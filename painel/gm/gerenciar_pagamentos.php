<head>
  	<link type="text/css" rel="stylesheet" href="../css/paginas.css">
	<link rel="stylesheet" href="../css/jquery-ui.css" />

        <script type="text/javascript" src="../js/jquery-1.8.2.js"></script>
	<script src="../js/jquery-ui.js"></script>


	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
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

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<br><Br><font size=3><b>CONFIRMAÇÕES DE PAGAMENTOS</font></b><br><br>

<?php
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;

require("../inclu/verif_nivel_gm.php");

$delete     = $_GET[delete];
$enviarmsg  = $_GET[enviarmsg];
$confirmar  = $_GET[confirmar];

if($delete)
{
	$msresults= mssql_query("delete from mk_pagamentos where id_pg='$delete'");
	echo "<center><font size=3 color=red>Confirmação excluida com sucesso!!</font><br><bR>";
}

if($enviarmsg)
{
	$loginin = $_GET[log_pg];
	$mensagem = utf8_encode(stripslashes($_POST['mensagem']));

	if ($loginin==null || $enviarmsg==null || $mensagem==null){
	Echo"<center><font size=3 color=red>Campos em Branco!!</font><bR><Br>";

} 
else 
{

mssql_query("INSERT INTO mk_mensagens (login,login_r,msg) values ('$loginin','$login','$mensagem' )");
mssql_query("update mk_pagamentos set respondido=1 where id_pg='$enviarmsg' and login='$loginin'");

echo "<font size=3 color=green>Mensagem enviada com Sucesso!!</font><bR><Br>";
}
}

if($confirmar){
$loginin= $_GET[log_pg];
$idd	= $_GET[idd];
$valor 	= stripslashes($_POST['valor']);
$valor2 = stripslashes($_POST['valor2']);

if ($loginin==null || $idd==null || $valor==null){
Echo"<center><bR><font size=3 color=red>Campos em Branco!!</font><bR><Br>";

} else {

$exp = 0;
if ($valor2 >= 20) 
{
	$exp = 100;
}
if ($valor2 >= 30) 
{
	$exp = 150;
}
if ($valor2 >= 40) 
{
	$exp = 200;
}
if ($valor2 >= 50) 
{
	$exp = 250;
}
if ($valor2 >= 100) 
{
	$exp = 500;
}
if ($valor2 >= 150) 
{
	$exp = 800;
}
if ($valor2 >= 200) 
{
	$exp = 1500;
}
if ($valor2 >= 300) 
{
	$exp = 2500;
}

if ($exp>0)
{
	mssql_query("UPDATE CHARACTER set exp_war=exp_war+$exp where accountid='$loginin'");
}

$msg = utf8_encode("Seu pagamento foi confirmado, foram adicionados $valor créditos em sua conta!!");

$insert1 = mssql_num_rows(mssql_query("Select accountid FROM CashShopData WHERE accountid = '$loginin'"));

if ( $insert1 <= 0)
{
	$msquery = mssql_query("INSERT INTO CashShopData ( accountid,wcoinc,wcoinp,goblinpoint ) values ('$loginin',0,0,0)");
}

mssql_query("update CashShopData set WcoinC= WcoinC+$valor where accountid='$loginin'");
mssql_query("update mk_pagamentos set confirmado=1,valor_confirmado='$valor', valor_depositado='$valor2' where id_pg='$idd' and login='$loginin'");
mssql_query("INSERT INTO mk_mensagens (login,login_r,msg) values ('$loginin','$login','$msg' )");

mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$loginin','$valor','$seuip','3')");

echo "<font size=3 color=green>Pagamento confirmado com sucesso!!</font><bR><Br>";
}

}

echo "<a href=gerenciar_pagamentos_grafico.php>GERENCIADOR FINANCEIRO</a> | <a href=gerenciar_pagamentos_ranking.php>RANKING CONTRIBUINTES</a><br><br>";

$query_pe = "select top 30 id_pg,login,data,hora,terminal,conta,valor,dados,ip,CONVERT(VARCHAR(19),data_pg,120) as data_pg,confirmado,valor_confirmado,respondido,valor_depositado from mk_pagamentos order by data_pg desc";
$result_pe = mssql_query( $query_pe );
$num   	= mssql_num_rows($result_pe);

echo '<center><table border=0 cellSpacing=0 align=center>';
echo '
<thead>
  <tr>
	<th width=100>Login</th>
	<th width=80 class=bgtr>Data</th>
	<th width=80 class=bgtr>Hora</th>
	<th width=100 class=bgtr>Terminal</th>
	<th width=130 class=bgtr>Valor(Confirmado)</th>
	<th width=100 class=bgtr>IP</th>
	<th width=130 class=bgtr>Data confirmação</th>
	<th width=100>Confirmado</th>
  </tr>
</thead>';

if ($num <= 0){ 
echo '<tr><td colspan=8>Nenhum resultado localizado!</td></tr>'; }

for($i=0;$i < $num;++$i)
{
$row_mail = mssql_fetch_row($result_pe);

$id		= $row_mail[0];
$login_pg	= $row_mail[1];
$data	 	= $row_mail[2];
$hora      	= $row_mail[3];
$terminal    	= $row_mail[4];
$conta    	= $row_mail[5];
$valor    	= $row_mail[6];
$dados    	= utf8_decode(nl2br($row_mail[7]));
$ip	    	= $row_mail[8];
$data_pg    	= $row_mail[9];
$confirmado    	= $row_mail[10];
$valor_confirmado = $row_mail[11];
$respondido     = $row_mail[12];
$valor_depositado     = $row_mail[13];
$conta = str_replace("Caixa Economica", "Caixa", "$conta");

$data_pg = date_create("$data_pg");
$data_pg = date_format($data_pg, 'd-m-Y H:i');

if ($confirmado==1) {$confirmado="<font color=green>Confirmado</font>";}
elseif ($confirmado==0 and $respondido==1){ $confirmado="<font color=blue>Respondido</font>";}
else {$confirmado="<font color=red>Não Confirmado</font>";}

if ($_GET[showid]==$id) $selecionado="bgcolor=lightblue"; else $selecionado ="";

echo "<tr height=21 $selecionado onclick=\"document.location.href='?showid=$id'\" onmouseover=\"this.style.backgroundColor='lightblue'; this.style.cursor='pointer';\" onmouseout=\"this.style.background='$selecionado';\">";
echo '<td>';
echo "$login_pg";
echo '</td><td>';
echo "$data";
echo '</td><td>';
echo "$hora";
echo '</td><td>';
echo "$terminal";
echo '</td><td>';
echo "$valor($valor_depositado)($valor_confirmado)";
echo '</td><td>';
echo "$ip";
echo '</td><td>';
echo "$data_pg";
echo '</td><td>';
echo "$confirmado";
echo '</td></tr>';

if ($_GET[showid]==$id){

echo "<tr style='background:transparent;'><td colspan=9><center>
<table border=0 width=100% cellspacing=0>

<thead>
  <tr>
	<th>Dados do deposito</th>
	<th class=bgtr>Mensagem</th>
	<th class=bgtr>Adicionar Pagamento</th>
  </tr>
</thead>

<tr style='background:transparent;'><td valign=top>
<table width=200 border=0 cellspacing=0 cellpadding=0 style='border:0;'>
<tr><td align=right height=20><b>Login:</td><td width=120>$login_pg</td></tr>
<tr><td align=right height=20><b>Data:</td><td>$data</td></tr>
<tr><td align=right height=20><b>Terminal:</td><td>$terminal</td></tr>
<tr><td align=right height=20><b>Valor:</td><td>$valor</td></tr>
<tr><td align=right height=20><b>Conta:</td><td>$conta</td></tr>
</table>
</td>
<td width=360 valign=top>
<table width=90% style='border:0;'>
<tr style='background:transparent;'><td>
$dados
</td</tr></table>
</td>
<td><center><br>

 <table width='200' border='0' cellspacing='0' cellpadding='0' style='border:0;'>
<form name='form1' method='post' action='?confirmar=ok&log_pg=$login_pg&idd=$id'>
  <tr style='background:transparent;'>
    <td><br><center>Conta <b>$login_pg</font><br><br>
	Valor Depositado<bR>
        <input name='valor2' type='text' maxlength='10'><bR><br>
	Valor Confirmado<bR>
        <input name='valor' type='text' maxlength='10'><bR><br>
        <input type='submit' value='Confirmar'><bR><br>
    </td>
  </tr></form></table>


<tr style='background:transparent;'><td colspan=3><center><a href='?responder=ok&showid=$id'><b>Enviar Mensagem</b></a> | <a href=\"javascript:confirmaExclusao('?delete=$id','Deseja realmente remover esse pagamento?')\"><b>Deletar</b></a><br><bR></td></tr>
";

if ($_GET[responder]){
echo "<tr style='background:transparent;'><td colspan=3> <center><table width='140' border='0' cellspacing='0' cellpadding='0' bordercolor='#333333'>
<form name='form1' method='post' action='?enviarmsg=$id&log_pg=$login_pg'>
  <tr style='background:transparent;'>
    <td><center>Mensagem para <b>$login_pg</b><br>
	<bR>Mensagem:
        <textarea name='mensagem' cols='70' rows='7'></textarea><bR>
        <input type='submit' value='Enviar Mensagem'>
    </td>
  </tr></form></table>
";
}


echo "</table></td></tr>";}


}

echo "</table><bR><bR>";

?>
<script>
function confirmaExclusao(aURL,aMensagem) {
if(confirm(aMensagem)) {
location.href = aURL;
}
}
</script>
</div>