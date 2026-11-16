<head>
  <link type="text/css" rel="stylesheet" href="../css/paginas.css">

        <script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>

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

<center><bR><BR><font size=3><b> DESBANIR PERSONAGEM </b><bR></font>


<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 1;
require("../inclu/verif_nivel_gm.php");

echo"
<form name='form1' method='post' action='?envia=banir'>
<br>Char:<input name='char' type='text' id='char' maxlength='20'>
<br><br><input type='submit' name='Submit' value='Desbanir' style='font: 17px LithosProBold, Arial, sans-serif;
	color: black;'> </form>
";

$envia = $_GET[envia];

if($envia==banir){

$name = stripslashes($_POST['char']);

$sql_username_check = mssql_query("SELECT name FROM Character WHERE name='$name'"); 
$username_check = mssql_num_rows($sql_username_check);

$sql_gm_username_check = mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'"); 
$gm_username_check = mssql_num_rows($sql_gm_username_check);

$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb__pwd='$psw' and memb___id='$login'"); 
$pw_check = mssql_num_rows($sql_pw_check); 

$ctl_query = "select nivel_gm,name from Character WHERE AccountID='$login' order by nivel_gm desc";
$ctl_query_result = mssql_query( $ctl_query );
$gm_check = mssql_fetch_row( $ctl_query_result );

$ctl_query1 = "select CtlCode,bloc_by from Character WHERE Name='$name'";
$nqj = mssql_query( $ctl_query1 );
$gm_check1 = mssql_fetch_row( $nqj );


if (empty($name)) {
echo "<center><b>Campos em Branco.<br>";
}

elseif ($username_check <= 0){ 
echo "<center><b>Esse Character nao existe!<br>"; }


elseif ($gm_check1[0] <> 1){ 
echo "<center><font color=red><b>Esse char não esta banido!<br>"; }

elseif ($pw_check <= 0){ 
echo "<center><b>Senha invalida<br>"; }

//elseif ($gm_check[0] < 4){ 
//echo "<center>Voce não esta autorizado!<br>Opção para Administradores!!<br>"; }

elseif ($gm_check[1] <> $gm_check1[1] || $nivel_dados[0] < 4){ 
echo "<center>Voce não esta autorizado!<br>Você só pode desbanir um personagem que você mesmo baniu!!<br>"; }


else { 


$msquery = "UPDATE dbo.Character
SET CtlCode=0 WHERE Name = '$name'";

$msresults= mssql_query($msquery);

echo "<center><b><font color=$font_color1>$name</font> esta desbanido <br>";

$data_now = date('m-j-y G:i:s');
$ip = $_SERVER["REMOTE_ADDR"]; 

$msquery = "INSERT INTO LOG_DESBAN ( login,desbanido,ip,data ) values ('$login','$name','$ip','$data_now' )";
$msresults= mssql_query($msquery);

}
}
?>


     <BR><BR> </div></td>
    </tr>
  </table>
</div>
