<?php
if ($pk_level > 0 and $pk_level < 3) {
$pk = "Herói"; }

elseif ($pk_level > 2 and $pk_level < 4) {
$pk = "Normal"; }

elseif ($pk_level > 3 and $pk_level < 7) {
$pk = "Assassino"; }

else{
$pk = "Normal"; }

?>