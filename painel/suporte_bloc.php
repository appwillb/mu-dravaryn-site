<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">
  <link type="text/css" rel="stylesheet" href="css/paginas_img.css">


</head>
<body leftmargin='0' topmargin='0' bgcolor=black>

<center>

<?PHP 
require_once("inclu/config.php");
require("inclu/cookie.php");


if($_GET[enviarmsgg]){
$enviarmsgg = $_GET[enviarmsgg];
$mensagem = utf8_encode(stripslashes($_POST['mensagem']));
$nome = stripslashes($_POST['nome']);

if ($nome == 1) {
$loginmsg = 'louis';
$admm = 'Luis[ADM]';
$nivel_gm = '5';
}
elseif ($nome == 2) {
$loginmsg = 'louis';
$admm = 'venu[ADM]';
$nivel_gm = '5';
}
else {
$acc = mssql_fetch_row(mssql_query("SELECT accountid,nivel_gm from character where name='$nome'"));
$loginmsg = "$acc[0]";
$nivel_gm = "$acc[1]";
}

$msg_check = mssql_num_rows(mssql_query("Select login_r FROM mk_mensagens WHERE login_r='$login' and respondido=0"));

if ($enviarmsgg==null || $mensagem==null || $nome==null){
Echo"<center><bR><font size=3 color=$font_color1>Campos em Branco!!</font></b><bR><Br>";} 

elseif ($nivel_gm<=0) {
Echo"<center><bR><font size=3 color=$font_color1><b>Esse pergonagem não faz parte da staff!</font></b><bR><Br>";} 

//elseif ($msg_check>10) {
//Echo"<center><bR><font size=3 color=$font_color1><b>Você não pode enviar várias mensagens para a staff, aguarde a resposta.</font></b><bR><Br>";} 

else {

if ($nivel_gm==5){
mssql_query("INSERT INTO mk_mensagens (login,msg,login_r,adm) values ('$loginmsg','$mensagem','$login','$admm')");
}else {
mssql_query("INSERT INTO mk_mensagens (login,msg,login_r) values ('$loginmsg','$mensagem','$login')");
}

echo "<center><bR><font size=3 color=green>Mensagem enviada com Sucesso!!</font><bR><Br>";
}
}

echo "<table border='0' cellspacing='0' cellpadding='0' width=650>";

echo "<center><table width='140' border='0' cellspacing='0' cellpadding='0'>
<form name='form1' method='post' action='?enviarmsgg=ok'>
  <tr>
    <td><center><font size=2><b>Enviar para<br></b>
<select name='nome' id='nome_help'>
<option value=0>Escolha o char</option>
<option value=1>Luis[ADM] - Administração</option>
<option value=2>venu[ADM] - Administração</option>";
echo "
</select>

    </td>
  </tr

  <tr>
    <td><center>
	<bR>Mensagem:
        <textarea name='mensagem' cols='70' rows='10'></textarea><bR>
        <input type='submit' value='Enviar Mensagem'>
    </td>
  </tr></form></table><bR>";



echo "</table>";


$query = "Select data,obs,mostrar,id_obs From log_obs where login='$login' and mostrar=1 order by id_obs desc";
$result = mssql_query( $query );

$xex_obs = mssql_num_rows($result);

if ($xex_obs > 0 ) {

echo "<br><table border=1 cellSpacing=0 width=600>
	<tr><td colspan=2><center><font size=3><b>Observações:</td></tr>
    <tr>
      <td><center><b>Data:</font></center></td>
      <td><b><center>Comentário:</center>
</tr> ";



for($i=0;$i < $xex_obs;++$i)
{
$row = mssql_fetch_row($result);

$data        =   $row[0];
$obs_conta   =   utf8_decode($row[1]);
$mostrar     =   $row[2];
$id          =   $row[3];

$sele1 = '';
$sele2 = '';

if ($mostrar=="1") $sele1='selected'; else $sele2='selected';

echo "
<tr>
<td width=120><center>
$data</td>
<td><center>$obs_conta</td>
</tr>";

}

echo "</td></tr></table><BR>";

}

