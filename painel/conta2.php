<div id="container">
<meta http-equiv='Content-Type' content='text/html;charset=iso-8859-1'>
<head>
<title>.::Painel MU Dravaryn::.</title>

  <link type="text/css" rel="stylesheet" href="css/main.css">
  <link type="image/x-icon" rel="shortcut icon" href="favicon.ico">

</head>

<script language="javascript">
function showTooltip(id) { 
document.getElementById(id).style.visibility = "visible"; 
} 
function hideTooltip(id) { 
document.getElementById(id).style.visibility = "hidden"; 
} 
</script>

<body leftmargin='0' topmargin='0' bottommargin='0' bgcolor=black>
	<script type="text/javascript" src="inclu/tooltip.js"></script>

<?PHP

require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET[msg_viu])
	{		
		mssql_query("update memb_info set msg_viu=1,msg_num=msg_num+1 where memb___id='$login' and msg_viu=0");	
	}

$query12 = "select 
s.ConnectStat,
s.tempo_vip,
s.connecttm,
m.mail_addr,
CONVERT(VARCHAR(19),m.AccountExpireDate,120) as data,
m.AccountLevel,
m.msg_num,
m.msg_viu,
m.missoes,
m.bloc_code,
m.img,
dbo.fn_wc(m.memb___id),
dbo.fn_wp(m.memb___id),
dbo.fn_gp(m.memb___id),
dbo.fn_mudar_mail(m.memb___id),
dbo.fn_nivel_gm(m.memb___id)
from
memb_stat s,memb_info m
where
m.memb___id='$login' and
m.memb__pwd = '$psw' and
s.memb___id=m.memb___id";
$result12 = mssql_query( $query12 );
$row = mssql_fetch_row($result12);

$min2     	= $row[1];
$ultima   	= $row[2];
$mail     	= $row[3];
$vip_time 	= date_format(date_create("$row[4]"), 'd-m-Y');
$vip      	= $row[5];
$num_msg  	= $row[6];
$msg_viu  	= $row[7];
$nmissoes 	= $row[8]-1;
$bloc     	= $row[9];
$imgm     	= $row[10];
$mudarm_check2 	= $row[14];
$nivel_gm 	= $row[15];

if ($vip==0) $vip_time="--";

// sistema de tempo conta online
$tempo_vip = 720-$min2;
$segundos = $tempo_vip * 60;
$str = "$segundos";
$h = date("H", mktime(0,0,$str,1,1,2000)); 
$m = date("i", mktime(0,0,$str,1,1,2000));
//fim

$creditos 	= 0;
$mgolds 	= 0;
$golds		= 0;
if ($row[11] || $row[12] || $row[13])
{
$creditos 	= $row[11];
$mgolds 	= $row[12];
$golds		= $row[13];
}

if ($bloc == 1){ 
echo "<br><Br><body style='background-color: black !important;'>
<center><table bgcolor=#cccccc width=960 ><tr style='background-color: transparent'><td valign=top><center><font color=$font_color1 size=3><br>Sua conta está bloqueada, qualquer dúvida entre em contato abaixo, você receberá a resposta aqui mesmo!!!</font>";
include ("suporte.php");
include ("mensagens_bloc.php");
echo "<br><bR></td></tr></table><br><bR>";
die(); 
}

//$eleicao_check = mssql_num_rows(mssql_query("SELECT votacao FROM MK_server WHERE votacao=1"));

if ($msg_viu   == 0   ) include("inclu/mensagens.php");
if ($mudarm_check2 > 0  ) $compra4= "<BR><BR>
<table cellspacing=0 border=0><tr><td>
<table width=750 style='text-align:justify; padding:5px 10px 5px 10px; border:1px dashed #46291a;'><tr><td><img src=img/loginho.png></td><td><b>Foi solicitada a troca do E-mail de cadastro dessa conta!</b><br> Se você não quer trocar seu E-mail <a href='mudar_mail.php' target='main2'><u>clique aqui</u></a> e cancele a troca.
</td></tr></table>
</td></tr></table>
";
if ($row[0] == 1) $status = '<img src="img/Pisca.gif" title="online">';
if ($row[0] == 0) $status = '<img src="img/off.gif" width = 5 width = 5 title="offline"> ';

	if ($vip == 0) 
	{ 
		$tipo = "<font color=red><b>$CONFIG_VIP0</b></font>"; 
	}
	if ($vip == 1) 
	{ 
		$tipo = "<font color=green><b>$CONFIG_VIP1</b></font>"; 
	}
	if ($vip == 2) 
	{ 
		$tipo = "<font color=006bf4><b>$CONFIG_VIP2</b></font>"; 
	}
	if ($vip == 3) 
	{ 
		$tipo = "<font color=#b60081><b>$CONFIG_VIP3</b></font>"; 
	}



	if ($imgm)
	{			
		$avatar ="../avatar/thumb.php?imagem=$imgm&y=150&x=150";		
	}
	else
	{	
		$avatar ='../avatar/Icon-user.png';	
	}



$query_s = "Select Name, exp_war, patente, ctlcode,nivel_gm
 From Character where accountid = '$login' order by nivel_gm desc, MasterResetCount desc,ResetCount desc, clevel desc";
$result_s = mssql_query( $query_s );

$xex_s = mssql_num_rows($result_s);

$dados_server = mssql_fetch_row(mssql_query("SELECT * from dbo.fn_info()"));

$online_now = $dados_server[0];
$gms_on     = $dados_server[4];
$gms_total  = $dados_server[5];

?>

<centeR>
   <table border='0' width='1000' cellspacing='0' cellpadding='0' bgcolor=#616975>
            <tr> <td valign=top width=200 class=esquerda><? include("menu.php"); ?> </td>
     	      
              <td width=100% bgcolor=#cccccc valign=top><div class=info_online>

   <table border='0' width='100%' cellspacing='0' cellpadding='0'>

            <tr> <form name='form1' method='post' action='../info_char_pop.php?painel=ok' target="main2">
		<td width=300 height=36><strong>
<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'pt', includedLanguages: 'en,es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</strong>
</td>
		<td width=150><input name='name' type='text' id='name' maxlength='10' value='Procurar Char' onClick="this.select();"> </td>
		<td width=30><input type="image" src="img/treenav.png" onClick="this.form.submit;"> </td></form><form name='form1' method='post' action='../info_guild_pop.php?painel=ok' target="main2">
		<td width=150><input name='modelist' type='text' id='modelist' maxlength='10' value='Procurar Guild' onClick="this.select();"> </td>
		<td width=30><input type="image" src="img/treenav.png" onClick="this.form.submit;"> </td></form>
		<td width=20> </td>
		<td width=150><span class=span style="width:130px;height:13px;position: relative; left:0;top:5px;"><a href=../online_gm.php target=main2><font color=white> <u> Gms Online:</u></a>&nbsp; </font> <? echo $gms_on;?>/<? echo $gms_total;?> </span></td>
		<td width=20> </td>
		<td width=150><span class=span style="width:130px;height:13px;position: relative; left:0;top:5px;"><a href=../online.php target=main2><font color=white> <u>Online no Jogo:</u></a>&nbsp; </font> <? echo $online_now;?> </span></td>
	    </tr>

           </table></div>

<?

include("menu_chars.php");

echo "<center>";


if ($_GET[ver_msg]){

require("mensagens.php");

$pagina = 'suporte.php';
}

elseif ($_GET[show]){$pagina = "../info_char_pop.php?server=$server&name=$_GET[show]&painel=ok";}

else {
$pagina = 'principal.php';

}
echo $compra4;

echo $compra3;

echo $compra;

echo $msgstaff;

/*
if (mssql_num_rows(mssql_query("select votacao from MK_server where votacao=1")) > 0 ) { 

echo "<br>
<table width=750 cellspacing=0 class='text_default' style='text-align:justify; padding:5px 10px 5px 10px; border:1px dashed black;'><tr><td><img src=img/loginho.png></td><td><b>";

$chat = mssql_query("select nome,votos from eleicao order by votos desc" );

echo "<b>Resultado Parcial das eleições (5 Primeiros)</b><table border=0 width=600 cellspacing=0 align=center>";

for($i=0;$i < 5;++$i)
{
$row2 = mssql_fetch_row($chat);

if ($i % 2==0){
$color= "#BEBEBE";
} else {
$color= "#cccccc"; }

echo "<tr height=20 bgcolor=$color>
  <td align=right width=120><a href='../../info_char_pop.php?server=$server&painel=ok&name=$row2[0]' target='main2'>$font $row2[0]</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  <td><b>$row2[1] votos</td>
  </td>
 </tr>";
}

echo "</table>";

echo "</td><td valign=center width=50><a href='eleger.php' target='main2'>Votar</a></td></tr></table>"; 

}
*/


echo $msgsvotos;

?>

<div id = 'iframe'>
<table width=950 cellSpacing=0 border=0><tr><td><centeR>
<iframe align='Center' src='<? echo $pagina;?>' width='100%' height='750' border='0' frameborder='0' name='main2' id='main2' allowtransparency='true'> Err:
      Browser dun support I-Frames =) sry.. </iframe>
</div>

</td></tr></table><br><tr><td colspan=2>


<div class=info_online><center>
   <table border='0' width='950' cellspacing='0' cellpadding='0'>
            <tr> 
		<td height=36 colspan=4><centeR><font color=white> <?=$CONFIG_NOME_MU?> - <?=$CONFIG_SITE?> By Louis</td>
	    </tr>
           </table></div></table>

