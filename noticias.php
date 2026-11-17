<?php
header('Content-Type: text/html; charset=utf-8');
require_once("inclu/config_index.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Notícias - MU Dravaryn</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Montserrat:wght@400;500;600;700&family=Rajdhani:wght@600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
    body {
      background: transparent !important;
      color: #cdd7e5;
      font-family: 'Montserrat', sans-serif;
      font-size: 14px;
      margin: 0;
      padding: 10px 0;
    }
    
    .news-card-wrap {
      background: rgba(14, 19, 29, 0.85);
      border: 1px solid rgba(212, 175, 55, 0.25);
      border-radius: 14px;
      padding: 24px;
      margin-bottom: 24px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.6);
      transition: all 0.3s ease;
    }
    .news-card-wrap:hover {
      border-color: #d4af37;
      box-shadow: 0 12px 35px rgba(0, 0, 0, 0.8), 0 0 15px rgba(212, 175, 55, 0.2);
    }

    .news-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      padding-bottom: 12px;
      flex-wrap: wrap;
      gap: 10px;
    }
    .news-title {
      font-family: 'Cinzel', serif;
      font-size: 20px;
      font-weight: 800;
      color: #d4af37;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 10px;
      letter-spacing: 0.5px;
    }
    .news-date-badge {
      font-family: 'Rajdhani', sans-serif;
      font-size: 13px;
      font-weight: 700;
      background: rgba(212, 175, 55, 0.15);
      border: 1px solid rgba(212, 175, 55, 0.4);
      color: #fce08a;
      padding: 4px 12px;
      border-radius: 20px;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .news-body {
      font-size: 14px;
      line-height: 1.7;
      color: #b8c6d8;
    }
    .news-body strong {
      color: #fff;
    }
    .news-body ul {
      padding-left: 20px;
      margin-top: 10px;
    }
    .news-body li {
      margin-bottom: 6px;
    }

    .news-footer {
      margin-top: 18px;
      padding-top: 12px;
      border-top: 1px solid rgba(255, 255, 255, 0.05);
      display: flex;
      justify-content: space-between;
      font-size: 12px;
      color: #7b8ba1;
    }
    .news-author {
      color: #d4af37;
      font-weight: 600;
    }
  </style>

  <script src="js/jquery.min.js"></script>
  <script>
  function adjustParentHeight() {
      var h = $('body').outerHeight(true) + 50;
      if (window.parent && window.parent.document) {
          var f = window.parent.document.getElementById('main2');
          if (f) f.style.height = h + 'px';
      }
  }
  $(window).on('load resize', adjustParentHeight);
  </script>
</head>

<body onload="adjustParentHeight()">

<?php include("tops_site.php"); ?>

<?php
$query = "SELECT id, date_format(data, '%d/%m/%Y') as data_formatada, titulo, noticia, user, dias_promo FROM public.noticias ORDER BY id DESC LIMIT 5";
$result = @mssql_query($query);

if ($result && @mssql_num_rows($result) > 0) {
    while ($row = @mssql_fetch_array($result)) {
        $titulo = !empty($row['titulo']) ? $row['titulo'] : 'Comunicado Oficial';
        $data   = !empty($row['data_formatada']) ? $row['data_formatada'] : date('d/m/Y');
        $corpo  = nl2br($row['noticia']);
        $autor  = !empty($row['user']) ? $row['user'] : 'Administração Dravaryn';
        ?>
        <div class="news-card-wrap">
          <div class="news-header">
            <h3 class="news-title"><i class="fa fa-newspaper-o"></i> <?=$titulo;?></h3>
            <span class="news-date-badge"><i class="fa fa-calendar"></i> <?=$data;?></span>
          </div>
          <div class="news-body">
            <?=$corpo;?>
          </div>
          <div class="news-footer">
            <span>Publicado por: <span class="news-author"><?=$autor;?></span></span>
            <span><i class="fa fa-check-circle text-gold"></i> Oficial Dravaryn Season 6</span>
          </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="news-card-wrap">
      <div class="news-header">
        <h3 class="news-title"><i class="fa fa-star text-gold"></i> Grande Inauguração - MU Dravaryn Season 6</h3>
        <span class="news-date-badge"><i class="fa fa-calendar"></i> <?=date('d/m/Y');?></span>
      </div>
      <div class="news-body">
        <p>Sejam todos muito bem-vindos ao <strong>MU Dravaryn Season 6 Episode 3</strong>, o servidor mais completo, estável e equilibrado do Brasil!</p>
        <ul>
          <li><strong>Versão:</strong> Season 6 Episode 3 Classic (Medium-Slow)</li>
          <li><strong>Experiência:</strong> 50x Geral | 30x Master Level</li>
          <li><strong>Drop Rate:</strong> 20% Normal | Jóias e Itens valorizados</li>
          <li><strong>Anti-Hack Avançado:</strong> Proteção de ponta ativa 24 horas</li>
          <li><strong>Castle Siege Semanal:</strong> Todos os domingos às 20h00 com premiações épicas!</li>
        </ul>
        <p>Crie sua conta agora mesmo e baixe o cliente completo para começar sua jornada!</p>
      </div>
      <div class="news-footer">
        <span>Publicado por: <span class="news-author">Equipe Dravaryn</span></span>
        <span><i class="fa fa-shield text-gold"></i> Servidor 100% Protegido</span>
      </div>
    </div>
    <?php
}
?>

</body>
</html>
