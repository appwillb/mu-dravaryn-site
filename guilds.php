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

<BR><BR><font size=3><b>RANKING DE GUILDS</font></b> <BR><BR>

<?
include("inclu/config_simples.php");
?>


<table border = 0 cellpadding='0' cellspacing='0'>

    <thead>

    <tr>
      <th width=25>Rank</th>
      <th width=105 class='bgtr'>Nome</th>
      <th width=55 class='bgtr'>Membros</th>
      <th width=55 class='bgtr'>Online</th>
      <th width=55 class='bgtr'>Score</th>
      <th width=100 class='bgtr'>Dono</th>
      <th width=100 class='bgtr'>País</th>
      <th width=75 class='bgtr'>Logo</th>
    </tr>

    </thead>

<?


$query = 'SELECT TOP 10 g_name,g_mark, g_score, g_master, g_count, dbo.fn_bandeira(dbo.fn_acc(g_master)) from guild order by G_score desc';
$result = mssql_query($query);

for($i=0;$i < mssql_num_rows($result);++$i)
{
$row = mssql_fetch_row($result);

$result22 = mssql_query("SELECT 
dbo.fn_online(guildmember.Name)
from 
guildmember 
Where 
G_Name = '$row[0]'");

$xex = mssql_num_rows($result22);

$onn = 0;

for($f=0;$f < $xex;++$f)
{
$row3 = mssql_fetch_row($result22);

if ($row3[0] == 1) { 
$onn = $onn+1;

}

}

$rank = $i+1;

$logo = urlencode(bin2hex($row [1]));

$bandeira 	= ($row[5]) ? "<img src=img/bandeiras30/$row[5].png>" : "<img src=img/bandeiras30/00.png>";

   echo "
<tr onclick=\"document.location.href='info_guild_pop.php?modelist=$row[0]'\" onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';\" onmouseout=\"this.style.background='';\">
        <td width=25><div align='center'><font size=4><b>"."$rank"."°</font></div></td>
        <td width=105><div align='center'><font size=3>$row[0]</font></div></td>
        <td width=55><div align='center'><font size=3>$row[4]</font></div></td>
        <td width=55><div align='center'><font size=3>$onn</font></div></td>
        <td width=55><div align='center'><font size=3>$row[2]</font></div></td>
        <td width=100><div align='center'><font size=3>$row[3]</font></div></td>
        <td width=100><div align='center'>$bandeira</font></div></td>
        <td width=75><div align='center'><img src='inclu/decode.php?decode=$logo' height=100 width=100></div></td>
      </tr>
    ";    
}            
?>

</table>

</div>