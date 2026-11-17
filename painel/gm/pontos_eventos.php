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

<center><bR><BR><font size=3><b> ADICIONAR EVENTO </b><bR></font>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 2;
require("../inclu/verif_nivel_gm.php");


$envia = $_GET['envia'];

if($envia==6){

$loginin 	= stripslashes($_POST['loginin']);
$VIPIN 		= stripslashes($_POST['tipo']);

if ((preg_match("[^0-9]", $VIPIN)))
{ 
echo("<font color='red'><b>Somente Números por favor</font></b><bR><Br>"); 
exit(); 
}

if 	($VIPIN == 1) { $n_eventos=1; $n_exp=10; $n_golds=10;}
elseif 	($VIPIN == 2) { $n_eventos=2; $n_exp=20; $n_golds=20;}
elseif 	($VIPIN == 3) { $n_eventos=3; $n_exp=30; $n_golds=30;}
elseif 	($VIPIN == 4) { $n_eventos=4; $n_exp=40; $n_golds=40;}
elseif 	($VIPIN == 5) { $n_eventos=5; $n_exp=50; $n_golds=50;}
elseif 	($VIPIN == 6) { $n_eventos=6; $n_exp=60; $n_golds=60;}
elseif 	($VIPIN == 7) { $n_eventos=7; $n_exp=70; $n_golds=70;}
elseif 	($VIPIN == 8) { $n_eventos=8; $n_exp=80; $n_golds=80;}
elseif 	($VIPIN == 9) { $n_eventos=9; $n_exp=90; $n_golds=90;}
elseif 	($VIPIN == 10){ $n_eventos=10; $n_exp=100; $n_golds=100;}
else {$VIPIN ="";}


$query_GM = "Select Name From Character WHERE accountID = '$login' and nivel_gm>1 ";
$result_GM = mssql_query( $query_GM );
$row_GM = mssql_fetch_row($result_GM);

$GM=$row_GM[0];

$result1 = mssql_query("Select accountid From Character WHERE Name = '$loginin'");
$row1 = mssql_fetch_row($result1);

echo "<font color=red>";

if (empty($loginin) || empty($VIPIN))
{ echo "<font size=2><b><center>Campos em Branco</b></font><br><bR><bR>";
}

elseif (!$row1)     				{  	echo "<font size=2><b><center>Esse char não exixte!!!</b></font><br><bR><bR>"; }
elseif (!$row_GM)		  		{   	echo "<font size=2><b><center>Você não está autorizado!!!</b></font><br><bR><bR>"; }
elseif ($row1[0] == $login)			{ 	echo "<font size=2><b><center>Você não pode add ponto para você mesmo.</b></font><br><bR>"; }

else {

mssql_query("UPDATE Character SET exp_war = exp_war+$n_exp, eventos=eventos+$n_eventos, eventos_semanal=eventos_semanal+$n_eventos, eventos_mensal=eventos_mensal+$n_eventos WHERE Name = '$loginin' and accountid='$row1[0]'");
mssql_query("Update CashShopData set wcoinp = wcoinp + $n_golds where accountid='$row1[0]'");
mssql_query("UPDATE dbo.Character SET evento = evento+$n_eventos, evento_dia=evento_dia+$n_eventos WHERE Name = '$GM'");

echo "<font color=$font_color2><center><b>$n_eventos</b> Evento(s) e <b>$n_golds</b> MGold(s) adicionado(s) para o char <a href='../../info_char_pop.php?server=$server&name=$loginin&painel=ok'><b>$loginin</b></a>. <br><br></font>";

$ip = $_SERVER["REMOTE_ADDR"]; 

//$msg="O char $loginin ganhou um evento( $nome_e ) valendo $points golds, $n_exp Exp e  $n_eventos evento(s) realizado por $GM. Parabéns!!!";
//$senha = "a1b1c1d1";

$msquery = "INSERT INTO LOG_EVENTOS ( login,login_char,personagem,tipo,ip,valor ) values ('$login','$row1[0]','$loginin','$VIPIN','$ip','$n_eventos' )";
$msresults= mssql_query($msquery);
$msquery = "INSERT INTO mk_MurKut_news ( nome,valor,tipo ) values ('$loginin','$GM','3')";
$msresults= mssql_query($msquery);
 
}
}

$serv= 'MU Dravaryn';

$mapa= $_GET[mapa];
if ($mapa=="lorencia"){
$map = "and mapnumber=0";}
elseif ($mapa=="davias"){
$map = "and mapnumber=2";}
elseif ($mapa=="stadium"){
$map = "and mapnumber=6";}
else {
$map="";}


$query = "Select Name From Character, MEMB_STAT,accountcharacter where 
Character.AccountId =AccountCharacter.id COLLATE database_default and
Character.AccountId =Memb_stat.memb___id COLLATE database_default and
Character.name =AccountCharacter.gameIDC COLLATE database_default and
memb_stat.Connectstat=1 and memb_stat.servername='$serv' and character.name<>'webzen' $map order by name";
$result = mssql_query( $query );

$xex = mssql_num_rows($result);

$option='';

for($i=0;$i < $xex;++$i)
{
$row = mssql_fetch_row($result);
$option .= "<option onclick=\"mudar('$row[0]')\">$row[0]</option>";

}



?>

<script type="text/javascript" language="javascript">
function mudar(nome){
document.getElementById("loginin").value = nome;
}
</script>

<form name='form1' method='post' action='?envia=6&serv=<? echo $serv;?>&mapa=<? echo $mapa;?>'>
<table width="600" style="border:0;">
  <tr>
    <td colspan='3'><centeR><table style="border:0;"><tr><td>
- GM esse é seu painel de administração de pontos dos eventos:
<br>- Tudo o que você fizer aqui será gravado em um log!
<br><br></td></tr></table></td>
  </tr>
    <tr style="background:transparent;">
      <td><centeR><b>Personagem:<bR><input name='loginin' type='text' id='loginin'></td>

      <td rowspan=3 valign=top width=150><center> <b>Users ON:
 <bR><SELECT NAME = "lista" SIZE=3 MULTIPLE style="width:120;height:400">
 <? echo $option;?></select>
 <a href=?serv=<? echo $serv;?>&mapa=<? echo $mapa;?>>Atualizar</a></td>
<td>
<br><center> <b>Mapa:</b></center>
<a href=?serv=<? echo $serv;?>&mapa=lorencia>Lorencia</a> <bR>
<a href=?serv=<? echo $serv;?>&mapa=davias>Davias</a> <bR>
<a href=?serv=<? echo $serv;?>&mapa=stadium>Stadium</a> <bR>
<a href=?serv=<? echo $serv;?>>Todos</a> <bR>
</td> 

  </tr>
  <tr style="background:transparent;">
    <td><center><b>Eventos
<br><select name='tipo' id='tipo' MULTIPLE style="width:300;height:200">

<option value=1>1 evento(s) / 10exp / 10Mgols </option>
<option value=2>2 evento(s) / 20exp / 20Mgols </option>
<option value=3>3 evento(s) / 30exp / 30Mgols </option>
<option value=4>4 evento(s) / 40exp / 40Mgols </option>
<option value=5>5 evento(s) / 50exp / 50Mgols </option>
<option value=6>6 evento(s) / 60exp / 60Mgols </option>
<option value=7>7 evento(s) / 70exp / 70Mgols </option>
<option value=8>8 evento(s) / 80exp / 80Mgols </option>
<option value=9>9 evento(s) / 90exp / 90Mgols </option>
<option value=10>10 evento(s) / 100exp / 100Mgols </option>

</select>

    </td>
  </tr>
  <tr style="background:transparent;">
    <td valign=top><br><Br><Br><div align='center'><input type='submit' name='Submit' value='Adicionar Golds' style='font: 17px LithosProBold, Arial, sans-serif;
	color: black;'></form></div></td>
  </tr>
</td></tr></table></form>
</td></tr></table>


</div>

</body>
</html>