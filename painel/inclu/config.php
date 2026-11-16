<?

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

if ($_COOKIE['usuario'] && $_COOKIE['senha']) {
$login = $_COOKIE['usuario'];
$psw   = $_COOKIE['senha'];

$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb___id='$login' and memb__pwd='$psw'"); 
$pw_check = mssql_num_rows($sql_pw_check);

if ($pw_check <= 0) {

echo "
<script>
	top.location.href = 'index.php?deslogar=ok';
</script>
";

die(); 
}

}
?>