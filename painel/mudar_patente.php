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

<center><bR><BR><font size=3><b> MUDAR PATENTE <bR><BR></font></b>

<?
require("inclu/config.php");
require("inclu/cookie.php");
require("inclu/verif_vip.php"); 
require("inclu/verif_resets.php");

echo "Nessa página você pode mudar a imagem da patente do seu personagem, você pode escolher todas<br> as imagens de patentes que você já conquistou, as novas patentes você não poderá escolher!<br><bR>
";

$char = $_GET[char];

if ($_GET[salvar]){
$pate = stripslashes($_POST['pate']);

if ($pate == 0 ) {
$exp = '0';
}
elseif ($pate == 1 ) {
$exp = '29';
}
elseif ($pate == 2 ) {
$exp = '49';
}
elseif ($pate == 3 ) {
$exp = '99';
}
elseif ($pate == 4 ) {
$exp = '199';
}
elseif ($pate == 5 ) {
$exp = '299';
}
elseif ($pate == 6 ) {
$exp = '399';
}
elseif ($pate == 7 ) {
$exp = '499';
}
elseif ($pate == 8 ) {
$exp = '999';
}
elseif ($pate == 9 ) {
$exp = '1999';
}
elseif ($pate == 10 ) {
$exp = '2999';
}
elseif ($pate == 11 ) {
$exp = '4999';
}
elseif ($pate == 12 ) {
$exp = '6999';
}
elseif ($pate == 13 ) {
$exp = '11999';
}
elseif ($pate == 14 ) {
$exp = '16999';
}
elseif ($pate == 15 ) {
$exp = '22999';
}
elseif ($pate == 16 ) {
$exp = '27999';
}
elseif ($pate == 17 ) {
$exp = '32999';
}
elseif ($pate == 18 ) {
$exp = '39999';
}
elseif ($pate == 19 ) {
$exp = '49999';
}
elseif ($pate == 20 ) {
$exp = '74999';
}
elseif ($pate == 21 ) {
$exp = '99999';
}
elseif ($pate == 22 ) {
$exp = '124999';
}
elseif ($pate == 23 ) {
$exp = '199999';
}
elseif ($pate == 24 ) {
$exp = '249999';
}
elseif ($pate == 25 ) {
$exp = '299999';
}
else {
$exp = -1;}

if ($exp < 0 ) { die("<br><br><br><br><b>Escolha uma patente.<bR><bR>");}


mssql_query("UPDATE Character SET patente = '$pate' where name = '$char' and accountid='$login' and exp_war>'$exp'");

echo '<script language="Javascript">alert("Patente salva com sucesso!")</script>';
}



if ($char){

$query = "Select Name, exp_war,patente From Character where accountid = '$login' and name='$char'";
$result = mssql_query( $query );
$row = mssql_fetch_row($result);

if (!$row) { die("<br><br><br><br><b>Esse personagem não existe ou não é da sua conta.<bR><bR>");}

if ($row [1] < 500 ) { die("<br><br><br><br><b><font color=$font_color1>Você deve ter pelo menos 500 pontos de experiência para mudar a patente de um personagem.<bR><bR>");}

$disable1 = 'disabled';
$disable2 = 'disabled';
$disable3 = 'disabled';
$disable4 = 'disabled';
$disable5 = 'disabled';
$disable6 = 'disabled';
$disable7 = 'disabled';
$disable8 = 'disabled';
$disable9 = 'disabled';
$disable10 = 'disabled';
$disable11 = 'disabled';
$disable12 = 'disabled';
$disable13 = 'disabled';
$disable14 = 'disabled';
$disable15 = 'disabled';
$disable16 = 'disabled';
$disable17 = 'disabled';
$disable18 = 'disabled';
$disable19 = 'disabled';
$disable20 = 'disabled';
$disable21 = 'disabled';
$disable22 = 'disabled';
$disable23 = 'disabled';
$disable24 = 'disabled';
$disable25 = 'disabled';

if ($row [1] > 499 ) {
$disable1 = '';
$disable2 = '';
$disable3 = '';
$disable4 = '';
$disable5 = '';
$disable6 = '';
$disable7 = '';
}
if ($row [1] > 999 ) {
$disable8 = '';
}
if ($row [1] > 1999 ) {
$disable9 = '';
}
if ($row [1] > 2999 ) {
$disable10 = '';
}
if ($row [1] > 4999 ) {
$disable11 = '';
}
if ($row [1] > 6999 ) {
$disable12 = '';
}
if ($row [1] > 11999 ) {
$disable13 = '';
}
if ($row [1] > 16999 ) {
$disable14 = '';
}
if ($row [1] > 22999 ) {
$disable15 = '';
}
if ($row [1] > 27999 ) {
$disable16 = '';
}
if ($row [1] > 32999 ) {
$disable17 = '';
}
if ($row [1] > 39999 ) {
$disable18 = '';
}
if ($row [1] > 49999 ) {
$disable19 = '';
}
if ($row [1] > 74999 ) {
$disable20 = '';
}
if ($row [1] > 99999 ) {
$disable21 = '';
}
if ($row [1] > 124999 ) {
$disable22 = '';
}
if ($row [1] > 199999 ) {
$disable23 = '';
}
if ($row [1] > 249999 ) {
$disable24 = '';
}
if ($row [1] > 299999 ) {
$disable25 = '';
}

if ($row[2]==1) { 
$check1 = 'checked';}
elseif ($row[2]==2) { 
$check2 = 'checked';}
elseif ($row[2]==3) { 
$check3 = 'checked';}
elseif ($row[2]==4) { 
$check4 = 'checked';}
elseif ($row[2]==5) { 
$check5 = 'checked';}
elseif ($row[2]==6) { 
$check6 = 'checked';}
elseif ($row[2]==7) { 
$check7 = 'checked';}
elseif ($row[2]==8) { 
$check8 = 'checked';}
elseif ($row[2]==9) { 
$check9 = 'checked';}
elseif ($row[2]==10) { 
$check10 = 'checked';}
elseif ($row[2]==11) { 
$check11 = 'checked';}
elseif ($row[2]==12) { 
$check12 = 'checked';}
elseif ($row[2]==13) { 
$check13 = 'checked';}
elseif ($row[2]==14) { 
$check14 = 'checked';}
elseif ($row[2]==15) { 
$check15 = 'checked';}
elseif ($row[2]==16) { 
$check16 = 'checked';}
elseif ($row[2]==17) { 
$check17 = 'checked';}
elseif ($row[2]==18) { 
$check18 = 'checked';}
elseif ($row[2]==19) { 
$check19 = 'checked';}
elseif ($row[2]==20) { 
$check20 = 'checked';}
elseif ($row[2]==21) { 
$check21 = 'checked';}
elseif ($row[2]==22) { 
$check22 = 'checked';}
elseif ($row[2]==23) { 
$check23 = 'checked';}
elseif ($row[2]==24) { 
$check24 = 'checked';}
elseif ($row[2]==25) { 
$check25 = 'checked';}
else { 
$check = 'checked';}



?>

<form name=formulario  method="post" action="?salvar=ok&char=<? echo $char;?>">
<table>
 <tr>
	<td><img src="/img/auto.jpg" width=100>        <br> <input name="pate" type="radio" class ="radio" value="0" <?php echo $check;?>> Automático</td>
	<td><img src="/img/guerreiro.jpg" width=100>   <br> <input name="pate" type="radio" class ="radio" value="1" <?php echo $check1;?> <?php echo $disable1;?>> Guerreiro</td>
	<td><img src="/img/estrategista.jpg" width=100><br> <input name="pate" type="radio" class ="radio" value="2" <?php echo $check2;?> <?php echo $disable2;?>> Estrategista</td>
	<td><img src="/img/gladiador.jpg" width=100>   <br> <input name="pate" type="radio" class ="radio" value="3" <?php echo $check3;?> <?php echo $disable3;?>> Gladiador</td>
	<td><img src="/img/sanguinario.jpg" width=100> <br> <input name="pate" type="radio" class ="radio" value="4" <?php echo $check4;?> <?php echo $disable4;?>> Sanguinário</td>
	<td><img src="/img/assassino.jpg" width=100>   <br> <input name="pate" type="radio" class ="radio" value="5" <?php echo $check5;?> <?php echo $disable5;?>> Assassino</td>
	<td><img src="/img/reidastrevas.jpg" width=100><br> <input name="pate" type="radio" class ="radio" value="6" <?php echo $check6;?> <?php echo $disable6;?>> Rei Trevas</td>

 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><img src="/img/membromk.jpg" width=100>    <br> <input name="pate" type="radio" class ="radio" value="7" <?php echo $check7;?> <?php echo $disable7;?>> Membro MK</td>
	<td><img src="/img/vingador.jpg" width=100>    <br> <input name="pate" type="radio" class ="radio" value="8" <?php echo $check8;?> <?php echo $disable8;?>> Vingador</td>
	<td><img src="/img/hero.jpg" width=100>        <br> <input name="pate" type="radio" class ="radio" value="9" <?php echo $check9;?> <?php echo $disable9;?>> Herói</td>
	<td><img src="/img/king.jpg" width=100>        <br> <input name="pate" type="radio" class ="radio" value="10" <?php echo $check10;?> <?php echo $disable10;?>> Rei Supremo</td>
	<td><img src="/img/mito.jpg" width=100>        <br> <input name="pate" type="radio" class ="radio" value="11" <?php echo $check11;?> <?php echo $disable11;?>> Mito</td>
	<td><img src="/img/mestretrevas.jpg" width=100><br> <input name="pate" type="radio" class ="radio" value="12" <?php echo $check12;?> <?php echo $disable12;?>> Mestre Trevas</td>
	<td><img src="/img/darkdefender.jpg" width=100><br> <input name="pate" type="radio" class ="radio" value="13" <?php echo $check13;?> <?php echo $disable13;?>> Justiceiro</td>

 </tr>

 <tr>
	<td> </td>
 </tr>

 <tr>
	<td><img src="/img/mercenario.jpg" width=100>  <br> <input name="pate" type="radio" class ="radio" value="14" <?php echo $check14;?> <?php echo $disable14;?>> Mercenário</td>
	<td><img src="/img/barbaro.jpg" width=100>     <br> <input name="pate" type="radio" class ="radio" value="15" <?php echo $check15;?> <?php echo $disable15;?>> Bárbaro</td>
	<td><img src="/img/guardiao.jpg" width=100>    <br> <input name="pate" type="radio" class ="radio" value="16" <?php echo $check16;?> <?php echo $disable16;?>> Guardião</td>
	<td><img src="/img/majestoso.jpg" width=100>   <br> <input name="pate" type="radio" class ="radio" value="17" <?php echo $check17;?> <?php echo $disable17;?>> Majestoso</td>
	<td><img src="/img/supremo.jpg" width=100>     <br> <input name="pate" type="radio" class ="radio" value="18" <?php echo $check18;?> <?php echo $disable18;?>> Supremo</td>
	<td><img src="/img/divino.jpg" width=100>      <br> <input name="pate" type="radio" class ="radio" value="19" <?php echo $check19;?> <?php echo $disable19;?>> Divino</td>
	<td><img src="/img/demonio.jpg" width=100>     <br> <input name="pate" type="radio" class ="radio" value="20" <?php echo $check20;?> <?php echo $disable20;?>> Demônio</td>

 </tr>

 <tr>
	<td><img src="/img/tita.jpg" width=100>  <br> <input name="pate" type="radio" class ="radio" value="21" <?php echo $check21;?> <?php echo $disable21;?>> Titã</td>
	<td><img src="/img/imortal.jpg" width=100>     <br> <input name="pate" type="radio" class ="radio" value="22" <?php echo $check22;?> <?php echo $disable22;?>> Imortal</td>
	<td><img src="/img/dragonslayer.jpg" width=100>     <br> <input name="pate" type="radio" class ="radio" value="23" <?php echo $check23;?> <?php echo $disable23;?>> Dragon Slayer</td>
	<td><img src="/img/lunatico.jpg" width=100>     <br> <input name="pate" type="radio" class ="radio" value="24" <?php echo $check24;?> <?php echo $disable24;?>> Lunático</td>
	<td><img src="/img/lenda.jpg" width=100>     <br> <input name="pate" type="radio" class ="radio" value="25" <?php echo $check25;?> <?php echo $disable25;?>> Lenda</td>
 </tr>

 <tr>
  <td colspan=7><br><br><center>  <input type='submit' value='Salvar Patente' class=imput></td>
 </tr>

</table></form>
<?
}
?>
