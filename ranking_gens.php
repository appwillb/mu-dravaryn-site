<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />

        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

<style>
.crhis {
    background: url(img/gensranlkingu.png);
        color: #FF6600;
    font-weight: bold;
    font-size: 20px;
    -moz-border-radius: 8px 8px 8px 8px;
}
.brown {
    color: #FF6600;
    font-weight: bold;
    font-size: 20px;

}
.hiphop {

        color: #3399FF;
    font-weight: bold;
    font-size: 20px;
}
</style>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>

<BR><BR><font size=3><b>RANKING DAS FAMÍLIAS</font></b> <BR><BR>

	<?
	include("inclu/config_simples.php");

	$pfamy1 = mssql_query("SELECT sum(Contribution) FROM Gens_rank WHERE Family='1'");
	$tpfamy1 = mssql_fetch_row($pfamy1);

	$pfamy2 = mssql_query("SELECT sum(Contribution) FROM Gens_rank WHERE Family='2'");
	$tpfamy2 = mssql_fetch_row($pfamy2);

	?>

<table width="570" height="170" align="center" border=0 style='border:0;'>

<tr style="background:transparent;">


<td height="14" class="crhis">
<div class="brown"  style="width:100; position: relative;top:70px; left:65px"  ><? echo $tpfamy1[0];?></div>
<div class="hiphop" style="width:100; position: relative;top:45px; left:402px"  ><? echo $tpfamy2[0];?></div>

</td>


</tr>

</table><br>

<table width="570" border="0" style='border:0;'>
  <tr style="background:transparent;">
    <th rowspan="2" scope="col"><img src='img/DupriansFamily.png' border='0'/></a></th>
    <th scope="col">
	<?

	$familia1 = mssql_query("SELECT count(*) FROM Gens_rank WHERE Family='1'");
	$tfamilia1 = mssql_fetch_row($familia1);
	echo "
	Membros: $tfamilia1[0]
	";?>
    </th>
    <th rowspan="2" scope="col" width=200></th>

    <th rowspan="2" scope="col">
	<img src='img/StewardsFamily.png' border='0'/></a></th>
    <th scope="col">
	<?

	$familia2 = mssql_query("SELECT count(*) FROM Gens_rank WHERE Family='2'");
    $tfamilia2 = mssql_fetch_row($familia2);
	echo "
	Membros: $tfamilia2[0]
	";?>
    </th>
  </tr>
  <tr style="background:transparent;">
    <th scope="col">	
	<?
	echo "
	Pontos: $tpfamy1[0]
	";?>
	</th>
    <th scope="col">	
	<?
	echo "
	Pontos: $tpfamy2[0]
	";?>
</th>
  </tr>
</table>

<table width=700 style='border:0;'>
<tr style="background:transparent;"><td>

<table border=0 width=300 cellspacing=2>

	<thead>

<tr>
	<th colspan=4><center>Rank Familia Duprian</th>

</tr>
<tr>
	<th>Rank</th>
	<th>Emblema</th>
	<th><center>Personagem</th>
	<th><center>Pontos</th>
</tr>
	</thead>

<?


$query = "select top 15 name,Contribution, dbo.fn_rank_gens(name,1) 
from Gens_rank where family=1 ORDER by Contribution DESC";
$result = mssql_query( $query );

for($i=1;$i <= 15;++$i)
{
$row = mssql_fetch_row($result);

$gens_num     = $row[1]; // Gens
$gens_family  = 1; // Gens
$gens_rank    = $row[2]; // Gens

include 'inclu/gens.php';


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='$fundo_tab_cor'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo $i;
echo "º</td><td>";
echo "<font size=3><b><img src=img/gens/$img_gens.png height=50></td><td>";
echo "$row[0]";
echo "</td><td>";
echo "<center>$row[1]";
echo "</td></tr>";

}

echo "</table>"; 

?>

</td>

<td width=100></td>

<td>
<table border=0 width=300 cellspacing=2>

	<thead>

<tr>
	<th colspan=4><center>Rank Familia Vanert</th>

</tr>
<tr>
	<th>Rank</th>
	<th>Emblema</th>
	<th><center>Personagem</th>
	<th><center>Pontos</th>
</tr>
	</thead>

<?


$query = "select top 15 name,Contribution, dbo.fn_rank_gens(name,2) 
from Gens_rank where family=2 ORDER by Contribution DESC";
$result = mssql_query( $query );

for($i=1;$i <= 15;++$i)
{
$row = mssql_fetch_row($result);

$gens_num     = $row[1]; // Gens
$gens_family  = 2; // Gens
$gens_rank    = $row[2]; // Gens

include 'inclu/gens.php';


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='$fundo_tab_cor'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo $i;
echo "º</td><td>";
echo "<font size=3><b><img src=img/gens/$img_gens.png height=50></td><td>";
echo "$row[0]";
echo "</td><td>";
echo "<center>$row[1]";
echo "</td></tr>";

}

echo "</table>"; 

?>

</td></tr></table></div>