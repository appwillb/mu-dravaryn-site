<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

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

<center><bR><BR><font size=3><b> MUDAR NOME <bR><BR>

<?
require_once("inclu/config.php");
require("inclu/cookie.php");
require("inclu/verif_vip.php"); 
require("inclu/verif_resets20.php");
?>

  <table width="400" border="0" cellspacing="2" cellpadding="3" bordercolor=#333333>
    <tr>
      <td valign="top"><div align="center"><font size=2>
<?PHP

$id = stripslashes($_POST['id']);
$character1 = stripslashes($_POST['character']);
$character = str_replace(" ", "", "$character1");
$pwd = $psw;

$badword = array(";","'","=","\"","*","union","del","DEL","insert","update","drop","sele","$","webzen","<",">","@","$","&","¨","%","?"); 

  foreach($badword as $words) 
    if(substr_count($character, $words) > 0) 
      die("<font color='orange'>Algumas letras não podem ser utilizadas, como:<br>
 #,$,%,Espaço,;,:,\,<,> <br><BR>
E outras mais, caso queira mudar o nome e não esteja conseguindo entre em contato pelo site que resolveremos o problema."); 


if (empty($id)) 
	{
    echo "<br><center><b>Campos em Branco. Volte e tente novamente.</b><br>";
	}

elseif (preg_match("[^0-9]", $id))
{ 
echo "<br><center><b>Selecione um personagem!</b><br>";
}

else {

if ($id==1) {$GameID = GameID1;}
elseif ($id==2) {$GameID = GameID2;}	
elseif ($id==3) {$GameID = GameID3;}
elseif ($id==4) {$GameID = GameID4;}
elseif ($id==5) {$GameID = GameID5;}
else {echo "<br><center><font color='orange'>Coloque um ID correto.";}


$ON = "Select ConnectStat FROM MEMB_STAT WHERE memb___id='$login'";
$ON2 = mssql_query( $ON );
$ON3 = mssql_fetch_row($ON2);

$gm_check   = mssql_num_rows(mssql_query("Select Name FROM Character where accountid='$login' and nivel_gm>0"));

$verefi = strtolower($character);
$badwords2 = array("webzen","adm","gm","sub");

  foreach($badwords2 as $word2) 
    if(substr_count($verefi, $word2) > 0 and $gm_check <= 0) 
      die("<br><Br><center><b><br>Você não pode colocar nick com a palavra GM e ADM no meio"); 

$sql_name_get = mssql_query("SELECT $GameID FROM AccountCharacter WHERE Id='$login'"); 
$name_get = mssql_fetch_row( $sql_name_get );


$username_check = mssql_num_rows(mssql_query("SELECT memb___id FROM MEMB_INFO WHERE memb___id='$login' AND memb__pwd='$pwd'"));
$name_check 	= mssql_num_rows(mssql_query("Select Name FROM Character WHERE Name = '$character'"));
$null_check 	= mssql_num_rows(mssql_query("Select $GameID FROM accountcharacter WHERE id='$login' and $GameID=null"));
$guild_check	= mssql_num_rows(mssql_query("Select Name FROM guildmember WHERE Name = '$name_get[0]'"));
$guild_check2	= mssql_num_rows(mssql_query("Select G_Name FROM guild WHERE G_Name = '$name_get[0]'"));
$gold_check 	= mssql_num_rows(mssql_query("SELECT goblinpoint FROM CashShopdata where accountid = '$login' and goblinpoint > 99")); 

echo "<font color=$font_color1>";

if (empty($login) || empty($pwd) || empty($id) || empty($character)) 
	{
    echo "<center><b><br>Todos os campos estão em branco. Volte e tente novamente.<br>";
	}

elseif ($username_check <= 0)
	{ 
        echo "<center><b><br>Seu login nao exite em nosso banco de dados ou a senha esta incorreta.<br>"; 
	}

elseif ($ON3[0] == 1){ 
echo "<center><b><br>Você está conectado no jogo. Saia e tente novamente!!!<br>"; }

elseif ($gold_check <= 0){ 
echo "<BR><b>Você não tem golds suficientes.<br>"; }

elseif ($null_check == 1){ 
echo "<center><b><br>Não tem nenhum char na posição escolhida, escolha outro e tente novamente.<br>"; }

elseif ($name_check > 0)
	{
echo "<center><b><br>O nome que você escolheu ja exite, escolha outro!";
}

elseif ($guild_check > 0){ 
echo "<center><b><br>Esse char é membro de alguma GUILD, saia da guild antes de mudar o nome!!!<br>"; }

//elseif ($guild_check2 > 0){ 
//echo "<center><b><br>Você não pode mudar o nome desse char pois possui uma guild com esse nome!!!<br>"; }

else 
	{

	mssql_query("UPDATE CashShopData SET goblinpoint = goblinpoint - 100 where accountid = '$login'");

$result= mssql_query("WZ_RenameCharacter \"$login\",\"$name_get[0]\",\"$character\"");

	echo "<font color=$font_color2><br><center>O Personagem <b>$name_get[0]</B> Agora é <B>$character</b>.";

$ip = $_SERVER["REMOTE_ADDR"]; 

$msquery = "INSERT INTO LOG_Nome ( login,novo,antigo,ip ) values ('$login','$character','$name_get[0]','$ip' )";
$msresults= mssql_query($msquery);

$msquery = "INSERT INTO MK_Murkut_news ( nome,valor,tipo ) values ('$name_get[0]','$character','4' )";
$msresults= mssql_query($msquery);

	}
}

?>
     <BR><BR> </div></td>
    </tr>
  </table>
</div>
