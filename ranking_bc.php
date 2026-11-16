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

<BR><BR><font size=3><b>RANKING BLOOD CASTLE GERAL</font></b> <BR><BR>

<?php
include("inclu/config_simples.php");

$query = "
select top 20
Name,score, score_semanal, dbo.fn_img(dbo.fn_acc(name)),dbo.fn_online(name),dbo.fn_bandeira(dbo.fn_acc(name)),dbo.fn_classe(name) from rankingbloodcastle order by Score desc";
$result = mssql_query( $query );


echo "";

echo "<center><table border=0 cellSpacing=0 align=center>";
echo "<thead><tr>
<th>Rank</th>
<th class=bgtr>Avatar</th>
<th class=bgtr>Personagem</th>
<th class=bgtr>Classe</th>
<th class=bgtr>Pontos</th>
<th class=bgtr>País</th>
<th>Status</th>
</tr></thead>";

for($i=0;$i < 20;++$i)
{
$row = mssql_fetch_row($result);

if ($row[3]){
$avatar ="avatar/thumb.php?imagem=$row[3]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}

$class_char = $row[6];
include 'inclu/classe.php';


if ($row[4] == 1) { 
$xir = "<img src=painel/img/on2.gif>"; }
else { 
$xir = "<img src=painel/img/off2.gif>"; }

$bandeira 	= ($row[5]) ? "<img src=img/bandeiras30/$row[5].png>" : "<img src=img/bandeiras30/00.png>";


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\">";
echo "<td width=30 align=rigth><center><font size=2>";
echo $i + 1;
echo '°</td><td width=32>';
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo '</td><td width=100>';
echo "<B>$row[0]";
echo '</td><td width=100><center>';
echo "$class";
echo '</td><td width=70><center>';
echo "<font size=3><b>$row[1]";
echo '</td><td width=70><center>';
echo "<font size=3><b>$bandeira";
echo '</td><td width=90><center>';
echo $xir;
echo '</tr>';
}
echo "</table>";

?>

</div>
