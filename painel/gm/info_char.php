<head>
  <link type="text/css" rel="stylesheet" href="../css/paginas.css">

        <script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(1300);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>
</head>

<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">
<br><Br><font size=3><b>INFO CHAR (STAFF)</font></b><br><br>

<?PHP
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 1;
require("../inclu/verif_nivel_gm.php");


if (!$_POST['name'])
	{
	  $name = $_GET['name'];
	}
 else 
	{
	  $name = $_POST['name'];
	}

IF ($name) {

$query_c = "select 
ConnectStat, 
ServerName,
CONVERT(VARCHAR(19),ConnectTM,120) as data,
CONVERT(VARCHAR(19),DisConnectTM,120) as data,
IP,
memb_stat.tempo,
character.accountid,
character.cLevel,
character.LevelUpPoint,
character.Class,
character.Strength,
character.Dexterity,
character.Vitality,
character.Energy,
character.Money,
character.MapNumber,
character.MapPosX,
character.MapPosY,
CONVERT(VARCHAR(19),character.MDate,120) as data,
character.CtlCode,
character.resetcount,
character.reset_diario,
character.reset_semanal,
character.reset_mensal,
character.masterresetcount,
character.mresets_diario,
character.mresets_semanal,
character.mreset_mensal,
character.exp_war,
character.patente,
character.tempo,
character.z_rankpk,
character.z_rankhr,
character.nivel_gm,
character.eventos,
memb_info.accountlevel,
CONVERT(VARCHAR(19),memb_info.accountexpiredate) as data2,
memb_info.whatsapp,
memb_info.img,
dbo.fn_online(name),
memb_info.bandeira,
dbo.fn_gens_contribution(name),
dbo.fn_gens_family(name),
dbo.fn_rank_gens(name,dbo.fn_gens_family(name)),
dbo.fn_rank_pos(name,1),
dbo.fn_rank_pos(name,2),
leadership
from memb_stat,character,memb_info
where
character.name = '$name' and
character.accountid=memb_stat.memb___id COLLATE database_default and
character.accountid=memb_info.memb___id COLLATE database_default";
$result_c = mssql_query( $query_c );
$row_c = mssql_fetch_row($result_c);

$dado0 = $row_c[0]; // connectstat
$dado3 = $row_c[1]; // servername
$dado4 = $row_c[2]; // connectTM

$dado4 = date_create("$dado4");
$dado4 = date_format($dado4, 'd-m-Y H:i:s');

$dado5 = $row_c[3]; // DisconnectTM
$dado5 = date_create("$dado5");
$dado5 = date_format($dado5, 'd-m-Y H:i:s');

$dado6 = $row_c[4]; // IP
$dado10= $row_c[5]; // tempo

$dado13= $row_c[6]; // acc
$dado14= $row_c[7]; // Level
$dado15= $row_c[8]; // Pontos a distribuir
$dado16= $row_c[9]; // Raça
$dado18= $row_c[10]; // força
$dado19= $row_c[11]; // agilidade
$dado20= $row_c[12]; // vida
$dado21= $row_c[13]; // energia
$dado22= $row_c[14]; // zen
$dado27= $row_c[15]; // mapa
$dado28= $row_c[16]; // cord x
$dado29= $row_c[17]; // cord y 
$dado33 = date_format(date_create("$row_c[18]"), 'd-m-Y H:i:s');
$dado34= $row_c[19]; // bloc code

$dado35= $row_c[20]; // resets
$dado68= $row_c[21]; // Resets Diario
$dado47= $row_c[22]; // reset semanal
$dado70= $row_c[23]; // Reset Mensal

$dado61= $row_c[24]; // mResets
$dado69= $row_c[25]; // MResets Diario
$dado62= $row_c[26]; // mResets Semanal
$dado72= $row_c[27]; // MReset Mensal

$dado39= $row_c[28]; // patentes
$dado73= $row_c[29]; // Patente
$dado44= $row_c[30]; // tempo
$dado46= $row_c[31]; // mortes total
$dado82= $row_c[32]; // hero total
$dado48= $row_c[33]; // nivel gm
$dado60= $row_c[34]; // eventos ganhos
$dado63= $row_c[35]; // VIP
$dado64= date_format(date_create("$row_c[36]"), 'd-m-Y H:i:s');
$dado67= $row_c[37]; // Whatsapp
$dado81= $row_c[38]; // img
$dado82= $row_c[39]; // img

$dado83= $row_c[40]; // bandeira

$gens_num     = $row_c[41]; // Gens
$gens_family  = $row_c[42]; // Gens
$gens_rank    = $row_c[43]; // Gens

$rank_resets  = $row_c[44]; // Gens
$rank_mresets = $row_c[45]; // Gens

$comando = $row_c[46]; // Comando

$patenten       = $row_c[38];

$nivel_gm_medal = $dado48;

if ($dado81){
$avatar ="/avatar/thumb.php?imagem=$dado81&y=100&x=100&qualidade=100";
}else{
$avatar ='/avatar/Icon-user.png';
}

$bandeira = '<img src=../../img/bandeiras30/00.png>';
if ($dado83){
$bandeira ="<img src=../../img/bandeiras30/$dado83.png>";
}


$whats = "Não informado.";
if (mssql_num_rows(mssql_query("Select memb___id from memb_info where memb___id='$dado13' and whatsapp is not null"))>0) {
$whats = "<img src=../../img/icon-whatsapp2.png> $dado67 <Br>";
}

$reset_mensal = $dado70;

$min =         $dado44;
$mapa =        $dado27;
$patente_num = $dado39;
$ctlco =       $dado34;
$class_char =  $dado16;
$niv      =    $dado48;

//$rank_resets  = mssql_fetch_row(mssql_query("select count(*) + 1 from character where nivel_gm < 2 and resetcount > ( SELECT resetcount from character where name = '$name' and nivel_gm < 2 ) "));
//$rank_mresets = mssql_fetch_row(mssql_query("select count(*) + 1 from character where nivel_gm < 2 and masterresetcount > ( SELECT masterresetcount from character where name = '$name' and nivel_gm < 2 ) "));

//if ($dado48>1) { 
//die("<br><br><center><font color=red>Você não pode ver informações sobre GMs e ADMs.</font>");
//}

$top_num_mensal = mssql_fetch_row(mssql_query("

SELECT 
count(case when tipo=1 and rank=1 then 1 end), 
count(case when tipo=1 and rank=2 then 1 end), 
count(case when tipo=1 and rank=3 then 1 end), 
count(case when tipo=2 and rank=1 then 1 end), 
count(case when tipo=2 and rank=2 then 1 end), 
count(case when tipo=2 and rank=3 then 1 end), 
count(case when tipo=3 and rank=1 then 1 end), 
count(case when tipo=3 and rank=2 then 1 end), 
count(case when tipo=3 and rank=3 then 1 end), 
count(case when tipo=4 and rank=1 then 1 end), 
count(case when tipo=4 and rank=2 then 1 end), 
count(case when tipo=4 and rank=3 then 1 end), 
count(case when tipo=5 and rank=1 then 1 end), 
count(case when tipo=5 and rank=2 then 1 end),
count(case when tipo=5 and rank=3 then 1 end)  
FROM top_mensal where nome='$name' 

"));

$top_num_semanal = mssql_fetch_row(mssql_query("

SELECT 
count(case when tipo=1 and rank=1 then 1 end), 
count(case when tipo=1 and rank=2 then 1 end), 
count(case when tipo=1 and rank=3 then 1 end), 
count(case when tipo=2 and rank=1 then 1 end), 
count(case when tipo=2 and rank=2 then 1 end), 
count(case when tipo=2 and rank=3 then 1 end), 
count(case when tipo=3 and rank=1 then 1 end), 
count(case when tipo=3 and rank=2 then 1 end), 
count(case when tipo=3 and rank=3 then 1 end), 
count(case when tipo=4 and rank=1 then 1 end), 
count(case when tipo=4 and rank=2 then 1 end), 
count(case when tipo=4 and rank=3 then 1 end), 
count(case when tipo=5 and rank=1 then 1 end), 
count(case when tipo=5 and rank=2 then 1 end),
count(case when tipo=5 and rank=3 then 1 end),
count(case when tipo=8 and rank=1 then 1 end), 
count(case when tipo=8 and rank=2 then 1 end), 
count(case when tipo=8 and rank=3 then 1 end), 
count(case when tipo=9 and rank=1 then 1 end), 
count(case when tipo=9 and rank=2 then 1 end), 
count(case when tipo=9 and rank=3 then 1 end), 
count(case when tipo=10 and rank=1 then 1 end), 
count(case when tipo=10 and rank=2 then 1 end), 
count(case when tipo=10 and rank=3 then 1 end)   
FROM top_semanal where nome='$name' 

"));


$diario_resets  = mssql_num_rows(mssql_query("select nome from TOP_diario where nome='$name' and (tipo=1 or tipo=2)"));
$diario_mresets = mssql_num_rows(mssql_query("select nome from TOP_diario where nome='$name' and tipo=3"));

$semanal_resets = $top_num_semanal[0];
$semanal_mresets= $top_num_semanal[3];
$semanal_tempo  = $top_num_semanal[6];
$semanal_eventos= $top_num_semanal[9];
$semanal_mortes = $top_num_semanal[12];
$semanal_ds	= $top_num_semanal[15];
$semanal_rei	= $top_num_semanal[18];
$semanal_bc	= $top_num_semanal[21];
$semanal_resets2 = $top_num_semanal[1];
$semanal_mresets2= $top_num_semanal[4];
$semanal_tempo2  = $top_num_semanal[7];
$semanal_eventos2= $top_num_semanal[10];
$semanal_mortes2 = $top_num_semanal[13];
$semanal_ds2	= $top_num_semanal[16];
$semanal_rei2	= $top_num_semanal[19];
$semanal_bc2	= $top_num_semanal[22];
$semanal_resets3 = $top_num_semanal[2];
$semanal_mresets3= $top_num_semanal[5];
$semanal_tempo3  = $top_num_semanal[8];
$semanal_eventos3= $top_num_semanal[11];
$semanal_mortes3 = $top_num_semanal[14];
$semanal_ds3	= $top_num_semanal[17];
$semanal_rei3	= $top_num_semanal[20];
$semanal_bc3	= $top_num_semanal[23];

$mensal_resets  = $top_num_mensal[0];
$mensal_mresets = $top_num_mensal[3];
$mensal_tempo   = $top_num_mensal[6];
$mensal_eventos = $top_num_mensal[9];
$mensal_mortes  = $top_num_mensal[12];
$mensal_resets2  = $top_num_mensal[1];
$mensal_mresets2 = $top_num_mensal[4];
$mensal_tempo2   = $top_num_mensal[7];
$mensal_eventos2 = $top_num_mensal[10];
$mensal_mortes2  = $top_num_mensal[13];
$mensal_resets3  = $top_num_mensal[2];
$mensal_mresets3 = $top_num_mensal[5];
$mensal_tempo3   = $top_num_mensal[8];
$mensal_eventos3 = $top_num_mensal[11];
$mensal_mortes3  = $top_num_mensal[14];


$result_quest = mssql_query("select nivel from mk_quest where name = '$name'");
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

$query = mssql_query( "Select quest1,quest2,quest3,quest4,quest5,quest6,quest7,quest8,quest9,quest10,quest11,quest12,quest13,quest14,quest15,quest16,quest17,quest18,quest19,quest20,quest21,quest22,quest23,quest24,quest25,quest26,quest27,quest28,quest29,quest30,quest31,quest32,quest33,quest34,quest35 from mk_quest where name='$name'" );
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

if ($nivel_gm_medal>1) {
$quest1  = 1;
$quest2  = 1;
$quest3  = 1;
$quest4  = 1;
$quest5  = 1;
$quest6  = 1;
$quest7  = 1;
$quest8  = 1;
$quest9  = 1;
$quest10 = 1;
$quest11 = 1;
$quest12 = 1;
$quest13 = 1;
$quest14 = 1;
$quest15 = 1;
$quest16 = 1;
$quest17 = 1;
$quest18 = 1;
$quest19 = 1;
$quest20 = 1;
$quest21 = 1;
$quest22 = 1;
$quest23 = 1;
$quest24 = 1;
$quest25 = 1;
$quest26 = 1;
$quest27 = 1;
$quest28 = 1;
$quest29 = 1;
$quest30 = 1;
$quest31 = 1;
$quest32 = 1;
$quest33 = 1;
$quest34 = 1;
$quest35 = 1;
}


include '../../inclu/classe.php';
include '../../inclu/tempo.php';
include '../../inclu/patentes.php';
include '../../inclu/gens.php';
include '../../inclu/mapas.php';
include '../../inclu/status_char.php';

$guild_query = "Select G_Name FROM GuildMember WHERE Name='$name'";
$guild_query2 = mssql_query( $guild_query );
$guildi = mssql_fetch_row($guild_query2);

$gmark = "SELECT G_Mark from guild where G_Name='$guildi[0]'" ;
$gresult = mssql_query($gmark);
$mark = mssql_fetch_row($gresult);

$logo = urlencode(bin2hex($mark [0]));

if ($mark){
$guild = "
<a href='info_guild_pop.php?server=$server&modelist=$guildi[0]'>
<img src='../../inclu/decode.php?decode=$logo' height=80 width=80><br><font size=3><B>$guildi[0]</a>";
}

$vip = "<font color='#CD0000' face=arial size=3><b>Free";
if ($dado63 == 1) { 
$vip = "<font color='green' face=arial size=3><b>VIP"; }
if ($dado63 == 2) { 
$vip = "Super VIP"; }
if ($dado63 == 3) { 
$vip = "Bonus VIP"; }

if (!$row_c) { 
echo "<br><br><center><font color=$font_color1 size=3>Esse Personagem não existe.</font>";
}

else {

$repu_select = mssql_fetch_row(mssql_query("

SELECT 
count(*), 
count(case when reputacao='P' then 1 end), 
count(case when reputacao='N' then 1 end) 
FROM mk_reputacao WHERE login_r='$dado13'

"));

$rep_check_t = $repu_select[0];
$rep_check_p = $repu_select[1];
$rep_check_n = $repu_select[2];

if ($rep_check_t > 0){ 

$rep = $rep_check_p*100;
$rep = bcdiv($rep ,$rep_check_t, 1);
$pontos_r= $rep_check_p-$rep_check_n;

if ($rep == 100){ 
$rank_p = "<img src=../../img/star.png><img src=../../img/star.png><img src=../../img/star.png><img src=../../img/star.png> ($rep%)</font>";
}
elseif ($rep > 89 and $rep < 100){ 
$rank_p = "<img src=../../img/star.png><img src=../../img/star.png><img src=../../img/star.png><img src=../../img/star.png> ($rep%)</font>";
}
elseif ($rep > 79 and $rep < 90){ 
$rank_p = "<img src=../../img/star.png><img src=../../img/star.png><img src=../../img/star.png><img src=../../img/star.png> ($rep%)</font>";
}
elseif ($rep > 59 and $rep < 80){ 
$rank_p = "<img src=../../img/star.png><img src=../../img/star.png><img src=../../img/star.png> ($rep%)</font>";
}
elseif ($rep > 39 and $rep < 60){ 
$rank_p = "<img src=../../img/star.png><img src=../../img/star.png> ($rep%)</font>";
}
elseif ($rep > 19 and $rep < 40){ 
$rank_p = "<img src=../../img/star.png> ($rep%)</font>";
}
elseif ($rep > 9 and $rep < 20){ 
$rank_p = "<img src=../../img/star.png> ($rep%)</font>";
}
elseif ($rep > 0 and $rep < 10){ 
$rank_p = "-- ($rep%)</font>";
}
else {
$rank_p = "-- ($rep%)</font>";
}
} else {
$rank_p = "--</font>";
$pontos_r=0;
}


if ($dado82 == 1) { 
$ONN = '<img src="../img/on2.gif" title="Online" alt="Online"></h3>';}
else { 
$ONN = '<img src="../img/off2.gif" title="Offline" alt="Offline"></h3>';}

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

$info_r = "<a href=\"info_reputacao.php?name=$name\">";

?>

<center>

<table width=720 border=0 cellspacing=0>

	<thead>
		<tr>
		  	<th colspan=5>Personagem</th>
		</tr>
	</thead>

		<tr>
			<td><b>Avatar:</td>
			<td width=200><b>Nome:</td>
			<td><b>Patente:</td>
			<td width=200><b>Tipo conta:</td>
		</tr>

		<tr>
			<td rowspan=9><img src=<?=$avatar;?> height=100 style='border: 1px solid #000000;height: 100px;' class=redondo2><br> <img src='<?=$class_ico;?>' style='border-radius: 5px; box-shadow: 0 3px 3px rgba(0,0,0,0.1);margin:10px;' width=100></td>
			<td><font color="#CD0000" face=arial size=3><b><?=$name;?></b></font></td>
			<td rowspan=9><font size=3><b><? echo $patente;?><bR><img src='../../img/<? echo $img;?>.jpg' style='border: 1px solid #000000;height: 155px;' class=redondo2> <bR> Exp: <? echo $patente_num;?></td>
			<td><? echo $vip;?></td>
		</tr>

		<tr>
			<td><b>Classe:</b></td>
			<td><b>Expira em:</td>
		</tr>

		<tr>
			<td><?=$class;?></td>
			<td><?=$dado64;?></td>
		</tr>

		<tr>
			<td><b>País:</b></td>
			<td><b>Conectou:</b></td>
		</tr>

		<tr>
			<td><?=$bandeira;?></td>
			<td><img src=../../img/arrow_up.gif width=13> <?=$dado4;?></td>
		</tr>

		<tr>
			<td><b>Whatsapp:</b></td>
			<td><b>Desconectou:</b></td>
		</tr>

		<tr>
			<td><?=$whats;?></td>
			<td><img src=../../img/arrow_down.gif width=13> <?=$dado5;?></td>
		</tr>

		<tr>
			<td><b>Status:</b></td>
			<td><b>Reputação ( <? echo $info_r;?>Ver</a> ):</b></td>
		</tr>

		<tr>
			<td><?=$ONN?></td>
			<td><?=$rank_p?></td>
		</tr>

	<thead>
		<tr>
		  	<th colspan=4>Dados do personagem</th>
		</tr>
	</thead>

		<tr>
			<td colspan=4>

<table width=169 cellspacing=0 style='float: left;margin:2px;'>

 <tr>
  <td><font size=3><b> M.Resets:</font></td>
  <td><font style='font: 15px LithosPro, Arial, sans-serif;'><B><? echo $dado61;?></td>
 </tr> 

 <tr>
  <td style='text-align:left;'><img src=../../img/cc4vwXD.png width=13> <font size=2>Posição:</font></td>
  <td><font size=2><B><? echo $rank_mresets;?>º</td>
 </tr> 

 <tr>
  <td style='text-align:left;'><img src=../../img/imgLetra-D.gif width=13> <font size=2> MR.Diário:</font></td>
  <td><font size=2><? echo $dado69;?></td>
 </tr> 

 <tr>
  <td style='text-align:left;'><img src=../../img/imgLetra-S.gif width=13> <font size=2>MR.Seman.:</font></td>
  <td><font size=2><? echo $dado62;?></td>
 </tr> 

 <tr>
  <td style='text-align:left;'><img src=../../img/imgLetra-M.gif width=13> <font size=2>MR.Mensal:</font></td>
  <td><font size=2><? echo $dado72;?></td>
 </tr>  

</table>

<table width=169 cellspacing=0 style='float: left;margin:2px;'>

 <tr>
  <td><font size=3><b>Resets:</font></td>
  <td><font style='font: 15px LithosPro, Arial, sans-serif;'><B><? echo $dado35;?></td>
 </tr> 

 <tr>
  <td style='text-align:left;'><img src=../../img/cc4vwXD.png width=13> <font size=2>Posição:</font></td>
  <td><font size=2><B><? echo $rank_resets;?>º</td>
 </tr> 


 <tr>
  <td style='text-align:left;'><img src=../../img/imgLetra-D.gif width=13> <font size=2>R.Diário:</font></td>
  <td><font size=2><? echo $dado68;?></td>
 </tr> 

 <tr>
  <td style='text-align:left;'><img src=../../img/imgLetra-S.gif width=13> <font size=2>R.Seman.:</font></td>
  <td><font size=2><? echo $dado47;?></td>
 </tr> 

 <tr>
  <td style='text-align:left;'><img src=../../img/imgLetra-M.gif width=13> <font size=2>R.Mensal:</font></td>
  <td><font size=2><? echo $reset_mensal;?></td>
 </tr>
</table>

<table width=169 cellspacing=0 style='float: left;margin:2px;'>

 <tr>
  <td style='text-align:left;'><img src=../../img/up.gif width=13> <font size=2>Level:</font></td>
  <td><font size=3><? echo $dado14;?></font></td>
 </tr>

 <tr>
  <td style='text-align:left;'><img src=../../img/balloon.gif width=13> <font size=2>Eventos:</td>
  <td><font size=2><? echo $dado60;?></td>
 </tr>

 <tr>
  <td style='text-align:left;'><img src=../../img/gold_coin.gif width=13> <font size=2>Hero:</td>
  <td><font size=2><? echo $dado82;?></td>
 </tr>

<tr>
  <td style='text-align:left;'><img src=../../img/dead2.gif width=13> <font size=2>Mortes:</td>
  <td><font size=2><? echo $dado46;?></td>
 </tr>

 <tr>
  <td style='text-align:left;'><img src=../../img/scroll.gif width=13> <font size=2>Situação:</td>
  <td><font size=2><? echo $ctlc;?>
  </td>
 </tr>


</table>

<table width=169 cellspacing=0 style='float: left;margin:2px;'>

 <tr>
  <td style='text-align:left;'><img src=../../img/barbell.gif width=13> <font size=2>Força:</font></td>
  <td><font size=3><? echo $forca;?></td>
 </tr>

 <tr>
  <td style='text-align:left;'><img src=../../img/body_run_away_right.gif width=13> <font size=2>Agilidade:</font></td>
  <td><font size=2><? echo $agilidade;?></td>
 </tr>

 <tr>
  <td style='text-align:left;'><img src=../../img/heart.gif width=13> <font size=2>Vida:</td>
  <td><font size=2><? echo $vitalidade;?></td>
 </tr>

 <tr>
  <td style='text-align:left;'><img src=../../img/lightningbolt.gif width=13> <font size=2>Energia:</td>
  <td><font size=2><? echo $energia;?></td>
 </tr>

 <tr>
  <td style='text-align:left;'><img src=../../img/scroll.gif width=13> <font size=2>Comando:</td>
  <td><font size=2><? echo $comando;?>
  </td>
 </tr>


</table>

			</td>
		</tr>


	<thead>
		<tr>
		  	<th colspan=4>Quests Realizadas (Total: <?=$quest_nivel;?>)</th>
		</tr>
	</thead>

		<tr>
			<td colspan=4>
			<?
			for($i=1;$i < 36;++$i)
			{
				$quests    = "quest$i";

				if ($$quests==1) 
				{ 
					$questON = "Quest Concluída";
		   			$aa = "a"; 
				}

	     			else        
				{ 
					$questON = "Quest Incompleta";
		   			$aa = ""; 
				}

				Echo " <img src=../../img/medalhas/quest".$i.$aa.".png width=35 title='Quest nível $i - $questON'>";
			}

			?>

			</td>
		</tr>

	<thead>
		<tr>
		  	<th colspan=2>Talismãs</th>
		  	<th colspan=2>Medalhas consquistadas</th>
		</tr>
	</thead>

		<tr>
			<td colspan=2>

				<img src='../../img/<? echo $talisma1;?>' width=65>
				<img src='../../img/<? echo $talisma2;?>' width=65>
				<img src='../../img/<? echo $talisma3;?>' width=65>
				<img src='../../img/<? echo $talisma4;?>' width=65>

			</td>

			<td colspan=2>

			<? 

				$medal_char = $name;
				include("../../inclu/medalhas.php");

				echo $medals;
			?>

			</td>
		</tr>

	<thead>
		<tr>
		  	<th colspan=4>Posição nos TOPS</th>
		</tr>
	</thead>

		<tr>
			<td colspan=2><center>
<table width=95%>
 <tr>
  <td><font size=3><b>TOP SEMANAL</td>
  <td align=right width=20><img src=../../img/icon-medal-gold.png>  </td>
  <td align=right width=20><img src=../../img/icon-medal-silver.png>  </td>
  <td align=right width=20><img src=../../img/icon-medal-bronze.png>  </td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Resets</td>
  <td align=right><b> <? echo $semanal_resets; ?> x</font>  &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_resets2; ?> x</font>   &nbsp; &nbsp; </td>
  <td align=right><b> <? echo $semanal_resets3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>M.Resets</td>
  <td align=right><b> <? echo $semanal_mresets; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_mresets2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_mresets3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Mortes</td>
  <td align=right><b> <? echo $semanal_mortes; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_mortes2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_mortes3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Tempo</td>
  <td align=right><b> <? echo $semanal_tempo; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_tempo2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_tempo3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Eventos</td>
  <td align=right><b> <? echo $semanal_eventos; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_eventos2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_eventos3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Devil Square</td>
  <td align=right><b> <? echo $semanal_ds; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_ds2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_ds3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Blood Castle</td>
  <td align=right><b> <? echo $semanal_bc; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_bc2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $semanal_bc3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>
</table>

			</td>

			<td colspan=2><center>

<table width=95%>
 <tr>
  <td><font size=3><b>TOP Mensal</td>
  <td align=right width=20><img src=../../img/icon-medal-gold.png>  </td>
  <td align=right width=20><img src=../../img/icon-medal-silver.png>  </td>
  <td align=right width=20><img src=../../img/icon-medal-bronze.png>  </td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Resets</td>
  <td align=right><b> <? echo $mensal_resets; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_resets2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_resets3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>M.Resets</td>
  <td align=right><b> <? echo $mensal_mresets; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_mresets2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_mresets3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Mortes</td>
  <td align=right><b> <? echo $mensal_mortes; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_mortes2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_mortes3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Tempo</td>
  <td align=right><b> <? echo $mensal_tempo; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_tempo2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_tempo3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>Eventos</td>
  <td align=right><b> <? echo $mensal_eventos; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_eventos2; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> <? echo $mensal_eventos3; ?> x</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>DIÁRIO - Resets</td>
  <td align=right><b> <? echo $diario_resets; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> --</font>    &nbsp; &nbsp;</td>
  <td align=right><b> --</font>    &nbsp; &nbsp;</td>
 </tr>

 <tr class='trbtborder'>
  <td style='text-align:left'><img src=../../img/seta.png width=13> <font size=2>DIÁRIO - Mresets</td>
  <td align=right><b> <? echo $diario_mresets; ?> x</font>    &nbsp; &nbsp;</td>
  <td align=right><b> --</font>    &nbsp; &nbsp;</td>
  <td align=right><b> --</font>    &nbsp; &nbsp;</td>
 </tr>
</table>

			</td>

		</tr>


	<thead>
		<tr>
		  	<th colspan=2>Informações da Guild</th>
		  	<th colspan=2>Informações da Família</th>
		</tr>
	</thead>

		<tr>
			<td colspan=2>

				<? echo $guild;?>

			</td>

			<td colspan=2>

			<? 

				if ($gens_family>0) 
				{
					echo "<font size=3><b>$gens_patente<br><img src=../../img/gens/$img_gens.png><br>$gens_num";
				}
				else
				{
					echo "Não está em nenhuma família.";
				}

?>



			</td>
		</tr>

	<thead>
		<tr>
		  	<th colspan=4>Outras informações</th>
		</tr>
	</thead>

		<tr>
			<td colspan=4>
				<font size=2><b>Esse char foi criado em <?=$dado33;?>. Conectado <?="$H3 hs $m m";?> essa semana.
			</td>
		</tr>

</table><br><br>


<? 

} 


if ($row_c) { 

$sql_char_check = mssql_query("SELECT Name,exp_war,patente FROM Character WHERE AccountID = '$dado13' order by resetcount desc,exp_war desc"); 
$char_check     = mssql_num_rows($sql_char_check); 

if ($char_check <= 0) 
{ 
	echo "<br><font size=3 color=$font_color1><b>Não existem personagens nessa Conta.</font></b>"; 
} 
else 
{
	echo "<b>Personagens dessa conta. Escolha o Personagem abaixo:</b><br><table cellspacing=8><tr>";

	for ($i=0;$i<$char_check; ++$i) {
		$row = mssql_fetch_row($sql_char_check);
		$patente_num = $row[1];
		$patenten    = $row[2];
		include ("../../inclu/patentes.php");

		if ($_GET[name]==$row[0]) $selecionado="red"; else $selecionado ="";

echo "<td width=70 bgcolor= '$selecionado' onclick=\"document.location.href='?name=$row[0]'\" onmouseover=\"this.style.backgroundColor='red'; this.style.cursor='pointer';\" onmouseout=\"this.style.background='$selecionado';\">

<div style='position: relative; left:-3; top:92;'><div style='z-index: 9; display: block; position: absolute; width: 78px; border:0px dotted black; text-align:center;'>
<center><table width='78' border='0' align='center' bgcolor=white cellspacing='0' cellpadding='0'>
  <tr>
    <td style='border: 1px solid #000000;'><center>
 <b>$row[0]</b></font>
     </td>
  </tr>
</table>
 </div></div>
<center>
<img src='../../img/$img.jpg' width=70 style='border:1px solid #000; margin-bottom:4px;'></td>";
	}

}
}

echo "</tr></table><br>IP dessa conta (clique para verificar outras contas com esse ip):<br><a href=?name=$name&verip=ok><font size=3><b>$dado6</b></font></a><br><br>";

if ($_GET[verip]){

$sql_char2_check = mssql_query("SELECT memb___id from memb_stat where ip='$dado6' and memb___id<>'$dado13'"); 
$char2_check = mssql_num_rows($sql_char2_check); 

if ($char2_check <= 0) { 
echo "<bR><bR><b>Não tem nenhuma outra conta com esse ip<br><br>";
} else {

for ($i=1;$i<=$char2_check; ++$i) {
$row2 = mssql_fetch_row($sql_char2_check);
$accip = $row2[0];

$sql_char_check = mssql_query("SELECT Name,exp_war,patente FROM Character WHERE AccountID = '$accip' order by resetcount desc,clevel desc"); 
$char_check = mssql_num_rows($sql_char_check); 

if ($char_check <= 0) 
{ 
	echo ""; 
} 
else 
{
	echo "<b>Conta $i:</b><br><table cellspacing=8><tr>";
	for ($i=0;$i<$char_check; ++$i) {
	$row = mssql_fetch_row($sql_char_check);
	$patente_num = $row[1];
	$patenten    = $row[2];
	include '../../inclu/patentes.php';

if ($_GET[name]==$row[0]) $selecionado="red"; else $selecionado ="";

echo "<td width=70 bgcolor= '$selecionado' onclick=\"document.location.href='?name=$row[0]'\" onmouseover=\"this.style.backgroundColor='red'; this.style.cursor='pointer';\" onmouseout=\"this.style.background='$selecionado';\">

<div style='position: relative; left:-3; top:92;'><div style='z-index: 9; display: block; position: absolute; width: 78px; border:0px dotted black; text-align:center;'>
<center><table width='78' border='0' align='center' bgcolor=white cellspacing='0' cellpadding='0'>
  <tr>
    <td style='border: 1px solid #000000;'><center>
 <b>$row[0]</b></font>
     </td>
  </tr>
</table>
 </div></div>
<center>
<img src='../../img/$img.jpg' width=70 style='border:1px solid #000; margin-bottom:4px;'></td>";
}
}
}
}
}

} else { 

echo "<br><br><center>

   <form name='form3' method='post' action=''>
<center><input name='name' type='text' id='name' maxlength='12' style='width:130;height:20;font-size:11px;text-align:center;' value=''>

    </form> </b><br><br> Coloque o nome do personagem acima."; 
} 


?>

</div>