<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

<script type="text/javascript">
    function numbers(evt)
    {
        var key_code = evt.keyCode  ? evt.keyCode  :
                       evt.charCode ? evt.charCode :
                       evt.which    ? evt.which    : void 0;


        // Habilita teclas <DEL>, <TAB>, <ENTER>, <ESC> e <BACKSPACE>
        if (key_code == 8  ||  key_code == 9  ||  key_code == 13  ||  key_code == 27  ||  key_code == 46)
        {
            return true;
        }

        // Habilita teclas <HOME>, <END>, mais as quatros setas de navegação (cima, baixo, direta, esquerda)
        else if ((key_code >= 35)  &&  (key_code <= 40))
        {
            return true
        }

        // Habilita números de 0 a 9
        else if ((key_code >= 48)  &&  (key_code <= 57))
        {
            return true
        }

        return false;
    }
</script>

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

<script language="javascript" src="inclu/func_excluir.js" type="text/javascript"></script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> MUDAR SENHA DO BAÚ <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");

$bau_check = mssql_num_rows(mssql_query("SELECT AccountID FROM warehouse WHERE AccountID = '$login'"));
if ($bau_check <= 0) Die ("<br>Você não possui nenhum baú."); 

if ($_GET[remover]) {
$passss = stripslashes($_POST['passs']);

if ((preg_match("[^0-9]", $passss))) 
{ 
die("<font color=$font_color1><b>Somente números por favor!!</b></font><br><br>");  
}
	
$username_check = mssql_num_rows(mssql_query("SELECT AccountID FROM warehouse WHERE AccountID='$login'")); 
$pw_check2 = mssql_num_rows(mssql_query("SELECT pw FROM warehouse WHERE pw='$passss' and AccountID='$login'")); 

if ($username_check <= 0){ 
        echo "<font color=$font_color1><b>Seu Login Não Foi Encontrado No Banco de Dados. Por Favor Volte e Tente Novamente.</b></font><br><br>"; }

elseif ($pw_check2 <= 0){ 
        echo "<font color=$font_color1><b>Senha incorreta.</b></font><br><br>"; }

else {
	
$sql = mssql_query("UPDATE dbo.warehouse
SET pw = ''
WHERE AccountID = '$login'");
echo "<font color=$font_color2><b>A Senha do seu baú foi removida com sucesso</b></font><br><br>";
}
} 

elseif ($_GET[criar]) {
$newpw = stripslashes($_POST['newpw']);

if ((preg_match("[^0-9]", $newpw))) 
{ 
die("<font color=$font_color1><b>Somente números por favor!!</b>");  
}
	
$username_check = mssql_num_rows(mssql_query("SELECT AccountID FROM warehouse WHERE AccountID='$login'")); 

$result = mssql_query("select pw from warehouse WHERE AccountID='$login'");
$row2 = mssql_fetch_row($result);

if (empty($newpw)) {
    echo "<font color=$font_color1><b>Campo em Branco. Por Favor Volte e Tente Novamente.<br><br></b></font>";}

elseif ($username_check <= 0){ 
        echo "<font color=$font_color1><b>Seu Login Não Foi Encontrado No Banco de Dados. Por Favor Volte e Tente Novamente.<br><br></b></font>"; }

elseif   ( strlen($newpw) != 4)   {echo "<font color=$font_color1><b>A senha deve conter 4 dígitos.</font><br><br></b></font>"; }

elseif ($row2[0]>0){ 
        echo "<font color=$font_color1><b>Seu báu já passui senha.<br><br></b></font>"; }

else {	
$sql = mssql_query("UPDATE dbo.warehouse
SET pw = '$newpw'
WHERE AccountID = '$login'");
echo "<font color=$font_color2><b>A Senha do seu baú Foi criada com sucesso.<br><br></b></font>";
}}

if ($_GET[mudar]) {
$newpw = stripslashes($_POST['newpw']);
$oldpw = stripslashes($_POST['oldpw']);

if ((preg_match("[^0-9]", $newpw)) || (preg_match("[^0-9]", $oldpw))) 
{ 
die("<font color=$font_color1><b>Somente números por favor!!</b>"); 
}
	
$username_check = mssql_num_rows(mssql_query("SELECT AccountID FROM warehouse WHERE AccountID='$login'")); 
$pw_check 	= mssql_num_rows(mssql_query("SELECT pw FROM warehouse WHERE pw='$oldpw' and AccountID='$login'")); 

if (empty($newpw) || empty($oldpw)) {
    echo "<font color=$font_color1><b>Campos em Branco. Por Favor Volte e Tente Novamente.</font></b><br><br>";}

elseif ($username_check <= 0){ 
        echo "<font color=$font_color1><b>Seu Login Não Foi Encontrado No Banco de Dados. Por Favor Volte e Tente Novamente.</font></b><br><br>"; }

elseif   ( strlen($newpw) != 4)   {echo "<font color=$font_color1><b>A senha deve conter 4 dígitos.</font></b><br><br>"; }

elseif ($pw_check <= 0){ 
        echo "<font color=$font_color1><b>Senha incorreta.</font></b><br><br>"; }

elseif ($newpw == $oldpw){ 
        echo "<font color=$font_color1><b>As senhas são iguais</font></b><br><br>"; }

else {	
$sql = mssql_query("UPDATE dbo.warehouse
SET pw = '$newpw'
WHERE AccountID = '$login'");
echo "<font color=$font_color2><b>A Senha do seu baú Foi alterada com sucesso.</font></b><br><br>";
}
}

$result2 = mssql_query("select pw from warehouse WHERE AccountID='$login'");
$row = mssql_fetch_row($result2);

if ($_GET[recuperar]) {

$query	= mssql_query     ("Select LOWER(mail_addr) FROM MEMB_INFO WHERE memb___id='$login'");
$row2	= mssql_fetch_row ( $query );

	if ($CONFIG_MAIL_ATIVAR == 1)
		{

                // Envia o E-Mail
        	include("../inclu/mail/class.phpmailer.php");

		$mail = new PHPMailer(true);
		$mail->IsSMTP(); // Define que a mensagem será SMTP

		try {
     			$mail->Host 		= $CONFIG_MAIL_HOST; 	// Endereço do servidor SMTP (Autenticação, utilize o host smtp.seudomínio.com.br)
     			$mail->SMTPAuth   	= true;  		// Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
     			$mail->Port       	= $CONFIG_MAIL_PORTA; 	// Usar 587 porta SMTP
     			$mail->Username 	= $CONFIG_MAIL_LOGIN; 	// Usuário do servidor SMTP (endereço de email)
     			$mail->Password 	= $CONFIG_MAIL_SENHA; 	// Senha do servidor SMTP (senha do email usado)
 
     			//Define o remetente
			$mail->SetFrom($CONFIG_MAIL_REMET, $CONFIG_NOME_MU);    //Seu e-mail
     			$mail->AddReplyTo($CONFIG_MAIL_REMET, $CONFIG_NOME_MU); //Seu e-mail
     			$mail->Subject = "$CONFIG_NOME_MU - Senha Bau";//Assunto do e-mail
 
     			//Define os destinatário(s)
     			$mail->AddAddress($row2[0], 'Cliente');
 
     			//Define o corpo do email
     			$mail->MsgHTML("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'> <center>Senha do Báu: $row[0] <br><Br>Acesse: $CONFIG_SITE"); 

     			$mail->Send();
     			echo "<center><font size=2 color=$font_color2><b>A senha foi enviada para o seu e-mail de cadastro!<br>Pode demorar alguns minutos para chegar em sua caixa de entrada.<br>Verifique a pasta lixo eletronico(Spam) do seu e-mail.<BR><br></font></b>";
 
    		   } catch (phpmailerException $e) {
      			//echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
      			echo "<center><br><font size=2 color=$font_color1><b>Sua senha não pode ser enviada<BR><br></font></b>";
		   }

                
	} else { echo "<center><br><br><font size=3 color=$font_color1><b>Sistema de e-mail desativado.<br><br>";   }

}

if (!$row[0]) {
echo "<form name='form1' method='post' action='?criar=ok'>";
echo "<table width='300' border='0' cellspacing='0' cellpadding='0'>
           <tr>
              <td align=right>
                Criar senha:</font>
              </td>
              <td><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>
                  <center><input class=input03 name='newpw' type='password' id='newpw' maxlength='4' onkeypress=\"javascript: return numbers(event);\"></td>
       	      </tr>
           <tr> 
              <td>
              </td>
              <td><center><BR><input type='submit' name='Submit' value='Criar Senha' class=imput>
              </td>
            </tr>
          </table>
      </form>
<center><br><Br>Você pode criar uma senha para proteger seu báu,<br> somente digitando essa senha será possível tirar os itens do baú.<br>
<center><br><b>A senha deve conter 4 digitos númericos.</b><br>Exemplo: 1234
";

} else {
echo "<b>Mudar Senha do Baú</b>";
echo "<form name='form1' method='post' action='?mudar=ok'>";
echo "<table width='350' border='0' cellspacing='0' cellpadding='0'>
           <tr>
              <td height='30'>
                <center>Senha Antiga:</font>
              </td>
              <td><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>
                  <center><input name='oldpw' type='password' id='oldpw' maxlength='4' onkeypress=\"javascript: return numbers(event);\"></td>
       	      </tr>
           <tr>
              <td height='18'>
                <center>Nova Senha:</font>
              </td>
              <td><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>
                  <center><input name='newpw' type='password' id='newpw' maxlength='4' onkeypress=\"javascript: return numbers(event);\"></td>
 <tr>
             <td colspan=2 height='30'><bR><center><input type='image' src='img/BT_salvar.png' name='Submit' value='Mudar Senha' style='border:0;background:transparent;'>
              </td>
       	      </tr>
          </table>
      </form>";
echo "_______________________________________________";
echo "<br><br><b>Remover Senha do Baú</b>";
echo "<form name='form2' method='post' action='?remover=ok'>";
echo "<table width='350 border='0' cellspacing='0' cellpadding='0'>
           <tr>
              <td height='30'>
                <center>Senha:</font>
              </td>
              <td><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>
                  <center><input class=input03 name='passs' type='password' id='passs' maxlength='4' onkeypress=\"javascript: return numbers(event);\"></td>
 <tr>
             <td colspan=2><br><center><input type='image' src='img/BT_remover.png' name='Submit' value='Remover Senha' style='border:0;background:transparent;'>
              </td></tr>
          </table>
      </form>
";

echo "<br><br><b><a href=\"javascript:confirmaExclusao('?recuperar=ok','Deseja realmente recuperar a senha do baú? A senha será enviada para seu e-mail de cadastro!')\">Esqueceu sua senha do baú? Clique aqui para recuperar!</a>";


} 

?>
