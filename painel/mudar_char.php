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



<center><bR><BR><font size=3><b> TRANSFERIR PERSONAGEM <bR><BR></font></b>



<?

require_once("inclu/config.php");

require("inclu/cookie.php");

?>



<?PHP



if($_GET[post]){





$id         = stripslashes($_POST['id']);

$destino    = stripslashes($_POST['destino']);



echo "<font color = red>";





if (empty($id)) 

	{

    echo "<br><center><b>Campos em Branco. Volte e tente novamente.[1]</b><br>";

	}



elseif (preg_match("[^0-9]", $id))

{ 

echo "<br><center><b>Selecione um personagem!</b><br>";

}



else 

	{

		if ($id==1) {$GameID = GameID1;}

		elseif ($id==2) {$GameID = GameID2;}	

		elseif ($id==3) {$GameID = GameID3;}

		elseif ($id==4) {$GameID = GameID4;}

		elseif ($id==5) {$GameID = GameID5;}

		else {Die("<br><center><font color='orange'>Coloque um ID correto.");}

	





$sql_name_get = mssql_query("SELECT $GameID FROM AccountCharacter WHERE Id='$login'"); 

$name_get = mssql_fetch_row( $sql_name_get );



$row_creditos = mssql_fetch_row(mssql_query("Select wcoinc From cashshopdata where accountid='$login'"));





$username_check 	= mssql_num_rows(mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login' "));

$username_check2 	= mssql_num_rows(mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$destino'"));

$null_check 		= mssql_num_rows(mssql_query("Select $GameID FROM accountcharacter WHERE id='$login' and $GameID=null"));

$guild_check		= mssql_num_rows(mssql_query("Select Name FROM guildmember WHERE Name = '$name_get[0]'"));

$guild_check2		= mssql_num_rows(mssql_query("Select G_Name FROM guild WHERE G_Name = '$name_get[0]'"));

$dest_check  		= mssql_num_rows(mssql_query("Select accountid FROM character WHERE accountid = '$destino'"));

$online1 		= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login' and connectstat=1"));

$online2 		= mssql_num_rows(mssql_query("Select ConnectStat FROM MEMB_STAT WHERE memb___id='$destino' and connectstat=1"));



$null_check1 = mssql_num_rows(mssql_query("Select $GameID FROM accountcharacter WHERE id ='$destino' and (GameID1 = '' or GameID1 is NULL)"));

$null_check2 = mssql_num_rows(mssql_query("Select $GameID FROM accountcharacter WHERE id ='$destino' and (GameID2 = '' or GameID2 is NULL)"));

$null_check3 = mssql_num_rows(mssql_query("Select $GameID FROM accountcharacter WHERE id ='$destino' and (GameID3 = '' or GameID3 is NULL)"));

$null_check4 = mssql_num_rows(mssql_query("Select $GameID FROM accountcharacter WHERE id ='$destino' and (GameID4 = '' or GameID4 is NULL)"));

$null_check5 = mssql_num_rows(mssql_query("Select $GameID FROM accountcharacter WHERE id ='$destino' and (GameID5 = '' or GameID5 is NULL)"));





if ($null_check1 == 1)

{

$id_dest = "GameID1";

}

elseif ($null_check2 == 1)

{

$id_dest = "GameID2";

}

elseif ($null_check3 == 1)

{

$id_dest = "GameID3";

}

elseif ($null_check4 == 1)

{

$id_dest = "GameID4";

}

elseif ($null_check5 == 1)

{

$id_dest = "GameID5";

}

else {

$id_dest = "NOID";

}





if (empty($login) || empty($psw) || empty($id) || empty($destino)) 

	{

    echo "<center><b><br>Campos em branco. Volte e tente novamente.[2]<br>";

	}



elseif ($username_check <= 0)

	{ 

        echo "<center><b><br>Seu login nao exite em nosso banco de dados ou a senha está incorreta.<br>"; 

	}



elseif ($username_check2 <= 0)

	{ 

        echo "<center><b><br>A conta de destino não existe.<br>"; 

	}



elseif ($online1 > 0){ 

echo "<center><b><br>Você está conectado no jogo. Saia e tente novamente!!!<br>"; }



elseif ($online2 > 0){ 

echo "<center><b><br>A conta $destino está conectada no jogo. Ela deve ficar Offline!!!<br>"; }



elseif ($null_check == 1){ 

echo "<center><b><br>Não tem nenhum char na posição escolhida, escolha outro e tente novamente.<br>"; }



elseif ($login == $destino){ 

echo "<center><b><br>Você não pode transferir um personagem para sua própria conta.<br>"; }



elseif ($dest_check == 0){ 

echo "<center><b><br>A conta de destino possui o máximo de personagens permitidos.[1]<br>"; }



elseif ($dest_check > 4){ 

echo "<center><b><br>A conta de destino possui o máximo de personagens permitidos.[2]<br>"; }



elseif ($id_dest == 'NOID'){ 

echo "<center><b><br>A conta de destino possui o máximo de personagens permitidos.[3]<br>"; }



elseif ($row_creditos[0] < 50){ 

echo "<center><b><br>Você não tem créditos suficientes.<br>"; }



elseif ($guild_check > 0){ 

echo "<center><b><br>Esse char é membro de alguma GUILD, saia da guild para poder transferir!!!<br>"; }



else 

	{

echo "</font>";

	





$query = "Update dbo.Character

	SET accountid='$destino' WHERE AccountID = '$login' AND Name = '$name_get[0]'

	Update dbo.accountcharacter

	SET $GameID=NULL,gameidc=null WHERE ID = '$login'

	Update dbo.accountcharacter

	SET $id_dest='$name_get[0]' WHERE ID = '$destino'

	Update dbo.mk_medalhas

	SET login='$destino' WHERE login = '$login' and name='$name_get[0]'

	";



$msresults= mssql_query($query);



$msquery = "INSERT INTO mk_Murkut_news ( nome,valor,tipo ) values ('$name_get[0]','$login','13' )";

$msresults= mssql_query($msquery);



$ip2 = $_SERVER["REMOTE_ADDR"]; 



mssql_query("update cashshopdata set wcoinc=wcoinc-50 where accountid='$login'");



mssql_query("INSERT INTO LOG_CREDITOS ( login, valor, ip, tipo ) values ('$login','-50','$ip2','16')");

mssql_query("INSERT INTO LOG_TRANSFERENCIA ( login,char,gameid,login_destino,gameid_dest,ip ) values ('$login','$name_get[0]','$GameID','$destino','$id_dest','$ip2')");



	echo "<font color=green><br><center>O Personagem <b>$name_get[0]</B> foi transferido para conta <B>$destino</b>.<br> Foram removidos 50 créditos.";





	}







}

	}





echo "</font>";





$sql_username_check = mssql_query("SELECT GameID1, GameID2, GameID3, GameID4, GameID5 FROM AccountCharacter WHERE Id='$login'"); 

$username_check = mssql_num_rows($sql_username_check); 

$username_get = mssql_fetch_row( $sql_username_check );





$name_check1 = mssql_query("SELECT name FROM character WHERE name='$username_get[0]' and accountid='$login'"); 

$name_check11 = mssql_num_rows($name_check1);

if($name_check11 <= 0){

$username_get[0] = "<font color=red>Nenhum Persoagem</font>";}

else {

$username_get[0] = "<option value=1>1. $username_get[0]</option>";}



$name_check2 = mssql_query("SELECT name FROM character WHERE name='$username_get[1]' and accountid='$login'"); 

$name_check22 = mssql_num_rows($name_check2);

if($name_check22 <= 0){

$username_get[1] = "<font color=red>Nenhum Persoagem</font>";}

else {

$username_get[1] = "<option value=2>2. $username_get[1]</option>";}



$name_check3 = mssql_query("SELECT name FROM character WHERE name='$username_get[2]' and accountid='$login'"); 

$name_check33 = mssql_num_rows($name_check3);

if($name_check33 <= 0){

$username_get[2] = "<font color=red>Nenhum Persoagem</font>";}

else {

$username_get[2] = "<option value=3>3. $username_get[2]</option>";}



$name_check4 = mssql_query("SELECT name FROM character WHERE name='$username_get[3]' and accountid='$login'"); 

$name_check44 = mssql_num_rows($name_check4);

if($name_check44 <= 0){

$username_get[3] = "<font color=red>Nenhum Persoagem</font>";}

else {

$username_get[3] = "<option value=4>4. $username_get[3]</option>";}



$name_check5 = mssql_query("SELECT name FROM character WHERE name='$username_get[4]' and accountid='$login'"); 

$name_check55 = mssql_num_rows($name_check5);

if($name_check55 <= 0){

$username_get[4] = "<font color=red>Nenhum Persoagem</font>";}

else{

$username_get[4] = "<option value=5>5. $username_get[4]</option>";}







echo "<body>

<br><center>Função para transferir um personagem de uma conta para outra.<br><Br><font color=$font_color1>O valor da transferência é de 50 créditos.</font><br><Br>

<form name='form1' method='post' action='?post=ok'>

          <table width='80%' border='0' cellspacing='0' cellpadding='0' style='border:0;'>

		<tr style='background:transparent;'> 

<td><center>

<select name='id' id='id'>

<option value=''>-Escolhar Personagem-</option>

$username_get[0] 

$username_get[1] 

$username_get[2] 

$username_get[3] 

$username_get[4] 

</select>



		</td>

            </tr>

            <tr style='background:transparent;'> 

              <td><center><bR>

                <input name='destino' type='text' id='destino' maxlength='10' value='Conta destino' onClick=\"this.select();\">

                </td>

            </tr>

            <tr style='background:transparent;'> 

              <td align='center'><bR><input type='image' src='img/BT_confirmar.png' name='Submit' value='Transferir' style='border:0;background:transparent;'> </td>

                          </tr>

          </table>

        </form>

</td>

</table>

Sistema by louis.







";

	





?>



<BR>



</div>



</body>

</html>