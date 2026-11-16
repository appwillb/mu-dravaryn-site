<head>
<title>JogandoMU.com.br</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="title" content="JogandoMU Season8"/>
<meta name="keywords" content="mu, mu online, muonline, mu online server, servidor de mu, servidor de mu online, server de mu, server de mu online, 24 horas, 24h, mmorpg, mmorpg online, rpg, rpg online, jogo de mu, jogar mu, baixar mu, download mu">
<meta name="description" content="Crie sua conta e participe dos eventos, não perca, promoção limitada, Mu Online Season 8 é na JogandoMU"/>
<meta name="abstract" content="Crie sua conta e participe dos eventos, não perca, promoção limitada, Mu Online Season 8 é na JogandoMU"/>
<meta name="distribution" content="Global"/>
<meta name="rating" content="General"/>
<meta name="Robots" content="INDEX,FOLLOW"/>
<meta name="author" content="JogandoMU.com.br"/>
<meta name="COPYRIGHT" content="Copyright (c) JogandoMU"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8"/>
<meta http-equiv="pragma" content="no-cache"/>
<meta http-equiv="expires" content="Mon, 01 Jan 1990 00:00:01 GMT"/>
<meta name="REVISIT-AFTER" content="1 DAYS"/>

<meta property="og:url" content="http://www.jogandomu.com.br"/>
<meta property="og:site_name" content="JogandoMU"/>
<meta property="og:title" content="JogandoMU Season 8"/>
<meta property="og:description" content="Crie sua conta e participe dos eventos, Mu Online Season 8 - JogandoMU"/>
<meta property="og:image" content="http://www.jogandomu.com.br/img/facebook4.jpg"/> 

<style type="text/css">
	body,tr			{ font-family: arial, helvetica; color: black; font-size: 12px; }

	A:link			{ text-decoration: none; color: black; }
	A:visited		{ text-decoration: none; color: black; }
	A:hover			{ text-decoration: underline; color: green;}

	A:link    IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:active  IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:visited IMG 	{border:1px; border-thickness: 0px; border-color: #000000; border-style: solid;}
	A:hover   IMG 	{border:1px; border-thickness: 2px; border-color: green; border-style: solid;}


       IMG 	{border:0px; border-thickness: 0px; border-color: green; border-style: solid;}

.redondo_avatar {
   background-color: #363636;
   color: #FFF;
 
   /* Agora a mágica */
   border-radius: 50%;
}

</style>

        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/instrucao.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        <script type="text/javascript" src="js/enhance.js"></script>

	<script type="text/javascript">
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7&appId=1166060120081812";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</head>

<body leftmargin= "0" topmargin="0" onload="tamanho()">
<div id="tamanho">

<?

foreach($_GET AS $key => $value) {
${$key} = $value;
}

function MontarLink ($texto)
{
       if (!is_string ($texto))
           return $texto;
      
    $er = "/( http:\/\/(www\.|.*?\/)?|www\.)([a-zA-Z0-9]+|_|-)+(\.(([0-9a-zA-Z]|-|_|\/|\?|=|&)+))+/i";
    preg_match_all ($er, $texto, $match);
    
    foreach ($match[0] as $link)
    {
        //coloca o 'http://' caso o link não o possua
        $link_completo = (stristr($link, "http://") === false) ? "http://" . $link : $link;
        
        $link_len = strlen ($link);
        
        
        //troca "&" por "&", tornando o link válido pela W3C


       if (stristr($link, "http://i.img") === false) {
       $web_link = str_replace ("&", "&amp;", $link_completo);
       $texto = str_ireplace ($link, "<a href=\"" . $web_link . "\" target=\"_blank\">". (($link_len > 60) ? substr ($web_link, 0, 25). "...". substr ($web_link, -15) : $web_link) ."</a>", $texto);
    
	}
    }
    
    return $texto;
    
}

?>
<center>
<BR>


     <a name="anc"></a> 

<? if (!$id) {

include("tops_site.php"); 

echo "<BR>";
}
?>

<?
$dbh=error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);mysql_connect ("$MySql_host", "$MySql_login", "$MySql_senha") or print ('Erro ao tentar conectar ao banco de dados' . mysql_error());
mysql_select_db ("$MySql_db"); 

?>

<centeR>
<table width=900 style='border:0px;'> <tr style='background:transparent;'> <td valign=top>
	<div id=mostrar>
<?PHP

if ($news) { $id= $news; }

if (!$id){
$idi="";
$lista = 10;
$br="";
}
elseif ($id == 'all') {
$idi="";
$lista = mysql_num_rows(mysql_query("SELECT id FROM $tabela_news"));
$br="";
}
else {
$idi ="where id=$id"; 
$lista = 1;
$br = "height=250";
}

$lista = mysql_num_rows(mysql_query("SELECT id FROM $tabela_news"));

$query = "SELECT id, date_format(data, '%d/%m/%Y') as data_formatada, titulo, noticia, user, dias_promo FROM $tabela_news $idi order by id desc";
$result = mysql_query( $query );

for($i=0;$i < 3;++$i)
{
$row = mysql_fetch_array($result);

$color = '';
if ($row[dias_promo] > 0 ){
$color = "color = yellow";
}

echo "<table cellspacing='0' width=573>
	<thead>
		<tr>
      		  <th><font size=2 $color>$row[data_formatada] - $row[titulo]</font><br></td>
		</tr>
	</thead>

    	<tr style='background:#eee;'border-bottom-right-radius: 7px;border-bottom-left-radius: 7px;'>
      		<td>";

		$noticia = nl2br($row[noticia]);
		$noticia = $noticia;

		echo "<font size=2>$noticia</font>";

echo "</td>
   </table><br>
";

}

echo "</div></td><td valign=top>
	<table cellspacing='0'>
	<thead>
		<tr>
      		  <th>Todas Notícias</td>
		</tr>
	</thead>

";

$result = mysql_query( $query );

$lista = 30;

for($i=0;$i < $lista;++$i)
{
$row = mysql_fetch_array($result);

echo " 	  <tr>
      		<th style='text-align:left;'><a href='#anc' onclick='getn($row[id])';>$row[data_formatada] - $row[titulo]</a></td>
    	  </tr>


";

}

echo 	"</table></table>";

?>

<script type="text/javascript">

function getn(news){

$.get('noticias_ver.php?news=' + news,{ num: Math.random() }, function(resultado){
$('#mostrar').empty().html(resultado);
})

}
</script>


</div>
