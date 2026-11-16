<html>
<head>
<title>Dicid - Ver Imagem</title>
<script language="javascript">
var i=0;
function resize() {
if (navigator.appName == 'Netscape') i=0;
if (document.images[0]) window.resizeTo(document.images[0].width +10, document.images[0].height+80-i);
}
</script>
</head>
<body onload="resize();" leftmargin="0" topmargin="0">

<img src="fotos/<?php echo $_GET[img]; ?>" border="0" align="center">

</body>
</html>

