<head>
  <link type="text/css" rel="stylesheet" href="../css/paginas.css">

        <script type="text/javascript" src="../../js/jquery-1.3.2.min.js"></script>

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

<br><Br><font size=3><b>LOGS MUDAR E-MAIL</font></b><br><br>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;
require("../inclu/verif_nivel_gm.php");

$query_pe = "select login,antigo,novo,ip,data from log_mail order by data desc";
$result_pe = mssql_query( $query_pe );

$waw = mssql_query("select count(*) from log_mail");

echo '<center><table border=0 cellSpacing=0 align=center width=95%>';
echo '
<thead>
  <tr>
	<th colspan=5> Solicitações de troca (Não significa que trocou) </th>
  </tr>
  <tr>
	<th width=100><b>Login</th>
	<th width=80><b>E-mail antigo</th>
	<th width=80><b>E-mail novo</th>
	<th width=80><b>Ip</th>
	<th width=120><b>Data</th>
</tr>';


$serial=$row_s[0];

$xex = mssql_result($waw, 0, 0);

for($i=0;$i < $xex;++$i)
{
$row_mail = mssql_fetch_row($result_pe);


$login_mail   =    $row_mail[0];
$antigo_mail  =    $row_mail[1];
$novo_mail    =    $row_mail[2];
$ip_mail      =    $row_mail[3];
$data_mail    =    date_format(date_create("$row_mail[4]"), 'd-m-Y H:i');
	
echo "<tr height=21>";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$login_mail>$login_mail</a>";
echo '</td><td>';
echo "$antigo_mail";
echo '</td><td>';
echo "$novo_mail";
echo '</td><td>';
echo "$ip_mail";
echo '</td><td>';
echo "$data_mail";
echo '</td></tr>';


}

echo '</table><br><br>';

$query_pe = "select login,antigo,novo,dias,ip,data from mk_mudar_mail order by dias desc, data desc";
$result_pe = mssql_query( $query_pe );

$waw = mssql_query("select count(*) from mk_mudar_mail");

echo '<center><table border=0 cellSpacing=0 align=center width=95%>';
echo '
<thead>
  <tr>
	<th colspan=6> Aguardando mudança de e-mail</th>
  </tr>
  <tr>
	<th width=100><b>Login</th>
	<th width=80><b>E-mail antigo</th>
	<th width=80><b>E-mail novo</th>
	<th width=40><center><b>Dias</th>
	<th width=80><b>Ip</th>
	<th width=120><b>Data</th>
</tr>';


$serial=$row_s[0];

$xex = mssql_result($waw, 0, 0);

for($i=0;$i < $xex;++$i)
{
$row_mail = mssql_fetch_row($result_pe);


$login_mail   =    $row_mail[0];
$antigo_mail  =    $row_mail[1];
$novo_mail    =    $row_mail[2];
$dias_mail    =    $row_mail[3];
$ip_mail      =    $row_mail[4];
$data_mail    =    date_format(date_create("$row_mail[5]"), 'd-m-Y H:i');
	
echo "<tr height=21>";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$login_mail>$login_mail</a>";
echo '</td><td>';
echo "$antigo_mail";
echo '</td><td>';
echo "$novo_mail";
echo '</td><td><center>';
echo "$dias_mail";
echo '</td><td>';
echo "$ip_mail";
echo '</td><td>';
echo "$data_mail";
echo '</td></tr>';


}

echo '</table>';

?>
</div>