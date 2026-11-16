ï»¿<!DOCTYPE html>
<html>
<head>

<title>MU Dravaryn - Season 6 Medium Slow</title>



<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta name="title" content="MU Dravaryn Season 6"/>

<meta name="keywords" content="mu, mu online, muonline, mu online server, servidor de mu, servidor de mu online, server de mu, server de mu online, 24 horas, 24h, mmorpg, mmorpg online, rpg, rpg online, jogo de mu, jogar mu, baixar mu, download mu">

<meta name="description" content="Crie sua conta e participe dos eventos, nÃ£o perca, promoÃ§Ã£o limitada, Mu Online Season 8 Ã© na MU Dravaryn"/>

<meta name="abstract" content="Crie sua conta e participe dos eventos, nÃ£o perca, promoÃ§Ã£o limitada, Mu Online Season 8 Ã© na MU Dravaryn"/>

<meta name="distribution" content="Global"/>

<meta name="rating" content="General"/>

<meta name="Robots" content="INDEX,FOLLOW"/>

<meta name="author" content="MU Dravaryn.com.br"/>

<meta name="COPYRIGHT" content="Copyright (c) MU Dravaryn"/>


  <link type="image/x-icon" rel="shortcut icon" href="favicon.ico" />



<meta property="og:url" content="http://www.mu-dravaryn.com"/>

<meta property="og:site_name" content="MU Dravaryn"/>

<meta property="og:title" content="MU Dravaryn Season 8"/>

<meta property="og:description" content="Crie sua conta e participe dos eventos, Mu Online Season 8 - MU Dravaryn"/>

<meta property="og:image" content="http://www.mu-dravaryn.com/img/facebook4.jpg"/> 






  <link type="text/css" rel="stylesheet" href="css/site.css">

<style>
#google_translate_element,
.goog-te-banner-frame,
.goog-te-balloon-frame,
#goog-gt-tt,
.goog-te-balloon-frame,
.goog-tooltip,
.goog-tooltip:hover {
 display:none !important;
}
</style>


    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body class='pt1' leftmargin='0' topmargin='0' bottommargin='0' bgcolor=#191c23>





<div id="container">





<?PHP


require_once("inclu/config_index.php");



$size_menu = "390px";



if ((isset($_COOKIE["usuario"])) && (isset($_COOKIE["senha"])) and !$off) {



$size_menu = "450px";



$sql_dados = mssql_query("SELECT img from memb_info where memb___id='$login'"); 

$login_dados = mssql_fetch_row($sql_dados);



if ($login_dados[0]){

$avatar ="avatar/thumb.php?imagem=$login_dados[0]&y=30&x=30&qualidade=100";

}else{

$avatar ='avatar/Icon-user30.png';

}

}

$dados_server = mssql_fetch_row(mssql_query("SELECT * from dbo.fn_info()"));





$server_on 	= $dados_server[0];

$acr2 		= $dados_server[1];

$acr3 		= $dados_server[2];




?>


<? include("menu_navbar.php"); ?>




<center>

  <table height=360 width='900'>
	<tr>
		<td valign=top width=400 align=center><cennter><BR><BR><BR><BR>


			<table cellspacing=5 style="border-radius: 10px;padding-top:15px;width:300px;height:240px;background-color:rgba(25,28,35,0.7);">
			     <tr>
					<td colspan=2 align=center>

            					<div id="google_translate_element"></div> 
            					<a href="javascript:void(0)" class="pt" onclick="ChangeLang('pt')" title="Traduzir para portugu&ecirc;s"><img src="img/portugues.gif" border="0" alt="Portugues" /></a>
            					<a href="javascript:void(0)" class="en" onclick="ChangeLang('en')" title="Translate to English"><img src="img/english.gif" border="0" alt="English" /></a>
            					<a href="javascript:void(0)" class="es" onclick="ChangeLang('es')" title="Traducir al espa&ntilde;ol"><img src="img/espanol.gif" border="0" alt="Spanish" /></a>
            					<a href="javascript:void(0)" class="it" onclick="ChangeLang('it')" title="Traduci in italiano"><img src="img/italiano.png" border="0" alt="Italian" /></a>
           					<a href="javascript:void(0)" class="de" onclick="ChangeLang('de')" title="&Uuml;bersetzen in Deutsch"><img src="img/alemao.png" border="0" alt="Deutsch" /></a>
            					<a href="javascript:void(0)" class="fr" onclick="ChangeLang('fr')" title="Traduire en fran&ccedil;ais"><img src="img/frances.png" border="0" alt="French" /></a>
					</td>
			     </tr>
			     <tr>
					<td colspan=2 align=center><h4><font color=white>InformaÃ§Ãµes do servidor</font></h4></td>
			     </tr>
			     <tr>
					<td align=center width=150><font color=white>VersÃ£o:</font> <br> <font color=yellow size=5>Season 6</font></td>
					<td align=center width=150><font color=white>ExperiÃªncia:</font> <bR> <font color=yellow size=5>50x (ML 30x)</font></td>
			     </tr>
			     <tr>
					<td align=center width=150><font color=white>Contas:</font> <bR> <font color=yellow size=4><?=$acr2;?></font></td>
					<td align=center width=150><font color=white>Personagens:</font> <br> <font color=yellow size=4><?=$acr3;?></font></td>
			     </tr>
			     <tr>
					<td colspan=2 align=center><a href='info.php' target='main2'><button class="btn btn-info" type="button">+ InformaÃ§Ãµes</button></a></td>
			     </tr>
			</table>

		</td> 
		<td valign=bottom align=right>    
			<p>
   				<a href='cadastro.php' target='main2'><button class="btn btn-primary btn-lg" type="button">Registro</button></a>
  				<a href='dwn.php' target='main2'><button class="btn btn-primary btn-lg" type="button">Download</button></a>
			</p><br>
	<a name="show" id="show" style='padding-top:20px;'></a>
 <br><BR>

		</td>
	</tr>
  </table> 




  <table border='0' width='100%' cellspacing='10' cellpadding='5' style="padding-top:15px;background-color:rgba(25,28,35,0.7);">

	<tr>	<td> <centeR>  
				<a href='tops_diario.php' target='main2'><img src=img/topdiario.png class='menu_top'></a>
				<a href='tops_semanal.php' target='main2'><img src=img/topsemanal.png class='menu_top'></a> 
				<a href='tops_mensal.php' target='main2'><img src=img/topmensal.png class='menu_top'></a>
				<a href='evento_arena.php' target='main2'><img src=img/reipvp.png class='menu_top'></a>
				<a href='ranking_castle.php' target='main2'><img src=img/castlesiege.png class='menu_top'></a>

  <table border='0' width='970' cellspacing='0' cellpadding='0' style="border-radius: 10px; background-color:#ccc;">

           <tr> 


              <td width=100% valign=top><centeR>






  <div id = 'iframe'>


	<table width=950 cellSpacing=0 border=0><tr><td><centeR>


		<iframe align='Center' src='noticias.php' width='100%' height='1000' border='0' frameborder='0' name='main2' id='main2' allowtransparency='true'> Err:


      			Browser dun support I-Frames =) sry.. </iframe></center>



	</td></tr></table>
  </div>


<br>

	  </td>
	</tr> 
	
		</table>

</center>

</div><bR>

    <footer><!-- Defining the footer section of the page -->
    <div class="footer">
        <div class="footer_wrap container">
            <div class="wcont">
                <h3 class="title">O Jogo</h3>
                <ul>
                    <li><a href="cadastro.php" target="main2">Cadastro</a></li>
                    <li><a href="dwn.php" target="main2">Download</a></li>
                    <li><a href="comandos.php" target="main2">Comandos</a></li>
                    <li><a href="imagens.php" target="main2">Imagens</a></li>
                </ul>
            </div>
            <div class="wcont">
                <h3 class="title">InformaÃ§Ãµes</h3>
                <ul>
            	    <li><a href="tutoriais.php" target='main2'>Tutoriais</a></li>
            	    <li><a href="patentes.php" target='main2'>Patentes</a></li>
                    <li><a href="medalhas.php" target='main2'>Medalhas</a></li>
                    <li><a href="reputacao.php" target='main2'>ReputaÃ§Ã£o</a></li>
                    <li><a href="talismas.php" target='main2'>TalismÃ£s</a></li>
                    <li><a href="quests.php" target='main2'>Quests</a></li>
                </ul>
            </div>
            <div class="wcont">
                <h3 class="title">Redes Sociais</h3>
                <ul class="social">
                    <li><a href="https://www.facebook.com/jogandomuoficial/" title="Facebook" target='_blank'><i class="fa fa-facebook"></i> </span> Facebook</a></li>
                    <li><a href="https://www.youtube.com/channel/UC-DwCGE7IUxw7r6LlM8Vc6w" title="YouTube" target='_blank'><i class="fa fa-youtube"></i> YouTube</a></li>
                </ul>
            </div>

            <div class="wcont" style='width:200px'>
                <h3 class="title">Vote no Servidor</h3>
                <ul>
                    <li><center>
			<!-- Begin XtremeTop100 code -->

			<a href="http://www.xtremetop100.com/in.php?site=1132360378" target=_blank title="Mu Online Servers">

			<img src="http://www.xtremeTop100.com/votenew.jpg" border="0" alt="Mu Online Servers">

			</a>

			<!-- End XtremeTop100 code --><br><br>



			<!--Begin Top Servers 200 Vote--><a  href="http://www.topservers200.com/in.php?id=5674"  target="_blank"><img  src="http://www.topservers200.com/button/5674.png" alt="Vote no Top 200" border="0"></a><!--End Top Servers 200 Code--><br><br />


			<a href="http://mmoserver.pro/in/jogandomu" target="_blank"><img src="http://mmoserver.pro/assets/images/mu.png" title="Mu Online Top 100" alt="Mu Online Top 100" border="0"></a><br>

		    </li>
                </ul>
            </div>

        </div>
    </div>

    <div class="copyright">
        <div class="container"><?=$CONFIG_FOOTER;?> | <?=$CONFIG_SITE;?> by louis</div>
    </div>
    </footer>

</body></html>

<script>

$('a').click(function(){
	var catTopPosition = jQuery('#show').offset().top;
	
	// When #scroll is clicked
		// Scroll down to 'catTopPosition'
		jQuery('html, body').animate({scrollTop:catTopPosition}, 'slow');
		// Stop the link from acting like a normal anchor link
		return true;
	});

function ChangeLang(a) {
	var b, elemento = "";
	if (document.createEvent) {
		var c = document.createEvent("HTMLEvents");
		c.initEvent("click", true, true)
	}
	if (a == 'pt') {
		elemento = $(".goog-te-banner-frame:eq(0)").contents().find("button[id*='restore']")
	} else {
		switch (a) {
		case 'de':
			b = "Alem";
			break;
		case 'es':
			b = "Espanhol";
			break;
		case 'fr':
			b = "Fran";
			break;
		case 'en':
			b = "Ing";
			break;
		case 'it':
			b = "Italiano";
			break
		}
		elemento = $(".goog-te-menu-frame:eq(0)").contents().find("span:contains('" + b + "')");
	}
	if (elemento.length > 0) {
		if (document.createEvent) {
			elemento[0].dispatchEvent(c)
		} else {
			elemento[0].click();
		}
	}
}
function googleTranslateElementInit() {
	new google.translate.TranslateElement({
		pageLanguage: 'pt',
		autoDisplay: false,
		includedLanguages: 'de,es,fr,en,it',
		layout: google.translate.TranslateElement.InlineLayout.SIMPLE
	},
	'google_translate_element');
}

</script>

        <script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
