<link rel="stylesheet" type="text/css" media="all" href="css/tabs.css" />
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<article class="tabs">


<?


for($i=0;$i < $xex_s;++$i)
{
$row_s = mssql_fetch_row($result_s);

$nome        = $row_s[0];
$patente_num = $row_s[1];
$patenten    = $row_s[2];
$bloc_c      = $row_s[3];
$razao       = $row_s[4];
$char_s      = $row_s[5];
$diasb       = $row_s[6];
$mresets     = $row_s[7];
$resets      = $row_s[8];

$dado49= $row_s[9]; // medal evento
$dado50= $row_s[10]; // medal reset
$dado51= $row_s[11]; // medal sreset
$dado52= $row_s[12]; // medal mreset
$dado53= $row_s[13]; // medal smreset
$dado54= $row_s[14]; // medal tempo
$dado55= $row_s[15]; // medal pk
$dado56= $row_s[16]; // medal exp
$dado57= $row_s[17]; // medal gm
$dado74= $row_s[22]; // medal tempo mensal
$dado75= $row_s[18]; // medal resets mensal
$dado76= $row_s[19]; // medal mresets mensal
$dado77= $row_s[20]; // medal eventos mensal
$dado78= $row_s[21]; // medal pk mensal
$dado81= $row_s[23]; // medal ds
$dado82= $row_s[24]; // medal ds semanal
$dado83= $row_s[25]; // medal rei

$medal_evento = '';
$medal_reset = '';
$medal_sreset = '';
$medal_mreset = '';
$medal_smreset = '';
$medal_tempo = '';
$medal_pk = '';
$medal_exp = '';
$medal_gm = '';
$medal_reputacao = '';
$medal_resets_m = '';
$medal_mresets_m = '';
$medal_eventos_m  = '';
$medal_pk_m = '';
$medal_ds = '';
$medal_ds_s = '';
$medal_rei = '';

$repu_check = mssql_num_rows(mssql_query("select name from character where accountid='$login' and medal_reputacao=1"));


If ($dado49==1){
$medal_evento = "<img src='http://mukoreia.net/img/medals/medal_41.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Eventos'>";
}

If ($dado50 ==1){
$medal_reset = "<img src='http://mukoreia.net/img/medals/medal_46.gif' title='Você ganha esse Prêmio se ficar pelo menos 1 dia em primeiro no ranking de Resets'>";
}

If ($dado51==1){
$medal_sreset = "<img src='http://mukoreia.net/img/medals/medal_51.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Resets'>";
}

If ($dado52 ==1){
$medal_mreset = "<img src='http://mukoreia.net/img/medals/medal_55.gif' title='Você ganha esse Prêmio se ficar pelo menos 1 dia em primeiro no ranking de Master Resets'>";
}

If ($dado53==1){
$medal_smreset = "<img src='http://mukoreia.net/img/medals/medal_44.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Master Resets'>";
}

If ($dado54==1){
$medal_tempo = "<img src='http://mukoreia.net/img/medals/medal_43.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Tempo'>";
}

If ($dado55==1){
$medal_pk = "<img src='http://mukoreia.net/img/medals/medal_38.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP semanal de Mortes'>";
}

If ($dado56==1){
$medal_exp = "<img src='http://mukoreia.net/img/medals/medal_60.gif' title='Você ganha esse Prêmio se ficar pelo menos 1 dia em primeiro no ranking de Patentes(exp)'>";
}

If ($dado57==1){
$medal_gm = "<img src='http://mukoreia.net/img/medals/medal_37.gif' title='Você ganha esse Prêmio se fizer as 20 primeiras quests do site'>";
}

If ($repu_check>0){
$medal_reputacao = "<img src='http://mukoreia.net/img/medals/medal_61.gif' title='Você ganha esse Prêmio se conseguir a melhor reputação(quantidade de votos positivos menos votos negativos, o total tem que ser o maior do server)'>";
}

If ($dado74==1){
$medal_tempo_m = "<img src='http://mukoreia.net/img/medals/medal_12.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Tempo'>";
}

If ($dado75==1){
$medal_resets_m = "<img src='http://mukoreia.net/img/medals/medal_13.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Resets'>";
}

If ($dado76==1){
$medal_mresets_m = "<img src='http://mukoreia.net/img/medals/medal_57.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Master Resets'>";
}

If ($dado77==1){
$medal_eventos_m = "<img src='http://mukoreia.net/img/medals/medal_18.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Eventos'>";
}

If ($dado78==1){
$medal_pk_m = "<img src='http://mukoreia.net/img/medals/medal_48.gif' title='Você ganha esse Prêmio se ficar em primeiro no TOP Mensal de Mortes'>";
}

If ($dado81==1){
$medal_ds = "<img src='http://mukoreia.net/img/medals/medal_10.gif' title='Você ganha esse Prêmio se ficar em primeiro no Ranking geral da Devil Square'>";
}

If ($dado82==1){
$medal_ds_s = "<img src='http://mukoreia.net/img/medals/medal_16.gif' title='Você ganha esse Prêmio se conquistar o TOP Devil Square Semanal'>";
}

If ($dado83==1){
$medal_rei = "<img src='http://mukoreia.net/img/medals/medal_31.gif' title='Você ganha esse Prêmio se for um membro da guild vencedora do Rei do MK Semanal'>";
}

include '../inclu/patentes.php';

if ( $i == 0 ) { $ativado = 'class = ativado'; }

echo "
	<section id='tab$i'>
		<h2 $ativado><a href='#tab$i' class = 'linka'>$nome</a></h2>
<p>
<table border=0 width=900 cellSpacing=1 align=center>
    <tr>
	<td rowspan=2><img src='../img/$img.jpg' class=redondo2></td>
	<td colspan=4>Você selecionou o personagem  <b>$nome</b> <br> 
$medal_evento
$medal_reset
$medal_sreset
$medal_mreset
$medal_smreset
$medal_tempo
$medal_pk
$medal_exp
$medal_gm
$medal_reputacao
$medal_tempo_m
$medal_resets_m
$medal_mresets_m
$medal_eventos_m
$medal_pk_m
$medal_ds
$medal_ds_s
$medal_rei</td>
    </tr>
    <tr>
      <td><a href='../info_char_pop.php?server=$server&name=$nome&painel=ok' target='main2'>Informações</a></td>
      <td><a href='add_$server.php?char=$nome' target='main2'>Distribuir Pontos</a></td>
      <td><a href='move.php?name=$nome' target=main2>Mover Personagem</td>
      <td><a href='mudar_patente.php?char=$nome' target='main2'>Mudar Patente</a></td>
      <td><a href='quest_done_$server.php?personagem=$nome' target=main2>Quests</a></td>
      <td><a href='resetar.php?show=$nome&resetar=ok' target=main2>Resetar</a></td>
      <td></td>
      <td></td>
    </tr>
</tr>
</table>
</p>
	</section>";
}

?>	

</article>


<script>

$('.abas li:first-child').addClass('ativo');

$('.linka').click(function(){
$('html, body').animate({scrollTop: '0'}, 800);
 });


</script>
