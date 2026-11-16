<head>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

<title>JogandoMu - Cadastro</title>

<style type="text/css">
		body { background: transparent !important; }
	body,tr			{ font-family: arial, helvetica; color: black; font-size: 12px; }

	A:link			{ text-decoration: none; color: black; }
	A:visited		{ text-decoration: none; color: black; }
	A:hover			{ text-decoration: underline; color: green;}

	A:link    IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:active  IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:visited IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:hover   IMG 	{border:1px; border-thickness: 2px; border-color: green; border-style: solid;}


.alert
{
width:600px !important; 
}

</style>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>



        <script type="text/javascript" src="inclu/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height(650);
		window.parent.parent.scrollTo(0,450)
		}
        </script>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>

<BR><BR><font size=4><b>CADASTRAR CONTA</font></b> <BR><BR>

<?php
include("inclu/config_simples.php");

$ps_loginname 	= stripslashes($_POST['ps_loginname']);
$ps_name 	= stripslashes($_POST['ps_name']);
$ps_email 	= strtolower(stripslashes($_POST['ps_email']));
$ps_email2 	= strtolower(stripslashes($_POST['ps_email2']));
$ps_person_id 	= stripslashes($_POST['ps_person_id']);
$ps_password 	= stripslashes($_POST['ps_password']);
$ps_repassword 	= stripslashes($_POST['ps_repassword']);
$extcode 	= stripslashes($_POST['extcode']);
$extcode1 	= stripslashes($_POST['extcode1']);
$email_check 	= mssql_num_rows(mssql_query("SELECT mail_addr FROM MEMB_INFO WHERE LOWER(mail_addr)=LOWER('$ps_email')")); 
$username_check = mssql_num_rows(mssql_query("SELECT memb___id FROM MEMB_INFO WHERE LOWER(memb___id)=LOWER('$ps_loginname')"));
$ip 		= $_SERVER["REMOTE_ADDR"];
$ps_name 	= utf8_encode($ps_name);


$count = substr_count($ps_loginname," ");

    if( preg_match('/^([\w\.-]+)+@+([\w\.-]+)+\.+[a-z]{2,3}$/',$ps_email) ){ 
        $mailok=1;
    } 
	else { $mailok=0; }

if (empty($ps_loginname) || empty($ps_name) || empty($ps_email)|| empty($ps_password) || empty($ps_repassword) || empty($extcode) || empty($extcode1)) {
    echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> Campos em branco! </div>"; 
 $Error=1;
}
elseif (($email_check > 0) || ($username_check > 0)){ 

 
    if($email_check > 0){ 
        echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> O E-mail que você colocou já esta em uso por outro membro em nosso banco de dados.<br> Por favor coloque um e-mail diferente </div>"; 
        $Error=1;
    } 
    if($count > 0){ 
        echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> Você não pode colocar espaço no seu login!! </div>"; 
        $Error=1;
    } 
    if ($username_check > 0){ 
        echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> O Login que você escolheu ja esta em uso. Por favor escolha outro! </div>"; 
         $Error=1;
    } 
    if ( $mailok == 0){ 
        echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> Coloque um e-mail válido! </div>"; 
         $Error=1;
    } 
    if ($ps_email <> $ps_email2){ 
        echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> E-mail diferente do e-mail de confirmação! </div>"; 
         $Error=1;
    } 
    }

elseif ($ps_password != $ps_repassword) {
	echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> Senha diferente da senha de confirmação. </div>";
        $Error=1;
}
elseif ($extcode != $extcode1) {
	echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong> Você digitou o código errado. </div>"; 
        $Error=1;
}

if ($Error!=1)
{

	$codigoo	= $random = (rand()%9999);
	$ip3 		= gethostbyaddr($ip);
	$nav 		= $_SERVER['HTTP_USER_AGENT'];
	$ativa_acc 	= ($CONFIG_MAIL_ATIVAR == 1) ? 2 : 1;

	mssql_query("INSERT INTO LOG_cadastros ( login,ip,host,navegador ) values ('$ps_loginname','$ip','$ip3','$nav')"); 
	mssql_query("INSERT INTO MEMB_INFO (memb___id,memb__pwd,memb_name,mail_addr,appl_days,mail_chek,bloc_code,ctl1_code,code,ip_cadastro) VALUES ('$ps_loginname','$ps_password','$ps_name','$ps_email',(getdate()),'$ativa_acc','0','1','$codigoo','$ip')");
	mssql_query("INSERT INTO MEMB_STAT (memb___id,ConnectStat,ServerName,IP,ConnectTM,DisConnectTM)  VALUES ('$ps_loginname','0','nenhum','$ip',(getdate()),(getdate()) )");

	echo "<div class='alert alert-success bs-alert-old-docs'> <strong> Conta criada com sucesso: </strong> Seu login é $ps_loginname</div>";


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
     			$mail->Subject = "$CONFIG_NOME_MU - Cadastro";//Assunto do e-mail
 
     			//Define os destinatário(s)
     			$mail->AddAddress($ps_email, 'Cliente');
 
     			//Define o corpo do email
     			$mail->MsgHTML("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'> <center>Parabéns sua conta foi criada com sucesso, você pode entrar em nossos servidores agora.<br>Mais primeiro você precisa ativar sua conta clicando no link abaixo:<br><bR><a href='". CLASSTPATH ."ativar_conta.php?login=$ps_loginname&codigo=$codigoo'>Ativar agora!!</a> <br><Br>Seu e-mail pode não permitir acesso ao link, então apenas copie e cole o endereço abaixo em seu navegador:<br><br>". CLASSTPATH ."ativar_conta.php?login=$ps_loginname&codigo=$codigoo <br><Br><b>Conta:</b> $ps_loginname <br><Br><b>Senha:</b> $ps_password <br><br>Acesse $CONFIG_SITE<br>"); 

     			$mail->Send();
     			echo "<div class='alert alert-success bs-alert-old-docs'> <strong> E-mail enviado: </strong> Em instantes você receberá um e-mail para confirmar sua conta!<br>Você deve clicar no link do e-mail para ativa-la.<br>Você tem 48 horas para ativar.</div> <div class='alert alert-danger bs-alert-old-docs'> <strong> Cuidado: </strong> Verifique sempre a pasta lixo eletronico do seu webmail.</div> <div class='alert alert-success bs-alert-old-docs'> <strong> Bonus: </strong>Quando Ativar sua conta você ganha automaticamente 15 dias VIP.</div><bR><br>BOM JOGO!!!";
 
    		   } catch (phpmailerException $e) {
      			echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
      			echo "<div class='alert alert-danger bs-alert-old-docs'> <strong> Erro: </strong>Seu e-mail de confirmação não pode ser enviado, entre em contato com a administrador do site.</div>";
		   }
		}


}
?>

</div>