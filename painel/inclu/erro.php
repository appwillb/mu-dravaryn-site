<?PHP
error_reporting(E_ALL & ~ E_NOTICE);

// Configs mensagens

if 	($MESSAGE_TIPO == 1) 
	{ 
	$CONFIG_img_erro = "icon_interrogacao.png";
	}
elseif 	($MESSAGE_TIPO == 2) 
	{ 
	$CONFIG_img_erro = "icon_exclamacao.png";
	}
elseif 	($MESSAGE_TIPO == 3) 
	{ 
	$CONFIG_img_erro = "icon_bandeira.png";
	}
elseif 	($MESSAGE_TIPO == 4) 
	{ 
	$CONFIG_img_erro = "icon_add.png";
	}
elseif 	($MESSAGE_TIPO == 6) 
	{ 
	$CONFIG_img_erro = "icon_exclamacao2.png";
	}
else 	{ 
	$CONFIG_img_erro = "icon_erro.png";
	}

$CONFIG_erro_inicio = "<center><table background = '/img/fundo_msg.png' width=700 height=100 border=0><tr><td width=100 align=center><img src=img/$CONFIG_img_erro> </td> <td>$MESSAGE_ERRO";
$CONFIG_erro_fim    = "</td></tr></table>";

$CONFIG_paginas_inicio = "<br><br>
<table width=600 cellspacing=0 class='text_default' style='text-align:justify; padding:5px 5px 5px 5px; border:1px dashed gray;'><tr><td width=100><img src=" . CLASSTPATH . "/img/$CONFIG_img_erro></td><td style='text-align:left;'><b>";
$CONFIG_paginas_fim    = "</td></tr></table><br><br><br><br><br><br><br><br><br><br>";

$CONFIG_paginas_inicio2 = "
<table width=600 cellspacing=0 class='text_default' style='text-align:justify; padding:5px 5px 5px 5px; border:1px dashed gray;'><tr><td width=100><img src=" . CLASSTPATH . "/img/$CONFIG_img_erro></td><td style='text-align:left;'><b>";


?>