<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">
  <link type="text/css" rel="stylesheet" href="css/paginas_img.css">

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

<center><bR><BR><font size=3><b> ADICIONAR REPUTAÇÃO <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");
require("inclu/verif_vip.php"); 
require("inclu/verif_resets.php");
?>



  <table width="400" border="0" cellspacing="2" cellpadding="3" bordercolor=#333333>
    <tr>
      <td valign="top"><div align="center">
<?

echo "
Nesse página você pode adiconar uma reputação a algum jogador que você conhece, ela pode ser tanto positiva quanto negativa, você ainda pode comentar o porque de tal reputação.
<br><br>Lembrando que você não pode adicionar uma reputação para você mesmo,as reputações que você adicionar serão vistas por todos pelo site do servidor na parte de informações sobre o personagem, cada reputação adicionada vale para todos os personagens da conta, e não somente para o personagem que você digitou.
<br><br>
<form name='form1' method='post' action='?envia=banir'>
<br><input name='char' type='text' id='char' maxlength='20' value='Personagem' onClick=\"this.select();\"; style='text-align:center'>
<br><br><input name='reason' type='text' id='reason' maxlength='70' value='Comentário' style='text-align:center;width:400' onClick=\"this.select();\";> 
<br><br><SELECT name=reputacao>
			<option value='P'>Positiva</option>
			<option value='N'>Negativa</option>
		</SELECT>
<br><br><input type='submit' name='Submit' value='Continuar'> 
</form>
";

$envia = $_GET[envia];

if($envia==banir){

$name 		= stripslashes($_POST['char']);
$reason 	= stripslashes($_POST['reason']);
$reputacao 	= stripslashes($_POST['reputacao']);

$result = mssql_query("Select accountid From Character where name='$name'");
$login_r = mssql_fetch_row( $result );
$login_r = $login_r[0];

$username_check = mssql_num_rows(mssql_query("SELECT * FROM Character WHERE name='$name'"));

$gm_username_check = mssql_num_rows(mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'"));

$rep_check = mssql_num_rows(mssql_query("SELECT login FROM mk_reputacao WHERE login='$login' and login_r='$login_r'")); 

if (empty($name) or $name=='Personagem') {
echo "<bR><bR><center><B>Coloque o nome do Personagem.<br>";
}

elseif ($username_check <= 0){ 
echo "<bR><bR><center><B>Esse Character nao existe!<br>"; }

elseif ($login == $login_r){ 
echo "<center><B>Você não pode adicionar reputação para você mesmo."; }

elseif ($reason == NULL or $reason=='Comentário'){ 
echo "<bR><bR><center><B>Coloque um comentário"; }

elseif ($rep_check > 0){ 
echo "<bR><bR><center><B>Você já adicionou uma reputação para esse personagem!!<br>"; }

else { 

$reason = utf8_encode($reason);

$msquery = "INSERT INTO mk_reputacao ( login,login_r,reputacao,comentario ) values ('$login','$login_r','$reputacao','$reason')";
	$msresults= mssql_query($msquery);

echo "<bR><bR><center>A reputação para o personagem <B>$name</b> foi confirmada!!<br>";

}
}

?>

 </div></td>
    </tr>
  </table>
</div>
