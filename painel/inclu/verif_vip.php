<?php
$vip_check = mssql_query("SELECT memb___ID FROM memb_info WHERE memb___id = '$login' and accountlevel>0"); 
$vip_check2 = mssql_num_rows($vip_check); 

if ($vip_check2<=0) {
die("<font color=$font_color1><br><br><br><br><b>Você não é VIP.<bR> Você pode adquirir um plano VIP no shopping X dentro do jogo.<bR><bR>");}

?>