<?php
if ($ctl_cd == 0) { 
$ctl_cod = "<font color=green>Normal</font>"; }

elseif ($ctl_cd == 1) { 
$ctl_cod = "<font color=red>Bloqueado</font>"; }

if ($ctl_cd == 0 and $nivel==1) { 
$ctl_cod = "<font color=blue>HELP</font>"; }

elseif ($ctl_cd == 8) { 

if ($nivel==5) {
$ctl_cod = "<font color=blue>ADM</font>"; }

elseif ($nivel==4) {
$ctl_cod = "<font color=blue>S-ADM</font>"; }

elseif ($nivel==3) {
$ctl_cod = "<font color=blue>GM</font>"; }

elseif ($nivel==2) {
$ctl_cod = "<font color=blue>SUB-GM</font>"; }

else {
$ctl_cod = "<font color=blue>SUB-GM</font>"; }

}


//status editar char painel adm
///////////////////////////////////////////////////
if ($ctlco == 0) { 
$ctlc = "Normal"; }

elseif ($ctlco == 1) { 
$ctlc = "Bloqueado"; }

elseif ($ctlco == 8) { 
$ctlc = "Game Master";}

else {
$ctlc = "Normal"; }

//status editar char painel adm
///////////////////////////////////////////////////

if ($niv==3) {
$nivel_gm = "ADM"; }

elseif ($niv==2) {
$nivel_gm = "GM</font>"; }

elseif ($niv==1) {
$nivel_gm = "SUB-GM"; }

else {
$nivel_gm = "Normal Player"; }


?>