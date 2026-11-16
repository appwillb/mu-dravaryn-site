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


<BR><BR><font size=3><b>TOP MENSAL</font></b> <BR><BR>

<font size=2><b>Vencedores do último TOP Mensal</font></b><br><br>

O top Mensal dá prêmios aos melhores personagens do Mês.<bR>
<b>Qualquer personagem que quebrar um dos recordes abaixo ganha 25 créditos. <br></b></font>
Se você conseguir basta entrar em contato pelo site!<br>
O Top é zerado todo Dia primeiro do mês de madrugada!<br><br>

<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>TOP TEMPO</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Ranking desse Mês:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
require("inclu/config_simples.php");
$query = mssql_query("select TOP 3 nome,dado,rank,dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=3 and data >= (select top 1 data from TOP_mensal where tipo=3 order by data desc, rank desc) order by data desc,rank asc");

$i = 0;

while ($row=mssql_fetch_row($query)){

$name 		= $row[0];
$min 		= $row[1];
$tipo 		= $row[2];
$patente_num 	= $row[3];
$patenten       = $row[4];

include 'inclu/patentes.php';
include 'inclu/tempo.php';

echo "<td>";
echo "<b><a href='info_char_pop.php?name=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='img/$img.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "$bbb3 $H3 hs $m m<br></font></b>";
echo "</td>";

$i++;

}

while ($i < 3)
{
echo "<td>";
echo "<font size=3><b>Nenhum<br>";
echo "<img src='img/lenda.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "0 hs 00 m<br></font></b>";
echo "</td>";

$i++;

}
?>

<?

echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "select top 6 Name,tempo_mensal,dbo.fn_online(Name),dbo.fn_bandeira(dbo.fn_acc(Name)) from character order by tempo_mensal desc";
$result = mssql_query( $query );


for($i=1;$i < 7;++$i)
{
$row = mssql_fetch_row($result);

$min = $row[1];
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
echo $H3."hs".$m;
echo "</td><td>";
echo $xir;
echo "</td></tr>";

}

echo "";

echo "</table></td>";

$recorde = mssql_fetch_row(mssql_query("select TOP 1 nome,dado,CONVERT(VARCHAR(19),data,120) as data,dbo.fn_bandeira(dbo.fn_acc(nome)),dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=3 order by dado desc"));
$name_r = $recorde[0];

$data_r = date_create("$recorde[2]");
$data_r = date_format($data_r, 'd-m-Y');

$patente_num 	= $recorde[4];
$patenten       = $recorde[5];

include 'inclu/patentes.php';

$min = $recorde[1];
include 'inclu/tempo.php';
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
			Medalha: <bR><img src='img/medals/medal_12.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Tempo' alt = 'Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Tempo'>
			<br><b>10 créditos</b></b>
			<br>10 dias VIP*</b>
			<br>1000 M.Golds
			<br>3000 Golds
			<bR>3000 EXP
		</td>

  		<td valign=top><font size=2>
			<br><b>7 créditos</b></b>
			<br>7 dias VIP*</b>
			<br>500 M.Golds
			<br>2000 Golds
			<bR>2000 EXP<bR><BR><BR>
		</td>

  		<td valign=top><font size=2>
			<br><b>5 créditos</b></b>
			<br>5 dias VIP*</b>
			<br>300 M.Golds
			<br>1000 Golds
			<bR>1000 EXP<bR><BR><BR>
		</td>
		<td><center>
			<table width=300 style='border:0;margin:0;' cellspacing=0>
			<tr style="background:transparent;"> 
				<td>
				  <img src='img/<?=$img?>.jpg' style='border: 1px solid #000000;height: 100px;' class=redondo2>
				</td>
				<td>
				  <a href='info_char_pop.php?name=<?=$name_r;?>&painel=ok'><font size=3><?=$bandeira?><br><?=$name_r?></a>
				</td>
				<td>
				Data:<br>
				<b><?=$data_r?></b><Br>
				Valor:<br>
				<b><?="$bbb3 $H3 hs $m mn"?></b>
				</td>
			</tr>
			</table>

		</td>
 	 </tr>

</table>

<br><bR>
<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>TOP MASTER RESETS</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Ranking desse Mês:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 3 nome,dado,rank,dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=2 and data >= (select top 1 data from TOP_mensal where tipo=2 order by data desc, rank desc) order by data desc,rank asc");

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
echo "$valor M.Resets<br></font></b>";
echo "</td>";

$i++;

}

while ($i < 3)
{
echo "<td>";
echo "<font size=3><b>Nenhum<br>";
echo "<img src='img/lenda.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "0 M.Resets<br></font></b>";
echo "</td>";

$i++;

}

echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "select top 6 Name,mreset_mensal,dbo.fn_online(Name),dbo.fn_bandeira(dbo.fn_acc(Name)) from character order by mreset_mensal desc";
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
echo "$valor MR";
echo "</td><td>";
echo $xir;
echo "</td></tr>";

}

echo "";

echo "</table></td>";

$recorde = mssql_fetch_row(mssql_query("select TOP 1 nome,dado,CONVERT(VARCHAR(19),data,120) as data,dbo.fn_bandeira(dbo.fn_acc(nome)),dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=2 order by dado desc"));
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
			Medalha: <bR><img src='img/medals/medal_40.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Master Resets' alt = 'Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Master Resets'>
			<br><b>15 créditos</b></b>
			<br>10 dias VIP*</b>
			<br>3000 M.Golds
			<br>6000 Golds
			<bR>6000 EXP
		</td>

  		<td valign=top><font size=2>
			<br><b>10 créditos</b></b>
			<br>7 dias VIP*</b>
			<br>1000 M.Golds
			<br>4000 Golds
			<bR>4000 EXP<bR><BR><BR>
		</td>

  		<td valign=top><font size=2>
			<br><b>5 créditos</b></b>
			<br>5 dias VIP*</b>
			<br>500 M.Golds
			<br>2000 Golds
			<bR>2000 EXP<bR><BR><BR>
		</td>
		<td><center>
			<table width=300 style='border:0;margin:0;' cellspacing=0>
			<tr style="background:transparent;"> 
				<td>
				  <img src='img/<?=$img?>.jpg' style='border: 1px solid #000000;height: 100px;' class=redondo2>
				</td>
				<td>
				  <a href='info_char_pop.php?name=<?=$name_r?>e&painel=ok'><font size=3><?=$bandeira?><br><?=$name_r?></a>
				</td>
				<td>
				Data:<br>
				<b><?=$data_r?></b><Br>
				Valor:<br>
				<b><?="$valor_r"?> MR</b>
				</td>
			</tr>
			</table>

		</td>
 	 </tr>

</table>

<br><bR>
<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>TOP RESETS</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Ranking desse Mês:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 3 nome,dado,rank,dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=1 and data >= (select top 1 data from TOP_mensal where tipo=1 order by data desc, rank desc) order by data desc,rank asc");

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
echo "$valor Resets<br></font></b>";
echo "</td>";

$i++;

}

while ($i < 3)
{
echo "<td>";
echo "<font size=3><b>Nenhum<br>";
echo "<img src='img/lenda.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "0 Resets<br></font></b>";
echo "</td>";

$i++;

}

echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "select top 6 Name,reset_mensal,dbo.fn_online(Name),dbo.fn_bandeira(dbo.fn_acc(Name)) from character order by reset_mensal desc";
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
echo "$valor R";
echo "</td><td>";
echo $xir;
echo "</td></tr>";

}

echo "";

echo "</table></td>";

$recorde = mssql_fetch_row(mssql_query("select TOP 1 nome,dado,CONVERT(VARCHAR(19),data,120) as data,dbo.fn_bandeira(dbo.fn_acc(nome)),dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=1 order by dado desc"));
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
			Medalha: <bR><img src='img/medals/medal_13.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Resets' alt = 'Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Resets'>
			<br><b>10 créditos</b></b>
			<br>10 dias VIP*</b>
			<br>1000 M.Golds
			<br>3000 Golds
			<bR>3000 EXP
		</td>

  		<td valign=top><font size=2>
			<br><b>7 créditos</b></b>
			<br>7 dias VIP*</b>
			<br>500 M.Golds
			<br>2000 Golds
			<bR>2000 EXP<bR><BR><BR>
		</td>

  		<td valign=top><font size=2>
			<br><b>5 créditos</b></b>
			<br>5 dias VIP*</b>
			<br>300 M.Golds
			<br>1000 Golds
			<bR>1000 EXP<bR><BR><BR>
		</td>
		<td><center>
			<table width=300 style='border:0;margin:0;' cellspacing=0>
			<tr style="background:transparent;"> 
				<td>
				  <img src='img/<?=$img?>.jpg' style='border: 1px solid #000000;height: 100px;' class=redondo2>
				</td>
				<td>
				  <a href='info_char_pop.php?name=<?=$name_r?>&painel=ok'><font size=3><?=$bandeira?><br><?=$name_r?></a>
				</td>
				<td>
				Data:<br>
				<b><?=$data_r?></b><Br>
				Valor:<br>
				<b><?="$valor_r"?> R</b>
				</td>
			</tr>
			</table>

		</td>
 	 </tr>

</table>

<br><bR>
<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>TOP EVENTOS</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Ranking desse Mês:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 3 nome,dado,rank,dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=4 and data >= (select top 1 data from TOP_mensal where tipo=4 order by data desc, rank desc) order by data desc,rank asc");

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
echo "$valor Eventos<br></font></b>";
echo "</td>";

$i++;

}

while ($i < 3)
{
echo "<td>";
echo "<font size=3><b>Nenhum<br>";
echo "<img src='img/lenda.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "0 Eventos<br></font></b>";
echo "</td>";

$i++;

}

echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "select top 6 Name,eventos_mensal,dbo.fn_online(Name),dbo.fn_bandeira(dbo.fn_acc(Name)) from character order by eventos_mensal desc";
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
echo "$valor Eventos";
echo "</td><td>";
echo $xir;
echo "</td></tr>";

}

echo "";

echo "</table></td>";

$recorde = mssql_fetch_row(mssql_query("select TOP 1 nome,dado,CONVERT(VARCHAR(19),data,120) as data,dbo.fn_bandeira(dbo.fn_acc(nome)),dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=4 order by dado desc"));
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
			Medalha: <bR><img src='img/medals/medal_18.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Eventos' alt = 'Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Eventos'>
			<br><b>10 créditos</b></b>
			<br>10 dias VIP*</b>
			<br>1000 M.Golds
			<br>3000 Golds
			<bR>3000 EXP
		</td>

  		<td valign=top><font size=2>
			<br><b>7 créditos</b></b>
			<br>7 dias VIP*</b>
			<br>500 M.Golds
			<br>2000 Golds
			<bR>2000 EXP<bR><BR><BR>
		</td>

  		<td valign=top><font size=2>
			<br><b>5 créditos</b></b>
			<br>5 dias VIP*</b>
			<br>300 M.Golds
			<br>1000 Golds
			<bR>1000 EXP<bR><BR><BR>
		</td>
		<td><center>
			<table width=300 style='border:0;margin:0;' cellspacing=0>
			<tr style="background:transparent;"> 
				<td>
				  <img src='img/<?=$img?>.jpg' style='border: 1px solid #000000;height: 100px;' class=redondo2>
				</td>
				<td>
				  <a href='info_char_pop.php?name=<?=$name_r?>&painel=ok'><font size=3><?=$bandeira?><br><?=$name_r?></a>
				</td>
				<td>
				Data:<br>
				<b><?=$data_r?></b><Br>
				Valor:<br>
				<b><?="$valor_r"?> Eventos</b>
				</td>
			</tr>
			</table>

		</td>
 	 </tr>

</table>

<br><bR>
<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>TOP MORTES</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Ranking desse Mês:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 3 nome,dado,rank,dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=5 and data >= (select top 1 data from TOP_mensal where tipo=5 order by data desc, rank desc) order by data desc,rank asc");

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
echo "$valor Mortes<br></font></b>";
echo "</td>";

$i++;

}

while ($i < 3)
{
echo "<td>";
echo "<font size=3><b>Nenhum<br>";
echo "<img src='img/lenda.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "0 Mortes<br></font></b>";
echo "</td>";

$i++;

}

echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "select top 6 Name,Z_RANKPK_mensal,dbo.fn_online(Name),dbo.fn_bandeira(dbo.fn_acc(Name)) from character order by Z_RANKPK_mensal desc";
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
echo "$valor Mortes";
echo "</td><td>";
echo $xir;
echo "</td></tr>";

}

echo "";

echo "</table></td>";

$recorde = mssql_fetch_row(mssql_query("select TOP 1 nome,dado,CONVERT(VARCHAR(19),data,120) as data,dbo.fn_bandeira(dbo.fn_acc(nome)),dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=5 order by dado desc"));
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
			Medalha: <bR><img src='img/medals/medal_48.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Mortes' alt = 'Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Mortes'>
			<br><b>10 créditos</b></b>
			<br>10 dias VIP*</b>
			<br>1000 M.Golds
			<br>3000 Golds
			<bR>3000 EXP
		</td>

  		<td valign=top><font size=2>
			<br><b>7 créditos</b></b>
			<br>7 dias VIP*</b>
			<br>500 M.Golds
			<br>2000 Golds
			<bR>2000 EXP<bR><BR><BR>
		</td>

  		<td valign=top><font size=2>
			<br><b>5 créditos</b></b>
			<br>5 dias VIP*</b>
			<br>300 M.Golds
			<br>1000 Golds
			<bR>1000 EXP<bR><BR><BR>
		</td>
		<td><center>
			<table width=300 style='border:0;margin:0;' cellspacing=0>
			<tr style="background:transparent;"> 
				<td>
				  <img src='img/<?=$img?>.jpg' style='border: 1px solid #000000;height: 100px;' class=redondo2>
				</td>
				<td>
				  <a href='info_char_pop.php?name=<?=$name_r?>&painel=ok'><font size=3><?=$bandeira?><br><?=$name_r?></a>
				</td>
				<td>
				Data:<br>
				<b><?=$data_r?></b><Br>
				Valor:<br>
				<b><?="$valor_r"?> Mortes</b>
				</td>
			</tr>
			</table>

		</td>
 	 </tr>

</table>

<br><bR>
<table border = 0  width=800 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>TOP HERO</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Ranking desse Mês:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php
$query = mssql_query("select TOP 3 nome,dado,rank,dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=6 and data >= (select top 1 data from TOP_mensal where tipo=6 order by data desc, rank desc) order by data desc,rank asc");

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
echo "$valor Hero<br></font></b>";
echo "</td>";

$i++;

}

while ($i < 3)
{
echo "<td>";
echo "<font size=3><b>Nenhum<br>";
echo "<img src='img/lenda.jpg' width='100' style='border: 1px solid #000000;height: 150px;' class=redondo2><br>";
echo "0 Hero<br></font></b>";
echo "</td>";

$i++;

}

echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "select top 6 Name,Z_RANKHR_mensal,dbo.fn_online(Name),dbo.fn_bandeira(dbo.fn_acc(Name)) from character order by Z_RANKHR_mensal desc";
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
echo "$valor Hero";
echo "</td><td>";
echo $xir;
echo "</td></tr>";

}

echo "";

echo "</table></td>";

$recorde = mssql_fetch_row(mssql_query("select TOP 1 nome,dado,CONVERT(VARCHAR(19),data,120) as data,dbo.fn_bandeira(dbo.fn_acc(nome)),dbo.fn_exp(nome),dbo.fn_patente(nome) from top_mensal where tipo=6 order by dado desc"));
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
			Medalha: <bR><img src='img/medals/medal_n13.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Hero' alt = 'Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Hero'>
			<br><b>10 créditos</b></b>
			<br>10 dias VIP*</b>
			<br>1000 M.Golds
			<br>3000 Golds
			<bR>3000 EXP
		</td>

  		<td valign=top><font size=2>
			<br><b>7 créditos</b></b>
			<br>7 dias VIP*</b>
			<br>500 M.Golds
			<br>2000 Golds
			<bR>2000 EXP<bR><BR><BR>
		</td>

  		<td valign=top><font size=2>
			<br><b>5 créditos</b></b>
			<br>5 dias VIP*</b>
			<br>300 M.Golds
			<br>1000 Golds
			<bR>1000 EXP<bR><BR><BR>
		</td>
		<td><center>
			<table width=300 style='border:0;margin:0;' cellspacing=0>
			<tr style="background:transparent;"> 
				<td>
				  <img src='img/<?=$img?>.jpg' style='border: 1px solid #000000;height: 100px;' class=redondo2>
				</td>
				<td>
				  <a href='info_char_pop.php?name=<?=$name_r?>&painel=ok'><font size=3><?=$bandeira?><br><?=$name_r?></a>
				</td>
				<td>
				Data:<br>
				<b><?=$data_r?></b><Br>
				Valor:<br>
				<b><?="$valor_r"?> Hero</b>
				</td>
			</tr>
			</table>

		</td>
 	 </tr>

</table>
<br><br>
*Você ganha os dias de acordo com seu VIP, caso não seja vip irá ganhar o VIP básico.

<br><br>"Vencer a si próprio é a maior das vitórias."

</div>
