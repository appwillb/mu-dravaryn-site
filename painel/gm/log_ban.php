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

<br><Br><font size=3><b>LOGS BANIDOS/DESBANIDOS</font></b><br><br>

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;
require("../inclu/verif_nivel_gm.php");

$result_pe = mssql_query( "select top 30 login,name,reason,gm,data as data from log_ban order by data desc" );
$num = mssql_num_rows($result_pe);

echo '<table border=0 cellSpacing=0 align=center width=800>';
echo '
<thead>
  <tr>
	<th colspan=5> Banidos </th>
  </tr>
  <tr>
	<td width=100><b>Login</td>
	<td width=100><b>Banido</td>
	<td width=300><b>Motivo</td>
	<td width=100><b>GM</td>
	<td width=150><b>Data</td>
  </tr>
</thead>';

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($result_pe);

$data = date_create("$row[4]");
$data = date_format($data, 'd-m-Y H:i');

echo "<tr height=21>";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$row[0]><font size=2>$row[0]</a>";
echo '</td><td><font size=2>';
echo "$row[1]";
echo "</td><td style='text-align:left;'><font size=2>";
echo utf8_decode($row[2]);
echo '</td><td><font size=2>';
echo "$row[3]";
echo '</td><td><font size=2>';
echo "$data";
echo '</td></tr>';


}

echo "</table><br><bR>";

$query_pe = "select login,desbanido,ip,data,id_desban from log_desban order by data desc";
$result_pe = mssql_query( $query_pe );

$waw = mssql_query("select count(*) from log_desban");

echo '<center><table border=0 cellSpacing=0 align=center width=800>';
echo '
<thead>
  <tr>
	<th colspan=4> Desbanidos </th>
  </tr>
  <tr>
	<th width=100><b>Login fez</th>
	<th width=80><b>Desbanido</th>
	<th width=100><b>Ip</th>
	<th width=100><b>Data</th>
  </tr>
</thead>';


$serial=$row_s[0];

$xex = mssql_result($waw, 0, 0);

for($i=0;$i < $xex;++$i)
{
$row_mail = mssql_fetch_row($result_pe);

$login_nick   =    $row_mail[0];
$desbanido    =    $row_mail[1];
$ip_nick      =    $row_mail[2];

$data_nick = date_create("$row_mail[3]");
$data_nick = date_format($data_nick, 'd-m-Y H:i');

echo "<tr height=21>";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$login_nick>$login_nick</a>";
echo '</td><td>';
echo "$desbanido";
echo '</td><td>';
echo "$ip_nick";
echo '</td><td>';
echo "$data_nick";
echo '</td></tr>';


}

echo "</table>";

?>