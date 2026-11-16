<head>
  <link type="text/css" rel="stylesheet" href="../../css/paginas.css">

        <script type="text/javascript" src="../../../js/jquery-1.3.2.min.js"></script>

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

<br><Br><font size=3><b>GERENCIAR NEWS</font></b><br><br>

<?
require("../../inclu/config.php");
require("../../inclu/cookie.php");

$NIVEL_ACESSO = 4;

$GM = mssql_fetch_row(mssql_query("Select top 1 Name From Character where nivel_gm>0 and AccountID='$login' order by nivel_gm desc"));
$GM = $GM[0];


require("../../inclu/verif_nivel_gm.php");

?>

<title>:: Administra&ccedil;&atilde;o - WAM Sistema de Not&iacute;cias ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<script language = "JavaScript">
function cadastrarNoticia() {
	document.formulario.cadastrar.value = 1;
}
function mostraNoticias() {
	document.formulario.mostrar.value = 1;
}
</script>

</head>

<body>
<div align="center">
  <form action="admin.php" method="post" enctype="multipart/form-data" name="formulario" id="formulario">
    <table width="300" border="0" cellspacing=5>
      <tr style="background:transparent;">
        <td width="72"><div align="left"><strong>T&iacute;tulo:</strong></div></td>
        <td width="218"><div align="left">
          <input name="titulo" type="text" id="titulo" style="width:500px" size="60">
        </div></td>
      </tr>
      <tr style="background:transparent;">
        <td valign="top"><div align="left"><strong>Not&iacute;cia:</strong></div></td>
        <td><div align="left">
          <textarea name="noticia" rows="20" cols="90" id="noticia"></textarea>
</div></td>
      </tr>
      <tr style="background:transparent;">
        <td><div align="left"><strong>Por:</strong></div></td>
        <td> <input type='hidden' name='user' value='<? echo $GM;?>'><div align="left">
        <? echo $GM;?></div></td>
      </tr>
      <tr style="background:transparent;">
        <td><div align="left"><strong>Destaque:</strong></div></td>
        <td><div align="left"><select name='server' id='server'>
             <option value="0">NÃO</option>
             <option value="1">SIM</option>
        </select>
        &nbsp;</div></td>
      </tr>
      <tr style="background:transparent;">
        <td><div align="left"><strong>Tipo:</strong></div></td>
        <td><div align="left"><select name='tipo' id='tipo'>
             <option value="1">NOTÍCIA</option>
             <option value="2">EVENTO</option>
        </select>
        &nbsp;</div></td>
      </tr>
      <tr style="background:transparent;">
        <td><div align="left"></div></td>
        <td><div align="left">
          <input name="cadastrar" type="hidden" id="cadastrar" value="0">          
          <input name="mostrar" type="hidden" id="mostrar" value="0">
</div></td>
      </tr>
      <tr style="background:transparent;">
        <td><div align="left"></div>          
                <div align="left"></div></td>
        <td><div align="left">
          <input type="submit" name="Submit2" value="Cadastrar" onClick="cadastrarNoticia()">
          <input type="submit" name="Submit" value="Mostrar Not&iacute;cias" onClick="mostraNoticias()">
        </div></td>
      </tr>
    </table>

</div>

<?php

	include("funcoes.php"); // Arquivo com as funções quer serão utilizadas pelo sistema.

	if (@$_REQUEST['cadastrar'] == 1) {
		adicionaNoticia($_REQUEST['noticia'], $_REQUEST['titulo'], $_REQUEST['user'], $_REQUEST['server'], $_REQUEST['tipo']);
	}
	else if (@$_REQUEST['mostrar'] == 1) {
		mostraNoticiasAdmin();
	}
	else if (@$_REQUEST['remover'] == 1) {
		apagarNoticia($_REQUEST['id']);
	}

?>


</div>
