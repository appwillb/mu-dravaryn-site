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



<center><bR><BR><font size=3><b> MUDAR NOME <bR><BR>



<?

require_once("inclu/config.php");

require("inclu/cookie.php");

require("inclu/verif_vip.php"); 

require("inclu/verif_resets20.php");



mssql_query("DELETE TOP_diario  where (SELECT COUNT(*) FROM character where name = TOP_diario.Nome )=0");

mssql_query("DELETE TOP_semanal where (SELECT COUNT(*) FROM character where name = TOP_semanal.Nome )=0 and tipo <> 6 and tipo <> 7");

mssql_query("DELETE TOP_mensal  where (SELECT COUNT(*) FROM character where name = TOP_mensal.Nome )=0");



$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb___id='$login'"); 

$pw_check = mssql_num_rows($sql_pw_check);





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



if (empty($login) || empty($psw)) {

    echo "<center><font color=#006699>Erro: Campos em Branco<br>";

}



elseif ($username_check <= 0)

	{ 

        echo "<center><font color=#006699>Seu Login não existe em nosso banco de dados.<br> Volte e tente novamente.<br>"; 

	}



elseif ($pw_check <= 0){ 

echo "<center><font color='#325784'>Senha invalida<br>"; }



else 

	{	

	echo "

<body>



<form name='form1' method='post' action='mudar_nome_3.php'>

          <table width='80%' border='0' cellspacing='0' cellpadding='0' style='border:0;'>

		<tr style='background:transparent;'> 

<td><center>

<select name='id' id='id'>

<option value=''>-Escolhar o Char-</option>

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

                <input name='character' type='text' id='character' maxlength='10' value='Novo Nome' onClick=\"this.select();\">

                </td>

            </tr>

            <tr style='background:transparent;'> 

              <td align='center'><bR><input type='submit' name='Submit' value='Mudar Nome' class='imput'></td>

                          </tr>

          </table>

        </form>



</td>

</table><font size=2><b>Taxa:</b> 100 Golds.<bR><BR>

<center>Não coloque <b>ESPAÇO</b> ou <b>acentos</b>.<br><br><b>SÓMENTE PARA VIPS!!!

</body>







";

	}





?>





</div>



</body>

</html>