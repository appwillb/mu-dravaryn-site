<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
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


<BR><BR><font size=4><b>ENTRAR EM CONTATO</font></b> <BR><BR>

<?

if ($server=='easy') {
$code_linkws='31793';
} 
elseif ($server=='hard') { 
$code_linkws='37678';
} 
elseif ($server=='new') {
$code_linkws='108925';
} else {
$code_linkws='31793';
}

?>

<script src="http://www.linkws.com/js/s_validate.js"></script>
<script>
function validateForm(form) {
	var validator = new Validator();
	validator.validateSimpleTextField(form.assunto,"Erro no campo: Assunto do contato");validator.validateSimpleTextField(form.nome,"Erro no campo: Nome");validator.validateEmailField(form.email,"Erro no campo: E-mail");validator.validateSimpleTextField(form.email,"Erro no campo: E-mail");validator.validateSimpleTextField(form.mensagem,"Erro no campo: Mensagem");
	if (validator.processLog()) {
		form.sendBtn.disabled = true;
                Abrir();
		return true;
	} else {
		return false;
	}
}
</script>

<script>
function Abrir() {
window.open('' , 'nome' , 'status , scrollbars=no ,width=400, height=350 , top=0 , left=0'); 
}
</script>


<form method="post" action="http://www.linkws.com/proc/superProc.jsp" onSubmit="return validateForm(this);" target="nome">
<input type="hidden" name="actionID" value="18">
<input type="hidden" name="userProductID" value="<? echo $code_linkws;?>">
<script>document.write("<input type=\"hidden\" name=\"__referer_1\" value=\""+document.referrer + "\">");</script>

Formulário de contato, envie sua mensagem para nós, ela será respondida em no máximo 2 dias.<bR><bR>

<table width="500" border="0" cellspacing="5" cellpadding="0" align=center>

<tr> 
	<td width="85" valign="top"> <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Assunto</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="assunto" value="" size="50" maxlength="128" class="fieldStyle"></font></td>
</tr>

<tr> 
	<td valign="top" > <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Seu login</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="Login" value="" size="20" maxlength="20" class="fieldStyle"></font></td>
</tr>

<tr> 
	<td valign="top" > <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Nome</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="nome" value="" size="50" maxlength="128" class="fieldStyle"></font></td>
</tr>

<tr> 
	<td valign="top" > <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>E-mail</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><input name="email" value="" size="50" maxlength="255" class="fieldStyle"></font></td>
</tr>

<tr> 
	<td valign="top" > <font size="1" face="Verdana, Arial, Helvetica, sans-serif"><strong>Mensagem</strong></font> </td>
	<td> </td>
	<td valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><textarea name="mensagem" cols="60" rows="15" class="fieldStyle" onKeyDown="limitTextArea(this, this.form._COUNTER_FIELD_mensagem, 500);" onKeyUp="limitTextArea(this, this.form._COUNTER_FIELD_mensagem, 500);"></textarea><input disabled name="_COUNTER_FIELD_mensagem" size="3" value="500"></font></td>
</tr>

</table>
<p> <br>
<input name="sendBtn" type="submit"  value="Enviar Formulário" style='font: 17px LithosProBold, Arial, sans-serif;
	color: black;width:250px;'>
  </form>
<br>
</div>