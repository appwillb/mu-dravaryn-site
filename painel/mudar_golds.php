<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

<Script language="JavaScript">
function confirmaCompra(aURL,msg) {
if(confirm(msg)) {
location.href = aURL;
}
}
</script>
</head>
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<?
require("inclu/config.php");
require("inclu/cookie.php");

$titulo = "Transferir Golds"; 

echo "<title>$titulo</title>";
echo $fundo_topo;
echo $titulo;
echo $fundo_topo_fim;


?>


<Script language="JavaScript">
function confirmaCompra(aURL,msg) {
if(confirm(msg)) {
location.href = aURL;
}
}
</script>

<?

$taxa = 10;

If ($_POST) {
$char = $_POST['id'];

$row_char = mssql_fetch_row(mssql_query("Select pontos From character where name = '$char' and accountid='$login'"));

$login_creditos = stripslashes($_POST['conta']);
$valor          = stripslashes($_POST['valor']);

$username_check = mssql_num_rows(mssql_query("SELECT name FROM character WHERE name = '$char'and accountid='$login'"));

$username_check2 = mssql_num_rows(mssql_query("SELECT name FROM character WHERE name = '$login_creditos'"));

//$comprou_check = mssql_num_rows(mssql_query("SELECT login FROM log_vip WHERE login='$login_vip' and tipo='$vip' and (CONVERT(CHAR(8),data,10))=(CONVERT(CHAR(8),GETDATE(),10))")); 

echo "<font size=2>";

if (!$row_char or !$login_creditos or !$valor or $valor=="Valor") {
echo "<br><br><b><font color=$font_color1>Campos em branco!.";}

elseif ($username_check <= 0) { 
echo "<br><br><b><font color=$font_color1>Esse char não existe em nosso banco de dados.";}

elseif ($username_check2 <= 0) { 
echo "<br><br><b><font color=$font_color1>Esse char não existe em nosso banco de dados.";}

elseif ($valor <= 0) { 
echo "<br><br><b><font color=$font_color1>O valor deve ser maior que zero.";}

elseif ($row_char[0] < ($valor+$taxa)) { 
echo "<br><br><b><font color=$font_color1>Você não tem Golds suficientes para transferir.";}

else {

$ip2 = $_SERVER["REMOTE_ADDR"];

mssql_query("update character set pontos=pontos-($valor+$taxa) where name = '$char'");
mssql_query("update character set pontos=pontos+$valor where name ='$login_creditos'");
mssql_query("INSERT INTO LOG_GOLDS ( login, name, name_destino, valor, ip ) values ('$login','$char','$login_creditos','$valor','$ip2')");

echo "<br><bR><font color=$font_color2><B>Você transferiu $valor Golds para o personagem $login_creditos !!</B><bR><br>Bom jogo.<br><bR>www.mukoreia.net";

}

echo "<br><bR>";

}

else { 

$sql_username_check = mssql_query("SELECT GameID1, GameID2, GameID3, GameID4, GameID5 FROM AccountCharacter WHERE Id='$login'"); 
$username_check = mssql_num_rows($sql_username_check); 
$username_get = mssql_fetch_row( $sql_username_check );


$name_check1 = mssql_query("SELECT name FROM character WHERE name='$username_get[0]' and accountid='$login'"); 
$name_check11 = mssql_num_rows($name_check1);
if($name_check11 <= 0){
$username_get[0] = "<font color=red>Nenhum Persoagem</font>";}
else {
$username_get[0] = "<option value='$username_get[0]'>1. $username_get[0]</option>";}

$name_check2 = mssql_query("SELECT name FROM character WHERE name='$username_get[1]' and accountid='$login'"); 
$name_check22 = mssql_num_rows($name_check2);
if($name_check22 <= 0){
$username_get[1] = "<font color=red>Nenhum Persoagem</font>";}
else {
$username_get[1] = "<option value='$username_get[1]'>2. $username_get[1]</option>";}

$name_check3 = mssql_query("SELECT name FROM character WHERE name='$username_get[2]' and accountid='$login'"); 
$name_check33 = mssql_num_rows($name_check3);
if($name_check33 <= 0){
$username_get[2] = "<font color=red>Nenhum Persoagem</font>";}
else {
$username_get[2] = "<option value='$username_get[2]'>3. $username_get[2]</option>";}

$name_check4 = mssql_query("SELECT name FROM character WHERE name='$username_get[3]' and accountid='$login'"); 
$name_check44 = mssql_num_rows($name_check4);
if($name_check44 <= 0){
$username_get[3] = "<font color=red>Nenhum Persoagem</font>";}
else {
$username_get[3] = "<option value='$username_get[3]'>4. $username_get[3]</option>";}

$name_check5 = mssql_query("SELECT name FROM character WHERE name='$username_get[4]' and accountid='$login'"); 
$name_check55 = mssql_num_rows($name_check5);
if($name_check55 <= 0){
$username_get[4] = "<font color=red>Nenhum Persoagem</font>";}
else{
$username_get[4] = "<option value='$username_get[4]'>5. $username_get[4]</option>";}



?>

<table width=700><tr><td><centeR>

Nessa página você pode transferir golds da seu personagem para outro.<Br><br>

<font color=<? echo $font_color1;?>><b>Taxa: <? echo $taxa;?> Golds </b></font><bR><br>

<font size=2><b>Descontar os golds desse personagem:</font><bR><bR>
<form name='form1' method='post' action=''>

<select name='id' id='id'>
<option>-Escolhar Personagem-</option>
<? echo $username_get[0];?>
<? echo $username_get[1];?>
<? echo $username_get[2];?>
<? echo $username_get[3];?> 
<? echo $username_get[4];?> 
</select><br><bR>

<font size=2>Coloque o Personagem  e o valor a ser tranferido abaixo:<bR>
<Br>
<input name='conta' type='text' id='conta' maxlength='20' value='Digite o Char' onClick="this.select();"; style='text-align:center'><br><bR>
<input name='valor' type='text' id='valor' maxlength='20' value='Valor' onClick="this.select();"; style='text-align:center'><br><bR>
<input type='image' src='img/BT_confirmar.png' name='Submit' value='Transferir' style='border:0;background:transparent;'> 
</form>

</tr></table>


<br><br>

<? } ?>

</div>
