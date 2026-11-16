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

<center><bR><BR><font size=3><b> BANIR PERSONAGEM </b><bR></font>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 2;
require("../inclu/verif_nivel_gm.php");


echo "
<body>
<form name='form1' method='post' action='?envia=banir'>
<br><input name='char' type='text' id='char' maxlength='20' value='Personagem' onClick=\"this.select();\";>
<br>
<br><select name='bann' id='bann'>
 <option value='12'>Atrapalhar evento        (1 dia)  </option>
 <option value='10'>Pedir Agradecimento/Retri pelo chat ou post (2 dias)  </option>
 <option value='1'>Atrapalhar evento        (3 dias)  </option>
 <option value='3'>Divulgação de outro MU   (10 dias) </option>
 <option value='11'>Pedir Retri na reputação (10 dias) </option>
 <option value='9'>Flood No Post            (5 dias) </option>
 <option value='5'>Se passar por GM ou ADM  (30 dias) </option>
 <option value='6'>Nick(GM/ADM)             (50 dias) </option>
 <option value='8'>Speed ou Trade Hacker    (9999 dias) </option>
</select>

<br><br>Screenshot (caso tenha o link da ss, favor colocar apenas links do site imageshack.us ou do imgur.com )
<br><input type='text' name='obs' id='obs' value='' style='width:550'>
<br><br><input type='submit' name='Submit' value='Banir Personagem' style='font: 17px LithosProBold, Arial, sans-serif;
	color: black;'> 
</form><br><br>
";

$envia = $_GET[envia];

if($envia==banir){

$name = stripslashes($_POST['char']);
$bann = stripslashes($_POST['bann']);
$obs = stripslashes($_POST['obs']);

$query = "Select Name From Character where nivel_gm>0 and AccountID='$login'";
$result = mssql_query( $query );
$GM = mssql_fetch_row( $result );
$bloc_by = $GM[0];

// PEGA A DATA E O HORÁRIO ATUAL
$ano = date('y'); // Pega o Ano
$mes = date("m"); // Pega o Mês
$dia = date('d'); // Pega o Dia
$data_atual = "$dia/$zero$mes/$ano"; // Pega a Data Atual

$reason ="eita";

if ($bann==1){
$reason = 'Atrapalhar evento';
$dias='3';}
elseif ($bann==2){
$reason = 'Ofender player';
$dias='6';}
elseif ($bann==3){
$reason = 'Divulgação de outro MU';
$dias='10';}
elseif ($bann==4){
$reason = 'Ofender GM e ADM';
$dias='15';}
elseif ($bann==5){
$reason = 'Se passar por GM ou ADM';
$dias='30';}
elseif ($bann==7){
$reason = 'Jogar Apostado';
$dias='15';}
elseif ($bann==6){
$reason = 'Nick(GM/ADM)';
$dias='50';}
elseif ($bann==8){
$reason = 'Speed ou Trade Hacker';
$dias='9999';}
elseif ($bann==9){
$reason = 'Flood no Post';
$dias='5';}
elseif ($bann==10){
$reason = 'Pedir Agradecimento/Retri pelo chat ou post';
$dias='2';}
elseif ($bann==11){
$reason = 'Pedir retri na reputação';
$dias='10';}
elseif ($bann==12){
$reason = 'Atrapalhar evento';
$dias='1';}


$sql_username_check = mssql_query("SELECT * FROM Character WHERE name='$name'"); 
$username_check = mssql_num_rows($sql_username_check);

$sql_bann_check = mssql_query("SELECT * FROM Character WHERE name='$name' and ctlcode='1'"); 
$bann_check = mssql_num_rows($sql_bann_check);

$sql_gm_username_check = mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'"); 
$gm_username_check = mssql_num_rows($sql_gm_username_check);

$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb__pwd='$psw' and memb___id='$login'"); 
$pw_check = mssql_num_rows($sql_pw_check); 

$ctl_query_result = mssql_query( "select nivel_gm from Character WHERE Name='$bloc_by' and AccountID='$login'" );
$gm_check = mssql_fetch_row( $ctl_query_result );

$gm_check1 = mssql_fetch_row(mssql_query("select nivel_gm,accountid from Character WHERE Name='$name'"));

if (empty($name) or $name=='Personagem') {
echo "<center><font color=$font_color1>Coloque o nome do Personagem a ser banido.<br>";
}

elseif ($username_check <= 0){ 
echo "<font color=$font_color1><center><b>Esse Character nao existe!<br>"; }

elseif ($bann_check > 0){ 
echo "<font color=$font_color1><center><b>Esse Character já está banido!<br>"; }

elseif ($gm_check1[0] > 0){ 
echo "<font color=$font_color1><center><b>Proibido dar BAN em GM!<br>"; }

elseif ($reason == NULL or $reason=='Motivo do Ban'){ 
echo "<font color=$font_color1><center><b>Coloque um motivo!"; }

elseif ($pw_check <= 0){ 
echo "<font color=$font_color1><center><b>Senha inválida<br>"; }

elseif ($gm_check[0] < 1){ 
echo "<font color=$font_color1><center><b>Você não está autorizado!<br>"; }

else { 

if ( $obs ) {
$reason = "$reason <b>SS:</b>$obs";
}

$msquery = "UPDATE dbo.Character
SET CtlCode=1, bloc_reason='$reason', bloc_by='$bloc_by', dia_bloc='$dias'
WHERE Name = '$name'
";
$msresults= mssql_query($msquery);

mssql_query("INSERT INTO MK_Murkut_news ( nome,valor,valor2,tipo ) values ('$name','$bloc_by','$reason','5' )");
mssql_query("INSERT INTO LOG_BAN ( login,name,reason,gm ) values ('$gm_check1[1]','$name','$reason','$bloc_by')");

$num_ban = mssql_num_rows(mssql_query("SELECT login from log_ban where login='$gm_check1[1]' and (CONVERT(CHAR(8),data,10))=(CONVERT(CHAR(8),GETDATE(),10))")); 

if ($num_ban>2){
mssql_query("update memb_info set bloc_code=1,bloc_eterno=1 where memb___id='$gm_check1[1]'");
}



echo "<center><font color=$font_color2><b>$name</b> está banido <br>";

}
}

?>


     <BR><BR> </div></td>
    </tr>
  </table>
</div>
