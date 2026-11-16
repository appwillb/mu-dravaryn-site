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

<center><bR><BR><font size=3><b> MUDAR E-MAIL <bR><BR>


<?php 

$random = (rand()%9999); 
require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET[cancelar]){ $query = mssql_query("Delete from mk_mudar_mail where login='$login'"); echo "<script language='Javascript'>alert('Troca de e-mail cancelada!')</script>"; }

$mailcheck= mssql_num_rows(mssql_query("Select login FROM mk_mudar_mail WHERE login='$login'"));

if($mailcheck > 0) die("

<font color=green size=4></b>Parabéns seu e-mail já está sendo atualizado.</b></font><br><br>

Você já solicitou a mudança do seu e-mail, aguarde 72 horas ou clique abaixo para cancelar a troca de e-mail.

<br><br>

Se você mudar a senha da sua conta, a atualização do e-mail de cadastro será automaticamente cancelada.

<br><br>


<font size=4 color=$font_color1><a href=?cancelar=ok>Cancelar Mudança</a></font>

"); 

?>

<center>
O E-mail de cadastro será alterado após 72 horas(3 dias).</font>

<br><br><font color=$font_color1>Se você mudar a senha da sua conta nesse período a mudança de e-mail será cancelada automaticamente.</font>

<br><bR>
		
		<form name='form1' method='post' action='mudar_mail.php'>

<table width='400' border='0' cellspacing='0' cellpadding='0'>
  <thead>
	<tr>	
		<th colspan=3>Preencha o formulário</th>
	</tr>
  </thead>

            <tr> 
              <td height=22 align=right><b>Novo E-mail:</td>
              <td><input name='mail' type='text' id='mail' maxLength=50>
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
              <td colspan=2><br><center><input type='submit' name='Submit' value='Mudar E-mail'></td>
            </tr>
          </table>
        </form>

<?

$mail      = strtolower(stripslashes($_POST['mail']));
$extcode   = stripslashes($_POST['extcode']);
$extcode1  = stripslashes($_POST['extcode1']);
$recupera  = stripslashes($_POST['recupera']);



if ($recupera) {

$query     = mssql_query     ("Select LOWER(mail_addr) FROM MEMB_INFO WHERE memb___id='$login'");
$row       = mssql_fetch_row ( $query );
$mail_check= mssql_num_rows  ( $query );

$check_mail= mssql_query     ("Select login from mk_mudar_mail where login='$login'");
$mail_check2= mssql_num_rows  ( $check_mail );

$check_mail2= mssql_query     ("Select memb___id from memb_info where memb___id='$login' and mail_addr='$mail'");
$mail_check3= mssql_num_rows  ( $check_mail2 );

if       (empty($login) or empty($mail))       { echo "<center><br><font color=$font_color1><b>Campos em branco </font></b><br><BR>"; }
else if  ($extcode != $extcode1) 	       { echo "<center><br><font color=$font_color1><b>Você digitou o codigo errado.<br><br>";   }
else if  ($mail_check3 > 0) 	               { echo "<center><br><font color=$font_color1><b>O e-mail de cadastro já é esse.<br><br>";   }
else if  ($mail_check <= 0) 	               { echo "<center><br><font color=$font_color1><b>Seu login ou e-mail de cadastro está incorreto.<br><br>";   }
else if  ($mail_check2 > 0) 	               { echo "<center><br><font color=$font_color1><b>Você já solicitou a mudança do seu e-mail, aguarde 72 horas ou clique no painel em cancelar mundança de e-mail.<br><br>";   }
else {


	if ($CONFIG_MAIL_ATIVAR == 1)
		{
                // Envia o E-Mail
        	include("../inclu/mail/class.send.php");

                $contato = new SendEmail;

		$contato->configHost 	 = $CONFIG_MAIL_HOST; 	// Endereço do seu SMTP
        	$contato->configPort 	 = $CONFIG_MAIL_PORTA; 	// Porta usada pelo seu servidor. Padrão 25
        	$contato->configUsuario  = $CONFIG_MAIL_LOGIN; 	// Login do email que ira utilizar
        	$contato->configSenha 	 = $CONFIG_MAIL_SENHA; 	// Senha do email
        	$contato->remetenteEmail = $CONFIG_MAIL_REMET; 	// E-mail que vai ser exibido no remetente da mensagem

                $contato->paraEmail 	= "$row[0]"; // Email que vai receber a mensagem
                $contato->assuntoEmail 	= "JogandoMU - Solicitada Troca de E-mail"; // Assunto da mensagem
                $contato->conteudoEmail = "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><center>Foi solicitada a troca do seu e-mail de cadastro, se não solicitou a troca entre no seu painel de controle para cancelar.<br><Br>Acesse www.jogandomu.com.br";// Conteudo da mensagem se voce quer enviar a mensagem em HTML so colocar o body ai dentro e montar seu style que ele aceita normal.
                $contato->confirmacao 	= 0; // Se for 1 exibi a mensagem de confirmação
                $contato->mensagem 	= "<center><b>A senha foi enviada para o seu e-mail de cadastro!<br>Pode demorar alguns minutos para chegar em sua caixa de entrada.<br>Verifique a paste lixo eletronico do seu e-mail também.<BR><br>"; // Mensagem de Confirmação          
                $contato->erroMsg 	= "Sua senha não pode ser enviada";// pode colocar uma mensagem de erro aqui!!
                $contato->confirmacaoErro = 0;// Se voce colocar 1 ele exibi o erro que ocorreu no erro se for 0 não exibi o erro uso geralmente para verificar se ta pegando.
                $contato-> enviar(); 	// envia a mensagem
		} else { echo "<center><br><br><font size=3 color=$font_color1><b>Sistema de e-mail desativado.<br><br>";   }

$data_now = date('m-j-y G:i:s');
$ip = $_SERVER["REMOTE_ADDR"]; 

$msquery = "INSERT INTO mk_mudar_mail ( login,antigo,novo,dias,ip ) values ('$login','$row[0]','$mail','3','$ip' )";
$msresults= mssql_query($msquery);

$msresults= mssql_query("INSERT INTO LOG_mail ( login,antigo,novo,ip ) values ('$login','$row[0]','$mail','$ip')");


echo "<meta http-equiv='refresh' content='0; url=mudar_mail.php'>";
}
}

?>
</div>