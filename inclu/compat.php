<?php
/**
 * MU Dravaryn - Database Compatibility Shim
 * Maps legacy mssql_* and mysql_* functions to PostgreSQL via PDO.
 */

class MuDatabase {
    private static $pdo = null;
    private static $last_stmt = null;
    private static $last_insert_id = null;
    private static $last_error = '';

    public static function getConnection($host = null, $user = null, $pass = null, $dbname = null) {
        if (self::$pdo === null) {
            $dbHost = getenv('DB_HOST') ?: ($host ?: 'postgres');
            $dbPort = getenv('DB_PORT') ?: '5432';
            $dbName = getenv('DB_NAME') ?: ($dbname ?: 'openmu');
            $dbUser = getenv('DB_USER') ?: ($user ?: 'postgres');
            $dbPass = getenv('DB_PASSWORD') ?: ($pass ?: 'postgres');

            try {
                $dsn = "pgsql:host={$dbHost};port={$dbPort};dbname={$dbName};options='--search_path=public,data,config'";
                self::$pdo = new PDO($dsn, $dbUser, $dbPass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
                    PDO::ATTR_CASE => PDO::CASE_NATURAL
                ]);
            } catch (PDOException $e) {
                self::$last_error = $e->getMessage();
                return false;
            }
        }
        return self::$pdo;
    }

    public static function query($sql, $conn = null) {
        $pdo = self::getConnection();
        if (!$pdo) return false;

        // Clean & Translate SQL dialect from T-SQL to PostgreSQL
        $translated = $sql;
        $translated = str_ireplace('getdate()', 'NOW()', $translated);
        $translated = str_ireplace('(getdate())', 'NOW()', $translated);
        $translated = str_ireplace('dbo.', 'public.', $translated);
        $translated = str_ireplace('[dbo].', 'public.', $translated);
        $translated = preg_replace('/\[(\w+)\]/', '"$1"', $translated);

        // Replace TOP N syntax if present
        if (preg_match('/SELECT\s+TOP\s+(\d+)\s+(.*)/i', $translated, $m)) {
            $limit = $m[1];
            $rest = $m[2];
            $translated = "SELECT " . $rest . " LIMIT " . $limit;
        }

        try {
            $stmt = $pdo->query($translated);
            if ($stmt === false) {
                $err = $pdo->errorInfo();
                self::$last_error = isset($err[2]) ? $err[2] : 'Unknown SQL error';
                return false;
            }
            self::$last_stmt = $stmt;
            return new MuResult($stmt);
        } catch (Exception $e) {
            self::$last_error = $e->getMessage();
            return false;
        }
    }

    public static function getLastError() {
        return self::$last_error;
    }
}

class MuResult {
    private $stmt;
    private $rows = null;
    private $cursor = 0;

    public function __construct($stmt) {
        $this->stmt = $stmt;
        $this->rows = $stmt->fetchAll(PDO::FETCH_BOTH);
    }

    public function fetchRow() {
        if ($this->cursor < count($this->rows)) {
            $row = $this->rows[$this->cursor++];
            // Return numerically indexed row
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