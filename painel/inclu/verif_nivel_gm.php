<?php

IF (!$NIVEL_ACESSO) $NIVEL_ACESSO = 0;

$nivel_query = mssql_query("SELECT dbo.fn_nivel_gm('$login')"); 
$nivel_dados = mssql_fetch_row($nivel_query);

include("erro.php");

if ($nivel_dados[0] < $NIVEL_ACESSO) {
die("$CONFIG_paginas_inicio Você não tem permissão para acessar essa área. $CONFIG_paginas_fim");}

?>