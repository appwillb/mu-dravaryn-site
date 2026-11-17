<?php
define('CONFIGPATH', dirname(__FILE__).'/');

require(CONFIGPATH."../../inclu/config.php");

ini_set('display_errors', false);

$msg_erro="
	<script>
		top.location.href = '../site.php';
	</script>
";

$msconnect 	= mssql_connect("$DB_host", "$DB_login", "$DB_senha") or die("$msg_erro");
$msdb		= mssql_select_db("$DB_db",$msconnect) or die("Couldn't select database $myDB");

ini_set('display_errors', true);

$eleicao 	= 0;
$eleicao_on 	= 0;

if (!empty($_COOKIE['usuario']) && !empty($_COOKIE['senha'])) {
    $login = addslashes($_COOKIE['usuario']);
    $psw   = $_COOKIE['senha'];

    $sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE LOWER(memb___id)=LOWER('$login')"); 
    $user_row = ($sql_pw_check) ? mssql_fetch_assoc($sql_pw_check) : false;

    $valid = false;
    if ($user_row && !empty($user_row['memb__pwd'])) {
        $stored = $user_row['memb__pwd'];
        if ($psw === md5($stored) || $psw === $stored || md5($psw) === $stored) {
            $valid = true;
        }
    }

    if (!$valid) {
        echo "<script>top.location.href = 'index.php?deslogar=ok';</script>";
        die(); 
    }
}
?>