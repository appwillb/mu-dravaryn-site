<?php
header('Content-Type: text/html; charset=utf-8');
require_once("inclu/config_index.php");

$dados_server = @mssql_fetch_row(mssql_query("SELECT * from public.fn_info()"));
$server_on    = isset($dados_server[0]) ? (int)$dados_server[0] : 1;
$acr2         = isset($dados_server[1]) ? (int)$dados_server[1] : 142;
$acr3         = isset($dados_server[2]) ? (int)$dados_server[2] : 77;

if ((isset($_COOKIE["usuario"])) && (isset($_COOKIE["senha"])) && !$off) {
    $sql_dados = mssql_query("SELECT img from public."MEMB_INFO" where memb___id='$login'"); 
    $login_dados = @mssql_fetch_row($sql_dados);
    if (!empty($login_dados[0])) {
        $avatar = "avatar/thumb.php?imagem=" . urlencode($login_dados[0]) . "&y=30&x=30&qualidade=100";
    } else {
        $avatar = "avatar/Icon-user30.png";
    }
} else {
    $avatar = "avatar/Icon-user30.png";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MU Dravaryn - Season 6 Medium Slow • Servidor Oficial</title>

  <meta name="title" content="MU Dravaryn Season 6 Medium Slow"/>
  <meta name="description" content="Jogue no maior e mais equilibrado servidor de MU Online Season 6 Medium Slow do Brasil. Experiência 50x, Master Exp 30x, Drop 20%. Registre-se grátis!"/>
  <meta name="keywords" content="mu, mu online, mu dravaryn, season 6, season 6 medium, mu brasil, jogar mu online, download mu"/>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Montserrat:wght@300;400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 3 & Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- Master Site CSS -->
  <link rel="stylesheet" href="css/site.css?v=2.0">
</head>

<body class="dravaryn-body">

<?php include("menu_navbar.php"); ?>

<!-- HERO SHOWCASE SECTION -->
<header class="hero-section">
  <div class="container">
    <div class="row hero-row align-items-center">
      
      <!-- HERO LEFT: Epic Title & Actions -->
      <div class="col-md-7 col-sm-12 hero-left">
        <div class="hero-badge">
          <span class="badge-dot"></span> SEASON 6 EPISODE 3 • MEDIUM-SLOW
        </div>
        <h1 class="hero-brand-title">MU <span>DRAVARYN</span></h1>
        <p class="hero-tagline">
          A verdadeira essência do MMORPG medieval. Economia valorizada, PvP balanceado e guerra de Guilds no Castle Siege!
        </p>

        <div class="hero-cta-group">
          <a href="cadastro.php" target="main2" class="btn-cta-gold">
            <span class="btn-icon"><i class="fa fa-user-plus"></i></span>
            <span class="btn-text">
              <strong>CRIAR CONTA GRÁTIS</strong>
              <small>Cadastre-se e ganhe 3 dias VIP</small>
            </span>
          </a>

          <a href="dwn.php" target="main2" class="btn-cta-blue">
            <span class="btn-icon"><i class="fa fa-download"></i></span>
            <span class="btn-text">
              <strong>BAIXAR JOGO COMPLETO</strong>
              <small>Cliente HD v1.42 • 1.2 GB</small>
            </span>
          </a>
        </div>
      </div>

      <!-- HERO RIGHT: Server HUD Card -->
      <div class="col-md-5 col-sm-12 hero-right">
        <div class="server-hud-card">
          <div class="hud-header">
            <div class="hud-status-badge">
              <span class="pulse-indicator"></span> SERVIDOR ONLINE
            </div>
            <div class="hud-clock" id="server-time">00:00:00</div>
          </div>

          <div class="hud-body">
            <div class="hud-stat-row">
              <span class="stat-label"><i class="fa fa-cube text-gold"></i> Versão:</span>
              <span class="stat-value text-gold">Season 6 Classic</span>
            </div>
            <div class="hud-stat-row">
              <span class="stat-label"><i class="fa fa-bolt text-gold"></i> Experiência:</span>
              <span class="stat-value text-cyan">50x (Master 30x)</span>
            </div>
            <div class="hud-stat-row">
              <span class="stat-label"><i class="fa fa-diamond text-gold"></i> Drop Rate:</span>
              <span class="stat-value text-gold">20% Normal</span>
            </div>
            <div class="hud-stat-row">
              <span class="stat-label"><i class="fa fa-shield text-gold"></i> Bug Bless:</span>
              <span class="stat-value text-danger">OFF (100% Desativado)</span>
            </div>

            <div class="hud-counters-grid">
              <div class="counter-box">
                <i class="fa fa-users counter-icon text-cyan"></i>
                <div class="counter-num"><?=$acr2;?></div>
                <div class="counter-title">Contas</div>
              </div>
              <div class="counter-box">
                <i class="fa fa-id-badge counter-icon text-gold"></i>
                <div class="counter-num"><?=$acr3;?></div>
                <div class="counter-title">Personagens</div>
              </div>
              <div class="counter-box">
                <i class="fa fa-signal counter-icon text-green"></i>
                <div class="counter-num"><?=$server_on;?></div>
                <div class="counter-title">Online</div>
              </div>
            </div>

            <a href="info.php" target="main2" class="btn-hud-details">
              <i class="fa fa-list-alt"></i> VER TODAS AS CONFIGURAÇÕES
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</header>

<!-- REAL-TIME EVENTS TICKER -->
<section class="events-ticker-bar">
  <div class="container">
    <div class="ticker-wrapper">
      <div class="ticker-title"><i class="fa fa-clock-o text-gold"></i> PRÓXIMOS EVENTOS:</div>
      <div class="ticker-items">
        <div class="ticker-item">
          <span class="event-name">Castle Siege:</span>
          <span class="event-time text-gold">Domingo 20:00</span>
        </div>
        <div class="ticker-item">
          <span class="event-name">Blood Castle:</span>
          <span class="event-time text-cyan" id="timer-bc">A cada 2h</span>
        </div>
        <div class="ticker-item">
          <span class="event-name">Devil Square:</span>
          <span class="event-time text-cyan" id="timer-ds">A cada 2h</span>
        </div>
        <div class="ticker-item">
          <span class="event-name">Chaos Castle:</span>
          <span class="event-time text-gold" id="timer-cc">A cada 4h</span>
        </div>
        <div class="ticker-item">
          <span class="event-name">Invasão Dourados:</span>
          <span class="event-time text-warning">A cada 3h</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- QUICK FEATURE CARDS -->
<section class="feature-cards-section">
  <div class="container">
    <div class="row cards-row">
      
      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="tops_diario.php" target="main2" class="feature-card">
          <div class="card-icon-wrap icon-gold"><i class="fa fa-trophy"></i></div>
          <h4>TOP RANKINGS</h4>
          <p>Diário, Semanal & Mensal</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="ranking_castle.php" target="main2" class="feature-card">
          <div class="card-icon-wrap icon-red"><i class="fa fa-fort-awesome"></i></div>
          <h4>CASTLE SIEGE</h4>
          <p>Guerra no Vale de Loren</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="evento_arena.php" target="main2" class="feature-card">
          <div class="card-icon-wrap icon-cyan"><i class="fa fa-gavel"></i></div>
          <h4>REI DO PVP</h4>
          <p>Torneio de Gladiadores</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="evento_goldens.php" target="main2" class="feature-card">
          <div class="card-icon-wrap icon-yellow"><i class="fa fa-star"></i></div>
          <h4>INVASÕES</h4>
          <p>Goldens & Super Bosses</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="guilds.php" target="main2" class="feature-card">
          <div class="card-icon-wrap icon-purple"><i class="fa fa-users"></i></div>
          <h4>GUILDS</h4>
          <p>Alianças & Batalhas</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="eventos.php" target="main2" class="feature-card">
          <div class="card-icon-wrap icon-green"><i class="fa fa-gift"></i></div>
          <h4>RECOMPENSAS</h4>
          <p>Missões e Horários</p>
        </a>
      </div>

    </div>
  </div>
</section>

<!-- MAIN CONTENT CONTAINER (PORTAL & SUBPAGES) -->
<main class="main-content-section" id="show">
  <div class="container">
    <div class="portal-glass-container">
      <div class="portal-frame-wrap">
        <iframe src="noticias.php" name="main2" id="main2" frameborder="0" allowtransparency="true" scrolling="no">
          Seu navegador não suporta iframes.
        </iframe>
      </div>
    </div>
  </div>
</main>

<!-- MODERN FOOTER -->
<footer class="dravaryn-footer">
  <div class="container">
    <div class="row footer-row">
      <div class="col-md-4 footer-col">
        <div class="footer-brand">
          <img src="img/logoJM.png" alt="Dravaryn" class="footer-logo">
          <h3>MU DRAVARYN</h3>
        </div>
        <p class="footer-desc">
          O melhor servidor de MU Online Season 6 do Brasil. Servidor estável, sem bugs, proteção avançada e suporte dedicado 24/7.
        </p>
      </div>

      <div class="col-md-2 col-sm-4 footer-col">
        <h4>O JOGO</h4>
        <ul class="footer-links">
          <li><a href="cadastro.php" target="main2">Criar Conta</a></li>
          <li><a href="dwn.php" target="main2">Download</a></li>
          <li><a href="info.php" target="main2">Configurações</a></li>
          <li><a href="comandos.php" target="main2">Comandos</a></li>
        </ul>
      </div>

      <div class="col-md-3 col-sm-4 footer-col">
        <h4>INFORMAÇÕES</h4>
        <ul class="footer-links">
          <li><a href="tutoriais.php" target="main2">Tutoriais</a></li>
          <li><a href="patentes.php" target="main2">Patentes & Medalhas</a></li>
          <li><a href="quests.php" target="main2">Missões & Quests</a></li>
          <li><a href="eventos.php" target="main2">Horários de Eventos</a></li>
        </ul>
      </div>

      <div class="col-md-3 col-sm-4 footer-col">
        <h4>COMUNIDADE</h4>
        <ul class="footer-social-links">
          <li><a href="https://discord.gg/" target="_blank"><i class="fa fa-comments"></i> Discord Oficial</a></li>
          <li><a href="https://chat.whatsapp.com/" target="_blank"><i class="fa fa-whatsapp"></i> Grupo WhatsApp</a></li>
          <li><a href="contato.php" target="main2"><i class="fa fa-life-ring"></i> Suporte Técnico</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="row">
        <div class="col-sm-6 text-left">
          <p>&copy; <?=date('Y');?> MU Dravaryn. Todos os direitos reservados.</p>
        </div>
        <div class="col-sm-6 text-right">
          <p class="designer-credit">Designed for <strong>MU Dravaryn Season 6</strong></p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>
// Auto scroll on subpage link click
$('a[target="main2"]').click(function(){
    var pos = $('#show').offset().top - 70;
    $('html, body').animate({scrollTop: pos}, 600);
});

// Live Server Clock
function updateClock() {
    var now = new Date();
    var h = String(now.getHours()).padStart(2, '0');
    var m = String(now.getMinutes()).padStart(2, '0');
    var s = String(now.getSeconds()).padStart(2, '0');
    var el = document.getElementById('server-time');
    if (el) el.innerText = h + ':' + m + ':' + s;
}
setInterval(updateClock, 1000);
updateClock();
</script>

</body>
</html>
