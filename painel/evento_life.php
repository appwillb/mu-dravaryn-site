<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

<script language="Javascript" type="text/javascript">
function tamanho() 
{ parent.document.getElementById("main2").height = document.getElementById("tamanho").scrollHeight + 40;
}
</script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<?
require("inclu/config.php");
require("inclu/cookie.php");



$titulo = "Evento LIFE"; 

echo "<title>$titulo</title>";
echo $fundo_topo;
echo "$titulo $racai";
echo $fundo_topo_fim;

if ($_GET[verificar]){

$result= mssql_query("EVENTO_LIFE \"$login\"");

$arr = mssql_fetch_assoc($result);       




if ($arr["qtd"] > 119 ) {

$ip2 = $_SERVER["REMOTE_ADDR"];

//mssql_query("UPDATE MEMB_INFO SET creditos = creditos + 10 where memb___id = '$login'");
mssql_query("UPDATE warehouse set items = null where accountid = '$login'");
//mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','10','$ip2','20')");

mssql_query("INSERT INTO LOG_EVENTOS_ITENS ( login, tipo ) values ('$login','4')");
mssql_query("update muonline.dbo.character set exp_war=exp_war+500 where accountid='$login'");
mssql_query("update memb_info set vip=1,dias_vip=dias_vip+5 where memb___id='$login'");

$char_forte = mssql_fetch_row(mssql_query( "Select top 1 name from character where accountid='$login' order by mresets desc,resets desc,clevel desc"));
$char = $char_forte[0];

mssql_query("UPDATE character set eventos=eventos+60, eventos_semanal=eventos_semanal+60, eventos_mensal=eventos_mensal+60 where name='$char'");



echo "<Br><font color=$font_color2 size=3><b>Você ganhou 500 exp e 5 dias VIP e 60 pontos de eventos!<br><br>
Seu Baú foi resetado!</font>";

}

elseif (mssql_num_rows(mssql_query("select memb___id from memb_stat where connectstat=1 and memb___id='$login'")) > 0 )
{
	echo "<Br><font color=$font_color1 size=3><b>Você deve ficar offline para realizar o evento!</font>";

}

else {
echo "<Br><font color=$font_color1 size=3><b>Você não tem 120 Lifes!</font>";
}

}

?>

<Br><Br><b>Novo evento no MK!<BR><BR> Evento "coleção de Lifes". <br><BR> Para participar você deve coletar 120 lifes e colocar no baú (Um baú completo), <br> Depois que completar o baú com lifes clique 
no botão Verificar. <BR><Br><b> Prêmio:</b><br><font color=red>- 500 exp. para todos os Personagens da sua conta. <Br>- 5 dias VIP. <br> - 60 Pontos de eventos para o persoangem mais forte.</font> <BR><BR><a href=?verificar=ok><img src=img/BT_verificar.png></a></font> <br><BR> Sistema By Louis com anti-dupe.

</div>