<?php
$resets_check = mssql_query("SELECT accountid FROM character WHERE accountid = '$login' and resets>150"); 
$resets_check2 = mssql_num_rows($resets_check); 

if ($resets_check2<=0) {
echo "<br><br><font color=red size=2>Pelo menos 1 personagem da sua conta precisa<br> ter mais de 150 resets para usar essa opção.";

$verificado= 'False';

}

else {

$verificado= 'True';

}

?>