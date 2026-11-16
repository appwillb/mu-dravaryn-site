<?php
//include("../config.php");

$medal_f = 
mssql_fetch_row(
mssql_query("select top 1 
medal_evento,
medal_resets,
medal_sresets,
medal_mresets,
medal_smresets,
medal_tempo,
medal_pk,
medal_exp,
medal_gm,
dbo.fn_medal(login,1),
medal_tempo_m,
medal_resets_m,
medal_mresets_m,
medal_evento_m,
medal_pk_m,
medal_ds,
medal_ds_s,
medal_rei,
medal_bc_s,
medal_vip,
medal_bc,
medal_rei_conquistas,
medal_duel,
medal_duel_semanal,
dbo.fn_medal(login,2),
dbo.fn_medal(login,3),
medal_hr,
medal_hr_m,
medal_cc_s,
medal_joias
FROM MK_Medalhas where name='$medal_char'"));

$medals = '';

$medal_desc1  = "Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Eventos";
$medal_desc2  = "Você ganha esse Prêmio se chegar a marca de 1000 resets";
$medal_desc3  = "Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Resets";
$medal_desc4  = "Você ganha esse Prêmio se chegar a marca de 500 Master Resets";
$medal_desc5  = "Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Master Resets";
$medal_desc6  = "Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Tempo";
$medal_desc7  = "Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Mortes";
$medal_desc8  = "Você ganha esse Prêmio se conseguir 150.000 pontos de EXP";
$medal_desc9  = "Você ganha esse Prêmio se fizer as 20 primeiras quests do site";
$medal_desc10 = "Você ganha esse Prêmio se conseguir 50 pontos de reputação";
$medal_desc11 = "Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Tempo";
$medal_desc12 = "Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Resets";
$medal_desc13 = "Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Master Resets";
$medal_desc14 = "Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Eventos";
$medal_desc15 = "Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Mortes";
$medal_desc16 = "Você ganha esse Prêmio se ficar em primeiro no Ranking geral da Devil Square";
$medal_desc17 = "Você ganha esse Prêmio se conquistar o TOP Devil Square Semanal";
$medal_desc18 = "Você ganha esse Prêmio se você for um membro da guild dona do castle siege(Prêmio adicionado toda segunda-feira 00:00hs)";
$medal_desc19 = "Você ganha esse Prêmio se conquistar o BLOOD CASTLE Semanal";
$medal_desc20 = "Você ganha esse Prêmio se tiver mais de 150 dias vip";
$medal_desc21 = "Você ganha esse Prêmio se ficar pelo menos 1 dia em primeiro no ranking BLOOD CASTLE Geral";
$medal_desc22 = "Você ganha esse Prêmio se consguir 50.000 pontos do Evento Survivor (Rei do PvP Geral)";
$medal_desc23 = "Você ganha esse Prêmio se vencer 100 duelos";
$medal_desc24 = "Você ganha esse Prêmio se ficar em primeiro no evento de Duelo Semanal";
$medal_desc25 = "Você ganha esse Prêmio se for o TOP Contribuinte do Mês";
$medal_desc26 = "Você ganha esse Prêmio se completar 35 missões ou mais";
$medal_desc27 = "Você ganha esse Prêmio se ficar em primeiro no TOP semanal Hero";
$medal_desc28 = "Você ganha esse Prêmio se ficar em primeiro no TOP Mensal Hero";
$medal_desc29 = "Você ganha esse Prêmio se conquistar o CHAOS CASTLE Semanal";
$medal_desc30 = "Você ganha esse Prêmio se realizar o evento coleção de souls";

if ($nivel_gm_medal >1) {

$mm='Medalhas:';

$medal_1 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_41.gif' title='$medal_desc1' alt = '$medal_desc1'> ";
$medals .= $medal_1;
$medal_2 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_46.gif' title='$medal_desc2' alt = '$medal_desc2'> ";
$medals .= $medal_2;
$medal_3 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_51.gif' title='$medal_desc3' alt = '$medal_desc3'> ";
$medals .= $medal_3;
$medal_4 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_14.gif' title='$medal_desc4' alt = '$medal_desc4'> ";
$medals .= $medal_4;
$medal_5 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_44.gif' title='$medal_desc5' alt = '$medal_desc5'> ";
$medals .= $medal_5;
$medal_6 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_43.gif' title='$medal_desc6' alt = '$medal_desc6'> ";
$medals .= $medal_6;
$medal_7 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_38.gif' title='$medal_desc7' alt = '$medal_desc7'> ";
$medals .= $medal_7;
$medal_8 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_17.gif' title='$medal_desc8' alt = '$medal_desc8'> ";
$medals .= $medal_8;
$medal_9 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_37.gif' title='$medal_desc9' alt = '$medal_desc9'> ";
$medals .= $medal_9;
$medal_10 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_22.gif' title='$medal_desc10' alt = '$medal_desc10'> ";
$medals .= $medal_10;
$medal_11 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_12.gif' title='$medal_desc11' alt = '$medal_desc11'> ";
$medals .= $medal_11;
$medal_12 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_13.gif' title='$medal_desc12' alt = '$medal_desc12'> ";
$medals .= $medal_12;
$medal_13 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_40.gif' title='$medal_desc13' alt = '$medal_desc13'> ";
$medals .= $medal_13;
$medal_14 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_18.gif' title='$medal_desc14' alt = '$medal_desc14'> ";
$medals .= $medal_14;
$medal_15 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_48.gif' title='$medal_desc15' alt = '$medal_desc15'> ";
$medals .= $medal_15;
$medal_16 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_39.gif' title='$medal_desc16' alt = '$medal_desc16'> ";
$medals .= $medal_16;
$medal_17 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_16.gif' title='$medal_desc17' alt = '$medal_desc17'> ";
$medals .= $medal_17;
$medal_18 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_31.gif' title='$medal_desc18' alt = '$medal_desc18'> ";
$medals .= $medal_18;
$medal_19 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_42.gif' title='$medal_desc19' alt = '$medal_desc19'> ";
$medals .= $medal_19;
$medal_20 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n18.gif' title='$medal_desc20' alt = '$medal_desc20'> ";
$medals .= $medal_20;
$medal_21 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n4.gif' title='$medal_desc21' alt = '$medal_desc21'> ";
$medals .= $medal_21;
$medal_22 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n16.gif' title='$medal_desc22' alt = '$medal_desc22'> ";
$medals .= $medal_22;
$medal_23 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n15.gif' title='$medal_desc23' alt = '$medal_desc23'> ";
$medals .= $medal_23;
$medal_24 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n12.gif' title='$medal_desc24' alt = '$medal_desc24'> ";
$medals .= $medal_24;
$medal_25 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n10.gif' title='$medal_desc25' alt = '$medal_desc25'> ";
$medals .= $medal_25;
$medal_26 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n7.gif' title='$medal_desc26' alt = '$medal_desc26'> ";
$medals .= $medal_26;
$medal_27 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n14.gif' title='$medal_desc27' alt = '$medal_desc27'> ";
$medals .= $medal_27;
$medal_28 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n13.gif' title='$medal_desc28' alt = '$medal_desc28'> ";
$medals .= $medal_28;
$medal_29 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n24.gif' title='$medal_desc29' alt = '$medal_desc29'> ";
$medals .= $medal_29;
$medal_30 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n22.gif' title='$medal_desc30' alt = '$medal_desc30'> ";
$medals .= $medal_30;

} else {

if ($medal_f)
{

if ($medal_f) $mm='Medalhas:';

If ($medal_f[0] == 1)
{
$medal_1 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_41.gif' title='$medal_desc1' alt = '$medal_desc1'> ";
$medals .= $medal_1;
}

If ($medal_f[1] == 1)
{
$medal_2 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_46.gif' title='$medal_desc2' alt = '$medal_desc2'> ";
$medals .= $medal_2;
}

If ($medal_f[2] == 1)
{
$medal_3 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_51.gif' title='$medal_desc3' alt = '$medal_desc3'> ";
$medals .= $medal_3;
}

If ($medal_f[3] ==1)
{
$medal_4 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_14.gif' title='$medal_desc4' alt = '$medal_desc4'> ";
$medals .= $medal_4;
}

If ($medal_f[4] == 1)
{
$medal_5 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_44.gif' title='$medal_desc5' alt = '$medal_desc5'> ";
$medals .= $medal_5;
}

If ($medal_f[5] == 1)
{
$medal_6 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_43.gif' title='$medal_desc6' alt = '$medal_desc6'> ";
$medals .= $medal_6;
}

If ($medal_f[6] == 1)
{
$medal_7 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_38.gif' title='$medal_desc7' alt = '$medal_desc7'> ";
$medals .= $medal_7;
}

If ($medal_f[7] == 1)
{
$medal_8 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_17.gif' title='$medal_desc8' alt = '$medal_desc8'> ";
$medals .= $medal_8;
}

If ($medal_f[8] == 1)
{
$medal_9 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_37.gif' title='$medal_desc9' alt = '$medal_desc9'> ";
$medals .= $medal_9;
}

If ($medal_f[9] == 1)
{
$medal_10 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_22.gif' title='$medal_desc10' alt = '$medal_desc10'> ";
$medals .= $medal_10;
}

If ($medal_f[10] == 1)
{
$medal_11 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_12.gif' title='$medal_desc11' alt = '$medal_desc11'> ";
$medals .= $medal_11;
}

If ($medal_f[11] == 1)
{
$medal_12 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_13.gif' title='$medal_desc12' alt = '$medal_desc12'> ";
$medals .= $medal_12;
}

If ($medal_f[12] == 1)
{
$medal_13 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_40.gif' title='$medal_desc13' alt = '$medal_desc13'> ";
$medals .= $medal_13;
}

If ($medal_f[13] == 1)
{
$medal_14 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_18.gif' title='$medal_desc14' alt = '$medal_desc14'> ";
$medals .= $medal_14;
}

If ($medal_f[14] == 1)
{
$medal_15 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_48.gif' title='$medal_desc15' alt = '$medal_desc15'> ";
$medals .= $medal_15;
}

If ($medal_f[15] == 1)
{
$medal_16 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_39.gif' title='$medal_desc16' alt = '$medal_desc16'> ";
$medals .= $medal_16;
}

If ($medal_f[16] == 1)
{
$medal_17 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_16.gif' title='$medal_desc17' alt = '$medal_desc17'> ";
$medals .= $medal_17;
}

If ($medal_f[17] == 1)
{
$medal_18 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_31.gif' title='$medal_desc18' alt = '$medal_desc18'> ";
$medals .= $medal_18;
}

If ($medal_f[18] == 1)
{
$medal_19 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_42.gif' title='$medal_desc19' alt = '$medal_desc19'> ";
$medals .= $medal_19;
}

If ($medal_f[19] == 1)
{
$medal_20 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n18.gif' title='$medal_desc20' alt = '$medal_desc20'> ";
$medals .= $medal_20;
}

If ($medal_f[20] == 1)
{
$medal_21 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n4.gif' title='$medal_desc21' alt = '$medal_desc21'> ";
$medals .= $medal_21;
}

If ($medal_f[21] == 1)
{
$medal_22 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n16.gif' title='$medal_desc22' alt = '$medal_desc22'> ";
$medals .= $medal_22;
}

If ($medal_f[22] == 1)
{
$medal_23 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n15.gif' title='$medal_desc23' alt = '$medal_desc23'> ";
$medals .= $medal_23;
}

If ($medal_f[23] == 1)
{
$medal_24 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n12.gif' title='$medal_desc24' alt = '$medal_desc24'> ";
$medals .= $medal_24;
}

If ($medal_f[24] == 1)
{
$medal_25 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n10.gif' title='$medal_desc25' alt = '$medal_desc25'> ";
$medals .= $medal_25;
}

If ($medal_f[25] == 1)
{
$medal_26 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n7.gif' title='$medal_desc26' alt = '$medal_desc26'> ";
$medals .= $medal_26;
}
If ($medal_f[26] == 1)
{
$medal_27 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n14.gif' title='$medal_desc27' alt = '$medal_desc27'> ";
$medals .= $medal_27;
}
If ($medal_f[27] == 1)
{
$medal_28 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n13.gif' title='$medal_desc28' alt = '$medal_desc28'> ";
$medals .= $medal_28;
}
If ($medal_f[28] == 1)
{
$medal_29 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n24.gif' title='$medal_desc29' alt = '$medal_desc29'> ";
$medals .= $medal_29;
}
If ($medal_f[29] == 1)
{
$medal_30 = 		"<img src='" . CLASSTPATH . "/img/medals/medal_n22.gif' title='$medal_desc30' alt = '$medal_desc30'> ";
$medals .= $medal_30;
}
}
}

?>