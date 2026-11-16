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

<BR><BR><font size=3><b>EVENTO ARENA CUSTOM (Rei do PvP)</font></b> <BR><BR>

Todos os sábados ocorre o evento arena custom, valendo muitos prêmios aos vencedores.<bR>

O evento ocorre em vários horários dividios por classe! (Vejam os horários e os prêmios abaixo)<br>
Apenas o primeiro colocado ganha o prêmio!<br><br>

Uma mensagem será exibida na tela indicando a abertura do evento, você deve com o Move(M) escolher e entrar na arena apropriada!<br><br>

<b>Mesmo que você não fique em primeiro aguarde até o final do evento para que seus pontos sejam validados. <br></b></font>

<table border = 0  width=600 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=2>Horários</td>
	 </tr>
	</thead>
 	 <tr>
  		<td><center>DM x DM:</td>
  		<td><center><b>17:00:00</td>
 	 </tr>
 	 <tr>
  		<td><center>GM x GM:</td>
  		<td><center><b>17:20:00</td>
 	 </tr>
 	 <tr>
  		<td><center>BM x BM:</td>
  		<td><center><b>17:40:00</td>
 	 </tr>
 	 <tr>
  		<td><center>FM x FM:</td>
  		<td><center><b>18:00:00</td>
 	 </tr>
 	 <tr>
  		<td><center>LE x LE:</td>
  		<td><center><b>18:20:00</td>
 	 </tr>
 	 <tr>
  		<td><center>ELF x ELF:</td>
  		<td><center><b>18:40:00</td>
 	 </tr>
 	 <tr>
  		<td><center>SUM x SUM:</td>
  		<td><center><b>19:00:00</td>
 	 </tr>

	<thead>
 	 <tr>
  		<th colspan=2>Prêmio ao primeiro colocado</td>
	 </tr>
	</thead>

 	 <tr>
  		<td colspan=2><b>10 Créditos</b><br>1000 Master Golds<br>1000 Golds<br>1000 pontos de exp<bR>50 pontos de eventos</td>
	 </tr>

</table><bR><bR>



<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=5>REI DO PvP Duel Master</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>4º Colocado:</td>
  		<th><center>5º Colocado:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
include("inclu/config_simples.php");

$query = mssql_query("select TOP 5 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=1 group by name order by num desc");

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$patente_num 	= $row[2];
$patenten       = $row[3];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos</font></b>";
echo "</td>";

}
echo "</table><br><Br>";
?>

<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=5>REI DO PvP Gran Master</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>4º Colocado:</td>
  		<th><center>5º Colocado:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php


$query = mssql_query("select TOP 5 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=2 group by name order by num desc");

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$patente_num 	= $row[2];
$patenten       = $row[3];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos</font></b>";
echo "</td>";

}
echo "</table><br><Br>";
?>

<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=5>REI DO PvP Blade Master</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>4º Colocado:</td>
  		<th><center>5º Colocado:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 5 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=3 group by name order by num desc");

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$patente_num 	= $row[2];
$patenten       = $row[3];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos</font></b>";
echo "</td>";

}
echo "</table><br><Br>";
?>

<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=5>REI DO PvP Fist Master</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>4º Colocado:</td>
  		<th><center>5º Colocado:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 5 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=4 group by name order by num desc");

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$patente_num 	= $row[2];
$patenten       = $row[3];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos</font></b>";
echo "</td>";

}
echo "</table><br><Br>";
?>

<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=5>REI DO PvP Lord Emperor</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>4º Colocado:</td>
  		<th><center>5º Colocado:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 5 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=5 group by name order by num desc");

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$patente_num 	= $row[2];
$patenten       = $row[3];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos</font></b>";
echo "</td>";

}
echo "</table><br><Br>";
?>

<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=5>REI DO PvP High Elf</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>4º Colocado:</td>
  		<th><center>5º Colocado:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 5 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=6 group by name order by num desc");

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$patente_num 	= $row[2];
$patenten       = $row[3];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos</font></b>";
echo "</td>";

}
echo "</table><br><Br>";
?>

<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=5>REI DO PvP Dimension Master</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>4º Colocado:</td>
  		<th><center>5º Colocado:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 5 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=7 group by name order by num desc");

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$patente_num 	= $row[2];
$patenten       = $row[3];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos</font></b>";
echo "</td>";

}
echo "</table>";
?>

<bR><BR>
</div>
