<?
$comeco = "<br>
<table width=750 cellspacing=0 class='text_default' style='text-align:justify; padding:5px 10px 5px 10px; border:1px dashed black;'><tr><td><img src=img/loginho.png></td><td><b>";
$fim = "</td><td valign=top width=23><a href=?msg_viu=ok><img src=img/2.png></a></td></tr></table>"; 


if ($num_msg == 1) {
$msgstaff= "$comeco Bem vindo! </b><br> Não esqueça de ver a lista de comandos que você pode usar in-game no site principal. $fim";
}
elseif ($num_msg == 2) {
$msgstaff= "$comeco Cuidado!</b><br> Nunca pedimos senhas, não acredite em engraçadinhos que ficam oferencendo GM. $fim";
}
elseif ($num_msg == 3) {
$msgstaff= "$comeco Dica!</b><br> Se você estiver com problemas onde o jogo fica lento e travando procure baixar o driver de vídeo do seu pc, qualquer dúvida envie um suporte. $fim";
}
elseif ($num_msg == 4) {
$msgstaff= "$comeco Cuidado!</b><br> Nunca empreste sua conta e senha para ninguém, se emprestar a responsabilidade será sua. $fim";
}
elseif ($num_msg == 5) {
$msgstaff= "$comeco Dica!</b><br> Você pode comprar créditos usando cartão de crédito, boleto ou tranferência usando o PAGSEGURO. $fim";
}
elseif ($num_msg == 6) {
$msgstaff= "$comeco Dica!</b><br> Sempre que depositar, mesmo que seja pelo PAGSEGURO ou pelo PayPal, confirme seu pagamento pelo painel para que possamos adicionar seus créditos o mais breve possível. $fim";
}
elseif ($num_msg == 7) {
$msgstaff= "$comeco Dica!</b><br> A cada 12 horas conectado no jogo você ganha 1 dia vip! $fim";
}
elseif ($num_msg == 8) {
$msgstaff= "$comeco Dica!</b><br> Qualquer dúvida sobre o jogo, eventos, problemas com gms, não deixe de enviar um suporte para a administração. $fim";
}
else {
$msgstaff= "";
}
?>