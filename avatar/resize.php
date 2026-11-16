<?

function teste($imagem) {

$imagem= "$imagem";

//DEFINE OS PARÂMETROS DA NOVA IMAGEM A SER FEITA
$largura = 150;
$altura = 150;

//NOME DO NOVO ARQUIVO
$imagem_gerada = explode(".", $imagem);
$imagem_gerada = '/avatar/'.$imagem_gerada[0].'.jpg';

$imagem = "/avatar/$imagem";

//CRIA A NOVA IMAGEM
$imagem_orig = ImageCreateFromJPEG($imagem);

//LARGURA
$pontoX = ImagesX($imagem_orig);

//ALTURA
$pontoY = ImagesY($imagem_orig);

//CRIA O THUMBNAIL
$imagem_fin = ImageCreateTrueColor($largura, $altura);

//COPIA A IMAGEM ORIGINAL PARA DENTRO
ImageCopyResampled($imagem_fin, $imagem_orig, 0, 0, 0, 0, $largura+1, $altura+1, $pontoX, $pontoY);

//SALVA A IMAGEM
ImageJPEG($imagem_fin, $imagem_gerada);

//LIBERA A MEMÓRIA
ImageDestroy($imagem_orig);
ImageDestroy($imagem_fin);

}

?>