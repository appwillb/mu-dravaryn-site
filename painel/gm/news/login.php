<?php
session_start(); // Inicia ou continua uma sesao.
ob_start();

include("../../../inclu/config.php"); // Arquivo de configuração do Sistema;

// Valida o login do Administrador.
if ((@$_REQUEST['login_news'] == $loginAdmin) && (@$_REQUEST['senha_news'] == $senhaAdmin)) {
	$_SESSION['logado'] = true;	
	Header("Location: admin.php");
}
else {
	@$_SESSION['logado'] = false;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>:: Login - WAM Sistema de Not&iacute;cias ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<head>
  <link type='text/css' rel='stylesheet' href='../../css/paginas.css'>

        <script type='text/javascript' src='../../../js/jquery-1.3.2.min.js'></script>

	<script type='text/javascript'>
		$('#main2', window.parent.document).height(1300);
        function tamanho(){
		$('#main2', window.parent.document).height($('#tamanho').height() + 40);
	    }
        </script>
</head>
<body leftmargin='0' topmargin='0' onload='tamanho()'>

<center>
<div id='tamanho'>
<br><Br><font size=3><b>GERENCIAR NEWS</font></b><br><br>

<body>
<div align="center"></div>
<div align="center">
  <form name="form1" method="post" action="login.php">
    <table width="240" border="0">
      <tr>
        <td width="86"><div align="left"><strong>Login:</strong></div></td>
        <td width="144"><div align="left">
          <input name="login_news" type="text" id="login_news">
        </div></td>
      </tr>
      <tr>
        <td><div align="left"><strong>Senha:</strong></div></td>
        <td><div align="left">
          <input name="senha_news" type="password" id="senha_news">
        </div></td>
      </tr>
      <tr>
        <td><div align="left"></div></td>
        <td><div align="left">
          <input type="submit" name="Submit" value="Entrar">
        </div></td>
      </tr>
    </table>
  </form>
  <p><strong>:: Painel de Login :: </strong></p>
  <p>Desenvolvido por &Aacute;lvaro Magnum<br>
  <a href="mailto:magnum@wamwebmedia.com.br%20">magnum@wamwebmedia.com.br</a></p>
</div>
</body>
</html>
