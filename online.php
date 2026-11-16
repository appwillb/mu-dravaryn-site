<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />

        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>


<?
include("inclu/config_simples.php");

echo "<br><font size=4><b>ONLINE AGORA</b></font><br><br>";


$query = "Select Name, Resetcount, masterresetcount, clevel, MapNumber, CONVERT(VARCHAR(19),memb_stat.ConnectTM,120) as data, memb_info.AccountLevel,dbo.fn_ml(Name) From Character, MEMB_STAT,accountcharacter,memb_info where 
Character.AccountId =AccountCharacter.id COLLATE database_default and
Character.AccountId =Memb_stat.memb___id COLLATE database_default and
Character.name =AccountCharacter.gameIDC COLLATE database_default and
Character.AccountId =Memb_info.memb___id COLLATE database_default and
memb_stat.Connectstat=1 order by ConnectTM desc";
$result = mssql_query( $query );

$xex = mssql_num_rows($result);

echo "<table border=0 cellspacing=0 width=800>
<thead>
<tr>
<th>Personagem</td>
<th class='bgtr'>Level</td>
<th class='bgtr'>M.Level</td>
<th class='bgtr'>Resets</td>
<th class='bgtr'>M.Resets</td>
<th class='bgtr'>Mapa</td>
<th class='bgtr'>VIP</td>
<th>Conectou</td>
<tr></thead>";

for($i=0;$i < $xex;++$i)
{
$row = mssql_fetch_row($result);

$resets	     = $row[1];
$mresets     = $row[2];
$level 	     = $row[3];
$mapa        = $row[4];
$hora        = $row[5];
$mlevel      = $row[7];

$hora = date_create("$hora");
$hora = date_format($hora, 'd-m H:i');

$vip2 = $row[6];

if ($vip2 > 0) { 
$vip = "<font color=green>SIM</b></font>"; }
else { 
$vip = "<font color=red>Não</b></font>"; }

include 'inclu/mapas.php';

echo "<tr>";
echo "<td><a href='info_char_pop.php?painel=ok&name=$row[0]' target=main2><font size=2>$row[0]</a></td>";
echo "<td>$level</td>";
echo "<td>$mlevel</td>";
echo "<td>$resets</td>";
echo "<td>$mresets</td>";
echo "<td>$map</td>";
echo "<td>$vip</td>";
echo "<td>$hora</td>";
echo '<tr>';

}
echo '</table></div>';
