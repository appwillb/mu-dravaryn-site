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

<center><bR><BR><font size=3><b> MUDAR REPUTAÇÃO </font></b><bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");
require("inclu/verif_vip.php"); 
require("inclu/verif_resets.php");
?>

Nessa página você pode mudar a reputação que você deu para algum personagem.<br><bR>

<?PHP

if($_GET[post]){

$login_repu = stripslashes($_POST['login_repu']);
$id         = stripslashes($_POST['id']);
$comentario = utf8_encode(stripslashes($_POST['comentario']));
$reputacao  = stripslashes($_POST['reputacao']);

if ($reputacao<>'P' and $reputacao<>'N') $reputacao='P';

elseif (empty($login_repu))   {
echo "<b>Campos em branco.<bR><br>";}

else {

$msresults= mssql_query("UPDATE mk_reputacao SET reputacao = '$reputacao', comentario = '$comentario' WHERE login = '$login' and login_r='$login_repu' and id='$id'");
}

}

echo"

<table border=0 cellSpacing=0 width=700 align=center>

  <thead>
	<tr>	
		<th colspan=5>Reputações</th>
	</tr>
  </thead>

    <tr>
      <td width=40> </td>
      <td><center><b>Pesonagem:</font></center></td>
      <td><b><center>Comentario:</center>
      <td><b><center>Mudar:</center>
      <td width=30> </td>
</tr>";

$query = "Select id,login, login_r,reputacao, comentario From mk_reputacao where login = '$login' and exists (select memb___id from memb_info where memb_info.memb___id= mk_reputacao.login_r collate database_default) order by id desc";
$result = mssql_query( $query );

$waw = mssql_query("SELECT count(*) From mk_reputacao where login = '$login' and exists (select memb___id from memb_info where memb_info.memb___id= mk_reputacao.login_r collate database_default)");
$xex = mssql_result($waw, 0, 0);

for($i=0;$i < $xex;++$i)
{
$row = mssql_fetch_row($result);

$id          =   $row[0];
$login_conta =   $row[1];
$login_repu  =   $row[2];
$reputacao   =   $row[3];
$comentario  =   utf8_decode($row[4]);

$sele1 = '';
$sele2 = '';

if ($reputacao=="P") $sele1='selected'; else $sele2='selected';

$query2 = "select top 1 name FROM Character where accountid='$login_repu' order by masterresetcount desc,resetcount desc";
$result2 = mssql_query( $query2 );
$row2 = mssql_fetch_row($result2);

$nome = $row2[0];

$imagem = "";
if ($reputacao == "P" ){ $imagem = "<img src=img/add.gif height=20>"; }
if ($reputacao == "N" ){ $imagem = "<img src=img/Minus_Icon.png height=20>"; }

echo "<form name='form1' method='post' action='?post=ok'>

<tr>
<td><center>$imagem</td>
<td>
	<input type='hidden' name='login_repu' value='$login_repu'>
	<input type='hidden' name='id' value='$id'>
<a href='../info_char.php?name=$nome' target='main2'><font size=1>$nome</a></td>
<td><center><input type='text' name='comentario' maxlength='70' value='$comentario' style='text-align:center;width:250' onClick=\"this.select();\";></td>
<td><select name='reputacao' id='reputacao'>
 <option value='P' $sele1> Positiva  </option>
 <option value='N' $sele2> Negativa  </option>
</select></td>
<td><center><input type='submit' name='Submit' value='OK'></td>
</tr></form>";



}

echo "</table>";

?>
</div>