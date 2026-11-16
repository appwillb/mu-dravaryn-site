<head>
  <link type="text/css" rel="stylesheet" href="css/paginas.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="css/exemplo.css" type="text/css" />
		<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />



	<script type="text/javascript">
		$("#main2", window.parent.document).height(800);
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>
<body style="background-color: transparent" leftmargin='0' topmargin='0' onload="tamanho()">

<center>
<div id="tamanho">


<center><bR><BR><font size=3><b> ENVIAR AVATAR <bR><BR>

<?
require("inclu/config.php");
require("inclu/cookie.php");

if ($_GET[remover]) {

$sql_dados = mssql_query("SELECT img FROM memb_info WHERE memb___id='$login' and img is not null"); 
$login_dados = mssql_fetch_row($sql_dados);

if ($login_dados) {
	$file = "../avatar/$login_dados[0]";
	
	if (file_exists($file)) chmod("$file", 0777);
	if (file_exists($file)) unlink($file);

   $msquery = "update memb_INFO set img = null where memb___id='$login'";
   $msresults= mssql_query($msquery);
}

echo "<font color=$font_color2 size=3><b>Avatar removido com sucesso!</font>";

}

if ($_GET[up]){


$sql_dados = mssql_query("SELECT img FROM memb_info WHERE memb___id='$login' and img is not null"); 
$login_dados = mssql_fetch_row($sql_dados);

if ($login_dados) {

	$file = "../avatar/$login_dados[0]";
	
	if (file_exists($file)) chmod("$file", 0777);
	if (file_exists($file)) unlink($file);

   $msquery = "update memb_info set img = null where memb___id='$login'";
   $msresults= mssql_query($msquery);
}


			// memory limit (nem todo server aceita)
			ini_set("memory_limit","50M");
			// set_time_limit(0);
			
			// processa arquivo
			$imagem		= ( isset( $_FILES['imagem'] ) && is_array( $_FILES['imagem'] ) ) ? $_FILES['imagem'] : NULL;
			$tem_crop	= false;
			$img		= '';
			$nome_f = $imagem['name'];
			$info_f = pathinfo($nome_f);
			$exte_f = $info_f['extension'];//Extensões permitidas
			$exte_p = array("jpg", "jpeg","JPG","JPEG"); 
			$rename = substr(md5(time()), 0, 10);
			$caminhoP = "../avatar/".$server."_".$rename.".$exte_f";
			$nomeimg = $server."_".$rename.".".$exte_f;
			$size_p = 2524288; //2512 kb

if (!$imagem['tmp_name']){
        echo "<br><bR><center><b>Extensão inválida ou tamanho excedido, Limite de 512KB por Imagem! <br><bR>";    
    }else{

			// valida a imagem enviada
			if( $imagem['tmp_name'] )
			{
			   if(in_array($exte_f, $exte_p)) {
				// armazena dimensÃµes da imagem
				$imagesize = getimagesize( $imagem['tmp_name'] );
				
				if( $imagesize !== false )
				{
					// move a imagem para o servidor
					if( move_uploaded_file( $imagem['tmp_name'], $caminhoP ) )
					{

						include( 'm2brimagem.class.php' );
						$oImg = new m2brimagem( $caminhoP );
						// valida via m2brimagem
						if( $oImg->valida() == 'OK' )
						{


							// redimensiona (opcional, sÃ³ pra evitar imagens muito grandes)
							$oImg->redimensiona( '600', '', '' );
							// grava nova imagem
							$oImg->grava( $caminhoP,'100', 0);
							// novas dimensÃµes da imagem
							$imagesize 	= getimagesize( "$caminhoP" );
							$img		= '<img src="'.$caminhoP.'" id="jcrop" '.$imagesize[3].' />';
							$preview	= '<img src="'.$caminhoP.'" id="preview" '.$imagesize[3].' />';
							$tem_crop 	= true;	


						}
					}
				}
} else {

echo "<br><br><b>Você só pode enviar imagens .JPG !!<br><br>";

} 
			}
 


}
}
		?>

		<?php if( $tem_crop === true ): ?>
			<h2 id="tit-jcrop"><font size=2>Recorte a imagem</font></h2>
			<div id="div-jcrop">
				

		
				<?php echo $img; ?>
				
				

			<div id="debug">
				<p><strong>X</strong> <input type="text" id="x" size="5" disabled /> x <input type="text" id="x2" size="5" disabled /> </p>
				<p><strong>Y</strong> <input type="text" id="y" size="5" disabled /> x <input type="text" id="y2" size="5" disabled /> </p>
				<p><strong>Dimensões</strong> <input type="text" id="h" size="5" disabled /> x <input type="text" id="w" size="5" disabled /></p>
				
				<div id="div-preview">
					<?php echo $preview; ?>
				</div>
			</div>

				<br><BR><BR><BR><BR><br><BR><BR><BR><BR><br> <input type="button" value="Salvar Imagem" id="btn-crop" />

			</div>

			<script type="text/javascript">
				var img = '<?php echo $caminhoP; ?>';


			
				$(function(){
					$('#jcrop').Jcrop({
						onChange: exibePreview,
						onSelect: exibePreview,
						minSize		: [ 150, 150 ],
						aspectRatio: 1
					});
					$('#btn-crop').click(function(){
						

					var $d = $('#w');
					if ($d.length != 0) {
  					if ($d.val().length != 0 && $d.val() != '0' ) 
					{

	
						$.post( 'crop.php?server=<? echo $server;?>&img=<? echo $nomeimg;?>', {
							img:img, 
							x: $('#x').val(), 
							y: $('#y').val(), 
							w: $('#w').val(), 
							h: $('#h').val()
						}, function(){
							$('#div-jcrop').html( '<img src="' + img + '?' + Math.random() + '" width="'+$('#w').val()+'" height="'+$('#h').val()+'" /> <bR><br><a href ="conta2.php" target="_top"> Clique aqui para continuar</a>' );
							$('#debug').hide();
							$('#tit-jcrop').html('Imagem enviada com sucesso!<br />');
						});


					} else { alert("Selecione e recorde o avatar na imagem!"); }
						} else { alert("Selecione e recorde o avatar na imagem!"); } 
					
       						

						return false;
					});
				});
				
				function exibePreview(c)
				{
					var rx = 100 / c.w;
					var ry = 100 / c.h;
				
					$('#preview').css({
						width: Math.round(rx * <?php echo $imagesize[0]; ?>) + 'px',
						height: Math.round(ry * <?php echo $imagesize[1]; ?>) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					});
					
					$('#x').val(c.x);
					$('#y').val(c.y);
					$('#x2').val(c.x2);
					$('#y2').val(c.y2);
					$('#w').val(c.w);
					$('#h').val(c.h);
					
				};
			</script>
		<?php else: ?>
			<form name="frm-jcrop" id="frm-jcrop" method="post" action="?up=ok" enctype="multipart/form-data">
				<p>
					<label><font size=2>Envie uma imagem:</label>
					<input type="file" name="imagem" id="imagem" />
					<input type="submit" value="Enviar Imagem" />
				</p>
			</form>
		<?php endif; ?>
		
		
<?

if (!$_GET[up]) {

echo "<br><Br><a href=?remover=ok><b>Remover Avatar atual?</a>";

}
?>


</div>
