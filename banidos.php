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

<BR><BR><font size=3><b>PERSONAGENS BANIDOS</font></b> <BR><BR>
<? 
include("inclu/config_simples.php");

$query = 'Select Name, bloc_reason, bloc_by, dia_bloc From Character WHERE ctlcode=1 and dia_bloc<>"9999" order by bloc_by asc,dia_bloc desc';
$result = mssql_query( $query );

echo '<table border="0" cellSpacing=0 width=800 align=center>

	<thead>
    <tr>
          <th><center>Personagem</center></td>
          <th class=bgtr><center>Motivo</center></td>
          <th class=bgtr><center>Banido por:</center></td>
          <th><center>Dias:</center></td> </tr></thead>';

$coee1 = mssql_query("SELECT count(*) FROM Character WHERE ctlcode=1 and dia_bloc<>'9999'");
$coee = mssql_result($coee1, 0, 0);

if ($coee <= 0 ) { echo "<tr> <td colspan=4> Nenhum personagem! </td> </tr>"; }

for($i=0;$i < $coee;++$i)
{
$row = mssql_fetch_row($result);
echo "<tr  onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\" onmouseover=\"this.style.backgroundColor='#999999'; this.style.cursor='pointer';\" onmouseout=\"this.style.background='';\">";
echo "<td width=150 style='border: 0px;'><center>";
echo "$row[0]"; 
echo '</td><td width=600>';
echo "$row[1]"; 
echo '</td><td width=120><center>';
echo "$row[2]"; 
echo '</td><td width=100><center>'; 
echo "$row[3]"; 
echo '</td></tr>'; 

}
$conn=mssql_close(); 
?>
</td></tr></table><br>

<center><font size=3><b>BANIDOS ETERNAMENTE</font><bR><br>

<?php
$query = 'Select Name, bloc_reason, bloc_by, dia_bloc From Character WHERE ctlcode=1 and dia_bloc="9999" order by bloc_by asc,dia_bloc desc';
$result = mssql_query( $query );

echo '<table cellSpacing=0 width=800 align=center>
	<thead>
    <tr>
          <th><center>Personagem</center></td>
          <th class=bgtr><center>Motivo</center></td>
          <th class=bgtr><center>Banido por:</center></td>
          <th><center>Dias:</center></td></TR> </thead>';

$coee1 = mssql_query("SELECT count(*) FROM Character WHERE ctlcode=1 and dia_bloc='9999'");
$coee = mssql_result($coee1, 0, 0);

if ($coee <= 0 ) { echo "<tr> <td colspan=4> Nenhum personagem! </td> </tr>"; }

for($i=0;$i < $coee;++$i)
{
$row = mssql_fetch_row($result);

echo "<tr  onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\" onmouseover=\"this.style.backgroundColor='#999999'; this.style.cursor='pointer';\" onmouseout=\"this.style.background='';\">";
echo "<td width=150 style='border: 0px;'><center>";
echo "$row[0]"; 
echo '</td><td width=600>';
echo "$row[1]"; 
echo '</td><td width=120><center>';
echo "$row[2]"; 
echo '</td><td width=100><center>'; 
echo "$row[3]"; 
echo '</td></tr>'; 

}
$conn=mssql_close(); 
?>
</td></tr></table>
</div>