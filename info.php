<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />

        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>

<BR><BR><font size=3><b>INFORMAÇÕES SOBRE O SERVIDOR</font></b> <BR><BR>

<?
include("inclu/config_simples.php");

$dados_server = mssql_fetch_row(mssql_query("SELECT * from dbo.fn_info_adm()"));


$server_on 	= $dados_server[0];
$acr2 		= $dados_server[1];
$acr3 		= $dados_server[2];
$acr4 		= $dados_server[3];
$acr5 		= $dados_server[4];
$acr6 		= $dados_server[5];
$acr7 		= $dados_server[6];
$acr8 		= $dados_server[7];
$acr9 		= $dados_server[8];
$acr10 		= $dados_server[9];
$acr11 		= $dados_server[10];
$acr12 		= $dados_server[11];
?>


<table border = 0 cellpadding='0' cellspacing='2' width=600>



	<tr>
		<td style='text-align:left;border-top-left-radius: 7px;' class='bgtr'>&nbsp;&nbsp;<b>Versão</b></td>
		<td style='text-align:left;'>Ex803</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Contas</b></td>
		<td style='text-align:left;'><?=$acr2;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Shopping</b></td>
		<td style='text-align:left;'>IN-GAME</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Contas VIP</b></td>
		<td style='text-align:left;'><?=$acr7;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Exp VIP</b></td>
		<td style='text-align:left;'>1000x</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Personagens</b></td>
		<td style='text-align:left;'><?=$acr3;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Exp FREE</b></td>
		<td style='text-align:left;'>900x</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<a href=online.php><b><u><font color=white>Online</u></b></a></td>
		<td style='text-align:left;'><?=$server_on;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Max Level</b></td>
		<td style='text-align:left;'>400(+330 M.Level)</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Recorde Online</b></td>
		<td style='text-align:left;'><?=$acr12;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Max Status</b></td>
		<td style='text-align:left;'>64.900</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<a href=banidos.php><b><u><font color=white>Banidos</u></a></b></td>
		<td style='text-align:left;'><?=$acr4;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Bug Bless</b></td>
		<td style='text-align:left;'>OFF</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Contas Bloc</b></td>
		<td style='text-align:left;'><?=$acr9;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Tipo Reset</b></td>
		<td style='text-align:left;'>Acumulativo</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Adms Online</b></td>
		<td style='text-align:left;'><?=$acr10;?>/<?=$acr11;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Level Reset</b></td>
		<td style='text-align:left;'>400</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Gms Online</b></td>
		<td style='text-align:left;'><?=$acr5;?>/<?=$acr6;?></td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>M.Reset Level</b></td>
		<td style='text-align:left;'>400</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Chaos Mix</b></td>
		<td style='text-align:left;'>100%</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Ativa M.Reset</b></td>
		<td style='text-align:left;'>300 resets</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Pentagram Mix</b></td>
		<td style='text-align:left;'>100%</td>
	</tr>

	<tr>
		<td style='text-align:left;border-bottom-left-radius: 7px;' class='bgtr'>&nbsp;&nbsp;<b>Item Drop</b></td>
		<td style='text-align:left;'>85%</td>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>Divulgações</b></td>
		<td style='text-align:left;'><?=$acr8;?></td>
	</tr>

</table>

<?
require 'eventos.php';

require 'comandos.php';
?>

<BR><BR><font size=3><b>CLASSES DISPONÍVEIS</font></b> <BR><BR>

<table border = 0 cellpadding='0' cellspacing='0'>
	<tr style='padding: 2px;'>
		<td style='padding: 2px;'><img src=img/dw.jpg></td>
		<td style='padding: 2px;'><img src=img/dk.jpg></td>
		<td style='padding: 2px;'><img src=img/elf.jpg></td>
		<td style='padding: 2px;'><img src=img/mg.jpg></td>
		<td style='padding: 2px;'><img src=img/dl.jpg></td>
		<td style='padding: 2px;'><img src=img/sum.jpg></td>
		<td style='padding: 2px;'><img src=img/rf.jpg></td>
	</tr>
</table>

</div>