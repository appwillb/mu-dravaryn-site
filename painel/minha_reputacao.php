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

<center><bR><BR><font size=3><b> MINHA REPUTAÇÂO <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");

$result2 = mssql_query( "SELECT comentario,login,reputacao,dbo.fn_char_forte(login) from mk_reputacao where login_r = '$login' and exists (select memb___id from memb_info where memb_info.memb___id= mk_reputacao.login_r collate database_default) order by id desc" );

$nums = mssql_num_rows( mssql_query( "SELECT comentario,login,reputacao from mk_reputacao where login_r = '$login' and exists (select memb___id from memb_info where memb_info.memb___id= mk_reputacao.login_r collate database_default)" ));

$positiva = mssql_num_rows( mssql_query( "SELECT comentario,login from mk_reputacao where login_r = '$login' and reputacao = 'P' order by id desc" ));
$negativa = mssql_num_rows( mssql_query( "SELECT comentario,login from mk_reputacao where login_r = '$login' and reputacao = 'N' order by id desc" ));

?>

<table border = 0 align=center width=350 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=2>Sua reputação</th>
	</tr>
  </thead>

	<tr style="background:transparent;">
		<td valign=top><img src=../img/more.png><font size=3><b><br><? echo $positiva; ?> votos(s)</td>
		<td valign=top><img src=../img/minus.png><br><font size=3><b><? echo $negativa; ?> votos(s)</td>
	</tr>

</table><Br><BR>


<table border = 0  width=500 cellspacing=0 align=center>

  <thead>
	<tr>	
		<th colspan=3>Reputações recebidas</th>
	</tr>
  </thead>

<?

for($i=0;$i < $nums;++$i)
{
$row2 = mssql_fetch_row($result2);

$imagem = "";
if ($row2[2] == "P" ){ $imagem = "<img src=img/add.gif height=20>"; }
if ($row2[2] == "N" ){ $imagem = "<img src=img/Minus_Icon.png height=20>"; }

$row2[0]= utf8_decode($row2[0]);

echo"
  <tr valign=top height=20>
  <td align=right width=20>$imagem</td>
  <td align=right width=70><a href='../info_char_pop.php?name=$row2[3]&painel=ok' target='main2'><b>$row2[3]</a></td>
  <td>$row2[0]  </td>
 </tr>";
}

?>
</table>
</div>
