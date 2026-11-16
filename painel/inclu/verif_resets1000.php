<?php
$resets_check = mssql_query("SELECT accountid FROM character WHERE accountid = '$login' and resets>999"); 
$resets_check2 = mssql_num_rows($resets_check); 

if ($resets_check2<=0) {
die("<font color=$font_color1><br><br><br><br><b>Pelo menos 1 personagem da sua conta precisa ter mais de 1000 resets para usar essa opção.");}

?>