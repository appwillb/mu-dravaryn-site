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

<br><Br><font size=3><b>LOGS DOS EVENTOS DOS GMS</font></b><br><br>

<?php
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;
require("../inclu/verif_nivel_gm.php");

$result_pe = mssql_query("select * from (select TOP 20 login,login_destino,char,GAMEID,GAMEID_dest,ip,CONVERT(VARCHAR(19),data,120) as data from LOG_TRANSFERENCIA order by data desc) a ");
$num = mssql_num_rows($result_pe);

echo '<table border=0 cellSpacing=0 align=center>';
echo '
<thead>
  <tr>
	<th colspan=7>Ultimas 20 transferências</th>
  </tr>
<tr>
<td width=90><b>Login</td>
<td width=90><b>Login Destino</td>
<td width=90><b>Personagem</td>
<td width=70><b>GameID</td>
<td width=90><b>GameID Dest</td>
<td width=120><b>IP</td>
<td width=120><b>Data</td></tr>';

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($result_pe);

$data = date_create("$row[6]");
$data = date_format($data, 'd-m-Y H:i');

echo "<tr height=21 onmouseover=\"this.style.backgroundColor='lightblue'; this.style.cursor='pointer';\" onmouseout=\"this.style.background='';\">";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$row[0]><font size=2>$row[0]</a>";
echo '</td><td><font size=2>';
echo "<a href=editar_conta.php?loginlog=$row[1]>$row[1]</a>";
echo '</td><td><font size=2>';
echo "$row[2]";
echo '</td><td><font size=2>';
echo "$row[3]";
echo '</td><td><font size=2>';
echo "$row[4]";
echo '</td><td><font size=2>';
echo "$row[5]";
echo '</td><td><font size=2>';
echo "$data";
echo '</td></tr>';


}

echo "</table>";
?>
</div>