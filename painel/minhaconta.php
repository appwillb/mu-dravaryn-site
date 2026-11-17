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



<center><bR><BR><font size=3><b> MINHA CONTA <bR><BR>



<?

require("inclu/config.php");

require("inclu/cookie.php");





	if ($_GET[salvar]) 

		{

			$nome = utf8_encode($_POST['nome']);

			$whats= $_POST['whats'];



			if(empty($nome)) 		{ echo "<font color=$font_color1><b>O campo Nome não pode ficar em branco</b></font><br><br>"; }

			elseif(strlen($nome)  >20) 	{ echo "<font color=$font_color1><b>O campo Nome não pode ter de 20 caracteres</b></font><br><br>"; }

			elseif(strlen($whats) >15)	{ echo "<font color=$font_color1><b>O campo Whatsapp não pode ter de 15 caracteres</b></font><br><br>"; }

			else 

				{

					mssql_query("UPDATE MEMB_INFO SET memb_name='$nome', whatsapp = '$whats' where memb___id='$login'");



						if(empty($whats) || strlen($whats) < 10) { mssql_query("UPDATE MEMB_INFO SET whatsapp = null where memb___id='$login'"); }



					echo "<font color=$font_color2><b>Salvo com sucesso!</b></font><br><br>";

				}

		}





$query12 = "select 

ConnectStat,

tempo,

CONVERT(VARCHAR(19),connecttm,120) as data,

memb_info.mail_addr,

memb_info.memb_name,

memb_info.bloc_code,

memb_info.whatsapp,

convert(NVARCHAR, appl_days, 106) as data

from

memb_stat,memb_info

where

memb_info.memb___id='$login' 

memb_stat.memb___id=MEMB_INFO.memb___id COLLATE database_default";

$result12 = mssql_query( $query12 );

$row = mssql_fetch_row($result12);



$min     = $row[1];

$ultima   = $row[2];

$mail     = $row[3];

$memb_name= utf8_decode($row[4]);

$whatsapp = $row[6];

$criada   = $row[7];



include '../inclu/tempo.php';



$result = mssql_query( "select gameidc from accountcharacter where id='$login'" );

$row_c = mssql_fetch_row($result);



$ultima = date_create("$ultima");

$ultima = date_format($ultima, 'd-m-Y H:i');



$gameidc  = $row_c[0];



if ($row[0] == 1) $status = '<font color=green size=2><b> Online    </font>';

if ($row[0] == 0) $status = '<font color=red size=2><b>Offline  </font>';

if ($row[5] == 1) $status = "<font color=red><b>Bloqueado</font>";



Echo "







<form name='form_conta' method='post' action='?salvar=ok'>

<table width='650' border='0' cellpadding='3' cellspacing='0'>

  <thead>
	<tr>	
		<th colspan=2>Editar informações</th>
	</tr>
  </thead>



  <tr>

    <td width='150' align=right><font size=2><b>Seu nome:</b> </td>

    <td><font size=2><input name='nome' type='text' id='nome' maxlength='20' value='$memb_name' style='text-align:center;width:300px'>  </td>

  </tr>



  <tr>

    <td width='150' align=right><font size=2><b>Whatsapp:</b> </td>

    <td><font size=2><input name='whats' type='text' id='whats' maxlength='15' value='$whatsapp' onkeypress=\"mascara( this, mtel );\" style='text-align:center;width:300px'>  </td>

  </tr>



  <tr>

    <td width='150' align=center colspan=2><font size=2><b><input type='image' src='img/BT_salvar.png' name='Submit' value='Mudar Senha' style='border:0;background:transparent;'></b><br> </td>

  </tr>

</table></form>

<table width='650' border='0' cellpadding='3' cellspacing='0'>
  <thead>
	<tr>	
		<th colspan=3>Informações gerais</th>
	</tr>
  </thead>



  <tr>

    <td width='150' align=right><font size=2><b>Conta:</b> </td>

    <td style='text-align:left;'><font size=2>$login  </td>

  </tr>



  <tr>

    <td align=right><font size=2><b>E-mail:</b>  </td>

    <td style='text-align:left;'><font size=2>$mail <a href=mudar_mail.php>( Mudar )</font>  </a></td>

  </tr>



  <tr>

    <td align=right><font size=2><b> Status:</td>

    <td style='text-align:left;'> $status</td>

  </tr>



  <tr>

    <td align=right><font size=2><b>Ultimo char usado: 

    <td style='text-align:left;'>$gameidc</font></td>

  </tr>



  <tr>

    <td align=right><font size=2><b>Tempo Online(Mês): 

    <td style='text-align:left;'> $H3 hs $m mins</font> </td>

  </tr>



  <tr>

    <td align=right><font size=2><B>Ultima Conexão: </td>

    <td style='text-align:left;'> $ultima</font> </td>

  </tr>



  <tr>

    <td align=right><font size=2><B>Criada: </td>

    <td style='text-align:left;'> $criada</font> </td>

  </tr>



</table><br>";



Echo "



<table width='650' cellspacing='0'>

  <thead>
	<tr>	
		<th colspan=3>Segurança</th>
	</tr>
  </thead>

<tr style='background:transparent;'><td valign=top>



<table width='310' border='0' cellpadding='3' cellspacing='0'>

  <thead>
	<tr>	
		<th colspan=3>Últimos Acessos ao painel<br>(Acesso bem sucedido)</th>
	</tr>
  </thead>



";



$query = mssql_query("select top 15 CONVERT(VARCHAR(19),data,120) as data, ip from log_painel where login='$login' order by data desc");

$num   = mssql_num_rows($query);



for($i=0;$i < $num;++$i)

{

$dados = mssql_fetch_row($query);



$data = date_create("$dados[0]");

$data = date_format($data, 'd-m-Y H:i');



echo "<tr>

    <td align=right>$data</td>

    <td style='text-align:left;'><b>IP:</b> $dados[1]</b> </td>

  </tr>";

}



Echo "</table>



</td><td valign=top>



<table width='310' border='0' cellpadding='3' cellspacing='0'>

  <thead>
	<tr>	
		<th colspan=3>Acessos negados ao painel:</b><br>(Senha Incorreta)</th>
	</tr>
  </thead>

";



$query = mssql_query("select top 15 CONVERT(VARCHAR(19),data,120) as data, ip from log_acesso_n where login='$login' order by data desc");

$num   = mssql_num_rows($query);





if($num == 0) {



Echo "

  <tr>

    <td align=center colspan=2><font size=2><b>Nenhum resultado</b></td>

  </tr>

</table></table>

";



} else {



for($i=0;$i < $num;++$i)

{

$dados = mssql_fetch_row($query);



$data = date_create("$dados[0]");

$data = date_format($data, 'd-m-Y H:i');



echo "<tr>

    <td align=right>$data</td>

    <td style='text-align:left;'><b>IP:</b> $dados[1]</b> </td>

  </tr>";

}



Echo "

</td>

  </tr></table></table>

"; 



}



?>



<script type="text/javascript">

/* Máscaras ER */

function mascara(o,f){

    v_obj=o

    v_fun=f

    setTimeout("execmascara()",1)

}

function execmascara(){

    v_obj.value=v_fun(v_obj.value)

}

function mtel(v){

    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito

    v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos

    v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos

    return v;

}

function mascaracep(o,f){

    v_obj=o

    v_fun=f

    setTimeout("execmascaracep()",1)

}

function execmascaracep(){

    v_obj.value=v_fun(v_obj.value)

}

function mcep(v){

    v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito

    v=v.replace(/(\d)(\d{3})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos

    return v;

}

</script>