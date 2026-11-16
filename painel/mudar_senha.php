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

<center><bR><BR><font size=3><b> MUDAR SENHA <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET['changepass']=='ok') {

$pass = stripslashes($_COOKIE['pass']);
$oldpwd = stripslashes($_POST['oldpwd']);
$newpwd = stripslashes($_POST['newpwd']);
$newpwd2 = stripslashes($_POST['newpwd2']);

$count = substr_count($newpwd," ");
	
$sql_username_check = mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login'"); 
$username_check = mssql_num_rows($sql_username_check); 

$sql_pw_check = mssql_query("SELECT memb__pwd FROM MEMB_INFO WHERE memb__pwd='$oldpwd' and memb___id='$login'"); 
$pw_check = mssql_num_rows($sql_pw_check);

include("inclu/erro.php");

if (empty($newpwd) || empty($oldpwd) || empty($newpwd2)) {
    echo "$CONFIG_paginas_inicio2 Campos Em Branco. $CONFIG_erro_fim <br><BR>";}

elseif ($username_check <= 0){ 
        echo "$CONFIG_paginas_inicio2 Seu login não foi encontrado no banco de dados. Por Favor Volte e Tente Novamente. $CONFIG_erro_fim <br><BR>"; }

elseif ($count > 0){ 
        echo "$CONFIG_paginas_inicio2 Você não pode colocar espaço na sua senha!! $CONFIG_erro_fim <br><BR>";} 
  
elseif ($pw_check <= 0){ 
        echo "$CONFIG_paginas_inicio2 Sua antiga senha está incorreta. $CONFIG_erro_fim <br><BR>"; }

elseif ($newpwd <> $newpwd2){ 
        echo "$CONFIG_paginas_inicio2 A senha e a confirmação estão diferentes. $CONFIG_erro_fim <br><BR>"; }


else {	
$sql = mssql_query("UPDATE dbo.MEMB_INFO SET memb__pwd = '$newpwd' WHERE memb___id = '$login'");
$sql = mssql_query("DELETE FROM mk_MUDAR_MAIL where  login = '$login'");

$MESSAGE_TIPO = 6;
include("inclu/erro.php");

echo "$CONFIG_paginas_inicio2 A senha da sua conta foi alterada com sucesso.<br>";
echo "Por favor saia e entre novamente para que as alterações funcionem corretamente. $CONFIG_erro_fim <br><BR>";

$ip2 = $_SERVER["REMOTE_ADDR"];

$msresults= mssql_query("INSERT INTO LOG_senha_m ( login,antiga,ip ) values ('$login','$oldpwd','$ip2')");


}}

echo $_COOKIE["login"];
$logined = $_COOKIE["login"];

echo "<form name='form1' method='post' action='?changepass=ok'>
          <table width='600' border='0' cellspacing='0' cellpadding='0'>

  <thead>
	<tr>	
		<th colspan=3>Preencha os campos abaixo</th>
	</tr>
  </thead>
          
            <tr>
              <td height='18'>
                <center>Senha antiga:</font>
              </td>
              <td><center><input class=input03 name='oldpwd' type='password' id='newpwd' maxlength='10'></td>
       	      </tr>
            <tr>
              <td height='18'>
                <center>Nova Senha:
              </td>
              <td>
                  <center><input class=input03 name='newpwd' type='password' id='newpwd' maxlength='10'></td>
       	      </tr>
            <tr>
              <td height='18'>
                <center>Confirmar Senha:</font>
              </td>
              <td>
                  <center><input class=input03 name='newpwd2' type='password' id='newpwd' maxlength='10'></td>
       	      </tr>
           <tr> 
              <td colspan=2><center><BR><input type='image' src='img/BT_salvar.png' name='Submit' value='Mudar Senha' style='border:0;background:transparent;'>
              </td>
            </tr>
          </table>
      </form>
</div>

";


?>

