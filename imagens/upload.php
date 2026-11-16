<head>
	<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>

	<link rel='stylesheet' href='../css/paginas.css' type='text/css' media='screen' />

        <script type='text/javascript' src='../js/jquery-1.3.2.min.js'></script>

	<script type='text/javascript'>
        function tamanho(){
		$("#main2", window.parent.document).height($("#tamanho").height() + 40);
	    }
        </script>

</head>

<body leftmargin= '0' topmargin='0' onload='tamanho()'>
<div id='tamanho'>
<center>

<BR><BR><font size=3><b>GERENCIAR IMAGENS</font></b> <BR><BR>Página para adicionar Screemshots(imagens) no site principal.<br><Br>


<?php
$NO_TITLE = 1; 
include("../painel/inclu/config.php");
include("../painel/inclu/cookie.php");

$NIVEL_ACESSO = 2;
require("../painel/inclu/verif_nivel_gm.php");

include("config2.php");

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

$NIVEL_ACESSO = 5;
require("../painel/inclu/verif_nivel_gm.php");

apagarfoto($_REQUEST['id']);
echo '<br><BR><meta http-equiv="refresh" content="0; url=upload.php">';

}


else {
echo "
<form action=upload.php method='post' enctype='multipart/form-data'>
<table width=600 cellspacing=0>
	<thead>
	<tr> 
		<th colspan=2> Enviar imagem </th>
	</tr>
	</thead>

	<tr>
		<td>Imagem:</td>
		<td><input type='file' name='foto'><br></td>
	</tr>
	<tr>
		<td>Comentario: </td>
		<td><input type='text' name='comentario'><br></td>
	</tr>
	<tr>
		<td colspan=2><input type='submit' name='Submit2' value='Enviar Foto!'></form></td>
	</tr>
</table><br><BR>";

$comandoSql = "SELECT * FROM fotos order by id desc";
$dados = mysql_query($comandoSql);

if ($dados) {

echo "<table width = '600' cellspacing=0>

	<thead>
	<tr> 
		<th colspan=3> Enviar imagem </th>
	</tr>

	<tr>
		<th width=100>Foto:</th>
		<th width=250>Coment&#225;rio</th>
		<th>Op&#231;&#245;es</th>
	</tr>

	</thead>
";

while ($linha = mysql_fetch_array($dados)) {
echo "
<tr><td><center><a href='#' onClick=window.open('fotos2.php?img=$linha[foto]','Janela','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=100%,height=100%,topmargin=0,leftmargin=0'); return false;><img src='thumb.php?imagem=fotos/$linha[foto]&x=100&qualidade=100'></a>
</td><td>$linha[comentario]</td><td><a href='upload.php?remover=1&id=$linha[id]'>Remover</a></td></tr>";	
}
echo "</table>";
}

}

?>
</div>