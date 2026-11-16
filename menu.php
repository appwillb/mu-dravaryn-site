<?
$dados_server = mssql_fetch_row(mssql_query("SELECT * from dbo.fn_info()"));


$server_on 	= $dados_server[0];
$acr2 		= $dados_server[1];
$acr3 		= $dados_server[2];
?>


<script src="js/jquery.min.js"></script>        
<link rel="stylesheet" href="css/menu_novo.css">


 <br>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src=img/home.png>&nbsp;<a href="site.php"><font color=white size=2><b> Página inicial</b></font></a>
<div id="wrapper">
    <ul class="menu1">
	<li class="item0" style="height: <? echo $size_menu;?>;"><div>

		<table height=100%><tr><td><center>

		<? 

		if ((isset($_COOKIE["usuario"])) && (isset($_COOKIE["senha"])) and !$off) {

		?>

		<center>


		<table width=200><tr><td><center>
		<img src=<? echo $avatar;?> width=100 style='border-radius: 50%;'><Br>

		</td><tr><td valign=top><center>
		Logado como <b><? echo $_COOKIE["usuario"];?>.</b><br> 
		</td></tr>

		<tr>
		<td><center>
		<form id="LoginBox" TARGET="_blank" action="painel/conta2.php" method="post">
		<input type='hidden' name='login' value='<? echo $_COOKIE["usuario"];?>'>
		<input type='hidden' name='oldpwd' value='<? echo $_COOKIE["senha"]; ?>'>
		<input type="image" name="img" title="Entrar no painel" src="img/logarpainel.png" onclick="submit();" style="border:0;" />
		
		<a href="logar.php?deslogar=ok"> Trocar de usuário?</a>
		</td></form></tr>

		</table> 

		<? 

		} else { 

		?>

		<form id="LoginBox" action="logar.php" method="post">
		<table width=220 border=0 align=center> <tr>
			<td align=right><b>LOGIN:</b> </td>
			<td><span><input type="text" name="login" maxlength="10" autocomplete="off" title="Login" style='width:130px;'/> </span> </td>
			</tr>

			<tr>
			<td align=right><b>SENHA:</b> </td>
			<td><input type="password" name="oldpwd" maxlength="10" autocomplete="off" title="Senha" style='width:130px;' /> </td>
			</tr>

			<tr>	
				<td colspan=2>	<center>		<input type="image" name="PartymuLogin" id="PartymuLogin" tabindex="3" title="LOGIN" src="img/BT_login.png" onclick="return fnValidateForm();" style="border:0;" /></form> </td>
			</tr>
	
		</table>

						
			

			<a href="recuperar_senha.php" target=main2><font color=white>Esqueceu sua senha?</a><bR>
			
		

		<? } ?>

		<table width=220 border=0 align=center>
			<tr><td width=15> &nbsp; </td><td><b>&nbsp; 		</td> 	<td>&nbsp; 		</td></tr>
			<tr><td colspan=3><center><b>Informações: 		</td></tr>
			<tr><td> </td><td><b>Versão: 		</td> 	<td> Ex803	</td></tr>
			<tr><td> </td><td><b>Exp Free: 		</td> 	<td> 9.000x 	</td></tr>
			<tr><td> </td><td><b>Exp VIP:		</td> 	<td> 9.999x 	</td></tr>			
			<tr><td> </td><td><b>Contas: 		</td> 	<td> <? echo $acr2;?> 	</td></tr>
			<tr><td> </td><td><b>Personagens:	</td> 	<td> <? echo $acr3;?> 	</td></tr>
			<tr><td> </td><td><b>Max Status:	</td> 	<td> 65.000	</td></tr>
			<tr><td> </td><td><b>BugBless:		</td> 	<td> OFF		</td></tr>
			<tr><td> </td><td><b> Tipo Reset:	</td> 	<td> Acumulativo	</td></tr>
			<tr><td> </td><td><b>Level reset:	</td> 	<td> 400	</td></tr>
			<tr><td> </td><td><b> Drop:		</td> 	<td> 85%	</td></tr>
			<tr><td> </td><td><b> 			</td> 	<td> 		</td></tr>

		</table>


			</td></tr></table>

		</div>
            <ul>
            </ul>
	</li>

        <li class="item2"><div><a href="cadastro.php" target="main2">Cadastre-se</a> </div>       </li>
        <li class="item3"><div><a href="dwn.php" target="main2">Download</a> </div>       </li>
        <li class="itemcom"><a href="#">Comandos <span> <img src=img/ButtonDown.png>  </span></a>
            <ul>
 	       <li> <span>/post - Enviar Msg à Todos </span></li>
 	       <li> <span>/resetar - Resetar personagem </span></li>
 	       <li> <span>/mreset  - Master Reset </span></li>
 	       <li> <span>/f - Adicionar Força</span></li>
 	       <li> <span>/a - Adicionar Agilidade </span></li>
 	       <li> <span>/v - Adicionar Vitalidade </span></li>
 	       <li> <span>/e - Adicionar Energia </span></li>
 	       <li> <span>/limparpk - Limpa Killer</span></li>
 	       <li> <span>/bau NUMERO_BAU </span></li>
 	       <li> <span>/evoluir </span></li>
 	       <li> <span>/loja creditos </span></li>
 	       <li> <span>/loja golds </span></li>
 	       <li> <span>/loja mgolds </span></li>
	   </ul>
        </li>

        <li class="item4"><div><a href="imagens.php" target="main2">Imagens</a> </div>       </li>
       
        <li class="item5"><a href="#">Informações <span> <img src=img/ButtonDown.png>  </span></a>
            <ul>
 	       <li><a href=tutoriais.php target='main2'><img src=img/icon-arrow-circle-4085da.png width=20> Tutoriais</font></a> </li>
 	       <li><a href=patentes.php target='main2'><img src=img/icon-arrow-circle-4085da.png width=20> Patentes</font></a> </li>
 	       <li><a href=reputacao.php target='main2'><img src=img/icon-arrow-circle-4085da.png width=20> Reputação</font></a> </li>
 	       <li><a href=medalhas.php target='main2'><img src=img/icon-arrow-circle-4085da.png width=20> Medalhas</font></a> </li>
 	       <li><a href=talismas.php target='main2'><img src=img/icon-arrow-circle-4085da.png width=20> Talismãs</font></a> </li>
            </ul>
        </li>

        <li class="itemeventos"><a href="#">Eventos <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
 	       <li><a href=evento_arena.php target='main2'><img src=/img/pvp.png width=20> Arena Custom</font></a> </li>
 	       <li><a href=evento_goldens.php target='main2'><img src=/img/star_golden.png width=20> Caça aos Goldens</font></a> </li>
 	       <li><a href=evento_fenix_semanal.php target='main2'><img src=/img/new_redirect.png width=20> Caça a Fenix</font></a> </li>
 	       <li><a href=evento_duelo_semanal.php target='main2'><img src=/img/bb1.gif width=20> Duelo Semanal</font></a> </li>
 	       <li><a href=evento_devil_semanal.php target='main2'><img src=/img/skull.gif width=20> Devil Square Semanal</font></a> </li>
 	       <li><a href=evento_bc_semanal.php target='main2'><img src=/img/skull.gif width=20> Blood Castle Semanal</font></a> </li>
            </ul>
        </li>

        <li class="item6"><a href="#">Tops <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
 	       <li><a href=tops_mensal.php target='main2'><img src=img/M.gif width=20> Top Mensal</font></a> </li>
 	       <li><a href=tops_semanal.php target='main2'><img src=img/S.gif width=20> Top Semanal</font></a> </li>
 	       <li><a href=tops_diario.php target='main2'><img src=img/D.gif width=20> Top Diário</font></a> </li>
 	       <li><a href=tops_compras_anual.php target='main2'><img src=img/CB.gif width=20> Top Contribuinte(Anual)</font></a> </li>
            </ul>
        </li>

        <li class="itemrank"><a href="#">Ranking <span> <img src=img/ButtonDown.png> </span></a>
            <ul>
 	       <li><a href=ranking.php target='main2'><img src=img/legend5.png width=20> Ranking Geral</font></a> </li>
 	       <li><a href=guilds.php target='main2'><img src=img/guild.png width=20> Ranking Guilds</font></a> </li>
 	       <li><a href=ranking_duelo.php target='main2'><img src=img/castle.gif width=20> Ranking Duelo</font></a> </li>
		<li><a href=ranking_gens.php target='main2'><img src=img/Demonic_Shield.png width=20> Ranking Gens</font></a> </li> 	       
		<li><a href=ranking_medal.php target='main2'><img src=img/rg-medal-on-icon.png width=20> Ranking Medalhas</font></a> </li>
 	       <li><a href=ranking_ds.php target='main2'><img src=img/skull.png width=20> Ranking Devil Square</font></a> </li>
 	       <li><a href=ranking_bc.php target='main2'><img src=img/castle.gif width=20> Ranking Blood Castle</font></a> </li>
            </ul>
        </li>

        <li class="item7"><div><a href="contato.php" target='main2'>Contato </span></a> </div>       </li>

<?
if ($msconnect) {
$data_dia = date("d");
$data_ano = date("Y");
$data_mes = date("m");

$media_on     = mssql_fetch_row(mssql_query("SELECT top 1 login, sum(valor_depositado) as valor,dbo.fn_char_forte(login),dbo.fn_exp(dbo.fn_char_forte(login)) FROM MK_pagamentos WHERE data_pg > '$data_mes/01/$data_ano 00:00:00' group by login order by valor desc"));

$char_forte = $media_on[2];
$patente_num = $media_on[3];

//$char_forte = mssql_fetch_row(mssql_query( "Select top 1 name,exp_war from character where accountid='$media_on[0]' and nivel_gm<2 order by masterresetcount desc,resetcount desc,clevel desc"));
//$patente_num = $char_forte[1];

}
include 'inclu/patentes.php';

?>
	<li class="item0" style="height: 450px;"><div>
		<? echo "<table width=220 border=0 cellspacing=2>
		<tr>
		    <td><center><bR><b>
			<font size=2>Contribuinte do Mês<br>
		    </td></tr>
		<tr>
			<td><center><a href='info_char_pop.php?server=easy&painel=ok&name=$char_forte' target=main2><img src='../img/$img.jpg' class=redondo2><br><font size=2><b>$char_forte</a><br></font>";?>

</td>
		</tr>

		</table>

<table width=220 border=0 cellspacing=2>
		<tr>
		    <td><center><bR><b>
			<font size=2>Vote no servidor<br>
		    </td></tr>
		<tr>
			<td>
<center>
<!-- Begin XtremeTop100 code -->
<a href="http://www.xtremetop100.com/in.php?site=1132360378" target=_blank title="Mu Online Servers">
<img src="http://www.xtremeTop100.com/votenew.jpg" border="0" alt="Mu Online Servers">
</a>
<!-- End XtremeTop100 code --><br>

<!--Begin Top Servers 200 Vote--><a  href="http://www.topservers200.com/in.php?id=5674"  target="_blank"><img  src="http://www.topservers200.com/button/5674.png" alt="Vote no Top 200" border="0"></a><!--End Top Servers 200 Code--><br />
<a href="http://mmoserver.pro/in/jogandomu" target="_blank"><img src="http://mmoserver.pro/assets/images/mu.png" title="Mu Online Top 100" alt="Mu Online Top 100" border="0"></a>


</td>
		</tr>

		</table><br><BR>


		</div>
            <ul>
            </ul>
	</li>
    </ul>
 
</div>

<script type="text/javascript">
$(document).ready(function(){
atualiza();
});

function atualiza(){
$.get('atumsg.php?login=<? echo $login;?>',{ num: Math.random() }, function(resultado){
$('#msgatu').empty().html(resultado);
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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
