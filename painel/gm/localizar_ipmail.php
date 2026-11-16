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

<br><Br><font size=3><b>RASTREAR IP/E-MAIL</font></b><br><br><Br>

Sistema para rastrear contas com IP ou E-Mail solicitado.<br>

<?php
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;

require("../inclu/verif_nivel_gm.php");

if ($_POST[loginip])
{
	$loginip = "$_POST[loginip]";
}
elseif ($_GET[loginip])
{
	$loginip = "$_GET[loginip]";
}
else
{
	$loginip = "";
}

if ($_POST[loginmail])
{
	$loginmail = "$_POST[loginmail]";
}
elseif ($_GET[loginmail])
{
	$loginmail = "$_GET[loginmail]";
}
else
{
	$loginmail = "";
}

if ($_POST[loginserial])
{
	$loginserial = "$_POST[loginserial]";
}
elseif ($_GET[loginserial])
{
	$loginserial = "$_GET[loginserial]";
}
else
{
	$loginserial = "";
}

echo "

<table style='border:0;'>
  <tr style='background:transparent;'>  <td>

<form name='form1' method='post' action='?'>
<center>
<table border='0' cellspacing='0' cellpadding='0'>
<thead>
 <tr> 
   <th>Rastrear E-mail</td>
 </tr>
</thead>
<tr>
   <td width='150'><center><input name='loginmail' type='text' id='loginmail' maxlength='30' value='$loginmail' onClick=\"this.select();\";><br>Ex: teste@teste.com <br><br> <input type='submit' value='Procurar'></td>
 </tr>
</table>
</form>

</td> <td>

<form name='form1' method='post' action='?'>
<center>
<table border='0' cellspacing='0' cellpadding='0'>
<thead>
 <tr> 
   <th>Rastrear IP</th>
 </tr>
</thead>
<tr>
   <td width='150'><center><input name='loginip' type='text' id='loginip' maxlength='15' value='$loginip' onClick=\"this.select();\";><br>Ex: 192.168.0.1 <br><br> <input type='submit' value='Procurar'></td>
 </tr>
</table>
</form>

</td> <td>

<form name='form1' method='post' action='?'>
<center>
<table border='0' cellspacing='0' cellpadding='0'>
<thead>
 <tr> 
   <th>Rastrear serial(item)</th>
 </tr>
</thead>
<tr>
   <td width='150'><center><input name='loginserial' type='text' id='loginserial' maxlength='15' value='$loginserial' onClick=\"this.select();\";><br>Ex: EFEFEFEF <br><br> <input type='submit' value='Procurar'></td>
 </tr>
</table>
</form>

</td> </tr> </table>
<br><Br>
";

if ($loginserial) 
{

If (!ctype_xdigit($loginserial)) 
{
	die("<center><font size=2 color=$font_color1><b>Serial Inválido!</b></font>"); 
}

$iten = "0x$loginserial";

echo "
<table width=670 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=3> Localizar Serial: $loginserial </th>
	</tr>
 	<tr>
		<th> Login </th>
		<th> Personagem principal </th>
		<th> Local do item </th>
	</tr>
</thead>
";

$qtd = 0; 

$query = mssql_query("select accountid, dbo.fn_char_forte(accountid)  from warehouse where (charindex ($iten, items) %16=4)");

while($row=mssql_fetch_row($query)){
echo '<tr>';
echo "<td><a href=editar_conta.php?loginlog=$row[0]> <font size=2> $row[0] </a></td>";
echo "<td>".(($row[1]) ? "<a href=editar_conta.php?loginchar=$row[2]> <font size=2> $row[1] </a>" : "-")."</td>";
echo "<td> Baú Principal </td>";
echo "</tr>";

$qtd++; 
}

$query1 = mssql_query("select accountid, dbo.fn_char_forte(accountid),number from extwarehouse where (charindex ($iten, extwarehouse.items) %16=4)");

while($row1=mssql_fetch_row($query1)){
echo '<tr>';
echo "<td><a href=editar_conta.php?loginlog=$row1[0]> <font size=2> $row1[0] </a></td>";
echo "<td>".(($row1[1]) ? "<a href=editar_conta.php?loginchar=$row1[1]> <font size=2> $row1[1] </a>" : "-")."</td>";
echo "<td> Baú extra número $row1[2] </td>";
echo "</tr>";
$qtd++; 
}

$query2 = mssql_query("select accountid,name from character where (charindex ($iten, Inventory) %16=4)");

while($row2=mssql_fetch_row($query2)){
echo '<tr>';
echo "<td><a href=editar_conta.php?loginlog=$row2[0]> <font size=2> $row2[0] </a></td>";
echo "<td>".(($row2[1]) ? "<a href=editar_conta.php?loginchar=$row2[1]> <font size=2> $row2[1] </a>" : "-")."</td>";
echo "<td> Inventório </td>";
echo "</tr>";
$qtd++; 
}

if ($qtd <= 0) 
{
echo '<tr><td colspan=3>Nenhum item encontrado!</td></tr>'; 
}
echo "</table><br><bR>";

}

if ($loginip)
{

echo "
<table width=670 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=3> Localizar IP: $loginip </th>
	</tr>
 	<tr>
		<th> Login </th>
		<th> Personagem principal </th>
		<th> Última conexão </th>
	</tr>
</thead>
";

$query = mssql_query("select memb___id,disconnectTM, dbo.fn_char_forte(memb___id) from memb_stat where ip='$loginip' order by disconnectTM desc");
$num   = mssql_num_rows($query);

if ($num <= 0){ 
echo '<tr><td colspan=3>Nenhum IP encontrado!</td></tr>'; }

else {

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($query);

$data   = date_format(date_create("$row[1]"), 'd/m/Y');

echo '<tr>';
echo "<td><a href=editar_conta.php?loginlog=$row[0]> <font size=2> $row[0] </a></td>";
echo "<td>".(($row[2]) ? "<a href=editar_conta.php?loginchar=$row[2]> <font size=2> $row[2] </a>" : "-")."</td>";
echo "<td>$data</td>";
echo '</tr>';

}

echo "</table><br><bR>";

}
}

if ($loginmail)
{
$query = mssql_query("select memb___id, dbo.fn_char_forte(memb_info.memb___id), (select disconnectTM from memb_stat where memb_stat.memb___id=memb_info.memb___id) as data  from memb_info where mail_addr='$loginmail' order by data desc");
$num   = mssql_num_rows($query);

echo "
<table width=670 cellspacing=0> 
<thead>
 	<tr>
		<th colspan=3> Localizar E-Mail: $loginmail </th>
	</tr>
 	<tr>
		<th> Login </th>
		<th> Personagem principal </th>
		<th> Última conexão </th>
	</tr>
</thead>
";

if ($num <= 0){ 
echo '<tr><td colspan=3>Nenhum IP encontrado!</td></tr>'; 
}

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($query);

$data   = date_format(date_create("$row[2]"), 'd/m/Y');

echo '<tr>';
echo "<td><a href=editar_conta.php?loginlog=$row[0]> <font size=2> $row[0] </a></td>";
echo "<td>".(($row[1]) ? "<a href=editar_conta.php?loginchar=$row[1]> <font size=2> $row[1] </a>" : "-")."</td>";
echo "<td>$data</td>";
echo '</tr>';

}
echo "</table><br><bR>";

}


?>

</div>