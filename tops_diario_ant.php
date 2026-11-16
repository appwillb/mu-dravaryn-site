<head>
<style type="text/css">
	body,tr			{ font-family: arial, helvetica; color: black; font-size: 12px; }

	A:link			{ text-decoration: none; color: black; }
	A:visited		{ text-decoration: none; color: black; }
	A:hover			{ text-decoration: underline; color: green;}

	A:link    IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:active  IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:visited IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:hover   IMG 	{border:1px; border-thickness: 2px; border-color: green; border-style: solid;}


	.bordaBox {background: transparent;}
	.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b4, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b, .bordaBox .b4b {display:block; overflow:hidden; font-size:1px;}
	.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b {height:1px;}
	.bordaBox .b2, .bordaBox .b3, .bordaBox .b4 {border-left:1px solid #000; border-right:1px solid #000;}
	.bordaBox .b1 {margin:0 5px; background:#000;}
	.bordaBox .b2 {margin:0 3px; border-width:0 2px;}
	.bordaBox .b3 {margin:0 2px;}
	.bordaBox .b4 {height:2px; margin:0 1px;}
	.bordaBox .conteudo {padding:0px;display:block; border-left:1px solid #000; border-right:1px solid #000;}

.redondo_avatar {
   background-color: #363636;
   color: #FFF;
 
   /* Agora a mágica */
   border-radius: 50%;
}

</style>

<title>Ranking - www.mukoreia.net</title>

<script src="js/jquery.min.js"></script>
<script src="js/easydropdown.js" type="text/javascript"></script>

	<script type="text/javascript">
        function tamanho(){
            if (parent.postMessage) {
				var height = document.getElementById("tamanho").scrollHeight + 40;;
				
                parent.postMessage(height, "http://mks3.sytes.net:8070");
                parent.postMessage(height, "http://mukoreia.net");
                parent.postMessage(height, "http://www.mukoreia.net");
            }

	    parent.document.getElementById("main2").height = document.getElementById("tamanho").scrollHeight + 40;
	    }

        </script>
</head>
<body leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">

<bR><BR><center><font size=4><b>TOP DIÁRIO</font></b><br><br>

<center><font size=4><b>Vencedores do último TOP Diário</font></b><br><br>

O top diário dá prêmios aos melhores personagens do dia, por enquanto temos apenas 3 tops e em breve vamos adicionar mais.<bR><br>

Para facilitar a vida dos novatos fizemos um top de resets para os personagens com menos de 100 resets. <br><bR>

O Top é zerado diariamente à 00:30!<br><br> 

<table align=center>
<tr>
<td>

<?php
$query = "select TOP 1 nome,dado from top_diario where tipo=1 order by data desc";
$result = mssql_query( $query );
$row = mssql_fetch_row($result);

$name = $row[0];

$query2 = "select TOP 1 exp_war from character where name='$name'";
$result2 = mssql_query( $query2 );
$row2 = mssql_fetch_row($result2);

$patente_num = $row2[0];
include 'inclu/patentes.php';

?>



<table border='0' cellpadding='0' align='center' cellspacing='0' width=130 height=170 style='border: 1px solid #000000;' >
 <tr>
    <td valign=top height=40><center><font size=2>Personagens com menos de 100 resets
     </td>
  </tr>
  <tr>
    <td valign=top>


<div style='position: relative; left:8; top:130;'><div style='z-index: 9; display: block; position: absolute; width: 110px; border:0px dotted black; text-align:center;'>
<center><table width='110' border='0' align='center' bgcolor=white cellspacing='0' cellpadding='0'>
  <tr>
    <td style='border: 1px solid #000000;'><center>
 <b><a href=info_char.php?name=<? echo $name;?> target=mainFrame><font size=2><? echo $name;?></b>
<br><? echo "$row[1]";?> Resets</font></a>
     </td>
  </tr>
</table>
 </div></div>
<center>
<img src='http://mukoreia.net/img/<? echo $img;?>.jpg' width='100' style='border: 1px solid #000000;'> 

<br><br><font style='font: 13px LithosProBold, Arial, sans-serif;
	color: black; text-shadow: 2px 2px 2px #ffffff;filter: glow(color=white,strength=2);'>Ganhou:</b></font>
<br>2 dias VIP</b>
<br>10 Golds
<bR>10 EXP

     </td>
  </tr>
</table>

<?
$query = "select TOP 1 nome,dado from top_diario where tipo=2 order by data desc";
$result = mssql_query( $query );
$row = mssql_fetch_row($result);

$name = $row[0];

$query2 = "select TOP 1 exp_war from character where name='$name'";
$result2 = mssql_query( $query2 );
$row2 = mssql_fetch_row($result2);

$patente_num = $row2[0];
include 'inclu/patentes.php';

?>

</td><td>
<table border='0' cellpadding='0' align='center' cellspacing='0' bordercolor=#333333 width=130 height=170 style='border: 1px solid #000000;'>
 <tr>
    <td valign=top height=40><center><font size=2>Personagens com mais de 100 Resets
     </td>
  </tr>
  <tr>
    <td valign=top>


<div style='position: relative; left:8; top:130;'><div style='z-index: 9; display: block; position: absolute; width: 110px; border:0px dotted black; text-align:center;'>
<center><table width='110' border='0' align='center' bgcolor=white cellspacing='0' cellpadding='0'>
  <tr>
    <td style='border: 1px solid #000000;'><center>
 <b><a href=info_char.php?name=<? echo $name;?> target=mainFrame><font size=2><? echo $name;?></b>
<br><? echo "$row[1]";?> Resets</font></a>
     </td>
  </tr>
</table>
 </div></div>
<center>
<img src='http://mukoreia.net/img/<? echo $img;?>.jpg' width='100' style='border: 1px solid #000000;'> 

<br><br><font style='font: 13px LithosProBold, Arial, sans-serif;
	color: black; text-shadow: 2px 2px 2px #ffffff;filter: glow(color=white,strength=2);'>Ganhou:</b></font>
<br>2 dias VIP</b>
<br>10 Golds
<bR>10 EXP
     </td>
  </tr>
</table>

<?
$query = "select TOP 1 nome,dado from top_diario where tipo=3 order by data desc";
$result = mssql_query( $query );
$row = mssql_fetch_row($result);

$name = $row[0];

$query2 = "select TOP 1 exp_war from character where name='$name'";
$result2 = mssql_query( $query2 );
$row2 = mssql_fetch_row($result2);

$patente_num = $row2[0];
include 'inclu/patentes.php';

?>

</td><td>

<table border='0' cellpadding='0' align='center' cellspacing='0' bordercolor=#333333 width=130 height=170 style='border: 1px solid #000000;'>
 <tr>
    <td height=40 valign=top><center><font size=2>+Master Resets
     </td>
  </tr>
  <tr>
    <td valign=top>


<div style='position: relative; left:8; top:130;'><div style='z-index: 9; display: block; position: absolute; width: 110px; border:0px dotted black; text-align:center;'>
<center><table width='110' border='0' align='center' bgcolor=white cellspacing='0' cellpadding='0'>
  <tr>
    <td style='border: 1px solid #000000;'><center>
 <b><a href=info_char.php?name=<? echo $name;?> target=mainFrame><font size=2><? echo $name;?></b>
<br><? echo "$row[1]";?> Resets</font></a>
     </td>
  </tr>
</table>
 </div></div>
<center>
<img src='http://mukoreia.net/img/<? echo $img;?>.jpg' width='100' style='border: 1px solid #000000;'> 

<br><br><font style='font: 13px LithosProBold, Arial, sans-serif;
	color: black; text-shadow: 2px 2px 2px #ffffff;filter: glow(color=white,strength=2);'>Ganhou:</b></font>
<br>3 dias VIP</b>
<br>10 Golds
<bR>10 EXP
     </td>
  </tr>
</table></td></tr></table><br><br><font size=3><b>Ranking Diário</b></font>
<?

echo "<br><table border=0 align=center><tr><td valign=top>";

echo "<table border=0 width=180 cellspacing=0 style='border: 1px solid #000000;'><tr><td colspan=2><center><font style='font: 12px LithosProBold, Arial, sans-serif;
	color: black; text-shadow: 2px 2px 2px #ffffff;filter: glow(color=white,strength=2);'>+Resets < 100 resets</td></tr>";

$query = "select top 10 Name,reset_diario from character where resets<101 order by reset_diario desc,resets desc";
$result = mssql_query( $query );


for($i=0;$i < 10;++$i)
{
$row = mssql_fetch_row($result);

$min = $row[1];
include 'inclu/tempo.php';

echo "<tr onclick=\"document.location.href='info_char.php?name=$row[0]'\" onmouseover=\"this.style.backgroundColor='#FFFACD'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo $row[0];
echo "</td><td>";
echo "$row[1]";
echo "</td></tr>";

}
echo "</table></td><td valign=top>";

echo "<table border=0 width=180 cellspacing=0 style='border: 1px solid #000000;'><tr><td colspan=2><center><font style='font: 12px LithosProBold, Arial, sans-serif;
	color: black; text-shadow: 2px 2px 2px #ffffff;filter: glow(color=white,strength=2);'>+Resets > 100 resets</td></tr>";

$query = "select top 10 Name,reset_diario from character where resets>100 order by reset_diario desc,resets desc";
$result = mssql_query( $query );


for($i=0;$i < 10;++$i)
{
$row = mssql_fetch_row($result);

echo "<tr onclick=\"document.location.href='info_char.php?name=$row[0]'\"  onmouseover=\"this.style.backgroundColor='#FFFACD'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo $row[0];
echo "</td><td>";
echo "$row[1]";
echo "</td></tr>";

}
echo "</table></td><td valign=top>";

echo "<table border=0 width=180 cellspacing=0 style='border: 1px solid #000000;'><tr><td colspan=2><center><font style='font: 12px LithosProBold, Arial, sans-serif;
	color: black; text-shadow: 2px 2px 2px #ffffff;filter: glow(color=white,strength=2);'>+M.Resets</td></tr>";

$query = "select top 10 Name,mresets_diario from character order by mresets_diario desc,mresets desc";
$result = mssql_query( $query );

for($i=0;$i < 10;++$i)
{
$row = mssql_fetch_row($result);

echo "<tr onclick=\"document.location.href='info_char.php?name=$row[0]'\"  onmouseover=\"this.style.backgroundColor='#FFFACD'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo $row[0];
echo "</td><td>";
echo "$row[1]";
echo "</td></tr>";

}
echo "</table></td></tr></table>";
?>
<br>"O importante não é vencer todos os dias, mas lutar sempre."

</div>
