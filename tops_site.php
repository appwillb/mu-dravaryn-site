<style>
	table {
    	border: 1px solid #000;
    	font-family: Verdana,sans-serif;
    	font-size: 12px;
	border-radius: 10px;
	}

	th, td {
    	padding: 5px;
    	text-align: center;
	}

	thead tr:first-child th:first-child 
	{
	border-top-left-radius: 7px; 
  	background-color:rgb(25,28,35);
    	color: #fff;
	}
	thead tr:first-child th:last-child 
	{ 
	border-top-right-radius: 7px; 
  	background-color:rgb(25,28,35);
    	color: #fff;
	}

	tbody tr:hover {
    	background: rgba(135,206,250,.2);
    	//cursor: pointer;
	}

	tr:nth-child(even) {
    	background: #eee;
	}

	td:nth-child(4), td:nth-child(7) {
    	
	}

	td:nth-child() {
    	//width: 10%;
	}

	td:nth-child(4) {
    	//width: 50%;
	}

	.redondo2 {
   	height: 100px;
   	background-color: #cccccc;
   	color: #FFF;
 
	border-radius: 5px;
	box-shadow: 0 3px 3px rgba(0,0,0,0.1);
	}
</style>
<?
include("inclu/config_simples.php");


echo "<table colspan=0 cellspacing=1>
	<thead>
	<tr>
		<th colspan=8>Melhores do Servidor</th>
	</tr>

	<tr>
		<th>+ M.Resets</th>
		<th>+ Resets</th>
		<th>+ Patente</th>
		<th>+ Eventos</th>
		<th>+ PK</th>
		<th>+ Hero</th>
		<th>+ Duelo</th>
		<th>+ Guild</th>
	</tr>
	</thead>


";

$query = "select 
valor1,dbo.fn_img(dbo.fn_acc(valor1)),
valor2,dbo.fn_img(dbo.fn_acc(valor2)),
valor3,dbo.fn_img(dbo.fn_acc(valor3)),
valor4,dbo.fn_img(dbo.fn_acc(valor4)),
valor5,dbo.fn_img(dbo.fn_acc(valor5)),
valor6,dbo.fn_img(dbo.fn_acc(valor6)),
valor7,(select g_mark from guild where g_name=valor7),
valor8,dbo.fn_img(dbo.fn_acc(valor8)),
valor9,dbo.fn_img(dbo.fn_acc(valor9)),
valor10,dbo.fn_img(dbo.fn_acc(valor10)),
valor11,dbo.fn_img(dbo.fn_acc(valor11)),
valor12,dbo.fn_img(dbo.fn_acc(valor12)),
valor13,dbo.fn_img(dbo.fn_acc(valor13)),
valor14,dbo.fn_img(dbo.fn_acc(valor14)),
valor15,dbo.fn_img(dbo.fn_acc(valor15)),
valor16,dbo.fn_img(dbo.fn_acc(valor16))
 from dbo.fn_tops()";
$result = mssql_query( $query );
$row 	= mssql_fetch_row($result);

$topmr 		= $row[0];
$topmr_img 	= $row[1];
$toprr 		= $row[2];
$toprr_img 	= $row[3];
$topexp 	= $row[4];
$topexp_img 	= $row[5];
$topeventos	= $row[6];
$topeventos_img	= $row[7];
$toppk 		= $row[8];
$toppk_img 	= $row[9];
$tophr 		= $row[10];
$tophr_img 	= $row[11];
$topguild	= $row[12];
$topguild_img 	= $row[13];
$topduel 	= $row[14];
$topduel_img 	= $row[15];
$topgm 		= $row[16];
$topgm_img 	= $row[17];
$topbm 		= $row[18];
$topbm_img 	= $row[19];
$topelf 	= $row[20];
$topelf_img 	= $row[21];
$topmg	 	= $row[22];
$topmg_img 	= $row[23];
$topdl	 	= $row[24];
$topdl_img 	= $row[25];
$topsum 	= $row[26];
$topsum_img 	= $row[27];
$toprf	 	= $row[28];
$toprf_img 	= $row[29];
$toppvp	 	= $row[30];
$toppvp_img 	= $row[31];

if ($topmr_img){
$avatar1 ="avatar/thumb.php?imagem=$topmr_img&y=100&x=100&qualidade=100";
}else{
$avatar1 ='avatar/Icon-user.png';
}
if ($toprr_img){
$avatar2 ="avatar/thumb.php?imagem=$toprr_img&y=100&x=100&qualidade=100";
}else{
$avatar2 ='avatar/Icon-user.png';
}
if ($topexp_img){
$avatar3 ="avatar/thumb.php?imagem=$topexp_img&y=100&x=100&qualidade=100";
}else{
$avatar3 ='avatar/Icon-user.png';
}
if ($topeventos_img){
$avatar4 ="avatar/thumb.php?imagem=$topeventos_img&y=100&x=100&qualidade=100";
}else{
$avatar4 ='avatar/Icon-user.png';
}
if ($toppk_img){
$avatar5 ="avatar/thumb.php?imagem=$toppk_img&y=100&x=100&qualidade=100";
}else{
$avatar5 ='avatar/Icon-user.png';
}
if ($tophr_img){
$avatar6 ="avatar/thumb.php?imagem=$tophr_img&y=100&x=100&qualidade=100";
}else{
$avatar6 ='avatar/Icon-user.png';
}
if ($topduel_img){
$avatar8 ="avatar/thumb.php?imagem=$topduel_img&y=100&x=100&qualidade=100";
}else{
$avatar8 ='avatar/Icon-user.png';
}
if ($topgm_img){
$avatar9 ="avatar/thumb.php?imagem=$topgm_img&y=100&x=100&qualidade=100";
}else{
$avatar9 ='avatar/Icon-user.png';
}
if ($topbm_img){
$avatar10 ="avatar/thumb.php?imagem=$topbm_img&y=100&x=100&qualidade=100";
}else{
$avatar10 ='avatar/Icon-user.png';
}
if ($topelf_img){
$avatar11 ="avatar/thumb.php?imagem=$topelf_img&y=100&x=100&qualidade=100";
}else{
$avatar11 ='avatar/Icon-user.png';
}
if ($topmg_img){
$avatar12 ="avatar/thumb.php?imagem=$topmg_img&y=100&x=100&qualidade=100";
}else{
$avatar12 ='avatar/Icon-user.png';
}
if ($topdl_img){
$avatar13 ="avatar/thumb.php?imagem=$topdl_img&y=100&x=100&qualidade=100";
}else{
$avatar13 ='avatar/Icon-user.png';
}
if ($topsum_img){
$avatar14 ="avatar/thumb.php?imagem=$topsum_img&y=100&x=100&qualidade=100";
}else{
$avatar14 ='avatar/Icon-user.png';
}
if ($toprf_img){
$avatar15 ="avatar/thumb.php?imagem=$toprf_img&y=100&x=100&qualidade=100";
}else{
$avatar15 ='avatar/Icon-user.png';
}
if ($toppvp_img){
$avatar16 ="avatar/thumb.php?imagem=$toppvp_img&y=100&x=100&qualidade=100";
}else{
$avatar16 ='avatar/Icon-user.png';
}



$logo = urlencode(bin2hex($topguild_img));

echo "<tr style=\"background:transparent;\">";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topmr&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar1' class='redondo2'> <br> <b>$topmr </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$toprr&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar2' class='redondo2'> <br> <b>$toprr </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topexp&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar3' class='redondo2'> <br> <b>$topexp </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topeventos&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar4' class='redondo2'> <br> <b>$topeventos </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$toppk&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar5' class='redondo2'> <br> <b>$toppk </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$tophr&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar6' class='redondo2'> <br> <b>$tophr </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topduel&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar8' class='redondo2'> <br> <b>$topduel </td>";
echo "<td onclick=\"document.location.href='info_guild_pop.php?modelist=$topguild&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='inclu/decode.php?decode=$logo' height=100 width=100 class=redondo2> <br> <b>$topguild </td>";

echo "</tr>";

echo"	<tr>
		<th>+ Gran Master</th>
		<th>+ Blade Master</th>
		<th>+ High Elf</th>
		<th>+ Duel Master</th>
		<th>+ Lord Emperor</th>
		<th>+ Dimension M.</th>
		<th>+ First Master</th>
		<th>+ Survivor</th>
	</tr>
	</thead>";

echo "<tr style=\"background:transparent;\">";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topgm&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar9' class='redondo2'> <br> <b>$topgm </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topbm&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar10' class='redondo2'> <br> <b>$topbm </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topelf&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar11' class='redondo2'> <br> <b>$topelf </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topmg&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar12' class='redondo2'> <br> <b>$topmg </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topdl&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar13' class='redondo2'> <br> <b>$topdl </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$topsum&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar14' class='redondo2'> <br> <b>$topsum </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$toprf&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar15' class='redondo2'> <br> <b>$toprf </td>";
echo "<td onclick=\"document.location.href='info_char_pop.php?name=$toppvp&painel=ok'\"  onmouseover=\"this.style.backgroundColor='rgba(135,206,250,.2)'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"> <img src='$avatar16' class='redondo2'> <br> <b>$toppvp </td>";



echo "</table>";



?>