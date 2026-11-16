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

<center><bR><BR><font size=3><b> ENVIAR MENSAGEM <bR><BR></font></b>

<?PHP 
require("inclu/config.php");
require("inclu/cookie.php");

if($_GET[enviarmsgg]){
$enviarmsg = $_GET[enviarmsgg];
$mensagem = utf8_encode(stripslashes($_POST['mensagem']));
$nome = stripslashes($_POST['nome']);

$acc = mssql_fetch_row(mssql_query("SELECT accountid,nivel_gm from character where name='$nome'"));
$loginmsg = "$acc[0]";
$nivel_gm = "$acc[1]";

$msg_check = mssql_num_rows(mssql_query("Select login_r FROM mk_mensagens WHERE login='$loginmsg' and login_r='$login' and respondido=0"));

if ($enviarmsg==null || $mensagem==null || $nome==null){
Echo"<center><font size=2 color=$font_color1><b>Campos em Branco!!</font></b><bR><Br><Br>";} 

elseif (!$loginmsg) {
Echo"<center><font size=2 color=$font_color1><b>Esse Personagem não existe!</font></b><bR><Br><Br>";} 

elseif ($nivel_gm>1) {
Echo"<center><font size=2 color=$font_color1><b>Para enviar mensagens para a Staff utilize o Suporte!</font></b><bR><Br><Br>";} 

elseif ($msg_check>4) {
Echo"<center><font size=2 color=$font_color1><b>Você não pode enviar mais que 5 mensagens para o mesmo personagem!<Br>Aguarde ele responder!</font></b><bR><Br><Br>";} 

else {

mssql_query("INSERT INTO mk_mensagens (login,msg,login_r,suporte) values ('$loginmsg','$mensagem','$login','0')");



$amigo_check = mssql_num_rows(mssql_query("Select login FROM mk_chat_amigos WHERE login_amigo='$loginmsg' and login='$login'"));
if ($amigo_check <=0 ){
mssql_query("INSERT INTO mk_chat_amigos (login_amigo,login) values ('$loginmsg','$login')");
}

mssql_query("Update mk_chat_amigos set data=(getdate()), qtd_msgs=qtd_msgs+1 where login='$login' and login_amigo = '$loginmsg'");

echo "<center><font size=2 color=green><b>Mensagem enviada com Sucesso!!</b></font><bR><Br><Br>";
}
}

if ($_GET[char]){

$nome_c = $_GET[char];

}

else
{
$nome_c = "Nome do Personagem";
}


echo "<table width=700 border=0 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=3>Enviar mensagem</th>
	</tr>
  </thead>


<tr style='background:transparent;'><td>";
echo "<center><table width='140' border='0' cellspacing='0' cellpadding='0' style='border:0;'>
<form name='form1' method='post' action='?enviarmsgg=ok'>
  <tr style='background:transparent;'>
  </tr>
  <tr style='background:transparent;'>
    <td><center><b>Nessa página você pode enviar uma mensagem privada para outro Personagem.<br><Br>

<input name='nome' type='text' id='nome' maxlength='20' value='$nome_c' onClick=\"this.select();\"; style='text-align:center'>
    </td>
  </tr>
  <tr style='background:transparent;'>
    <td><center>
	<bR>Mensagem:
        <textarea name='mensagem' cols='70' rows='10'></textarea><bR><bR>
<input type='image' src='img/BT_enviar2.png' value='Enviar Mensagem'style='border:0;background:transparent;'>
    </td>
  </tr></form></table>



</td><td valign=top bgcolor=#BEBEBE>

<table width=160 border=0 style='border:0;' cellspacing=0><tr><td colspan=3><center><b>Ultima Conversas</td></tr> ";

$select = mssql_query("Select top 10 login_amigo,dbo.fn_img(login_amigo) from mk_chat_amigos where login ='$login' order by data desc");
$qtd_chat = mssql_num_rows($select);

for($i=0;$i < $qtd_chat;++$i)
{
$char_on = mssql_fetch_row($select);


//SISTEMA DO MURKUT
if ($char_on[1]) {
$avatar ="../avatar/thumb.php?imagem=$char_on[1]&y=20&x=20&qualidade=100";
}else{
$avatar ='../avatar/Icon-user-mini.png';
}



$char_on2 = mssql_fetch_row(mssql_query("SELECT top 1 name from character where accountid = '$char_on[0]' order by resetcount desc,clevel desc"));

echo "<tr>
	<td><a href='../info_char_pop.php?server=$server&name=$char_on2[0]&painel=ok'><img src=$avatar width=20 class=redondo_avatar></a></td>
	<td><a href='../info_char_pop.php?server=$server&name=$char_on2[0]&painel=ok'>$char_on2[0]</a></td>
	<td width=20><a href='enviar_msg.php?char=$char_on2[0]'><img src='img/enviar2.gif' title='Enviar Mensagem' alt='Enviar Mensagem' width=20></a></td>
      </tr>";

}

?>



</table></td></tr></table>


<br><bR>



