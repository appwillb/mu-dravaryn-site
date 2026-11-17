<?php
/**
 * MU Dravaryn - Ultra-Resilient Database Compatibility Shim
 * Maps legacy mssql_* and mysql_* functions to PostgreSQL via PDO with HTTP Fallback.
 */

class MuDatabase {
    private static $pdo = null;
    private static $last_error = '';
    private static $use_http_fallback = false;

    public static function getConnection($host = null, $user = null, $pass = null, $dbname = null) {
        if (self::$pdo === null && !self::$use_http_fallback) {
            $dbHost = getenv('DB_HOST') ?: ($host ?: '187.127.26.213');
            $dbPort = getenv('DB_PORT') ?: '5432';
            $dbName = getenv('DB_NAME') ?: ($dbname ?: 'openmu');
            $dbUser = getenv('DB_USER') ?: ($user ?: 'postgres');
            $dbPass = getenv('DB_PASSWORD') ?: ($pass ?: 'postgres');

            try {
                $dsn = "pgsql:host={$dbHost};port={$dbPort};dbname={$dbName};options='--search_path=public,data,config'";
                self::$pdo = new PDO($dsn, $dbUser, $dbPass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
                    PDO::ATTR_CASE => PDO::CASE_NATURAL,
                    PDO::ATTR_TIMEOUT => 2
                ]);
            } catch (Exception $e) {
                // If direct port 5432 is unreachable inside container network, activate HTTP API fallback
                self::$use_http_fallback = true;
                self::$last_error = $e->getMessage();
            }
        }
        return self::$pdo ?: true;
    }

    public static function query($sql, $conn = null) {
        self::getConnection();

        // Translate SQL dialect from T-SQL to PostgreSQL
        $translated = $sql;
        $translated = str_ireplace('getdate()', 'NOW()', $translated);
        $translated = str_ireplace('(getdate())', 'NOW()', $translated);
        $translated = str_ireplace('dbo.', 'public.', $translated);
        $translated = str_ireplace('[dbo].', 'public.', $translated);
        $translated = preg_replace('/\\[(\\w+)\\]/', '"$1"', $translated);
        $translated = preg_replace('/\\bmemb_info\\b/i', 'public."MEMB_INFO"', $translated);
        $translated = preg_replace('/\\bmemb_stat\\b/i', 'public."MEMB_STAT"', $translated);
        $translated = preg_replace('/CONVERT\\s*\\(\\s*VARCHAR\\s*\\(\\s*\\d+\\s*\\)\\s*,\\s*([^,)]+)\\s*,\\s*\\d+\\s*\\)/i', '($1)::text', $translated);
        $translated = preg_replace('/CONVERT\\s*\\(\\s*VARCHAR\\s*\\(\\s*\\d+\\s*\\)\\s*,\\s*([^)]+)\\s*\\)/i', '($1)::text', $translated);
        $translated = str_ireplace('isnull(', 'coalesce(', $translated);
        $translated = preg_replace('/\\blen\\s*\\(/i', 'length(', $translated);

        if (preg_match('/SELECT\\s+TOP\\s+(\\d+)\\s+(.*)/i', $translated, $m)) {
            $limit = $m[1];
            $rest = $m[2];
            $translated = "SELECT " . $rest . " LIMIT " . $limit;
        }

        // 1. Try PDO if connected
        if (self::$pdo instanceof PDO && !self::$use_http_fallback) {
            try {
                $stmt = self::$pdo->query($translated);
                if ($stmt !== false) {
                    return new MuResult($stmt->fetchAll(PDO::FETCH_BOTH));
                }
            } catch (Exception $e) {
                // Fallthrough to HTTP fallback
            }
        }

        // 2. HTTP Fallback to pgweb API on port 8088
        $url = 'http://187.127.26.213:8088/api/query?query=' . urlencode($translated);
        $ctx = stream_context_create([
            'http' => [
                'method' => 'POST',
                'timeout' => 4,
                'header' => "Content-Type: application/x-www-form-urlencoded\r\nContent-Length: 0\r\n"
            ]
        ]);

        $resp = @file_get_contents($url, false, $ctx);
        if ($resp !== false) {
            $json = json_decode($resp, true);
            if (isset($json['rows'])) {
                $cols = isset($json['columns']) ? $json['columns'] : [];
                $formatted_rows = [];
                foreach ($json['rows'] as $r) {
                    $row = [];
                    foreach ($r as $idx => $val) {
                        $row[$idx] = $val;
                        if (isset($cols[$idx])) {
                            $row[$cols[$idx]] = $val;
                        }
                    }
                    $formatted_rows[] = $row;
                }
                return new MuResult($formatted_rows);
            }
        }

        return false;
    }

    public static function getLastError() {
        return self::$last_error;
    }
}

class MuResult {
    private $rows = [];
    private $cursor = 0;

    public function __construct($rows) {
        $this->rows = is_array($rows) ? $rows : [];
    }

    public function fetchRow() {
        if ($this->cursor < count($this->rows)) {
            $row = $this->rows[$this->cursor++];
            $num_row = [];
            foreach ($row as $k => $v) {
                if (is_int($k)) $num_row[$k] = $v;
            }
            return $num_row;
        }
        return false;
    }

    public function fetchAssoc() {
        if ($this->cursor < count($this->rows)) {
            $row = $this->rows[$this->cursor++];
            $assoc_row = [];
            foreach ($row as $k => $v) {
                if (!is_int($k)) $assoc_row[$k] = $v;
            }
            return $assoc_row;
        }
        return false;
    }

    public function fetchArray() {
        if ($this->cursor < count($this->rows)) {
            return $this->rows[$this->cursor++];
        }
        return false;
    }

    public function numRows() {
        return count($this->rows);
    }

    public function result($row = 0, $field = 0) {
        if (isset($this->rows[$row][$field])) {
            return $this->rows[$row][$field];
        }
        return false;
    }
}

// Global legacy MSSQL functions
if (!function_exists('mssql_connect')) {
    function mssql_connect($host = null, $user = null, $pass = null) {
        return MuDatabase::getConnection($host, $user, $pass);
    }
    function mssql_select_db($db, $conn = null) {
        return true;
    }
    function mssql_query($sql, $conn = null) {
        return MuDatabase::query($sql, $conn);
    }
    function mssql_fetch_row($res) {
        if ($res instanceof MuResult) return $res->fetchRow();
        return false;
    }
    function mssql_fetch_assoc($res) {
        if ($res instanceof MuResult) return $res->fetchAssoc();
        return false;
    }
    function mssql_num_rows($res) {
        if ($res instanceof MuResult) return $res->numRows();
        return 0;
    }
    function mssql_result($res, $row, $field = 0) {
        if ($res instanceof MuResult) return $res->result($row, $field);
        return false;
    }
    function mssql_close($conn = null) {
        return true;
    }
}

// Global legacy MySQL functions
if (!function_exists('mysql_connect')) {
    function mysql_connect($host = null, $user = null, $pass = null) {
        return MuDatabase::getConnection($host, $user, $pass);
    }
    function mysql_select_db($db, $conn = null) {
        return true;
    }
    function mysql_query($sql, $conn = null) {
        return MuDatabase::query($sql, $conn);
    }
    function mysql_fetch_array($res) {
        if ($res instanceof MuResult) return $res->fetchArray();
        return false;
    }
    function mysql_num_rows($res) {
        if ($res instanceof MuResult) return $res->numRows();
        return 0;
    }
    function mysql_error($conn = null) {
        return MuDatabase::getLastError();
    }
    function mysql_close($conn = null) {
        return true;
    }
}
?>
