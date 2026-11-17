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


<BR><BR><font size=4><b>SISTEMA DE QUESTS</font></b> <BR><BR>

Nosso servidor conta com um sistema de quests que são realiadas atigindo objetivos pré estabelecidos,<br> concluindo esses objetivos você ganha muitos prêmios, veja tabela abaixo:

<bR><BR>

<?php

include("inclu/config.php");

$quest1  = 1;
$quest2  = 1;
$quest3  = 1;
$quest4  = 1;
$quest5  = 1;
$quest6  = 1;
$quest7  = 1;
$quest8  = 1;
$quest9  = 1;
$quest10 = 1;
$quest11 = 1;
$quest12 = 1;
$quest13 = 1;
$quest14 = 1;
$quest15 = 1;
$quest16 = 1;
$quest17 = 1;
$quest18 = 1;
$quest19 = 1;
$quest20 = 1;
$quest21 = 1;
$quest22 = 1;
$quest23 = 1;
$quest24 = 1;
$quest25 = 1;
$quest26 = 1;
$quest27 = 1;
$quest28 = 1;
$quest29 = 1;
$quest30 = 1;
$quest31 = 1;
$quest32 = 1;
$quest33 = 1;
$quest34 = 1;
$quest35 = 1;


$requisito1="
-10 ou + resetes.
<br>-10 ou + Pontos Experiência.
<br>-Estar no level 99(exatamente).
";
$premio1="
-200 pontos de Experiência.
";

$requisito2="
-70 ou + resetes.
<br>-70 ou + Pontos Experiência.
<br>-1 Double Blade Sword+5+Luck em seu baú.
<br>-Estar no level 349 (exatamente).
";
$premio2="
-300 pontos de experiência.
";

$requisito3="
-100 ou + resetes.
<br>-100 ou + Pontos Experiência.
<br>-1 Jewel of chaos,life,bless,soul e creation no baú.
<br>- Estar no level 251(exatamente).
";
$premio3="
-450 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito4="
-120 ou +  resetes.
<br>-50 ou +  Pontos Experiência.
<br>-Chaos Staff+5+luck+option 28 no baú.
<br>-Chaos Dragon Axe+5+luck+option 28 no baú.
<br>-Chaos Nature+5+luck+skill+option 28 bow no baú.
<br>-Estar no level 309(exatamente).
";
$premio4="
-500 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito5="
-200 ou + resetes.
<br>-100 ou + Pontos Experiência.
<br>-300 ou + mortes (pk)
";
$premio5="
-700 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito6="
-200 ou + resetes.
<br>-Katana(+4+option 16) no baú.
<br>-Legendary Staff(+3+option 16) no baú.
<br>-Legendary Shield Normal(+5+Luck) no baú.
<br>-Bone Helm No baú.
";
$premio6="
-500 pontos de experiência.
<br>-500 pontos de eventos
";

$requisito7="
-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Blood Fang +1,+2,+3,+4,+5,+6 e +7 no baú.
";
$premio7="
-500 pontos de experiência.
<br>-600 pontos de eventos
";

$requisito8="
-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Scroll of Archangel +1,+2,+3,+4,+5,+6 e +7 no baú.
";
$premio8="
-500 pontos de experiência.
<br>-600 pontos de eventos
";

$requisito9="
-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Devil Key +1,+2,+3,+4,+5 e +6 no baú.
";
$premio9="
-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito10="
-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-Devil Eye +1,+2,+3,+4,+5 e +6 no baú.
";
$premio10="
-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito11="
-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-1 Bill of Balrog +0 no baú.
";
$premio11="
-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito12="
-500 ou + resetes.
<br>-400 ou + pontos de Experiência.
<br>-1 Box of Kundun +1,+2,+3,+4,+5 no baú.
";
$premio12="
-500 pontos de experiência.
<br>-400 pontos de eventos
";

$requisito13="
-350 ou + resetes.
<br>-200 ou + pontos de Experiência.
<br>-Ficar conectado 75 horas na semana.
";
$premio13="
-200 pontos de experiência.
<br>-200 pontos de eventos
";

$requisito14="
-500 ou + Resetes.
<br>-1000 ou + pontos de Experiência.
<br>-Completar a quest 4.
<br>-1000 golds.
";
$premio14="
-1000 pontos de experiência.
<br>-200 pontos de eventos.
";

$requisito15="
-500 ou + Resetes.
<br>-1000 ou + pontos de Experiência.
<br>-Completar a quest 5.
<br>-Ancient Gloves +0 sem lucky No baú.
<bR>-Gran Soul Boots +1 sem lucky no baú.
<bR>-Ficar nas coordenadas 100x 236y do mapa Crywolf. 
";
$premio15="
-1000 pontos de experiência.
<br>-400 pontos de eventos.
";

$requisito16="
-500 ou + Master Resetes.
<br>-1000 ou + Resetes.
<br>-2000 ou + pontos de Experiência. 
<br>-Completar as quests 12 e 13. 
<br>-Ter a medalha de MReset semanal. 
";
$premio16="
-1000 pontos de experiência. 
<br>-300 pontos de eventos. 
<br>-2000 MGolds.
";

$requisito17="
-600 ou + Master Resetes.
<br>-1 Shining Scepter(+5+luck+28 Option+skill) no bau.
<br>-Completar as quests de 1 à 5.
<br>-Ter a medalha de Tempo online.
";
$premio17="
-1000 pontos de experiência.
<br>-300 pontos de eventos.
<br>-2000 MGolds.
";

$requisito18="
-500 ou + Master Resetes.
<br>-15000 ou + Pontos Experiência.
<br>-Brave Armor(+5+luck+28 option) Completo no baú.
<br>-Completar as quests de 6 à 10.
";
$premio18="
-1000 pontos de experiência.
<br>-300 pontos de eventos.
<br>-2000 MGolds.
";

$requisito19="
-500 ou + Master Resetes.
<br>-20000 Pontos Experiência.
<br>-600 mortes (pk).
<br>-50 Pontos de reputação.
<br>-Completar as quests de 11 à 15.
";
$premio19="
-7.000 pontos de experiência.
<br>-2.000 pontos de eventos.
<br>-20.000 MGolds.
";

$requisito20="
-1000 ou + Master Resets
<br>-25000 ou + Pontos Experiência.
<br>-2000 ou + Eventos.
<br>-Ficar na coordenada x225 y237 do castelo de davias.
<br>-Completar todas as quests.
";
$premio20="
-Medalha especial.
<br>-100 Créditos.
<br>-50.000 Master Golds.
";

$requisito21="
-1000 ou + Resets
<br>-Estar no level 200 (exatamente).
<bR>-Vencer 5x o Top Reset Diário.
<br>-Ficar na coordenada x70 y185 do tarkan.
";
$premio21="
-5 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito22="
-500 ou + Master Resets
<br>-Estar no level 200 (exatamente).
<bR>-Vencer 5x o Top MReset Diário.
<br>-Ficar na coordenada x5 y244 do tarkan.
";
$premio22="
-5 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito23="
-1000 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Resets Semanal.
<br>-Ficar na coordenada x125 y125 de lorencia.
";
$premio23="
-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito24="
-500 ou + MResets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top MResets Semanal.
<br>-Ficar na coordenada x125 y125 de Lorencia.
";
$premio24="
-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito25="
-500 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Tempo Semanal.
<br>-Ficar na coordenada x222 y62 de Davias.
";
$premio25="
-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito26="
-500 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Mortes Semanal.
<br>-Ficar na coordenada x222 y62 de Davias.
";
$premio26="
-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito27="
-500 ou + Resets
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Eventos Semanal.
<br>-Ficar na coordenada x141 y71 de Atlans.
";
$premio27="
<br>-7 créditos.
<br>-1000 pontos de experiência.
<br>-1000 Golds.
";

$requisito28="
-1000 ou + MResets
<bR>-30000 ou + Pontos Experiência.
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 10x o Top Resets Diário.
<bR>-Vencer 10x o Top MResets Diário.
<br>-Ficar na coordenada x65 y109 de Dungeon.
";
$premio28="
-10 créditos.
<br>-20.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito29="
-1000 ou + MResets
<bR>-40000 ou + Pontos Experiência.
<br>-Estar no level 125 (exatamente).
<bR>-Vencer 3x o Top Resets Semanal.
<bR>-Vencer 3x o Top MResets Semanal.
<bR>-Vencer 3x o Top Tempo Semanal.
<bR>-Vencer 3x o Top Mortes Semanal.
<bR>-Vencer 3x o Top Eventos Semanal.
<br>-Ficar na coordenada x38 y233 de Icarus.
";
$premio29="
-50 créditos.
<br>-50.000 pontos de experiência.
<br>-30.000 Golds.
";

$requisito30="
-3000 ou + MResets
<br>-Estar no level 125 (exatamente).
<br>-Ficar na coordenada x34 y232 de Lorencia.
";
$premio30="
-10 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";
$requisito31="
-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top Tempo Mensal.
";
$premio31="
-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito32="
-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top Resets Mensal.
";
$premio32="
-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito33="
-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top MResets Mensal.
";
$premio33="
-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito34="
-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 2x o Top Eventos Mensal.
<bR>-Vencer 1x o Top PK Mensal.
";
$premio34="
-20 créditos.
<br>-10.000 pontos de experiência.
<br>-10.000 Golds.
";

$requisito35="
-1000 ou + MResets
<bR>-100000 ou + pontos de Experiência. 
<br>-Estar no level 300 (exatamente).
<bR>-Vencer 1x o Top Tempo Mensal.
<bR>-Vencer 1x o Top Resets Mensal.
<bR>-Vencer 1x o Top Mresets Mensal.
<bR>-Vencer 1x o Top Eventos Mensal.
<bR>-Vencer 1x o Top PK Mensal.
";
$premio35="
-100 créditos.
<br>-15.000 pontos de experiência.
<br>-10.000 Golds.
";

for($i=1;$i < 36;++$i)
{
$quests    = "quest$i";
$premio    = "premio$i";
$premio    = $$premio;
$requisito = "requisito$i";
$requisito = $$requisito;

Echo "
  <table width=500 cellspacing=0>
	<thead>
	<tr>
	   <th colspan=2><font size=4> Quest nível $i</b></font><br><img src=img/medalhas/quest".$i."a.png></td>
	</tr>
	<tr>
	   <th valign=top> Requisitos:	</b></td>
           <th valign=top> Prêmios:		</b></td>
	</tr>
	</thead>

	<tr style=\"background:transparent;\">
		<td style='text-align:left;'>$requisito </td>
		<td style='text-align:left;'>$premio    </td>
	</tr>
  </table> <b><br>

";
}
?><center>
JogandoMu by louis - www.mu-dravaryn.com.br
</div>

