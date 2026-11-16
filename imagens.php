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

<BR><BR><font size=4><b>MURAL DE IMAGENS</font></b> <BR><BR>

<?PHP
include("inclu/config.php");
include("imagens/config2.php");
?>


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


if ($i %4 == 0) echo "<tR>";

echo "<td width=145 height=110 valign=top><center><img  onClick=window.open('imagens/fotos2.php?img=$dado[0]','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=400,topmargin=0,leftmargin=0'); return false; onmouseover=\"this.style.cursor='pointer';\" src='imagens/thumb.php?imagem=fotos/$dado[0]&x=200x150&qualidade=100' title='$dado[1]'><br>$dado[1]</td>";
}

?>

</tr>

</table>

  </td>
  </tr>
</table>
<br><center>

</div>

