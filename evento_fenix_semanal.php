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


<center><bR><BR><font size=3><b> CAÇA A FENIX <bR><BR></font></b>

<?
include("inclu/config_simples.php");
?>


O evento caça a Fenix acontece a todo momento, você deve ir até icarus,<bR> encontrar a Fenix e matar, cada Fenix vale 1 ponto.<bR><BR>

<b>Quem matar mais ganha o prêmio semanal.</b><br><bR>

<br><bR>
<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>Vencedores da semana passada</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Ranking dessa semana:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 3 nome,dado,rank,dbo.fn_exp(nome),dbo.fn_patente(nome) from top_semanal where tipo=12 and data >= (select top 1 data from TOP_semanal where tipo=12 order by data desc, rank desc) order by data desc,rank asc");

$i = 0;

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$valor 		= $row[1];
$tipo 		= $row[2];
$patente_num 	= $row[3];
$patenten       = $row[4];

include 'inclu/patentes.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$valor Pontos<br></font></b>";
echo "</td>";

$i++;

}

while ($i < 3)
{
echo "<td>";
echo "<font size=3><b>Nenhum<br>";
echo "<img src='img/lenda.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "0 Pontos<br></font></b>";
echo "</td>";

$i++;

}
echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "select top 6 Name,fenix,dbo.fn_online(Name),dbo.fn_bandeira(dbo.fn_acc(Name)) from character order by fenix desc";
$result = mssql_query( $query );


for($i=1;$i < 7;++$i)
{
$row = mssql_fetch_row($result);

$valor = $row[1];
include 'inclu/tempo.php';

$xir 		= ($row[2] == 1) ? "<img src=painel/img/on2.gif>" : "<img src=painel/img/off2.gif>";
$bandeira 	= ($row[3]) ? "<img src=img/bandeiras30/$row[3].png>" : "<img src=img/bandeiras30/00.png>";

echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='$fundo_tab_cor'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td><font size=1>";
echo "<font style='font: 14px LithosProBold, Arial, sans-serif; color: black;'>";
echo $i."°</b></font>";
echo "</td><td>";
echo $bandeira;
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "$valor Pontos";
echo "</td><td>";
echo $xir;
echo "</td></tr>";

}

echo "";

echo "</table></td>";

$recorde = mssql_fetch_row(mssql_query("select TOP 1 nome,dado,CONVERT(VARCHAR(19),data,120) as data,dbo.fn_bandeira(dbo.fn_acc(nome)),dbo.fn_exp(nome),dbo.fn_patente(nome) from top_semanal where tipo=12 order by dado desc"));
$name_r = $recorde[0];
$valor_r= $recorde[1];
$data_r = date_create("$recorde[2]");
$data_r = date_format($data_r, 'd-m-Y');

$patente_num 	= $recorde[4];
$patenten       = $recorde[5];

include 'inclu/patentes.php';

$bandeira 	= ($recorde[3]) ? "<img src=img/bandeiras30/$recorde[3].png>" : "<img src=img/bandeiras30/00.png>";

?>

</tr>

	<thead>
 	 <tr>
  		<th>Prêmio</td>
  		<th class='bgtr'>Prêmio</td>
  		<th class='bgtr'>Prêmio</td>
  		<th>Recorde</td>
 	 </tr>
	</thead>

 	 <tr style="background:transparent;">
  		<td valign=top><font size=2>
			<br>5 dias VIP</b>
			<br>1000 Golds
			<bR>1000 EXP
		</td>

  		<td valign=top><font size=2>
			<br>5 dias VIP</b>
			<br>500 Golds
			<bR>500 EXP<BR><BR><BR>
		</td>

  		<td valign=top><font size=2>
			<br>5 dias VIP</b>
			<br>300 Golds
			<bR>300 EXP<BR><BR><BR>
		</td>
		<td><center>
			<table width=300 style='border:0;margin:0;' cellspacing=0>
			<tr style="background:transparent;"> 
				<td>
				  <img src='img/<?=$img?>.jpg' style='border: 1px solid #000000;height: 100px;' class=redondo2>
				</td>
				<td>
				  <a href='info_char_pop.php?name_r=$name&painel=ok'><font size=3><?=$bandeira?><br><?=$name_r?></a>
				</td>
				<td>
				Data:<br>
				<b><?=$data_r?></b><Br>
				Valor:<br>
				<b><?="$valor_r"?> Pontos</b>
				</td>
			</tr>
			</table>

		</td>
 	 </tr>

	<thead>
 	 <tr>
  		<th colspan=4>Como participar do evento</td>
	 </tr>
	</thead>

	<tr>
		<td colspan=4> <iframe width="560" height="315" src="https://www.youtube.com/embed/qaQiDAxGJsU" frameborder="0" allowfullscreen></iframe> </td>
	</tr>

</table>

<br><bR></div>

