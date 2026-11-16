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

<br><Br><font size=3><b>LOGS REI DO MU</font></b><br><br>

<?php
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 5;
require("../inclu/verif_nivel_gm.php");

$result_pe = mssql_query( "select login,name,guild,data from log_rei_mk order by id desc" );
$num = mssql_num_rows($result_pe);

echo '<body>';
echo '<center><table border=0 cellSpacing=0 align=center>';
echo '
<thead>
  <tr>
	<th colspan=4> Log de conquistas do trono </th>
  </tr>
  <tr>
	<th width=100><b>Login</th>
	<th width=100><b>Personagem</th>
	<th width=100><b>Guild</th>
	<th width=150><b>Data</th>
  </tr>
</thead>';

for($i=0;$i < $num;++$i)
{
$row = mssql_fetch_row($result_pe);

$data = date_format(date_create("$row[3]"), 'd-m-Y H:i');

echo "<tr height=21>";
echo "<td>";
echo "<a href=editar_conta.php?loginlog=$row[0]><font size=2>$row[0]</a>";
echo '</td><td><font size=2>';
echo "$row[1]";
echo '</td><td><font size=2>';
echo "$row[2]";
echo '</td><td><font size=2>';
echo "$data";
echo '</td></tr>';


}

echo '</table>';

?>
</div>