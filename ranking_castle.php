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

<center><BR><BR><font size=3><b>CASTLE SIEGE</b></font><bR><bR>

<centeR>

	<?
include("inclu/config_simples.php");

$SiegeInfo = mssql_fetch_row(mssql_query("SELECT OWNER_GUILD,MONEY,TAX_RATE_CHAOS,TAX_RATE_STORE,TAX_HUNT_ZONE,SIEGE_START_DATE,SIEGE_END_DATE FROM MuOnline.dbo.MuCastle_DATA"));
			$GuilDueño = $SiegeInfo[0];
			$Money = $SiegeInfo[1];
			$Chaos = $SiegeInfo[2];
			$Store = $SiegeInfo[3];
			$Hunt = $SiegeInfo[4];
			
$GuildInfo = mssql_fetch_row(mssql_query("SELECT G_Master,G_Mark,G_Score,G_Name FROM MuOnline.dbo.Guild WHERE G_Name = (SELECT OWNER_GUILD FROM MuOnline.dbo.MuCastle_DATA)")); 
			$MasterGuild = $GuildInfo[0]; 
			$LogoGuild = urlencode(bin2hex($GuildInfo[1]));
			$ScoreGuild = $GuildInfo[2]; 
			
$MasterInfo = mssql_fetch_row(mssql_query("SELECT Resetcount,cLevel,AccountID,masterresetcount FROM MuOnline.dbo.Character WHERE Name='".$MasterGuild."'")); 
			$ResetsMaster = $MasterInfo[0];
			$LevelMaster = $MasterInfo[1];
			$AccountMaster = $MasterInfo[2];
			$MResetsMaster = $MasterInfo[3];
			
$NivelMasterInfo = mssql_fetch_row(mssql_query("SELECT Masterlevel FROM MasterSkillTree WHERE Name='".$MasterGuild."'")); 
			$NivelMaster = $NivelMasterInfo[1];
			
$PaisMasterInfo = mssql_fetch_row(mssql_query("SELECT bandeira FROM MuOnline.dbo.MEMB_INFO WHERE memb___id='".$AccountMaster."'")); 
			$PaisG1 = $PaisMasterInfo[0];

	if($PaisG1){
		$bandeira = "<img src=img/bandeiras30/$PaisG1.png>";
	}
	else
	{
		$bandeira = "<img src=img/bandeiras30/00.png>";
	}
				
$AsistenteGuildInfo = mssql_fetch_row(mssql_query("SELECT Name FROM MuOnline.dbo.GuildMember WHERE G_Name = (SELECT OWNER_GUILD FROM MuOnline.dbo.MuCastle_DATA) AND G_Status = '64'")); 
			$AsistenteGuild = $AsistenteGuildInfo[0];
			
			if($GuilDueño == ''){ $GuilDueño = '<Font Color="#DF0101"> N/A</Font>'; }
			if($MasterGuild == ''){ $MasterGuild = '<Font Color="#DF0101"> N/A </Font>'; }
			if($LevelMaster == ''){ $LevelMaster = '<Font Color="#DF0101"> N/A </Font>'; }
			if($ResetsMaster == ''){ $ResetsMaster = '<Font Color="#DF0101"> N/A </Font>'; }
			if($NivelMaster == ''){ $NivelMaster = '<Font Color="#DF0101"> N/A </Font>'; }
			if($PaisG1 == ''){ $PaisG1 = '<Font Color="#DF0101"> N/A </Font>'; }
			if($ScoreGuild == ''){ $ScoreGuild = '0'; }
			if($AsistenteGuild == ''){ $AsistenteGuild = '<Font Color="#DF0101"> N/A </Font>'; }
			if($Batallador == ''){ $Batallador = '<Font Color="#DF0101"> N/A </Font>'; }
?>

          <table width="500" border="0" cellspacing="0" cellpadding="0">
	<thead>
	    <tr>
		<th colspan=2>Dona Atual</th>
	    </tr>
	</thead>
                  <tr>
                    <td width="125" id="InfoGt">Dono:</td>
                    <td width="96" id="GuilDueño"><a href=info_guild_pop.php?modelist=<?=$GuilDueño?>><?=$GuilDueño?></a></td>
                    </tr>
                  <tr>
                    <td id="InfoGt">Mestre:</td>
                    <td id="MasterGuild"><a href=info_char_pop.php?name=<?=$MasterGuild?>&painel=ok><?=$MasterGuild?></a></td>
                    </tr>
                  <tr>
                    <td id="InfoGt">Level:</td>
                    <td id="LevelMaster"><?=$LevelMaster?></td>
                    </tr>
                  <tr>
                    <td id="InfoGt">Resets:</td>
                    <td id="ResetMaster"><?=$ResetsMaster?></td>
                    </tr>
                  <tr>
                    <td id="InfoGt">M.Resets:</td>
                    <td id="ResetMaster"><?=$MResetsMaster?></td>
                    </tr>
                     <tr>
                    <td id="InfoGt">País:</td>
                    <td id="PaisMaster"><?=$bandeira?></td>
                    </tr>
                  <tr>
                    <td id="InfoGt">Logo:</td>
                    <td id="LogoGuild"><img src='inclu/decode.php?decode=<? echo $LogoGuild;?>' height=80 width=80></td>
                    </tr>
                  <tr>
                    <td id="InfoGt">Pontos:</td>
                    <td id="ScoreGuild"><?=$ScoreGuild?></td>
                    </tr>
                  <tr>
                    <td id="InfoGt">Assistente:</td>
                    <td id="AsistenteGuild"><?=$AsistenteGuild?></td>
                    </tr>
                  <tr>
                  <?

$query=mssql_query("select TOP 3 * from MuOnline.dbo.GuildMember WHERE G_Name = (SELECT OWNER_GUILD FROM MuOnline.dbo.MuCastle_DATA) AND G_Status = '32'");
while($row=mssql_fetch_assoc($query)){
$Batallador=$row['Name'];
?>
                    <td id="InfoGt">Mestre de batalha <?=++$countBTM;?>:</td>
                    <td id="BatalladorGuild"><?=$Batallador?></td>
                    </tr>
                    <? } ?>
                </table><Br><br>

          <table width="500" border="0" cellspacing="1" cellpadding="1" class="FondoModulo">
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
				  
$AlianzasInfo = mssql_fetch_row(mssql_query("select Number,G_Name FROM MuOnline.dbo.Guild WHERE G_Name= (SELECT OWNER_GUILD FROM MuOnline.dbo.MuCastle_DATA)")); 
			$Union = $AlianzasInfo[0];
			
$query=mssql_query("select TOP 4 * from MuOnline.dbo.Guild WHERE G_name <> (SELECT OWNER_GUILD FROM MuOnline.dbo.MuCastle_DATA) and g_union=(SELECT Number FROM MuOnline.dbo.Guild WHERE G_Name= (SELECT OWNER_GUILD FROM MuOnline.dbo.MuCastle_DATA))");
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


?>
		<tr onclick="document.location.href='info_guild_pop.php?modelist=ok&modelist=<?=$Alianzas?>'" onmouseover="this.style.backgroundColor='<?=$fundo_tab_cor?>'; this.style.cursor='pointer';this.style.textDecoration='underline';" onmouseout="this.style.background=''; this.style.textDecoration='none';">
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

	<center><BR><BR><font size=3><b>OUTRAS INFORMAÇÕES</b></font><bR><bR>

          <table width="500" border="0" cellspacing="1" cellpadding="1" class="FondoModulo">
	<thead>
	    <tr>
		<th colspan=7>Guilds registradas</th>
	    </tr>
                  <tr>
                    <th width="26" class="Degradado">#</td>
                    <th width="81" class="Degradado">Guild:</td>
                    <th width="91" class="Degradado">Mestre:</td>
                    <th width="51" class="Degradado">Pontos:</td>
                    <th width="91" class="Degradado">Sign Of Lord:</td>
                    <th width="51" class="Degradado">País:</td>
                    <th width="59" class="Degradado">Logo:</td>
                    </tr>
	</thead>
                <?
$query=mssql_query("select TOP 50 * from MuOnline.dbo.MuCastle_REG_SIEGE");
while($row=mssql_fetch_assoc($query)){
$Registrados=$row['REG_SIEGE_GUILD'];
$Marks=$row['REG_MARKS'];

$GuildReg = mssql_fetch_row(mssql_query("SELECT G_Master,G_Score,G_Mark,G_Name FROM MuOnline.dbo.Guild WHERE G_Name='".$Registrados."'")); 
			$MasterReg = $GuildReg[0];
			$ScoreReg = $GuildReg[1];
			$LogoReg = urlencode(bin2hex($GuildReg[2]));
			$GuildReg = $GuildReg[3];
			
$PeronsajeInfo = mssql_fetch_row(mssql_query("SELECT AccountID,Name FROM MuOnline.dbo.Character WHERE Name='".$MasterReg."'")); 
			$AccountReg = $PeronsajeInfo[0];
			
$CountryRegInfo = mssql_fetch_row(mssql_query("SELECT bandeira,memb___id FROM MuOnline.dbo.MEMB_INFO WHERE memb___id='".$AccountReg."'")); 
			$PaisG3 = $CountryRegInfo[0];
	if($PaisG3){
		$bandeira = "<img src=img/bandeiras30/$PaisG3.png>";
	}
	else
	{
		$bandeira = "<img src=img/bandeiras30/00.png>";
	}
?>
                  <tr onclick="document.location.href='info_guild_pop.php?modelist=ok&modelist=<?=$Registrados?>'" onmouseover="this.style.backgroundColor='<?=$fundo_tab_cor?>'; this.style.cursor='pointer';this.style.textDecoration='underline';" onmouseout="this.style.background=''; this.style.textDecoration='none';">
                    <td width="25" class="ModuloPrincipal"><?=++$countReg;?></td>
                    <td width="80" class="ModuloPrincipal"><?=$Registrados?></td>
                    <td width="90" class="ModuloPrincipal"><?=$MasterReg?></td>
                    <td width="50" class="ModuloPrincipal"><?=$ScoreReg?></td>
                    <td width="89" class="ModuloPrincipal"><?=$Marks?></td>
                    <td width="50" class="ModuloPrincipal"><?=$bandeira?></td>
                    <td width="58" class="ModuloPrincipal"><img src='inclu/decode.php?decode=<? echo $LogoReg;?>' height=20 width=20></td>
                  </tr>
                    <? } ?>
                </table><Br><bR>

          <table width="500" border="0" cellspacing="0" cellpadding="0">
	<thead>
	    <tr>
		<th>Prêmios para Guild Dona do castelo</th>
	    </tr>
                  <tr>
                    <th width="112">Prêmio para todos os membros</td>
                    </tr>
	</thead>

                   <tr>
                    <td class="ModuloPrincipal">Medalha: <bR><img src='img/medals/medal_31.gif' title='Você ganha esse Prêmio se você for um membro da guild dona do castle siege(Prêmio adicionado toda segunda-feira 00:00hs)' alt = 'Você ganha esse Prêmio se você for um membro da guild dona do castle siege(Prêmio adicionado toda segunda-feira 00:00hs)'><br><br>2000 EXP</td>
                    </tr>
	<thead>
	    <tr>
		<th>Prêmios para as alianças</th>
	    </tr>
                  <tr>
                    <th width="112">Prêmio para todos os membros</td>
                    </tr>
	</thead>

                   <tr>
                    <td class="ModuloPrincipal">1000 EXP</td>
                    </tr>

                            </tr>
                        </table><Br><bR>

          <table width="500" border="0" cellspacing="0" cellpadding="0">
	<thead>
	    <tr>
		<th colspan=3>Horários</th>
	    </tr>
                  <tr>
                    <th width="112" class="ModuloPrincipal">Dia:</td>
                    <th width="112" class="ModuloPrincipal">Hora:</td>
                    <th width="222" class="ModuloPrincipal">Detalhes:</td>
                    </tr>
	</thead>

                   <tr>
                    <td class="ModuloPrincipal">Segunda</td>
                    <td class="ModuloPrincipal">00:00:00</td>
                    <td class="ModuloPrincipal">Registro das Guilds</td>
                    </tr>
                    <tr>
                    <td class="ModuloPrincipal">Terça</td>
                    <td class="ModuloPrincipal">23:59:00</td>
                    <td class="ModuloPrincipal">Fim do resgistro</td>
                    </tr>
                    <tr>
                    <td class="ModuloPrincipal">Quarta</td>
                    <td class="ModuloPrincipal">00:00:00</td>
                    <td class="ModuloPrincipal">Registro das Signs of Lord</td>
                    </tr>
                    <tr>
                    <td class="ModuloPrincipal">Quarta</td>
                    <td class="ModuloPrincipal">11:59:00</td>
                    <td class="ModuloPrincipal">Fim do resgistro das Signs</td>
                    </tr>
                    <tr>
                    <td class="ModuloPrincipal">Sexta</td>
                    <td class="ModuloPrincipal">12:00:00</td>
                    <td class="ModuloPrincipal">Anuncio das guilds que poderão participar</td>
                    </tr>
                    <tr>
                    <td class="ModuloPrincipal">Sexta</td>
                    <td class="ModuloPrincipal">19:00:00</td>
                    <td class="ModuloPrincipal">Preparar para o Siege</td>
                    </tr>
                    <tr>
                    <td class="ModuloPrincipal">Domingo</td>
                    <td class="ModuloPrincipal">20:00:00</td>
                    <td class="ModuloPrincipal">Inicio do Siege</td>
                    </tr>
                    <tr>
                    <td class="ModuloPrincipal">Domingo</td>
                    <td class="ModuloPrincipal">22:00:00</td>
                    <td class="ModuloPrincipal">Fim do Siege</td>
                            </tr>
                        </table>

</div>