<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">
  <link type="text/css" rel="stylesheet" href="css/paginas_img.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(1300);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>
</head>
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">
<br><Br><font size=3><b>EVENTO REI DO MU</font></b><br><br>

O evento Rei do Mu da prêmios para a Guild que ficar mais tempo como dona do Castelo de Devias na semana.

<Br><BR>

<?PHP 
require("inclu/config.php");
require("inclu/cookie.php");

$dona_check = mssql_query("SELECT top 1 g_Name,G_Mark,owner_time,owner_count FROM guild WHERE owner=1"); 
$dona = mssql_fetch_row($dona_check);

$logo = urlencode(bin2hex($dona[1]));

$min =         $dona[2];
include '../inclu/tempo.php';

$member_check = mssql_query("SELECT top 5 name,event_count,dbo.fn_online(name),dbo.fn_bandeira(dbo.fn_acc(name)) FROM guildmember WHERE g_name='$dona[0]' order by event_count desc");

?>

<table border = 0  width=900 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>Dona atual</td>
	 </tr>
 	 <tr>
  		<th><center>Guild:</td>
  		<th><center>Personagens que mais conquistaram:</td>
 	 </tr>
	</thead>

<?PHP 

echo "

	<tr style='background:transparent;'>
		<td> <a href='../info_guild_pop.php?modelist=$dona[0]'> <font size=3>$dona[0]</font><br>
	<img src='../inclu/decode.php?decode=$logo' height=80 width=80></a>
	<br> Tempo:</b> $H3 hs $m mins<br><bR><b>Conquistou:</b> $dona[3] x<br><bR>
		</td>

		<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>
";

for($i=1;$i < 6;++$i)
{
$row = mssql_fetch_row($member_check);


$xir 		= ($row[2] == 1) ? "<img src=img/on2.gif>" : "<img src=img/off2.gif>";
$bandeira 	= ($row[3]) ? "<img src=../img/bandeiras30/$row[3].png>" : "<img src=../img/bandeiras30/00.png>";

echo "<tr onclick=\"document.location.href='../info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='$fundo_tab_cor'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td><font size=1>";
echo "<font style='font: 14px LithosProBold, Arial, sans-serif; color: black;'>";
echo $i."°</b></font>";
echo "</td><td>";
echo $bandeira;
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo $row[1];
echo " x</td><td>";
echo $xir;
echo "</td></tr>";

}


echo "</table></table>";

?>
<br><BR>
<table border = 0  width=900 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>Melhores essa semana</td>
	 </tr>
 	 <tr>
  		<th><center>Ranking de tempo:</td>
  		<th><center>+ Conquistas Primeira colocada:</td>
  		<th><center>+ Conquistas geral:</td>
 	 </tr>
	</thead>

<tr style="background:transparent;"><td><table border=0 width=100% cellspacing=0 style='border:0;'>

<?PHP
$query = "SELECT TOP 5 G_name, owner_time,g_mark,owner_count from guild where g_count>4 order by owner_time desc, owner_count desc";
$result = mssql_query( $query );

for($i=1;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if (!$dona_tempo){
$dona_tempo= $row[0];
}

$min =         $row[1];
include '../inclu/tempo.php';

$logo = urlencode(bin2hex($row[2]));

echo "<tr onclick=\"document.location.href='../info_guild_pop.php?modelist=$row[0]'\" onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\">";
echo "<td><font size=3><b> $i °";
echo "</td><td>";
echo "<img src='../inclu/decode.php?decode=$logo' height=20 width=20>";
echo "</td><td>";
echo "$row[0]";
echo "</td><td>";
echo " $H3 hs $m m";
echo "</td><td>";
echo " $row[3] x";
echo "</td></tr>";

}

echo "</table></td><td>";


echo "<table border=0 width=100% cellspacing=0 style='border:0px;'>";

$query = "SELECT TOP 5 G_name, name, event_count from guildmember where g_name='$dona_tempo' order by event_count desc";
$result = mssql_query( $query );

for($i=1;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

$row2 = mssql_fetch_row(mssql_query("SELECT TOP 1 G_mark from guild where g_name='$row[0]'"));

$logo = urlencode(bin2hex($row2[0]));

echo "<tr onclick=\"document.location.href='../info_char_pop.php?painel=ok&name=$row[1]'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\">";
echo "<td><font size=3><b> $i °";
echo "</td><td>";
echo "<img src='../inclu/decode.php?decode=$logo' height=20 width=20>";
echo "</td><td>";
echo "$row[1]";
echo "</td><td>";
echo "$row[2] x";
echo "</td></tr>";
}

echo "</table></td><td>";

echo "<table border=0 width=100% cellspacing=0 style='border:0px;' >";

$query = "SELECT TOP 5 G_name, name, event_count from guildmember order by event_count desc";
$result = mssql_query( $query );

for($i=1;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

$row2 = mssql_fetch_row(mssql_query("SELECT TOP 1 G_mark from guild where g_name='$row[0]'"));

$logo = urlencode(bin2hex($row2[0]));

echo "<tr onclick=\"document.location.href='../info_char_pop.php?painel=ok&name=$row[1]'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\">";
echo "<td><font size=3><b> $i °";
echo "</td><td>";
echo "<img src='../inclu/decode.php?decode=$logo' height=20 width=20>";
echo "</td><td>";
echo "$row[1]";
echo "</td><td>";
echo "$row[2] x";
echo "</td></tr>";
}

?>

</table></table><br><br>

<table border = 0  width=900 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th colspan=4>Ultimos vencedores</td>
	 </tr>
 	 <tr>
  		<th><center>1º Colocado:</td>
  		<th><center>2º Colocado:</td>
  		<th><center>3º Colocado:</td>
  		<th><center>Personagem que mais conquistaram:</td>
 	 </tr>
	</thead>
	<tr style="background:transparent;">

<?php

$query = mssql_query("select TOP 3 nome,dado from top_semanal where tipo=7 order by data desc, rank asc");

while ($row=mssql_fetch_row($query)){

$name 	= $row[0];
$min 	= $row[1];

$logo = mssql_fetch_row(mssql_query("SELECT TOP 1 G_mark from guild where g_name='$row[0]'"));

$logo = urlencode(bin2hex($logo[0]));

include '../inclu/tempo.php';

echo "<td>";
echo "<b><a href='../info_guild_pop.php?modelist=$name&painel=ok'><font size=3>$name<br>";
echo "<img src='../inclu/decode.php?decode=$logo' height=100 width=100><br>";
echo "$bbb3 $H3 hs $m m<br></font></b>";
echo "</td>";

}
?>

<?

echo "<td><table border=0 width=100% height=100% cellspacing=0 style='border:0;'>";

$query = "SELECT nome,dado,dbo.fn_online(nome),dbo.fn_bandeira(dbo.fn_acc(nome)) from top_semanal where tipo=9 order by data desc,rank asc";
$result = mssql_query( $query );


for($i=1;$i < 6;++$i)
{
$row = mssql_fetch_row($result);


$xir 		= ($row[2] == 1) ? "<img src=img/on2.gif>" : "<img src=img/off2.gif>";
$bandeira 	= ($row[3]) ? "<img src=../img/bandeiras30/$row[3].png>" : "<img src=../img/bandeiras30/00.png>";

echo "<tr onclick=\"document.location.href='../info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='$fundo_tab_cor'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td><font size=1>";
echo "<font style='font: 14px LithosProBold, Arial, sans-serif; color: black;'>";
echo $i."°</b></font>";
echo "</td><td>";
echo $bandeira;
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo $row[1];
echo " x</td><td>";
echo $xir;
echo "</td></tr>";

}


echo "</table></td>";

?>

</tr>

	<thead>
 	 <tr>
  		<th>Prêmio</td>
  		<th class=bgtr>Prêmio</td>
  		<th class=bgtr>Prêmio</td>
  		<th>Prêmio</td>
 	 </tr>
	</thead>

 	 <tr style="background:transparent;">
  		<td valign=top style='text-align:left;'>
			- 20 créditos ao GM da Guild.<Br><Br>
			- 10 créditos para os membros<br> da guild que mais<br> conquistaram<Br><Br>
			- Todos da guild ganharam 3000<bR> pontos de Experiência.<BR><Br>
		</td>

  		<td valign=top style='text-align:left;'>
			- 15 créditos ao GM da Guild.<br><Br>
			- Todos da guild ganharam 2000<br> pontos de Experiência.
		</td>

  		<td valign=top style='text-align:left;'>
			- 10 créditos ao GM da Guild.<br><Br>
			- Todos da guild ganharam 1000<br> pontos de Experiência.
		</td>
		<td valign=top>
		- 1º Colocado: 5000 Experiência<Br>
		- 2º Colocado: 4000 Experiência<Br>
		- 3º Colocado: 3000 Experiência<Br>
		- 4º Colocado: 2000 Experiência<Br>
		- 5º Colocado: 1000 Experiência<Br>

		</td>
 	 </tr>

</table><br>

<b>O Top é zerado toda Segunda-Feira 00:00hs!</b><bR><br>


<table border = 0  width=900 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th>Requisitos para participar:</td>
	 </tr>
	</thead>
	<tr style="background:transparent;">
	<td>		- Ser Guild Master ou membro de uma guild com 5 membros.</td>

	<thead>
 	 <tr>
  		<th>Como particpar:</td>
	 </tr>
	</thead>
	  <tr>
		<td>
1 - Aguardar o anuncio do evento!<br>
2 - Algum membro da guild deve ir ao castelo de Davias, coordenada x225 y237(Trono lado esquerdo), e digitar o comando /rei!<BR>
3 - Não é necessário o GM da guild estar online, qualquer membro pode solicitar a coroa.<BR>
4 - Depois que pegar a coroa, a guild deve proteger o castelo e não permitir que nenhuma outra guild o domine e solicite a coroa.<BR>
5 - A guild que ficar mais tempo com a coroa na semana ganha os prêmios.<BR>
6 - O evento dura 20 minutos, o tempo semanal só conta durante o evento.<BR>
7 - A cada conquista você ganha 1 ponto de evento e 10 de Exp.<BR>
		</td>
	  </tr>

	<thead>
 	 <tr>
  		<th>Regras:</td>
	 </tr>
	</thead>

	  <tr>
		<td>
-É permitido qualquer personagem participar mesmo sem guild.<Br>
-É permitido guilds se unirem para atacar o castelo, mais não é permitido defenderem juntas.<Br>
-Não é permitido ficar alternando conquistas com outra guild.<Br>
-Não é permitido que uma personagem sem guild fique dentro do castelo ajudando outra guild.<Br>
-Não é permitido duas guild se unirem e ficarem próximas ou dentro do castelo.<Br><Br>
		</td>
	  </tr>

</table>

</div>

