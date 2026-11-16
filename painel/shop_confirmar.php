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
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> CONFIRMAR PAGAMENTO <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET['confirmar']){
$data 		= stripslashes($_POST['data']);
$hora 		= stripslashes($_POST['hora']);
$terminal 	= stripslashes($_POST['terminal']);
$valor 		= stripslashes($_POST['Valor']);
$conta 		= stripslashes($_POST['conta']);
$mensagem 	= utf8_encode(stripslashes($_POST['mensagem']));
$ip 		= $_SERVER["REMOTE_ADDR"];

if ($data==null || $hora==null || $terminal==null || $valor==null || $conta==null || $mensagem==null){
Echo "<font size=2 color=$font_color1><br><b>Alguns Campos em branco. Preencha todos os campos por favor.</font><br><bR><br>
<center><input type='submit' value='Voltar' style='font: 17px LithosProBold, Arial, sans-serif;
	color: #363636;' onclick='history.go(-1)'>
";
}

else {
mssql_query("INSERT INTO mk_Pagamentos ( login,data,hora,terminal,conta,valor,dados,ip) values ('$login','$data','$hora','$terminal','$conta','$valor','$mensagem','$ip')");
echo "<br><bR><font size=2 color=$font_color2><b>Confirmação enviada com sucesso!!</b><bR><bR>
O Prazo para confirmação é de 1 ou 2 dias Úteis.<br><Br>
Você irá receber uma mensagem de confirmação em seu painel de controle!!<bR><Br>
Obrigado <bR>
www.jogandomu.com.br";
}

}

Else {

?>
<center>
<br><br>
<form name="form" id="form" method="post" action="?confirmar=ok">

<center><table width="600" border="0" cellspacing="5" cellpadding="0">

<tr> 
	<td width="150" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Data</strong></font> </td>
	<td> </td>

	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
	<input name="data" value="" size="15" maxlength="15" onclick="document.forms[0].sendBtn.disabled=false;document.forms[0].sendBtn.value='Enviar Confirmação'"></font></td>
</tr>

<tr> 
	<td width="150" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Hora exata</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
	<input name="hora" value="" size="15" maxlength="15" onclick="document.forms[0].sendBtn.disabled=false;document.forms[0].sendBtn.value='Enviar Confirmação'"></font></td>
</tr>

<tr> 
	<td width="150" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Terminal</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
	<input name="terminal" value="" size="10" maxlength="10" onclick="document.forms[0].sendBtn.disabled=false;document.forms[0].sendBtn.value='Enviar Confirmação'"></font></td>
</tr>

<tr> 
	<td width="150" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Valor</strong></font> </td>

	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
	<input name="Valor" value="R$" size="10" maxlength="10" onclick="document.forms[0].sendBtn.disabled=false;document.forms[0].sendBtn.value='Enviar Confirmação'"></font></td>
</tr>

<tr> 
	<td width="150" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Qual conta usou?</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
<select name="conta" size="1" style="width:200px" onchange="document.forms[0].sendBtn.disabled=false;document.forms[0].sendBtn.value='Enviar Confirmação'">
<option value=""></option>
<option value="Caixa Economica 1632-0">Caixa Economica 1632-0</option>
<option value="Caixa Economica 73591-2">Caixa Economica 73591-2</option>
<option value="Banco do Brasil">Banco do Brasil</option> 
<option value="PagSeguro">PagSeguro UOL</option>
<option value="PayPal">PayPal</option></select></font></select></td>
</tr>

<tr> 
	<td width="150" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><br>Dados:</strong></font> </td>
	<td> </td><tr>
	<td valign="top"colspan=3> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><textarea name="mensagem" cols="80" rows="15" onclick="document.forms[0].sendBtn.disabled=false;document.forms[0].sendBtn.value='Enviar Confirmação'">Coloque os resto dos dados aqui!

Se Pagou no Banco do Brasil coloque o número do envelope!

Se pagou com pagamento seguro, favor informar seu nome completo ou se usou cartão o nome do titular do cartão!

</textarea></font></td>
</tr>

</table>

<p> 
<input name="sendBtn" id="sendBtn" type="submit" style='font: 17px LithosProBold, Arial, sans-serif;
	color: #363636;' value="Enviar Confirmação" onclick="this.form.submit();this.disabled=true; this.value='Processando ... ' "><br><br>

<?
}
?>

</div>
