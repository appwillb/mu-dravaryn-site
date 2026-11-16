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

<center><bR><BR><font size=3><b> CAIXA DE ENTRADA </font></b><bR><BR>


<?
require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET['remover'])
{
$char_remover = $_GET['namer'];

if ($char_remover) {
	$row = mssql_fetch_row(mssql_query("Select accountid from Character where name='$char_remover'"));

	if (!$row) { die("<br><br><br><br><b>Esse personagem não existe!.<bR><bR>");}
	$acc_remover = $row[0];
}
else 
{
	$acc_remover = $_GET['acc'];
}

mssql_query("update mk_mensagens set removeu1='$login' where ((login='$login' and login_r='$acc_remover') or (login_r='$login' and login='$acc_remover')) and removeu1 is null and removeu2 is null");

mssql_query("update mk_mensagens set removeu2='$login' where ((login='$login' and login_r='$acc_remover') or (login_r='$login' and login='$acc_remover')) and (removeu1 = '$acc_remover' and removeu1 is not null)  and removeu2 is null");

mssql_query("update mk_mensagens set viu = 1 where login='$login' and login_r='$acc_remover' and viu=0");

mssql_query("delete from mk_mensagens where removeu1 is not null and removeu2 is not null");
}

$query_msg = mssql_query("
select distinct acc, 
(select top 1 data from MK_Mensagens where (login_r=acc and login='$login') or (login=acc and login_r='$login') order by data desc) as data_sele,
dbo.fn_char_forte(acc),
dbo.fn_img(acc),
(select count(*) from mk_mensagens where ((login   = '$login' and login_r=acc) or (login_r = '$login' and login=acc)) and (removeu1 <> '$login' or removeu1 is null) and (removeu2 <> '$login' or removeu2 is null)),
(select count(*) from mk_mensagens where (login   = '$login' and login_r=acc) and viu=0 and (removeu1 <> '$login' or removeu1 is null) and (removeu2 <> '$login' or removeu2 is null))
from 
(
select distinct MSG.login_r as acc from MK_Mensagens MSG where login='$login' and (removeu1 <> '$login' or removeu1 is null) and (removeu2 <> '$login' or removeu2 is null)
UNION
select distinct MSG.login as acc from MK_Mensagens MSG where login_r='$login' and (removeu1 <> '$login' or removeu1 is null) and (removeu2 <> '$login' or removeu2 is null)
) a order by data_sele desc
");

$msg_total = mssql_fetch_row(mssql_query("select dbo.fn_msg1('$login'), dbo.fn_msg2('$login')"));

?>
<a href=enviar_msg.php><img src=img/BT_nova_msg.png></a><bR><br>
<table width=700 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=6>Mensagens recebidas (Mensagens recebidas: <?=$msg_total[0];?> | Mensagens enviadas: <?=$msg_total[1];?>)</th>
	</tr>
	<tr>	
		<th>Avatar</th>
		<th>De:</th>
		<th>Mensagens:</th>
		<th>Novas:</th>
		<th>Ultima Mensagem:</th>
		<th>Apagar:</th>
	</tr>
  </thead>

<?PHP

while ($row = mssql_fetch_row($query_msg))
{
$login_enviou 	= $row[0];
$data_enviou 	= date_format(date_create("$row[1]"), 'd-m-Y H:i');
$char_enviou 	= $row[2];
$img_enviou 	= $row[3];
$total_msg    	= $row[4];
$novas_msg	= $row[5];

$pisca = ($novas_msg > 0) ? "<img src=img/Pisca.gif> <font><b>$msgscount_viu</b></font>" : $pisca = " &nbsp;";

$char_enviou3 = (!$char_enviou) ? "acc=$login_enviou" : "namer=$char_enviou";
$char_enviou2 = (!$char_enviou) ? "acc=$login_enviou" : "name=$char_enviou";
$char_enviou  = (!$char_enviou) ? "<font color=$font_color1>Sem Char" : $char_enviou;


if ($img_enviou){
$avatar ="../avatar/thumb.php?imagem=$img_enviou&y=40&x=40&qualidade=100";
} else {
$avatar ='../avatar/Icon-user40.png';
}

$char_enviou .= (!$char_enviou) ? "acc=$login_enviou" : "";

echo "<tr>
<td onclick=\"document.location.href='mensagens_ver.php?$char_enviou2'\"  onmouseover=\"this.style.cursor='pointer';\"><img src=$avatar width=40 class=redondo_avatar></td>
<td onclick=\"document.location.href='mensagens_ver.php?$char_enviou2'\"  onmouseover=\"this.style.cursor='pointer';\"><b>$char_enviou</td>
<td onclick=\"document.location.href='mensagens_ver.php?$char_enviou2'\"  onmouseover=\"this.style.cursor='pointer';\"><font size = 3><b>$total_msg</td>
<td onclick=\"document.location.href='mensagens_ver.php?$char_enviou2'\"  onmouseover=\"this.style.cursor='pointer';\"><font size = 3><b>$novas_msg $pisca</td>
<td onclick=\"document.location.href='mensagens_ver.php?$char_enviou2'\"  onmouseover=\"this.style.cursor='pointer';\">$data_enviou</td>
<td><a href='#' onclick=\"javascript:confirmaExclusao('?remover=ok&$char_enviou3','Deseja realmente remover essa conversa?')\"> <img src=img/2.png> </a></td>
</tr>

";

}

?>
<script>
function confirmaExclusao(aURL,aMensagem) {
if(confirm(aMensagem)) {
location.href = aURL;
}
}
</script>
</table>
</div>

