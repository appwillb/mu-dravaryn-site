<?PHP

if($_GET[add]){
$nome_help = stripslashes($_POST['nome_help']);

$userlogin = mssql_fetch_row(mssql_query("SELECT accountid FROM Character WHERE name='$nome_help'"));
$ip2 = $_SERVER["REMOTE_ADDR"];

$hoje_check   = mssql_num_rows(mssql_query("Select login_recebeu FROM LOG_VOTOS WHERE login_fez = '$login' and (CONVERT(CHAR(8),data,10))=(CONVERT(CHAR(8),GETDATE(),10))"));
$voto_check   = mssql_num_rows(mssql_query("Select login_recebeu FROM LOG_VOTOS WHERE login_fez = '$login'"));
$vip_check    = mssql_num_rows(mssql_query("select vip from memb_info where memb___id='$login' and vip=1"));
$nome_check   = mssql_num_rows(mssql_query("Select name FROM character WHERE name='$nome_help' and nivel_gm>0"));
$gm_check     = mssql_num_rows(mssql_query("Select name FROM character WHERE accountid='$login' and nivel_gm>0"));


if     ( empty($nome_help)    ) {echo "<script language=\"Javascript\">alert(\"Campos em branco.\")</script>";}
elseif ( $nome_check   <= 0   ) {echo "<script language=\"Javascript\">alert(\"Esse Personagem não existe.\")</script>";}
elseif ( $userlogin[0]==$login) {echo "<script language=\"Javascript\">alert(\"Você não pode votar em você mesmo.\")</script>"; }
elseif ( $voto_check  > 0     ) {echo "<script language=\"Javascript\">alert(\"Você já votou!\")</script>"; }
elseif ( $hoje_check  > 0     ) {echo "<script language=\"Javascript\">alert(\"Você já votou hoje. Amanhã poderá votar novamente!\")</script>"; }
elseif ( $gm_check  > 0    )   {echo "<script language=\"Javascript\">alert(\"Staff não pode votar.\")</script>"; }
//elseif ( $vip_check  <= 0     ) {echo "<script language=\"Javascript\">alert(\"Você não é vip.\")</script>"; }

else {

$msresults= mssql_query("UPDATE character SET votos = votos+1 where name='$nome_help' and accountid='$userlogin[0]'");

$msquery = "INSERT INTO LOG_VOTOS ( login_fez,login_recebeu,ip ) values ('$login','$userlogin[0]','$ip2')";
	$msresults= mssql_query($msquery);

Echo "<script language=\"Javascript\">alert(\"Seu voto foi registrado.\")</script>";
}
}

else { 

$sql_username_check = mssql_query("select Name from character where nivel_gm=2 or nivel_gm = 3 order by nivel_gm desc, evento desc"); 
$num = mssql_num_rows($sql_username_check);


$msgsvotos = "
<table cellspacing=0 border=0><tr><td>
<table width=750 cellspacing=0 class='text_default' style='text-align:justify; padding:5px 10px 5px 10px; border:1px dashed #46291a;'><tr><td><img src=img/loginho.png></td><td><b>

<center><BR><b>Qual GM fez os melhores eventos nessa semana?</b>
<div align='center'>

<form name='form1' method='post' action='?add=ok'>
<table border='0' cellspacing='3' cellpadding='0'>

<tr>
<td align=center>
<select name='nome_help' id='nome_help'>
<option value=0>-Escolher o GM-</option>";


for($i=0;$i < $num;++$i)
{
$username_get = mssql_fetch_row( $sql_username_check );
$msgsvotos .= "<option value='$username_get[0]'> $username_get[0] </option>"; }

$msgsvotos .= "

</select>
</td>
</tr>

</tr>
<tr>
<td align=center><br><input type='submit' name='Submit' value='Escolher GM' class=imput></td>
</tr>

</table>
</form>

</td><td valign=top width=23><a href=?msg_viu=ok><img src=img/2.png></a></td></tr></table></div><b class='b4'></b><b class='b3'></b><b class='b2'></b><b class='b1'></b></td></tr></table></div>";


}

?>