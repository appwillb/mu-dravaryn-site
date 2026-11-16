<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>
</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> RESETAR MASTER SKILL TREE </b><bR><BR></font>

<?
require_once("inclu/config.php");
require("inclu/cookie.php");

if ($_GET[resetar]) {

$personagem = $_GET[show];

$conta_check = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$personagem' and accountid='$login'"));
$reset_check = mssql_num_rows(mssql_query("Select name FROM MasterSkillTree WHERE Name = '$personagem'"));
$online_check= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and ConnectStat=0"));

if     ($conta_check  <= 0) {$resultado1= "<font size=2 color=$font_color1><b><center><br>Esse Personagem não pertece a sua conta.<br><br>";}
elseif ($reset_check  <= 0) {$resultado1= "<font size=2 color=$font_color1><b><center><br>Você já resetou.<br><br>"; }
elseif ($online_check <= 0) {$resultado1= "<font size=2 color=$font_color1><b><center><br>Você está Online, saia do jogo e tente novamente.<br><br>"; } 
else {


mssql_query("DELETE FROM MasterSkillTree where name='$personagem'");

mssql_query("UPDATE character set MagicList = (select MagicList from DefaultClassType where class=16) where name='$personagem'");

$resultado2= "<font size=2 color=$font_color2> Master Skill resetada com sucesso!! </font><br><br><Br>";

}
}



?>



<bR><bR><b>Clique no botão para resetar a Master Skill do personagem <? echo $_GET[show];?></b><bR><bR>

<font color=red>*Ao resetar, o Master level e os pontos são zerados!

<br><Br>

<a href=?resetar=ok&show=<? echo $_GET[show];?>><img src=img/BT_resetar.png></a>

<?

if ($resultado1)
{
	$MESSAGE_TIPO = 5;
	include("inclu/erro.php");

	echo "$CONFIG_paginas_inicio $resultado1 $CONFIG_paginas_fim";
}
if ($resultado2)
{
	$MESSAGE_TIPO = 6;
	include("inclu/erro.php");

	echo "$CONFIG_paginas_inicio $resultado2 $CONFIG_paginas_fim";
}

?>

</div>