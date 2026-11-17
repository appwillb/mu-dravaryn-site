<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">

        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> QUESTS PELO SITE </font></b> <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");

$ip2 = $_SERVER["REMOTE_ADDR"];

$personagem = $_GET[personagem];
$verificar  = $_GET[verif];

$insert2 = mssql_num_rows(mssql_query("Select name FROM character WHERE Name = '$personagem' and accountid='$login'"));
$insert1 = mssql_num_rows(mssql_query("Select name FROM mk_quest WHERE Name = '$personagem'"));

if ( $insert1 <= 0 and $insert2 == 1){
$msquery = mssql_query("INSERT INTO mk_quest ( name ) values ('$personagem')");
}

$existe  = mssql_num_rows(mssql_query("Select name FROM mk_quest WHERE Name = '$personagem'"));

if (!$personagem or $insert2 <= 0 or $existe <=0) die("<bR><Br><font color=green>Escolha um Personagem!");

if ($verificar==1) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>10"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>9"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='99'"));
$quest_check = mssql_num_rows(mssql_query("Select name FROM mk_quest WHERE Name = '$personagem' and quest1=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($clevel_check <= 0) {$resultado= "<center><br>Você não esta no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest1=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+200 where name='$personagem' and accountid='$login'");

$resultado = 1;

}
}

if ($verificar==2) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>70"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>69"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='349'"));
$quest_check = mssql_num_rows(mssql_query("Select name FROM mk_quest WHERE Name = '$personagem' and quest2=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0D2C, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($clevel_check <= 0) {$resultado= "<center><br>Você não esta no level correto.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem uma Double Blade+5+Luck em seu baú.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest2=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+300 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==3) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>100"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>99"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='251'"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest3=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0F00, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0E00, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1000, items) %16=1) and accountid='$login'"));
$item_check3  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0D00, items) %16=1) and accountid='$login'"));
$item_check4  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1600, items) %16=1) and accountid='$login'"));


if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($clevel_check <= 0) {$resultado= "<center><br>Você não esta no level correto.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem uma Chaos no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem uma Soul no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem uma Life no baú.<br><br>"; } 
elseif ($item_check3  <= 0) {$resultado= "<center><br>Você não tem uma Bless no baú.<br><br>"; } 
elseif ($item_check4  <= 0) {$resultado= "<center><br>Você não tem uma Creation no baú.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest3=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+450, eventos=eventos+200, eventos_mensal=eventos_mensal+200, eventos_semanal = eventos_semanal+200 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==4) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>120"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>49"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='309'"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest4=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x062F56, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x06AF4A, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x072F4C, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($clevel_check <= 0) {$resultado= "<center><br>Você não esta no level correto.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem uma Chaos Dragon Axe+5+luck+option 28 no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem um Chaos Nature Bow+5+luck+skill+option 28 no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem uma Chaos Staff+5+luck+option 28 no baú.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest4=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+200, eventos_mensal=eventos_mensal+200, eventos_semanal = eventos_semanal+200 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==5) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>200"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>99"));
$morte_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and z_rankpk>'299'"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest5=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($morte_check  <= 0) {$resultado= "<center><br>Você não tem mortes suficientes.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest5=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+700,eventos=eventos+200, eventos_mensal=eventos_mensal+200, eventos_semanal = eventos_semanal+200 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==6) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>200"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest6=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0320, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0518, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0E2C, items) %16=1 or charindex (0xCEAC, items) %10=1 and charindex (0xFF, items) %10=3) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem uma Katana+4+option 16 no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem uma Legendary Staff+3+option 16 no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem um Legendary Shield+5+luck no baú.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest6=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+500, eventos_mensal=eventos_mensal+500, eventos_semanal = eventos_semanal+500 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==7) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>500"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>399"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest7=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1108, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1110, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1118, items) %16=1) and accountid='$login'"));
$item_check3  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1120, items) %16=1) and accountid='$login'"));
$item_check4  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1128, items) %16=1) and accountid='$login'"));
$item_check5  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1130, items) %16=1) and accountid='$login'"));
$item_check6  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1138, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem um Blood Fang +1 no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem um Blood Fang +2 no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem um Blood Fang +3 no baú.<br><br>"; } 
elseif ($item_check3  <= 0) {$resultado= "<center><br>Você não tem um Blood Fang +4 no baú.<br><br>"; } 
elseif ($item_check4  <= 0) {$resultado= "<center><br>Você não tem um Blood Fang +5 no baú.<br><br>"; } 
elseif ($item_check5  <= 0) {$resultado= "<center><br>Você não tem um Blood Fang +6 no baú.<br><br>"; }
elseif ($item_check6  <= 0) {$resultado= "<center><br>Você não tem um Blood Fang +7 no baú.<br><br>"; }
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest7=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+600, eventos_mensal=eventos_mensal+600, eventos_semanal = eventos_semanal+600 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==8) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>500"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>399"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest8=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check   = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1008, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1010, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1018, items) %16=1) and accountid='$login'"));
$item_check3  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1020, items) %16=1) and accountid='$login'"));
$item_check4  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1028, items) %16=1) and accountid='$login'"));
$item_check5  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1030, items) %16=1) and accountid='$login'"));
$item_check6  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1038, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem um Scroll of archangel +1 no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem um Scroll of archangel +2 no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem um Scroll of archangel +3 no baú.<br><br>"; } 
elseif ($item_check3  <= 0) {$resultado= "<center><br>Você não tem um Scroll of archangel +4 no baú.<br><br>"; } 
elseif ($item_check4  <= 0) {$resultado= "<center><br>Você não tem um Scroll of archangel +5 no baú.<br><br>"; } 
elseif ($item_check5  <= 0) {$resultado= "<center><br>Você não tem um Scroll of archangel +6 no baú.<br><br>"; }
elseif ($item_check6  <= 0) {$resultado= "<center><br>Você não tem um Scroll of archangel +7 no baú.<br><br>"; }
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest8=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+600, eventos_mensal=eventos_mensal+600, eventos_semanal = eventos_semanal+600 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==9) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>500"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>399"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest9=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check   = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1208, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1210, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1218, items) %16=1) and accountid='$login'"));
$item_check3  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1220, items) %16=1) and accountid='$login'"));
$item_check4  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1228, items) %16=1) and accountid='$login'"));
$item_check5  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1230, items) %16=1) and accountid='$login'"));


if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem um Devil Key +1 no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem um Devil Key +2 no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem um Devil Key +3 no baú.<br><br>"; } 
elseif ($item_check3  <= 0) {$resultado= "<center><br>Você não tem um Devil Key +4 no baú.<br><br>"; } 
elseif ($item_check4  <= 0) {$resultado= "<center><br>Você não tem um Devil Key +5 no baú.<br><br>"; } 
elseif ($item_check5  <= 0) {$resultado= "<center><br>Você não tem um Devil Key +6 no baú.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest9=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+400, eventos_mensal=eventos_mensal+400, eventos_semanal = eventos_semanal+400 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==10) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>500"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>399"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest10=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check   = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1108, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1110, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1118, items) %16=1) and accountid='$login'"));
$item_check3  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1120, items) %16=1) and accountid='$login'"));
$item_check4  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1128, items) %16=1) and accountid='$login'"));
$item_check5  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x1130, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem um Devil Eye +1 no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem um Devil Eye +2 no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem um Devil Eye +3 no baú.<br><br>"; } 
elseif ($item_check3  <= 0) {$resultado= "<center><br>Você não tem um Devil Eye +4 no baú.<br><br>"; } 
elseif ($item_check4  <= 0) {$resultado= "<center><br>Você não tem um Devil Eye +5 no baú.<br><br>"; } 
elseif ($item_check5  <= 0) {$resultado= "<center><br>Você não tem um Devil Eye +6 no baú.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest10=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+400, eventos_mensal=eventos_mensal+400, eventos_semanal = eventos_semanal+400 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==11) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>499"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>399"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest11=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x09004A, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem a Bill Of Balrog no baú.<br><br>"; } 
//elseif ($item_check3  <= 0) {$resultado= "<center><br>Você não tem uma Stone no baú.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest11=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+400, eventos_mensal=eventos_mensal+400, eventos_semanal = eventos_semanal+400 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==12) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>500"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>399"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest12=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0B40, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0B48, items) %16=1) and accountid='$login'"));
$item_check2  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0B50, items) %16=1) and accountid='$login'"));
$item_check3  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0B58, items) %16=1) and accountid='$login'"));
$item_check4  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0B60, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem uma Box of Kundun +1 no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem uma Box of Kundun +2 no baú.<br><br>"; } 
elseif ($item_check2  <= 0) {$resultado= "<center><br>Você não tem uma Box of Kundun +3 no baú.<br><br>"; } 
elseif ($item_check3  <= 0) {$resultado= "<center><br>Você não tem uma Box of Kundun +4 no baú.<br><br>"; } 
elseif ($item_check4  <= 0) {$resultado= "<center><br>Você não tem uma Box of Kundun +5 no baú.<br><br>"; }
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest12=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+500,eventos=eventos+400, eventos_mensal=eventos_mensal+400, eventos_semanal = eventos_semanal+400 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==13) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>350"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>199"));
$tempo_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and tempo>4499"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest13=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($tempo_check  <= 0) {$resultado= "<center><br>Você não tem Tempo conectado suficiente.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest13=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+200,eventos=eventos+200, eventos_mensal=eventos_mensal+200, eventos_semanal = eventos_semanal+200 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==14) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>499"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>999"));
$gold_check  = mssql_num_rows(mssql_query("Select accountid FROM CashShopData WHERE accountid = '$login' and goblinpoint>999"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest14=0 "));
$quest4_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest4=1 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($quest4_check <= 0) {$resultado= "<center><br>Você não completou a quest 4.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($gold_check   <= 0) {$resultado= "<center><br>Você não tem Golds suficientes.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest14=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000,eventos=eventos+200, eventos_mensal=eventos_mensal+200, eventos_semanal = eventos_semanal+200 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==15) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>499"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>999"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='34' and mapposx='100' and mapposy='236'"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest15=0 "));
$quest5_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest5=1 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));
$item_check  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x290036, items) %16=1) and accountid='$login'"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x120844, items) %16=1) and accountid='$login'"));

if     ($conta_check  <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($quest5_check <= 0) {$resultado= "<center><br>Você não completou a quest 5.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($mapa_check   <= 0) {$resultado= "<center><br>Você não está nas coordenadas corretas do mapa Crywolf.<br><br>"; } 
elseif ($item_check   <= 0) {$resultado= "<center><br>Você não tem uma Ancient Gloves no baú.<br><br>"; } 
elseif ($item_check1  <= 0) {$resultado= "<center><br>Você não tem uma Gran Soul Boots +1 no baú.<br><br>"; }
elseif ($online_check <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest15=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000,eventos=eventos+400, eventos_mensal=eventos_mensal+400, eventos_semanal = eventos_semanal+400 where name='$personagem' and accountid='$login'");

$resultado = 1;

}}

if ($verificar==16) {

$conta_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>999"));
$mreset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>500"));
$exp_check    = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>1999"));
$trofeu_check = mssql_num_rows(mssql_query("Select name FROM Mk_medalhas WHERE Name = '$personagem' and medal_smresets='1'"));
$quest_check  = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest16=0 "));
$quest12_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest12=1 "));
$quest13_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest13=1 "));
$online_check = mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check   <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check   <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($quest12_check <= 0) {$resultado= "<center><br>Você não completou a quest 12.<br><br>"; }
elseif ($quest13_check <= 0) {$resultado= "<center><br>Você não completou a quest 13.<br><br>"; }
elseif ($reset_check   <= 0) {$resultado= "<center><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($mreset_check  <= 0) {$resultado= "<center><br>Você não tem Master Resets suficientes.<br><br>"; }
elseif ($exp_check     <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($trofeu_check  <= 0) {$resultado= "<center><br>Você não tem a medalha de Master Resets semanal.<br><br>"; } 
elseif ($online_check  <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest16=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000,eventos=eventos+300, eventos_mensal=eventos_mensal+300, eventos_semanal = eventos_semanal+300 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinp = wcoinp + 2000 where accountid='$login'");

$resultado = 1;

}}

if ($verificar==17) {

$conta_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>599"));
$trofeu_check = mssql_num_rows(mssql_query("Select name FROM Mk_medalhas WHERE Name = '$personagem' and medal_tempo='1'"));
$item_check   = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x0FAF54, items) %16=1) and accountid='$login'"));
$quest_check  = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest17=0 "));
$quest1_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest1=1 "));
$quest2_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest2=1 "));
$quest3_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest3=1 "));
$quest4_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest4=1 "));
$quest5_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest5=1 "));
$online_check = mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check   <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check   <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($quest1_check  <= 0) {$resultado= "<center><br>Você não completou a quest 1.<br><br>"; }
elseif ($quest2_check  <= 0) {$resultado= "<center><br>Você não completou a quest 2.<br><br>"; }
elseif ($quest3_check  <= 0) {$resultado= "<center><br>Você não completou a quest 3.<br><br>"; }
elseif ($quest4_check  <= 0) {$resultado= "<center><br>Você não completou a quest 4.<br><br>"; }
elseif ($quest5_check  <= 0) {$resultado= "<center><br>Você não completou a quest 5.<br><br>"; }
elseif ($reset_check   <= 0) {$resultado= "<center><br>Você não tem Master Resets suficientes.<br><br>"; }
elseif ($item_check    <= 0) {$resultado= "<center><br>Você não tem uma Shining Scepter+5+luck+28+skill Option no baú.<br><br>"; } 
elseif ($trofeu_check  <= 0) {$resultado= "<center><br>Você não tem a medalha de Master Resets semanal.<br><br>"; } 
elseif ($online_check  <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest17=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000,eventos=eventos+300, eventos_mensal=eventos_mensal+300, eventos_semanal = eventos_semanal+300 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinp = wcoinp + 2000 where accountid='$login'");

$resultado = 1;

}}

if ($verificar==18) {

$conta_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>499"));
$exp_check    = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>14999"));
$item_check1  = mssql_num_rows(mssql_query("select items from warehouse where (charindex (0x2E2F5C, items) %16=1) and accountid='$login'"));
$quest_check  = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest18=0 "));
$quest6_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest6=1 "));
$quest7_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest7=1 "));
$quest8_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest8=1 "));
$quest9_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest9=1 "));
$quest10_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest10=1 "));
$online_check = mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check   <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check   <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($quest6_check  <= 0) {$resultado= "<center><br>Você não completou a quest 6.<br><br>"; }
elseif ($quest7_check  <= 0) {$resultado= "<center><br>Você não completou a quest 7.<br><br>"; }
elseif ($quest8_check  <= 0) {$resultado= "<center><br>Você não completou a quest 8.<br><br>"; }
elseif ($quest9_check  <= 0) {$resultado= "<center><br>Você não completou a quest 9.<br><br>"; }
elseif ($quest10_check <= 0) {$resultado= "<center><br>Você não completou a quest 10.<br><br>"; }
elseif ($exp_check     <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($reset_check   <= 0) {$resultado= "<center><br>Você não tem Master Resets suficientes.<br><br>"; }
elseif ($item_check1   <= 0) {$resultado= "<center><br>Você não tem uma Brave Armor(+5+luck+28 option) no baú.<br><br>"; } 
elseif ($online_check  <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest18=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000,eventos=eventos+300, eventos_mensal=eventos_mensal+300, eventos_semanal = eventos_semanal+300 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinp = wcoinp + 2000 where accountid='$login'");

$resultado = 1;

}}

if ($verificar==19) {

$conta_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>499"));
$exp_check    = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>199999"));
$quest11_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest11=1 "));
$quest12_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest12=1 "));
$quest13_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest13=1 "));
$quest14_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest14=1 "));
$quest15_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest15=1 "));
$mortes_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and Z_rankpk>'599'"));
$quest_check  = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest19=0 "));
$repu_check   = mssql_num_rows(mssql_query("Select login_r FROM mk_reputacao WHERE login_r='$login' and (select count(*) from mk_reputacao where login_r='$login' and reputacao='P')>49"));
$online_check = mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check   <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check   <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($quest11_check <= 0) {$resultado= "<center><br>Você não completou a quest 11.<br><br>"; }
elseif ($quest12_check <= 0) {$resultado= "<center><br>Você não completou a quest 12.<br><br>"; }
elseif ($quest13_check <= 0) {$resultado= "<center><br>Você não completou a quest 13.<br><br>"; }
elseif ($quest14_check <= 0) {$resultado= "<center><br>Você não completou a quest 14.<br><br>"; }
elseif ($quest15_check <= 0) {$resultado= "<center><br>Você não completou a quest 15.<br><br>"; }
elseif ($repu_check    <= 0) {$resultado= "<center><br>Você não tem Pontos de Reputação suficientes.<br><br>"; }
elseif ($mortes_check  <= 0) {$resultado= "<center><br>Você não tem mortes suficientes.<br><br>"; } 
elseif ($exp_check     <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($reset_check   <= 0) {$resultado= "<center><br>Você não tem Master Resets suficientes.<br><br>"; }
elseif ($online_check  <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest19=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+7000,eventos=eventos+2000, eventos_mensal=eventos_mensal+2000, eventos_semanal = eventos_semanal+2000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinp = wcoinp + 20000 where accountid='$login'");

$resultado = 1;

}}

if ($verificar==20) {

$conta_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$mreset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$exp_check    = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>24999"));
$eventos_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and eventos>199"));
$mapa_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='2' and mapposx='225' and mapposy='237'"));
$quest1_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest1=1 "));
$quest2_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest2=1 "));
$quest3_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest3=1 "));
$quest4_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest4=1 "));
$quest5_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest5=1 "));
$quest6_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest6=1 "));
$quest7_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest7=1 "));
$quest8_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest8=1 "));
$quest9_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest9=1 "));
$quest10_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest10=1 "));
$quest11_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest11=1 "));
$quest12_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest12=1 "));
$quest13_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest13=1 "));
$quest14_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest14=1 "));
$quest15_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest15=1 "));
$quest16_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest16=1 "));
$quest17_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest17=1 "));
$quest18_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest18=1 "));
$quest19_check= mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest19=1 "));
$quest_check  = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest20=0 "));
$online_check = mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check   <= 0) {$resultado= "<center><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check   <= 0) {$resultado= "<center><br>Você já completou essa Quest.<br><br>"; }
elseif ($quest1_check  <= 0) {$resultado= "<center><br>Você não completou a quest 1.<br><br>"; }
elseif ($quest2_check  <= 0) {$resultado= "<center><br>Você não completou a quest 2.<br><br>"; }
elseif ($quest3_check  <= 0) {$resultado= "<center><br>Você não completou a quest 3.<br><br>"; }
elseif ($quest4_check  <= 0) {$resultado= "<center><br>Você não completou a quest 4.<br><br>"; }
elseif ($quest5_check  <= 0) {$resultado= "<center><br>Você não completou a quest 5.<br><br>"; }
elseif ($quest6_check  <= 0) {$resultado= "<center><br>Você não completou a quest 6.<br><br>"; }
elseif ($quest7_check  <= 0) {$resultado= "<center><br>Você não completou a quest 7.<br><br>"; }
elseif ($quest8_check  <= 0) {$resultado= "<center><br>Você não completou a quest 8.<br><br>"; }
elseif ($quest9_check  <= 0) {$resultado= "<center><br>Você não completou a quest 9.<br><br>"; }
elseif ($quest10_check <= 0) {$resultado= "<center><br>Você não completou a quest 10.<br><br>"; }
elseif ($quest11_check <= 0) {$resultado= "<center><br>Você não completou a quest 11.<br><br>"; }
elseif ($quest12_check <= 0) {$resultado= "<center><br>Você não completou a quest 12.<br><br>"; }
elseif ($quest13_check <= 0) {$resultado= "<center><br>Você não completou a quest 13.<br><br>"; }
elseif ($quest14_check <= 0) {$resultado= "<center><br>Você não completou a quest 14.<br><br>"; }
elseif ($quest15_check <= 0) {$resultado= "<center><br>Você não completou a quest 15.<br><br>"; }
elseif ($quest16_check <= 0) {$resultado= "<center><br>Você não completou a quest 16.<br><br>"; }
elseif ($quest17_check <= 0) {$resultado= "<center><br>Você não completou a quest 17.<br><br>"; }
elseif ($quest18_check <= 0) {$resultado= "<center><br>Você não completou a quest 18.<br><br>"; }
elseif ($quest19_check <= 0) {$resultado= "<center><br>Você não completou a quest 19.<br><br>"; }
elseif ($mapa_check    <= 0) {$resultado= "<center><br>Você não está nas coordenadas corretas do mapa Davias.<br><br>"; } 
elseif ($eventos_check <= 0) {$resultado= "<center><br>Você não tem eventos suficientes.<br><br>"; } 
elseif ($exp_check     <= 0) {$resultado= "<center><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($mreset_check  <= 0) {$resultado= "<center><br>Você não tem Master Resets suficientes.<br><br>"; }
elseif ($online_check  <= 0) {$resultado= "<center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest20=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE mk_medalhas set medal_gm=1 where name='$personagem'");
$update= mssql_query("UPDATE CashShopData set wcoinp = wcoinp + 50000, wCoinC = wCoinC+100 where accountid='$login'");

$resultado = 1;

}}

if ($verificar==21) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>999"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='8' and mapposx='70' and mapposy='185'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='200'"));
$diario_check= mssql_num_rows(mssql_query("Select nome FROM top_diario WHERE Nome = '$personagem' and (tipo=1 or tipo=2)"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest21=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x70 y185 de Tarkan.<br><br>"; } 
elseif ($diario_check <= 4) {$resultado= "<center><b><br>Você não venceu 5x TOP Resets Diário.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest21=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+5,GoblinPoint=GoblinPoint+1000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','5','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==22) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>499"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='8' and mapposx='5' and mapposy='244'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='200'"));
$diario_check= mssql_num_rows(mssql_query("Select nome FROM top_diario WHERE Nome = '$personagem' and tipo=3"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest22=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x5 y244 de Tarkan.<br><br>"; } 
elseif ($diario_check <= 4) {$resultado= "<center><b><br>Você não venceu 5x TOP MResets Diário.<br><br>"; } 
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest22=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+5,GoblinPoint=GoblinPoint+1000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','5','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==23) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>999"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='0' and mapposx='125' and mapposy='125'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
$seman_check = mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=1 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest23=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x125 y125 de Lorencia.<br><br>"; } 
elseif ($seman_check  <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Resets Semanal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest23=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+7,GoblinPoint=GoblinPoint+1000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','7','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==24) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='0' and mapposx='125' and mapposy='125'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
$seman_check = mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=2 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest24=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x125 y125 de Lorencia.<br><br>"; } 
elseif ($seman_check  <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP MResets Semanal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest24=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+7,GoblinPoint=GoblinPoint+1000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','7','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==25) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>499"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='2' and mapposx='222' and mapposy='62'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
$seman_check = mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=3 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest25=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x222 y62 de Davias.<br><br>"; } 
elseif ($seman_check  <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Tempo Semanal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest25=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+7,GoblinPoint=GoblinPoint+1000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','7','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==26) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>499"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='2' and mapposx='222' and mapposy='62'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
$seman_check = mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=5 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest26=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x222 y62 de Davias.<br><br>"; } 
elseif ($seman_check  <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Mortes Semanal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest26=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+7,GoblinPoint=GoblinPoint+1000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','7','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==27) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and resetcount>499"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='7' and mapposx='141' and mapposy='71'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
$seman_check = mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=4 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest27=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem Resets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x141 y71 de Atlans.<br><br>"; } 
elseif ($seman_check  <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Eventos Semanal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest27=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+1000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+7,GoblinPoint=GoblinPoint+1000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','7','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==28) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='1' and mapposx='65' and mapposy='109'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>29999"));
$diario_check= mssql_num_rows(mssql_query("Select nome FROM top_diario WHERE Nome = '$personagem' and (tipo=1 or tipo=2)"));
$diari2_check= mssql_num_rows(mssql_query("Select nome FROM top_diario WHERE Nome = '$personagem' and tipo=3"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest28=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><b><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x65 y109 de Dungeon.<br><br>"; } 
elseif ($diario_check <= 9) {$resultado= "<center><b><br>Você não venceu 10x TOP Resets Diário.<br><br>"; }
elseif ($diari2_check <= 9) {$resultado= "<center><b><br>Você não venceu 10x TOP MResets Diário.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest28=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+2000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+7,GoblinPoint=GoblinPoint+1500 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','10','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==29) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='10' and mapposx='38' and mapposy='233'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>39999"));
$seman1_check= mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=1 and rank=1"));
$seman2_check= mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=2 and rank=1"));
$seman3_check= mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=3 and rank=1"));
$seman4_check= mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=4 and rank=1"));
$seman5_check= mssql_num_rows(mssql_query("Select nome FROM top_semanal WHERE Nome = '$personagem' and tipo=5 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest29=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><b><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x38 y233 de Icarus.<br><br>"; } 
elseif ($seman1_check <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Resets Semanal.<br><br>"; }
elseif ($seman2_check <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP MResets Semanal.<br><br>"; }
elseif ($seman3_check <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Tempo Semanal.<br><br>"; }
elseif ($seman4_check <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Eventos Semanal.<br><br>"; }
elseif ($seman5_check <= 2) {$resultado= "<center><b><br>Você não venceu 3x TOP Mortes Semanal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest29=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+50000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+50,GoblinPoint=GoblinPoint+30000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','50','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==30) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>2999"));
$mapa_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and mapnumber='0' and mapposx='34' and mapposy='232'"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='125'"));
//$agrade_check= mssql_fetch_row(mssql_query("Select agradecimentos FROM memb_info where memb___id = '$login'"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest30=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($mapa_check   <= 0) {$resultado= "<center><b><br>Você não está na coordenada x34 y232 de Lorencia.<br><br>"; } 
//elseif ($agrade_check<=999) {$resultado= "<center><b><br>Você não tem agradecimentos suficientes.<br><br>"; } 
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest30=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+10000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+10,GoblinPoint=GoblinPoint+10000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','10','$ip2','15')");

$resultado = 1;

}
}


if ($verificar==31) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='300'"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>9999"));
$seman1_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=3 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest31=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><b><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($seman1_check <= 1) {$resultado= "<center><b><br>Você não venceu 2x TOP Tempo Mensal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest31=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+10000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+20,GoblinPoint=GoblinPoint+10000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','20','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==32) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='300'"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>9999"));
$seman1_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=1 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest32=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><b><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($seman1_check <= 1) {$resultado= "<center><b><br>Você não venceu 2x TOP Resets Mensal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest32=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+10000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+20,GoblinPoint=GoblinPoint+10000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','20','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==33) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='300'"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>9999"));
$seman1_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=2 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest33=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><b><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($seman1_check <= 1) {$resultado= "<center><b><br>Você não venceu 2x TOP MResets Mensal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest33=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+10000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+20,GoblinPoint=GoblinPoint+10000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','20','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==34) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='300'"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>9999"));
$seman1_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=4 and rank=1"));
$seman2_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=5 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest34=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><b><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($seman1_check <= 1) {$resultado= "<center><b><br>Você não venceu 2x TOP Eventos Mensal.<br><br>"; }
elseif ($seman2_check <= 0) {$resultado= "<center><b><br>Você não venceu 1x TOP PK Mensal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest34=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+10000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+20,GoblinPoint=GoblinPoint+10000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','20','$ip2','15')");

$resultado = 1;

}
}

if ($verificar==35) {

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and masterresetcount>999"));
$clevel_check= mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and clevel='300'"));
$exp_check   = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login' and exp_war>9999"));
$seman1_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=3 and rank=1"));
$seman2_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=1 and rank=1"));
$seman3_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=2 and rank=1"));
$seman4_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=4 and rank=1"));
$seman5_check= mssql_num_rows(mssql_query("Select nome FROM top_mensal WHERE Nome = '$personagem' and tipo=5 and rank=1"));
$quest_check = mssql_num_rows(mssql_query("Select name from mk_quest WHERE Name = '$personagem' and quest35=0 "));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado= "<center><b><br>Esse Personagem não pertece a conta $login.<br><br>";}
elseif ($quest_check  <= 0) {$resultado= "<center><b><br>Você já completou essa Quest.<br><br>"; }
elseif ($reset_check  <= 0) {$resultado= "<center><b><br>Você não tem MResets suficientes.<br><br>"; }
elseif ($exp_check    <= 0) {$resultado= "<center><b><br>Você não tem Experiência suficiente.<br><br>"; } 
elseif ($seman1_check <= 0) {$resultado= "<center><b><br>Você não venceu 1x TOP Tempo Mensal.<br><br>"; }
elseif ($seman2_check <= 0) {$resultado= "<center><b><br>Você não venceu 1x TOP Resets Mensal.<br><br>"; }
elseif ($seman3_check <= 0) {$resultado= "<center><b><br>Você não venceu 1x TOP Mresets Mensal.<br><br>"; }
elseif ($seman4_check <= 0) {$resultado= "<center><b><br>Você não venceu 1x TOP Eventos Mensal.<br><br>"; }
elseif ($seman5_check <= 0) {$resultado= "<center><b><br>Você não venceu 1x TOP PK Mensal.<br><br>"; }
elseif ($clevel_check <= 0) {$resultado= "<center><b><br>Você não está no level correto.<br><br>"; } 
elseif ($online_check <= 0) {$resultado= "<center><b><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {

$update= mssql_query("UPDATE mk_quest set quest35=1,nivel=nivel+1 where name='$personagem'");
$update= mssql_query("UPDATE character set exp_war=exp_war+15000 where name='$personagem' and accountid='$login'");
$update= mssql_query("UPDATE CashShopData set wcoinC=wcoinC+100,GoblinPoint=GoblinPoint+10000 where accountid='$login'");
mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','20','$ip2','15')");

$resultado = 1;

}
}




$query = mssql_query( "Select quest1,quest2,quest3,quest4,quest5,quest6,quest7,quest8,quest9,quest10,quest11,quest12,quest13,quest14,quest15,quest16,quest17,quest18,quest19,quest20,quest21,quest22,quest23,quest24,quest25,quest26,quest27,quest28,quest29,quest30,quest31,quest32,quest33,quest34,quest35 from mk_quest where name='$personagem'" );
$quest = mssql_fetch_row($query);

$quest1  = $quest[0];
$quest2  = $quest[1];
$quest3  = $quest[2];
$quest4  = $quest[3];
$quest5  = $quest[4];
$quest6  = $quest[5];
$quest7  = $quest[6];
$quest8  = $quest[7];
$quest9  = $quest[8];
$quest10 = $quest[9];
$quest11 = $quest[10];
$quest12 = $quest[11];
$quest13 = $quest[12];
$quest14 = $quest[13];
$quest15 = $quest[14];
$quest16 = $quest[15];
$quest17 = $quest[16];
$quest18 = $quest[17];
$quest19 = $quest[18];
$quest20 = $quest[19];
$quest21 = $quest[20];
$quest22 = $quest[21];
$quest23 = $quest[22];
$quest24 = $quest[23];
$quest25 = $quest[24];
$quest26 = $quest[25];
$quest27 = $quest[26];
$quest28 = $quest[27];
$quest29 = $quest[28];
$quest30 = $quest[29];
$quest31 = $quest[30];
$quest32 = $quest[31];
$quest33 = $quest[32];
$quest34 = $quest[33];
$quest35 = $quest[34];


$requisito1="
<br>-10 ou + resetes.
<br>-10 ou + Pontos Experiência.
<br>-Estar no level 99(exatamente).
";
$premio1="
<br>-200 pontos de Experiência.
";

$requisito2="
<br>-70 ou + resetes.
<br>-70 ou + Pontos Experiência.
<br>-1 Double Blade Sword+5+Luck em seu baú.
<br>-Estar no level 349 (exatamente).
";
$premio2="
<br>-300 pontos de experiência.
";

$requisito3="
<br>-100 ou + resetes.
<br>-100 ou + Pontos Experiência.
<br>-1 Jewel of chaos,life,bless,soul e creation no baú.
<br>- Estar no level 251(exatamente).
";
$premio3="
<br>-450 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito4="
<br>-120 ou +  resetes.
<br>-50 ou +  Pontos Experiência.
<br>-Chaos Staff+5+luck+option 28 no baú.
<br>-Chaos Dragon Axe+5+luck+option 28 no baú.
<br>-Chaos Nature+5+luck+skill+option 28 bow no baú.
<br>-Estar no level 309(exatamente).
";
$premio4="
<br>-500 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito5="
<br>-200 ou + resetes.
<br>-100 ou + Pontos Experiência.
<br>-300 ou + mortes (pk)
";
$premio5="
<br>-700 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito6="
<br>-200 ou + resetes.
<br>-Katana(+4+option 16) no baú.
<br>-Legendary Staff(+3+option 16) no baú.
<br>-Legendary Shield Normal(+5+Luck) no baú.
<br>-Bone Helm No baú.
";
$premio6="
<br>-500 pontos de experiência.
<br>-500 pontos de eventos
";

$requisito7="
<br>-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Blood Fang +1,+2,+3,+4,+5,+6 e +7 no baú.
";
$premio7="
<br>-500 pontos de experiência.
<br>-600 pontos de eventos
";

$requisito8="
<br>-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Scroll of Archangel +1,+2,+3,+4,+5,+6 e +7 no baú.
";
$premio8="
<br>-500 pontos de experiência.
<br>-600 pontos de eventos
";

$requisito9="
<br>-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Devil Key +1,+2,+3,+4,+5 e +6 no baú.
";
$premio9="
<br>-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito10="
<br>-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Devil Eye +1,+2,+3,+4,+5 e +6 no baú.
";
$premio10="
<br>-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito11="
<br>-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-1 Bill of Balrog +0 no baú.
";
$premio11="
<br>-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito12="
<br>-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-1 Box of Kundun +1,+2,+3,+4,+5 no baú.
";
$premio12="
<br>-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito13="
<br>-350 ou + resetes.
<br>-200 ou + pontos de Experiência.
<br>-Ficar conectado 75 horas na semana.
";
$premio13="
<br>-200 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito14="
<br>-500 ou + Resetes.
<br>-1000 ou + pontos de Experiência.
<br>-Completar a quest 4.
<br>-1000 golds.
";
$premio14="
<br>-1000 pontos de experiência.
<br>-200 pontos de eventos.
";

$requisito15="
<br>-500 ou + Resetes.
<br>-1000 ou + pontos de Experiência.
<br>-Completar a quest 5.
<br>-Ancient Gloves +0 sem lucky No baú.
<bR>-Gran Soul Boots +1 sem lucky no baú.
<bR>-Ficar nas coordenadas 100x 236y do mapa Crywolf. 
";
$premio15="
<br>-1000 pontos de experiência.
<br>-400 pontos de eventos.
";

$requisito16="
<br>-500 ou + Master Resetes.
<br>-1000 ou + Resetes.
<br>-2000 ou + pontos de Experiência. 
<br>-Completar as quests 12 e 13. 
<br>-Ter a medalha de MReset semanal. 
";
$premio16="
<br>-1000 pontos de experiência. 
<br>-300 pontos de eventos. 
<br>-2000 MGolds.
";

$requisito17="
<br>-600 ou + Master Resetes.
<br>-1 Shining Scepter(+5+luck+28 Option+skill) no bau.
<br>-Completar as quests de 1 à 5.
<br>-Ter a medalha de Tempo online.
";
$premio17="
<br>-1000 pontos de experiência.
<br>-300 pontos de eventos.
<br>-2000 MGolds.
";

$requisito18="
<br>-500 ou + Master Resetes.
<br>-15000 ou + Pontos Experiência.
<br>-Brave Armor(+5+luck+28 option) Completo no baú.
<br>-Completar as quests de 6 à 10.
";
$premio18="
<br>-1000 pontos de experiência.
<br>-300 pontos de eventos.
<br>-2000 MGolds.
";

$requisito19="
<br>-500 ou + Master Resetes.
<br>-20000 Pontos Experiência.
<br>-600 mortes (pk).
<br>-50 Pontos de reputação.
<br>-Completar as quests de 11 à 15.
";
$premio19="
<br>-7.000 pontos de experiência.
<br>-2.000 pontos de eventos.
<br>-20.000 MGolds.
";

$requisito20="
<bR>-1000 ou + Master Resets
<br>-25000 ou + Pontos Experiência.
<br>-2000 ou + Eventos.
<br>-Ficar na coordenada x225 y237 do castelo de davias.
<br>-Completar todas as quests.
";
$premio20="
<br>-Medalha especial.
<br>-100 Créditos.
<br>-50.000 Master Golds.
";

$requisito21="
<bR>-1000 ou + Resets
<br>-Estar no level 200 (exatamente).
<bR>-Vencer 5x o Top Reset Diário.
<br>-Ficar na coordenada x70 y185 do tarkan.
";
$premio21="
<br>-5 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito22="
<bR>-500 ou + Master Resets
<br>-Estar no level 200 (exatamente).
<bR>-Vencer 5x o Top MReset Diário.
<br>-Ficar na coordenada x5 y244 do tarkan.
";
$premio22="
<br>-5 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito23="
<bR>-1000 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Resets Semanal.
<br>-Ficar na coordenada x125 y125 de lorencia.
";
$premio23="
<br>-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito24="
<bR>-1000 ou + MResets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top MResets Semanal.
<br>-Ficar na coordenada x125 y125 de Lorencia.
";
$premio24="
<br>-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito25="
<bR>-500 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Tempo Semanal.
<br>-Ficar na coordenada x222 y62 de Davias.
";
$premio25="
<br>-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito26="
<bR>-500 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Mortes Semanal.
<br>-Ficar na coordenada x222 y62 de Davias.
";
$premio26="
<br>-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito27="
<bR>-500 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Eventos Semanal.
<br>-Ficar na coordenada x141 y71 de Atlans.
";
$premio27="
<br>-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito28="
<bR>-1000 ou + MResets
<bR>-30000 ou + Pontos Experiência.
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 10x o Top Resets Diário.
<bR>-Vencer 10x o Top MResets Diário.
<br>-Ficar na coordenada x65 y109 de Dungeon.
";
$premio28="
<br>-10 créditos.
<br>-20.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito29="
<bR>-1000 ou + MResets
<bR>-40000 ou + Pontos Experiência.
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Resets Semanal.
<bR>-Vencer 3x o Top MResets Semanal.
<bR>-Vencer 3x o Top Tempo Semanal.
<bR>-Vencer 3x o Top Mortes Semanal.
<bR>-Vencer 3x o Top Eventos Semanal.
<br>-Ficar na coordenada x38 y233 de Icarus.
";
$premio29="
<br>-50 créditos.
<br>-50.000 pontos de experiência.
<br>-30.000 Golds.
";

$requisito30="
<bR>-3000 ou + MResets
<br>-Estar no level 125 (exatamente).
<br>-Ficar na coordenada x34 y232 de Lorencia.
";
$premio30="
<br>-10 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";
$requisito31="
<bR>-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top Tempo Mensal.
";
$premio31="
<br>-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito32="
<bR>-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top Resets Mensal.
";
$premio32="
<br>-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito33="
<bR>-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top MResets Mensal.
";
$premio33="
<br>-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito34="
<bR>-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top Eventos Mensal.
<bR>-Vencer 1x o Top PK Mensal.
";
$premio34="
<br>-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito35="
<bR>-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 1x o Top Tempo Mensal.
<bR>-Vencer 1x o Top Resets Mensal.
<bR>-Vencer 1x o Top Mresets Mensal.
<bR>-Vencer 1x o Top Eventos Mensal.
<bR>-Vencer 1x o Top PK Mensal.
";
$premio35="
<br>-100 créditos.
<br>-15.000 pontos de experiência.
<br>-10.000 Golds.
";

for($i=1;$i < 36;++$i)
{
$quests    = "quest$i";
$premio    = "premio$i";
$premio    = $$premio;
$requisito = "requisito$i";
$requisito = $$requisito;

if ($$quests==1) { $questON = "<font color=green size=2><b>	Quest Concluída	</font>"; }
     else        { $questON = "<a href=?personagem=$personagem&verif=$i><font size=2>Verificar Quest	</font></a>"; }

$resultadoOK = "";
if ($verificar==$i) 
{
	if ($resultado == 1)
	{
		$resultadoOK = "<font size=4 color=$font_color2>Quest concluída com sucesso!</font><Br><Br>	<font size=2><br>O Personagem <font color='green'>$personagem</font> recebeu:<br>$premio<br>";
	}
	else
	{
		$resultadoOK = "<font size=4 color=$font_color1>Quest não concluída!</font><Br><Br> <font color=$font_color1><b> $resultado </font></b>";
	}

}

Echo "
  <table width=600 cellspacing=0>
    <thead>
	<tr>
	   <th colspan=3>Quest nível $i</th>
	</tr>
	<tr>
	   <th>Emblema: </th>
	   <th>Requisitos: </th>
           <th>Prêmio:	</th>
	</tr>
    </thead>
	<tr>
	   <td> <img src=../img/medalhas/quest".$i."a.png> </td>
	   <td style='text-align:left;'> $requisito </td>
           <td style='text-align:left;'> $premio    </td>
	</tr>
	<tr>
	   <td colspan=3><br> <b> $questON <br><br></td>
	</tr>
	<tr style='background:transparent;'>
	   <td colspan=3 style='text-align:center;'><center><br> $resultadoOK <br></td>
	</tr>
  </table> <br><br>

 </font>

";
}
?>

JogandoMu by louis - www.mu-dravaryn.com.br