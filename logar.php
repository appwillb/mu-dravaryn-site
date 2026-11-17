<?php

$NO_TITLE = 1;
require("inclu/config_simples.php");

if ($_GET['logar']) 
{
}
elseif ($_GET['deslogar'])
{	
	setcookie("usuario", "");
	setcookie("senha", "");

echo "
<script>
top.location.href = 'site.php';
</script>
";

Die();
}
else
{
	setcookie("usuario", "");
	setcookie("senha", "");	
}

if (isset($_COOKIE['usuario']) && isset($_COOKIE['senha']) and !$_GET[deslogar]) 
{

echo "<meta http-equiv='refresh' content='3; url=site.php'>
     
<center><Br><Br><br><bR><br><bR><br><bR><br><bR><br><bR><br><bR><br><bR><font color=white size=3>Redirecionando...
<br><bR><a href='site.php'><font color=white size=3>Clique aqui para continuar.</a></p>
  <p>&nbsp;</p>
  <p><font color=white size=2>MU Dravaryn - www.jogandoMu.com.br</a></p>
";

} 



else {
	
$table = "<table width=1000><tr><td width=400><center>
<br><br><br><br><br><br><br><br><br><br>
		<table border=0 cellspacing=5 cellpadding=0 background=img/Borders.png width='413' height='300'>
		<tr><td width='250' align='center' height=60>
		
                </td></tr><tr><td valign=top height=130>	<center>		
		<form name='form1' method='post' action=''>
<font size=3 color=white>Acesso ao Painel:
          <table width='250' border='0' cellspacing='5' cellpadding='0' align='center'>
            <tr> 
              <td width='60' height=22 align=right></td>
              <td></td></tr>

            <tr>
            <tr> 
              <td width='60' height=22 align=right><font color=white><b>Login:&nbsp;&nbsp;</td>
              <td><input name='login' type='text' id='login' maxLength=10></td></tr>

            <tr>
              <td align=right height=22><font color=white><b>Senha:&nbsp;&nbsp;</td>
              <td><input name='oldpwd' type='password' id='oldpwd' maxLength=10></td>
            </tr>

            </tr>
            <tr> 
              <td colspan=2><br><center><input type='submit' name='Submit' value='Continuar'></td>
            </tr>
          </table>
        </form>

</td></tr><tr><td valign=top><center><br><Br>
<a href='recuperar_senha.php'><font color=white><b>Recuperar senha?</a> 
</td></tr>
</table>

";


$mid = $_POST['login'];
$mpw = $_POST['oldpwd'];

$ip2 = $_SERVER["REMOTE_ADDR"];
$ip3 = gethostbyaddr($ip2);

if ( empty($mid) || empty($mpw)) 
{	
	$erro_msg = ""; 
	$erro=1;
}
else 
{
$sql_pw_check 	= mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb___id='$mid' and memb__pwd='$mpw'"); 
$pw_check 	= mssql_num_rows($sql_pw_check);

$querym = "Select bloc_code,mail_chek,memb___id From memb_info WHERE memb___id='$mid'";
$resultm = mssql_query( $querym );
$mm = mssql_fetch_row($resultm);

	if ($pw_check <= 0) {
		$erro=1;
		mssql_query("INSERT INTO LOG_acesso_n ( login,senha,ip ) values ('$mid','$mpw','$ip2')");
		$erro_msg = "<br><font color=white size=3><b>Senha ou usu&#225;rio incorreto!<font color=white><td>&nbsp;</td></table>";
	}
	elseif ($mm[1] == 2)
	{ 
		$erro=1;
		$erro_msg = "<br><font color=white size=3><b>Sua conta ainda n&#227;o foi ativada!!!<br><br>Caso n&#227;o tenha recebido o e-mail de ativa&#231;&#227;o clique no link abaixo:<br><br><a href='painel/reenviar.php?log=$mid'><font color=white size=3><b><u>Reenviar link de ativa&#231;&#227;o para o E-mail de cadastro?</a><td>&nbsp;</td></table>"; 
	}
	else 
	{
		$msquery = "INSERT INTO LOG_painel ( login,ip,host ) values ('$mid','$ip2','$ip3')";
		$msresults= mssql_query($msquery);
		setcookie("usuario", "$mm[2]"); 
		setcookie("senha", "$mpw");
	}
}

echo "<title>Logar - MU Dravaryn</title>
<meta http-equiv='Content-Type' content='text/html;charset=iso-8859-1'>
<style type='text/css'>
	body {background-image:url('img/bg2016.jpg'); background-repeat:no-repeat; background-position:top center; background-attachment:fixed }

	body,tr			{ font-family: arial, helvetica; color: black; font-size: 12px; }

	A:link			{ text-decoration: none; color: black; }
	A:visited		{ text-decoration: none; color: black; }
	A:hover			{ text-decoration: underline;}

input {
background-color : #363636;
color : #cccccc;
border : 1px solid #363636;
cursor : pointer;
font-size:16px;
}
input.submit-form {
background-color : #2d190f;
color : #cccccc;
border : 1px solid #46291a;
cursor : pointer;
font-size:16px;
}
input.submit-form:hover {
background-color : #46291a;
color : #cccccc;
border : 1px solid #2d190f;
cursor : pointer;
}
input.text-form {
background-color : #2d190f;
color : #cccccc;
border : 1px solid #46291a;
cursor : pointer;
}
input.text-form:hover {
background-color : #46291a;
color : #cccccc;
border : 1px solid #2d190f;
cursor : pointer;
}
select {
border : 1px solid #46291a;
color : #cccccc;
background-color : #2d190f;
font-size:16px;
}
textarea {
border : 1px solid #46291a;
font-family : Tahoma,Verdana,Geneva,sans-serif;
font-size : 11px;
color : #cccccc;
background-color : #2d190f;
cursor : pointer;
margin : 2px; 
padding : 1px;
}
</style>
<body leftmargin='0' topmargin='0' bottommargin='0' bgcolor=black>
<table width=530 border=0 align=center><tr><td width=250 align=left>

";

	if ($erro==1)
	{
		echo $table;
		echo $erro_msg;
	}
	else
	{
		
echo '

<title>Logando...</title>

<meta http-equiv="refresh" content="3; url=site.php">

	<p style="height : 260px;">
		<center>
		  <table width="800">
			<tr>
 			  	<td width=0></td><td height="200" width="400" style="border-radius: 10px;padding-top:10px;background-color:rgba(25,28,35,0.7);">
					<center><font size=3 color=white>Redirecionando...
					<br><bR><br><a href="site.php"><font color=white size=3><u>Clique aqui para continuar</u></a>
 					<br><br><br><font size=2 color=white>MU Dravaryn - www.jogandoMu.com.br </td>
				<td>&nbsp;</td>
		        </tr>
                  </table>
	</p>';

 }
}

?>