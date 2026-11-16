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

<BR><BR><font size=4><b>TOP CONTRIBUINTE ANUAL</font></b> <BR><BR>

<center><font size=4><b>Jogadores que mais ajudaram nosso servidor a crescer nesse ano.</font></b><br><br>

Somos muito gratos a todos vocês.<bR><br>
<table align=center cellspacing=0 style="border:0;">
<tr style="background:transparent;">
<?php
include("inclu/config_simples.php");

$query = "SELECT top 20 login,sum(valor_depositado) as valor_depositado,dbo.fn_char_forte(login),dbo.fn_exp(dbo.fn_char_forte(login)) FROM MK_pagamentos WHERE data_pg > '1/1/2017 00:00:00' group by login order by valor_depositado desc";
$result = mssql_query( $query );

for($i=1;$i < 21;++$i)
{
$row = mssql_fetch_row($result);

$name= $row[2];
$patente_num = $row[3];

include 'inclu/patentes.php';

if ($i==6 or $i==11 or $i==16 or $i==21) echo "<TR style='background:transparent;'>";


echo "<td>
<table border='0' cellpadding='0' align='center' cellspacing='0' width=130 height=150>

  <thead>
	<tr>	
		<th colspan=5>$i º Colocado</th>
	</tr>
  </thead>


  <tr>
    <td valign=top><a href='info_char_pop.php?name=$name&painel=ok'>
    <center><img src='/img/$img.jpg' height=120'><bR>
    <font size=2><b>$name &nbsp;</a>
     </td>
  </tr>
</table>";

}
?>

</table><br><br><b>www.jogandomu.com.br - Online graças aos nossos queridos players!!

</div>
