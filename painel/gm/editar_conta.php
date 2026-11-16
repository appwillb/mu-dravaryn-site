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

<br><Br><font size=3><b>EDITAR CONTA/PERSONAGEM</font></b><br><br>

<?php
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;

require("../inclu/verif_nivel_gm.php");

if ($_POST[loginlog])
{
	$loginlog = "$_POST[loginlog]";
}
elseif ($_GET[loginlog])
{
	$loginlog = "$_GET[loginlog]";
}
else
{
	$loginlog = "";
}

if ($_POST[loginchar])
{
	$loginchar = "$_POST[loginchar]";
}
elseif ($_GET[loginchar])
{
	$loginchar = "$_GET[loginchar]";
}
else
{
	$loginchar = "";
}

if ($loginchar) 
{
$acc_char 	= mssql_fetch_row(mssql_query("Select accountid,name From character WHERE name = '$loginchar'"));
$loginlog 	= $acc_char[0];
$loginchar 	= ($loginlog) ? $acc_char[1]: $loginchar;
}



if($_GET[post2]){

$id         = stripslashes($_POST['id']);
$comentario = utf8_encode(stripslashes($_POST['comentario']));
$mostrar    = stripslashes($_POST['mostrar']);

if (empty($loginlog))   {
echo "<b>Campos em branco.<bR><br>";}

else {

mssql_query("INSERT INTO LOG_OBS (login,obs,mostrar) VALUES ('$loginlog','$comentario','$mostrar')");

//echo '<script language="Javascript">alert("Observação adicionada!!")</script>';
}

}



if($_GET[post3]){

$id         = stripslashes($_POST['id']);
$comentario = utf8_encode(stripslashes($_POST['comentario']));
$mostrar    = stripslashes($_POST['mostrar']);

if (empty($loginlog))   {
echo "<b>Campos em branco.<bR><br>";}

else {

$msresults= mssql_query("UPDATE log_obs SET obs = '$comentario', login = '$loginlog', mostrar = '$mostrar' WHERE id_obs='$id'");

//echo '<script language="Javascript">alert("Observação Salva!!")</script>';
}

}


if($_GET[post4]){

$id         = $_GET[post4];

if (empty($loginlog))   {
echo "<b>Campos em branco.<bR><br>";}

else {

mssql_query("delete from LOG_OBS where id_obs='$id'");

}

}

if($_GET[editar_conta]){
$vip  		= stripslashes($_POST['vip']);
$memb_name 	= stripslashes($_POST['memb_name']);
$memb_mail 	= stripslashes($_POST['memb_mail']);
$memb_pwd 	= stripslashes($_POST['memb_pwd']);
$memb_code 	= stripslashes($_POST['memb_code']);
$memb_vip 	= stripslashes($_POST['memb_vip']);
$calendario1 	= stripslashes($_POST['calendario1']);
$upcreditos 	= stripslashes($_POST['creditos']);
$upmgolds 	= stripslashes($_POST['mgolds']);
$upgolds 	= stripslashes($_POST['golds']);
$upwhatsapp 	= stripslashes($_POST['whatsapp']);

$data1 = implode('-', array_reverse(explode('/', $calendario1)));

$data1 = date_format(date_create("$data1"), 'Y-m-d');

if (empty($loginlog)) {
    echo "<br><BR><font color=blue>Alguns Campos estão em branco."; 
}
else {

mssql_query("
update memb_info
set 
mail_addr= '$memb_mail',
memb_name= '$memb_name',
bloc_code= '$memb_code',
memb__pwd= '$memb_pwd',
accountlevel      = '$memb_vip',
accountexpiredate = '$data1',
whatsapp = '$upwhatsapp'
where 
memb___id='$loginlog'");

	if(empty($upwhatsapp) || strlen($upwhatsapp) < 10) { mssql_query("UPDATE MEMB_INFO SET whatsapp = null where memb___id='$loginlog'"); }

if ($upcreditos > 0 || $upmgolds > 0 || $upgolds > 0) {

mssql_query("IF NOT EXISTS (select accountid from CashShopData where accountid='$loginlog') BEGIN INSERT INTO CashShopData VALUES ('$loginlog',0,0,0) END");

mssql_query("UPDATE CashShopData set WCoinC = '$upcreditos', WCoinP = '$upmgolds', GoblinPoint = '$upgolds' where AccountID = '$loginlog'");

}


echo '<script language="Javascript">alert("Salvo com sucesso!!")</script>';


$seuip= $_SERVER['REMOTE_ADDR'];
mssql_query("INSERT INTO LOG_ADM (login,ip,tipo) VALUES ('$login_change','$seuip','5')");

}

}


if($_GET[editar_char]){
$class 		= stripslashes($_POST['class']);
$money 		= stripslashes($_POST['money']);
$strength	= stripslashes($_POST['strength']);
$dexterity 	= stripslashes($_POST['dexterity']);
$vitality 	= stripslashes($_POST['vitality']);
$energy 	= stripslashes($_POST['energy']);
$comand 	= stripslashes($_POST['comand']);
$exp_war 	= stripslashes($_POST['exp_war']);
$uppoint 	= stripslashes($_POST['uppoints']);
$clevel 	= stripslashes($_POST['clevel']);
$resets 	= stripslashes($_POST['resets']);
$resets_diario 	= stripslashes($_POST['resets_diario']);
$resets_semanal	= stripslashes($_POST['resets_semanal']);
$resets_mensal	= stripslashes($_POST['resets_mensal']);
$mresets 	= stripslashes($_POST['mresets']);
$mresets_diario = stripslashes($_POST['mresets_diario']);
$mresets_semanal= stripslashes($_POST['mresets_semanal']);
$mresets_mensal	= stripslashes($_POST['mresets_mensal']);
$experience 	= stripslashes($_POST['experience']);
$mapnumber 	= stripslashes($_POST['mapnumber']);
$mapposx 	= stripslashes($_POST['mapposx']);
$mapposy 	= stripslashes($_POST['mapposy']);
$evento_dia 	= stripslashes($_POST['evento_dia']);
$evento 	= stripslashes($_POST['evento']);
$eventos 	= stripslashes($_POST['eventos']);
$eventos_semanal= stripslashes($_POST['eventos_semanal']);
$eventos_mensal = stripslashes($_POST['eventos_mensal']);
$nivel_gm 	= stripslashes($_POST['nivel_gm']);
$ctlcode 	= stripslashes($_POST['ctlcode']);
$bloc_reason 	= stripslashes($_POST['bloc_reason']);
$bloc_by 	= stripslashes($_POST['bloc_by']);
$dia_bloc 	= stripslashes($_POST['dia_bloc']);
$pkcount 	= stripslashes($_POST['pkcount']);
$pkscount 	= stripslashes($_POST['pkcounts']);
$pkmcount 	= stripslashes($_POST['pkcountm']);
$hrcount 	= stripslashes($_POST['hrcount']);
$hrscount 	= stripslashes($_POST['hrscount']);
$hrmcount 	= stripslashes($_POST['hrmcount']);
$extinv 	= stripslashes($_POST['extinv']);
$tempo	 	= stripslashes($_POST['tempo_semanal']);
$tempo_mensal 	= stripslashes($_POST['tempo_mensal']);

$ml 		= stripslashes($_POST['masterlevel']);
$mp 		= stripslashes($_POST['masterpoint']);
$me 		= stripslashes($_POST['masterexperience']);

if (empty($loginlog) or empty($loginchar)) 
{
	echo '<script language="Javascript">alert("ERRO: ATUALIZAÇÃO NÃO REALIZADA!")</script>'; 
}
elseif 
(
empty($loginlog) ||
empty($loginchar) ||
!preg_match('/^\-?[0-9]+$/',$class) ||
!preg_match('/^\-?[0-9]+$/',$money) ||
!preg_match('/^\-?[0-9]+$/',$strength) ||
!preg_match('/^\-?[0-9]+$/',$dexterity) ||
!preg_match('/^\-?[0-9]+$/',$vitality) ||
!preg_match('/^\-?[0-9]+$/',$energy) ||
!preg_match('/^\-?[0-9]+$/',$comand) ||
!preg_match('/^\-?[0-9]+$/',$exp_war) ||
!preg_match('/^\-?[0-9]+$/',$uppoint) ||
!preg_match('/^\-?[0-9]+$/',$clevel) ||
!preg_match('/^\-?[0-9]+$/',$resets) ||
!preg_match('/^\-?[0-9]+$/',$resets_diario) ||
!preg_match('/^\-?[0-9]+$/',$resets_semanal) ||
!preg_match('/^\-?[0-9]+$/',$resets_mensal) ||
!preg_match('/^\-?[0-9]+$/',$mresets) ||
!preg_match('/^\-?[0-9]+$/',$mresets_diario) ||
!preg_match('/^\-?[0-9]+$/',$mresets_semanal) ||
!preg_match('/^\-?[0-9]+$/',$mresets_mensal) ||
!preg_match('/^\-?[0-9]+$/',$experience) ||
!preg_match('/^\-?[0-9]+$/',$mapnumber) ||
!preg_match('/^\-?[0-9]+$/',$mapposx) ||
!preg_match('/^\-?[0-9]+$/',$mapposy) ||
!preg_match('/^\-?[0-9]+$/',$evento_dia) ||
!preg_match('/^\-?[0-9]+$/',$evento) ||
!preg_match('/^\-?[0-9]+$/',$eventos) ||
!preg_match('/^\-?[0-9]+$/',$eventos_semanal) ||
!preg_match('/^\-?[0-9]+$/',$eventos_mensal) ||
!preg_match('/^\-?[0-9]+$/',$nivel_gm) ||
!preg_match('/^\-?[0-9]+$/',$ctlcode) ||
!preg_match('/^\-?[0-9]+$/',$dia_bloc) ||
!preg_match('/^\-?[0-9]+$/',$pkcount) ||
!preg_match('/^\-?[0-9]+$/',$pkscount) ||
!preg_match('/^\-?[0-9]+$/',$pkmcount) ||
!preg_match('/^\-?[0-9]+$/',$hrcount) ||
!preg_match('/^\-?[0-9]+$/',$hrscount) ||
!preg_match('/^\-?[0-9]+$/',$hrmcount) ||
!preg_match('/^\-?[0-9]+$/',$extinv) ||
!preg_match('/^\-?[0-9]+$/',$tempo) ||
!preg_match('/^\-?[0-9]+$/',$tempo_mensal)
) 
{
	echo '<script language="Javascript">alert("ERRO: ALGUM CAMPO EM BRANCO OU NO FORMATO INCORRETO!")</script>'; 
}
else {

	mssql_query("update character
                        set class		= '$class',
                            leveluppoint	= '$uppoint',
                            money		= '$money',
                            strength		= '$strength',
                            dexterity		= '$dexterity',
                            vitality		= '$vitality',
                            energy		= '$energy',
			    leadership 		= '$comand',
                            exp_war		= '$exp_war',
                            clevel		= '$clevel',
                            resetcount	 	= '$resets',
                            reset_diario	= '$resets_diario',
                            reset_semanal	= '$resets_semanal',
                            reset_mensal	= '$resets_mensal',
                            masterresetcount	= '$mresets',
                            mresets_diario	= '$mresets_diario',
                            mresets_semanal	= '$mresets_semanal',
                            mreset_mensal	= '$mresets_mensal',
                            experience		= '$experience',
                            mapnumber		= '$mapnumber',
                            mapposx		= '$mapposx',
                            mapposy		= '$mapposy',
                            evento_dia		= '$evento_dia',
                            evento		= '$evento',
                            eventos		= '$eventos',
                            eventos_semanal	= '$eventos_semanal',
                            eventos_mensal	= '$eventos_mensal',
                            nivel_gm		= '$nivel_gm',
                            Z_rankPK		= '$pkcount',
                            Z_rankPK_semanal	= '$pkscount', 
                            Z_rankPK_mensal	= '$pkmcount', 
                            Z_rankHR		= '$hrcount', 
                            Z_rankHR_semanal	= '$hrscount', 
                            Z_rankhr_mensal	= '$hrmcount',  
                            ctlcode		= '$ctlcode',
			    bloc_reason		= '$bloc_reason',
                            bloc_by		= '$bloc_by',
                            dia_bloc		= '$dia_bloc',
                            tempo		= '$tempo',
                            tempo_mensal	= '$tempo_mensal',
			    extinventory 	= '$extinv'
                      where name='$loginchar' and accountid='$loginlog'");

$seuip= $_SERVER['REMOTE_ADDR'];
mssql_query("INSERT INTO LOG_ADM (login,ip,tipo,valor) VALUES ('$login_change','$seuip','4','$char_change')");

if( $ml > 0 || $mp > 0 || $me > 0) {
mssql_query("IF NOT EXISTS (select name from masterskilltree where name='$loginchar') BEGIN INSERT INTO masterskilltree (Name,MasterLevel,MasterPoint,MasterExperience) VALUES ('$loginchar',1,0,0) END");
mssql_query("update masterskilltree set masterlevel = '$ml', masterpoint='$mp', masterexperience='$me' where name='$loginchar'");
}

echo '<script language="Javascript">alert("ATUALIZAÇÃO EFETUADA COM SUCESSO!")</script>';


}
}



echo "

<table style='border:0;'>
  <tr style='background:transparent;'>  <td>

<form name='form1' method='post' action='?'>
<center>
<table border='0' cellspacing='0' cellpadding='0'>
<thead>
 <tr> 
   <th>Editar Conta</th>
 </tr>
</thead>
<tr>
   <td width='150'><center><input name='loginlog' type='text' id='loginlog' maxlength='10' value='$loginlog' onClick=\"this.select();document.execCommand('Paste');\";> <br><br> <input type='submit' value='Editar'></td>
 </tr>
</table>
</form>

</td> <td>

<form name='form1' method='post' action='?'>
<center>
<table border='0' cellspacing='0' cellpadding='0'>
<thead>
 <tr> 
   <th>Editar Personagem</td>
 </tr>
</thead>
<tr>
   <td width='150'><center><input name='loginchar' type='text' id='loginchar' maxlength='10' value='$loginchar' onClick=\"this.select();document.execCommand('Paste');\";> <br><br> <input type='submit' value='Editar'></td>
 </tr>
</table>
</form>

</td> </tr> </table>

<br>
";

if (empty($loginchar)) 
{
	if (empty($loginlog)) 
	{
		die("<center><font size=2 color=$font_color1><b>Coloque o login ou personagem!</b></font>");
	}
}
else 
{
	if (empty($loginlog)) 
	{
		die("<center><font size=2 color=$font_color1><b>Esse personagem não existe!</b></font>");
	}

}


if ($loginchar)
{

	if (!$loginchar || !$loginlog) {
		die("<center><font size=2 color=$font_color1><b>Esse personagem não existe!"); }


$query_c = "select 
character.clevel,
character.LevelUpPoint,
character.Class,
character.Experience,
character.Strength,
character.Dexterity,
character.Vitality,
character.Energy,
character.leadership,
character.Money,
character.MapNumber,
character.MapPosX,
character.MapPosY,
character.MDate,
character.CtlCode,
character.resetcount,
character.reset_diario,
character.reset_semanal,
character.reset_mensal,
character.masterresetcount,
character.mresets_diario,
character.mresets_semanal,
character.mreset_mensal,
character.bloc_reason,
character.bloc_by,
character.dia_bloc,
character.exp_war,
character.evento,
character.evento_dia,
character.tempo,
character.nivel_gm,
character.extinventory,
character.Z_rankPK,
character.Z_rankPK_semanal,
character.Z_rankPK_mensal,
character.Z_rankHR,
character.Z_rankHR_semanal,
character.Z_rankHR_mensal,
character.eventos,
character.eventos_semanal,
character.eventos_mensal,
dbo.fn_online(name),
character.tempo_mensal
from character
where character.name = '$loginchar' and accountid='$loginlog'";
$result_c = mssql_query( $query_c );
$row_c = mssql_fetch_row($result_c);


$clevel		= $row_c[0];
$uppotins	= $row_c[1];
$class		= $row_c[2];
$experience	= $row_c[3];
$strr		= $row_c[4];
$agi		= $row_c[5];
$vit		= $row_c[6];
$ene		= $row_c[7];
$com		= $row_c[8];
$zen		= $row_c[9];
$map		= $row_c[10];
$mapx		= $row_c[11];
$mapy		= $row_c[12];
$criado		= date_format(date_create("$row_c[13]"), 'd-m-Y H:i:s');
$ctlcode	= $row_c[14];
$resets		= $row_c[15];
$rdiario	= $row_c[16];
$rsemanal	= $row_c[17];
$rmensal	= $row_c[18];
$mresets	= $row_c[19];
$mrdiario	= $row_c[20];
$mrsemanal	= $row_c[21];
$mrmensal	= $row_c[22];
$blocr		= $row_c[23];
$blocby		= $row_c[24];
$blocd		= $row_c[25];
$exp_war	= $row_c[26];
$evento		= $row_c[27];
$evento_dia	= $row_c[28];
$tempo		= $row_c[29];
$nivel_gm	= $row_c[30];
$extinv		= $row_c[31];
$pk		= $row_c[32];
$pks		= $row_c[33];
$pkm		= $row_c[34];
$hr		= $row_c[35];
$hrs		= $row_c[36];
$hrm		= $row_c[37];
$eventos	= $row_c[38];
$eventos_semanal= $row_c[39];
$eventos_mensal	= $row_c[40];
$online		= $row_c[41];
$tempo_mensal	= $row_c[42];

$query_m = "select 
masterlevel,
masterpoint,
masterexperience
from MasterSkillTree
where name = '$loginchar'";
$result_m = mssql_query( $query_m );
$row_m = mssql_fetch_row($result_m);

if (!$row_m) 
{
$ml = 0;
$mp = 0;
$me = 0;
}
else 
{
$ml = $row_m[0];
$mp = $row_m[1];
$me = $row_m[2];
}

$min =         $tempo;
include '../../inclu/tempo.php';

if ($online == 1) { 
$ONN = '<img src="../img/on2.gif" title="Online" alt="Online"></h3>';}
else { 
$ONN = '<img src="../img/off2.gif" title="Offline" alt="Offline"></h3>';}

?>

<form name=formulario_conta  method="post" action="?editar_char=ok">
<table border = 0 align=center width=800 cellspacing=0>
<thead>
<tr>
  <th Colspan=4>Editar Personagem:</th>
</tr>
</thead>

<tr>
  <td class=bgtr2>Conta:</td>
  <td><input readonly='readonly' value='<? echo $loginlog;?>'> <input type='hidden' name='loginlog' value='<? echo $loginlog;?>'></td></td>
  <td class=bgtr2>Resets:</td>
  <td><input name='resets' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $resets;?>' ></td>
</tr>

<tr>
  <td class=bgtr2>Char:</td>
  <td><input readonly='readonly' value='<? echo $loginchar;?>'> <input type='hidden' name='loginchar' value='<? echo $loginchar;?>'></td></td>
  <td class=bgtr2>Resets diario:</td>
  <td><input name='resets_diario' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $rdiario;?>' ></td>

</tr>

 <tr>
  <td class=bgtr2>Raça:</td>
  <td>
		<SELECT name='class' style='width:205px;'>

			<option value='2'  <? if ($class == '2')  echo 'selected'; ?>>Gran Master</option>
			<option value='18' <? if ($class == '18') echo 'selected'; ?>>Blade Master</option>
			<option value='34' <? if ($class == '34') echo 'selected'; ?>>High Elf</option>
			<option value='50' <? if ($class == '50') echo 'selected'; ?>>Duel Master</option>
			<option value='65' <? if ($class == '65') echo 'selected'; ?>>Lord Emperor</option>
			<option value='66' <? if ($class == '66') echo 'selected'; ?>>Lord Emperor2</option>
			<option value="98" <? if ($class == '98') echo 'selected'; ?>>First Master</option>
			<option value='82' <? if ($class == '82') echo 'selected'; ?>>Dimension Master</option>
			<option value='80' <? if ($class == '80') echo 'selected'; ?>>Summoner</option>
			<option value="81" <? if ($class == '81') echo 'selected'; ?>>Bloody Summoner</option>
			<option value="64" <? if ($class == '64') echo 'selected'; ?>>Dark Lord</option>
			<option value="96" <? if ($class == '96') echo 'selected'; ?>>Rage Fighter</option>

			<option value="1"  <?PHP if ($class == '1')  {echo 'selected';} ?>>Soul Master</option>
			<option value="17" <?PHP if ($class == '17') {echo 'selected';} ?>>Blade Knight</option>
			<option value="33" <?PHP if ($class == '33') {echo 'selected';} ?>>Muse Elf</option>
			<option value="48" <?PHP if ($class == '48') {echo 'selected';} ?>>Magic Gladiator</option>
			<option value="0"  <?PHP if ($class == '0')  {echo 'selected';} ?>>Dark Wizard</option>
			<option value="16" <?PHP if ($class == '16') {echo 'selected';} ?>>Dark Knight</option>
			<option value="32" <?PHP if ($class == '32') {echo 'selected';} ?>>Elf</option>
		</SELECT>

  </td>
  <td class=bgtr2>Resets semanal:</td>
  <td><input name='resets_semanal' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $rsemanal;?>' ></td>
 </tr>

 <tr>
  <td class=bgtr2>Zen:</td>
  <td><input  name='money' value='<? echo $zen;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Resets mensal:</td>
  <td><input name='resets_mensal' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $rmensal;?>' ></td>
 </tr>

 <tr>
  <td class=bgtr2>Força:</td>
  <td><input name='strength' value='<? echo $strr;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Master Resets:</td>
  <td><input name='mresets' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $mresets;?>' ></td>
 </tr>

 <tr>
  <td class=bgtr2>Agilidade:</td>
  <td><input name='dexterity' value='<? echo $agi;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>MR diario:</td>
  <td><input name='mresets_diario' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $mrdiario;?>' ></td>
 </tr>
 
 <tr>
  <td class=bgtr2>Vida:</td>
  <td><input name='vitality' value='<? echo $vit;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>MR semanal:</td>
  <td><input name='mresets_semanal' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $mrsemanal;?>' ></td>
 </tr>

 <tr>
  <td class=bgtr2>Energia:</td>
  <td><input name='energy' value='<? echo $ene;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>MR mensal:</td>
  <td><input name='mresets_mensal' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $mrmensal;?>' ></td>
 </tr>

 <tr>
  <td class=bgtr2>Comando:</td>
  <td><input name='comand' value='<? echo $com;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Eventos:</td>
  <td><input name='eventos' value='<? echo $eventos;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Level:</td>
  <td><input name='clevel' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $clevel;?>' ></td>
  <td class=bgtr2>Eventos semanal:</td>
  <td><input name='eventos_semanal' value='<? echo $eventos_semanal;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>LevelUp Points:</td>
  <td><input name='uppoints' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $uppotins;?>' ></td>
  <td class=bgtr2>Eventos mensal:</td>
  <td><input name='eventos_mensal' value='<? echo $eventos_mensal;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Experiência:</td>
  <td><input name='experience' style='color:black' onKeyPress = "this.style.color = 'blue';" value='<? echo $experience;?>' ></td>
  <td class=bgtr2>Mortes:</td>
  <td><input name='pkcount' value='<? echo $pk;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>


 <tr>
  <td class=bgtr2>Patente:</td>
  <td><input name='exp_war' value='<? echo $exp_war;?>'  style='color:black' onKeyPress = "this.style.color = 'blue';" >  </td>
  <td class=bgtr2>Mortes semanal:</td>
  <td><input name='pkcounts' value='<? echo $pks;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Mapa:</td>
  <td>
		<SELECT name='mapnumber' style='width:205px;'> 
			<option value="0"  <? if ($map == '0')  echo 'selected'; ?>>0 - Lorencia</option>
			<option value="1"  <? if ($map == '1')  echo 'selected'; ?>>1 - Dungeon</option>
			<option value="2"  <? if ($map == '2')  echo 'selected'; ?>>2 - Devias</option>
			<option value="3"  <? if ($map == '3')  echo 'selected'; ?>>3 - Noria</option>
			<option value="4"  <? if ($map == '4')  echo 'selected'; ?>>4 - Lost tower</option>
			<option value="5"  <? if ($map == '5')  echo 'selected'; ?>>5 - Exile</option>
			<option value="6"  <? if ($map == '6')  echo 'selected'; ?>>6 - Arena</option>
			<option value="7"  <? if ($map == '7')  echo 'selected'; ?>>7 - Atlans</option>
			<option value="8"  <? if ($map == '8')  echo 'selected'; ?>>8 - Tarkan</option>
			<option value="9"  <? if ($map == '9')  echo 'selected'; ?>>9 - Devil Square</option>
			<option value="10" <? if ($map == '10') echo 'selected'; ?>>10 - Icarus</option>
			<option value="11" <? if ($map == '11') echo 'selected'; ?>>11 - Blood castle 1</option>
			<option value="12" <? if ($map == '12') echo 'selected'; ?>>12 - Blood castle 2</option>
			<option value="13" <? if ($map == '13') echo 'selected'; ?>>13 - Blood castle 3</option>
			<option value="14" <? if ($map == '14') echo 'selected'; ?>>14 - Blood castle 4</option>
			<option value="15" <? if ($map == '15') echo 'selected'; ?>>15 - Blood castle 5</option>
			<option value="16" <? if ($map == '16') echo 'selected'; ?>>16 - Blood castle 6</option>
			<option value="17" <? if ($map == '17') echo 'selected'; ?>>17 - Blood castle 7</option>
			<option value="18" <? if ($map == '18') echo 'selected'; ?>>18 - Chaos Castle 1</option>
			<option value="19" <? if ($map == '19') echo 'selected'; ?>>19 - Chaos Castle 2</option>
			<option value="20" <? if ($map == '20') echo 'selected'; ?>>20 - Chaos Castle 3</option>
			<option value="21" <? if ($map == '21') echo 'selected'; ?>>21 - Chaos Castle 4</option>
			<option value="22" <? if ($map == '22') echo 'selected'; ?>>22 - Chaos Castle 5</option>
			<option value="23" <? if ($map == '23') echo 'selected'; ?>>23 - Chaos Castle 6</option>
			<option value="24" <? if ($map == '24') echo 'selected'; ?>>24 - Kalima 1</option>
			<option value="25" <? if ($map == '25') echo 'selected'; ?>>25 - Kalima 2</option>
			<option value="26" <? if ($map == '26') echo 'selected'; ?>>26 - Kalima 3</option>
			<option value="27" <? if ($map == '27') echo 'selected'; ?>>27 - Kalima 4</option>
			<option value="28" <? if ($map == '28') echo 'selected'; ?>>28 - Kalima 5</option>
			<option value="29" <? if ($map == '29') echo 'selected'; ?>>29 - Kalima 6</option>
			<option value="30" <? if ($map == '30') echo 'selected'; ?>>30 - Castle Siege</option>
			<option value="31" <? if ($map == '31') echo 'selected'; ?>>31 - Land of Trials</option>
			<option value="32" <? if ($map == '32') echo 'selected'; ?>>32 - Devil Square 2</option>
			<option value="33" <? if ($map == '33') echo 'selected'; ?>>33 - Aida</option>
			<option value="34" <? if ($map == '34') echo 'selected'; ?>>34 - Crywolf</option>
			<option value="35" <? if ($map == '35') echo 'selected'; ?>>35 - ??????????????</option>
			<option value="36" <? if ($map == '36') echo 'selected'; ?>>36 - Kalima 7</option>
			<option value="37" <? if ($map == '37') echo 'selected'; ?>>37 - Kanturu 1</option>
			<option value="38" <? if ($map == '38') echo 'selected'; ?>>38 - Kanturu 2</option>
			<option value="39" <? if ($map == '39') echo 'selected'; ?>>39 - Kanturu 3</option>
			<option value="40" <? if ($map == '40') echo 'selected'; ?>>40 - Silent</option>
			<option value="41" <? if ($map == '41') echo 'selected'; ?>>41 - Barracks</option>
			<option value="42" <? if ($map == '42') echo 'selected'; ?>>42 - Refuge</option>
			<option value="43" <? if ($map == '43') echo 'selected'; ?>>43 - ??????????????</option>
			<option value="44" <? if ($map == '44') echo 'selected'; ?>>44 - ??????????????</option>
			<option value="45" <? if ($map == '45') echo 'selected'; ?>>45 - Illusion Temple 1</option>
			<option value="46" <? if ($map == '46') echo 'selected'; ?>>46 - Illusion Temple 2</option>
			<option value="47" <? if ($map == '47') echo 'selected'; ?>>47 - Illusion Temple 3</option>
			<option value="48" <? if ($map == '48') echo 'selected'; ?>>48 - Illusion Temple 4</option>
			<option value="49" <? if ($map == '49') echo 'selected'; ?>>49 - Illusion Temple 5</option>
			<option value="50" <? if ($map == '50') echo 'selected'; ?>>50 - Illusion Temple 6</option>
			<option value="51" <? if ($map == '51') echo 'selected'; ?>>51 - Elbeland</option>
			<option value="52" <? if ($map == '52') echo 'selected'; ?>>52 - Blood Castle 8</option>
			<option value="53" <? if ($map == '53') echo 'selected'; ?>>53 - Chaos Castle 7</option>
			<option value="54" <? if ($map == '54') echo 'selected'; ?>>54 - ??????????????</option>
			<option value="55" <? if ($map == '55') echo 'selected'; ?>>55 - ??????????????</option>
			<option value="56" <? if ($map == '56') echo 'selected'; ?>>56 - Swamp of Calmness</option>
			<option value="57" <? if ($map == '57') echo 'selected'; ?>>57 - Raklion 1</option>
			<option value="58" <? if ($map == '58') echo 'selected'; ?>>58 - Raklion 2</option>
			<option value="59" <? if ($map == '59') echo 'selected'; ?>>59 - ??????????????</option>
			<option value="60" <? if ($map == '60') echo 'selected'; ?>>60 - ??????????????</option>
			<option value="61" <? if ($map == '61') echo 'selected'; ?>>61 - ??????????????</option>
			<option value="62" <? if ($map == '62') echo 'selected'; ?>>62 - Santa Town</option>
			<option value="63" <? if ($map == '63') echo 'selected'; ?>>63 - Vulcanus</option>
			<option value="64" <? if ($map == '64') echo 'selected'; ?>>64 - Duel Arena</option>
			<option value="65" <? if ($map == '65') echo 'selected'; ?>>65 - Double Goer 1</option>
			<option value="66" <? if ($map == '66') echo 'selected'; ?>>66 - Double Goer 2</option>
			<option value="67" <? if ($map == '67') echo 'selected'; ?>>67 - Double Goer 3</option>
			<option value="68" <? if ($map == '68') echo 'selected'; ?>>68 - Double Goer 4</option>
			<option value="69" <? if ($map == '69') echo 'selected'; ?>>69 - Imperial Guardian 1</option>
			<option value="70" <? if ($map == '70') echo 'selected'; ?>>70 - Imperial Guardian 2</option>
			<option value="71" <? if ($map == '71') echo 'selected'; ?>>71 - Imperial Guardian 3</option>
			<option value="72" <? if ($map == '72') echo 'selected'; ?>>72 - Imperial Guardian 4</option>
			<option value="73" <? if ($map == '73') echo 'selected'; ?>>73 - ??????????????</option>
			<option value="74" <? if ($map == '74') echo 'selected'; ?>>74 - ??????????????</option>
			<option value="75" <? if ($map == '75') echo 'selected'; ?>>75 - ??????????????</option>
			<option value="76" <? if ($map == '76') echo 'selected'; ?>>76 - ??????????????</option>
			<option value="77" <? if ($map == '77') echo 'selected'; ?>>77 - ??????????????</option>
			<option value="78" <? if ($map == '78') echo 'selected'; ?>>78 - ??????????????</option>
			<option value="79" <? if ($map == '79') echo 'selected'; ?>>79 - Loren Market</option>
			<option value="80" <? if ($map == '80') echo 'selected'; ?>>80 - Karutan 1</option>
			<option value="81" <? if ($map == '81') echo 'selected'; ?>>81 - Karutan 2</option>
			<option value="82" <? if ($map == '82') echo 'selected'; ?>>82 - ??????????????</option>
			<option value="83" <? if ($map == '83') echo 'selected'; ?>>83 - ??????????????</option>
			<option value="84" <? if ($map == '84') echo 'selected'; ?>>84 - ??????????????</option>
			<option value="85" <? if ($map == '85') echo 'selected'; ?>>85 - ??????????????</option>
			<option value="86" <? if ($map == '86') echo 'selected'; ?>>86 - ??????????????</option>
			<option value="87" <? if ($map == '87') echo 'selected'; ?>>87 - ??????????????</option>
			<option value="88" <? if ($map == '88') echo 'selected'; ?>>88 - ??????????????</option>
			<option value="89" <? if ($map == '89') echo 'selected'; ?>>89 - ??????????????</option>
			<option value="90" <? if ($map == '90') echo 'selected'; ?>>90 - ??????????????</option>
			<option value="91" <? if ($map == '91') echo 'selected'; ?>>91 - Acheron 1</option>
			<option value="92" <? if ($map == '92') echo 'selected'; ?>>92 - Acheron 2</option>
			<option value="93" <? if ($map == '93') echo 'selected'; ?>>93 - ??????????????</option>
			<option value="94" <? if ($map == '94') echo 'selected'; ?>>94 - ??????????????</option>
			<option value="95" <? if ($map == '95') echo 'selected'; ?>>95 - Deventer 1</option>
			<option value="96" <? if ($map == '96') echo 'selected'; ?>>96 - Deventer 2</option>
			<option value="97" <? if ($map == '97') echo 'selected'; ?>>97 - Chaos Castle Final</option>
			<option value="98" <? if ($map == '98') echo 'selected'; ?>>98 - Illusion Temple Final 1</option>
			<option value="99" <? if ($map == '99') echo 'selected'; ?>>99 - Illusion Temple Final 2</option>

		</SELECT>
 
  </td>
  <td class=bgtr2>Mortes Mensal:</td>
  <td><input name='pkcountm' value='<? echo $pkm;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Cord.X:</td>
  <td><input name='mapposx' value='<? echo $mapx;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Hero:</td>
  <td><input name='hrcount' value='<? echo $hr;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Cord.Y:</td>
  <td><input name='mapposy' value='<? echo $mapy;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Hero semanal:</td>
  <td><input name='hrscount' value='<? echo $hrs;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Inventorio extra:</td>
  <td>
		<SELECT name='extinv' style='width:205px;'> 
			<option value="0" <?PHP if ($extinv == '0') {echo 'selected';} ?>>0 expanção</option>
			<option value="1" <?PHP if ($extinv == '1') {echo 'selected';} ?>>1 expanção</option>
			<option value="2" <?PHP if ($extinv == '2') {echo 'selected';} ?>>2 expanção</option>
		</SELECT>
 
  </td>
  <td class=bgtr2>Hero mensal:</td>
  <td><input name='hrmcount' value='<? echo $hrm;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  </tr>

 <tr>
  <td class=bgtr2>Banido Motivo:</td>
  <td><input name='bloc_reason' value='<? echo $blocr;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Tempo semanal(Min):</td>
  <td><input name='tempo_semanal' value='<? echo $tempo;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Banido por:</td>
  <td><input name='bloc_by' value='<? echo $blocby;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Tempo mensal(Min):</td>
  <td><input name='tempo_mensal' value='<? echo $tempo_mensal;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Banido dias:</td>
  <td><input name='dia_bloc' value='<? echo $blocd;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Status Char:</td>
  <td>
 		<SELECT name='ctlcode' style='width:205px;'> 
			<option value="0"  <?PHP if ($ctlcode == '0') {echo 'selected';} ?>>Normal</option>
			<option value="1"  <?PHP if ($ctlcode == '1') {echo 'selected';} ?>>Bloqueado</option>
			<option value="8"  <?PHP if ($ctlcode == '8') {echo 'selected';} ?>>GM</option>
			<option value="32" <?PHP if ($ctlcode == '32') {echo 'selected';} ?>>Administrador</option>
		</SELECT>
  </td>
 </tr>

 <tr>
  <td class=bgtr2>Master Level:</td>
  <td><input name='masterlevel' value='<? echo $ml;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Nível(<b>GM</b>):</td>
  <td>
		<SELECT name='nivel_gm' style='width:205px;'> 
			<option value="0" <?PHP if ($nivel_gm == '0') {echo 'selected';} ?>>Normal Player</option>
			<option value="1" <?PHP if ($nivel_gm == '1') {echo 'selected';} ?>>Ajudante</option>
			<option value="2" <?PHP if ($nivel_gm == '2') {echo 'selected';} ?>>SUB-GM</option>
			<option value="3" <?PHP if ($nivel_gm == '3') {echo 'selected';} ?>>GM </option>
			<option value="4" <?PHP if ($nivel_gm == '4') {echo 'selected';} ?>>SUB-ADM</option>
			<option value="5" <?PHP if ($nivel_gm == '5') {echo 'selected';} ?>>Administrador</option>
		</SELECT>
 
  </td>
 </tr>

 <tr>
  <td class=bgtr2>Master Point:</td>
  <td><input name='masterpoint' value='<? echo $mp;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Eventos dia(<b>GM</b>):</td>
  <td><input name='evento_dia' value='<? echo $evento_dia;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>

 <tr>
  <td class=bgtr2>Master Experience:</td>
  <td><input name='masterexperience' value='<? echo $me;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
  <td class=bgtr2>Eventos Total(<b>GM</b>):</td>
  <td><input name='evento' value='<? echo $evento;?>' style='color:black' onKeyPress = "this.style.color = 'blue';" ></td>
 </tr>


 <tr>
  <td colspan=4><Br>
  <input type='image' src='../img/BT_salvar.png' name='Submit' value='Salvar Dados' style='border:0;background:transparent;'><Br><Br></td>
 </tr>

<thead>
<tr>
  <th Colspan=4>Outros Dados:</th>
</tr>
</thead>

<tr>
  <td colspan=2 class=bgtr2>Status:</td>
  <td colspan=2><? echo "$ONN";?></td>
 </tr>

<tr>
  <td colspan=2 class=bgtr2>Tempo Conectado(Semanal):</td>
  <td colspan=2><input  readonly='readonly' value='<? echo "$H3 hs $m mins";?>'></td>
 </tr>

 <tr>
  <td colspan=2 class=bgtr2>Criado dia:</td>
  <td colspan=2><input readonly='readonly' value='<? echo $criado;?>'></td>
 </tr> 

</table></form>

<?PHP

}

else {

$resultm = mssql_query("Select memb___id From memb_info WHERE memb___id='$loginlog'");
$mm1 = mssql_fetch_row($resultm);

$account = $mm1[0];

if ($account != $loginlog ) {
die("<center><font size=2 color=$font_color1><b>Esse login não existe!"); }

$query_c = "select 
ConnectStat, 
ServerName,
ConnectTM,
DisConnectTM,
IP,
memb_info.mail_addr,
memb_info.memb_name,
memb_info.bloc_code,
memb_info.memb__pwd,
memb_info.accountlevel,
memb_info.accountexpiredate,
dbo.fn_wc(memb_info.memb___ID),
dbo.fn_wP(memb_info.memb___ID),
dbo.fn_GP(memb_info.memb___ID),
memb_info.appl_days,
memb_info.whatsapp,
memb_info.bandeira,
memb_info.img
from memb_stat,memb_info
where
memb_stat.memb___id='$loginlog' and
memb_stat.memb___id=MEMB_INFO.memb___id COLLATE database_default";
$result_c = mssql_query( $query_c );
$row_c = mssql_fetch_row($result_c);

$dado0 		= $row_c[0]; // connectstat
$dado1 		= $row_c[9]; // vip
$dado3 		= $row_c[1]; // servername
$dado4 		= $row_c[2]; // connectTM
$dado5 		= $row_c[3]; // DisconnectTM
$dado6 		= $row_c[4]; // IP
$dado13		= $row_c[5]; // e-mail
$dado14		= $row_c[6]; // nome
$dado15		= $row_c[7]; // bloc code
$dado16		= $row_c[8]; // pass
$creditos 	= $row_c[11];
$mgolds 	= $row_c[12];
$golds	 	= $row_c[13];
$criada		= $row_c[14];
$whatsapp	= $row_c[15];
$band		= $row_c[16];
$imgm 		= $row_c[17];

$bandeira 	= ($band) ? "<img src=../../img/bandeiras30/$band.png>" : "<img src=../../img/bandeiras30/00.png>";

$data_vip = date_format(date_create("$row_c[10]"), 'd/m/Y');

$criada   = date_format(date_create("$criada"), 'd/m/Y');

$dado4 = date_format(date_create("$dado4"), 'd/m/Y H:m');
$dado5 = date_format(date_create("$dado5"), 'd/m/Y H:m');

if ($dado0 == 1 and $dado15 <> 1) { 
$dado0 = "<img src=../img/on2.gif>"; }
elseif ($dado0 == 0 and $dado15 <> 1) { 
$dado0 = "<img src=../img/off2.gif>"; }
elseif ($dado15 == 1) { 
$dado0 = "<font color=red>Bloqueado</font>"; }

	if ($dado1 == 0) 
	{ 
		$vip_stat = "<font color=red><b>$CONFIG_VIP0</b></font>"; 
	}
	if ($dado1 == 1) 
	{ 
		$vip_stat = "<font color=green><b>$CONFIG_VIP1</b></font>"; 
	}
	if ($dado1 == 2) 
	{ 
		$vip_stat = "<font color=#0460d6><b>$CONFIG_VIP2</b></font>"; 
	}
	if ($dado1 == 3) 
	{ 
		$vip_stat = "<font color=#b60081><b>$CONFIG_VIP3</b></font>"; 
	}

if ($dado26 == 1) { 
$dado26 = "<font color=red size=2>Sim</font>"; }
elseif ($dado26 == 0) { 
$dado26 = "<font color=green size=2>Não</font>"; }

		if ($imgm)
		{			
			$avatar ="../../avatar/thumb.php?imagem=$imgm&y=100&x=100";		
		}
		else
		{	
			$avatar ='../../avatar/Icon-user.png';	
		}


?>
<table border = 0 width=800 cellspacing=0>
<form name=formulario_conta  method="post" action="?editar_conta=ok&loginlog=<?=$loginlog;?>">
<thead>
<tr>
  <th Colspan=4>Dados da conta:</th>
</tr>
</thead>

<tr>
  <td class=bgtr2>Login:</td>
  <td style='text-align:left;'> <?=$loginlog;?> </td>
  <td class=bgtr2>Conectou: </td>
  <td style='text-align:left;'> <?=$dado4;?> </td>
</tr>

 <tr>
  <td class=bgtr2>Senha:</td>
  <td style='text-align:left;'><input type='text' name='memb_pwd' value='<? echo $dado16;?>'></td>
  <td class=bgtr2><font size=2>Disconectou.: </td>
  <td style='text-align:left;'><? echo $dado5;?></td>
 </tr>

 <tr>
  <td class=bgtr2>VIP:</td>
  <td style='text-align:left;'>
                <SELECT name=memb_vip>
			<option value="3" <?PHP if ($dado1 == '3') {echo 'selected';} ?>><?=$CONFIG_VIP3?></option>
			<option value="2" <?PHP if ($dado1 == '2') {echo 'selected';} ?>><?=$CONFIG_VIP2?></option>
			<option value="1" <?PHP if ($dado1 == '1') {echo 'selected';} ?>><?=$CONFIG_VIP1?></option>
			<option value="0" <?PHP if ($dado1 == '0') {echo 'selected';} ?>><?=$CONFIG_VIP0?></option>
		</SELECT></td>
  <td class=bgtr2>IP: </td>
  <td style='text-align:left;'><? echo $dado6;?> &nbsp;<a href='localizar_ipmail.php?loginip=<?=$dado6;?>'><img src='../img/bnt_lupa.png' title='Rastrear IP' alt='Rastrear IP' ></a></td>
 </tr>

 <tr>

 <tr>
  <td class=bgtr2>Conta:</td>
  <td style='text-align:left;'>
                <SELECT name=memb_code>
			<option value="1" <?PHP if ($dado15 == '1') {echo 'selected';} ?>>Bloqueada</option>
			<option value="0" <?PHP if ($dado15 == '0') {echo 'selected';} ?>>Normal</option>
		</SELECT></td>
  <td class=bgtr2>Servidor: </td>
  <td style='text-align:left;'><? echo $dado3;?></td>
 </tr>

 <tr>
  <td class=bgtr2>Nome:</td>
  <td style='text-align:left;'><input type='text' name='memb_name' value='<? echo $dado14;?>'></td>
  <td class=bgtr2>Status: </td>
  <td style='text-align:left;'><? echo $dado0;?></td>
 </tr>

 <tr>
  <td class=bgtr2>Data VIP:</td>
  <td style='text-align:left;'><input type='text' name = 'calendario1' id='calendario1' value='<?=$data_vip;?>'> </td>
  <td class=bgtr2>Conta: </td>
  <td style='text-align:left;'><? echo $vip_stat; ?></td>
 </tr>

 <tr>
  <td class=bgtr2>E-mail:</td>
  <td style='text-align:left;'><input type='text' name='memb_mail' value='<?=$dado13;?>' style='width:230' > &nbsp;<a href='localizar_ipmail.php?loginmail=<?=$dado13;?>'><img src='../img/bnt_lupa.png' title='Rastrear Mail' alt='Rastrear Mail' ></a></td>
  <td class=bgtr2>Criada:</td>
  <td style='text-align:left;'><?=$criada;?></td>
 </tr>

 <tr>
  <td class=bgtr2>Créditos (WCoinC):</td>
  <td style='text-align:left;'><input type='text' name='creditos' value='<?=$creditos;?>' style='width:100' ></td>
  <td class=bgtr2>Bandeira:</td>
  <td><?=$bandeira;?></td>
 </tr>

 <tr>
  <td class=bgtr2>M.Golds (WCoinP):</td>
  <td style='text-align:left;'><input type='text' name='mgolds' value='<?=$mgolds;?>' style='width:100' ></td>
  <td class=bgtr2 rowspan=3>Avatar:</td>
  <td rowspan=3><img src=<?=$avatar;?>></td>
 </tr>

 <tr>
  <td class=bgtr2>Golds (GoblinPoints):</td>
  <td style='text-align:left;'><input type='text' name='golds' value='<?=$golds;?>' style='width:100' ></td>
 </tr>

 <tr>
  <td class=bgtr2>Whatsapp:</td>
  <td style='text-align:left;'><input type='text' name='whatsapp' value='<?=$whatsapp;?>'></td>
 </tr>
 
 <tr>
  <td colspan=4> <input type='image' src='../img/BT_salvar.png' name='Submit' value='Salvar Dados' style='border:0;background:transparent;'> </td>
 </tr>

</form>

<thead>
 <tr>
  <th Colspan=4>Personagens da conta:</th>
 </tr>
</thead>

<?PHP



$query = "Select Name, clevel, Resetcount,exp_war,ctlcode,tempo,MapNumber,nivel_gm,nivel_gm,masterresetcount,dbo.fn_ml(Name), dbo.fn_online(name)
From 
Character where accountid='$loginlog' order by character.nivel_gm desc, exp_war desc, resetcount desc";
$result = mssql_query( $query );

if (mssql_num_rows($result) > 0) {

?>

 <tr style='background:transparent;'>
  <td colspan=4> 

    <table border=0 cellSpacing=0 width=100%>
    <thead>
    <tr>
      <th Colspan=9 style='height:2px;'></th>
    </tr>
    <tr>
      <th>Nome:</th>
      <th>M.Resets</th>
      <th>Resets:</th>
      <th>Level (ML):</th>
      <th>Patente(EXP):</td>
      <th>Nível:</th>
      <th>Tempo(semanal):</th>
      <th>Editar:</th>
      </tr>



<?PHP

while($row = mssql_fetch_row($result))
{

$nome =   $row[0];
$lvl =    $row[1];
$resets = $row[2];
$exp =    $row[3];
$ctl_cd = $row[4];
$min =    $row[5];

$patente_num = str_pad($exp, 5, '0', STR_PAD_LEFT);
$niv =  $row[7];
$eventos =$row[8];
$mresets =$row[9];
$ml      =$row[10];

if ($row[0] == 1) $status = '';

include '../../inclu/patentes.php';
include '../../inclu/mapas.php';
include '../../inclu/tempo.php';
include '../../inclu/status_char.php';

echo "<tr>
<td><a href='info_char.php?name=$nome'><b>$nome</a>".(($row[11]==1) ? ' <img src="../img/Pisca.gif" title="online">' : '')."</td>
<td align=right>$mresets</td>
<td align=right>$resets</td>
<td align=right>$lvl($ml)</td>
<td style='text-align:left;'>$patente_num</font>-$patente</td>
<td><center>".(($niv>0) ? '<font color=$font_color2>' : '')."$nivel_gm</td>
<td>$H3 hs $m mins</td>
<td><a href='?&loginchar=$nome'><img src='../img/Edit.gif'></a></td>
</tr>";
}

echo "</table>";
}
else
{
echo "
 <tr>
  <td colspan=4> Nenhum personagem encontrado</td>
 </tr>
";
}

?>


    

  </td>
 </tr>

<thead>
<tr>
  <th Colspan=4>Adicionar Observação:</th>
</tr>
<tr>
      <th colspan=2>Observação </th>
      <th> Exibir no painel:</th>
      <th> Adiconar </th>
</tr>

</thead>


<form name='form1' method='post' action="?post2=ok&loginlog=<?=$loginlog;?>">

<tr>
<td colspan=2><center>
<input type='text' name='comentario' maxlength='150' value='Coloque aqui sua observação' style='text-align:center;width:420' onClick="this.select();";></td>
<td><select name='mostrar' id='mostrar'>
 <option value='0'> Ocultar </option>
 <option value='1'> Mostrar  </option>
</select></td>
<td><center><input type='submit' name='Submit' value='ADICIONAR'></td>
</tr></form>
</td></tr>

 <tr>
  <td colspan=4> &nbsp;</td>
 </tr>

<thead>
<tr>
  <th Colspan=4>Observações:</th>
</tr>
<tr>
      <th colspan=2> Observação:</th>
      <th>Exibir no painel</th>
      <th>Editar </th>
</tr>

</thead>

<?php

$query = "Select data,obs,mostrar,id_obs From log_obs where login='$loginlog' order by id_obs desc";
$result = mssql_query( $query );

$xex = mssql_num_rows($result);

if ($xex <= 0 ) {
echo "
 <tr>
  <td colspan=4> Nenhuma Observação</td>
 </tr>
";
}

for($i=0;$i < $xex;++$i)
{
$row = mssql_fetch_row($result);

$data        =   $row[0];
$obs_conta   =   utf8_decode($row[1]);
$mostrar     =   $row[2];
$id          =   $row[3];

$data = date_format(date_create("$data"), 'd/m/Y');

$sele1 = '';
$sele2 = '';

if ($mostrar=="1") $sele1='selected'; else $sele2='selected';

echo "

<form name='form1' method='post' action='?post3=ok&loginlog=$loginlog'>

<tr>
<td colspan=2>$data <input type='text' name='comentario' maxlength='150' value='$obs_conta' style='text-align:center;width:270' onClick=\"this.select();\";></td>
<td><select name='mostrar' id='mostrar'>
 <option value='1' $sele1> Mostrar  </option>
 <option value='0' $sele2> Ocultar </option>
</select> 
</td>
<td>
<input type='image' src='../img/save.png' name='Submit' value='Continuar' style='border:0;background:transparent;'></form> &nbsp; &nbsp;
<a href='?post4=$id&loginlog=$loginlog'><img src='../img/excluir.png'></a></td>
</tr>";

}

echo "</table></td></tr></table><BR><BR>";

}

?>
</div>