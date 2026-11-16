<head>
  <link type="text/css" rel="stylesheet" href="../css/paginas.css">

        <script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(1300);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>
</head>
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">
<br><Br><font size=3><b>LOG MUDAR NOME</font></b><br><br>

<?PHP
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 4;
require("../inclu/verif_nivel_gm.php");


$remover_tudo   = $_GET[remover_tudo];

if($remover_tudo==ok){

	mssql_query("delete from log_nome");
	echo "<center><font color=$font_color2>Log Limpo<br><bR><bR>";

}

$query_pe = "select login,novo,antigo,ip,CONVERT(VARCHAR(19),data,120) as data from log_nome order by data desc, ip desc";
$result_pe = mssql_query( $query_pe );

$waw = mssql_query("select count(*) from log_nome");

echo '<body>';
echo '<font face=Arial>';
echo '<center><table border=0 cellSpacing=0 align=center width=80%>';
echo "<thead><tr>
<th><b>Login</th>
<th class='bgtr'><b>Nick antigo</th>
<th class='bgtr'><b>Nick novo</th>
<th class='bgtr'><b>Ip</th>
<th><b>Data</th></tr></thead>";


$serial=$row_s[0];

$xex = mssql_result($waw, 0, 0);

echo ($xex <= 0) ? "<tr><td colspan=5>Nenhum resultado!</td></tr>":"";

for($i=0;$i < $xex;++$i)
{
$row_mail = mssql_fetch_row($result_pe);


$login_nick   =    $row_mail[0];
$novo_nick    =    $row_mail[1];
$antigo_nick  =    $row_mail[2];
$ip_nick      =    $row_mail[3];
$data_nick    =    $row_mail[4];

$data_nick = date_create("$data_nick");
$data_nick = date_format($data_nick, 'd-m-Y H:i');

echo "<tr>";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$login_nick>$login_nick</a>";
echo '</td><td>';
echo "$antigo_nick";
echo '</td><td>';
echo "$novo_nick";
echo '</td><td>';
echo "$ip_nick";
echo '</td><td>';
echo "$data_nick";
echo '</td></tr>';


}

echo "</table>";

$pagina = $_GET[pagina]; 

echo "<a href=?pagina=$pagina&remover_tudo=ok><br><bR><center><font size=3><b>Limpar Log</a><bR><bR>";


?>
</div>
