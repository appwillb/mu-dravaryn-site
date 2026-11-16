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

<br><Br><font size=3><b>GERENCIADOR FINANCEIRO</font></b><br><br>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;

require("../inclu/verif_nivel_gm.php");

if($_GET[deletar]){
$id  		= stripslashes($_GET['deletar']);

if (empty($id)) {
echo '<script language="Javascript">alert("ERRO: Campos em branco!!")</script>';
}
else {

mssql_query("DELETE FROM MK_DESPESAS where id_desp = '$id'");

echo '<script language="Javascript">alert("Deletado com sucesso!!")</script>';

}

}

if($_GET[adicionar]){
$data 		= stripslashes($_POST['calendario1']);
$tipo 		= stripslashes($_POST['tipo']);
$valor 		= stripslashes($_POST['valor']);

$data = implode('-', array_reverse(explode('/', $data)));

$data = date_format(date_create("$data"), 'Y-m-d');

if (empty($data) || empty($valor) || empty($tipo)) {
echo '<script language="Javascript">alert("ERRO: Campos em branco!!")</script>';
}
else {

mssql_query("INSERT INTO MK_DESPESAS (data_pg, despesa, valor_despesa) VALUES ('$data','$tipo','$valor')");

echo '<script language="Javascript">alert("Salvo com sucesso!!")</script>';

}

}


if($_GET[salvar]){
$id  		= stripslashes($_GET['id']);
$data 		= stripslashes($_POST['calendario2']);
$tipo 		= stripslashes($_POST['tipo']);
$valor 		= stripslashes($_POST['valor']);

$data = implode('-', array_reverse(explode('/', $data)));

$data = date_format(date_create("$data"), 'Y-m-d');

if (empty($id) || empty($data) || empty($valor) || empty($tipo)) {
echo '<script language="Javascript">alert("ERRO: Campos em branco!!")</script>';
}
else {

mssql_query("UPDATE MK_DESPESAS SET data_pg='$data',despesa = '$tipo', valor_despesa = '$valor' where id_desp = '$id'");

echo '<script language="Javascript">alert("Salvo com sucesso!!")</script>';

}

}


echo "
<table width=800 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=5> Situação financeira do servidor </th>
	</tr>
 	<tr>
		<th width=100> Mês </th>
		<th> Gráfico </th>
		<th> Receitas </th>
		<th> Despesas </th>
		<th> Saldo </th>
	</tr>
</thead>
";


$por_mes     	= mssql_query("SELECT MONTH(data), YEAR(data), SUM(credito), SUM(debito) from (SELECT data_pg as data , valor_depositado as credito, 0 as debito FROM MK_Pagamentos WHERE confirmado = 1 UNION ALL SELECT data_pg, 0, valor_despesa FROM MK_Despesas) a GROUP BY MONTH(data), YEAR(data)");
$num   		= mssql_num_rows($por_mes);
$max     	= mssql_fetch_row(mssql_query("Select MAX(credito) from (SELECT SUM(credito) as credito from (SELECT data_pg as data , valor_depositado as credito, 0 as debito FROM MK_Pagamentos WHERE confirmado = 1 UNION ALL SELECT data_pg, 0, valor_despesa FROM MK_Despesas) a GROUP BY MONTH(data), YEAR(data)) b "));
$max		= $max[0];

if ($num <= 0){ 
echo '<tr><td colspan=3>Nenhum resultado localizado!</td></tr>'; }

else {

$debitos 	= 0;
$creditos 	= 0;
$Saldo 		= 0;
$meses 		= 0;

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($por_mes);

$mes 		= $row[0];
$ano 		= $row[1];
$credito	= $row[2];
$debito		= $row[3];
$total		= $credito-$debito;
$meses++;

$debitos	= $debitos+$debito;
$creditos	= $creditos+$credito;
$saldo		= $saldo+$total;

$perc 		= $credito*100;
$perc 		= bcdiv($perc,$max)+7;

$perc2 		= $debito*100;
$perc2 		= bcdiv($perc2,$max)+7;

$total = ($total > 0) ? "<font color=$font_color2>$total</font>" : "<font color=$font_color1>$total</font>";

echo "<tr>";
echo "<td><font size=2><b>$mes/$ano</td>";
echo "<td style='text-align: left;' width='320px;'>";
echo "<div style='background-color: green; height: 10px; width: $perc%;'><!-- --></div><br><div style='background-color: $font_color1; height: 10px; width: $perc2%;'><!-- --></div></td>";
echo "</td><td><center><font size=2><font color=$font_color2>$credito</font></td>";
echo "</td><td><center><font size=2><font color=$font_color1>-$debito</font></td>";
echo "</td><td><center><font size=2><b>$total</td>";
echo "</tr>";

}
}

$media		= bcdiv($saldo,$meses);

$saldo = ($saldo > 0) ? "<font color=$font_color2>R$ $saldo</font>" : "<font color=$font_color1>R$ $saldo</font>";
$media = ($media > 0) ? "<font color=$font_color2>R$ $media/mês</font>" : "<font color=$font_color1>R$ $media/mês</font>";

echo "
<tr>
	<td></td>
	<td><b>Média: $media </b></td>
	<td><b>Total: <font color=$font_color2>R$ $creditos </font></td>
	<td><b>Total: <font color=$font_color1>R$ $debitos </font></td>
	<td><b>Saldo final: $saldo </td>

</table><bR><Br>";


echo "
<table width=800 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=5> Depósitos x Mês </th>
	</tr>
 	<tr>
		<th width=100> Mês </th>
		<th> Gráfico </th>
		<th> Valor depositado </th>
		<th> Valor confirmado </th>
		<th> Quantidade </th>
	</tr>
</thead>
";


$por_mes     	= mssql_query("SELECT MONTH(data_pg), YEAR(data_pg), SUM(valor_depositado), SUM(valor_confirmado),count(*) FROM MK_Pagamentos WHERE confirmado = 1 GROUP BY MONTH(data_pg), YEAR(data_pg)");
$num   		= mssql_num_rows($por_mes);
$max     	= mssql_fetch_row(mssql_query("Select MAX(vdepositado) from (SELECT SUM(valor_depositado) as vdepositado FROM MK_Pagamentos WHERE confirmado = 1 GROUP BY MONTH(data_pg), YEAR(data_pg)) a "));
$max		= $max[0];


if ($num <= 0){ 
echo '<tr><td colspan=3>Nenhum resultado localizado!</td></tr>'; }

else {

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($por_mes);

$mes 		= $row[0];
$ano 		= $row[1];
$v_depositado	= $row[2];
$v_confirmado	= $row[3];
$quantidade	= $row[4];

$perc 		= $v_depositado*100;
$perc 		= bcdiv($perc,$max)+5;

echo "<tr>";
echo "<td><font size=2><b>$mes/$ano</td>";
echo "<td style='text-align: left;padding-top:5px;' width='320px;'>";
echo "<div style='background-color: green; height: 10px; width: $perc%;'><!-- --></div></td>";
echo "</td><td><center><font size=2>$v_depositado</td>";
echo "</td><td><center><font size=2>$v_confirmado</td>";
echo "</td><td><center><font size=2>$quantidade</td>";
echo "</tr>";

}
}

echo "</table><br><Br>";

echo "
<table width=800 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=5> Depósitos x Ano </th>
	</tr>
 	<tr>
		<th width=100> Ano </th>
		<th> Gráfico </th>
		<th> Valor depositado </th>
		<th> Valor confirmado </th>
		<th> Quantidade </th>
	</tr>
</thead>
";


$por_ano     	= mssql_query("SELECT YEAR(data_pg), SUM(valor_depositado), SUM(valor_confirmado) as vconfirmado,count(*) FROM MK_Pagamentos WHERE confirmado = 1 GROUP BY YEAR(data_pg)");
$num   		= mssql_num_rows($por_ano );
$max     	= mssql_fetch_row(mssql_query("Select MAX(vdepositado) from (SELECT SUM(valor_depositado) as vdepositado FROM MK_Pagamentos WHERE confirmado = 1 GROUP BY YEAR(data_pg)) a "));
$max		= $max[0];

if ($num <= 0){ 
echo '<tr><td colspan=3>Nenhum resultado localizado!</td></tr>'; }

else {

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($por_ano );

$ano 		= $row[0];
$v_depositado	= $row[1];
$v_confirmado	= $row[2];
$quantidade	= $row[3];

$perc 		= $v_depositado*100;
$perc 		= bcdiv($perc,$max)+5;

echo "<tr>";
echo "<td><font size=2><b>$ano</td>";
echo "<td style='text-align: left;padding-top:5px;' width='320px;'>";
echo "<div style='background-color: green; height: 10px; width: $perc%;'><!-- --></div></td>";
echo "</td><td><center><font size=2>$v_depositado</td>";
echo "</td><td><center><font size=2>$v_confirmado</td>";
echo "</td><td><center><font size=2>$quantidade</td>";
echo "</tr>";

}
}

echo "</table><br><BR>";

echo "

<table border = 0 width=800 cellspacing=0>

<thead>
<tr>
  <th Colspan=4>Gerenciar despesas:</th>
</tr>
<tr>
  <th width=200>Despesa:</th>
  <th colspan=2>Gráfico:</th>
  <th>Total:</th>
</tr>
</thead>

";


$por_desp     	= mssql_query("SELECT despesa, SUM(valor_despesa) as valor1 FROM MK_despesas GROUP BY despesa order by valor1 desc");
$num   		= mssql_num_rows($por_desp);
$max     	= mssql_fetch_row(mssql_query("Select MAX(valor1) from (SELECT SUM(valor_despesa) as valor1 FROM MK_despesas GROUP BY despesa) a "));
$max		= $max[0];

$v_despesat = 0;

if ($num <= 0){ 
echo '<tr><td colspan=4>Nenhum resultado!</td></tr>'; }

else {



for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($por_desp);

$despesa 	= $row[0];
$v_despesa	= $row[1];

$perc 		= $v_despesa*100;
$perc 		= bcdiv($perc,$max);

$v_despesat 	= $v_despesat+$v_despesa;

echo "<tr>";
echo "<td><font size=2><b>$despesa</td>";
echo "<td style='text-align: left;padding-top:5px;' width='320px;' colspan=2>";
echo "<div style='background-color: $font_color1; height: 10px; width: $perc%;'><!-- --></div></td>";
echo "<td><center><font size=2 color=$font_color1>R$ -$v_despesa</font></td>";
echo "</tr>";

}
}

?>

<tr><td colspan=3></td><td><b>Total:<font size=2 color=$font_color1> R$ -<?=$v_despesat;?> </b></font></td></tr>

<thead>
<tr>
  <th colspan=4>Adicionar Despesa:</th>
</tr>
<tr>
      <th>Data </th>
      <th>Tipo </th>
      <th>Valor:</th>
      <th>Adiconar </th>
</tr>

</thead>


<form name='form1' method='post' action="?adicionar=ok">

<tr>
<td> <input type='text' name = 'calendario1' id='calendario1' value='' style='width:120px;'> </td>
<td><select name='tipo' id='tipo' style='width:250px;'>
 <option value=''> -- Selecione -- </option>
 <option value='CLOUD/VPS'> CLOUD/VPS </option>
 <option value='ENERGIA'> ENERGIA </option>
 <option value='HOSPEDAGEM'> HOSPEDAGEM  </option>
 <option value='INTERNET'> INTERNET </option>
 <option value='LICENCAS/PROGRAMAS'> LICENCAS/PROGRAMAS </option>
 <option value='PROPAGANDA'> PROPAGANDA </option>
 <option value='OUTROS'> OUTROS </option>
</select></td>

<td><input type='text' name='valor' maxlength='10' style='width:100px;'></td>

<td><center><input type='submit' name='Submit' value='ADICIONAR'></td>
</tr></form>
</td></tr>

 <tr>
  <td colspan=4> &nbsp;</td>
 </tr>

<thead>
<tr>
  <th Colspan=4>Listagem de despesas:</th>
</tr>
<tr>
      <th>Data </th>
      <th>Tipo </th>
      <th>Valor:</th>
      <th>Adiconar </th>
</tr>

</thead>

<?php

$query = "Select data_pg, despesa, valor_despesa, id_desp From mk_despesas order by data_pg desc";
$result = mssql_query( $query );

$xex = mssql_num_rows($result);

if ($xex <= 0 ) {
echo "
 <tr>
  <td colspan=4> Nenhuma despesa</td>
 </tr>
";
}

$c = 10;

for($i=0;$i < $xex;++$i)
{
$row = mssql_fetch_row($result);

$data        =   $row[0];
$tipo        =   $row[1];
$valor       =   $row[2];
$id          =   $row[3];

$c++;

echo "
<script>
$(function() {
    $('#calendario$c').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
</script>
";

$data = date_format(date_create("$data"), 'd/m/Y');

echo "

<form name='form1' method='post' action='?salvar=ok&id=$id'>

<tr>
<td> <input type='text' name = 'calendario2' id='calendario$c' value='$data' style='width:120px;'> </td>

<td><select name='tipo' id='tipo' style='width:250px;'>
 <option value=''> -- Selecione -- </option>
 <option value='CLOUD/VPS' 		".($tipo == 'CLOUD/VPS' ? "selected " : "")."	> CLOUD/VPS </option>
 <option value='ENERGIA' 		".($tipo == 'ENERGIA' ? "selected " : "")."	> ENERGIA </option>
 <option value='HOSPEDAGEM' 		".($tipo == 'HOSPEDAGEM' ? "selected " : "")."	> HOSPEDAGEM  </option>
 <option value='INTERNET' 		".($tipo == 'INTERNET' ? "selected " : "")."	> INTERNET </option>
 <option value='LICENCAS/PROGRAMAS' 	".($tipo == 'LICENCAS' ? "selected " : "")."	> LICENCAS/PROGRAMAS </option>
 <option value='PROPAGANDA' 		".($tipo == 'PROPAGANDA' ? "selected " : "")."	> PROPAGANDA </option>
 <option value='OUTROS' 		".($tipo == 'OUTROS' ? "selected " : "")."	> OUTROS </option>
</select></td>

<td><input type='text' name='valor' maxlength='10' style='width:100px;' value='$valor'></td>

<td>
<input type='image' src='../img/save.png' name='Submit' value='Continuar' style='border:0;background:transparent;'></form> &nbsp; &nbsp;
<a href='?deletar=$id'><img src='../img/excluir.png'></a></td>
</tr>";

}

echo "</table></td></table><BR><BR>";

?>

</div>