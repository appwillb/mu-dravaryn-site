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
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> DIVULGAR JOGANDO MU <bR><BR></font></b>

<?
require("inclu/config.php");
require("inclu/cookie.php");

$envia = $_GET[envia];

if($envia==banir){

$name 		= stripslashes($_POST['char']);
$reason 	= stripslashes($_POST['reason']);

$link_check = mssql_num_rows(mssql_query("Select link from mk_dv where link='$reason'" ));


if ($reason == NULL or $reason=='Link de divulgação'){ 
echo "<center><font color=$font_color1><b>Coloque um link válido!</font></b><br><br>"; }

elseif ($link_check > 0){ 
echo "<center><font color=$font_color1><b>Link já utilizado!</font></b><br><br>"; }

else { 

$reason = utf8_encode($reason);

$msquery = "INSERT INTO mk_dv ( login,link ) values ('$login','$reason')";
	$msresults= mssql_query($msquery);

echo "<center><font color=$font_color2><b>Divulgação adicionada com sucesso!! <br><br>Aguarde sua validação. <br>(Pode demorar até 48hs)</b></font><br><bR><bR>";

}
}
?>

  <table width="600" border="0" cellspacing="2" cellpadding="3" style='border:0;'>
    <tr style="background:transparent;">
      <td valign="top"><div align="center">
<?

echo "<font size=2>
Nessa página você pode divulgar o jogo e ganhar créditos com isso.
<br><br>Você pode divulgar o jogo em qualquer site, forum, facebook, etc. 
<br><br>A maneira mais facil de enviar o link com a imagem da sua divulgação é ao divulgar apertar o botão Print Screen (PrntScr) do teclado e colar no site <a href='http://www.imgur.com' target='_blank'>www.imgur.com</a>. Você pode utilzar o botão Ctrl+V no site! 
<bR><Br>E depois enviar o link para nós nessa página.
<bR><Br><b>Aceitamos qualquer link de imagem, mesmo sendo de outros sites, e também qualquer tipo de divulgação, vamos analisar os links e adicionar o créditos na sua conta!</b>.
<form name='form1' method='post' action='?envia=banir'>
<br><br><input name='reason' type='text' id='reason' maxlength='70' value='Link de divulgação' style='text-align:center;width:400' onClick=\"this.select();\";> 
<br><br><input type='submit' name='Submit' value='Continuar'> 
</form>
";

?>

 </div></td>
    </tr>
  </table><bR><Br>


          <table width="600" border="0" cellspacing="0" cellpadding="0" class="FondoModulo">
	<thead>
	    <tr>
		<th colspan=5>Divulgações realizadas</th>
	    </tr>
                  <tr>
                    <th width="26">#</td>
                    <th width="300">Link:</td>
                    <th width="80">Créditos:</td>
                    <th width="91">Situação:</td>
                    <th width="80">Data:</td>
                    </tr>
	</thead>
                  <?
				  
			
$query=mssql_query("select link,valor,CONVERT(VARCHAR(19),data,120) as data, invalida from mk_dv where login = '$login'");
while($row=mssql_fetch_row($query)){
$link  	=$row[0];
$valor 	=$row[1];
$data 	=$row[2];
$inv 	=$row[3];

$data = date_format(date_create("$data"), 'd-m-Y');

if ($valor > 0)
	{
		$situacao = '<font color=green>Confirmado';
	}
else 	
	{
		$situacao = '<font color=blue>Pendente';
	}

if ($inv == 1)
	{
		$situacao = '<font color=red>Inválido';
	}


?>
		<tr>
                    <td><?=++$countAli;?></td>
                    <td style='text-align:left;'><?=$link?></td>
                    <td><?=$valor?></td>
                    <td><?=$situacao?></td>
                    <td><?=$data?></td>
		     </tr>
                    <? } ?>
                </table><br><Br>


          <table width="600" border="0" cellspacing="1" cellpadding="1" class="FondoModulo">
	<thead>
	    <tr>
		<th colspan=3>Tipos de divulgação</th>
	    </tr>
                  <tr>
                    <th width="300">Descrição:</td>
                    <th width="80">Créditos:</td>
                    <th width="91">Limite:</td>
                   </tr>
	</thead>

		<tr>
                    <td style='text-align:left;'>Votar no jogando MU (válido uma vez por dia)</td>
                    <td>2</td>
                    <td>*</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Foruns</td>
                    <td>2</td>
                    <td>*</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Foruns de outros Servidores de mu</td>
                    <td>3</td>
                    <td>*</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Divulgar no /post em outros serviores</td>
                    <td>5</td>
                    <td>*</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Postar link do site do jogando Mu em qualquer lugar no facebook (www.jogandoMu.com.br)</td>
                    <td>1</td>
                    <td>10</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Postar texto de DV na sua linha do tempo facebook</td>
                    <td>2</td>
                    <td>1</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Postar texto de DV em páginas de outros servidores de MU</td>
                    <td>2</td>
                    <td>*</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Compartilhar uma publicação do JM e marcar 10 amigos</td>
                    <td>10</td>
                    <td>3</td>
		</tr>

		<tr>
                    <td style='text-align:left;'>Postar alguma imagem do jogandoMU na sua linha do tempo (perfil publico)</td>
                    <td>15</td>
                    <td>1</td>
		</tr>
</table>

</div>
