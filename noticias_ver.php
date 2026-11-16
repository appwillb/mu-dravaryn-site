<?
require("inclu/config.php");

$dbh = error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);mysql_connect ("$MySql_host", "$MySql_login", "$MySql_senha") or print ('Erro ao tentar conectar ao banco de dados' . mysql_error());
mysql_select_db ("$MySql_db"); 

$id_news= $_GET[news];

$query = "SELECT id, date_format(data, '%d/%m/%Y') as data_formatada, titulo, noticia, user, dias_promo FROM noticias where id = '$id_news'";
$result = mysql_query( $query );
$row = mysql_fetch_array($result);

$color = '';
if ($row[dias_promo] > 0 ){
$color = "color = yellow";
}

echo "

	<table cellspacing='0' width=520>
	<thead>
		<tr>
      		  <th><font size=2 $color>$row[data_formatada] - $row[titulo]</font><br></td>
		</tr>
	</thead>

    	<tr style='background:#eee;'>
      		<td valign=top>";

		$noticia = nl2br($row[noticia]);
		$noticia = $noticia;

		echo "<font size=2>$noticia</font>";

echo "</td>
   </tr></table>

";


?>
