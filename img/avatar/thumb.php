<?php 

/* 
Thumb.php 

Como usar: 

setar o src de uma img para a pagina de thumb, passando os devidos 
parametro pela URL 

<img src="Thumb.php?imagem=foto.jpg&x=100&y=100&qualidade=100"> 

qualidade é parametro opcional, seta 75% se não for passada 

O ideal é passar apenas um ID da foto e pegar os parametro no Banco de dados, para evitar o uso indevido do script 

www.gambiarra.com.br 
bozo@gambiarra.com.br 

*/ 


$imagem = $_GET["imagem"]; 
$x = $_GET["x"]; 
$y = $_GET["y"]; 

if (isset($_GET["qualidade"])){ 
$qualidade = $_GET["qualidade"]; 
}else{ 
$qualidade = 75; 
} 

$extensao = explode(".",$imagem); 
$extensao = strtoupper(end($extensao)); 

if(($extensao=="JPG") OR ($extensao=="JPEG")){ 
$tipo = "JPEG"; 
} 
elseif($extensao=="GIF"){ 
$tipo = "GIF"; 
} 
elseif($extensao=="PNG"){ 
$tipo = "PNG"; 
} 
else{ 
$tipo = "NULL"; 
} 

$CriarImagemDe= 'ImageCreateFrom'.$tipo; 
$img = $CriarImagemDe($imagem);  

if($x==""){ 
$x = "75"; 
} 

if($qualidade==""){ 
$qualidade = "75"; 
} 

$largura = ImageSX($img); 
$altura = ImageSY($img); 
$img_largura = $x; 
$img_altura = $altura * $x / $largura; 
                                 
if($y==""){ 
$y = "$img_altura"; 
} 

//Aqui é criada a nova imagem 
$img_nova = imagecreatetruecolor ($x,$y);  
imagecopyresampled($img_nova, $img, 0, 0, 0, 0, $img_largura, $img_altura, $largura, $altura);  

//Cabeçalhos de img para printar a imagem na tela   
    Header("Content-disposition: filename=$imagem");  
    Header("Content-Type: image/$tipo");  
    ImageInterlace($img_nova,1);  
    $Image = "Image".$tipo; 
    $Image($img_nova,"","$qualidade");  
    ImageDestroy($img_nova);  
    ImageDestroY($img);  



?>