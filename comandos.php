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

<?PHP include_once("inclu/config.php"); ?>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>

<BR><BR><font size=3><b>COMANDOS IN-GAME</font></b> <BR><BR>

<table border = 0 cellpadding='0' cellspacing='2' width=600>



	<tr>
		<td style='text-align:left;width:100px;border-top-left-radius: 7px; ' class='bgtr'>&nbsp;&nbsp;<b>/post</b></td>
		<td style='text-align:left;'>Enviar mensagem no chat dentro do jogo</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/reset</b></td>
		<td style='text-align:left;'>Resetar Pesonagem (Você deve estar no level 400 para usar)</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/reset auto</b></td>
		<td style='text-align:left;'>Ao chegar no level 400 seu personagem será resetado automaticamente, digite novamente o comando para desativar.</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/mreset</b></td>
		<td style='text-align:left;'>Usar o master reset (Você deve ter 300 resets para usar)</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/f</b></td>
		<td style='text-align:left;'>Adiciona pontos em Força (exemplo: /f 500)</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/a</b></td>
		<td style='text-align:left;'>Adiciona pontos em Agilidade (exemplo: /a 500)</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/v</b></td>
		<td style='text-align:left;'>Adiciona pontos em Vitalidade (exemplo: /v 500)</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/e</b></td>
		<td style='text-align:left;'>Adiciona pontos em Energia (exemplo: /e 500)</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/pk</b></td>
		<td style='text-align:left;'>Limpar seu PK</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/bau</b></td>
		<td style='text-align:left;'>Muda o baú que você está usando (exemplo: /bau 1). Obs: Baú principal é /bau 0</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/evo</b></td>
		<td style='text-align:left;'>Evoluir personagem para ultima classe ( Utilizar 2 vezes )</td>
	</tr>

	<tr>
		<td style='text-align:left;' class='bgtr'>&nbsp;&nbsp;<b>/loja</b></td>
		<td style='text-align:left;'>	<b>/loja creditos</b> <br> Vende itens por créditos<bR><bR>
						<b>/loja golds</b> <br> Vende itens por Golds<bR><bR>
						<b>/loja mgolds</b> <br> Vende itens por Master Golds<bR><br>
						<b>Como Utilizar:</b><br> Você deve colocar o item na sua loja pessoal, ao colocar o item será solicitado o valor,
						 você deve colocar no lugar do zen o valor que deseja, exemplo 30 zen = 30 créditos, após colocar o valor você deve digitar o comando desejado, exemplo: /loja creditos</td>
	</tr>

	<tr>
		<td style='text-align:left;border-bottom-left-radius: 7px; ' class='bgtr'>&nbsp;&nbsp;<b>/offstore</b></td>
		<td style='text-align:left;'>Utilizado para deixar sua conta online, mesmo estando off, para utilizar o comando você deve abrir um Loja Pessoal de qualquer tipo e digitar o comando, você vai levar DC, feche o jogo, pronto seu personagem vai ficar online vendendo os itens que você colocou na loja. Quando entrar no jogo novamente você receberá a mensagem que sua conta está online, na segunda tentativa vai logar normalmente.</td>
	</tr>



</table>

</div>