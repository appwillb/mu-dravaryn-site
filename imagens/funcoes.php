<?php
include("config2.php"); 

function apagarfoto($idfoto) {
include("../painel/inclu/config.php");
include("../painel/inclu/cookie.php");

include("config2.php"); 
	
$comandoSql = "DELETE FROM fotos WHERE id = '$idfoto' ";

if (mysql_query($comandoSql)) {
print ("<center><strong>Foto deletada com sucesso!</strong></center>");
}
else print("<center><strong>Foto nao deletada!</strong></center>");
mysql_close();

}

?>