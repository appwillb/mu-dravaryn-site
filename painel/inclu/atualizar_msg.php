<?php

require("../inclu/config.php");
require("../inclu/cookie.php");

$dados_msg 	= mssql_fetch_row(mssql_query("SELECT COUNT(*) FROM mk_mensagens WHERE login='$login' and viu=0"));

$msgscount_viu	= $dados_msg[0];

if ($msgscount_viu > 0  ) 
	{ 
		echo "<img src=img/Pisca.gif> <font><b>$msgscount_viu</b></font>"; 
	} 
	else 
	{
		echo "<font><b>0</b></font>";
	}

?>

