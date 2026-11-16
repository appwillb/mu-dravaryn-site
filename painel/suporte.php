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
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">
<br><Br><font size=3><b>SUPORTE</font></b><br>

<?PHP 
require("inclu/config.php");
require("inclu/cookie.php");

if($_GET[enviarmsgg])
{

$enviarmsgg 	= $_GET[enviarmsgg];
$mensagem 	= utf8_encode(stripslashes($_POST['mensagem']));
$nome 		= stripslashes($_POST['nome']);

$acc 		= mssql_fetch_row(mssql_query("SELECT accountid,nivel_gm from character where name='$nome'"));
$loginmsg 	= "$acc[0]";
$nivel_gm 	= "$acc[1]";

//$msg_check 	= mssql_num_rows(mssql_query("Select login_r FROM mk_mensagens WHERE login_r='$login' and respondido=0"));

if ($enviarmsgg==null || $mensagem==null || $nome==null)
{
	echo"<center><bR><font size=3 color=$font_color1>Campos em Branco!!</font></b>";
}
elseif ($nivel_gm<=0) 
{
	echo"<center><bR><font size=3 color=$font_color1>Esse pergonagem não faz parte da staff!</font></b>";
} 
elseif ("$login" == "$loginmsg") 
{
	echo"<center><bR><font size=3 color=$font_color1>Você não pode enviar mensagem para você mesmo!</font></b>";
} 
//elseif ($msg_check>10) {
//Echo"<center><bR><font size=3 color=$font_color1>Você não pode enviar várias mensagens para a staff, aguarde a resposta.</font></b>";} 

else 
{
	mssql_query("INSERT INTO mk_mensagens (login,msg,login_r) values ('$loginmsg','$mensagem','$login')");
	echo "<center><bR><font size=3 color=green>Mensagem enviada com Sucesso!!</font>";
}
}


echo "<Br><BR><center><table border='0' cellspacing='0' cellpadding='0' width=650>

  <thead>
	<tr>	
		<th colspan=3>Mensagem para a Administração</th>
	</tr>
  </thead>
";

echo "
<form name='form1' method='post' action='?enviarmsgg=ok'>
  <tr style='background:transparent;'>
    <td><Br><font size=2><b>Enviar para<br></b>
<select name='nome' id='nome_help'>
<option value=0>Escolha o destinatário</option>
";

$query = mssql_query("SELECT name,nivel_gm FROM Character WHERE nivel_gm>0 and nivel_gm<=5 order by nivel_gm desc");
$xex = mssql_num_rows($query);

for($i=0;$i < $xex;++$i)
{
$username_get = mssql_fetch_row( $query );

if (!$adm){
if ($username_get[1]==5){
$adm = "<option value='0'>- - - ADMINISTRADORES - - - </option>";
echo $adm;}
}

if (!$subadm){
if ($username_get[1]==4){
$subadm = "<option value='0'>- - - - SUB-ADMS- - - - </option>";
echo $subadm;}
}
if (!$gm){
if ($username_get[1]==3){
$gm = "   <option value='0'>- - - - - - - -  GMS - - - - - - -  </option>";
echo $gm;}
}
if (!$subgm){
if ($username_get[1]==2){
$subgm= " <option value='0'>- - - - - - - SUB-GMS - - - - </option>";
echo $subgm;}
}
if (!$aju){
if ($username_get[1]==1){
$aju= "<option value='0'>- - - - - - Ajudantes - - - - - -  </option>";
echo $aju;}
}

echo "<option value='$username_get[0]'> $username_get[0] </option>";}

echo "
</select>

    </td>
  </tr>

  <tr style='background:transparent;'>
    <td><center>
	<bR><font size=2><b>Mensagem:<br>
        <textarea name='mensagem' cols='70' rows='10'></textarea><bR><bR>
        <input type='image' src='img/BT_enviar2.png' value='Enviar Mensagem'style='border:0;background:transparent;'>
    </td>
  </tr></form></table>";

?>
<br><bR>



