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

<center><bR><BR><font size=3><b> PREMIO ESPECIAL <bR><BR></font></b>

<?
require("inclu/config.php");
require("inclu/cookie.php");
?>

Todo dia primeiro do mês o personagem que estiver como "Contribuinte do Mês"<Br>
irá ganhar um bônus especial por ser o personagem que mais ajudou o servidor no mês.<br><Br>

<b>O prêmio será:</b><br>
- Será somado todo o valor que esse personagem depositou no mês, valor em reais e não em créditos,<br>
por exemplo, o personagem depoistou, somando todos os depositos 100 reais,<br>
sendo assim serão adicionados mais 100 créditos na sua conta. 

<? 

$query = "select login,SUM(valor_depositado) as valor_depositado from mk_pagamentos where data_pg > (getdate())-30 GROUP BY login ORDER BY valor_depositado DESC";
$result = mssql_query( $query );
$qtd = mssql_num_rows( $result );

$encontrou = 0;

if ($qtd>0){
for($i=1;$i < $qtd;$i++)
{
$row = mssql_fetch_row($result);

if ($login == $row[0]) {
echo "<br><Br><font size=2><b>Você está em $i º colocado no ranking de compras nos ultimos 30 dias!</b></font><br><Br>";
$encontrou = 1;
break;
}
}
}

if ( $encontrou <=0 ) { 
echo "<br><Br><b>Você não contribuiu nos ultimos 30 dias!</b>";
}

?>

<BR><Br>

<b>MK TEAM


</div>
