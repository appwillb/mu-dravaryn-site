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

<?
require("inclu/config.php");
require("inclu/cookie.php");



$titulo = "Evento KUNDUN +3"; 

echo "<title>$titulo</title>";
echo $fundo_topo;
echo "$titulo $racai";
echo $fundo_topo_fim;

if ($_GET[verificar]){

$result= mssql_query("EVENTO_K3 \"$login\"");

$arr = mssql_fetch_assoc($result);       



if ($arr["qtd"] > 119 ) {

$ip2 = $_SERVER["REMOTE_ADDR"];

//mssql_query("UPDATE MEMB_INFO SET creditos = creditos + 20 where memb___id = '$login'");
mssql_query("UPDATE warehouse set items = null where accountid = '$login'");
mssql_query("UPDATE character set exp_war = exp_war+2000 where accountid = '$login'");
//mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','20','$ip2','21')");
mssql_query("INSERT INTO LOG_EVENTOS_ITENS ( login, tipo ) values ('$login','6')");

$char_forte = mssql_fetch_row(mssql_query( "Select top 1 name from character where accountid='$login' order by mresets desc,resets desc,clevel desc"));
$char = $char_forte[0];

mssql_query("UPDATE character set eventos=eventos+120, eventos_semanal=eventos_semanal+120, eventos_mensal=eventos_mensal+120 where name='$char'");


echo "<Br><font color=$font_color2 size=3><b>Prêmios adicionados!<br><br>
Seu Baú foi resetado!</font>";

}

elseif (mssql_num_rows(mssql_query("select memb___id from memb_stat where connectstat=1 and memb___id='$login'")) > 0 )
{
	echo "<Br><font color=$font_color1 size=3><b>Você deve ficar offline para realizar o evento!</font>";

}

else {
echo "<Br><font color=$font_color1 size=3><b>Você não tem 120 Kunduns +3!</font>";
}

}

?>

<Br><Br><b>Novo evento no MK!<BR><BR> Evento "coleção de Kunduns". <br><BR> Para participar você deve coletar 120 kunduns +3 e colocar no baú (Um baú completo), <br> Depois que completar o baú clique 
no botão Verificar. <BR><Br><b> Prêmio temporário:</b><br><font color=red>- 2000 Exp para todos os personagens da sua conta.</font> <br><font color=red>- 120 Pontos de eventos para o personagem mais forte.</font>
<BR><BR><a href=?verificar=ok><img src=img/BT_verificar.png></a></font> <br><BR> Sistema By Louis com anti-dupe.

</div>