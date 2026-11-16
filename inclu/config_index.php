<?php

define('CONFIGPATH', dirname(__FILE__).'/');

require(CONFIGPATH."config.php");

ini_set('display_errors', false);

//Configuração da mensagem de erro do banco de dados offline no index do site	
$msg_erro="
	<p style='height : 260px;'>
		<center>
		  <table width=800>
			<tr>
 			  	<td width=0></td><td height='200' width='400' style='border-radius: 10px;padding-top:15px;background-color:rgba(25,28,35,0.7);'><br><br><center><font size=3 color=white>Estamos em Manuten&#231;&#227;o!<br><br><br>Voltamos em Breve.<br><bR><bR><bR></font> </td>
				<td>&nbsp;</td>
		        </tr>
                  </table>
	</p>";

$msconnect 	= mssql_connect("$DB_host", "$DB_login", "$DB_senha") or die("$msg_erro");
$msdb		= mssql_select_db("$DB_db",$msconnect) or die("Couldn't select database $myDB");

ini_set('display_errors', true);

if ((isset($_COOKIE["usuario"])) && (isset($_COOKIE["senha"]))) 
{
	$login = $_COOKIE["usuario"];
	$psw   = $_COOKIE["senha"];

	$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb___id='$login' and memb__pwd='$psw'"); 
	$pw_check     = mssql_num_rows($sql_pw_check);

	if ($pw_check <= 0) 
	{
		echo "
		<script>
			top.location.href = 'logar.php?deslogar=ok';
		</script>
		";

		Die();
	}
}

?>