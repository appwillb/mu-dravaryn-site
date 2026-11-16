<?PHP
$tabelastaff ='';

if ($nivel_gm == 1){
$tabelaj = "<li><a href='gm/banir.php' target='main2'><img src=img/abuso.png width=20> Banir Personagem</a></li>";
}

if ($nivel_gm == 2 || $nivel_gm == 3){

$tabelgm = "
        <li><a href='gm/pontos_eventos.php' target='main2'><img src=img/i_sell.gif width=20> Distribuir Golds</a></li>
	<li><a href='gm/log_gm.php' target='main2'><img src=img/parchment.png width=20> Log GM</font></a></li>
        <li><a href='gm/banir.php' target='main2'><img src=img/abuso.png width=20> Banir Personagem</a></li>
        <li><a href='../imagens/upload.php' target='main2'><img src=img/table-config.png width=20>Gerenciar Imagens</a></li>
";
}

if ($nivel_gm == 4 || $nivel_gm == 5){

$tabeladm = "
	<li><a href='gm/gerenciar_pagamentos.php' target='main2'><img src=img/ico_valor.png width=20> Gerenciar Pagamentos</font></a></li>
	<li><a href='gm/gerenciar_staff.php' target='main2'><img src=img/locko.png width=20> Gerenciar Staff</font></a></li>
        <li><a href='gm/editar_conta.php' target='main2'><img src=img/Edit.gif width=20> Editar Conta/Personagem</font></a></li>
        <li><a href='gm/localizar_ipmail.php' target='main2'><img src=img/bnt_lupa2.png width=20> Rastreador</a></li>
        <li><a href='gm/divulgacoes.php' target='main2'><img src=img/megafone.gif width=20> Divulgações</font></a></li>
        <li><a href='gm/pontos_eventos.php' target='main2'><img src=img/i_sell.gif width=20> Distribuir Golds</a></li>
        <li><a href='gm/banir.php' target='main2'><img src=img/abuso.png width=20> Banir Personagem</a></li>
        <li><a href='gm/news/admin.php' target='main2'><img src=img/icon_news.png width=20>Gerenciar Notícias</a></li>
        <li><a href='../imagens/upload.php' target='main2'><img src=img/table-config.png width=20>Gerenciar Imagens</a></li>
        <li><a href='gm/logs.php' target='main2'><img src=img/parchment.png width=20> Logs</font></a></li>";
}

if ($nivel_gm > 0 ) {
$tabelastaff = "
        <li class='itemgm'><a href='#'>Administração <span> <img src=img/ButtonDown.png> </span></a>
      <ul>
        <li><a href='../gm_vantagens.php' target='main2'><img src=img/sign56.gif width=20> Regras</a></li>
        <li><a href='gm/info_char.php' target='main2'><img src=img/mlp_question_mark.gif width=20> Info Char</a></li>
	$tabelaj
 	$tabelgm
	$tabeladm
	<li><a href='gm/desbanir.php' target='main2'><img src=img/locko.png width=20> Desbanir Char</font></a></li>
      </ul>
   </li>";
}

?>


<div id="wrapper">
    <ul class="menu1">
	<li class="item0" style="height: 350px;"><div><center>
		<? echo "<table width=210 border=0 height=350 cellspacing=2 >

		<tr>
			<td colspan=2><center><img src=img/home.png>&nbsp;<a href='conta2.php' style='text-decoration: none;'><font color=white size=2><b> Página inicial</b></font></a></td>
		</tr>

		<tr>

		    <td colspan=2><center>
			<a href='avatar.php' target='main2'><img src=$avatar height=150 style='border: 1px solid #999999;height: 150px;' class=redondo2></a>
		    </td></tr>
		<tr>
			<td colspan=2><center><font size=2 color=white><b> Conta:</b> <u><a href='minhaconta.php' target='main2'>$login</a></u> $status</td>
		</tr>

		<tr>

			<td>Tipo:</td>
			<td align=right>$tipo</td>

		</tr>
		<tr>
			<td>Termino VIP:</td>
			<td align=right><b>$vip_time</td>

		</tr>

		<tr>
			<td width=90>Créditos:</td>
			<td align=right><b><font color=grenn>$creditos</td>
		</tr>

		<tr>
			<td>Master Golds:</td>
			<td align=right><b>$mgolds</td>

		</tr>

		<tr>
			<td>Golds:</td>
			<td align=right><b>$golds</td>

		</tr>

		<tr>
			<td>Prêmio VIP em:</td>
			<td align=right onmouseover=\"Tip('Tempo online para ganhar 1 dia vip!');\" onmouseout=\"UnTip();\"><b> $h Hs $m min </td>
		</tr>
		<tr>
			<td></td>
			<td></td>
		</tr>

		</table>";?>
		</div>
            <ul>
            </ul>
	</li>
		
		<?=$menu_eleger;?>
		<?=$tabelastaff;?>
        <li class="item2"><div><a href="noticias.php" target="main2">Notícias</a> </div>       </li>
        <li class="item_dv"><div><a href="divulgar_link.php" target="main2">Divulgar o Jogo</a> </div>       </li>
        <li class="itemshop"><div><a href="shop_como_comprar.php" target="main2">Como obter créditos</a> </div>       </li>
        <li class="item3"><a href="#">Opções <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
		<? echo $add_lan;?>
        	<li><a href=minhaconta.php target='main2'><img src=img/Edit.gif width=20> Informações da conta</font></a></li>
        	<li><a href=minha_reputacao.php target='main2'><img src=img/parchment.png width=20> Reputação</font></a></li>
        	<li><a href=mudar_senha.php target='main2'><img src=img/lock.png width=20> Mudar Senha</font></a></li>
        	<li><a href=extrato.php target='main2'><img src=img/imprimir.gif width=20> Extrato</font></a></li>
       		<li><a href=mudar_senha_bau.php target='main2'><img src=img/thread_lock.gif width=20> Senha Báu</font></a></li>
        	<li><a href=mudar_char.php target='main2'><img src=img/ico_trocarUf.png width=20> Transferir Personagem</font></a></li>
        	<li><a href=mudar_creditos.php target='main2'><img src=img/ico_trocarUf.png width=20> Transferir Créditos</font></a></li>
        	<li><a href=mudar_bandeira.php target='main2'><img src=img/flagsel.png width=20> Mudar Bandeira</font></a></li>
            </ul>
        </li>
        <li class="item4"><a href="#">Opções VIP <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
        	<li><a href=reputacao.php target='main2'><img src=img/positivo.gif width=20> Adicionar Reputação</font></a></li>
        	<li><a href=mudar_reputacao.php target='main2'><img src=img/Edit.gif width=20> Mudar Reputação</font></a></li>
        	<li><a href=mudar_nome_2.php target='main2'><img src=img/billiards-forum.png width=20> Mudar Nome</font></a></li>
        	<li><a href=mudar_ordem.php target='main2'><img src=img/ico_trocarUf.png width=20> Mudar Ordem Personagem</font></a></li>
            </ul>
        </li>
        <li class="itemeventos"><a href="#">Eventos <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
 	       <li><a href=rei_mu.php target='main2'><img src=img/King.png width=20> Rei do MU</font></a> </li>
 	       <li><a href=../evento_arena.php target='main2'><img src=../img/pvp.png width=20> Arena Custom</font></a> </li>
 	       <li><a href=../evento_goldens.php target='main2'><img src=../img/star_golden.png width=20> Caça aos Goldens</font></a> </li>
 	       <li><a href=../evento_fenix_semanal.php target='main2'><img src=../img/new_redirect.png width=20> Caça a Fenix</font></a> </li>
 	       <li><a href=../evento_duelo_semanal.php target='main2'><img src=../img/bb1.gif width=20> Duelo Semanal</font></a> </li>
 	       <li><a href=../evento_devil_semanal.php target='main2'><img src=../img/skull2.png width=20> Devil Square Semanal</font></a> </li>
 	       <li><a href=../evento_bc_semanal.php target='main2'><img src=../img/castle2.png width=20> Blood Castle Semanal</font></a> </li>
 	       <li><a href=../evento_cc_semanal.php target='main2'><img src=../img/reputation_highpos.png width=20> Chaos Castle Semanal</font></a> </li>
 	       <li><a href=evento_k5.php target='main2'><img src=img/k5.png width=20> Evento Kundun+5</font></a> </li>
 	       <li><a href=evento_soul.php target='main2'><img src=img/soul.png width=20> Evento Soul</font></a> </li>
            </ul>
        </li>

        <li class="item6"><a href="#">Tops <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
 	       <li><a href=../tops_mensal.php target='main2'><img src=../img/M.gif width=20> Top Mensal</font></a> </li>
 	       <li><a href=../tops_semanal.php target='main2'><img src=../img/S.gif width=20> Top Semanal</font></a> </li>
 	       <li><a href=../tops_diario.php target='main2'><img src=../img/D.gif width=20> Top Diário</font></a> </li>
 	       <li><a href=../tops_compras_anual.php target='main2'><img src=../img/CB.gif width=20> Top Contribuinte(Anual)</font></a> </li>
            </ul>
        </li>

        <li class="itemrank"><a href="#">Ranking <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
 	       <li><a href=../ranking.php target='main2'><img src=img/legend5.png width=20> Ranking Geral</font></a> </li>
 	       <li><a href=../guilds.php target='main2'><img src=img/guild.png width=20> Ranking Guilds</font></a> </li>
 	       <li><a href=../ranking_duelo.php target='main2'><img src=img/castle.gif width=20> Ranking Duelo</font></a> </li>
 	       <li><a href=../ranking_gens.php target='main2'><img src=img/Demonic_Shield.png width=20> Ranking Gens</font></a> </li>
 	       <li><a href=../ranking_medal.php target='main2'><img src=img/rg-medal-on-icon.png width=20> Ranking Medalhas</font></a> </li>
 	       <li><a href=../ranking_ds.php target='main2'><img src=../img/skull2.png width=20> Ranking Devil Square</font></a> </li>
 	       <li><a href=../ranking_bc.php target='main2'><img src=../img/castle2.png width=20> Ranking Blood Castle</font></a> </li>
 	       <li><a href=../ranking_cc.php target='main2'><img src=../img/reputation_highpos.png width=20> Ranking Chaos Castle</font></a> </li>
            </ul>
        </li>
        <li class="itemmissao"><div> <a href="missoes.php" target='main2'>Missões<span><b><? echo $nmissoes;?>/37</b></span></a> </div>       </li>
        <li class="itempag"><div><a href="shop_confirmar.php" target='main2'>Confirmar Pagamento </a> </div>       </li>
        <li class="item7"><div><a href="mensagens.php" target='main2'>Mensagens <span id="msgatu"> 0 </span></a> </div>       </li>
        <li class="itemsup"><div><a href="suporte.php" target='main2'>Suporte</a> </div>       </li>
        <li class="item8"><div><a href="index.php?deslogar=ok">Deslogar</a> </div>       </li>

<?

$data_dia = date("d");
$data_ano = date("Y");
$data_mes = date("m");

$media_on     = mssql_fetch_row(mssql_query("SELECT top 1 login, sum(valor_depositado) as valor,dbo.fn_char_forte(login),dbo.fn_exp(dbo.fn_char_forte(login)) FROM MK_pagamentos WHERE data_pg > '$data_mes/01/$data_ano 00:00:00' group by login order by valor desc"));

$char_forte = $media_on[2];
$patente_num = $media_on[3];

include '../inclu/patentes.php';

?>
	<li class="item0" style="height: 230px;"><div>
		<? echo "<table width=220 border=0 cellspacing=2>
		<tr>
		    <td><center><bR><b>
			<font size=2>Contribuinte do Mês<br>(<font size=2><a href=bonus.php target=main2>Ver prêmio especial</a>)
		    </td></tr>
		<tr>
			<td><center><a href='../info_char_pop.php?server=easy&painel=ok&name=$char_forte' target=main2><img src='../img/$img.jpg' class=redondo2><br><font size=2><b>$char_forte</a><br><br></font></td>
		</tr>

		</table>";?>
		</div>
            <ul>
            </ul>
	</li>
    </ul>
 
</div>

<script src="inclu/jquery.min.js"></script> 

<link rel="stylesheet" href="css/menu_novo.css">

<script type="text/javascript">
$(document).ready(function(){
atualiza();
});


function atualiza(){

$.get('inclu/atualizar_msg.php',{ num: Math.random() }, function(resultado){
$("#msgatu").empty().html(resultado);
})

setTimeout('atualiza()', 30000);

}
</script>

<!--initiate accordion-->
<script type="text/javascript">
	$(function() {
	
	    var menu_ul = $('.menu1 > li > ul'),
	           menu_a  = $('.menu1 > li > a');
	    
	    menu_ul.hide();
	
	    menu_a.click(function(e) {
	        e.preventDefault();
	        if(!$(this).hasClass('active')) {
	            menu_a.removeClass('active');
	            menu_ul.filter(':visible').slideUp('normal');
	            $(this).addClass('active').next().stop(true,true).slideDown('normal');
	        } else {
	            $(this).removeClass('active');
	            $(this).next().stop(true,true).slideUp('normal');
	        }
	    });
	
	});
</script>