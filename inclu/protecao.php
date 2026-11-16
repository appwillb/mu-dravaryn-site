<?php
require_once(dirname(__FILE__) . '/compat.php');

// Begin

/*

    The muonline xweb base injection filter script

        Mssql Injection Filter, Includes arrays

-----------------------------------------------------------------

           Changelog: mu.vachev.net?mod=xweb

*/



function xw_sanitycheck($str){

    if(strpos(str_replace("''",""," $str"),"'")!=false)

        return str_replace("'", "''", $str);

    else

        return $str;

}



function secure($str){

    // Case of an array

    if (is_array($str)) {

        foreach($str AS $id => $value) {

            $str[$id] = secure($value);

        }

    }

    else

        $str = xw_sanitycheck($str);



    return $str;

}



// Get Filter

$xweb_AI    = array_keys($_GET);

$i=0;

while($i<count($xweb_AI)) {

    $_GET[$xweb_AI[$i]]=secure($_GET[$xweb_AI[$i]]);

    $i++;

}

unset($xweb_AI);



// Request Filter

$xweb_AI    = array_keys($_REQUEST);

$i=0;

while($i<count($xweb_AI)) {

    $_REQUEST[$xweb_AI[$i]]=secure($_REQUEST[$xweb_AI[$i]]);

    $i++;

}

unset($xweb_AI);



// Post Filter

$xweb_AI    = array_keys($_POST);

$i=0;

while($i<count($xweb_AI)) {

    $_POST[$xweb_AI[$i]]=secure($_POST[$xweb_AI[$i]]);

    $i++;

}



// Cookie Filter (do we have a login system?)

$xweb_AI    = array_keys($_COOKIE);

$i=0;

while($i<count($xweb_AI)) {

    $_COOKIE[$xweb_AI[$i]]=secure($_COOKIE[$xweb_AI[$i]]);

    $i++;

}

// End 
?>