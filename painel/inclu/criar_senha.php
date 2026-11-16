<script type="text/javascript">
    function numbers(evt)
    {
        var key_code = evt.keyCode  ? evt.keyCode  :
                       evt.charCode ? evt.charCode :
                       evt.which    ? evt.which    : void 0;


        // Habilita teclas <DEL>, <TAB>, <ENTER>, <ESC> e <BACKSPACE>
        if (key_code == 8  ||  key_code == 9  ||  key_code == 13  ||  key_code == 27  ||  key_code == 46)
        {
            return true;
        }

        // Habilita teclas <HOME>, <END>, mais as quatros setas de navegação (cima, baixo, direta, esquerda)
        else if ((key_code >= 35)  &&  (key_code <= 40))
        {
            return true
        }

        // Habilita números de 0 a 9
        else if ((key_code >= 48)  &&  (key_code <= 57))
        {
            return true
        }

        return false;
    }
</script>
<?
require("config.php");
require("cookie.php");

if ($_POST['atualiza']) {
$senha_check= mssql_num_rows(mssql_query("select senha from guild where g_name='$_GET[guild_name]' and senha>1"));

$senha1 = $_POST['senha1'];
$senha2 = $_POST['senha2'];

if       (empty($senha1) or empty($senha2))	{ echo "<center><br><br><font color=orange size=3>Campos em branco </font><br><BR>"; }
elseif   (!ereg("(^[0-9])",$senha1) or !ereg("(^[0-9])",$senha2))		{echo "<center><font size=2 color='orange'><br><br>Somente números por favor.</font><br><br>";}
elseif   ( strlen($senha1) != 4 or  strlen($senha2) != 4 )                      {echo "<center><font size=2 color='orange'><br><br>A senha deve conter 4 dígitos.</font><br><br>"; }
elseif   ($senha_check > 0)                     { echo "<center><br><bR><font color=orange size=3>Senha Já cadastrada!</font><br><BR>"; } 
elseif   ($senha1 <> $senha2)                   { echo "<center><br><bR><font color=orange size=3>Senha diferente da senha de confirmação!</font><br><BR>"; } 

else { $query = mssql_query( "Update guild set senha='$senha1' where login='$login' and g_name = '$_GET[nome_guild]'" ); 
$die = "1";

}

}

if (!$die) {
echo "
<br><Br>
<center><font color=orange size=4>Criar uma senha de guild:</font><br><br>

Pedimos que você crie uma senha de segurança para sua guild,
<br> essa senha deve ser numérica com 4 dígitos.

<br><BR>Essa senha será solicitada quando
<br> você precisar excluir alguém da sua guild ou excluir a própria guild.

<br><br>Poderá ser solicitada também em outras ocasiões.

<br><br><font color=orange>Guarde bem sua senha e não passe para ninguém.</font>

<br><bR>
		<table border=1 align=center cellspacing=2 cellpadding=3 bordercolor=#333333>
		<tr><td width='300' align='center' style='border: 1px solid #000000;'>
		
                </td></tr><tr><td style='border: 1px solid #000000;'>			
		<form name='form1' method='post' action=''>
          <table width='100%' border='0' cellspacing='0' cellpadding='0'>
            <tr> 
              <td width='100' height=22 align=right style='border: 1px solid #000000;'>Senha:</td>
              <td style='border: 1px solid #000000;'><input name='senha1' type='text' id='login' maxLength=4 onkeypress=\"javascript: return numbers(event);\"></td></tr>
            <tr> 
              <td height=22 align=right style='border: 1px solid #000000;'>Confirmar Senha:</td>
              <td style='border: 1px solid #000000;'><input name='senha2' type='text' id='login' value='' maxLength=4 onkeypress=\"javascript: return numbers(event);\">
              <input type='hidden' name='atualiza' id='atualiza' value='ok'></td></tr>
            </tr>
            <tr> 
              <td colspan=2 style='border: 1px solid #000000;'><br><center><input type='submit' name='Submit' value='Continuar'></td>
            </tr>
          </table>
        </form>";


die();
}
?>