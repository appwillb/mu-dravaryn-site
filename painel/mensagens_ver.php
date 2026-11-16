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

<center><bR><BR><font size=3><b> VER CONVERSA </font></b><bR><BR>


<?
require("inclu/config.php");
require("inclu/cookie.php");

$char = $_GET['name'];

if($_GET[enviarmsgg]){

$mensagem = utf8_encode(stripslashes($_POST['mensagem']));
$nome = $char;

if ($nome)
{
$acc = mssql_fetch_row(mssql_query("SELECT accountid,nivel_gm from character where name='$nome'"));
$loginmsg = "$acc[0]";
$nivel_gm = "$acc[1]";
}

else 
{
	$nome = '<font color=$font_color1>Sem Char</font>';
	$loginmsg = $_GET['acc'];

}


$msg_check = mssql_num_rows(mssql_query("Select login_r FROM mk_mensagens WHERE login='$loginmsg' and login_r='$login' and respondido=0"));

if ($mensagem==null || $nome==null){
Echo"<center><font size=2 color=$font_color1><b>Campos em Branco!!</font></b><bR><Br><Br>";} 

elseif (!$loginmsg) {
Echo"<center><font size=2 color=$font_color1><b>Esse Personagem não existe!</font></b><bR><Br><Br>";} 

elseif ($msg_check>4) {
Echo"<center><font size=2 color=$font_color1><b>Você não pode enviar mais que 5 mensagens para o mesmo personagem!<Br>Aguarde ele responder!</font></b><bR><Br><Br>";} 

	else 
	{
		mssql_query("INSERT INTO mk_mensagens (login,msg,login_r,suporte) values ('$loginmsg','$mensagem','$login','0')");
		mssql_query("update mk_mensagens set respondido = 1 where login='$login' and login_r='$loginmsg' and respondido=0");
	}
}

if ($char)
{

	$row = mssql_fetch_row(mssql_query("Select accountid from Character where name='$char'"));

	if (!$row) { die("<br><br><br><br><b>Essa conversa não existe.<bR><bR>"); }

	$acc_msg = $row[0];
	
	$envia = "name=$char";
}

else 
{
	$char = "<font color=$font_color1>Sem Char</font>";
	$acc_msg = $_GET['acc'];
	$envia = "acc=$acc_msg";

}

if ($acc_msg) {

mssql_query("update mk_mensagens set viu = 1 where login='$login' and login_r='$acc_msg' and viu=0");

$query_msg = mssql_query("Select msg, data, login_r, dbo.fn_img(login_r), viu, dbo.fn_nivel_gm('$login') from mk_mensagens where ((login='$login' and login_r='$acc_msg') or (login_r='$login' and login='$acc_msg')) and (removeu1 <> '$login' or removeu1 is null) and (removeu2 <> '$login' or removeu2 is null) order by data asc");

?>

<table width=800 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=4>Conversa com <?=$char;?></th>
	</tr>
	<tr>	
		<th>Avatar</th>
		<th>De:</th>
		<th>Mensagens:</th>
		<th>Data:</th>
	</tr>
  </thead>

<?PHP

while ($row = mssql_fetch_row($query_msg))
{
$msg = utf8_decode(nl2br($row[0]));
$data_enviou 	= date_format(date_create("$row[1]"), 'd-m-Y H:i');
$login_enviou 	= $row[2];
$img_enviou 	= $row[3];
$nivel_gm 	= $row[5];

$pisca = ($novas_msg > 0) ? "<img src=img/Pisca.gif> <font><b>$msgscount_viu</b></font>" : $pisca = " &nbsp;";

$showlogin = ($nivel_gm == 5) ? " (<a href = 'gm/editar_conta.php?loginlog=$login_enviou'>$login_enviou</a>) <Br>" : "";

$char_enviou = ($login_enviou == $login) ? "<font color=$font_color1><b>Você" : "$showlogin <b>$char";

if ($img_enviou)
{
	$avatar ="../avatar/thumb.php?imagem=$img_enviou&y=40&x=40&qualidade=100";
} else {
	$avatar ='../avatar/Icon-user40.png';
}

echo "<tr>
<td><img src=$avatar width=40 class=redondo_avatar></td>
<td>$char_enviou</td>
<td style='text-align:left;width:550px;'>$msg</td>
<td style='width:100px;'>$data_enviou</td>

</tr>

";

}

echo "</table><bR>";

}

echo "

<form name='form1' method='post' action='?enviarmsgg=ok&$envia'>

<table width=700 border=0 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=3>Responder mensagem</th>
	</tr>
  </thead>

  <tr style='background:transparent;'>
    <td><center>
	<bR><font size=2><b>Mensagem:</font></b><Br>
        <textarea name='mensagem' cols='70' rows='10'></textarea><bR><bR>
	<input type='image' src='img/BT_enviar2.png' value='Enviar Mensagem'style='border:0;background:transparent;'>
    </td>
  </tr></form>

</table>";

?>

</div>

