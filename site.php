<?php
header('Content-Type: text/html; charset=utf-8');
require_once("inclu/config_index.php");

// Fetch real OpenMU database stats
$dados_server = @mssql_fetch_row(mssql_query("SELECT * from public.fn_info()"));
$server_on    = isset($dados_server[0]) ? (int)$dados_server[0] : 1;
$acr2         = isset($dados_server[1]) ? (int)$dados_server[1] : 20;
$acr3         = isset($dados_server[2]) ? (int)$dados_server[2] : 77;

// Active logged user check
$is_logged = false;
$user_login = '';
$user_avatar = 'avatar/Icon-user30.png';

if (isset($_COOKIE["usuario"]) && isset($_COOKIE["senha"]) && !$off) {
    $user_login = htmlspecialchars($_COOKIE["usuario"]);
    $sql_dados = @mssql_query("SELECT img from memb_info where memb___id='$user_login'"); 
    $login_dados = @mssql_fetch_row($sql_dados);
    if (!empty($login_dados[0])) {
        $user_avatar = "avatar/thumb.php?imagem=" . urlencode($login_dados[0]) . "&y=30&x=30&qualidade=100";
    }
    $is_logged = true;
}

// Subpage router (NO IFRAMES!)
$page = isset($_GET['p']) ? strtolower(trim($_GET['p'])) : 'home';
$allowed_pages = ['home', 'cadastro', 'download', 'info', 'ranking', 'comandos', 'contato', 'dicas', 'eventos', 'guilds', 'mudar_senha'];
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MU Dravaryn - Season 6 Episode 3 • Servidor Oficial</title>

  <meta name="title" content="MU Dravaryn - Season 6 Episode 3 Medium-Slow"/>
  <meta name="description" content="O maior e mais épico servidor de MU Online Season 6 do Brasil. 50x EXP, 30x Master, 20% Drop. Castle Siege semanal e economia 100% valorizada!"/>
  <meta name="keywords" content="mu, mu online, mu dravaryn, season 6, season 6 medium, mmorpg, brasil"/>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <!-- Luxury Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 3 & Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- Master AAA Stylesheet -->
  <link rel="stylesheet" href="css/site.css?v=4.0">
</head>

<body class="dravaryn-body">

<!-- TOP LUXURY NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top modern-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dravaryn-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="site.php">
        <img src="img/logoJM.png" alt="MU Dravaryn" class="brand-logo">
        <span class="brand-title">MU <span>DRAVARYN</span></span>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="dravaryn-nav">
      <ul class="nav navbar-nav nav-links-center">
        <li class="<?=$page=='home'?'active':'';?>"><a href="site.php">INÍCIO</a></li>

        <li class="dropdown <?=(in_array($page, ['info', 'comandos', 'dicas']))?'active':'';?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            O JOGO <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="site.php?p=info"><i class="fa fa-info-circle text-gold"></i> Informações do Servidor</a></li>
            <li><a href="site.php?p=comandos"><i class="fa fa-terminal text-gold"></i> Comandos do Jogo</a></li>
            <li><a href="site.php?p=dicas"><i class="fa fa-lightbulb-o text-gold"></i> Dicas para Iniciantes</a></li>
          </ul>
        </li>

        <li class="<?=$page=='download'?'active':'';?>"><a href="site.php?p=download"><i class="fa fa-download text-gold"></i> DOWNLOAD</a></li>
        <li class="<?=$page=='cadastro'?'active':'';?>"><a href="site.php?p=cadastro"><i class="fa fa-user-plus text-gold"></i> CADASTRO</a></li>
        <li class="<?=$page=='ranking'?'active':'';?>"><a href="site.php?p=ranking"><i class="fa fa-trophy text-gold"></i> RANKINGS</a></li>
        <li class="<?=$page=='eventos'?'active':'';?>"><a href="site.php?p=eventos"><i class="fa fa-clock-o text-gold"></i> EVENTOS</a></li>
        <li class="<?=$page=='contato'?'active':'';?>"><a href="site.php?p=contato"><i class="fa fa-envelope-o text-gold"></i> SUPORTE</a></li>
      </ul>

      <div class="nav navbar-nav navbar-right auth-btn-wrap">
        <?php if ($is_logged): ?>
          <div class="dropdown user-pill-dropdown">
            <button class="btn btn-user-pill dropdown-toggle" type="button" data-toggle="dropdown">
              <img src="<?=$user_avatar;?>" class="user-pill-avatar" alt="Avatar">
              <span class="user-pill-name"><?=$user_login;?></span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="painel/index.php" target="_blank"><i class="fa fa-dashboard text-gold"></i> Painel do Usuário</a></li>
              <li><a href="site.php?p=mudar_senha"><i class="fa fa-key text-gold"></i> Alterar Senha</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="logar.php?deslogar=ok" class="text-danger"><i class="fa fa-sign-out"></i> Desconectar</a></li>
            </ul>
          </div>
        <?php else: ?>
          <button type="button" class="btn btn-nav-login" data-toggle="modal" data-target="#loginModal">
            <i class="fa fa-lock"></i> ENTRAR
          </button>
          <a href="site.php?p=cadastro" class="btn btn-nav-register">
            <i class="fa fa-user-plus"></i> JOGAR GRÁTIS
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<!-- LOGIN MODAL (LUXURY GLASSMORPHISM) -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content modal-glass">
      <div class="modal-header">
        <button type="button" class="close text-gold" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="loginModalLabel"><i class="fa fa-shield text-gold"></i> ACESSO À CONTA</h4>
      </div>
      <form action="logar.php" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label text-gold">Login / Conta:</label>
            <input type="text" name="login" class="form-control modal-input" placeholder="Digite seu usuário" required>
          </div>
          <div class="form-group">
            <label class="control-label text-gold">Senha:</label>
            <input type="password" name="oldpwd" class="form-control modal-input" placeholder="Digite sua senha" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-cta-gold btn-block">ENTRAR NO PAINEL</button>
          <a href="site.php?p=cadastro" class="btn-modal-sublink">Ainda não tem conta? Cadastre-se grátis</a>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- HERO SHOWCASE (MONUMENTAL AAA HEADER) -->
<header class="hero-showcase">
  <div class="container">
    <div class="row hero-content-row">
      
      <!-- HERO LEFT: Monumental Logo & CTAs -->
      <div class="col-md-7 col-sm-12 hero-left-col text-center-sm">
        <div class="hero-season-badge">
          <span class="pulsing-emerald"></span> SEASON 6 EPISODE 3 • MEDIUM-SLOW CLÁSSICO
        </div>

        <div class="hero-logo-container">
          <img src="img/logo_dravaryn.png" alt="MU Dravaryn Oficial" class="hero-main-logo">
        </div>

        <p class="hero-epic-description">
          A maior e mais lendária experiência medieval do Brasil. Economia 100% valorizada, PvP rigorosamente calibrado e a mais sangrenta batalha semanal pelo <strong>Castle Siege</strong>!
        </p>

        <div class="hero-buttons-wrapper">
          <a href="site.php?p=cadastro" class="btn-hero-primary">
            <span class="btn-shine"></span>
            <div class="btn-hero-icon"><i class="fa fa-user-plus"></i></div>
            <div class="btn-hero-content">
              <span class="btn-hero-title">CRIAR CONTA GRÁTIS</span>
              <span class="btn-hero-sub">Registro rápido • 3 Dias VIP</span>
            </div>
          </a>

          <a href="site.php?p=download" class="btn-hero-secondary">
            <div class="btn-hero-icon"><i class="fa fa-download"></i></div>
            <div class="btn-hero-content">
              <span class="btn-hero-title">BAIXAR CLIENTE HD</span>
              <span class="btn-hero-sub">Instalador Completo • 1.2 GB</span>
            </div>
          </a>
        </div>
      </div>

      <!-- HERO RIGHT: Tactical Server HUD (OpenMU Live) -->
      <div class="col-md-5 col-sm-12 hero-right-col">
        <div class="tactical-hud-card">
          <div class="hud-top-bar">
            <div class="hud-server-status">
              <span class="status-dot-green"></span>
              <strong>SERVIDOR ONLINE</strong>
            </div>
            <div class="hud-live-time" id="server-live-clock">--:--:--</div>
          </div>

          <div class="hud-inner-body">
            <div class="hud-rate-item">
              <span class="rate-name"><i class="fa fa-bookmark text-gold"></i> Versão:</span>
              <span class="rate-val text-gold">Season 6 Ep. 3</span>
            </div>
            <div class="hud-rate-item">
              <span class="rate-name"><i class="fa fa-bolt text-gold"></i> Experiência:</span>
              <span class="rate-val text-cyan">50x Geral (Master 30x)</span>
            </div>
            <div class="hud-rate-item">
              <span class="rate-name"><i class="fa fa-diamond text-gold"></i> Drop Rate:</span>
              <span class="rate-val text-gold">20% Valorizado</span>
            </div>
            <div class="hud-rate-item">
              <span class="rate-name"><i class="fa fa-ban text-gold"></i> Bug Bless:</span>
              <span class="rate-val text-danger">OFF (100% Desativado)</span>
            </div>
            <div class="hud-rate-item">
              <span class="rate-name"><i class="fa fa-map-marker text-gold"></i> Spots:</span>
              <span class="rate-val text-gold">1.399 Balanceados</span>
            </div>

            <!-- LIVE DATABASE METRICS -->
            <div class="hud-metrics-row">
              <div class="metric-card">
                <i class="fa fa-users metric-icon text-cyan"></i>
                <div class="metric-number"><?=$acr2;?></div>
                <div class="metric-label">CONTAS</div>
              </div>
              <div class="metric-card">
                <i class="fa fa-shield metric-icon text-gold"></i>
                <div class="metric-number"><?=$acr3;?></div>
                <div class="metric-label">PERSONAGENS</div>
              </div>
              <div class="metric-card">
                <i class="fa fa-signal metric-icon text-green"></i>
                <div class="metric-number"><?=$server_on;?></div>
                <div class="metric-label">ONLINE</div>
              </div>
            </div>

            <a href="site.php?p=info" class="btn-hud-full-info">
              <i class="fa fa-sliders"></i> TODAS AS CONFIGURAÇÕES DETALHADAS
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</header>

<!-- REAL-TIME EVENTS HUD BAR -->
<section class="events-hud-bar">
  <div class="container">
    <div class="events-hud-inner">
      <div class="events-hud-title">
        <i class="fa fa-clock-o text-gold"></i> <strong>PRÓXIMOS EVENTOS:</strong>
      </div>
      <div class="events-hud-list">
        <div class="event-hud-badge">
          <span class="event-hud-name">Castle Siege:</span>
          <span class="event-hud-time text-gold"><i class="fa fa-fort-awesome"></i> Domingo 20:00</span>
        </div>
        <div class="event-hud-badge">
          <span class="event-hud-name">Blood Castle:</span>
          <span class="event-hud-time text-cyan"><i class="fa fa-fire"></i> A cada 2 Horas</span>
        </div>
        <div class="event-hud-badge">
          <span class="event-hud-name">Devil Square:</span>
          <span class="event-hud-time text-cyan"><i class="fa fa-bolt"></i> A cada 2 Horas</span>
        </div>
        <div class="event-hud-badge">
          <span class="event-hud-name">Chaos Castle:</span>
          <span class="event-hud-time text-gold"><i class="fa fa-trophy"></i> A cada 4 Horas</span>
        </div>
        <div class="event-hud-badge">
          <span class="event-hud-name">Invasão Dourados:</span>
          <span class="event-hud-time text-warning"><i class="fa fa-star"></i> A cada 3 Horas</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT WRAPPER (100% NATIVE, ZERO IFRAMES) -->
<main class="main-body-container">
  <div class="container">
    <div class="main-glass-panel">

      <?php if ($page == 'home'): ?>

        <!-- HALL OF FAME (REAL OPENMU CHARACTERS) -->
        <?php include("tops_site.php"); ?>

        <!-- QUICK ACCESS 3D CARDS -->
        <div class="quick-cards-grid">
          <a href="site.php?p=ranking" class="quick-card">
            <div class="qc-icon-box qc-gold"><i class="fa fa-trophy"></i></div>
            <h4>TOP RANKINGS</h4>
            <p>Melhores jogadores e guildas</p>
          </a>
          <a href="site.php?p=ranking&tipo=castle" class="quick-card">
            <div class="qc-icon-box qc-red"><i class="fa fa-fort-awesome"></i></div>
            <h4>CASTLE SIEGE</h4>
            <p>Guerra semanal pelo castelo</p>
          </a>
          <a href="site.php?p=ranking&tipo=pvp" class="quick-card">
            <div class="qc-icon-box qc-cyan"><i class="fa fa-crosshairs"></i></div>
            <h4>REI DO PVP</h4>
            <p>Gladiadores da arena</p>
          </a>
          <a href="site.php?p=eventos" class="quick-card">
            <div class="qc-icon-box qc-yellow"><i class="fa fa-star"></i></div>
            <h4>INVASÕES</h4>
            <p>Bosses e Goldens em tempo real</p>
          </a>
          <a href="site.php?p=guilds" class="quick-card">
            <div class="qc-icon-box qc-purple"><i class="fa fa-users"></i></div>
            <h4>GUILDAS</h4>
            <p>Alianças e batalhas épicas</p>
          </a>
          <a href="site.php?p=dicas" class="quick-card">
            <div class="qc-icon-box qc-green"><i class="fa fa-graduation-cap"></i></div>
            <h4>GUIA INICIANTE</h4>
            <p>Como evoluir no servidor</p>
          </a>
        </div>

        <!-- OFFICIAL NEWS SECTION -->
        <div class="news-feed-wrapper">
          <div class="section-gold-header">
            <h3><i class="fa fa-newspaper-o text-gold"></i> NOTÍCIAS & <span>COMUNICADOS OFICIAIS</span></h3>
          </div>

          <div class="modern-news-card">
            <div class="news-card-header">
              <div class="news-badge-wrap">
                <span class="badge-news-type">LANÇAMENTO OFICIAL</span>
                <h4>Grande Abertura do MU Dravaryn Season 6 Episode 3</h4>
              </div>
              <div class="news-date-tag">
                <i class="fa fa-calendar text-gold"></i> <?=date('d/m/Y');?>
              </div>
            </div>

            <div class="news-card-body">
              <p>É com grande honra e dedicação que abrimos os portais de <strong>MU Dravaryn Season 6</strong>!</p>
              <p>Construímos este servidor pensando na melhor jogabilidade dos anos de ouro do MU Online:</p>
              <div class="news-features-grid">
                <div class="nf-item"><i class="fa fa-check text-gold"></i> <strong>Exp:</strong> 50x Geral | 30x Master</div>
                <div class="nf-item"><i class="fa fa-check text-gold"></i> <strong>Drop:</strong> 20% com jóias valorizadas</div>
                <div class="nf-item"><i class="fa fa-check text-gold"></i> <strong>Spots:</strong> 1.399 spots balanceados</div>
                <div class="nf-item"><i class="fa fa-check text-gold"></i> <strong>Invasões:</strong> 9 Invasões com Kundun, Selupan e Medusa</div>
                <div class="nf-item"><i class="fa fa-check text-gold"></i> <strong>Castle Siege:</strong> Todo domingo às 20h00</div>
                <div class="nf-item"><i class="fa fa-check text-gold"></i> <strong>Anti-Hack:</strong> Proteção de ponta ativa 24 horas</div>
              </div>
              <p style="margin-top:15px;">Cadastre sua conta agora e baixe o cliente completo para iniciar sua jornada épica!</p>
            </div>

            <div class="news-card-footer">
              <span>Publicado por: <strong class="text-gold">Equipe Dravaryn</strong></span>
              <span><i class="fa fa-shield text-gold"></i> Servidor 100% Protegido</span>
            </div>
          </div>
        </div>

      <?php elseif ($page == 'cadastro'): ?>

        <!-- NATIVE REGISTRATION -->
        <div class="native-view-box">
          <div class="section-gold-header">
            <h3><i class="fa fa-user-plus text-gold"></i> CRIAR <span>NOVA CONTA</span></h3>
          </div>

          <div class="register-form-box">
            <form action="cadastrar_done.php" method="post" class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-3 control-label">Nome de Usuário (Login):</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control luxury-input" name="ps_loginname" maxlength="10" placeholder="Digite seu login (4 a 10 letras/números)" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Nome Completo:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control luxury-input" name="ps_name" maxlength="50" placeholder="Seu nome completo" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">E-mail Válido:</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control luxury-input" name="ps_email" maxlength="50" placeholder="seu-email@dominio.com" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Confirmar E-mail:</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control luxury-input" name="ps_email2" maxlength="50" placeholder="Confirme seu e-mail" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Senha de Acesso:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control luxury-input" name="ps_password" maxlength="20" placeholder="Crie uma senha forte" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 control-label">Confirmar Senha:</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control luxury-input" name="ps_repassword" maxlength="20" placeholder="Repita sua senha" required>
                </div>
              </div>

              <input type="hidden" name="ps_person_id" value="111111111111111111">
              <input type="hidden" name="extcode" value="1234">
              <input type="hidden" name="extcode1" value="1234">

              <div class="form-group text-center" style="margin-top:25px;">
                <div class="col-sm-offset-3 col-sm-8">
                  <button type="submit" class="btn btn-hero-primary btn-block" style="border-radius:8px;">
                    <i class="fa fa-check-circle"></i> CONCLUIR MEU CADASTRO
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>

      <?php elseif ($page == 'download'): ?>

        <!-- NATIVE DOWNLOAD -->
        <div class="native-view-box">
          <div class="section-gold-header">
            <h3><i class="fa fa-download text-gold"></i> DOWNLOAD <span>DO CLIENTE OFICIAL</span></h3>
          </div>

          <div class="row" style="margin-top:25px;">
            <div class="col-md-6 col-sm-12" style="margin-bottom:25px;">
              <div class="luxury-download-card">
                <span class="card-ribbon">RECOMENDADO</span>
                <h4><i class="fa fa-cloud-download text-gold"></i> CLIENTE COMPLETO (INSTALADOR)</h4>
                <p>Instalador oficial do MU Dravaryn Season 6 com som, músicas, efeitos HD e anti-hack integrado.</p>
                <div class="card-meta-info">
                  <span><i class="fa fa-hdd-o text-gold"></i> Tamanho: 1.2 GB</span>
                  <span><i class="fa fa-calendar text-gold"></i> <?=date('d/m/Y');?></span>
                </div>
                <a href="http://187.127.26.213:8085/MUDravaryn_Full_v1.42.exe" class="btn btn-hero-primary btn-block">
                  <i class="fa fa-download"></i> BAIXAR LINK DIRETO
                </a>
              </div>
            </div>

            <div class="col-md-6 col-sm-12" style="margin-bottom:25px;">
              <div class="luxury-download-card">
                <span class="card-ribbon" style="background:#00d2ff; color:#050914;">OPÇÃO 2</span>
                <h4><i class="fa fa-cloud-download text-cyan"></i> ESPELHO MEGA / DRIVE</h4>
                <p>Link espelho de alta velocidade no Mega caso sua conexão necessite de acelerador.</p>
                <div class="card-meta-info">
                  <span><i class="fa fa-hdd-o text-cyan"></i> Tamanho: 1.2 GB</span>
                  <span><i class="fa fa-shield text-cyan"></i> 100% Seguro</span>
                </div>
                <a href="https://mega.nz/" target="_blank" class="btn btn-hero-secondary btn-block">
                  <i class="fa fa-external-link"></i> BAIXAR VIA MEGA
                </a>
              </div>
            </div>
          </div>
        </div>

      <?php elseif ($page == 'info'): ?>

        <!-- NATIVE SERVER INFO -->
        <div class="native-view-box">
          <div class="section-gold-header">
            <h3><i class="fa fa-info-circle text-gold"></i> ESPECIFICAÇÕES <span>DO SERVIDOR</span></h3>
          </div>

          <table class="table luxury-table">
            <thead>
              <tr><th>Configuração</th><th>Detalhe Oficial</th></tr>
            </thead>
            <tbody>
              <tr><td><strong>Versão Oficial:</strong></td><td class="text-gold">Season 6 Episode 3 Classic</td></tr>
              <tr><td><strong>Experiência Normal:</strong></td><td class="text-cyan">50x Dinâmica</td></tr>
              <tr><td><strong>Experiência Master:</strong></td><td class="text-cyan">30x</td></tr>
              <tr><td><strong>Drop Rate de Itens:</strong></td><td class="text-gold">20% (Jóias e Itens valorizados)</td></tr>
              <tr><td><strong>Sistema de Reset:</strong></td><td>Pontuativo (Medium-Slow)</td></tr>
              <tr><td><strong>Bug Bless:</strong></td><td class="text-danger">OFF (100% Desativado)</td></tr>
              <tr><td><strong>Spots de Monstros:</strong></td><td class="text-gold">1.399 spots balanceados</td></tr>
              <tr><td><strong>Castle Siege:</strong></td><td>Todo Domingo às 20h00</td></tr>
              <tr><td><strong>Invasões:</strong></td><td>Goldens, Red Dragon, Kundun, Medusa, Selupan</td></tr>
            </tbody>
          </table>
        </div>

      <?php elseif ($page == 'ranking'): ?>

        <!-- NATIVE RANKING -->
        <div class="native-view-box">
          <div class="section-gold-header">
            <h3><i class="fa fa-trophy text-gold"></i> RANKING DOS <span>MELHORES JOGADORES</span></h3>
          </div>

          <table class="table luxury-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Personagem</th>
                <th>Experiência</th>
                <th>Resets</th>
                <th>Level</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $r_res = @mssql_query('SELECT "Name", "Experience", "MasterExperience", "PlayerKillCount" FROM data."Character" ORDER BY "Experience" DESC LIMIT 15');
              if ($r_res && @mssql_num_rows($r_res) > 0) {
                  $pos = 1;
                  while ($rc = @mssql_fetch_array($r_res)) {
                      $cname = htmlspecialchars($rc['Name']);
                      $cexp  = number_format((float)$rc['Experience']);
                      $resets = floor((float)$rc['MasterExperience'] / 100000000);
                      $lvl = 400;
                      $medal = ($pos == 1) ? '🥇 ' : (($pos == 2) ? '🥈 ' : (($pos == 3) ? '🥉 ' : ''));
                      echo "<tr>
                        <td><strong>$medal#$pos</strong></td>
                        <td class='text-gold'><i class='fa fa-shield'></i> $cname</td>
                        <td>$cexp</td>
                        <td class='text-cyan'>$resets</td>
                        <td>$lvl</td>
                        <td><span class='text-green'><i class='fa fa-circle'></i> Ativo</span></td>
                      </tr>";
                      $pos++;
                  }
              } else {
                  echo "<tr><td colspan='6' class='text-center'>Nenhum personagem registrado no momento.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

      <?php else: ?>
        <div class="native-view-box text-center" style="padding:60px 0;">
          <h3>PÁGINA EM ATUALIZAÇÃO</h3>
          <p>Esta funcionalidade estará disponível em breve com o novo layout!</p>
          <a href="site.php" class="btn btn-hero-primary" style="display:inline-block; margin-top:20px;">Voltar ao Início</a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</main>

<!-- LUXURY FOOTER -->
<footer class="modern-footer">
  <div class="container">
    <div class="row footer-grid">
      <div class="col-md-4 footer-about">
        <div class="footer-logo-wrap">
          <img src="img/logoJM.png" alt="Dravaryn" class="footer-brand-logo">
          <h3>MU DRAVARYN</h3>
        </div>
        <p>O maior e mais estável servidor de MU Online Season 6 do Brasil. Servidor balanceado, proteção de ponta e suporte dedicado.</p>
      </div>

      <div class="col-md-2 col-sm-4 footer-links-col">
        <h4>O JOGO</h4>
        <ul>
          <li><a href="site.php?p=cadastro">Criar Conta</a></li>
          <li><a href="site.php?p=download">Download</a></li>
          <li><a href="site.php?p=info">Configurações</a></li>
          <li><a href="site.php?p=comandos">Comandos</a></li>
        </ul>
      </div>

      <div class="col-md-3 col-sm-4 footer-links-col">
        <h4>INFORMAÇÕES</h4>
        <ul>
          <li><a href="site.php?p=dicas">Guia de Iniciantes</a></li>
          <li><a href="site.php?p=eventos">Horários de Eventos</a></li>
          <li><a href="site.php?p=ranking">Rankings Oficiais</a></li>
          <li><a href="site.php?p=guilds">Guildas do Servidor</a></li>
        </ul>
      </div>

      <div class="col-md-3 col-sm-4 footer-links-col">
        <h4>COMUNIDADE</h4>
        <ul>
          <li><a href="https://discord.gg/" target="_blank"><i class="fa fa-comments text-gold"></i> Discord Oficial</a></li>
          <li><a href="https://chat.whatsapp.com/" target="_blank"><i class="fa fa-whatsapp text-gold"></i> Grupo WhatsApp</a></li>
          <li><a href="site.php?p=contato"><i class="fa fa-life-ring text-gold"></i> Suporte Técnico</a></li>
        </ul>
      </div>
    </div>

    <div class="footer-copyright-bar">
      <div class="row">
        <div class="col-sm-6 text-left">
          <p>&copy; <?=date('Y');?> MU Dravaryn. Todos os direitos reservados.</p>
        </div>
        <div class="col-sm-6 text-right">
          <p>Designed for <strong>MU Dravaryn Season 6 Episode 3</strong></p>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

<script>
// Live Server Clock
function updateClock() {
    var now = new Date();
    var h = String(now.getHours()).padStart(2, '0');
    var m = String(now.getMinutes()).padStart(2, '0');
    var s = String(now.getSeconds()).padStart(2, '0');
    var el = document.getElementById('server-live-clock');
    if (el) el.innerText = h + ':' + m + ':' + s;
}
setInterval(updateClock, 1000);
updateClock();
</script>

</body>
</html>
