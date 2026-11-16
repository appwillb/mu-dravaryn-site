<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />

        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>
<BR><BR><font size=3><b>INFORMAÇÕES SOBRE A GUILD</b></font><bR><bR>

<?php

if (!$_POST['modelist']){
$modelist = $_GET['modelist'];
}
else {
$modelist = $_POST['modelist'];
}

include("inclu/config_simples.php");
	
$sql_username_check = mssql_query("SELECT G_Name FROM Guild WHERE G_Name='$modelist'"); 
$username_check = mssql_num_rows($sql_username_check);

if ($username_check <= 0){ 
echo "<br><br><center><font color=red size=2>Essa Guild não existe.</font>"; }

else {

$query = "SELECT G_Score, G_Master, G_notice, G_name, G_mark,CONVERT(VARCHAR(19),data,120) as data from guild Where G_Name = '$modelist'";
$result2 = mssql_query( $query );
$guild = mssql_fetch_row($result2);

$guild[5] = date_format(date_create("$guild[5]"), 'd-m-Y H:i:s');

$query_gm = "SELECT exp_war,resetcount-1,dbo.fn_online(character.Name),masterresetcount,dbo.fn_bandeira(dbo.fn_acc(character.Name)) from character,memb_stat Where character.Name = '$guild[1]' and character.accountid=memb_stat.memb___id COLLATE database_default";
$result_gm = mssql_query( $query_gm );
$guild_gm = mssql_fetch_row($result_gm);

$logo = urlencode(bin2hex($guild[4]));
		
$query2 = "SELECT 
guildmember.Name,
character.resetcount,
character.exp_war,
character.accountid,
dbo.fn_online(character.Name),
masterresetcount,
dbo.fn_bandeira(dbo.fn_acc(character.Name)),
g_status
from 
guildmember,character
Where 
G_Name = '$modelist' and
guildmember.name=character.name COLLATE database_default
 order by G_Status desc, character.masterresetcount desc,resetcount desc";
$result = mssql_query( $query2 );

$patente_num=$guild_gm[0];

include 'inclu/patentes.php';

$sql_pw_check = mssql_query("select GameIDC from AccountCharacter WHERE GameIDC='$guild[1]'");
$pw_check = mssql_num_rows($sql_pw_check);

$waw = mssql_query("SELECT count(*) FROM Guildmember WHERE G_Name = '$modelist'");
$xex = mssql_result($waw, 0, 0);

if ($guild_gm[2] == 1) { 
$xir = "<img src=painel/img/on2.gif>"; }
else { 
$xir = "<img src=painel/img/off2.gif>"; }

?><center>

<table border = 0  width=600 cellspacing=0 align=center>

	<thead>
 	 <tr>
  		<th><center>Dados da Guild:</td>
  		<th><center>Guild Master:</td>
 	 </tr>
	</thead>


 <tr style="background:transparent;">
  <td><center>

<table border = 0 style="border:0;"><tr style="background:transparent;"><td>
  <img src='inclu/decode.php?decode=<? echo $logo;?>' height=80 width=80><br>
  <font size=3><b><? echo $guild[3];?>
  </td>

  <td valign=top><center>Pontos: <br><input readonly='readonly' style='width:40;text-align:center;' align=center value='<? echo $guild[0];?>'> <br><br>

                  Membros: <br> <input readonly='readonly' style='width:40;text-align:center;' align=center value='<? echo $xex;?>'>

  </td>
 </tr>

</table>

<font size=2>Criada em:<br>
  <b> <?=$guild[5]?> </B>

</td><td valign=top>

<table border = 0  width=95% cellspacing=0 align=center style="border:0;">

 <tr style="background:transparent;">
  <td>
<center>

  <img src='img/<? echo $img;?>.jpg' height='150' style='border: 1px solid #000000;height: 150px;' class=redondo2>

  </td>
<td valign=top>

<a href="info_char_pop.php?painel=ok&name=<? echo $guild[1];?>"><font size=2><b><? echo $guild[1];?></b></a>

<Br><? echo $xir;?><br><br>

M.Resets:<br>
  <input readonly='readonly' style='width:40;text-align:center;' value='<? echo $guild_gm[3];?>'><br><br>

Resets:<br>
  <input readonly='readonly' style='width:40;text-align:center;' value='<? echo $guild_gm[1];?>'><br><br>

</td></tr>

</table>
</td></tr></table><br>


<center><table width='600' cellspacing=0>
      
	<thead>
 	 <tr>
  		<th colspan=7><center>Membros da Guild:</td>
 	 </tr>


    <tr>
      <th width='90'>Personagem:</td>
      <th width='40'>M.Resets:</td>     
      <th width='40'>Resets:</td>
      <th width='40'>Exp:</td>
      <th width='100'>G.Patente:</td>
      <th width='40'>País:</td>
      <th width='70'>Status:</td>
      </tr>

	</thead>

<?
while($row = mssql_fetch_row($result)){

if ($row[7] == 128) { 
	$patente = "Mestre da guild"; }
elseif ($row[7] == 64) { 
	$patente = "Assistente"; }
elseif ($row[7] == 32) { 
	$patente = "Mestre de Batalha"; }
else 	{ 
	$patente = "Normal"; 
	}

if ($row[4] == 1) { 
$xir = "<img src=painel/img/on2.gif>"; }
else { 
$xir = "<img src=painel/img/off2.gif>"; }


if($row[6])
{
	$bandeira = "<img src=img/bandeiras30/$row[6].png>";
}
else
{
	$bandeira = "<img src=img/bandeiras30/00.png>";
}

//$patente_num= $row[2];
//include 'inclu/patentes.php';

echo "<tr onclick=\"document.location.href='info_char_pop.php?painel=ok&name=$row[0]'\"  onmouseover=\"this.style.backgroundColor='$fundo_tab_cor'; this.style.cursor='pointer';this.style.textDecoration='underline'; \" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\">";

echo "<td>";
echo "$row[0]";
echo '</td><td><center>';
echo $row[5];
echo '</td><td><center>';
echo $row[1];
echo '</td><td><center>';
echo "$row[2]";
echo '</td><td><center>';
echo "$patente";
echo '</td><td><center>';
echo "$bandeira";
echo '</td><td><center>';
echo "$xir</td></tr>";
}
echo '</table><BR>';

}
?>

          <table width="600" border="0" cellspacing="0" cellpadding="1" class="FondoModulo">
	<thead>
	    <tr>
		<th colspan=7>Aliadas</th>
	    </tr>
                  <tr>
                    <th width="26" class="Degradado">#</td>
                    <th width="81" class="Degradado">Aliada:</td>
                    <th width="91" class="Degradado">Mestre:</td>
                    <th width="91" class="Degradado">Assistente:</td>
                    <th width="51" class="Degradado">Pontos</td>
                    <th width="51" class="Degradado">País:</td>
                    <th width="59" class="Degradado">Logo:</td>
                    </tr>
	</thead>
                  <?
				  
$query=mssql_query("select TOP 4 * from MuOnline.dbo.Guild WHERE g_name <> '$modelist' and G_Union= (SELECT G_Union FROM MuOnline.dbo.Guild WHERE G_Name= '$modelist') and G_Union>0");
while($row=mssql_fetch_assoc($query)){
$Alianzas=$row['G_Name'];
$Master=$row['G_Master'];
$Score=$row['G_Score'];
$Logo=urlencode(bin2hex($row['G_Mark']));

$AsistenteInfo = mssql_fetch_row(mssql_query("SELECT Name FROM MuOnline.dbo.GuildMember WHERE G_Name ='".$Alianzas."' AND G_Status = '64'")); 
			$Asistente = $AsistenteInfo[0];
			
$CharacterInfo = mssql_fetch_row(mssql_query("SELECT AccountID,Name FROM MuOnline.dbo.Character WHERE Name='".$Master."'")); 
			$Account = $CharacterInfo[0];
			
$CountryInfo = mssql_fetch_row(mssql_query("SELECT bandeira,memb___id FROM MuOnline.dbo.MEMB_INFO WHERE memb___id='".$Account."'")); 
			$PaisG2 = $CountryInfo[0];

if($PaisG2){
		$bandeira = "<img src=img/bandeiras30/$PaisG2.png>";
	}
	else
	{
		$bandeira = "<img src=img/bandeiras30/00.png>";
	}			
			if($Asistente == ''){ $Asistente = ' N/A '; }


?>		<tr onclick="document.location.href='info_guild_pop.php?modelist=ok&modelist=<?=$Alianzas?>'" onmouseover="this.style.backgroundColor='<?=$fundo_tab_cor?>'; this.style.cursor='pointer';this.style.textDecoration='underline';" onmouseout="this.style.background=''; this.style.textDecoration='none';">
                    <td width="25" class="ModuloPrincipal"><?=++$countAli;?></td>
                    <td width="80" class="ModuloPrincipal"><?=$Alianzas?></td>
                    <td width="90" class="ModuloPrincipal"><?=$Master?></td>
                    <td width="90" class="ModuloPrincipal"><?=$Asistente?></td>
                    <td width="50" class="ModuloPrincipal"><?=$Score?></td>
                    <td width="50" class="ModuloPrincipal"><?=$bandeira?></td>
                    <td width="57" class="ModuloPrincipal"><img src='inclu/decode.php?decode=<? echo $Logo;?>' height=20 width=20></td>
                  </tr>
                    <? } ?>
                </table>


</div>