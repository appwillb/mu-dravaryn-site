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

<center><bR><BR><font size=3><b> TRANSFERIR CREDITOS <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");
?>


<Script language="JavaScript">
function confirmaCompra(aURL,msg) {
if(confirm(msg)) {
location.href = aURL;
}
}
</script>

	<script src="js/numeros.js"></script>

<?

$taxa = 5;

$row_char = mssql_fetch_row(mssql_query("Select wcoinc From CashShopData where accountid='$login'"));

If ($_POST) {

$login_creditos = stripslashes($_POST['conta']);
$valor          = stripslashes($_POST['valor']);

$erro_Valor = 0;  
if (preg_match("[^0-9]", $valor)) 
{ 
$erro_valor = 1;  
}

$username_check = mssql_num_rows(mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb___id='$login_creditos'"));

$username_check2 = mssql_num_rows(mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb___id='$login'"));

$cashdata_check  = mssql_num_rows(mssql_query("Select wcoinc From CashShopData where accountid='$login_creditos'")); 

echo "<font size=2>";

if (!$row_char or !$login_creditos or !$valor or $valor=="Valor") {
echo "<br><br><b><font color=$font_color1>Campos em branco!.";}

elseif ($username_check <= 0) { 
echo "<br><br><b><font color=$font_color1>Esse login não existe em nosso banco de dados.";}

elseif ($cashdata_check <= 0) { 
echo "<br><br><b><font color=$font_color1>A conta de destino precisa abrir o Shop dentro do jogo primeiro.";}

elseif ($username_check2 <= 0) { 
echo "<br><br><b><font color=$font_color1>Você não pode transferir créditos para outras contas.";}

elseif ($valor <= 0) { 
echo "<br><br><b><font color=$font_color1>O valor deve ser maior que zero.";}

elseif ($erro_valor == 1) { 
echo "<br><br><b><font color=$font_color1>Somente números por favor.";}

elseif ($row_char[0] < ($valor+$taxa)) { 
echo "<br><br><b><font color=$font_color1>Você não tem créditos suficientes para transferir.";}

else {

$ip2 = $_SERVER["REMOTE_ADDR"];

mssql_query("update CashShopData set wcoinc=wcoinc-($valor+$taxa) where accountid='$login'");
mssql_query("update CashShopData set wcoinc=wcoinc+$valor where accountid='$login_creditos'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','-$valor','$ip2','17')");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','-$taxa','$ip2','18')");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login_creditos','$valor','$ip2','19')");
mssql_query("INSERT INTO LOG_TRANSFERENCIA_CREDITOS ( login, login_destino, valor, ip ) values ('$login','$login_creditos','$valor','$ip2')");

echo "<br><bR><font color=$font_color2><B>Você transferiu $valor créditos para a conta $login_creditos !!</B><bR><br>Bom jogo.<br><bR>www.mukoreia.net";

$creditos=$creditos-$valor;

echo "<script language='javascript'>
document.getElementById.('ServerTime').innerHTML ='$creditos';
</script>";

}

echo "<br><bR>";

}

else { 

?>

<table width=700 style='border:0;'><tr style="background:transparent;"><td><centeR>

Nessa página você pode transferir créditos da sua conta para outra.<Br><br>

<font color=<? echo $font_color1;?>><b>Taxa: <? echo $taxa;?> Créditos </b></font><bR><br>

Coloquei o login e o valor a ser tranferido abaixo:
<Br>

<form name='form1' method='post' action=''>
<br><font size=2>Você tem <b><? echo "$row_char[0]";?> </b> Créditos:<br><br>
<input name='conta' type='text' id='conta' maxlength='20' value='Digite o Login' onClick="this.select();"; style='text-align:center'><br><bR>
<input name='valor' type='text' id='valor' maxlength='20' value='Valor' onClick="this.select();"; style='text-align:center' onkeypress="javascript: return numbers(event);" ><br>
Exemplo: 10, 20, 30 créditos!
<bR><bR>
<input type='image' src='img/BT_confirmar.png' name='Submit' value='Transferir' style='border:0;background:transparent;'> 
</form>

</tr></table>


<br><br>

<? } ?>

</div>
