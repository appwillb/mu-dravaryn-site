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



<center><bR><BR><font size=3><b> MUDAR ORDEM DOS PERSONAGENS </font></b><bR><BR>



<?

require_once("inclu/config.php");

require("inclu/cookie.php");

require("inclu/verif_resets20.php");

require("inclu/verif_vip.php");



if($_GET[post]){





$id1         = stripslashes($_POST['id']);

$id2         = stripslashes($_POST['id2']);



echo "<font color = red>";





if (empty($id1) || empty($id2)) 

	{

    echo "<b>Campos em Branco. Volte e tente novamente.[1]</b><br><br>";

	}



elseif (preg_match("[^0-9]", $id1) || preg_match("[^0-9]", $id2))

{ 

echo "<font color=$font_color1><b>Selecione as posições!</b><br><br>";

}



else 

	{

		if ($id1==1) {$Game1 = GameID1;}

		elseif ($id1==2) {$Game1 = GameID2;}	

		elseif ($id1==3) {$Game1 = GameID3;}

		elseif ($id1==4) {$Game1 = GameID4;}

		elseif ($id1==5) {$Game1 = GameID5;}

		else {echo "<br><center><font color=$font_color2>Coloque um ID correto.<br><br>";}



		if ($id2==1) {$Game2 = GameID1;}

		elseif ($id2==2) {$Game2 = GameID2;}	

		elseif ($id2==3) {$Game2 = GameID3;}

		elseif ($id2==4) {$Game2 = GameID4;}

		elseif ($id2==5) {$Game2 = GameID5;}

		else {echo "<br><center><font color=$font_color2>Coloque um ID correto.<br><br>";}

	



$username_check 	= mssql_num_rows(mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login' "));

$online1 		= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and connectstat=1"));



if (empty($login) || empty($psw) || empty($id1) || empty($id2)) 

	{

    echo "<font color=$font_color1><b>Campos em branco. Volte e tente novamente.[2]<br><br>";

	}



elseif ($username_check <= 0)

	{ 

        echo "<font color=$font_color1><b>Seu login nao exite em nosso banco de dados ou a senha está incorreta.<br><br>"; 

	}



elseif ($online1 > 0){ 

echo "<font color=$font_color1><center><b><br>Você está conectado no jogo. Saia e tente novamente!!!<br><br>"; }



elseif ($id1 == $id2){ 

echo "<font color=$font_color1><b>Você escolheu duas posições iguais!!!<br><br>"; }



else 

	{

echo "</font>";

	



$query = "Update dbo.accountcharacter

	SET $Game1=(select $Game2 from accountcharacter where id='$login'),$Game2 = (select $Game1 from accountcharacter where id='$login') where id='$login'";



$msresults= mssql_query($query);



$ip2 = $_SERVER["REMOTE_ADDR"]; 



mssql_query("INSERT INTO LOG_ORDEM ( login,posicao1,posicao2,ip ) values ('$login','$Game1','$Game2','$ip2')");



	echo "<font color=$font_color2><center><b>Mudança Realizada com Secesso!!<br><br>";





	}







}

	}





echo "</font>";





$sql_username_check = mssql_query("SELECT GameID1, GameID2, GameID3, GameID4, GameID5 FROM AccountCharacter WHERE Id='$login'"); 

$username_check = mssql_num_rows($sql_username_check); 

$username_get = mssql_fetch_row( $sql_username_check );





$name_check1 = mssql_query("SELECT name,exp_war,patente FROM character WHERE name='$username_get[0]' and accountid='$login'"); 

$name1 = mssql_fetch_row( $name_check1 );





$name_check2 = mssql_query("SELECT name,exp_war,patente FROM character WHERE name='$username_get[1]' and accountid='$login'"); 

$name2 = mssql_fetch_row( $name_check2 );



$name_check3 = mssql_query("SELECT name,exp_war,patente FROM character WHERE name='$username_get[2]' and accountid='$login'"); 

$name3 = mssql_fetch_row( $name_check3 );



$name_check4 = mssql_query("SELECT name,exp_war,patente FROM character WHERE name='$username_get[3]' and accountid='$login'"); 

$name4 = mssql_fetch_row( $name_check4 );



$name_check5 = mssql_query("SELECT name,exp_war,patente FROM character WHERE name='$username_get[4]' and accountid='$login'"); 

$name5 = mssql_fetch_row( $name_check5 );



if (!$name1[0]) { $name1[0] = "Nenhum"; }

if (!$name2[0]) { $name2[0] = "Nenhum"; }

if (!$name3[0]) { $name3[0] = "Nenhum"; }

if (!$name4[0]) { $name4[0] = "Nenhum"; }

if (!$name5[0]) { $name5[0] = "Nenhum"; }



$patente_num = $row[1];

$patenten    = $row[2];

include '../inclu/patentes.php';





echo "



</b></font>Função para mudar a ordem dos personagens da tela do Select Char.<br><Br>";



$patente_num = $name1[1];

$patenten    = $name1[2];

include '../inclu/patentes.php';



echo "<table style='border:1;' cellspacing=0>
	<thead>
	<tr>	
		<th colspan=5>Ordem atual</th>
	</tr>

	</thead>
<tr style='background:transparent;'><td width=100>



<center><table width='78' border='0' align='center' cellspacing='0' cellpadding='0'>

	

	<tr><td><center><img src='../img/$img.jpg' width=70 style='border:1px solid #000;'></td></tr>

	<tr><td><center> <b><font color=black size=2>$name1[0]</b></font> </td></tr>

</table>

</td>";



$patente_num = $name2[1];

$patenten    = $name2[2];

include '../inclu/patentes.php';



echo "<td width=100>



<center><table width='78' border='0' align='center' cellspacing='0' cellpadding='0'>

	

	<tr><td><center><img src='../img/$img.jpg' width=70 style='border:1px solid #000;'></td></tr>

	<tr><td><center> <b><font color=black size=2>$name2[0]</b></font> </td></tr>

</table>

</td>";



$patente_num = $name3[1];

$patenten    = $name3[2];

include '../inclu/patentes.php';



echo "<td width=100>



<center><table width='78' border='0' align='center' cellspacing='0' cellpadding='0'>

	

	<tr><td><center><img src='../img/$img.jpg' width=70 style='border:1px solid #000;'></td></tr>

	<tr><td><center> <b><font color=black size=2>$name3[0]</b></font> </td></tr>

</table>

</td>";





$patente_num = $name4[1];

$patenten    = $name4[2];

include '../inclu/patentes.php';



echo "<td width=100>



<center><table width='78' border='0' align='center' cellspacing='0' cellpadding='0'>

	

	<tr><td><center><img src='../img/$img.jpg' width=70 style='border:1px solid #000;'></td></tr>

	<tr><td><center> <b><font color=black size=2>$name4[0]</b></font> </td></tr>

</table>

</td>";



$patente_num = $name5[1];

$patenten    = $name5[2];

include '../inclu/patentes.php';



echo "<td width=100>



<center><table width='78' border='0' align='center' cellspacing='0' cellpadding='0'>

	

	<tr><td><center><img src='../img/$img.jpg' width=70 style='border:1px solid #000;'></td></tr>

	<tr><td><center> <b><font color=black size=2>$name5[0]</b></font> </td></tr>

</table>

</td>";













echo "

</tr> </table><br><Br>



<form name='form1' method='post' action='?post=ok'>

          <table width='500' border='0' cellspacing='0' cellpadding='0' style='border:0;'>

		<tr style='background:transparent;'> 

<td><center><b>Mudar:</b><br>

<select name='id' id='id'>

<option value=''>Selecione a posição:</option>

<option value=1>Posição 1</option>

<option value=2>Posição 2</option>

<option value=3>Posição 3</option>

<option value=4>Posição 4</option>

<option value=5>Posição 5</option>

</select><br><br>



<b>Para:</b><br>

<select name='id2' id='id2'>

<option value=''>Selecione a posição:</option>

<option value=1>Posição 1</option>

<option value=2>Posição 2</option>

<option value=3>Posição 3</option>

<option value=4>Posição 4</option>

<option value=5>Posição 5</option>

</select>



		</td>

            </tr>

            <tr style='background:transparent;'> 

              <td align='center'><bR><input type='submit' name='Submit' value='Mudar Posição' class='imput'></td>

                          </tr>

          </table>

        </form>

</div>

</td>

</table><font color=$font_color1>

Sistema by louis.

</body>







";

	





?>





</div>



</body>

</html>