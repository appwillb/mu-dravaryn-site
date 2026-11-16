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

<BR><BR><font size=4><b>RECUPERAR SENHA</font></b> <BR><BR>

<?php $random = (rand()%9999); ?>

A senha será enviada somente ao e-mail de cadastro, não devolveremos senhas por outros meios.</font>

<br><br>Quando o e-mail for enviado verifique a pasta Lixo eletrônico da sua caixa de e-mail.</font>

<br><bR>
			
		<form name='form1' method='post' action=''>
          <table width='400' border='0' cellspacing='0' cellpadding='0'>

  <thead>
	<tr>	
		<th colspan=3>Preencha o formulário</th>
	</tr>
  </thead>

              <td height=22 align=right><b>E-mail de cadastro:</td>
              <td><input name='email' type='text' id='email' maxLength=50>
              <input type='hidden' name='recupera' id='recupera' value='ok'></td></tr>
            </tr>
            <TR> 
              <TD align=right><b>Código</TD>
              <TD>
		<input type="hidden" name="extcode" id="extcode" value="<?PHP print("$random"); ?>">
                <?PHP print("$random"); ?></TD>
            </TR>
            <TR > 
              <TD align=right><b>Código</TD>
              <TD> <input size="10" name="extcode1" id="extcode1" style="width:50 "> Coloque o código acima.</TD>
            </TR>
            <tr> 
              <td colspan=2><br><center><input type='submit' name='Submit' value='Recuperar Senha' style='font: 17px LithosProBold, Arial, sans-serif;
	color: black;'></td>
            </tr>
          </table>
        </form>

<?

include("inclu/config_simples.php");

$login     = stripslashes($_POST['login']);
$email      = stripslashes($_POST['email']);
$extcode   = stripslashes($_POST['extcode']);
$extcode1  = stripslashes($_POST['extcode1']);
$recupera  = stripslashes($_POST['recupera']);


if ($recupera) {

$query     	= mssql_query     ("Select LOWER(mail_addr),memb__pwd,memb___id FROM MEMB_INFO WHERE LOWER(mail_addr)=LOWER('$email')");
$mail_check	= mssql_num_rows  ( $query );

$lista_senha 	= "";
$ip2 		= $_SERVER["REMOTE_ADDR"];

if       (empty($email)) 	 { echo "<center><br><font size=3 color=$font_color1><b>Campos em branco </font><br><BR>"; }
else if  ($extcode != $extcode1) { echo "<center><br><font size=3 color=$font_color1><b>Você digitou o codigo errado.<br><br>";   }
else if  ($mail_check <= 0) 	 { echo "<center><br><font size=3 color=$font_color1><b>Não tem nenhuma conta com esse e-mail cadastrada em nosso sistema.<br><br>";   }
else {

	for ($i=1; $i<= $mail_check; $i++) 
	{
		$row       	= mssql_fetch_row ( $query );
		$lista_senha 	.= "<b>Login:</b> $row[2] <br><b>Senha:</b> $row[1]<br><br>";

		mssql_query("INSERT INTO LOG_senha_r ( login,mail,ip ) values ('$row[2]','$row[0]','$ip2')");
	}	

	if ($CONFIG_MAIL_ATIVAR == 1)
		{

                // Envia o E-Mail
        	include("inclu/mail/class.phpmailer.php");

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
     			$mail->Subject = "$CONFIG_NOME_MU - Recuperar Senha";//Assunto do e-mail
 
     			//Define os destinatário(s)
     			$mail->AddAddress($email, 'Cliente');
 
     			//Define o corpo do email
     			$mail->MsgHTML("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'> <center><b>Login para acesso:</b><BR><BR> $lista_senha <br><Br>Acesse: $CONFIG_SITE"); 

     			$mail->Send();
     			echo "<center><br><font size=3 color=$font_color2>A senha foi enviada para o seu e-mail de cadastro!<br>Pode demorar alguns minutos para chegar em sua caixa de entrada.</font><br><br><font color=red size=3>Verifique a pasta lixo eletronico(Spam) do seu e-mail.<BR><br></font>";
 
    		   } catch (phpmailerException $e) {
      			//echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
      			echo "<center><br><font size=3 color=$font_color1><b>Sua senha não pode ser enviada";
		   }

                
	} else { echo "<center><br><br><font size=3 color=$font_color1><b>Sistema de e-mail desativado.<br><br>";   }

}
}

?>
</div>