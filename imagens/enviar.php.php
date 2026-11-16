<head>
<title>MuK&#243;reia Imagens - Mk Sempre o Melhor</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<?PHP include("config2.php"); ?>
<?php

$erro = $config = array();

// Prepara a vari&#225;vel do arquivo
$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;

// Tamanho m&#225;ximo do arquivo (em bytes)
$config["tamanho"] = 10150883;
// Largura m&#225;xima (pixels)
$config["largura"] = 1280;
// Altura m&#225;xima (pixels)
$config["altura"]  = 1024;

// Formul&#225;rio postado... executa as a&#231;&#245;es
if($arquivo)
{  
    // Verifica se o mime-type do arquivo &#233; de imagem
    if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
    {
        $erro[] = "Arquivo em formato inv&#225;lido! A imagem deve ser jpg, jpeg, 
			bmp, gif ou png. Envie outro arquivo";
    }
    else
    {
        // Verifica tamanho do arquivo
        if($arquivo["size"] > $config["tamanho"])
        {
            $erro[] = "Arquivo em tamanho muito grande! 
		A imagem deve ser de no m&#225;ximo " . $config["tamanho"] . " bytes. 
		Envie outro arquivo";
        }
        
        // Para verificar as dimens&#245;es da imagem
        $tamanhos = getimagesize($arquivo["tmp_name"]);
        
        // Verifica largura
        if($tamanhos[0] > $config["largura"])
        {
            $erro[] = "Largura da imagem n&#227;o deve 
				ultrapassar " . $config["largura"] . " pixels";
        }

        // Verifica altura
        if($tamanhos[1] > $config["altura"])
        {
            $erro[] = "Altura da imagem n&#227;o deve 
				ultrapassar " . $config["altura"] . " pixels";
        }

        if(empty($_POST[comentario])) {

            $erro[] = "Coloque um coment&#225;rio para a foto.";
        }

    }
    
    // Imprime as mensagens de erro
    if(sizeof($erro))
    {
        foreach($erro as $err)
        {
            echo "<center> - " . $err . "<BR>";
        }

        echo "<center><BR><BR><a href=\"upload.php\">Fazer Upload de Outra Imagem</a>";
    }

    // Verifica&#231;&#227;o de dados OK, nenhum erro ocorrido, executa ent&#227;o o upload...
    else
    {
        // Pega extens&#227;o do arquivo
        preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

        // Gera um nome &#250;nico para a imagem
        $imagem_nome = md5(uniqid(time())) . "." . $ext[1];

	$comandoSql = "INSERT INTO fotos(foto, comentario) VALUES ('$imagem_nome', '$_POST[comentario]')";
	$sql = mysql_query($comandoSql);

        // Caminho de onde a imagem ficar&#225;
        $imagem_dir = "fotos/" . $imagem_nome;

        // Faz o upload da imagem
        move_uploaded_file($arquivo["tmp_name"], $imagem_dir);

        echo "<center>Sua foto foi enviada com sucesso!";

        echo "<center><BR><BR><a href=\"upload.php\">Fazer Upload de Outra Imagem</a>";

    }
}

else if (@$_REQUEST['remover'] == 1) {
include("funcoes.php");

apagarfoto($_REQUEST['id']);
echo '<br><BR><meta http-equiv="refresh" content="0; url=upload.php">';

}


else {
echo "
<center><form action=upload.php method='post' enctype='multipart/form-data'>
<table><tr><TD>Imagem:</td><td><input type='file' name='foto'><br></td></tr>
<tr><TD>Comentario: </td><td><input type='text' name='comentario'><br></td></tr>
<tr><TD colspan=2><center><input type='submit' name='Submit2' value='Enviar Foto!'></form></td></tr>";

$comandoSql = "SELECT * FROM fotos order by id desc";
$dados = mysql_query($comandoSql);

if ($dados) {
echo "<table width = '50%' align = 'center' border = '1'>";
echo "<tr><td width=100><strong>Foto:</strong></td><td width=250><strong>Coment&#225;rio</strong></td><td><strong>Op&#231;&#245;es</td></tr>";
while ($linha = mysql_fetch_array($dados)) {
echo "
<tr><td><center><a href='#' onClick=window.open('fotos/fotos.php?img=$linha[foto]','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=100%,height=100%,topmargin=0,leftmargin=0'); return false;><img src='thumb.php?imagem=fotos/$linha[foto]&x=100&qualidade=100'></a>
</td><td>$linha[comentario]</td><td></td></tr>";	
}
echo "</table>";
}

}

?>
