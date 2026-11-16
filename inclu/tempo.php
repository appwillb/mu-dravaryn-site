<?php
$segundos = $min * 60;
$Horas2 = bcdiv($segundos, 3600, 0);
$Horas = $segundos / 3600 ; 
$soma1 = $Horas * 3600;
$Minutos = ($segundos - $soma1) / 60 ;
$Minutos2 = (($segundos-($Horas * 3600))/60);

$str = "$segundos";
$h = date("H", mktime(0,0,$str,1,1,2000)); 
$m = date("i", mktime(0,0,$str,1,1,2000));

$H2 = '0';
if ( $min > 1439) {
$H2 = '24';}
if ( $min > 2879) {
$H2 = '48';}
if ( $min > 4319) {
$H2 = '72';}
if ( $min > 5759) {
$H2 = '96';}
if ( $min > 7199) {
$H2 = '120';}
if ( $min > 8639) {
$H2 = '144';}
if ( $min > 10079) {
$H2 = '168';}
if ( $min > 11519) {
$H2 = '192';}
if ( $min > 12959) {
$H2 = '216';}
if ( $min > 14399) {
$H2 = '240';}
if ( $min > 15839) {
$H2 = '264';}
if ( $min > 17279) {
$H2 = '288';}
if ( $min > 18719) {
$H2 = '312';}
if ( $min > 20159) {
$H2 = '336';}
if ( $min > 21599) {
$H2 = '360';}
if ( $min > 23039) {
$H2 = '384';}
if ( $min > 24479) {
$H2 = '408';}
if ( $min > 25919) {
$H2 = '432';}
if ( $min > 27359) {
$H2 = '456';}
if ( $min > 28799) {
$H2 = '480';}
if ( $min > 30239) {
$H2 = '504';}
if ( $min > 31679) {
$H2 = '528';}
if ( $min > 33119) {
$H2 = '552';}
if ( $min > 34559) {
$H2 = '576';}
if ( $min > 35999) {
$H2 = '600';}
if ( $min > 37439) {
$H2 = '624';}
if ( $min > 38879) {
$H2 = '648';}
if ( $min > 40319) {
$H2 = '672';}
if ( $min > 41759) {
$H2 = '696';}

$H3= $h + $H2;

?>