<?php
$qs = !empty($_SERVER['QUERY_STRING']) ? '&' . $_SERVER['QUERY_STRING'] : '';
header("Location: site.php?p=ranking" . $qs);
exit();
?>
