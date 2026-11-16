<?php

$connect=error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);mysql_connect ("$MySql_host", "$MySql_login", "$MySql_senha") or die ('I cannot connect to the database because: ' . mysql_error());

mysql_select_db("$MySql_db");


?>