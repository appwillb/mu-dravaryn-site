<head>
  	<link type="text/css" rel="stylesheet" href="../css/paginas.css">
	<link rel="stylesheet" href="../css/jquery-ui.css" />

        <script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
	<script src="../js/jquery-ui.js"></script>


	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>


<script>
$(function() {
    $("#calendario1").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});

    </script>

<style>

	.bgtr2 {
  	background-color:rgb(97,97,97);
    	color: #fff;
	}

</style>
</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<br><Br><font size=3><b>RANKING CONTRIBUINTES</font></b><Br><br>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;

require("../inclu/verif_nivel_gm.php");

echo "
<table width=500 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=2> Top 20 Ranking Geral </th>
	</tr>
 	<tr>
		<th> Login </th>
		<th> Valor </th>
	</tr>
</thead>";

$por_geral     	= mssql_query("SELECT top 20 login, SUM(valor_depositado) as valor1 FROM MK_Pagamentos WHERE confirmado = 1 group by login order by valor1 desc");
$num   		= mssql_num_rows($por_geral);


if ($num <= 0){ 
echo '<tr><td colspan=2>Nenhum resultado localizado!</td></tr>'; }

else {

$mes_anterior = "";
$ano_anterior = "";

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($por_geral);

$logcre		= $row[0];
$valor		= $row[1];


echo "<tr>";
echo "<td><font size=2><a href=editar_conta.php?loginlog=$logcre>$logcre</a></td>";
echo "</td><td><center><font size=2>$valor</td>";
echo "</tr>";

}
}

echo "</table><br><Br>";

echo "
<table width=500 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=2> Ranking x Ano </th>
	</tr>
 	<tr>
		<th colspan=2> Ranking dos personagens que mais contribuiram no servidor/ano. </th>
	</tr>
</thead>";

$por_ano    	= mssql_query("SELECT login, YEAR(data_pg) as data2, SUM(valor_depositado) as valor1 FROM MK_Pagamentos WHERE confirmado = 1 GROUP BY YEAR(data_pg), login order by YEAR(data_pg) desc, valor1 desc");
$num   		= mssql_num_rows($por_ano);


if ($num <= 0){ 
echo '<tr><td colspan=2>Nenhum resultado localizado!</td></tr>'; }

else {

$ano_anterior = "";

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($por_ano);

$logcre		= $row[0];
$ano 		= $row[1];
$valor		= $row[2];


if ($ano <> $ano_anterior) {

$ano_anterior	= $ano;


echo " 
<thead>
 	<tr>
		<th colspan=2> Ano referência:  $ano </th>
	</tr>
 	<tr>
		<th> Login </th>
		<th> Valor </th>
	</tr>
</thead>
";
}

echo "<tr>";
echo "<td><font size=2><a href=editar_conta.php?loginlog=$logcre>$logcre</a></td>";
echo "</td><td><center><font size=2>$valor</td>";
echo "</tr>";

}
}

echo "</table><br><Br>";


echo "
<table width=500 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=2> Ranking x Mês </th>
	</tr>
 	<tr>
		<th colspan=2> Ranking dos personagens que mais contribuiram no servidor/mês. </th>
	</tr>
</thead>";

$por_mes     	= mssql_query("SELECT login, MONTH(data_pg) as data1, YEAR(data_pg) as data2, SUM(valor_depositado) as valor1 FROM MK_Pagamentos WHERE confirmado = 1 GROUP BY MONTH(data_pg), YEAR(data_pg), login order by data2 desc, data1 desc, valor1 desc");
$num   		= mssql_num_rows($por_mes);


if ($num <= 0){ 
echo '<tr><td colspan=2>Nenhum resultado localizado!</td></tr>'; }

else {

$mes_anterior = "";
$ano_anterior = "";

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($por_mes);

$logcre		= $row[0];
$mes 		= $row[1];
$ano 		= $row[2];
$valor		= $row[3];


if ($mes <> $mes_anterior || $ano <> $ano_anterior) {

$mes_anterior	= $mes;
$ano_anterior	= $ano;


echo " 
<thead>
 	<tr>
		<th colspan=2> Mês referência:  $mes/$ano </th>
	</tr>
 	<tr>
		<th> Login </th>
		<th> Valor </th>
	</tr>
</thead>
";
}

echo "<tr>";
echo "<td><font size=2><a href=editar_conta.php?loginlog=$logcre>$logcre</a></td>";
echo "</td><td><center><font size=2>$valor</td>";
echo "</tr>";

}
}

echo "</table><br><Br>";

?>

</div>