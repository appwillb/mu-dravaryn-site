<div class="nf_title">
	<h3 class="lastmitems">Informações do Personagem <font color=red face=arial><b><? echo $name;?></b></font></h3>
</div>
<center>

<?PHP

if (!$_POST['name']){
$name = $_GET['name'];
}
else {
$name = $_POST['name'];
}

$query_c = "select 
ConnectStat, 
ServerName,
ConnectTM,
DisConnectTM,
IP,
memb_stat.tempo,
character.accountid,
character.cLevel,
character.LevelUpPoint,
character.Class,
character.Experience,
character.Strength,
character.Dexterity,
character.Vitality,
character.Energy,
character.Money,
character.Life,
character.MaxLife,
character.Mana,
character.MaxMana,
character.MapNumber,
character.MapPosX,
character.MapPosY,
character.PkCount,
character.PkLevel,
character.PkTime,
character.MDate,
character.CtlCode,
character.resets-1,
character.Pontos,
character.bloc_reason,
character.bloc_by,
character.exp_war,
character.evento,
character.evento_dia,
character.dia_bloc,
character.teste,
character.tempo,
character.dinheiro_gm,
character.mortes,
character.reset_semanal,
character.nivel_gm,
character.medal_evento,
character.medal_resets,
character.medal_sresets,
character.medal_mresets,
character.medal_smresets,
character.medal_tempo,
character.medal_pk,
character.medal_exp,
character.medal_gm,
character.medal_reputacao,
accountcharacter.gameidc,
character.eventos,
character.mresets,
character.mresets_semanal,
memb_info.vip,
memb_info.dias_vip,
memb_info.dias_svip,
memb_info.agradecimentos,
character.cred,
character.reset_diario,
character.mresets_diario,
character.reset_mensal,
character.resetfree_mensal,
character.mreset_mensal,
character.patente,
character.medal_tempo_m,
character.medal_resets_m,
character.medal_mresets_m,
character.medal_evento_m,
character.medal_pk_m,
character.patente
from memb_stat,character,accountcharacter,memb_info
where
character.name = '$name' and
character.accountid=memb_stat.memb___id COLLATE database_default and
character.accountid=accountcharacter.id COLLATE database_default and
character.accountid=memb_info.memb___id COLLATE database_default";
$result_c = mssql_query( $query_c );
$row_c = mssql_fetch_row($result_c);

$dado0 = $row_c[0]; // connectstat
$dado3 = $row_c[1]; // servername
$dado4 = $row_c[2]; // connectTM
$dado5 = $row_c[3]; // DisconnectTM
$dado6 = $row_c[4]; // IP
$dado10= $row_c[5]; // tempo

$dado13= $row_c[6]; // acc
$dado14= $row_c[7]; // Level
$dado15= $row_c[8]; // Pontos a distribuir
$dado16= $row_c[9]; // Raça
$dado17= $row_c[10]; // exp
$dado18= $row_c[11]; // força
$dado19= $row_c[12]; // agilidade
$dado20= $row_c[13]; // vida
$dado21= $row_c[14]; // energia
$dado22= $row_c[15]; // zen
$dado23= $row_c[16]; // vida pontos
$dado24= $row_c[17]; // max vida pontos
$dado25= $row_c[18]; // mana pontos
$dado26= $row_c[19]; // max mana pontos
$dado27= $row_c[20]; // mapa
$dado28= $row_c[21]; // cord x
$dado29= $row_c[22]; // cord y 
$dado30= $row_c[23]; // pk count
$dado31= $row_c[24]; // pk level
$dado32= $row_c[25]; // pk time
$dado33= $row_c[26]; // Criado dia
$dado34= $row_c[27]; // bloc code
$dado35= $row_c[28]; // resets
$dado36= $row_c[29]; // pontos eventos
$dado37= $row_c[30]; // razão do bloc
$dado38= $row_c[31]; // bloc por
$dado39= $row_c[32]; // patentes
$dado40= $row_c[33]; // evento gm total
$dado41= $row_c[34]; // evento gm dia
$dado42= $row_c[35]; // dia bloqueado
$dado43= $row_c[36]; // teste
$dado44= $row_c[37]; // tempo
$dado45= $row_c[38]; // dinheiro gm
$dado46= $row_c[39]; // mortes total
$dado47= $row_c[40]; // reset semanal
$dado48= $row_c[41]; // nivel gm
$dado49= $row_c[42]; // medal evento
$dado50= $row_c[43]; // medal reset
$dado51= $row_c[44]; // medal sreset
$dado52= $row_c[45]; // medal mreset
$dado53= $row_c[46]; // medal smreset
$dado54= $row_c[47]; // medal tempo
$dado55= $row_c[48]; // medal pk
$dado56= $row_c[49]; // medal exp
$dado57= $row_c[50]; // medal gm
$dado58= $row_c[51]; // nivel reputacao
$dado60= $row_c[53]; // eventos ganhos
$dado61= $row_c[54]; // mResets
$dado62= $row_c[55]; // mResets Semanal

$dado63= $row_c[56]; // VIP
$dado64= $row_c[57]; // Dias VIP
$dado65= $row_c[58]; // Dias SVIP
$dado66= $row_c[59]; // Agradecimentos
$dado67= $row_c[60]; // Dias Créditos

$dado68= $row_c[61]; // Resets Diario
$dado69= $row_c[62]; // MResets Diario
$dado70= $row_c[63]; // Reset Mensal
$dado71= $row_c[64]; // Reset Free Mensal
$dado72= $row_c[65]; // MReset Mensal
$dado73= $row_c[66]; // Patente
$dado74= $row_c[67]; // medal tempo mensal
$dado75= $row_c[68]; // medal resets mensal
$dado76= $row_c[69]; // medal mresets mensal
$dado77= $row_c[70]; // medal eventos mensal
$dado78= $row_c[71]; // medal pk mensal
$patenten       = $row_c[72];

//SISTEMA DO MURKUT
$sql_dados = mssql_query("SELECT nome,convert(varchar, nascimento, 103),img,msn,perfil,cidade,datediff(yy, nascimento, getdate()) as Idade,id,disable_chat,disable_lista_amigos FROM Murkut WHERE login='$dado13'"); 
$login_dados = mssql_fetch_row($sql_dados);

if ($login_dados) {
if ($login_dados[2]){
$avatar = "thumb.php?imagem=$login_dados[2]&y=50&x=50&qualidade=100";
}else{
$avatar ='Icon-user.png';
}
}
else {
$avatar ='Icon-user.png';
}

//FIM

$reset_mensal = $dado70;

$dado67 = 100-$dado67;

$min =         $dado44;
$mapa =        $dado27;
$patente_num = $dado39;
$ctlco =       $dado34;
$class_char =  $dado16;
$niv      =    $dado48;
$pk_level =    $dado31;

//if ($dado48>1) { 
//die("<br><br><center><font color=orange>Você não pode ver informações sobre GMs e ADMs.</font>");
//}

if ($name=='webzen') { 
die("<br><br><img src=img/palam.gif>");
}

$n_fotos = mssql_num_rows(mssql_query("select id_foto from murkut_fotos where login = '$dado13'"));
$diario_resets  = mssql_num_rows(mssql_query("select nome from TOP_diario where nome='$name' and (tipo=1 or tipo=2)"));
$diario_mresets = mssql_num_rows(mssql_query("select nome from TOP_diario where nome='$name' and tipo=3"));
$semanal_resets = mssql_num_rows(mssql_query("select nome from TOP_semanal where nome='$name' and tipo=1"));
$semanal_mresets= mssql_num_rows(mssql_query("select nome from TOP_semanal where nome='$name' and tipo=2"));
$semanal_tempo  = mssql_num_rows(mssql_query("select nome from TOP_semanal where nome='$name' and tipo=3"));
$semanal_eventos= mssql_num_rows(mssql_query("select nome from TOP_semanal where nome='$name' and tipo=4"));
$semanal_mortes = mssql_num_rows(mssql_query("select nome from TOP_semanal where nome='$name' and tipo=5"));
$mensal_resets  = mssql_num_rows(mssql_query("select nome from TOP_mensal where nome='$name' and tipo=1"));
$mensal_mresets = mssql_num_rows(mssql_query("select nome from TOP_mensal where nome='$name' and tipo=2"));
$mensal_tempo   = mssql_num_rows(mssql_query("select nome from TOP_mensal where nome='$name' and tipo=3"));
$mensal_eventos = mssql_num_rows(mssql_query("select nome from TOP_mensal where nome='$name' and tipo=4"));
$mensal_mortes  = mssql_num_rows(mssql_query("select nome from TOP_mensal where nome='$name' and tipo=5"));


$repu_check = mssql_num_rows(mssql_query("select name from character where accountid='$dado13' and medal_reputacao=1"));


If ($dado49==1){
$medal_evento = "<img src='http://mukoreia.net/img/medals/medal_41.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Eventos'>";
$mm='Medalhas:';}

If ($dado50 ==1){
$medal_reset = "<img src='http://mukoreia.net/img/medals/medal_46.gif' title='Você ganha esse Prêmio se ficar pelo menos 1 dia em primeiro no ranking de Resets'>";
$mm='Medalhas:';}

If ($dado51==1){
$medal_sreset = "<img src='http://mukoreia.net/img/medals/medal_51.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Resets'>";
$mm='Medalhas:';}

If ($dado52 ==1){
$medal_mreset = "<img src='http://mukoreia.net/img/medals/medal_55.gif' title='Você ganha esse Prêmio se ficar pelo menos 1 dia em primeiro no ranking de Master Resets'>";
$mm='Medalhas:';}

If ($dado53==1){
$medal_smreset = "<img src='http://mukoreia.net/img/medals/medal_44.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Master Resets'>";
$mm='Medalhas:';}

If ($dado54==1){
$medal_tempo = "<img src='http://mukoreia.net/img/medals/medal_43.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Tempo'>";
$mm='Medalhas:';}

If ($dado55==1){
$medal_pk = "<img src='http://mukoreia.net/img/medals/medal_38.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Mortes'>";
$mm='Medalhas:';}

If ($dado56==1){
$medal_exp = "<img src='http://mukoreia.net/img/medals/medal_60.gif' title='Você ganha esse Prêmio se ficar pelo menos 1 dia em primeiro no ranking de Patentes(exp)'>";
$mm='Medalhas:';}

If ($dado57==1){
$medal_gm = "<img src='http://mukoreia.net/img/medals/medal_37.gif' title='Você ganha esse Prêmio se fizer as 20 primeiras quests do site'>";
$mm='Medalhas:';}

If ($repu_check>0){
$medal_reputacao = "<img src='http://mukoreia.net/img/medals/medal_61.gif' title='Você ganha esse Prêmio se conseguir a melhor reputação(quantidade de votos positivos menos votos negativos, o total tem que ser o maior do server)'>";
$mm='Medalhas:';}

If ($dado74==1){
$medal_tempo_m = "<img src='http://mukoreia.net/img/medals/medal_12.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Tempo'>";
$mm='Medalhas:';}

If ($dado75==1){
$medal_resets_m = "<img src='http://mukoreia.net/img/medals/medal_13.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Resets'>";
$mm='Medalhas:';}

If ($dado76==1){
$medal_mresets_m = "<img src='http://mukoreia.net/img/medals/medal_57.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Master Resets'>";
$mm='Medalhas:';}

If ($dado77==1){
$medal_eventos_m = "<img src='http://mukoreia.net/img/medals/medal_18.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Eventos'>";
$mm='Medalhas:';}

If ($dado78==1){
$medal_pk_m = "<img src='http://mukoreia.net/img/medals/medal_48.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Mortes'>";
$mm='Medalhas:';}

$result_quest = mssql_query("select nivel from quest where name = '$name'");
$quest_nivel  = mssql_fetch_row($result_quest);
$quest_nivel  = $quest_nivel[0]; 

$talisma1 = "pendante_gray.png";
$talisma2 = "pendante_gray.png";
$talisma3 = "pendante_gray.png";
$talisma4 = "pendante_gray.png";

if (!$quest_nivel){
$quest_nivel = 0;
}
if ($quest_nivel > 9 or $dado48 > 1){
$talisma1 = "pendante1.png";
}
if ($quest_nivel > 14 or $dado48 > 1){
$talisma2 = "pendante2.png";
}
if ($quest_nivel > 19 or $dado48 > 1){
$talisma3 = "pendante3.png";
}
if ($quest_nivel > 24 or $dado48 > 1){
$talisma4 = "pendante4.png";
}

$query = mssql_query( "Select quest1,quest2,quest3,quest4,quest5,quest6,quest7,quest8,quest9,quest10,quest11,quest12,quest13,quest14,quest15,quest16,quest17,quest18,quest19,quest20,quest21,quest22,quest23,quest24,quest25,quest26,quest27,quest28,quest29,quest30,quest31,quest32,quest33,quest34,quest35 from quest where name='$name'" );
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



include 'inclu/classe.php';
include 'inclu/tempo.php';
include 'inclu/patentes.php';
include 'inclu/mapas.php';
include 'inclu/status_char.php';
include 'inclu/lvl_pk.php';

if($dado34<>1){
$dado37= '';
$dado38= '';
$dado42= '';
}

$guild_query = "Select G_Name FROM GuildMember WHERE Name='$name'";
$guild_query2 = mssql_query( $guild_query );
$guildi = mssql_fetch_row($guild_query2);

$gmark = "SELECT G_Mark from guild where G_Name='$guildi[0]'" ;
$gresult = mssql_query($gmark);
$mark = mssql_fetch_row($gresult);

$logo = urlencode(bin2hex($mark [0]));

if ($mark){
$guild = "<a href=info_guild.php?modelist=$guildi[0]></b><img src='inclu/decode.php?decode=$logo' height=50 width=50><br><B>$guildi[0]</a>";
}

if ($dado63 == 1) { 
$vip = "<img src=img/selo_vip.png title='User VIP'>"; }

if ($dado63 == 1 and $dado65 > 0) { 
$vip = "<img src=img/selo_svip.png title='User Super VIP'>"; }

if ($dado63 == 0) { 
$vip = ""; }

if (!$row_c) { 
die("<br><br><center><font color=red>Esse Personagem não existe.</font>");
}

$rep_check_t = mssql_num_rows(mssql_query("select login from reputacao WHERE login_r='$dado13'"));
$rep_check_p = mssql_num_rows(mssql_query("select login from reputacao WHERE login_r='$dado13' and reputacao='P'"));
$rep_check_n = mssql_num_rows(mssql_query("select login from reputacao WHERE login_r='$dado13' and reputacao='N'"));

if ($rep_check_t > 0){ 

$rep = $rep_check_p*100;
$rep = bcdiv($rep ,$rep_check_t, 1);
$pontos_r= $rep_check_p-$rep_check_n;

if ($rep == 100){ 
$rank_p = "<img src=img/star.png><img src=img/star.png><img src=img/star.png><img src=img/star.png><br> ($rep%)</font>";
}
elseif ($rep > 89 and $rep < 100){ 
$rank_p = "<img src=img/star.png><img src=img/star.png><img src=img/star.png><img src=img/star.png><br> ($rep%)</font>";
}
elseif ($rep > 79 and $rep < 90){ 
$rank_p = "<img src=img/star.png><img src=img/star.png><img src=img/star.png><img src=img/star.png><br> ($rep%)</font>";
}
elseif ($rep > 59 and $rep < 80){ 
$rank_p = "<img src=img/star.png><img src=img/star.png><img src=img/star.png><br> ($rep%)</font>";
}
elseif ($rep > 39 and $rep < 60){ 
$rank_p = "<img src=img/star.png><img src=img/star.png><br> ($rep%)</font>";
}
elseif ($rep > 19 and $rep < 40){ 
$rank_p = "<img src=img/star.png><br> ($rep%)</font>";
}
elseif ($rep > 9 and $rep < 20){ 
$rank_p = "<img src=img/star.png><br> ($rep%)</font>";
}
elseif ($rep > 0 and $rep < 10){ 
$rank_p = "-- <br>($rep%)</font>";
}
else {
$rank_p = "--<br> ($rep%)</font>";
}
} else {
$rank_p = "--</font>";
$pontos_r=0;
}


$sql_pw_check = mssql_query("select GameIDC from AccountCharacter WHERE id='$dado13' and GameIDC='$name'");
$pw_check = mssql_num_rows($sql_pw_check); 

if ($dado0 == 1) { 
$onn = '<img src=img/icon_user_online.gif>';}
if (($dado0 == 0) || ($pw_check <= 0)) { 
$onn = '<img src=img/icon_user_offline.png>';}

$forca = $dado18;
if ($forca<0) {
$forca = 65536+$dado18;
}
$agilidade = $dado19;
if ($agilidade<0) {
$agilidade = 65536+$dado19;
}
$vitalidade = $dado20;
if ($vitalidade<0) {
$vitalidade = 65536+$dado20;
}
$energia = $dado21;
if ($energia<0) {
$energia = 65536+$dado21;
}

?>

<center>
<table border = 0 align=center width=520>

<tr><td rowspan=2 width=130 valign=top>
<table width=100%><tr><td><img src=<? echo "$servidor";?>/avatar/<? echo "$avatar";?> height=50></td><td valign=top>
  <a href=info_album.php?name=<? echo "$name";?>><img src=painel/img/PhotoAlbumIcon.gif width=20> <font style='font: 12px LithosPro, Arial, sans-serif;'>Fotos </a><br>
  <a href=info_video.php?name=<? echo "$name";?>><img src=painel/img/video_icon.png width=20> <font style='font: 12px LithosPro, Arial, sans-serif;'>Videos</a><br>
</td></tr>
<tr><td colspan=2><center>
 <? echo $onn; ?> <? echo $vip; ?></td></tr></table>
<div style='position: relative; left:0; top:155;'><div style='z-index: 9; display: block; position: absolute; width: 130px; border:0px dotted #ffe6cb; text-align:center;'>
<center><table width='130' border='0' align='center' bgcolor=black cellspacing='0' cellpadding='0'>
  <tr>
    <td style='border: 1px solid #ffe6cb;' height=40><center>
 <b><font size=2>
<? echo "$class";?></b><br><? echo $patente;?> (<? echo $patente_num;?>)</font>
     </td>
  </tr>
</table>
 </div></div>
<center>
<img src='http://mukoreia.net/img/<? echo $img;?>.jpg' width='120' style='border: 1px solid #ffe6cb;'> <br><br>

<table>
 <tr>
  <td><img src=img/arrow_up.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Conectou:</td>
 </tr> <tr>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado4;?></td>
 </tr> 

 <tr>
  <td><img src=img/arrow_down.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Disconectou:</td>
 </tr> <tr>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado5;?></td>
 </tr>

</table>
<bR>
<font style='font: 11px LithosProBold, Arial, sans-serif;'><a href="info_reputacao.php?name=<? echo $name;?>">Reputação:</a><br>
<? echo $rank_p ?><br><br>


<? echo $guild;?>

</td>
<td valign=top>

<table width=95% cellspacing=1 align=center>

 <tr>
  <td><img src=img/up.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Level:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado14;?></font></td>
 </tr>

 <tr>
  <td><img src=img/th_money2.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Dinheiro:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado22;?></td>
  </tr>

 <tr>
  <td><img src=img/barbell.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Força:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $forca;?></td>
 </tr>

 <tr>
  <td><img src=img/body_run_away_right.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Agilidade:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $agilidade;?></td>
 </tr>

 <tr>
  <td><img src=img/heart.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Vida:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $vitalidade;?></td>
 </tr>

 <tr>
  <td><img src=img/lightningbolt.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Energia:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $energia;?></td>
 </tr>

 <tr>
  <td><img src=img/balloon.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Eventos:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado60;?></td>
 </tr>

 <tr>
  <td><img src=img/gold_coin.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Golds:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado36;?></td>
 </tr>

 <tr>
  <td><img src=img/yinyang.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>PK Level:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $pk;?>
  </td>
 </tr>

<tr>
  <td><img src=img/dead2.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Mortes Total:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado46;?></td>
 </tr>

 <tr>
  <td><img src=img/icon-google-map.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Mapa:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $map;?>
  </td>
 </tr> 

 <tr>
  <td><img src=img/scroll.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Status Char:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $ctlc;?>
  </td>
 </tr>

 <tr>
  <td><img src=img/laptop.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Servidor:</td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado3;?></td>
 </tr>

 <tr>
  <td><img src=img/thumbsup.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>Agradecido:</a></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $dado66; ?> x </font>
  </td>
 </tr>


</table>

<td valign=top>

<table width=90% cellspacing=0>

 <tr>
  <td><font style='font: 13px LithosProBold, Arial, sans-serif;'>Resets:</font></td>
  <td><font style='font: 13px LithosPro, Arial, sans-serif;'><? echo $dado35;?></td>
 </tr> 

 <tr>
  <td><img src=img/imgLetra-D.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>R.Diário:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado68;?></td>
 </tr> 

 <tr>
  <td><img src=img/imgLetra-S.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>R.Seman.:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado47;?></td>
 </tr> 

 <tr>
  <td><img src=img/imgLetra-M.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>R.Mensal:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $reset_mensal;?></td>
 </tr>

</table>

<br>

<table width=90% cellspacing=0>

 <tr>
  <td><font style='font: 13px LithosProBold, Arial, sans-serif;'>M.Resets:</font></td>
  <td><font style='font: 13px LithosPro, Arial, sans-serif;'><? echo $dado61;?></td>
 </tr> 

 <tr>
  <td><img src=img/imgLetra-D.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>MR.Diário:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado69;?></td>
 </tr> 

 <tr>
  <td><img src=img/imgLetra-S.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>MR.Seman.:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado62;?></td>
 </tr> 

 <tr>
  <td><img src=img/imgLetra-M.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>MR.Mensal:</font></td>
  <td><font style='font: 11px LithosPro, Arial, sans-serif;'><? echo $dado72;?></td>
 </tr>  

</table>

<center><br>
Faltam <b><? echo $dado67; ?></b> Resets ou Mresets<br> para ganhar 1 crédito!<bR>

<tr><td valign=top colspan=2>

<table width=100% cellspacing=0 border=0>
<tR><td>

<table width=100%>
 <tr>
  <td><img src=img/imgLetra-D.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Resets Diario:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $diario_resets; ?> x</font>
  </td>
 </tr>


 <tr>
  <td><img src=img/imgLetra-S.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Resets Semanal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $semanal_resets; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-S.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP MResets Semanal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $semanal_mresets; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-S.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Mortes Semanal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $semanal_mortes; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-S.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Tempo Semanal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $semanal_tempo; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-S.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Eventos Semanal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $semanal_eventos; ?> x</font>
  </td>
 </tr>

</td><td>

</table>


</td><td>

<table width=100%>

 <tr>
  <td><img src=img/imgLetra-D.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP MResets Diario:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $diario_mresets; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-M.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Resets Mensal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $mensal_resets; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-M.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP MResets Mensal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $mensal_mresets; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-M.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Mortes Mensal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $mensal_mortes; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-M.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Tempo Mensal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $mensal_tempo; ?> x</font>
  </td>
 </tr>

 <tr>
  <td><img src=img/imgLetra-M.gif width=13> <font style='font: 11px LithosProBold, Arial, sans-serif;'>TOP Eventos Mensal:</td>
  <td align=right><font style='font: 11px LithosPro, Arial, sans-serif;'> <? echo $mensal_eventos; ?> x</font>
  </td>
 </tr>

</table>

</td></tr>

</table>

<center>
 <font style='font: 11px LithosProBold, Arial, sans-serif;'>Medalhas:<br>

<? echo $medal_evento;?>
<? echo $medal_reset;?>
<? echo $medal_sreset;?>
<? echo $medal_mreset;?>
<? echo $medal_smreset;?>
<? echo $medal_tempo;?>
<? echo $medal_pk;?>
<? echo $medal_exp;?>
<? echo $medal_gm;?>
<? echo $medal_reputacao;?>
<? echo $medal_tempo_m;?>
<? echo $medal_resets_m;?>
<? echo $medal_mresets_m;?>
<? echo $medal_eventos_m;?>
<? echo $medal_pk_m;?>
<br>
<br>

</td></tr>

</table>

<table width=520>

<tr><td width=200><center>
<font style='font: 13px LithosProBold, Arial, sans-serif;'>Talismas </font>
</td>

<td><center>
<font style='font: 13px LithosProBold, Arial, sans-serif;'>Quests Realizadas (<? echo $quest_nivel;?>)</font>
</td>

</tr>

<tr><td width=200><center>
<img src='http://mukoreia.net/img/<? echo $talisma1;?>' width=80>
<img src='http://mukoreia.net/img/<? echo $talisma2;?>' width=80><br>
<img src='http://mukoreia.net/img/<? echo $talisma3;?>' width=80>
<img src='http://mukoreia.net/img/<? echo $talisma4;?>' width=80>
</td>

<td>

<?
for($i=1;$i < 36;++$i)
{
$quests    = "quest$i";

if ($$quests==1) { $questON = "Quest Concluída";
		   $aa = "a"; }
     else        { $questON = "Quest Incompleta";
		   $aa = ""; }

Echo " <img src=http://mukoreia.net/img/medalhas/quest".$i.$aa.".png width=35 title='Quest nível $i - $questON'>";
}
?>


</td>

</tr>

</table>

<center><font size=2>Esse char foi criado em <? echo $dado33;?>. Conectado <? echo "$H3 hs $m m";?> essa semana!<br>

</html>