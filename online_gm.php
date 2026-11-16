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

<br><br><font size=4><b>STAFF ONLINE</b></font><br><br>

<?php
include("inclu/config_simples.php");

echo "<a href=gm_vantagens.php><font size=2><b>Clique aqui para ver as Vantagens de ser GM</a></b><br><BR>";

?>

<table width='800' border='0' cellpadding='2' cellspacing='0' bordercolor=black>
<thead>
    <tr>
      <th colspan=7>Membros da staff</th>
    </tr>
    <tr>
      <th>Nome:</th>
      <th>Cargo:</th>
      <th>Status:</th>
      <th>Sala:</th>
      <th>Tempo Semanal:</th>
      <th>Eventos hoje:</th>
      <th>Eventos total:</th>
    </tr>

</thead>

<?php

$query = mssql_query("Select Name, evento, evento_dia, dbo.fn_online(Name), memb_stat.servername, nivel_gm, ctlcode, character.tempo From Character,memb_stat WHERE character.accountid=memb_stat.memb___id COLLATE database_default and nivel_gm>0 order by nivel_gm desc,evento desc");

while($row=mssql_fetch_row($query)){

$min = $row[7];
include 'inclu/tempo.php';

$niv = $row[5];
include 'inclu/status_char.php';

$color='red';
if($niv==4) {	$color='blue'; 		}
if($niv==3) {	$color='darkblue'; 	}
if($niv==2) {	$color='green'; 	}
if($niv==1) {	$color='darkorange'; 	}


echo "<tr onclick=\"location.href='info_char_pop.php?painel=ok&&name=$row[0]'\" onmouseover=\"this.style.cursor='pointer';\">";

echo "<td><b> $row[0] </b></td>";

echo "<td> <font color=$color> <b> $nivel_gm2 </font></td>";

echo "<td>".(($row[3] == 1) ? "<img src=painel/img/on2.gif>" : "<img src=painel/img/off2.gif>")."</td>";

echo (($row[3] == 1) ? "<td> $row[4] </td>" : "<td> - </td>");

echo "<td style='text-align:right;'> $H3 hs $m mins </td>";

echo (($niv > 1) ? "<td> $row[2] </td>" : "<td> - </td>");

echo (($niv > 1) ? "<td> $row[1] </td>" : "<td> - </td>");

echo '</tr>';
}
echo "</table><br><br>";

?>


</div>
