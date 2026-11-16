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

<?
require("../inclu/config.php");
require("../inclu/cookie.php");

$NIVEL_ACESSO = 4;
require("../inclu/verif_nivel_gm.php");

$data_dia = mssql_fetch_row(mssql_query("SELECT DAY(GETDATE())-7"));
$data_ano = mssql_fetch_row(mssql_query("SELECT YEAR(GETDATE())"));
$data_mes = mssql_fetch_row(mssql_query("SELECT MONTH(GETDATE())"));


$sql_username_check = mssql_query("select name,(select sum(valor) from log_eventos where log_eventos.login=character.accountid and log_eventos.data > getdate()-7) as num from character where character.nivel_gm=2 or nivel_gm=3 ORDER BY num DESC"); 
$xex = mssql_num_rows($sql_username_check);

?>
<table border='0' cellspacing='0' cellpadding='0' width=400>

  <thead>
	<tr>	
		<th colspan=5>Ultimos 7 dias</th>
	</tr>

	<tr>	
		<th>Game Master</th>
  		<th>Quantidade</th>
	</tr>

  </thead>



<?

for($i=0;$i < $xex;++$i)
{
$username_get = mssql_fetch_row( $sql_username_check );

if (!$username_get[1]) $username_get[1] = 0;

echo "<tr>
  <td align=right><a href='../../info_char_pop.php?name=$username_get[0]&painel=ok' target='main2'>$username_get[0]</a></td>
  <td><center><a href='?mostrar=$username_get[0]'>$username_get[1]</a></td>
</tr>";

}

echo "</table>";


?>

</table><br><br>

<?

$data_dia = mssql_fetch_row(mssql_query("SELECT DAY(GETDATE())"));
$data_ano = mssql_fetch_row(mssql_query("SELECT YEAR(GETDATE())"));
$data_mes = mssql_fetch_row(mssql_query("SELECT MONTH(GETDATE())"));
$dd = cal_days_in_month(CAL_GREGORIAN, $data_mes[0], $data_ano[0]);


$sql_username_check = mssql_query("select name,(select sum(valor) from log_eventos where log_eventos.login=character.accountid and log_eventos.data > '$data_mes[0]/1/$data_ano[0] 00:00:00' and log_eventos.data < '$data_mes[0]/$dd/$data_ano[0] 23:59:00') as num from character where nivel_gm=2 or nivel_gm=3 ORDER BY num DESC"); 
$xex = mssql_num_rows($sql_username_check);

?>

<table border='0' cellspacing='0' cellpadding='0' width=400>
  <thead>
	<tr>	
		<th colspan=5>Total de evento nesse mês</th>
	</tr>

	<tr>	
		<th>Game Master</th>
  		<th>Quantidade</th>
	</tr>

  </thead>
<?
for($i=0;$i < $xex;++$i)
{
$username_get = mssql_fetch_row( $sql_username_check );

if (!$username_get[1]) $username_get[1] = 0;

echo "<tr>
  <td align=right><a href='../../info_char_pop.php?name=$username_get[0]&painel=ok' target='main2'>$username_get[0]</a></td>
  <td><center><a href='?mostrar=$username_get[0]'>$username_get[1]</a></td>
</tr>";

}

echo "</table><br><BR>";

$data_dia = mssql_fetch_row(mssql_query("SELECT DAY(GETDATE())"));
$data_ano = mssql_fetch_row(mssql_query("SELECT YEAR(GETDATE())"));
//$data_ano[0] = '2016';
$data_mes = mssql_fetch_row(mssql_query("SELECT MONTH(GETDATE())-1"));
//$data_mes[0] = 12;

$data_ano[0] = ($data_mes[0] <=0) ? $data_ano[0]-1 : $data_ano[0];
$data_mes[0] = ($data_mes[0] <=0) ? 12 : $data_mes[0];


$dd = cal_days_in_month(CAL_GREGORIAN, $data_mes[0], $data_ano[0]);

$sql_username_check = mssql_query("select name,(select sum(valor) from log_eventos where log_eventos.login=character.accountid and log_eventos.data > '$data_mes[0]/1/$data_ano[0] 00:00:00' and log_eventos.data < '$data_mes[0]/$dd/$data_ano[0] 23:59:00') as num from character where nivel_gm=2 or nivel_gm=3 ORDER BY num DESC"); 
$xex = mssql_num_rows($sql_username_check);

?>

<table border='0' cellspacing='0' cellpadding='0' width=400>
  <thead>
	<tr>	
		<th colspan=5>Total de eventos mês passado</th>
	</tr>

	<tr>	
		<th>Game Master</th>
  		<th>Quantidade</th>
	</tr>

  </thead>

<?
for($i=0;$i < $xex;++$i)
{
$username_get = mssql_fetch_row( $sql_username_check );

if (!$username_get[1]) $username_get[1] = 0;

echo "<tr>
  <td align=right><a href='../../info_char_pop.php?name=$username_get[0]&painel=ok' target='main2'>$username_get[0]</a></td>
  <td><center><a href='?mostrar=$username_get[0]'>$username_get[1]</a></td>
</tr>";

}

echo "</table>";

if ($_GET['mostrar']){
$gm = $_GET['mostrar'];

$sql_username_check = mssql_query("select personagem,valor,data from log_eventos where login = (select accountid from character where name='$gm' and (nivel_gm=2 or nivel_gm=3)) and data>getdate()-7 order by data desc"); 
$xex = mssql_num_rows($sql_username_check);

echo "<BR><BR>
<table border='0' cellspacing='0' cellpadding='0' width=400>

  <thead>
	<tr>	
		<th colspan=3>Log dos ultimos 7 dias</th>
	</tr>

	<tr>	
		<th>Personagem</th>
  		<th>Valor</th>
  		<th>Data</th>
	</tr>

  </thead>
";

for($i=0;$i < $xex;++$i)
{
$username_get = mssql_fetch_row( $sql_username_check );

echo "<tr>
  <td align=right><a href='../../info_char_pop.php?name=$username_get[0]&painel=ok' target='main2'>$username_get[0]</a></td>
  <td><center>$username_get[1]</td>
  <td><center>$username_get[2]</td>
</tr>";

}

echo "</table>";


}



?>

</table><br><br>
</div>
