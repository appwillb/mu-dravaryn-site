<?php

require("inclu/config.php");
require("inclu/cookie.php");


if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
	include( 'm2brimagem.class.php' );
	$oImg = new m2brimagem( $_POST['img'] );
	if( $oImg->valida() == 'OK' )
	{
		$oImg->posicaoCrop( $_POST['x'], $_POST['y'] );
		$oImg->redimensiona( $_POST['w'], $_POST['h'], 'crop' );
		$oImg->grava( $_POST['img'],'100',"$_GET[img]" );

   include("../avatar/resize.php");
    teste("$_GET[img]");

   $msquery = "update memb_info set img = '$_GET[img]' where memb___id='$login'";
   $msresults= mssql_query($msquery);


	}
}
exit;



?>