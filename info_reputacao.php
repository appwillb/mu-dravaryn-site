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

<Br><BR><font size=3><b>INFO REPUTAÇÂO</b></font><Br><BR>

<?PHP
include("inclu/config_simples.php");


$name = $_GET['name'];

$row = mssql_fetch_row(mssql_query( "SELECT top 1 accountid from character where name = '$name' order by resetcount,clevel desc" ));

$result2 = mssql_query( "SELECT top 20 comentario,login,reputacao from mk_reputacao where login_r = '$row[0]' order by id desc" );

$xex = mssql_num_rows($result2);

if ($xex>20){
$xex = 20;}

$positiva = mssql_num_rows( mssql_query( "SELECT comentario,login from mk_reputacao where login_r = '$row[0]' and reputacao = 'P' order by id desc" ));
$negativa = mssql_num_rows( mssql_query( "SELECT comentario,login from mk_reputacao where login_r = '$row[0]' and reputacao = 'N' order by id desc" ));

?>

<table border = 0 align=center width=350 cellspacing=0>

  <thead>
	<tr>	
		<th colspan=2>Personagem <?=$name;?></th>
	</tr>
  </thead>

<tr style="background:transparent;"><td valign=top><center>

<img src=img/more.png><br><? echo $positiva; ?> votos(s)

<td valign=top><center>
<img src=img/minus.png><br><? echo $negativa; ?> votos(s)

</td></tr></table><br><br>

<table border = 0  width=500 cellspacing=0 align=center>

  <thead>
	<tr>	
		<th colspan=3>Ultima recebidas</th>
	</tr>
  </thead>


<?

for($i=0;$i < $xex;++$i)
{
$row2 = mssql_fetch_row($result2);

$query3 = "SELECT name from character where accountid = '$row2[1]' order by resetcount desc,clevel desc";
$result3 = mssql_query( $query3 );
$row3 = mssql_fetch_row($result3);

$imagem = "";
if ($row2[2] == "P" ){ $imagem = "<img src=painel/img/add.gif height=15>"; }
if ($row2[2] == "N" ){ $imagem = "<img src=painel/img/Minus_Icon.png height=15>"; }

$row2[0]= utf8_decode($row2[0]);

echo" <tr valign=top height=20>
  <td width=20>$imagem</td>
  <td width=70><b>$row3[0]</td>
  <td>$row2[0]
  </td>
 </tr>";
}

?>

</table>
</div>