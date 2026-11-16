<?

require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET[deletar_msg]){
$msresults= mssql_query("delete from mensagens where login='$login' and id_msg='$_GET[deletar_msg]'");
}

$sql_msg = mssql_query("SELECT id_msg,msg,data,id_resposta,tipo FROM mensagens WHERE login='$login' and respondido=0 order by id_msg desc");

$xexgg = mssql_num_rows($sql_msg);

If ($xexgg > 0 ) {

echo "<centar><table border='0' cellspacing='0' cellpadding='0' width=650 background=http://mukoreia.net/v6/news/fundonews.png>";

for($i=0;$i < $xexgg;++$i)
{
$username_get = mssql_fetch_row( $sql_msg );

$msg = utf8_decode(nl2br($username_get[1]));

echo "
<tr><td colspan=3 height=5 ></td></tr>
      <tr>
	<td valign=top width=250>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Mensagem da Administração:<bR></td>
        <td valign=top></td>
        <td valign=top align=right>$username_get[2]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></tr></td>
	<tr>
	<td valign=top colspan=3><center><table width=90% border='0' cellspacing='0' ><tr><td valign=top><b><font color=green>$msg</td></tr></table></td>
	</tr>
	<tr>
	<td colspan=3 valign=top><table align=right><tr>
	    <td>&nbsp;</td>
	    <td valign=bottom><a href='?deletar_msg=$username_get[0]'> <b>Deletar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> </tr></table></td></tr>
	<tr><td height=5 colspan=3></td></tr>
      <tr><td heigth=5 colspan=3>&nbsp;</td></tr>
";
}

echo "</table>";
}
?>