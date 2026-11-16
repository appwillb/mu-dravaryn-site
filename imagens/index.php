<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: black;
}
body {
	background-color: #000000;
}
a {
	font-size: 12px;
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
	text-decoration: none;
	color: green;
}
a:active {
	text-decoration: none;
	color: #000000;
}

A:link    IMG 	{border:0px; border-thickness: 1px; border-color: #ab09d6;}
A:active  IMG 	{border:0px; border-thickness: 1px; border-color: #ab09d6;}
A:visited IMG 	{border:0px; border-thickness: 1px; border-color: #ab09d6;
A:hover   IMG 	{border:0px; border-thickness: 1px; border-color: white;}

-->
</style>
<html>  
<head>  
<title>MuK&#243;reia Imagens - Mk Sempre o Melhor</title>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> 

<script language="Javascript" type="text/javascript">
function tamanho() 
{ parent.document.getElementById("mainFrame").height = document.getElementById("tamanho").scrollHeight + 40;
}
</script>
</head>
<html>
<body  leftmargin='0' topmargin='0' style="background-color: transparent" onload="tamanho()">
<div id="tamanho">


<?PHP include("config2.php"); ?>
<?PHP

?>

<div id="tamanho">

<center>

<table border=0 cellSpacing=0 width=90% align=center> 

<center><table border=0 cellSpacing=3 align=center bordercolor=#ab09d6> 
 <tr>
<?php

$comando = "SELECT foto, comentario FROM fotos order by id desc";

$sql = $comando;
$query = mysql_query($sql); 

$linhas = mysql_num_rows($query);

for($i=0;$i < $linhas;++$i)
{
$dado = mysql_fetch_array($query);


if ($i %5 == 0) echo "<tR>";

echo "<td width=145 height=110 valign=top><a href='#' onClick=window.open('fotos2.php?img=$dado[0]','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=400,topmargin=0,leftmargin=0'); return false;><center><img src='thumb.php?imagem=fotos/$dado[0]&y=95&x=140&qualidade=100' title='$dado[1]'></a><br>$dado[1]</td>";
}

?>

</tr>

</table>

  </td>
  </tr>
</table>
<br><center>

</div>
</div>

</body>  
</html> 


