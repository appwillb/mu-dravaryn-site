<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> MOVER PERSONAGEM <bR><BR>
<div align="center">
  <table width="400" border="0" cellspacing="2" cellpadding="3" bordercolor=#333333>
    <tr>
      <td valign="top"><div align="center">

<?php

include("inclu/config.php");
include("inclu/cookie.php");

$envia = $_GET[envia];
$name  = $_GET[name];

echo "
<table width='200' border='0' cellpadding='0' cellspacing='10' align=center>
  <tr>
    <td valign=top>
          <form name='frm' method='post' action='?envia=lorencia&name=$name'>
     <center><input name='submit' type='submit' class='imput' value='Lorencia' style='width:130'></form><br><br>
	 <form name='frm' method='post' action='?envia=dungeon2&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Dungeon 2' style='width:130'></form><br><br>
	 <form name='frm' method='post' action='?envia=dungeon3&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Dungeon 3' style='width:130'></form><br><br>
	 <form name='frm' method='post' action='?envia=davias&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Davias' style='width:130'></form><br><br>
   </td>

<td valign=top>
	 <form name='frm' method='post' action='?envia=stadium&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Arena' style='width:130'></form><br><br>
	 <form name='frm' method='post' action='?envia=atlans&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Atlans' style='width:130'></form> <br><br>
	 <form name='frm' method='post' action='?envia=lt7&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Lost Tower 7' style='width:130'></form><br><br>


</td>
      <td valign=top>
	 <form name='frm' method='post' action='?envia=tarkan&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Tarkan' style='width:130'></form><br><br>
	 <form name='frm' method='post' action='?envia=icarus&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Icarus' style='width:130'></form><br><br>
	 <form name='frm' method='post' action='?envia=noria&name=$name'>
     <center><input name='submit' type='submit' class='imput' size=20 value='Noria' style='width:130'></form><br><br>
         </td>
  </tr>
</table>";

if($envia==lorencia){
$msquery = "
UPDATE dbo.Character SET MapNumber = '0'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '125'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '125'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Lorencia!!<br><br>
";
}

elseif($envia==dungeon){
$msquery = "
UPDATE dbo.Character SET MapNumber = '1'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '119'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '46'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Dungeon!!<br><br>
";
}

elseif($envia==dungeon2){
$msquery = "
UPDATE dbo.Character SET MapNumber = '1'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '233'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '126'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Dungeon 2!!<br><br>";
}

elseif($envia==dungeon3){
$msquery = "
UPDATE dbo.Character SET MapNumber = '1'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '119'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '46'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Dungeon 3!!<br><br>";
}

elseif($envia==lt7){
$msquery = "
UPDATE dbo.Character SET MapNumber = '4'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '9'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '86'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Lost Tower 7!!<br><br>";
}

elseif($envia==davias){
$msquery = "
UPDATE dbo.Character SET MapNumber = '2'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '222'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '62'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Davias!!<br><br>";
}

elseif($envia==noria){
$msquery = "
UPDATE dbo.Character SET MapNumber = '3'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '176'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '110'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Noria!!<br><br>";
}

elseif($envia==stadium){
$msquery = "
UPDATE dbo.Character SET MapNumber = '6'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '63'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '100'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Arena!!<br><br>";
}

elseif($envia==atlans){
$msquery = "
UPDATE dbo.Character SET MapNumber = '7'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '24'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '19'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Atlans!!<br><br>";
}
elseif($envia==exile){
$msquery = "
UPDATE dbo.Character SET MapNumber = '5'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '24'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '19'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Place of EXILE!!<br><br>";
}

elseif($envia==tarkan){
$msquery = "
UPDATE dbo.Character SET MapNumber = '8'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '187'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '58'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Tarkan!!<br><br>";
}

elseif($envia==icarus){
$msquery = "
UPDATE dbo.Character SET MapNumber = '10'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '15'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '13'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Icarus!!<br><br>";
}


elseif($envia==kalima){
$msquery = "
UPDATE dbo.Character SET MapNumber = '24'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '43'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '89'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Kalima!!<br><br>";
}

elseif($envia==daredevil){
$msquery = "
UPDATE dbo.Character SET MapNumber = '19'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '50'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '69'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Dare Devil!!<br><br>";
}

elseif($envia==crystal){
$msquery = "
UPDATE dbo.Character SET MapNumber = '17'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '35'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '40'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Crystal Quest MAP!!<br><br>";
}

elseif($envia==aida){
$msquery = "
UPDATE dbo.Character SET MapNumber = '23'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '78'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '11'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Aida Map!!<br><br>";
}

elseif($envia==kundun){
$msquery = "
UPDATE dbo.Character SET MapNumber = '22'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosX = '105'
WHERE Name = '$name' AND AccountID = '$login'
UPDATE dbo.Character SET MapPosY = '38'
WHERE Name = '$name' AND AccountID = '$login'";

$msresults= mssql_query($msquery);
echo " <center><br>O char $name foi movido para <b>Kundun Castle!!<br><br>";
}

Echo "</font><center><b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dica:</b></font> Agora não precisa sair do jogo para usar o Move, apenas de 'Switch Character' use o move e entre no char novamente.";
?>
</div>