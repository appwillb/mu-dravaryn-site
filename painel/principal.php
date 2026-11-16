<head>

	<style>


	body,tr			{ font-family: arial, helvetica; color: #363636; font-size: 12px; }

	A:link			{ text-decoration: none; color: #8B0000; }
	A:visited		{ text-decoration: none; color: #8B0000; }
	A:hover			{ text-decoration: underline; color: grenn;}

         input    { font-family:verdana; font-size:14; color:#363636; border:1px solid #696969; background: #BEBEBE; }
         textarea { font-family:verdana; font-size:12; color:#363636; border:1px solid #696969; background: #BEBEBE; }
         Select   { font-family:verdana; font-size:14; color:#363636; border:1px solid #696969; background: #BEBEBE; }
         radio    { font-family:verdana; font-size:12; color:#363636; border:1px solid #696969; background: #BEBEBE; }

	.bordaBox {background: transparent;}
	.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b4, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b, .bordaBox .b4b {display:block; overflow:hidden; font-size:1px;}
	.bordaBox .b1, .bordaBox .b2, .bordaBox .b3, .bordaBox .b1b, .bordaBox .b2b, .bordaBox .b3b {height:1px;}
	.bordaBox .b2, .bordaBox .b3, .bordaBox .b4 {background:url('../img/fundonews2.png'); border-left:1px solid #c9c9c9; border-right:1px solid #c9c9c9;}
	.bordaBox .b1 {margin:0 5px; background:#c9c9c9;}
	.bordaBox .b2 {margin:0 3px; border-width:0 2px;}
	.bordaBox .b3 {margin:0 2px;}
	.bordaBox .b4 {height:2px; margin:0 1px;}
	.bordaBox .conteudo {padding:0px;display:block; background:url('../img/fundonews2.png'); border-left:1px solid #c9c9c9; border-right:1px solid #c9c9c9;}

	.imput {
	font: 17px Arial, sans-serif;
	color: #363636;
	}

	div.nf_title { background:url('../img/line-hr.png') center bottom no-repeat; margin-bottom:5px;}
	div.nf_title h3.lastmitems { float:center; width:710px; height:35px; text-align:center; font: 17px LithosProBold; color: #696969; padding:0px; margin-top:10px; }

	.redondo_avatar {
        background-color: #363636;
        color: #FFF;      
        border-radius: 50%;
	}

	.redondo2 {
   	height: 30px;
   	background-color: #363636;
   	color: #FFF;
 
	border-radius: 5px;
	box-shadow: 0 3px 3px rgba(0,0,0,0.1);
	}

</style>
  <link type="text/css" rel="stylesheet" href="css/paginas_img.css">

        <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>

	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>

<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho(); teste();">

<center>
<div id="tamanho">

<?

require("inclu/config.php");
require("inclu/cookie.php");

$titulo = "Seja bem vindo "; 

echo "<title>$titulo</title>";

?>

</head>


<?

require("chat_centro.php");

?> 
