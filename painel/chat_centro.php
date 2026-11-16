<script language="Javascript" type="text/javascript">
function limitTextArea(mf,cf,m) {

if (mf.value.length>m) {

mf.value=mf.value.substring(0,m);

}else{

if(cf!=null){cf.value=m-mf.value.length;
}
}
}

function stopEvent(event) {
        if (event.preventDefault) {
                event.preventDefault();
                event.stopPropagation();
        } else {
                event.returnValue = false;
                event.cancelBubble = true;
        }
}

function areaEnvia(obj, evt) {
        var e = evt || event;
        var k = e.keyCode;
        
        if(k == 13) { //verifica se teclou enter
                if(!e.shiftKey) {
                        if(obj.form)
                                obj.form.submit();
                        
                        stopEvent(e);
                }
        }
}

function addText(f){
document.getElementById('obs').value+=f;
}

</script>

<script src="inclu/jquery.min.js"></script> 

<style type="text/css">
<!--
td div .teste2 {
color:#FF0000; 
padding:5px; 
width:730px; 
height:500px; 
overflow:auto; 
scrollbar-arrow-color:#000000;
scrollbar-3dlight-color:#000000;
scrollbar-highlight-color:#FFFACD;
scrollbar-face-color:#FFFACD;
scrollbar-shadow-color:#000000;
scrollbar-darkshadow-color:#FFFFFF;
scrollbar-track-color:#ffffff;
}
-->

.redondo_avatar {
   background-color: #363636;
   color: #FFF;
 
   /* Agora a mágica */
   border-radius: 50%;
}
</style>

<center><bR><BR><font size=3><b> CHAT DO SERVIDOR <bR><BR>

<?PHP
require_once("inclu/config.php");
require("inclu/cookie.php");

if($_GET[post]){
$char = stripslashes($_POST['charp']);
$obs  = stripslashes($_POST['obs']);
$obs = str_replace("<", "", "$obs");
$obs  = utf8_encode($obs);

$result_c = mssql_query( "select AccountLevel, tempo_chat from memb_info where memb___id = '$login'" );
$row_c = mssql_fetch_row($result_c);

if ($row_c[0] == 1) { 
$taxa = "0"; }
if ($row_c[0] == 2) { 
$taxa = "0"; }
if ($row_c[0] == 0) { 
$taxa = "1"; }


$conta_check  = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$char' and accountid='$login'"));
//$conta_check2 = mssql_num_rows(mssql_query("Select name FROM Character WHERE Name = '$char' and accountid='$login' and pontos >= '$taxa'"));
$conta_check3 = mssql_num_rows(mssql_query("Select msg FROM mk_chat WHERE Name = '$char' and login='$login' and id_chat = (select max(id_chat)from MK_chat where login='$login') and msg='$obs'"));
$conta_check4 = mssql_num_rows(mssql_query("Select resetcount FROM character WHERE accountid='$login' and resetcount > 20 " ));

if 	(empty($char) or $obs=='Postar Mensagem' or empty($obs)) { echo ""; }
elseif 	($conta_check  <= 0) 	{ echo "<center><font size=3 color=red>Esse Personagem não pertece a conta $login.</font><bR><Br>";}
//elseif  ($conta_check2 <= 0) 	{ echo "<center><font size=3 color=red>Esse Personagem não tem Golds suficientes para enviar uma mensagem!</font><bR><Br>";}
elseif  ($conta_check3 > 0) 	{ echo "<center><font size=3 color=red>Você já enviou essa mensagem recentemente!</font><bR><Br>";}
//elseif  ($conta_check4 <= 0) 	{ echo "<center><font size=3 color=red>Pelo menos 1 Personagem da sua conta deve ter mais de 20 resets!</font><bR><Br>";}
//elseif  ($row_c[1] > 0) 	{ echo "<center><font size=3 color=red>Você deve aguardar $row_c[1] minuto(s) para enviar outra mensagem!</font><bR><Br>";}

else {

$msquery = "INSERT INTO mk_chat ( login,name,msg ) values ('$login','$char','$obs')";
	$msresults= mssql_query($msquery);

//$update= mssql_query("UPDATE character set pontos=pontos-$taxa where name='$char' and accountid='$login'");
$update= mssql_query("UPDATE memb_info set tempo_chat='$taxa' where memb___id='$login'");

//echo "<center><font size=3 color=green>Mensagem enviada com Sucesso!!</font><bR><Br>";

}

}

?>

<table width=720 style='border:0;'><tr><td><center> <div id='atuchat'> <Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><img src=img/carregando.gif><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br><Br>

</div>
</td>
  </tr>
</table><br><br>
<table cellspacing=0><tr>
<td><a href="javascript:addText(' :) ')">  <img src=img/emo/biggrin.png>	</a></td> <td> :)  </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' /o/ ');"><img src=img/emo/dancing4dh.gif>	</a></td> <td> /o/ </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' Oo ');"> <img src=img/emo/omg-msn-smiley.gif>		</a></td> <td> Oo  </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' kkk ');"><img src=img/emo/rindo.gif>		</a></td> <td> kkk </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' :~ ');"> <img src=img/emo/at-wits-end-yahoo-emoticon.gif>		</a></td> <td> :~  </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' :- ');"> <img src=img/emo/angry-skype-smiley.gif>		</a></td> <td> :-  </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' :D ');"> <img src=img/emo/baeh-smiley.gif>		</a></td> <td> :D  </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' :( ');"> <img src=img/emo/broken-heart-yahoo-emoticon.gif>		</a></td> <td> :(  </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' :@ ');"> <img src=img/emo/big-smile2-smiley.gif>		</a></td> <td> :@  </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' :´( ');"> <img src=img/emo/crying-yahoo-emoticon.gif>		</a></td> <td> :´(   </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>
<td><a href="javascript:addText(' :´o ');"> <img src=img/emo/baby-smiley.gif>		</a></td> <td> :´o   </td> <td> &nbsp;&nbsp;&nbsp;&nbsp;  </td>

</tr></table>

<form name=form method='post' action='?post=ok'>
<table><tr><td align=right><table><tr><td>

<?

$sql_char_check = mssql_query("SELECT Name FROM Character WHERE AccountID = '$login' order by resetcount desc,clevel desc"); 
$char_check = mssql_num_rows($sql_char_check); 

if ($char_check <= 0) { 
echo "<br><bR><b>Você precisa criar um Personagem para poder enviar mensagens!"; 
} else {
echo "<select name='charp' id='charp' style='width:100;'>";
for ($i=0;$i<$char_check; ++$i) {
$row = mssql_fetch_row($sql_char_check);

$sele ='';
if ($row[0]==$_POST[charp]) $sele= 'selected'; 

echo "<option $sele> $row[0]</option>";
}

?>

</select></td></tr><tr><td>
<input disabled name="_COUNTER_FIELD_mensagem" size="3" value="140" style='width:100; text-align:center;'></td></tr></table>
</td><td>
<textarea rows=3 cols = 93 name='obs' id='obs' style='border:1px solid #c9c9c9;height: 50px;' onKeyDown="limitTextArea(this, this.form._COUNTER_FIELD_mensagem, 140); areaEnvia(this, event);" onKeyUp="limitTextArea(this, this.form._COUNTER_FIELD_mensagem, 140);"></textarea>
</td>

<td>
<table><tr><td><input type='submit' value='Atualizar' style='width:100;'></td></tr>
<tr><td><input type='submit' value='Enviar' style='width:100;'></td></tr></table>
</td></tr>
<tr><td></td><td colspan=2><table width=80%><tr><td> <b><div id=atuqtd><? echo $qtd_chat2;?> Usuários Online </div>  </b> &nbsp;&nbsp; </td><td valign=top align=right><B>  </td><td valign=top ><br></td></tr></table>

 </td></tr></table>
</form>

<?php 

}?>

<script type="text/javascript">
$(document).ready(function(){
atualiza();
});

function atualiza(){
$.get('chat_atu.php',{ num: Math.random() }, function(resultado){
$("#atuchat").append().html(resultado);
})

setTimeout('atualiza()', 40000);

}
</script> 