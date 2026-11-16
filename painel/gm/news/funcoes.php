<?php

// WAM Sistema de Notícias - Desenvolvido por Álvaro Magnum - magnum@wamwebmedia.com.br

// Funçao para conectar-se com o Banco de Dados. Retorno = O sucesso da operacao (V ou F)
function conectaBancoDados() {
	
include("../../../inclu/config.php"); // Inclui o arquivo de configuraçao do Banco de Dados.

	$resultado = false; // Retorno da Funçao (default = falso). Indica o sucesso da conexao.
	
	// Tenta conectar-se ao Banco de Dados.
	if (@mysql_connect($MySql_host, $MySql_login, $MySql_senha)) {
		mysql_select_db($MySql_db);
		$resultado = true;
	}
	
	return $resultado;
	
} // Fim da funçao conectaBancoDados.

function adicionaNoticia($noticia, $titulo, $user, $server,$tipo) {
	
	include("../../../inclu/config.php"); // Inclui o arquivo de configuraçao do Banco de Dados.
	
	// Tenta conectar-se ao Banco de Dados mostrando uma mensagem de erro caso contrário.
	if(!conectaBancoDados()) {
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	}
	else {
		// Executa o Comando no Banco de Dados mostrando uma mensagem de erro em caso de falha.
		if (mysql_query("INSERT INTO $tabela_news(data, noticia, titulo, user, dias_promo,tipo) VALUES(now(), '$noticia', '$titulo', '$user', '$server', '$tipo')")) {
			print("<center><strong>Notícia inserida com sucesso!</strong></center>");
		}
		else print("<center><strong>Notícia nao inserida!</strong></center>". mysql_error());
		mysql_close(); // Nao obrigatoria, porém recomendado.
	}
	
} // Fim da funçao adicionaNoticia.

// Funcao para apagar uma notícia. Retorno = nenhum.
// Parâmetro único - O id da notícia que será deletada.
function apagarNoticia($idNoticia) {
	
	include("../../../inclu/config.php"); // Inclui o arquivo de configuraçao do Banco de Dados.
	
	// Tenta conectar-se ao Banco de Dados mostrando uma mensagem de erro caso contrário.
	if(!conectaBancoDados()) {
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	}
	else {
		// Comando que será executado no Banco de Dados.
		$comandoSql = "DELETE FROM $tabela_news WHERE id = '$idNoticia'";
		// Executa o Comando no Banco de Dados mostrando uma mensagem de erro em caso de falha.
		if (mysql_query($comandoSql)) {
			print ("<center><strong>Notícia deletada com sucesso!</strong></center>");
		}
		else print("<center><strong>Notícia nao deletada!</strong></center>");
		mysql_close();
	}
	
} // Fim da funçao apagarNoticia.

// Funcao para mostrar as noticias cadastradas no sistema com opcao de exclusao. Versao administrativa.
function mostraNoticiasAdmin() {
	
	include("../../../inclu/config.php"); // Inclui o arquivo de configuraçao do Banco de Dados.
	
	if (!conectaBancoDados()) {
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	}
	else {
		// Comando que será executado no Banco de Dados.
		$comandoSql = "SELECT id, date_format(data, '%d/%m/%Y') as data_formatada, titulo FROM $tabela_news ORDER by id desc";
		// Joga todos os dados da pesquisa para a variavel dados.
		$dados = mysql_query($comandoSql);
		// Mostra todos as noticias do sistema mostrando uma mensagem de erro em caso de falha.
		if ($dados) {
			// Cria uma tabela com os resultados.
			print("<table width = '50%' align = 'center' border = '0'>");
			print("<tr><td><strong>DATA</strong></td><td><strong>NOTÍCIA</strong></td></tr>");
			while ($linha = mysql_fetch_array($dados)) {
				print("<tr><td>$linha[data_formatada]</td><td>$linha[titulo]</td><td><a href='admin.php?remover=1&id=$linha[id]'><strong>Remover</strong></a></td></tr>");	
			}
			print("</table>");
		}
		else print("<center><strong>Erro na exibiçao das notícias!</strong></center>".mysql_error());
	}
	
} // Fim da funçao mostraNoticiasAdmin.

// Funcao para mostrar as noticias cadastradas no sistema. Versao do usuário.
// Parâmetro Único - Quantidade de notícias que será exibida.
function mostraNoticias($quantidadeNoticias) {
	
	include("../../../inclu/config.php"); // Inclui o arquivo de configuraçao do Banco de Dados.
	
	if (!conectaBancoDados()) {
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	}
	else {
		// Comando que será executado no Banco de Dados.
		$comandoSql = "SELECT id, date_format(data, '%d/%m/%Y') as data_formatada, titulo, noticia FROM $tabela_news ORDER BY id asc";
		// Joga todos os dados da pesquisa para a variavel dados.
		$dados = mysql_query($comandoSql);
		// Mostra todos as noticias do sistema mostrando uma mensagem de erro em caso de falha.
		if ($dados) {
			$i = 0; // Variável de controle da quantidade de notícias que será exibida
			// Cria uma tabela com os resultados.
			print("<table width = '100%' align = 'center' border = '0'>");
			while (($linha = mysql_fetch_array($dados)) && ($i < $quantidadeNoticias)) {
				// Formata a notícia para que apareçam apenas os 250 primeiros caracteres.
				@$noticia_formatada = substr($linha[noticia], 0, 250)."...";
				print("<tr><td colspan=' 2'><div align='left'><strong>$linha[data_formatada] -  $linha[titulo]</strong></div></td></tr>");
				print("<tr><td width='5%' valign='top'><div align='left'><img src='img_noticias/$linha[imagem]' alt='sem imagem' width='70' height='60'></div></td><td width='95%' valign='top'><div align='left'><a href='mostrar_noticia.php?id=$linha[id]'>$noticia_formatada</a></div></td></tr>");
				print("<tr><td colspan=' 2'><div align='left'><hr></div></td></tr>");
				$i++;
			}
			print("</table>");
		}
		else print("<center><strong>Erro na exibiçao das notícias!</strong></center>");
	}
	
} // Fim da funçao mostraNoticias.

// Funçao para mostrar as notícias individualmente.
// Parâmetro único - O Id da notícia que será exibida.
function mostraNoticiaId($id) {
	
	include("../../../inclu/config.php"); // Inclui o arquivo de configuraçao do Banco de Dados.
	
	if (!conectaBancoDados()) {
		print("<center><strong>Nao foi possível estabelecer conexao com o Banco de Dados!</strong></center>");
	}
	else {
		// Comando que será executado no Banco de Dados.
		$comandoSql = "SELECT id, date_format(data, '%d/%m/%Y') as data_formatada, titulo, noticia FROM $tabela_news WHERE id = '$id'";
		// Joga todos os dados da pesquisa para a variavel dados.
		$dados = mysql_query($comandoSql);
		// Mostra todos as noticias do sistema mostrando uma mensagem de erro em caso de falha.
		if ($dados) {
			// Cria uma tabela com a notícia.
			print("<table width = '100%' align = 'center' border = '0'>");
			$linha = mysql_fetch_array($dados);
			print("<tr><td colspan=' 2'><div align='center'><strong>$linha[data_formatada] -  $linha[titulo]</strong></div><br></td></tr>");
			print("<tr><td colspan=' 2'><div align='center'><img src='img_noticias/$linha[imagem]' alt='sem imagem'></div><br></td></tr>");
			print("<tr><td width='100%' valign='top'><div align='justify'>$linha[noticia]</div></td></tr>");
			print("<tr><td colspan=' 2'><div align='left'><hr></div></td></tr>");
			print("</table>");
		}
		else print("<center><strong>Erro na exibiçao da notícia!</strong></center>");
	}
	
} // Fim da funçao mostraNoticiaId.

// Funçao para fazer o upload da imagem da notícia.
function uploadImagem() {
	
	// Pega a imagem enviada através do formulário. Nome temporário e verdadeiro.
	@$imagem_temp= $_FILES['imagem']['tmp_name'];
	@$imagem_real= $_FILES['imagem']['name'];
	
	// O Upload só é efetuado se a imagem for do tipo gif ou jpg.
	if (($_FILES['imagem']['type'] == "image/pjpeg") || ($_FILES['imagem']['type'] == "image/gif")) {
		// Move a imagem para a pasta de imagens. Mostra mensagem de erro em caso de falha.
		if (move_uploaded_file($imagem_temp, "img_noticias/$imagem_real")) {
			print("<center><strong>Imagem enviada com sucesso!</strong></center>");
		}
		else print("<center><strong>Erro no upload!</strong></center>");
	}
	else print("<center><strong>A imagem não é do tipo jpg ou gif!</strong></center>");
	
} // Fim da funçao uploadImagem.

?>


