<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />
</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>

<BR><BR><font size=4><b>ATIVAR CONTA</font></b> <BR><BR>


  <table width="400" border="0" cellspacing="2" cellpadding="3" bordercolor=#333333>
    <tr>
      <td><font size="4">Ativação de conta - JogandoMU<br><hr></td>
    </tr>
<tr><td>
<center>
Seja bem vindo!!!
<?PHP

require("inclu/config_simples.php");

if($_GET[login]){

$login  = $_GET[login];
$codigo = $_GET[codigo];

$nome_check   = mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login'"));
$ativado_check= mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login' and mail_chek=1"));
$codigo_check = mssql_num_rows(mssql_query("Select memb___id FROM memb_info WHERE memb___id='$login' and code='$codigo'"));

if     ( $nome_check   <= 0   ) {echo "<center><font size=3 color='$font_color1'><b><br><br>Esse login não existe em nosso banco de dados.</font><bR><br>";}
elseif ( $ativado_check   > 0 ) {echo "<center><font size=3 color='$font_color1'><b><br><br>Essa conta já foi ativada.</font><bR><br>";}
elseif ( empty($login)        ) {echo "<center><font size=3 color='$font_color1'><b><br><br>Campos em branco.</font><bR><br>";}
elseif ( $codigo   <= 0       ) {echo "<center><font size=3 color='$font_color1'><b><br><br>Código incorreto.</font><br><br>";}
elseif ( $codigo_check <= 0   ) {echo "<center><font size=3 color='$font_color1'><b><br><br>Código incorreto.</font><br><br>";}

else {

mssql_query("UPDATE memb_info SET bloc_code=0,code=0,mail_chek=1 where memb___id='$login' and code='$codigo'");

mssql_query("UPDATE memb_info SET Accountlevel=1,accountexpiredate = (getdate()+15) where memb___id = '$login'");

Echo "<center><font size=3 color='$font_color2'><b><br><br>Conta Ativada com sucesso.<br> Você pode jogar quando quiser. <br><br>Bom jogo!!<br><br>$CONFIG_SITE<br></font><br><br>";
}
}

?>

</td></tr></table>
