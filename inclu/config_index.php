<?php
define('CONFIGPATH', dirname(__FILE__).'/');
require_once(CONFIGPATH . "config.php");

ini_set('display_errors', false);

$msconnect = mssql_connect("$DB_host", "$DB_login", "$DB_senha");
$msdb      = mssql_select_db("$DB_db", $msconnect);

ini_set('display_errors', true);

// Validate active user session cookies
if (isset($_COOKIE["usuario"]) && isset($_COOKIE["senha"])) {
    $c_user = addslashes(trim($_COOKIE["usuario"]));
    $c_pass = trim($_COOKIE["senha"]);

    $sql_user = @mssql_query("SELECT memb___id, memb__pwd FROM MEMB_INFO WHERE LOWER(memb___id) = LOWER('$c_user')");
    $u_data   = ($sql_user) ? @mssql_fetch_assoc($sql_user) : false;

    $cookie_valid = false;
    if ($u_data && !empty($u_data['memb__pwd'])) {
        $expected_token = md5($u_data['memb__pwd']);
        if ($c_pass === $expected_token || $c_pass === $u_data['memb__pwd']) {
            $cookie_valid = true;
        }
    }

    if (!$cookie_valid) {
        // Invalidate corrupt/expired cookies silently
        setcookie("usuario", "", time() - 3600, "/");
        setcookie("senha", "", time() - 3600, "/");
        unset($_COOKIE["usuario"]);
        unset($_COOKIE["senha"]);
    }
}
?>