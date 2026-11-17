<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

<style>

	table {
    	border: 1px solid #000;
    	font-family: Verdana,sans-serif;
    	font-size: 12px;
    	margin: 10px auto;
	}

	th, td {
    	padding: 5px;
    	text-align: center;
	height:32px;
	}

	thead tr:nth-child(1) {
    	background: #02273b;
    	color: #fff;
	}

	tbody tr:hover {
    	background: rgba(135,206,270,.2);
    	//cursor: pointer;
	}

	tr:nth-child(even) {
    	background: #eee;
	}

	td:nth-child(4), td:nth-child(7) {
    	text-align: left;
	}

</style>

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<center><bR><BR><font size=3><b> NOTÍCIAS DO JOGO<bR><BR>

<?
require("inclu/config.php");
?>

<table border='0' cellspacing='0' cellpadding='0' width="700">

<?

$sql_check = mssql_query("SELECT nome,valor,tipo,CONVERT(VARCHAR(19),data,120) as data,valor2 FROM mk_murkut_news order by id_news desc");

for($i=0;$i < 30;++$i)
{
$username_get = mssql_fetch_row( $sql_check );
$char  = $username_get[0];
$valor = $username_get[1];
$tipo  = $username_get[2];
$data  = $username_get[3];
$valor2= $username_get[4];

$data = date_create("$data");
$data = date_format($data, 'd-m-Y H:i');

if ($i % 2==0){
$color= "#BEBEBE";
} else {
$color= "#cccccc"; }


if ($tipo==1){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/add2.png width=20> Um novo Personagem foi <font color=green>criado</font> no MU Dravaryn, seu nome é <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><b>$char</b>.</a>
	</td>
      </tr>";}

if ($tipo==2){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/2.png width=20> O Personagem <b>$char</b> foi <font color=red>excluído</font> do MU Dravaryn.
	
	</td>
      </tr>";}

if ($tipo==3){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/teste.png width=20 height=20> <font color=$font_color2>O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><b>$char</b></a> venceu um evento realizado por <a href='../info_char_pop.php?server=$server&painel=ok&name=$valor'><b>$valor</b></font></a>.
	
	</td>
      </tr>";}

if ($tipo==4){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/billiards-forum.png width=20> O Personagem <b>$char</b> mudou o nome para <a href='../info_char_pop.php?server=$server&painel=ok&name=$valor'><b>$valor</b></a>.
	
	</td>
      </tr>";}

if ($tipo==5){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/abuso.png width=20> <font color=$font_color1>O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><b>$char</b></a> foi banido por <a href='../info_char_pop.php?server=$server&painel=ok&name=$valor'><b>$valor</b></a>. Motivo: $valor2.
	
	</td>
      </tr>";}

if ($tipo==6){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/ico_trocarUf.png width=20> O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><b>$char</b></a> mudou de classe, agora sua classe é <b>$valor</b>.
	</td>
      </tr>";}

if ($tipo==7){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/i_sell.gif width=20> Novo personagem no Mercadão, ele se chama <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><font color=orange>$char</font></a> e seu passe inicial é de <font color=orange>$valor</font> golds.
	</td>
      </tr>";}

if ($tipo==8){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/i_sell.gif width=20> O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><font color=orange>$char</font></a> criou uma nova guild chamada <a href='../info_guild.php?modelist=$guild'> <font color=orange>$guild</font></a>.
	</td>
      </tr>";}

if ($tipo==9){
echo "<tr bgcolor=$color height=25>
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/i_sell.gif width=20> O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><font color=orange>$char</font></a> deletou a guild <a href='../info_guild.php?modelist=$guild'> <font color=orange>$guild</font></a>.
	</td>
      </tr>";}

if ($tipo==10){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/i_sell.gif width=20> O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><font color=orange>$char</font></a> rescindiu contrato com a guild <a href='../info_guild.php?modelist=$guild'> <font color=orange>$guild</font></a>.
	</td>
      </tr>";}

if ($tipo==12){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/skull.gif width=20> A Guild <a href='../info_guild.php?modelist=$valor'> <b>$valor</b></font></a> venceu a guild <a href='../info_guild.php?modelist=$valor2'> <b>$valor2</b></font></a> em um partida realizada por <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><b>$char</b></a>.
	</td>
      </tr>";}

if ($tipo==13){
echo "<tr bgcolor=$color height=25>
	
	<td width=120><B>$data </td>
	<td style='text-align:left;'><img src=img/ico_trocarUf.png width=20> <font color=green>O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><font color=#8B0000><b>$char</b></font></a> foi transferido de conta.
	
	</td>
      </tr>";}

if ($tipo==14){
echo "<tr bgcolor=$color height=30>
	<td width=120><b>$data </td>
	<td style='text-align:left;'> <img src=img/skull.gif height=20 style=\"padding-bottom: 4px; vertical-align: middle;\"> <font color=green> O Personagem <a href='../info_char_pop.php?server=$server&painel=ok&name=$char'><font color=#696969><b>$char</b></font></a> conquistou o castelo no rei do MU.
	
	</td>
      </tr>";}




}
?>
</table>

</td>
    </tr>
  </table>
      </div>

</div></div>
