<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> MISSÕES <bR><BR></font></b>

<?
require_once("inclu/config.php");
require("inclu/cookie.php");

$select_missao = mssql_fetch_row(mssql_query("Select missoes From memb_info where memb___id='$login'"));

$missoes = 

   array(
	1  => "1 - Crie 1 Personagem.",
	2  => "2 - Chegue ao level 350 com algum pesonagem da sua conta.",
	3  => "3 - Tenha 15 resets ou mais.",
	4  => "4 - Tenha 100 resets ou mais.",
	5  => "5 - Tenha 200 resets ou mais.",
	6  => "6 - Use o Master Reset.",
	7  => "7 - Tenha 300 Master Resets.",
	8  => "8 - Tenha 5 personagens na sua conta.",
	9  => "9 - Tenha algum personagem na sua conta com 6 horas online na semana.",
	10 => "10 - Tenha 10 pontos de evento.",
	11 => "11 - Tenha 2000 Golds.",
	12 => "12 - Coloque um item no seu baú 1 (use /bau 1).",
	13 => "13 - Adicione o avatar(Imagem pessoal) da sua conta no site principal",
	14 => "14 - Tenha 100 pontos de morte.",
	15 => "15 - Chegue a 1500 pontos de Experiência com alguem personagem da sua conta",
	16 => "16 - Tenha 2 personagens na sua conta com 100 resets ou mais.",
	17 => "17 - Tenha um personagem Blade Master na sua conta",
	18 => "18 - Tenha um personagem Gran Master na sua conta",
	19 => "19 - Tenha 3 personagens na sua conta com 100 resets ou mais.",
	20 => "20 - Tenha algum personagem na sua conta com 12 horas online na semana.",
	21 => "21 - Ter mais de um mês VIP",
	22 => "22 - Escolha sua bandeira",
	23 => "23 - Ganhe alguma medalha",
	24 => "24 - Ganhe 20 eventos realizados pelos gms.",
	25 => "25 - Tenha 1000 resets ou mais.",
	26 => "26 - Deixe 5 personagens na sua conta no level 400.",
	27 => "27 - Tenha 1000 Master Resets.",
	28 => "28 - Tenha 4000 Golds.",
	29 => "29 - Tenha 500 pontos de morte.",
	30 => "30 - Tenha 300 resets semanal.",
	31 => "31 - Tenha 100 pontos de evento.",
	32 => "32 - Tenha 3 personagem com Master Level 330.",
	33 => "33 - Tenha 5 personagens com mais de 300 resets.",
	34 => "34 - Mate 100x a fenix.",
	35 => "35 - Faça 300.000 pontos no Blood Castle Semanal.",
	36 => "36 - Faça 5.500.000 pontos no evento Devil Square semanal.",
	37 => "37 - Ganhe 50 duelos na semana.",
); 

$premios = 

   array(
	1  => '10',
	2  => '20',
	3  => '30',
	4  => '40',
	5  => '50',
	6  => '60',
	7  => '70',
	8  => '80',
	9  => '90',
	10 => '100',
	11 => '100',
	12 => '100',
	13 => '100',
	14 => '100',
	15 => '100',
	16 => '100',
	17 => '100',
	18 => '100',
	19 => '100',
	20 => '100',
	21 => '200',
	22 => '300',
	23 => '200',
	24 => '200',
	25 => '100',
	26 => '100',
	27 => '300',
	28 => '200',
	29 => '200',
	30 => '400',
	31 => '200',
	32 => '300',
	33 => '300',
	34 => '300',
	35 => '500',
	36 => '200',
	37 => '200',

); 

if ($select_missao[0] > 37) 
{

	echo "<font color=$font_color2><b>Você completou todas as missões!<br><br>Aguarde novas missões!!";

echo "<br><Br><table>";
for ($i=1;$i < $select_missao[0];$i++) {

echo "<tr><td><img src=../img/ok.png width=15></td><td>".$missoes[$i]."</td><td align=right>".$premios[$i]." Exp</td></tr>";
}

echo "<table>";

} else {

if($_GET[missao]){

$missao = $_GET[missao];

if ($missao <> $select_missao[0])
{
	echo "<font size=2 color=$font_color1><b>Você não pode realizar essa missão!<bR><BR><a href=missoes.php>Voltar</a>";

} else { 

if ($missao == 1) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login'"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você ainda não criou nenhum personagem.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 2) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and clevel>349"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem no level 350 na sua conta.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 3) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and resetcount>14"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 15 resets ou mais.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 4) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and resetcount>99"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 100 resets ou mais.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 5) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and resetcount>199"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 200 resets ou mais.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 6) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and masterresetcount>0"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com master reset ativo.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao ==7) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and masterresetcount>299"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 300 master resets.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 8) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login'"));

if     ($char_check  < 5) {echo "<font size=2 color=$font_color1><b><br>Você não tem 5 personagens na sua conta.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 9) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and tempo > 359"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com mais de 6 horas online na semana.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 10) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and eventos > 9"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 10 pontos de eventos.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 11) {
$char_check = mssql_num_rows(mssql_query("Select goblinpoint FROM cashshopdata WHERE accountid='$login' and goblinpoint > 1999"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem 2000 Golds.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 12) {
$char_check = mssql_num_rows(mssql_query("Select accountid FROM extwarehouse WHERE accountid='$login'"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não colocou um item no baú 1.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 13) {
$char_check = mssql_num_rows(mssql_query("Select img FROM memb_info WHERE memb___id='$login' and img is not null"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não adicionou um avatar.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 14) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and z_rankpk > 99"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 100 ou mais pontos de morte.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 15) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and exp_war > 1499"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 1500 ou mais pontos de experiencia.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 16) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and resetcount > 99"));

if     ($char_check  < 2) {echo "<font size=2 color=$font_color1><b><br>Você não 2 personagens com 100 resets ou mais.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 17) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and class='18'"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem Blade Master.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 18) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and class='2'"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem Gran Master.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 19) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and resetcount > 99"));

if     ($char_check  < 3) {echo "<font size=2 color=$font_color1><b><br>Você não 3 personagens com 100 resets ou mais.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 20) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and tempo > 719"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com mais de 12 horas online na semana.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 21) {
$char_check = mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login' and accountexpiredate > getdate()+30"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem mais de 1 mês VIP.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}


if ($missao == 22) {
$char_check = mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login' and bandeira is not null"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não escolheu uma bandeira.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 23) {
$char_check = mssql_num_rows(mssql_query("Select login FROM mk_medalhas WHERE login='$login'"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhuma medalha.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 24) {
$char_check = mssql_num_rows(mssql_query("Select login_char FROM log_eventos WHERE login_char='$login'"));

if     ($char_check  < 20) {echo "<font size=2 color=$font_color1><b><br>Você não ganhou 20 eventos realizados por gms.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 25) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and resetcount>999"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 1000 resets ou mais.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 26) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and clevel>399"));

if     ($char_check  < 5) {echo "<font size=2 color=$font_color1><b><br>Você não tem 5 personagens no level 400.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao ==27) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and masterresetcount>999"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 1000 master resets.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 28) {
$char_check = mssql_num_rows(mssql_query("Select goblinpoint FROM cashshopdata WHERE accountid='$login' and goblinpoint > 3999"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem 4000 ou mais Golds.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 29) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and z_rankpk > 499"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 500 ou mais pontos de morte.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 30) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and reset_semanal > 299"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 300 ou mais resets semanais.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 31) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and eventos > 99"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem nenhum personagem com 100 pontos de eventos.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 32) {
$char_check = mssql_num_rows(mssql_query("select masterlevel from MasterSkillTree join Character on MasterSkilltree.name = Character.Name where accountid='$login' and MasterLevel=330"));

if     ($char_check  < 3) {echo "<font size=2 color=$font_color1><b><br>Você não tem 3 personagens com MasterLevel 330.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 33) {
$char_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE accountid='$login' and resetcount > 299"));

if     ($char_check  < 5) {echo "<font size=2 color=$font_color1><b><br>Você não tem 5 personagens com mais de 300 resets.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 34) {
$char_check = mssql_num_rows(mssql_query("Select name from character WHERE accountid='$login' and fenix>99"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não matou 100x a Fenix.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 35) {
$char_check = mssql_num_rows(mssql_query("select score_semanal from RankingBloodCastle join Character on RankingBloodCastle.name = Character.Name where accountid='$login' and score_semanal>299999"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não ganhou 300.000 pontos no Blood Castle Semanal.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 36) {
$char_check = mssql_num_rows(mssql_query("select score_semanal from RankingDevilSquare join Character on RankingDevilSquare.name = Character.Name where accountid='$login' and score_semanal>1499999"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não tem 1.500.000 pontos no evento Devil Square Semanal.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}

if ($missao == 37) {
$char_check = mssql_num_rows(mssql_query("select winscore_semanal from RankingDuel join Character on RankingDuel.name = Character.Name where accountid='$login' and winscore_semanal>49"));

if     ($char_check  <= 0) {echo "<font size=2 color=$font_color1><b><br>Você não ganhou 50 duelos nessa semana.<br><br><a href=?missao=$missao>Tentar novamente</a>";}
else {
mssql_query("UPDATE memb_info set missoes = missoes+1 where memb___id='$login'");
mssql_query("UPDATE character set exp_war=exp_war+$premios[$missao] where accountid='$login'");

echo "<font size=2 color=$font_color2><b><br>Parabéns você completou a Missão $missao.<br><br></b></font><br><a href=missoes.php>Clique aqui para fazer outra missão</a>";

}}




}
}

else {

echo "Bem vindo ao sistema de missões,<br> fazendo as missões você ganha pontos de experiência<bR> para todos os personagens da sua conta.<Br><BR>";
 
echo "<font size=2><b>Missão Nº $select_missao[0]:</font></b><br> ";

echo $missoes[$select_missao[0]];

echo "<br><Br><font size=2><b>Prêmio:</font></b><br> ";

echo $premios[$select_missao[0]]." pontos de Experiência";


echo "<br><Br><form name='form1' method='post' action='?missao=$select_missao[0]'>
<input type='submit' name='Submit' value='Realizar missão' style='font: 17px LithosProBold, Arial, sans-serif;color: #363636;'> 
</form>
";

echo "<br><Br><table>";
for ($i=1;$i < $select_missao[0];$i++) {

echo "<tr><td><img src=../img/ok.png width=15></td><td>".$missoes[$i]."</td></tr>";
}

echo "<table>";



}
}



?>

<br><bR><b>Sistema by louis.


</div>