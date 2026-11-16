<html>
<head>
<title>Dicid - Ver Imagem</title>
<script language="javascript">
var i=0;
function resize() {
if (navigator.appName == 'Netscape') i=40;
if (document.images[0]) window.resizeTo(document.images[0].width +10, document.images[0].height+60-i);
}
</script>
</head>
<body bgcolor=#AB82FF onload="resize();" leftmargin="0" topmargin="0">

<img src="fotos/<?php echo $img; ?>" border="0" align="center">

</body>
</html>

