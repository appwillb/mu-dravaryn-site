<title>JogandoMu</title>
<style type="text/css">
	body,tr			{ font-family: arial, helvetica; color: black; font-size: 11px; }

	A:link			{ text-decoration: none; color: black; }
	A:visited		{ text-decoration: none; color: black; }
	A:hover			{ text-decoration: underline; color: black;}



	A:link    IMG 	{border:0px; border-thickness: 2px; border-color: #325784; border-style: solid;}
	A:active  IMG 	{border:0px; border-thickness: 2px; border-color: #325784; border-style: solid;}
	A:visited IMG 	{border:0px; border-thickness: 2px; border-color: #325784; border-style: solid;}
	A:hover   IMG 	{border:0px; border-thickness: 2px; border-color: white; border-style: solid;}

</style>
<body style="background-color: transparent">
<center>

<br>
<div align="center">
  <table width="400" border="0" cellspacing="2" cellpadding="3" bordercolor=#333333>
    <tr>
      <td><font size="4"><center>Reenviar E-mail de ativação <br><br><hr></td>
    </tr>
<tr><td>
<center>
Não se esqueça que o e-mail pode estar na pasta lixo eletronico (spam) da sua caixa de e-mails.
<?PHP
require("../inclu/config_simples.php");

if($_GET[log]){

$login  = $_GET[log];

$nome_check   = mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login'"));
$ativado_check= mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login' and mail_chek=1"));
$codigo_check = mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login' and code='$codigo'"));

if     ( $nome_check   <= 0   ) {echo "<center><font size=3><b><br><br>Esse login não existe em nosso banco de dados.</font><bR><br>";}
elseif ( $ativado_check   > 0 ) {echo "<center><font size=3><b><br><br>Essa conta já foi ativada.</font><bR><br>";}
elseif ( empty($login)        ) {echo "<center><font size=3><b><br><br>Campos em branco.</font><bR><br>";}

else {

if ($_POST) {

$mm = mssql_fetch_row(mssql_query("Select mail_addr,memb_name,code From memb_info WHERE memb___id='$login'"));

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
     			$mail->Subject = "$CONFIG_NOME_MU - Ativar Cadastro";//Assunto do e-mail
 
     			//Define os destinatário(s)
     			$mail->AddAddress($mm[0], 'Cliente');
 
     			//Define o corpo do email
     			$mail->MsgHTML("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'> <center>Parabéns sua conta foi criada com sucesso, você pode entrar em nossos servidores agora.<br>Mais primeiro você precisa ativar sua conta clicando no link abaixo:<br><bR><a href='". CLASSTPATH ."ativar_conta.php?login=$login&codigo=$mm[2]'>Ativar agora!!</a> <br><Br>Seu e-mail pode não permitir acesso ao link, então apenas copie e cole o endereço abaixo em seu navegador:<br><br>". CLASSTPATH ."ativar_conta.php?login=$login&codigo=$mm[2] <br><Br><b>Conta:</b> $login<br><br><b>Acesse:</b><Br> $CONFIG_SITE<br>"); 

     			$mail->Send();
     			echo "<br><BR><br><font size=3><b>Foi reenviado um e-mail para <br><font color=red>$mm[0]</font><br> para ativar sua conta!<br>Você deve clicar no link do e-mail para ativa-la.<br>Você tem 48 horas para ativar.<br><br>Verifique sempre a pasta lixo eletronico do seu webmail.<br><br><font color=green>Quando Ativar sua conta você ganha automaticamente 15 dias VIP.<bR>BOM JOGO!!!";
 
    		   } catch (phpmailerException $e) {
      			//echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
      			echo "<br><bR><font color=red>Seu e-mail de confirmação não pode ser enviado, entre em contato com a administrador do site.";
		   }

                
	} else { echo "<center><br><br><font size=3 color=$font_color1><b>Sistema de e-mail desativado.<br><br>";   }

}
else { 
Echo "<br><br><br><form method=post><input type='submit' name='ok' value='Reenviar E-mail'></form>";
}
}
}

?>
