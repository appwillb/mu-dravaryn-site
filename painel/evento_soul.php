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

<center><bR><BR><font size=3><b> EVENTO - COLEÇÃO DE SOULS <bR><BR></font></b>

<?
require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET[verificar]){

$result= mssql_query("VERIFICAR_ITENS \"$login\",0x0E00");

$arr = mssql_fetch_assoc($result);       
   
if ($arr[qtd] > 119 ) {

mssql_query("INSERT INTO LOG_EVENTOS_ITENS ( login, tipo, qtd ) values ('$login','6','$arr[qtd]')");
mssql_query("UPDATE CashShopData set wcoinc = wcoinc+5 where accountid='$login'");
mssql_query("UPDATE character set exp_war=exp_war+500 where accountid='$login'");
mssql_query("UPDATE character set eventos=eventos+60, eventos_semanal=eventos_semanal+60, eventos_mensal=eventos_mensal+60 where name=dbo.fn_char_forte('$login')");


echo "<font color=$font_color2 size=3><b>Localizadas $arr[qtd] Souls!<br><br>Elas foram removidas do seu baú!<Br><BR>Seus Prêmios foram adicionados!</font>";


}

elseif ($arr[find] == 1 ) {

echo "<font color=$font_color1 size=3><b>Você deve deixar somente as souls no baú!</font>";

}

elseif (mssql_num_rows(mssql_query("select memb___id from memb_stat where connectstat=1 and memb___id='$login'")) > 0 )
{
	echo "<font color=$font_color1 size=3><b>Você deve ficar offline para adicionar!</font>";

}

else {
echo "<font color=$font_color1 size=3><b>Você não tem um baú completo de Souls!</font>";
}

echo "<Br><br>";

}

?>

Para participar você deve coletar 120 souls e colocar no baú (Um baú completo), <br> Depois que completar o baú com souls clique 
no botão Verificar. <BR><Br>**SUAS SOULS SERÃO REMOVIDAS**<BR><Br><b> Prêmio:</b><br>-5 Créditos<br>-500 exp. para todos os Personagens da sua conta. <br> - 60 Pontos de eventos para o persoangem mais forte.</font> <BR><BR><a href=?verificar=ok><img src=img/BT_verificar.png></a></font> <br><BR> Sistema By Louis com anti-dupe.

</div>