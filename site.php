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

// Subpage router (NO IFRAME!)
$page = isset($_GET['p']) ? strtolower(trim($_GET['p'])) : 'home';
$allowed_pages = ['home', 'cadastro', 'download', 'info', 'ranking', 'comandos', 'contato', 'dicas', 'eventos', 'guilds'];
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title>MU Dravaryn - Season 6 Medium Slow • Servidor Oficial</title>

  <meta name="title" content="MU Dravaryn Season 6 Medium Slow"/>
  <meta name="description" content="Servidor Oficial de MU Online Season 6 Medium Slow do Brasil. 50x EXP, 30x Master, 20% Drop. Cadastro grátis!"/>
  <meta name="keywords" content="mu, mu online, mu dravaryn, season 6, mmorpg, brasil"/>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Montserrat:wght@300;400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 3 & Font Awesome CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- Modern Responsive Stylesheet -->
  <link rel="stylesheet" href="css/site.css?v=3.0">
  <link rel="stylesheet" href="css/paginas.css?v=3.0">
</head>

<body class="dravaryn-body">

<!-- STICKY RESPONSIVE NAVBAR -->
<nav class="navbar menucls navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dravaryn-navbar" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="site.php">
        <img src="img/logoJM.png" alt="MU Dravaryn" class="nav-logo">
        <span class="brand-text">MU <span>DRAVARYN</span></span>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="dravaryn-navbar">
      <ul class="nav navbar-nav nav-center-links">
        <li class="<?=$page=='home'?'active':'';?>"><a href="site.php"><i class="fa fa-home"></i> INÍCIO</a></li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gamepad"></i> O JOGO <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="site.php?p=cadastro"><i class="fa fa-user-plus text-gold"></i> Criar Conta</a></li>
            <li><a href="site.php?p=download"><i class="fa fa-download text-gold"></i> Download do Jogo</a></li>
            <li><a href="site.php?p=info"><i class="fa fa-info-circle text-gold"></i> Informações do Servidor</a></li>
            <li><a href="site.php?p=comandos"><i class="fa fa-terminal text-gold"></i> Comandos do Jogo</a></li>
            <li><a href="site.php?p=dicas"><i class="fa fa-lightbulb-o text-gold"></i> Dicas para Iniciantes</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shield"></i> EVENTOS <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="site.php?p=eventos"><i class="fa fa-clock-o text-gold"></i> Horários dos Eventos</a></li>
            <li><a href="site.php?p=ranking&tipo=castle"><i class="fa fa-fort-awesome text-gold"></i> Castle Siege</a></li>
            <li><a href="site.php?p=ranking&tipo=pvp"><i class="fa fa-crosshairs text-gold"></i> Rei do PvP</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-trophy"></i> RANKINGS <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="site.php?p=ranking"><i class="fa fa-list-ol text-gold"></i> Ranking Geral</a></li>
            <li><a href="site.php?p=guilds"><i class="fa fa-users text-gold"></i> Ranking de Guilds</a></li>
          </ul>
        </li>

        <li class="<?=$page=='contato'?'active':'';?>"><a href="site.php?p=contato"><i class="fa fa-envelope-o"></i> SUPORTE</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right auth-section">
        <?php if ($is_logged): ?>
        <li class="dropdown user-logged-dropdown">
          <a href="#" class="dropdown-toggle user-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="<?=$user_avatar;?>" class="user-avatar-mini" alt="User">
            <span class="user-name-label"><?=$user_login;?></span>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="painel/index.php" target="_blank"><i class="fa fa-dashboard text-gold"></i> Painel da Conta</a></li>
            <li><a href="site.php?p=mudar_senha"><i class="fa fa-key text-gold"></i> Alterar Senha</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logar.php?deslogar=ok" class="text-danger"><i class="fa fa-sign-out"></i> Desconectar</a></li>
          </ul>
        </li>
        <?php else: ?>
        <form class="navbar-form navbar-right login-form-modern" action="logar.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control nav-input" name="login" placeholder="Conta" required>
            <input type="password" class="form-control nav-input" name="oldpwd" placeholder="Senha" required>
          </div>
          <button type="submit" class="btn btn-login-gold">ENTRAR</button>
          <a href="site.php?p=cadastro" class="btn btn-register-nav">REGISTRAR</a>
        </form>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- HERO SHOWCASE SECTION -->
<header class="hero-section">
  <div class="container">
    <div class="row hero-row">
      
      <!-- HERO LEFT -->
      <div class="col-md-7 col-sm-12 hero-left">
        <div class="hero-badge">
          <span class="badge-dot"></span> SEASON 6 EPISODE 3 • MEDIUM-SLOW
        </div>
        <h1 class="hero-brand-title">MU <span>DRAVARYN</span></h1>
        <p class="hero-tagline">
          O mais lendário servidor medieval do Brasil. PvP balanceado, economia real de jóias e guerra pelo trono do Castle Siege!
        </p>

        <div class="hero-cta-group">
          <a href="site.php?p=cadastro" class="btn-cta-gold">
            <span class="btn-icon"><i class="fa fa-user-plus"></i></span>
            <span class="btn-text">
              <strong>CRIAR CONTA GRÁTIS</strong>
              <small>Cadastro rápido • Comece agora</small>
            </span>
          </a>

          <a href="site.php?p=download" class="btn-cta-blue">
            <span class="btn-icon"><i class="fa fa-download"></i></span>
            <span class="btn-text">
              <strong>BAIXAR CLIENTE COMPLETO</strong>
              <small>Cliente HD Oficial • 1.2 GB</small>
            </span>
          </a>
        </div>
      </div>

      <!-- HERO RIGHT: Server HUD Card (Connected directly to OpenMU Database) -->
      <div class="col-md-5 col-sm-12 hero-right">
        <div class="server-hud-card">
          <div class="hud-header">
            <div class="hud-status-badge">
              <span class="pulse-indicator"></span> SERVIDOR ONLINE
            </div>
            <div class="hud-clock" id="server-time">--:--:--</div>
          </div>

          <div class="hud-body">
            <div class="hud-stat-row">
              <span class="stat-label"><i class="fa fa-cube text-gold"></i> Versão Oficial:</span>
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

            <a href="site.php?p=info" class="btn-hud-details">
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
          <span class="event-time text-cyan">A cada 2h</span>
        </div>
        <div class="ticker-item">
          <span class="event-name">Devil Square:</span>
          <span class="event-time text-cyan">A cada 2h</span>
        </div>
        <div class="ticker-item">
          <span class="event-name">Chaos Castle:</span>
          <span class="event-time text-gold">A cada 4h</span>
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
        <a href="site.php?p=ranking" class="feature-card">
          <div class="card-icon-wrap icon-gold"><i class="fa fa-trophy"></i></div>
          <h4>TOP RANKINGS</h4>
          <p>Geral & Classes</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="site.php?p=ranking&tipo=castle" class="feature-card">
          <div class="card-icon-wrap icon-red"><i class="fa fa-fort-awesome"></i></div>
          <h4>CASTLE SIEGE</h4>
          <p>Guerra no Vale</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="site.php?p=ranking&tipo=pvp" class="feature-card">
          <div class="card-icon-wrap icon-cyan"><i class="fa fa-gavel"></i></div>
          <h4>REI DO PVP</h4>
          <p>Torneio Solo</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="site.php?p=eventos" class="feature-card">
          <div class="card-icon-wrap icon-yellow"><i class="fa fa-star"></i></div>
          <h4>INVASÕES</h4>
          <p>Goldens & Bosses</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="site.php?p=guilds" class="feature-card">
          <div class="card-icon-wrap icon-purple"><i class="fa fa-users"></i></div>
          <h4>GUILDS</h4>
          <p>Alianças & Duelos</p>
        </a>
      </div>

      <div class="col-md-2 col-sm-4 col-xs-6 card-col">
        <a href="site.php?p=dicas" class="feature-card">
          <div class="card-icon-wrap icon-green"><i class="fa fa-lightbulb-o"></i></div>
          <h4>INICIANTES</h4>
          <p>Guia de Evolução</p>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- NATIVE DYNAMIC CONTENT CONTAINER (ZERO IFRAMES!) -->
<main class="main-content-section" id="portal-content">
  <div class="container">
    <div class="portal-glass-container">

      <?php if ($page == 'home'): ?>
        
        <!-- HALL OF FAME NATIVE EMBED -->
        <?php include("tops_site.php"); ?>

        <!-- OFFICIAL NEWS FEED -->
        <div class="news-section-wrap">
          <div class="section-title-bar">
            <h3>ÚLTIMAS <span>NOTÍCIAS & ATUALIZAÇÕES</span></h3>
          </div>

          <div class="news-card-wrap">
            <div class="news-header">
              <h3 class="news-title"><i class="fa fa-star text-gold"></i> Grande Inauguração Oficial - MU Dravaryn Season 6</h3>
              <span class="news-date-badge"><i class="fa fa-calendar"></i> <?=date('d/m/Y');?></span>
            </div>
            <div class="news-body">
              <p>É com imenso orgulho que anunciamos a abertura oficial do <strong>MU Dravaryn Season 6 Episode 3</strong>!</p>
              <p>Trabalhamos intensamente para criar um servidor perfeito, estável e livre de qualquer desbalanceamento.</p>
              <ul>
                <li><strong>Versão:</strong> Season 6 Episode 3 Classic (Medium-Slow)</li>
                <li><strong>Taxas:</strong> Experiência 50x | Master Exp 30x | Drop 20%</li>
                <li><strong>Invasões:</strong> 9 Invasões balanceadas com Kundun, Medusa, Selupan e Red Dragon</li>
                <li><strong>Spots Exclusivos:</strong> 1.399 spots customizados em todos os mapas</li>
                <li><strong>Castle Siege:</strong> Batalha semanal todo domingo às 20h00 com premiações reais!</li>
              </ul>
              <p>Cadastre sua conta agora mesmo e baixe o cliente completo para iniciar sua lenda no MU Dravaryn!</p>
            </div>
            <div class="news-footer">
              <span>Publicado por: <strong class="text-gold">Administração Dravaryn</strong></span>
              <span><i class="fa fa-shield text-gold"></i> Servidor 100% Protegido</span>
            </div>
          </div>
        </div>

      <?php elseif ($page == 'cadastro'): ?>
        
        <!-- NATIVE REGISTRATION FORM -->
        <div class="native-subpage-wrap">
          <div class="section-title-bar">
            <h3>CRIAR <span>NOVA CONTA</span></h3>
          </div>

          <form action="cadastrar_done.php" method="post" class="form-horizontal modern-register-form">
            <div class="form-group">
              <label class="col-sm-3 control-label">Nome de Usuário (Login):</label>
              <div class="col-sm-7">
                <input type="text" class="form-control input-dark" name="ps_loginname" maxlength="10" placeholder="Digite seu login (4 a 10 letras/números)" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Nome Completo:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control input-dark" name="ps_name" maxlength="50" placeholder="Seu nome completo" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">E-mail Válido:</label>
              <div class="col-sm-7">
                <input type="email" class="form-control input-dark" name="ps_email" maxlength="50" placeholder="seu-email@dominio.com" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Confirmar E-mail:</label>
              <div class="col-sm-7">
                <input type="email" class="form-control input-dark" name="ps_email2" maxlength="50" placeholder="Confirme seu e-mail" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Senha de Acesso:</label>
              <div class="col-sm-7">
                <input type="password" class="form-control input-dark" name="ps_password" maxlength="20" placeholder="Crie uma senha forte" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">Confirmar Senha:</label>
              <div class="col-sm-7">
                <input type="password" class="form-control input-dark" name="ps_repassword" maxlength="20" placeholder="Repita sua senha" required>
              </div>
            </div>

            <input type="hidden" name="ps_person_id" value="111111111111111111">
            <input type="hidden" name="extcode" value="1234">
            <input type="hidden" name="extcode1" value="1234">

            <div class="form-group text-center">
              <div class="col-sm-offset-3 col-sm-7">
                <button type="submit" class="btn btn-cta-gold btn-block">
                  <i class="fa fa-check-circle"></i> CONCLUIR CADASTRO
                </button>
              </div>
            </div>
          </form>
        </div>

      <?php elseif ($page == 'download'): ?>
        
        <!-- NATIVE DOWNLOADS -->
        <div class="native-subpage-wrap">
          <div class="section-title-bar">
            <h3>DOWNLOAD <span>DO CLIENTE</span></h3>
          </div>
          <p class="text-center" style="font-size:15px; margin-bottom:30px;">
            Baixe o instalador oficial completo do MU Dravaryn Season 6 com todas as texturas em alta definição, efeitos visuais e som inclusos!
          </p>

          <div class="row">
            <div class="col-md-6 col-sm-12" style="margin-bottom:20px;">
              <div class="download-card">
                <div class="download-badge">RECOMENDADO</div>
                <h4><i class="fa fa-cloud-download text-gold"></i> CLIENTE COMPLETO (INSTALADOR)</h4>
                <p>Versão oficial Season 6 com som, músicas, efeitos HD e anti-hack integrado.</p>
                <div class="download-meta">
                  <span><i class="fa fa-hdd-o"></i> Tamanho: 1.2 GB</span>
                  <span><i class="fa fa-calendar"></i> Atualizado: <?=date('d/m/Y');?></span>
                </div>
                <a href="http://187.127.26.213:8085/MUDravaryn_Full_v1.42.exe" class="btn btn-cta-gold btn-block">
                  <i class="fa fa-download"></i> LINK DIRETO (ALTA VELOCIDADE)
                </a>
              </div>
            </div>

            <div class="col-md-6 col-sm-12" style="margin-bottom:20px;">
              <div class="download-card">
                <div class="download-badge" style="background:#00d2ff; color:#000;">OPÇÃO 2</div>
                <h4><i class="fa fa-cloud-download text-cyan"></i> ESPELHO MEGA / GOOGLE DRIVE</h4>
                <p>Link alternativo caso a sua velocidade com o servidor direto seja reduzida.</p>
                <div class="download-meta">
                  <span><i class="fa fa-hdd-o"></i> Tamanho: 1.2 GB</span>
                  <span><i class="fa fa-check"></i> 100% Livre de Vírus</span>
                </div>
                <a href="https://mega.nz/" target="_blank" class="btn btn-cta-blue btn-block">
                  <i class="fa fa-external-link"></i> BAIXAR VIA MEGA
                </a>
              </div>
            </div>
          </div>
        </div>

      <?php elseif ($page == 'info'): ?>
        
        <!-- NATIVE SERVER INFO -->
        <div class="native-subpage-wrap">
          <div class="section-title-bar">
            <h3>INFORMAÇÕES <span>DO SERVIDOR</span></h3>
          </div>
          
          <table class="table modern-info-table">
            <tr><th>Configuração</th><th>Detalhe Oficial</th></tr>
            <tr><td><strong>Versão do Servidor:</strong></td><td class="text-gold">Season 6 Episode 3 Classic</td></tr>
            <tr><td><strong>Experiência Normal:</strong></td><td class="text-cyan">50x</td></tr>
            <tr><td><strong>Experiência Master:</strong></td><td class="text-cyan">30x</td></tr>
            <tr><td><strong>Drop Rate de Itens:</strong></td><td class="text-gold">20% (Valorizado)</td></tr>
            <tr><td><strong>Sistema de Reset:</strong></td><td>Pontuativo (Medium-Slow)</td></tr>
            <tr><td><strong>Bug Bless:</strong></td><td class="text-danger">Desativado (OFF)</td></tr>
            <tr><td><strong>Spots de Monstros:</strong></td><td class="text-gold">1.399 spots balanceados em todos os mapas</td></tr>
            <tr><td><strong>Castle Siege:</strong></td><td>Todo Domingo às 20h00</td></tr>
            <tr><td><strong>Invasões Automáticas:</strong></td><td>Goldens, Red Dragon, Kundun, Medusa, Selupan</td></tr>
          </table>
        </div>

      <?php elseif ($page == 'ranking'): ?>
        
        <!-- NATIVE RANKINGS -->
        <div class="native-subpage-wrap">
          <div class="section-title-bar">
            <h3>RANKING <span>TOP JOGADORES</span></h3>
          </div>
          
          <table class="table modern-info-table">
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
              $r_res = @mssql_query("SELECT "Name", "Experience", "MasterExperience", "PlayerKillCount" FROM data."Character" ORDER BY "Experience" DESC LIMIT 15");
              if ($r_res && @mssql_num_rows($r_res) > 0) {
                  $pos = 1;
                  while ($rc = @mssql_fetch_array($r_res)) {
                      $cname = $rc['Name'];
                      $cexp  = number_format((float)$rc['Experience']);
                      $resets = floor((float)$rc['MasterExperience'] / 100000000);
                      $lvl = 400;
                      echo "<tr>
                        <td><strong>#$pos</strong></td>
                        <td class='text-gold'><i class='fa fa-shield'></i> $cname</td>
                        <td>$cexp</td>
                        <td class='text-cyan'>$resets</td>
                        <td>$lvl</td>
                        <td><span class='text-green'><i class='fa fa-circle'></i> Normal</span></td>
                      </tr>";
                      $pos++;
                  }
              } else {
                  echo "<tr><td colspan='6' class='text-center'>Nenhum personagem registrado até o momento.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

      <?php else: ?>
        <div class="native-subpage-wrap text-center" style="padding:40px 0;">
          <h3>Página em Manutenção</h3>
          <p>Esta funcionalidade estará disponível em breve!</p>
          <a href="site.php" class="btn btn-cta-gold">Voltar ao Início</a>
        </div>
      <?php endif; ?>

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
          <li><a href="site.php?p=cadastro">Criar Conta</a></li>
          <li><a href="site.php?p=download">Download</a></li>
          <li><a href="site.php?p=info">Configurações</a></li>
          <li><a href="site.php?p=comandos">Comandos</a></li>
        </ul>
      </div>

      <div class="col-md-3 col-sm-4 footer-col">
        <h4>INFORMAÇÕES</h4>
        <ul class="footer-links">
          <li><a href="site.php?p=dicas">Dicas para Iniciantes</a></li>
          <li><a href="site.php?p=eventos">Horários de Eventos</a></li>
          <li><a href="site.php?p=ranking">Rankings Oficiais</a></li>
          <li><a href="site.php?p=guilds">Guilds do Servidor</a></li>
        </ul>
      </div>

      <div class="col-md-3 col-sm-4 footer-col">
        <h4>COMUNIDADE</h4>
        <ul class="footer-social-links">
          <li><a href="https://discord.gg/" target="_blank"><i class="fa fa-comments"></i> Discord Oficial</a></li>
          <li><a href="https://chat.whatsapp.com/" target="_blank"><i class="fa fa-whatsapp"></i> Grupo WhatsApp</a></li>
          <li><a href="site.php?p=contato"><i class="fa fa-life-ring"></i> Suporte Técnico</a></li>
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
