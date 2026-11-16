<?php

define('CONFIGPATH', dirname(__FILE__).'/');

require(CONFIGPATH."config.php");

ini_set('display_errors', false);

	$msconnect = mssql_connect("$DB_host","$DB_login","$DB_senha");
	$msdb	   = mssql_select_db("$DB_db",$msconnect);

	If (!$msconnect) 
	{
		Die("<font color=red><center><b>Banco de dados OFFLINE!<BR><BR></font>");	
	}

ini_set('display_errors', true);

?>