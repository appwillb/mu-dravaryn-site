<?
require("config.php");
require("cookie.php");

if ($_POST['atualiza']) {
$mail_check= mssql_num_rows(mssql_query("Select memb___id FROM MEMB_INFO WHERE memb___id='$login' and memb__pwd = '$psw' and mail_ok=1"));

$mail1 = $_POST['mail1'];
$mail2 = $_POST['mail2'];

if       (empty($mail1) or empty($mail2))       { echo "<center><br><br><font color=orange size=3>Campos em branco </font><br><BR>"; }
else if  ($mail1 <> $mail2)                     { echo "<center><br><bR><font color=orange size=3>E-mail diferente do e-mail de confirmação!</font><br><BR>"; } 
else if  ($mail_check > 0)                      { echo "<center><br><bR><font color=orange size=3>O E-mail dessa conta já foi atualizado!</font><br><BR>"; } 

else { $query = mssql_query( "Update memb_info set mail_addr='$mail1', mail_ok=1 where memb___id='$login' and memb__pwd = '$psw'" ); 
$die = "1";

}

}

if (!$die) {
echo "
<br><Br>
<center><font color=orange size=4>Atualizar e-mail de cadastro:</font><br><br>

Pedimos a todos que coloquem um e-mail de cadastro válido em sua conta,
<br> não devolveremos mais senhas para pessoas que não estão com seu e-mail de cadastro em dia.

<br><BR>O novo sistema do MK devolve a senha por e-mail automaticamente,
<br> se você perder a senha você poderá recuperar no mesmo momento em que perdeu ou esqueceu.

<br><br>Vendas de contas não são proibidas mais não nos responsabilizamos se você perder a conta.

<br><br><font color=orange>Não aceitaremos reclamações posteriores.</font>

<br><bR>Seu e-mail de cadastro atual é: <font color=orange>$mail</font>

<br><bR>Se o e-mail estiver correto apenas digite o mesmo novamente.</font>

<br><bR>
		<table border=1 align=center cellspacing=2 cellpadding=3 bordercolor=#333333>
		<tr><td width='300' align='center' style='border: 1px solid #000000;'>
		
                </td></tr><tr><td style='border: 1px solid #000000;'>			
		<form name='form1' method='post' action=''>
          <table width='100%' border='0' cellspacing='0' cellpadding='0'>
            <tr> 
              <td width='100' height=22 align=right style='border: 1px solid #000000;'>E-mail:</td>
              <td style='border: 1px solid #000000;'><input name='mail1' type='text' id='login' maxLength=50></td></tr>
            <tr> 
              <td height=22 align=right style='border: 1px solid #000000;'>Confirmar E-mail:</td>
              <td style='border: 1px solid #000000;'><input name='mail2' type='text' id='login' maxLength=50>
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