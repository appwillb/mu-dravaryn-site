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

<? 
include("inclu/config_simples.php");

$top =   $_GET['top'];
$raca =  $_GET['raca'];
$order = $_GET['order'];
$vip =   $_GET['vip'];

?>
<center><BR><BR><font size=3><b>RANKING DE MEDALHAS</b></font><bR><bR>

<?php

$query = "
select top 25 
name,
dbo.fn_acc(name),
medal_evento,
medal_resets,
medal_mresets,
medal_tempo,
medal_sresets,
medal_smresets,
medal_pk,
medal_exp,
medal_gm,
medal_reputacao,
medal_evento_m,
medal_resets_m,
medal_mresets_m,
medal_tempo_m,
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
medal_missao,
dbo.fn_medal(login,2),
dbo.fn_medal(login,3),
medal_hr,
medal_hr_m,
medal_cc_s,
medal_joias,
medal_evento+
medal_resets+
medal_mresets+
medal_tempo+
medal_sresets+
medal_smresets+
medal_pk+
medal_exp+
medal_gm+
medal_reputacao+
medal_evento_m+
medal_resets_m+
medal_mresets_m+
medal_tempo_m+
medal_pk_m+
medal_ds+
medal_ds_s+
medal_rei+
medal_bc_s+
medal_vip+
medal_bc+
medal_rei_conquistas+
medal_duel+
medal_duel_semanal+
dbo.fn_medal(dbo.fn_acc(name),2)+
dbo.fn_medal(dbo.fn_acc(name),3)+
medal_hr+
medal_hr_m+
medal_cc_s+
medal_joias as total,
dbo.fn_img(dbo.fn_acc(name))
 from mk_medalhas  
order by total desc";
$result = mssql_query( $query );

echo "<center><table width=750 border=0 cellSpacing=0 align=center>";
echo "<thead><tr>
<th>Rank</th>
<th class='bgtr'>Medalhas</th>
<th class='bgtr'>Character</th>
<th class='bgtr'><center>Medalhas</th>
<th class='bgtr'>Total</th>
</tr></thead>";

for($i=0;$i < 25;++$i)
{
$row = mssql_fetch_row($result);

if ($row[34]){
$avatar ="avatar/thumb.php?imagem=$row[34]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}

$medals = '';

$medal_char= $row[0];
include("inclu/medalhas.php");


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\">";
echo "<td width=30 align=rigth><center><font size=2>";
echo $i + 1;
echo '°</td><td width=32>';
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo '</td><td width=80>';
echo "<B>$row[0]";
echo '</font></td><td width=550>';
echo "
$medals";
echo '</td><td width=70><center>';
echo "<font size=3><b>$row[33]";
echo '</tr>';
}
echo "</table>";

?>

</div>
