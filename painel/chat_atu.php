<?PHP
require("inclu/config.php");
require("inclu/cookie.php");

$select 	= mssql_query("select bloc_code, bandeira from memb_info where memb___id='$login'
				exec chat_atualizar '$login'");
$row_select 	= mssql_fetch_row($select);

if($row_select[0] > 0)
{
echo "
<script>
top.location.href = 'index.php';
</script>
";
}

if(!$row_select[1])
{
echo "
<script>
document.location.href = 'mudar_bandeira.php';
</script>
";
}

$select = 15;

$chat = mssql_query(" select top $select * from ( select TOP $select * from (
( select msg as valor, tabela=4, tipo=0, CONVERT(VARCHAR(19),data,120) as data, id_chat as idd, name,dbo.fn_img(login) as img, login, dbo.fn_whats(login) as whats, dbo.fn_bandeira(login) as band from MK_chat)

) a order by data desc ) b order by data asc ");


?>

<table style='border:0;'><tr style="background:transparent;"><td>
<table width=700 cellspacing=0 align=center style='border:0;'>

<?

for($i=0;$i < 15;++$i)
{
$row2 = mssql_fetch_row($chat);
$valor = $row2[0];
$tabela= $row2[1];
$tipo  = $row2[2];
$data  = $row2[3];
$acc   = $row2[5];
$imga  = $row2[6];
$logc  = $row2[7];
$whats = $row2[8];
$band  = $row2[9];


$data = date_create("$data");
$data = date_format($data, 'H:i');

if ($i % 2==0){
$color= "#BEBEBE";
} else {
$color= "#cccccc"; }


if ($tabela==4){ 

$valor= utf8_decode($valor);

if($band){
$bandeira = "<img src=../img/bandeiras30/$band.png>";
}
else
{
$bandeira = "<img src=../img/bandeiras30/00.png>";
}

if ($row2[6]){
$avatar ="../avatar/thumb.php?imagem=$row2[6]&y=30&x=30&qualidade=100";
}else{
$avatar ='../avatar/Icon-user30.png';
}


//FIM

if ($whats > 0) {
$whats = "<img src=../img/icon-whatsapp.png>";
}
else $whats= '';


$text_c = $valor;

$text_c = preg_replace("/(\s){2,}/",'$1',$text_c);
$text_c = preg_replace('{( ?.)\1{4,}}','$1$1$1',$text_c);

$word = array(":)","/o/","Oo","kkk",":~",":D",":(",":@",":bye"); 

  foreach($word as $words) 
    if(substr_count($text_c, $words) > 3) {

$text_c='Sou Noob';
}

$tamanhomaximo = 100; //tamanho maximo de cada palavra


$palavras = explode(" ", $text_c);


  foreach ($palavras as $palavras_W)
  {
      $tamanhop = strlen($palavras_W); 
    if ($tamanhop > $tamanhomaximo){

    //$primeira_parte = substr($palavras_W, 0, ($tamanhomaximo/2)); 
    //$segunda_parte  = substr($palavras_W, -($tamanhomaximo/2)); 
    //$text_c = str_replace($palavras_W, $primeira_parte." ... ".$segunda_parte, $text_c);
    $text_c = "Digitei uma palavra muito grande!";
    }

  }


$text_c = str_replace(":)", "<img src=img/emo/biggrin.png style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace("/o/", "<img src=img/emo/dancing4dh.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace("goku..", "<img src=img/emo/goku.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace("Oo", "<img src=img/emo/omg-msn-smiley.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace("kkk", "<img src=img/emo/rindo.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":~", "<img src=img/emo/at-wits-end-yahoo-emoticon.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":-", "<img src=img/emo/angry-skype-smiley.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":D", "<img src=img/emo/baeh-smiley.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":(", "<img src=img/emo/broken-heart-yahoo-emoticon.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":@", "<img src=img/emo/big-smile2-smiley.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":bye", "<img src=img/emo/bye2.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":´(", "<img src=img/emo/crying-yahoo-emoticon.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");
$text_c = str_replace(":´o", "<img src=img/emo/baby-smiley.gif style=\"padding-bottom: 4px; vertical-align: middle;\">", "$text_c");


$text_c = str_replace("...troll", "<img src=img/emo/trollface.gif>", "$text_c");
$text_c = str_replace("...fuu", "<img src=img/emo/fffuuu.gif>", "$text_c");
$text_c = str_replace("...trol3", "<img src=img/emo/troll3.gif>", "$text_c");
$text_c = str_replace("...luta1", "<img src=img/emo/luta.gif>", "$text_c");
$text_c = str_replace("...luta2", "<img src=img/emo/luta2.gif>", "$text_c");
$text_c = str_replace("...luta3", "<img src=img/emo/luta3.gif>", "$text_c");
$text_c = str_replace("...dbz", "<img src=img/emo/dbz1.gif>", "$text_c");

echo" <tr height=20 bgcolor=$color>
	<td width=5><B> </td>
	<td width=35><font size=3>$data </td>
  <td width=35><a href='../info_char_pop.php?server=$server&name=$acc&painel=ok'><img src=$avatar width=30 class=redondo_avatar></a></td>
  <td width=30><a href='../info_char_pop.php?server=$server&name=$acc&painel=ok'>$bandeira</a></td>
  <td width=95><a href='../info_char_pop.php?server=$server&name=$acc&painel=ok'>$acc $whats</a></td>
  <td><b>$text_c</td>
  </td>
 </tr>";

}
}

?>

</table></div></td><td valign=top bgcolor=#BEBEBE>

<table width=160 border=0><tr><td colspan=3><center><b>Online no Chat</td></tr> 

<?

$select    = mssql_query("Select top 15 login,dbo.fn_img(login),dbo.fn_char_forte(login),dbo.fn_chat_online() from MK_chat_online where data > DateADD(mi, -10, getdate())");
$qtd_chat  = mssql_num_rows($select);

for($i=0;$i < $qtd_chat;++$i)
{
$char_on = mssql_fetch_row($select);



if ($char_on[1]){
$avatar ="../avatar/thumb.php?imagem=$char_on[1]&y=20&x=20&qualidade=100";
} else {
$avatar ='../avatar/Icon-user-mini.png';
}

//$char_on2 = mssql_fetch_row(mssql_query("SELECT top 1 name from character where accountid = '$char_on[0]' order by resetcount desc,clevel desc"));

if (!$char_on[2]) { $char_on[2] = 'Sem Char'; }

echo "<tr>
	<td><a href='../info_char_pop.php?server=$server&name=$char_on[2]&painel=ok'><img src=$avatar width=20 class=redondo_avatar></a></td>
	<td><a href='../info_char_pop.php?server=$server&name=$char_on[2]&painel=ok'>$char_on[2]</a></td>
	<td width=20><a href='enviar_msg.php?char=$char_on[2]'><img src='img/enviar2.gif' title='Enviar Mensagem' alt='Enviar Mensagem' width=20></a></td>
      </tr>";

}

echo "<script language='javascript'>
$('#atuqtd').empty().html('$qtd_chat Usuários Online');
</script>";

?>



</table></td></tr></table>