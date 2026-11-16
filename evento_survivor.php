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

<BR><BR><font size=3><b>EVENTO SURVIVOR</font></b> <BR><BR>

Todos os dias de 1 em 1 hora, valendo muitos prêmios aos vencedores.<bR>

Todas as classe são permitidas nesse evento! (Vejam os horários e os prêmios abaixo)<br>
Necessário ter no minimo 85 resetes para participar!<br><br>

Uma mensagem será exibida na tela indicando a abertura do evento, você deve com o Move(M) entrar no evento Survivor!<br><br>

<b>Mesmo que você não fique em primeiro aguarde até o final do evento para que seus pontos sejam validados. <br></b></font>

<table width=500 cellspacing=0>

	<thead>
		<tr>
	    	  <th colspan=2> Horários do evento </th>
		</tr>
	</thead>

<tr><td colspan=2><b>Todos os dias de 1 em 1 hora.</b></td>
<tr><td>00:10 hs</td><td>12:10 hs</td></tr>
<tr><td>01:10 hs</td><td>13:10 hs</td></tr>
<tr><td>02:10 hs</td><td>14:10 hs</td></tr>
<tr><td>03:10 hs</td><td>15:10 hs</td></tr>
<tr><td>04:10 hs</td><td>16:10 hs</td></tr>
<tr><td>05:10 hs</td><td>17:10 hs</td></tr>
<tr><td>06:10 hs</td><td>18:10 hs</td></tr>
<tr><td>07:10 hs</td><td>19:10 hs</td></tr>
<tr><td>08:10 hs</td><td>20:10 hs</td></tr>
<tr><td>09:10 hs</td><td>21:10 hs</td></tr>
<tr><td>10:10 hs</td><td>22:10 hs</td></tr>
<tr><td>11:10 hs</td><td>23:10 hs</td></tr>

	<thead>
 	 <tr>
  		<th colspan=2>Prêmio ao primeiro colocado</td>
	 </tr>
	</thead>

 	 <tr>
  		<td colspan=2>1000 Master Golds<br>1000 Golds<br>1000 pontos de exp<bR>50 pontos de eventos</td>
	 </tr>

</table><bR><bR>


<table border = 0  width=800 cellspacing=0s align=center>

	<thead>
 	 <tr>
  		<th colspan=5>Rei do Survivor</td>
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
$query = mssql_query("select TOP 10 name,sum(valor) as num, dbo.fn_exp(name),dbo.fn_patente(name) from log_custom_arena where arena=0 group by name order by num desc");

$i=0;

while ($row=mssql_fetch_row($query)){

$i++;

if ($i == 6) echo "
	<thead><tr style='background:transparent;'><td></td></tr>
 	 <tr>
  		<th><center>6º Colocado:</td>
  		<th><center>7º Colocado:</td>
  		<th><center>8º Colocado:</td>
  		<th><center>9º Colocado:</td>
  		<th><center>10º Colocado:</td>
 	 </tr>
	</thead><tr>";

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
