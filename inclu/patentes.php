<?php
if (($patente_num > 29 and $patente_num < 50)) {
$patente = Guerreiro;
$img = guerreiro;
}
elseif (($patente_num > 49 and $patente_num < 100)) {
$patente = Estrategista;
$img = estrategista;
}
elseif (($patente_num > 99 and $patente_num < 200)) {
$patente = Gladiador;
$img = gladiador;
}
elseif (($patente_num > 199 and $patente_num < 300)) {
$patente = Sanguinário;
$img = sanguinario;
}
elseif (($patente_num > 299 and $patente_num < 400)) {
$patente = Assassino;
$img = assassino;
}
elseif (($patente_num > 399 and $patente_num < 500)) {
$patente = 'Rei Trevas';
$img = reidastrevas;
}
elseif (($patente_num > 499 and $patente_num < 1000)) {
$patente = 'Membro MK';
$img = membromk;
}
elseif (($patente_num > 999 and $patente_num < 2000)) {
$patente = 'Vingador';
$img = vingador;
}
elseif (($patente_num > 1999 and $patente_num < 3000)) {
$patente = 'Herói';
$img = hero;
}
elseif (($patente_num > 2999 and $patente_num < 5000)) {
$patente = 'Rei Supremo';
$img = king;
}
elseif (($patente_num > 4999 and $patente_num < 7000)) {
$patente = 'Mito';
$img = mito;
}
elseif (($patente_num > 6999 and $patente_num <12000)) {
$patente = 'Mestre Trevas';
$img = mestretrevas;
}
elseif (($patente_num > 11999 and $patente_num <17000)) {
$patente = 'Justiceiro';
$img = darkdefender;
}
elseif (($patente_num > 16999 and $patente_num <23000)) {
$patente = 'Mercenário';
$img = mercenario;
}
elseif (($patente_num > 22999 and $patente_num <28000)) {
$patente = 'Bárbaro';
$img = barbaro;
}
elseif (($patente_num > 27999 and $patente_num <33000)) {
$patente = 'Guardião';
$img = guardiao;
}
elseif (($patente_num > 32999 and $patente_num <40000)) {
$patente = 'Majestoso';
$img = majestoso;
}
elseif (($patente_num > 39999 and $patente_num <50000)) {
$patente = 'Supremo';
$img = supremo;
}
elseif ($patente_num > 49999 and $patente_num <75000) {
$patente = 'Divino';
$img = divino;
}
elseif ($patente_num > 74999 and $patente_num <100000) {
$patente = 'Demônio';
$img = demonio;
}
elseif ($patente_num > 99999 and $patente_num <125000) {
$patente = 'Titã';
$img = tita;
}
elseif ($patente_num > 124999 and $patente_num <200000) {
$patente = 'Imortal';
$img = imortal;
}
elseif ($patente_num > 199999 and $patente_num <250000) {
$patente = 'Dragon Slyer';
$img = dragonslayer;
}
elseif ($patente_num > 249000 and $patente_num <300000) {
$patente = 'Lunático';
$img = lunatico;
}
elseif ($patente_num > 299999) {
$patente = 'Lenda';
$img = lenda;
}
else {
$patente = NooB;
$img = noob;
}
if ($patenten==1) {
$img = guerreiro;
}
if ($patenten==2) {
$img = estrategista;
}
if ($patenten==3) {
$img = gladiador;
}
if ($patenten==4) {
$img = sanguinario;
}
if ($patenten==5) {
$img = assassino;
}
if ($patenten==6) {
$img = reidastrevas;
}
if ($patenten==7) {
$img = membromk;
}
if ($patenten==8) {
$img = vingador;
}
if ($patenten==9) {
$img = hero;
}
if ($patenten==10) {
$img = king;
}
if ($patenten==11) {
$img = mito;
}
if ($patenten==12) {
$img = mestretrevas;
}
if ($patenten==13) {
$img = darkdefender;
}
if ($patenten==14) {
$img = mercenario;
}
if ($patenten==15) {
$img = barbaro;
}
if ($patenten==16) {
$img = guardiao;
}
if ($patenten==17) {
$img = majestoso;
}
if ($patenten==18) {
$img = supremo;
}
if ($patenten==19) {
$img = divino;
}
if ($patenten==20) {
$img = demonio;
}
if ($patenten==21) {
$img = tita;
}
if ($patenten==22) {
$img = imortal;
}
if ($patenten==23) {
$img = dragonslayer;
}
if ($patenten==24) {
$img = lunatico;
}
if ($patenten==25) {
$img = lenda;
}
?>