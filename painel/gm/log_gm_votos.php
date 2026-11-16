<head>
  <link type="text/css" rel="stylesheet" href="../css/paginas.css">
  <link type="text/css" rel="stylesheet" href="../css/paginas_img.css">

<title>www.mukoreia.net</title>

<script language="Javascript" type="text/javascript">
function tamanho() 
{ parent.document.getElementById("main2").height = document.getElementById("tamanho").scrollHeight + 40;
}
</script>
</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">
<div id="tamanho">
<center>
  <table width="400" border="0" cellspacing="2" cellpadding="3" bordercolor=#333333>
<tr><td>
<?PHP
require("../inclu/config.php");
require("../inclu/cookie.php");
require("../inclu/verif_gm.php");

echo "<center><table border=0 width=250 cellspacing=0><tr><td colspan=2><center><b>Lista dos GMS mais bem votados pelos players do MK:</b><br>(Melhores eventos)</td></tr>";

$sql_username_check2 = mssql_query("select Name,votos from character where (nivel_gm=2 or nivel_gm=3) order by votos desc"); 
$num2 = mssql_num_rows($sql_username_check2);

for($i=0;$i < $num2;++$i)
{
$row = mssql_fetch_row($sql_username_check2);

echo "<tr onclick=\"document.location.href='../info_char.php?name=$row[0]'\"  onmouseover=\"this.style.backgroundColor='lightblue'; this.style.cursor='pointer';\" onmouseout=\"this.style.backgroundColor='';this.style.textDecoration='none';\"><td>";
echo "<font size=2><b>$row[0]</font>";
echo "</td><td>";
echo "<font size=2><b>$row[1]</font>";
echo "</td></tr>";

}

$query = mssql_query("select login_fez from log_votos");
$quant = mssql_num_rows($query);

echo "</table><br>Total de votos: <b>$quant";
?>
