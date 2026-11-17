<?php
header('Content-Type: text/html; charset=utf-8');
require_once("inclu/config_index.php");

// Helper function to resolve OpenMU class codes
function get_mu_class_name($class_id) {
    switch ((int)$class_id) {
        case 0: return 'Dark Wizard';
        case 1: return 'Soul Master';
        case 2: return 'Grand Master';
        case 16: return 'Dark Knight';
        case 17: return 'Blade Knight';
        case 18: return 'Blade Master';
        case 32: return 'Fairy Elf';
        case 33: return 'Muse Elf';
        case 34: return 'High Elf';
        case 48: return 'Magic Gladiator';
        case 50: return 'Duel Master';
        case 64: return 'Dark Lord';
        case 66: return 'Lord Emperor';
        case 80: return 'Summoner';
        case 81: return 'Bloody Summoner';
        case 82: return 'Dimension Master';
        case 96: return 'Rage Fighter';
        case 98: return 'Fist Master';
        default: return 'Guerreiro';
    }
}

// Fetch real OpenMU database stats
$dados_server = @mssql_fetch_row(mssql_query("SELECT * from public.fn_info()"));
$server_on    = isset($dados_server[0]) ? (int)$dados_server[0] : 1;
$acr2         = isset($dados_server[1]) ? (int)$dados_server[1] : 20;
$acr3         = isset($dados_server[2]) ? (int)$dados_server[2] : 77;

// Fetch Top 5 characters from PostgreSQL view
$top_chars_res = @mssql_query("SELECT \"Name\", \"cLevel\", \"ResetCount\", \"Class\" FROM public.character ORDER BY \"ResetCount\" DESC, \"cLevel\" DESC LIMIT 5");
$top_characters = [];
if ($top_chars_res) {
    while ($tc = @mssql_fetch_assoc($top_chars_res)) {
        $top_characters[] = $tc;
    }
}

// Fallback if empty
if (empty($top_characters)) {
    $top_characters = [
        ['Name' => 'testgm2Sum', 'cLevel' => 48, 'ResetCount' => 0, 'Class' => 82],
        ['Name' => 'testgm2Rf',  'cLevel' => 48, 'ResetCount' => 0, 'Class' => 98],
        ['Name' => 'quest3Dw',   'cLevel' => 48, 'ResetCount' => 0, 'Class' => 2],
        ['Name' => 'testgmElf',  'cLevel' => 48, 'ResetCount' => 0, 'Class' => 34],
        ['Name' => 'testgmMg',   'cLevel' => 48, 'ResetCount' => 0, 'Class' => 50],
    ];
}

// Hall of Fame top characters
$tops_res = @mssql_fetch_row(@mssql_query("SELECT valor1, valor2, valor3, valor4, valor5, valor6, valor7, valor8, valor9, valor10, valor11, valor12, valor13, valor14, valor15, valor16 FROM public.fn_tops()"));
$hof_list = [
    ['role' => 'GRAND MASTER', 'name' => !empty($tops_res[0]) ? $tops_res[0] : 'quest3Dw', 'img' => 'img/charsm.jpg'],
    ['role' => 'BLADE MASTER', 'name' => !empty($tops_res[2]) ? $tops_res[2] : 'test400Dk', 'img' => 'img/charbk.jpg'],
    ['role' => 'HIGH ELF',     'name' => !empty($tops_res[4]) ? $tops_res[4] : 'quest3Elf', 'img' => 'img/charelf.jpg'],
    ['role' => 'DUEL MASTER',  'name' => !empty($tops_res[6]) ? $tops_res[6] : 'testgmMg', 'img' => 'img/charmg.jpg'],
    ['role' => 'LORD EMPEROR', 'name' => !empty($tops_res[8]) ? $tops_res[8] : 'test400Dl', 'img' => 'img/dl.jpg'],
    ['role' => 'DIMENSION M.', 'name' => !empty($tops_res[10]) ? $tops_res[10] : 'testgm2Sum', 'img' => 'img/charbk.jpg'],
    ['role' => 'FIST MASTER',  'name' => !empty($tops_res[12]) ? $tops_res[12] : 'testgm2Rf', 'img' => 'img/dl.jpg'],
    ['role' => 'TOP GUILDA',   'name' => !empty($tops_res[14]) ? $tops_res[14] : 'Dravaryn', 'img' => 'img/guild.png'],
];

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
  <title>MU Dravaryn - Season 6 Episode 3 • Portal Oficial</title>

  <meta name="title" content="MU Dravaryn - Season 6 Episode 3 Medium-Slow"/>
  <meta name="description" content="O maior e mais épico servidor de MU Online Season 6 do Brasil. 50x EXP, 30x Master, 20% Drop. Castle Siege semanal e economia 100% valorizada!"/>
  <meta name="keywords" content="mu, mu online, mu dravaryn, season 6, season 6 medium, mmorpg, brasil"/>

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

  <!-- Luxury Google Fonts (Cinzel, Montserrat, Rajdhani) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Montserrat:wght@400;500;600;700;800;900&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 3 & Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- Master Vanguard-Grade Stylesheet -->
  <link rel="stylesheet" href="css/site.css?v=5.0">
</head>

<body>

<!-- TOP STICKY NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top modern-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dravaryn-nav" aria-expanded="false">
        <span class="sr-only">Menu</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      <a class="brand-wrapper" href="site.php">
        <img src="img/logo_dravaryn.png" alt="MU Dravaryn" class="brand-logo-img">
        <div class="brand-text-wrap">
          <span class="brand-name">MU <span>DRAVARYN</span></span>
          <span class="brand-sub">Season 6 Episode 3</span>
        </div>
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

      <div class="nav navbar-nav navbar-right nav-auth-actions">
        <?php if ($is_logged): ?>
          <div class="dropdown">
            <button class="btn btn-user-pill dropdown-toggle" type="button" data-toggle="dropdown">
              <img src="<?=$user_avatar;?>" class="user-pill-avatar" alt="Avatar">
              <span class="user-pill-name"><?=$user_login;?></span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="painel/index.php" target="_blank"><i class="fa fa-dashboard text-gold"></i> Painel do Jogador</a></li>
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

<!-- LOGIN MODAL -->
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
            <input type="text" name="login" class="form-control luxury-input" placeholder="Digite seu usuário" required>
          </div>
          <div class="form-group">
            <label class="control-label text-gold">Senha:</label>
            <input type="password" name="oldpwd" class="form-control luxury-input" placeholder="Digite sua senha" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-nav-register btn-block" style="padding:12px;font-size:14px;">ENTRAR NO PAINEL</button>
          <div style="text-align:center;margin-top:12px;">
            <a href="site.php?p=cadastro" class="text-gold-light" style="font-size:12px;">Ainda não tem conta? Cadastre-se grátis</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MONUMENTAL HERO SHOWCASE (VANGUARD ARTWORK) -->
<header class="vanguard-hero">
  <div class="vanguard-hero-overlay"></div>
  <div class="vanguard-hero-radial"></div>

  <div class="vanguard-hero-container">
    <div class="hero-season-badge">
      <span class="pulse-dot"></span> SEASON 6 EPISODE 3 • CLASSIC MEDIUM-SLOW
    </div>

    <!-- Centered Majestic Logo -->
    <img src="img/logo_dravaryn.png" alt="MU Dravaryn Season 6" class="hero-main-logo">

    <h1 class="hero-epic-title">
      ENTRE NA <span class="text-gradient-gold">MÁXIMA</span> EXPERIÊNCIA
    </h1>

    <p class="hero-epic-desc">
      O maior e mais lendário servidor clássico de MU Online do Brasil. Economia 100% valorizada, PvP rigorosamente calibrado e a mais sangrenta batalha semanal pelo <strong>Castle Siege</strong>!
    </p>

    <!-- CTAs -->
    <div class="hero-cta-wrapper">
      <a href="site.php?p=cadastro" class="btn-cta-gold">
        <i class="fa fa-user-plus fa-lg"></i>
        <div>
          <span>CRIAR CONTA GRÁTIS</span>
          <span class="btn-cta-sub">Registro rápido • 3 Dias VIP</span>
        </div>
      </a>

      <a href="site.php?p=download" class="btn-cta-blue">
        <i class="fa fa-download fa-lg"></i>
        <div>
          <span>BAIXAR CLIENTE HD</span>
          <span class="btn-cta-sub">Instalador Completo • 1.2 GB</span>
        </div>
      </a>
    </div>

    <!-- Docked Tactical HUD Bar -->
    <div class="tactical-hud-dock">
      <div class="hud-item">
        <span class="pulse-dot"></span>
        <span>SERVIDOR: <strong class="text-green">ONLINE</strong></span>
      </div>
      <div class="hud-item">
        <i class="fa fa-users"></i>
        <span><strong><?=$acr2;?></strong> Contas</span>
      </div>
      <div class="hud-item">
        <i class="fa fa-shield"></i>
        <span><strong><?=$acr3;?></strong> Heróis</span>
      </div>
      <div class="hud-item">
        <i class="fa fa-signal"></i>
        <span><strong class="text-green"><?=$server_on;?></strong> Jogador Online</span>
      </div>
      <div class="hud-item">
        <i class="fa fa-bolt"></i>
        <span><strong>50x</strong> Geral (Master 30x)</span>
      </div>
      <div class="hud-item">
        <i class="fa fa-diamond"></i>
        <span><strong>20%</strong> Drop</span>
      </div>
      <div class="hud-item">
        <i class="fa fa-fort-awesome"></i>
        <span><strong>Siege:</strong> Dom 20h</span>
      </div>
    </div>

  </div>
</header>

<!-- 5 SHINY CLASSIC ACTION BANNERS -->
<section class="action-banners-section">
  <div class="container">
    <div class="action-banners-grid">
      <a href="site.php?p=ranking&tipo=diario" class="action-banner-card">
        <img src="img/topdiario.png" alt="Top Diário">
      </a>
      <a href="site.php?p=ranking&tipo=semanal" class="action-banner-card">
        <img src="img/topsemanal.png" alt="Top Semanal">
      </a>
      <a href="site.php?p=ranking&tipo=mensal" class="action-banner-card">
        <img src="img/topmensal.png" alt="Top Mensal">
      </a>
      <a href="site.php?p=ranking&tipo=pvp" class="action-banner-card">
        <img src="img/reipvp.png" alt="Rei do PvP">
      </a>
      <a href="site.php?p=ranking&tipo=castle" class="action-banner-card">
        <img src="img/castlesiege.png" alt="Castle Siege">
      </a>
    </div>
  </div>
</section>

<!-- MAIN CONTENT AREA -->
<main class="main-body-container">
  <div class="container">

    <?php if ($page == 'home'): ?>

      <!-- VANGUARD SPLIT SHOWCASE (3D ARCHANGEL + LIVE OPENMU RANKINGS) -->
      <section class="vanguard-split-section">
        <div class="row" style="display:flex;align-items:center;flex-wrap:wrap;">
          
          <!-- LEFT: 3D Archangel Gladiator Render -->
          <div class="col-md-5 col-sm-12">
            <div class="char-showcase-wrapper">
              <img src="img/gladiator.png" alt="Gladiator Archangel" class="char-showcase-img">
              <div class="char-pedestal"></div>
            </div>
          </div>

          <!-- RIGHT: Live OpenMU Database Rankings -->
          <div class="col-md-7 col-sm-12">
            <div class="vanguard-panel-glass">
              <div class="section-vanguard-header">
                <h3><i class="fa fa-trophy text-gold"></i> TOP JOGADORES <span>EM TEMPO REAL</span></h3>
                <p>Classificação ao vivo sincronizada com o banco de dados oficial OpenMU</p>
              </div>

              <div class="table-responsive">
                <table class="vanguard-table">
                  <thead>
                    <tr>
                      <th style="width:40px;">#</th>
                      <th>PERSONAGEM</th>
                      <th>CLASSE</th>
                      <th style="text-align:center;">NÍVEL</th>
                      <th style="text-align:center;">RESETS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $rank = 1;
                    foreach ($top_characters as $c): 
                      $badge_class = $rank == 1 ? 'rank-badge-1' : ($rank == 2 ? 'rank-badge-2' : ($rank == 3 ? 'rank-badge-3' : ''));
                      $class_name  = get_mu_class_name(isset($c['Class']) ? $c['Class'] : 0);
                    ?>
                      <tr>
                        <td>
                          <?php if ($badge_class): ?>
                            <span class="<?=$badge_class;?>"><?=$rank;?></span>
                          <?php else: ?>
                            <span style="color:#7d8c9e;font-weight:700;"><?=$rank;?></span>
                          <?php endif; ?>
                        </td>
                        <td>
                          <strong style="color:#fff;font-size:15px;"><?=$c['Name'];?></strong>
                        </td>
                        <td>
                          <span class="class-badge"><?=$class_name;?></span>
                        </td>
                        <td style="text-align:center;font-weight:700;color:var(--gold-light);">
                          <?=$c['cLevel'];?>
                        </td>
                        <td style="text-align:center;font-weight:800;color:#52e591;">
                          <?=$c['ResetCount'];?>
                        </td>
                      </tr>
                    <?php 
                      $rank++;
                    endforeach; 
                    ?>
                  </tbody>
                </table>
              </div>

              <a href="site.php?p=ranking" class="btn-view-all-ranking">
                <i class="fa fa-list"></i> VER RANKING COMPLETO (TODAS AS CLASSES)
              </a>
            </div>
          </div>

        </div>
      </section>

      <!-- HALL OF FAME (MELHORES DO SERVIDOR - 7 CLASSES + GUILDA) -->
      <section class="hof-section">
        <div class="section-vanguard-header" style="text-align:center;">
          <h3><i class="fa fa-star text-gold"></i> HALL DA FAMA <span>DRAVARYN</span></h3>
          <p>Os maiores guerreiros consagrados de cada linhagem no continente</p>
        </div>

        <div class="hof-cards-grid">
          <?php foreach ($hof_list as $hof): ?>
            <div class="hof-card-item">
              <div class="hof-card-title"><?=$hof['role'];?></div>
              <img src="<?=$hof['img'];?>" alt="<?=$hof['role'];?>" class="hof-avatar-circle">
              <div class="hof-char-name" title="<?=$hof['name'];?>"><?=$hof['name'];?></div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- SERVER FEATURES (VANGUARD 6 CARDS) -->
      <section class="features-section">
        <div class="section-vanguard-header" style="text-align:center;">
          <h3><i class="fa fa-shield text-gold"></i> POR QUE JOGAR NO <span>MU DRAVARYN</span>?</h3>
          <p>Construído por jogadores veteranos para entregar a melhor experiência MMORPG do Brasil</p>
        </div>

        <div class="features-grid">
          <div class="feature-card">
            <div class="feature-icon-box"><i class="fa fa-diamond"></i></div>
            <h4>Economia 100% Valorizada</h4>
            <p>Jóias (Bless, Soul, Chaos, Life) e itens raros têm valor real no mercado de trocas. Sem vendas de itens apelativos em webshop!</p>
          </div>

          <div class="feature-card">
            <div class="feature-icon-box"><i class="fa fa-crosshairs"></i></div>
            <h4>PvP Calibrado & Dinâmico</h4>
            <p>Fórmulas de dano, defesa, SD Ratio e combos ajustadas milimetricamente para garantir batalhas equilibradas entre todas as 7 classes.</p>
          </div>

          <div class="feature-card">
            <div class="feature-icon-box"><i class="fa fa-lock"></i></div>
            <h4>Anti-Hack Ativo 24/7</h4>
            <p>Sistema de segurança com proteção em tempo real no cliente e no servidor contra speedhack, dupes e modificações de memória.</p>
          </div>

          <div class="feature-card">
            <div class="feature-icon-box"><i class="fa fa-fire"></i></div>
            <h4>Invasões & Bosses Épicos</h4>
            <p>Kundun em Kalima 7, Selupan em Raklion, Medusa em Peace Swamp e Invasões de Dourados a cada 2 horas com recompensas nobres.</p>
          </div>

          <div class="feature-card">
            <div class="feature-icon-box"><i class="fa fa-fort-awesome"></i></div>
            <h4>Guerra Castle Siege Semanal</h4>
            <p>A mais disputada batalha de alianças todo domingo às 20h00 pelo controle soberano de Valley of Loren e da Land of Trials.</p>
          </div>

          <div class="feature-card">
            <div class="feature-icon-box"><i class="fa fa-comments"></i></div>
            <h4>Comunidade & Suporte Ativo</h4>
            <p>Comunidade vibrante no Discord oficial, suporte ágil com GM ativa diariamente e eventos especiais todos os fins de semana.</p>
          </div>
        </div>
      </section>

      <!-- OFFICIAL NEWS MODULE -->
      <section class="news-section">
        <div class="news-card-master">
          <div class="news-header-top">
            <div style="display:flex;align-items:center;gap:12px;">
              <span class="news-badge">LANÇAMENTO OFICIAL</span>
              <h4 style="margin:0;color:#fff;font-family:var(--font-heading);font-size:18px;">Grande Abertura MU Dravaryn Season 6 Ep. 3</h4>
            </div>
            <div class="news-date"><i class="fa fa-calendar text-gold"></i> <?=date('d/m/Y');?></div>
          </div>

          <div class="news-body-content">
            <p>É com imensa honra que abrimos oficialmente os portais de <strong>MU Dravaryn Season 6 Episode 3</strong>!</p>
            <p>O servidor foi desenvolvido durante meses para resgatar a autêntica essência e nostalgia do MU Online clássico, aliando estabilidade moderna, taxas equilibradas e uma economia forte:</p>
            
            <div class="row" style="margin:20px 0;">
              <div class="col-md-4 col-sm-6" style="margin-bottom:10px;">
                <i class="fa fa-check text-gold"></i> <strong>Experiência:</strong> 50x Geral (Master 30x)
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom:10px;">
                <i class="fa fa-check text-gold"></i> <strong>Drop Rate:</strong> 20% com jóias valorizadas
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom:10px;">
                <i class="fa fa-check text-gold"></i> <strong>Spots:</strong> 1.399 spots balanceados
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom:10px;">
                <i class="fa fa-check text-gold"></i> <strong>Bug Bless:</strong> OFF (100% Desativado)
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom:10px;">
                <i class="fa fa-check text-gold"></i> <strong>Castle Siege:</strong> Todo domingo às 20h00
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom:10px;">
                <i class="fa fa-check text-gold"></i> <strong>Bônus Inicial:</strong> 3 Dias VIP para novos cadastros
              </div>
            </div>

            <p>Cadastre sua conta agora e baixe o cliente completo para iniciar sua jornada rumo ao topo de Dravaryn!</p>
          </div>

          <div style="border-top:1px solid rgba(255,255,255,0.08);padding-top:15px;margin-top:20px;display:flex;justify-content:space-between;align-items:center;font-size:13px;color:#94a3b8;">
            <span>Publicado por: <strong class="text-gold">Administração Dravaryn</strong></span>
            <span><i class="fa fa-shield text-gold"></i> Servidor 100% Seguro & Protegido</span>
          </div>
        </div>
      </section>

    <?php elseif ($page == 'cadastro'): ?>

      <!-- CADASTRO NATIVO -->
      <section class="subpage-container">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-user-plus text-gold"></i> CRIAR <span>NOVA CONTA</span></h3>
            <p>Cadastre-se agora e receba 3 Dias VIP para acelerar sua jornada!</p>
          </div>

          <form action="cadastrar_done.php" method="post" class="form-horizontal" style="max-width:700px;margin:30px auto 0;">
            <div class="form-group">
              <label class="col-sm-4 control-label text-gold">Login da Conta:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control luxury-input" name="ps_loginname" maxlength="10" placeholder="4 a 10 letras/números" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-gold">Nome Completo:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control luxury-input" name="ps_name" maxlength="50" placeholder="Seu nome completo" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-gold">E-mail Válido:</label>
              <div class="col-sm-8">
                <input type="email" class="form-control luxury-input" name="ps_email" maxlength="50" placeholder="seu-email@dominio.com" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-gold">Confirmar E-mail:</label>
              <div class="col-sm-8">
                <input type="email" class="form-control luxury-input" name="ps_email2" maxlength="50" placeholder="Confirme seu e-mail" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-gold">Senha de Acesso:</label>
              <div class="col-sm-8">
                <input type="password" class="form-control luxury-input" name="ps_password" maxlength="20" placeholder="Crie uma senha forte" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-4 control-label text-gold">Confirmar Senha:</label>
              <div class="col-sm-8">
                <input type="password" class="form-control luxury-input" name="ps_re_password" maxlength="20" placeholder="Repita sua senha" required>
              </div>
            </div>

            <div class="form-group" style="margin-top:30px;">
              <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-cta-gold btn-block">
                  <i class="fa fa-check-circle"></i> CONCLUIR CADASTRO
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>

    <?php elseif ($page == 'download'): ?>

      <!-- DOWNLOAD NATIVO -->
      <section class="subpage-container">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-download text-gold"></i> DOWNLOAD <span>DO CLIENTE</span></h3>
            <p>Baixe o instalador completo e entre no jogo em poucos minutos</p>
          </div>

          <div class="row" style="margin-top:30px;">
            <div class="col-md-6 col-sm-12" style="margin-bottom:25px;">
              <div style="background:rgba(10,27,48,0.7);border:1px solid var(--border-gold);border-radius:10px;padding:25px;text-align:center;">
                <i class="fa fa-file-archive-o fa-3x text-gold" style="margin-bottom:15px;"></i>
                <h4 style="font-family:var(--font-heading);color:#fff;margin:0 0 10px;">CLIENTE COMPLETO COM SOM HD</h4>
                <p style="color:#94a3b8;font-size:13px;margin-bottom:20px;">Tamanho: 1.2 GB • Instalador Oficial com Anti-Hack</p>
                <div style="display:flex;flex-direction:column;gap:10px;">
                  <a href="#" class="btn-cta-gold" style="justify-content:center;">
                    <i class="fa fa-cloud-download"></i> DOWNLOAD VIA GOOGLE DRIVE
                  </a>
                  <a href="#" class="btn-cta-blue" style="justify-content:center;">
                    <i class="fa fa-cloud-download"></i> DOWNLOAD VIA MEGA.NZ
                  </a>
                  <a href="#" class="btn-cta-blue" style="justify-content:center;">
                    <i class="fa fa-cloud-download"></i> DOWNLOAD VIA MEDIAFIRE
                  </a>
                </div>
              </div>
            </div>

            <div class="col-md-6 col-sm-12">
              <div style="background:rgba(10,27,48,0.7);border:1px solid var(--border-gold);border-radius:10px;padding:25px;">
                <h4 style="font-family:var(--font-heading);color:#fff;margin:0 0 15px;"><i class="fa fa-desktop text-gold"></i> REQUISITOS DE SISTEMA</h4>
                <table class="table" style="color:#cbd5e1;font-size:13px;">
                  <tr><th>Sistema:</th><td>Windows 7 / 8 / 10 / 11 (64-bit)</td></tr>
                  <tr><th>Processador:</th><td>Intel Core i3 ou superior</td></tr>
                  <tr><th>Memória RAM:</th><td>4 GB de RAM</td></tr>
                  <tr><th>Placa de Vídeo:</th><td>GeForce 8600GT / Radeon HD ou superior</td></tr>
                  <tr><th>Espaço em Disco:</th><td>3 GB livres</td></tr>
                  <tr><th>DirectX:</th><td>DirectX 9.0c ou mais recente</td></tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

    <?php elseif ($page == 'info'): ?>

      <!-- INFORMAÇÕES NATIVAS -->
      <section class="subpage-container">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-info-circle text-gold"></i> INFORMAÇÕES <span>DO SERVIDOR</span></h3>
            <p>Configurações técnicas oficiais do MU Dravaryn Season 6 Episode 3</p>
          </div>

          <div class="row" style="margin-top:25px;">
            <div class="col-md-6">
              <table class="table" style="color:#cbd5e1;font-size:14px;">
                <tr><th class="text-gold">Versão:</th><td>Season 6 Episode 3 Clássico</td></tr>
                <tr><th class="text-gold">Experiência Geral:</th><td>50x (Dinâmica)</td></tr>
                <tr><th class="text-gold">Experiência Master:</th><td>30x</td></tr>
                <tr><th class="text-gold">Drop Rate:</th><td>20% Valorizado</td></tr>
                <tr><th class="text-gold">Bug Bless:</th><td><span class="text-danger">OFF (100% Desativado)</span></td></tr>
                <tr><th class="text-gold">Level Máximo:</th><td>400 + 400 Master Level</td></tr>
                <tr><th class="text-gold">Pontos por Nível:</th><td>DK/DW/ELF/SUM = 5 | MG/DL/RF = 7</td></tr>
              </table>
            </div>

            <div class="col-md-6">
              <table class="table" style="color:#cbd5e1;font-size:14px;">
                <tr><th class="text-gold">Reset:</th><td>Pontuativo (Mantém status ajustados)</td></tr>
                <tr><th class="text-gold">Spots:</th><td>1.399 Spots espalhados em todos os mapas</td></tr>
                <tr><th class="text-gold">Jóias na Chaos Machine:</th><td>+10 = 70% | +11 = 65% | +12 a +15 = 55%</td></tr>
                <tr><th class="text-gold">Castle Siege:</th><td>Todos os Domingos às 20h00</td></tr>
                <tr><th class="text-gold">Blood Castle:</th><td>A cada 2 horas com recompensas</td></tr>
                <tr><th class="text-gold">Chaos Castle:</th><td>A cada 4 horas com itens Ancient</td></tr>
              </table>
            </div>
          </div>
        </div>
      </section>

    <?php elseif ($page == 'ranking'): ?>

      <!-- RANKING NATIVO COMPLETO -->
      <section class="subpage-container">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-trophy text-gold"></i> RANKINGS <span>OFICIAIS</span></h3>
            <p>Melhores jogadores e heróis de MU Dravaryn</p>
          </div>

          <div class="table-responsive" style="margin-top:20px;">
            <table class="vanguard-table">
              <thead>
                <tr>
                  <th style="width:40px;">#</th>
                  <th>PERSONAGEM</th>
                  <th>CLASSE</th>
                  <th style="text-align:center;">NÍVEL</th>
                  <th style="text-align:center;">RESETS</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $rank = 1;
                foreach ($top_characters as $c): 
                  $badge_class = $rank == 1 ? 'rank-badge-1' : ($rank == 2 ? 'rank-badge-2' : ($rank == 3 ? 'rank-badge-3' : ''));
                  $class_name  = get_mu_class_name(isset($c['Class']) ? $c['Class'] : 0);
                ?>
                  <tr>
                    <td>
                      <?php if ($badge_class): ?>
                        <span class="<?=$badge_class;?>"><?=$rank;?></span>
                      <?php else: ?>
                        <span style="color:#7d8c9e;font-weight:700;"><?=$rank;?></span>
                      <?php endif; ?>
                    </td>
                    <td><strong style="color:#fff;font-size:15px;"><?=$c['Name'];?></strong></td>
                    <td><span class="class-badge"><?=$class_name;?></span></td>
                    <td style="text-align:center;font-weight:700;color:var(--gold-light);"><?=$c['cLevel'];?></td>
                    <td style="text-align:center;font-weight:800;color:#52e591;"><?=$c['ResetCount'];?></td>
                  </tr>
                <?php 
                  $rank++;
                endforeach; 
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>

    <?php else: ?>

      <!-- SUBPÁGINA GENÉRICA -->
      <section class="subpage-container">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-file-text-o text-gold"></i> <?=strtoupper($page);?></h3>
          </div>
          <?php 
            $subfile = $page . ".php";
            if (file_exists($subfile) && $subfile != 'site.php') {
                include($subfile);
            } else {
                echo "<p style='color:#cbd5e1;'>Conteúdo em carregamento...</p>";
            }
          ?>
        </div>
      </section>

    <?php endif; ?>

  </div>
</main>

<!-- VANGUARD LUXURY FOOTER -->
<footer class="vanguard-footer">
  <div class="container text-center">
    <img src="img/logo_dravaryn.png" alt="MU Dravaryn" class="footer-logo">
    <p style="margin:10px auto;max-width:650px;color:#94a3b8;">
      MU Dravaryn Season 6 Episode 3 é um servidor privado independente dedicado aos fãs clássicos de MMORPG. Todos os direitos reservados às respectivas marcas.
    </p>
    <p style="font-size:12px;color:#64748b;margin-top:15px;">
      &copy; <?=date('Y');?> MU Dravaryn • Desenvolvido com excelência AAA.
    </p>
  </div>
</footer>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

</body>
</html>
