<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel="stylesheet" href="css/paginas.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/easydropdown.metro.css" type="text/css" />


	<script src="js/jquery.min.js"></script>
	<script src="js/easydropdown.js" type="text/javascript"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(2900);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">
<center>


<centeR>
<? 
include("inclu/config_simples.php");

$top =   $_GET['top'];
$raca =  $_GET['raca'];
$order = $_GET['order'];
$vip =   $_GET['vip'];

?>
<center><BR><BR><font size=3><b>RANKING DE JOGADORES</b></font><bR><bR>
<table border=0 cellspacing=5 cellpadding=0 align=center style='border:0;'><tr style="background:transparent;">
		<td width='400'><center>
<form name='form1' method='get' action='ranking.php?ranking=1'>
          <table width='80%' border='0' cellspacing='0' cellpadding='0' style='border:0;'>
   <tr style="background:transparent;"> 
  <td>     
<select name='top' id='top' class="dropdown" tabindex="1">
 <option value="10"  <?php if ($top==10 ) echo 'selected'; ?>>TOP 10  </option>
 <option value="20"  <?php if ($top==20 or !$top) echo 'selected'; ?>>TOP 20  </option>
 <option value="50"  <?php if ($top==50 ) echo 'selected'; ?>>TOP 50  </option>
 <option value="100" <?php if ($top==100) echo 'selected'; ?>>TOP 100 </option>
</select>
  </td>
   <td>
<select name='raca' id='raca' class="dropdown" tabindex="2">
 <option value=""   <?php if ($raca=='' ) echo 'selected'; ?>>Todas as Raças </option>
 <option value="2"  <?php if ($raca==2  ) echo 'selected'; ?>>Gran Master    </option>
 <option value="18" <?php if ($raca==18 ) echo 'selected'; ?>>Blade Master   </option>
 <option value="34" <?php if ($raca==34 ) echo 'selected'; ?>>High Elf       </option>
 <option value="50" <?php if ($raca==50 ) echo 'selected'; ?>>Duel Master</option>
 <option value="66" <?php if ($raca==66 ) echo 'selected'; ?>>Lord Emperor</option>
 <option value="82" <?php if ($raca==82 ) echo 'selected'; ?>>Dimension Master</option>
 <option value="98" <?php if ($raca==98 ) echo 'selected'; ?>>First Master</option>
</select>
  </td>
   <td>
<select name='order' id='order' class="dropdown" tabindex="3">
 <option value="mresets"  <?php if ($order=='mresets'  ) echo 'selected'; ?>>M.Resets      </option>
 <option value="resets"  <?php if ($order=='resets'  ) echo 'selected'; ?>>Resets      </option>
 <option value="eventos"  <?php if ($order=='eventos'  ) echo 'selected'; ?>>Eventos     </option>
 <option value="Exp_war" <?php if ($order=='Exp_war' ) echo 'selected'; ?>>Experiência </option>
 <option value="mortes"  <?php if ($order=='mortes'  ) echo 'selected'; ?>>Mortes          </option>
 <option value="pontos"  <?php if ($order=='pontos'  ) echo 'selected'; ?>>Hero          </option>
</select>
  </td>
   </tr>
            <tr style="background:transparent;"> 
              <td align='center' height='30' colspan=4><bR>
<input type="submit" value="Listar Personagens" class="btn btn-info btn-block"></td>
                          </tr>

          </table>
        </form>
</div>
</td>
</table>

<?php

if (!$top) {
$top= 20;}
elseif ($top==10){
$top= 10;}
elseif ($top==50){
$top= 50;}
elseif ($top==100){
$top= 100;}
Else {
$top = 20;}

if (!$raca) {
$raca= '';}
elseif ($raca==2){
$raca= 'and class=2';}
elseif ($raca==18){
$raca= 'and class=18';}
elseif ($raca==34){
$raca= 'and class=34';}
elseif ($raca==50){
$raca= 'and class=50';}
elseif ($raca==66){
$raca= 'and class=66';}
elseif ($raca==82){
$raca= 'and class=82';}
elseif ($raca==98){
$raca= 'and class=98';}
Else {
$raca = '';}

if (!$order) {
$order= 'masterresetcount desc,resetcount desc,clevel';
$tipor = '1';
$bold6='<b>';}
elseif ($order=='eventos'){
$order= 'eventos desc, resetcount';
$tipor = '3';
$bold1='<b>';}
elseif ($order=='Exp_war'){
$order= 'Exp_war desc, resetcount';
$tipor = '4';
$bold2='<b>';}
elseif ($order=='mortes'){
$order= 'z_rankpk desc, resetcount';
$tipor = '5';
$bold3='<b>';}
elseif ($order=='pontos'){
$order= 'z_rankhr desc, resetcount';
$tipor = '6';
$bold4='<b>';}
elseif ($order=='resets'){
$order= 'resetcount desc, clevel';
$tipor = '2';
$bold5='<b>';}
Else {
$order = 'masterresetcount desc,resetcount desc,clevel';
$tipor = '1';
$bold6='<b>';}


$query = "SELECT TOP $top Name,cLevel, Resetcount, accountid, masterresetcount, class, exp_war,character.eventos,z_rankpk,z_rankhr, dbo.fn_online(name),mi.accountlevel,dbo.fn_img(dbo.fn_acc(name)),dbo.fn_rank(name,$tipor),dbo.fn_bandeira(dbo.fn_acc(name)) FROM Character, memb_info mi WHERE 
(nivel_gm=0 or nivel_gm=1) 
and character.accountid=mi.memb___id COLLATE database_default $raca and ctlcode=0 order by character.$order desc ";
$result = mssql_query( $query );


echo "<center><table border=0 cellSpacing=0 align=center>";
echo "<thead><tr>
<th>Rank</th>
<th class=bgtr>Avatar</th>
<th class=bgtr>Character</th>
<th class=bgtr>Patente</th>
<th class=bgtr><center>Patente(exp)</th>
<th class=bgtr>M.Resets</th>
<th class=bgtr>Resets</th>
<th class=bgtr>Eventos</th>
<th class=bgtr>Mortes</th>
<th class=bgtr>Hero</th>".
((!$raca)?"<th>Pos</th>":"")."</tr></thead>";

for($i=0;$i < $top;++$i)
{
$row = mssql_fetch_row($result);

$vip3 = $row[11];
$patente_num = $row[6];
$class_char = $row[5];
include 'inclu/patentes.php';
include 'inclu/classe.php';


//$ranka = mssql_fetch_row(mssql_query("select posicao from LOG_RANK where name = '$row[0]' and tipo = '$tipor'"));

$posicao = $row[13]-($i+1);

$bandeira = $row[13]-($i+1);

if ($posicao > 0 ) {
$posi = "+$posicao <img src=img/up.png>";
}
elseif ($posicao < 0 ) {
$posi = "$posicao <img src=img/down.png>";
}
else {
$posi = "- <img src=img/igual.png>";
}

if($row[14])
{
	$bandeira = "<img src=img/bandeiras30/$row[14].png>";
}
else
{
	$bandeira = "<img src=img/bandeiras30/00.png>";
}

//SISTEMA DO MURKUT

if ($row[12]){
$avatar ="avatar/thumb.php?imagem=$row[12]&y=100&x=100&qualidade=100";
}else{
$avatar ='avatar/Icon-user.png';
}

if ($row[10] == 1) { 
$xir = "<img src=painel/img/on2.gif>"; }
else { 
$xir = "<img src=painel/img/off2.gif>"; }

if ($vip3 > 0) { 
$vip2 = "<font color=green><B>VIP</font>";}

if ($vip3 == 0) { 
$vip2 = "<font color=red><B>FREE</font>"; }

echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\">";
echo "<td width=30 align=rigth><center><font size=2><B>";
echo $i + 1;
echo '°</td><td width=42>';
echo "<img src=$avatar width=80 class=redondo_avatar>";
echo '</td><td width=130>';
echo "<font style='font-size: 15px;'><b>$row[0]</b> <br> <font style='font-size: 12px;'>($class) <br> $xir <br> $bandeira </font>";
echo '</td><td width=80>';
echo "<img src='img/$img.jpg' style='border: 1px solid #000000;height: 80px;' class=redondo2>";
echo "</td><td width=70 align=right>$bold2";
echo "<font style='font-size: 15px;'> $row[6]";
echo "</td><td width=70 align=right>$bold6";
echo "<font style='font-size: 15px;'> $row[4]";
echo "</td><td width=70 align=right>$bold5";
echo "<font style='font-size: 15px;'>$row[2]";
echo "</td><td width=70 align=right>$bold1";
echo "<font style='font-size: 15px;'>$row[7]";
echo "</td><td width=70 align=right>$bold3";
echo "<font style='font-size: 15px;'>$row[8]";
echo "</td><td width=60 align=right>$bold4";
echo "<font style='font-size: 15px;'>$row[9]";
echo ((!$raca)?"</td><td width=60 align=right valign=middle>$posi":"");
echo '</td>';
echo '</tr>';
}
echo "</table>";

if (!$_GET[top]){

echo "<br><bR><table border=0 align=center style='border:0;'><tr style='background:transparent;'><td valign=top>

<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Resets Diário</th></tr></thead>";

$query = "select top 5 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_diario where (tipo=1 or tipo=2) GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 5;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}

echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ M Resets Diário</th></tr></thead>";

$query = "select top 5 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_diario where tipo=3 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 5;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table>";

////


/////

echo "</td></tr><tr style='background:transparent;'><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Resets Semanal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_semanal where tipo=1 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ M Resets Semanal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_semanal where tipo=2 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Tempo Semanal</td></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_semanal where tipo=3 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Eventos Semanal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_semanal where tipo=4 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Mortes Semanal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_semanal where tipo=5 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td>";

/////////////////////////////////////

echo "<tr style='background:transparent;'><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Resets Mensal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_mensal where tipo=1 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ M Resets Mensal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_Mensal where tipo=2 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Tempo Mensal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_Mensal where tipo=3 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Eventos Mensal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_Mensal where tipo=4 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table></td><td valign=top>";

echo "<table border=0 width=170 cellspacing=0><thead><tr><th colspan=3>+ Mortes Mensal</th></tr></thead>";

$query = "select top 6 nome,count(nome) as num, dbo.fn_img(dbo.fn_acc(nome)) from top_Mensal where tipo=5 GROUP BY nome ORDER BY num DESC";
$result = mssql_query( $query );

for($i=0;$i < 6;++$i)
{
$row = mssql_fetch_row($result);

if ($row[2]){
$avatar ="avatar/thumb.php?imagem=$row[2]&y=30&x=30&qualidade=100";
}else{
$avatar ='avatar/Icon-user30.png';
}


echo "<tr onclick=\"document.location.href='info_char_pop.php?name=$row[0]&painel=ok'\"  onmouseover=\"this.style.backgroundColor='#BEBEBE'; this.style.cursor='pointer';this.style.textDecoration='underline';\" onmouseout=\"this.style.background=''; this.style.textDecoration='none';\"><td>";
echo "<img src=$avatar width=30 class=redondo_avatar>";
echo "</td><td>";
echo $row[0];
echo "</td><td>";
echo "<center>$row[1]x";
echo "</td></tr>";

}

echo "</table>";

}

?>
</table>
</div>
