<?php

$option1= "Increase Zen After Hunt 40%";
$option2= "Defense Success Rate 10%";
$option3= "Reflect Damage 5%";
$option4= "Damage Decrease 4%";
$option5= "Increase Mana 4%";
$option6= "Increase HP 4%";

$option7= "Increases Mana After Monster +mana/8";
$option8= "Increases Life After Monster +mana/8";
$option9= "Increase Attacking(wizardry) Speed +7";
$option10= "Increase Damage +2%";
$option11= "Increase Damage + Level/20 ";
$option12= "Excellent Damage Rate +10%";

$option13= "HP Increase";
$option14= "MP Increase";
$option15= "Ignore Oponent Defense Power 3%";
$option16= "Max Stamina Increase";
$option17= "Increase Attack(wizardry) Speed +5";

if ($codigo > '1099' and $codigo <'1200'){
$opt1 = $option1;
$opt2 = $option2;
$opt3 = $option3;
$opt4 = $option4;
$opt5 = $option5;
$opt6 = $option6;
if(!$tipo1){
$tipo1 =  "<center><font size=4><b>Set's:</B></font>";
echo "$tipo1<br>";}}

if ($codigo > '1200' and $codigo <'1300'){
$opt1 = $option7;
$opt2 = $option8;
$opt3 = $option9;
$opt4 = $option10;
$opt5 = $option11;
$opt6 = $option12;
if(!$tipo2){
$tipo2 =  "<center><font size=4><b>Machados(Axes):</B></font>";
echo "$tipo2<br>";}}

if ($codigo > '1300' and $codigo <'1400'){
$opt1 = $option7;
$opt2 = $option8;
$opt3 = $option9;
$opt4 = $option10;
$opt5 = $option11;
$opt6 = $option12;
if(!$tipo3){
$tipo3 =  "<center><font size=4><b>Arcos(Bows,CrossBow):</B></font>";
echo "$tipo3<br>";}}

if ($codigo > '1400' and $codigo <'1500'){
$opt1 = $option7;
$opt2 = $option8;
$opt3 = $option9;
$opt4 = $option10;
$opt5 = $option11;
$opt6 = $option12;
if(!$tipo4){
$tipo4 =  "<center><font size=4><b>Maces:</B></font>";
echo "$tipo4<br>";}}

if ($codigo > '1500' and $codigo <'1503'){
$opt1 = $option1;
$opt2 = $option2;
$opt3 = $option3;
$opt4 = $option4;
$opt5 = $option5;
$opt6 = $option6;
if(!$tipo5){
$tipo5 =  "<center><font size=4><b>Acessórios:</B></font>";
echo "$tipo5<br>";}}

if ($codigo >= '1503' and $codigo <'1505'){
$opt1 = $option7;
$opt2 = $option8;
$opt3 = $option9;
$opt4 = $option10;
$opt5 = $option11;
$opt6 = $option12;
if(!$tipo5){
$tipo5 =  "<center><font size=4><b>Acessórios:</B></font>";
echo "$tipo5<br>";}}

if ($codigo >= '1505' and $codigo <'1510'){
$opt1 = $option1;
$opt2 = $option2;
$opt3 = $option3;
$opt4 = $option4;
$opt5 = $option5;
$opt6 = $option6;
if(!$tipo5){
$tipo5 =  "<center><font size=4><b>Acessórios:</B></font>";
echo "$tipo5<br>";}}

if ($codigo > '1599' and $codigo <'1700'){
$opt1 = $option1;
$opt2 = $option2;
$opt3 = $option3;
$opt4 = $option4;
$opt5 = $option5;
$opt6 = $option6;
if(!$tipo6){
$tipo6 =  "<center><font size=4><b>Escudos(Shilds):</B></font>";
echo "$tipo6<br>";}}

if ($codigo > '1700' and $codigo <'1800'){
$opt1 = $option7;
$opt2 = $option8;
$opt3 = $option9;
$opt4 = $option10;
$opt5 = $option11;
$opt6 = $option12;
if(!$tipo7){
$tipo7 =  "<center><font size=4><b>Cajados(Staff's):</B></font>";
echo "$tipo7<br>";}}

if ($codigo > '1800' and $codigo <'1900'){
$opt1 = $option7;
$opt2 = $option8;
$opt3 = $option9;
$opt4 = $option10;
$opt5 = $option11;
$opt6 = $option12;
if(!$tipo8){
$opt1 = $option7;
$opt2 = $option8;
$opt3 = $option9;
$opt4 = $option10;
$opt5 = $option11;
$opt6 = $option12;
$tipo8 =  "<center><font size=4><b>Espadas(Swords):</B></font>";
echo "$tipo8<br>";}}

if ($codigo > '1900' and $codigo <'2000'){
$opt1 = $option13;
$opt2 = $option14;
$opt3 = $option15;
$opt4 = $option16;
$opt5 = $option17;
$opt6 = '';
if(!$tipo9){
$tipo9 =  "<center><font size=4><b>Asas(wings):</B></font>";
echo "$tipo9<br>";}}

?>