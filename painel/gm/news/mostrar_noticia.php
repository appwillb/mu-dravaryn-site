<?php 
include("funcoes.php");
@$id = $_REQUEST['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>:: Not&iacute;cia ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
body {
	background-color: #FFFFFF;
}
a {
	font-size: 10px;
	color: #000000;
	font-weight: bold;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #000000;
}
a:hover {
	text-decoration: underline;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #000000;
}
-->
</style></head>

<body>
<?php mostraNoticiaId($id) ?>
<p align="center"><a href="javascript:history.back()">Voltar</a></p>
<p align="center"><strong>:: WAM Sistema de Not&iacute;cias :: </strong></p>
<p align="center">Desenvolvido por &Aacute;lvaro Magnum<br>
    <a href="mailto:magnum@wamwebmedia.com.br%20">magnum@wamwebmedia.com.br</a></p>
</body>
</html>
