<?php

if ($gens_family==1)
{

if (($gens_num >= 0 and $gens_num < 500)) {
$gens_patente 	= 'Confidencial';
$img_gens 	= d14;
}
elseif (($gens_num >= 500 and $gens_num < 1500)) {
$gens_patente 	= 'Sargento';
$img_gens 	= d13;
}
elseif (($gens_num >= 1500 and $gens_num < 3000)) {
$gens_patente 	= 'Tenente';
$img_gens 	= d12;
}
elseif (($gens_num >= 3000 and $gens_num < 6000)) {
$gens_patente 	= 'Oficial';
$img_gens 	= d11;
}
elseif (($gens_num >= 6000 and $gens_num < 10000)) {
$gens_patente 	= 'Capitão';
$img_gens 	= d10;
}
elseif (($gens_num >= 10000)) {
if ($gens_rank == 1) {
$gens_patente 	= 'Gran Duque';
$img_gens 	= d1;
}
elseif ($gens_rank >= 2 and $gens_rank <= 5) {
$gens_patente 	= 'Duque';
$img_gens 	= d2;
}
elseif ($gens_rank >= 6 and $gens_rank <= 10) {
$gens_patente 	= 'Marquês';
$img_gens 	= d3;
}
elseif ($gens_rank >= 11 and $gens_rank <= 30) {
$gens_patente 	= 'Conde';
$img_gens 	= d4;
}
elseif ($gens_rank >= 31 and $gens_rank <= 50) {
$gens_patente 	= 'Visconde';
$img_gens 	= d5;
}
elseif ($gens_rank >= 51 and $gens_rank <= 100) {
$gens_patente 	= 'Barão';
$img_gens 	= d6;
}
elseif ($gens_rank >= 101 and $gens_rank <= 200) {
$gens_patente 	= 'Elite';
$img_gens 	= d7;
}
elseif ($gens_rank >= 200 and $gens_rank <= 300) {
$gens_patente 	= 'Marechal';
$img_gens 	= d8;
}
else {
$gens_patente 	= 'General';
$img_gens 	= d9;
}
}
}

if ($gens_family==2)
{

if (($gens_num >= 0 and $gens_num < 500)) {
$gens_patente 	= 'Confidencial';
$img_gens 	= v14;
}
elseif (($gens_num >= 500 and $gens_num < 1500)) {
$gens_patente 	= 'Sargento';
$img_gens 	= v13;
}
elseif (($gens_num >= 1500 and $gens_num < 3000)) {
$gens_patente 	= 'Tenente';
$img_gens 	= v12;
}
elseif (($gens_num >= 3000 and $gens_num < 6000)) {
$gens_patente 	= 'Oficial';
$img_gens 	= v11;
}
elseif (($gens_num >= 6000 and $gens_num < 10000)) {
$gens_patente 	= 'Capitão';
$img_gens 	= v10;
}
elseif (($gens_num >= 10000)) {
if ($gens_rank == 1) {
$gens_patente 	= 'Gran Duque';
$img_gens 	= v1;
}
elseif ($gens_rank >= 2 and $gens_rank <= 5) {
$gens_patente 	= 'Duque';
$img_gens 	= v2;
}
elseif ($gens_rank >= 6 and $gens_rank <= 10) {
$gens_patente 	= 'Marquês';
$img_gens 	= v3;
}
elseif ($gens_rank >= 11 and $gens_rank <= 30) {
$gens_patente 	= 'Conde';
$img_gens 	= v4;
}
elseif ($gens_rank >= 31 and $gens_rank <= 50) {
$gens_patente 	= 'Visconde';
$img_gens 	= v5;
}
elseif ($gens_rank >= 51 and $gens_rank <= 100) {
$gens_patente 	= 'Barão';
$img_gens 	= v6;
}
elseif ($gens_rank >= 101 and $gens_rank <= 200) {
$gens_patente 	= 'Elite';
$img_gens 	= v7;
}
elseif ($gens_rank >= 200 and $gens_rank <= 300) {
$gens_patente 	= 'Marechal';
$img_gens 	= v8;
}
else {
$gens_patente 	= 'General';
$img_gens 	= v9;
}
}
}


?>