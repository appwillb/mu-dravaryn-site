<?php
header('Content-Type: text/html; charset=utf-8');
define('DRAVARYN_PORTAL', true);
require_once("inclu/config_index.php");

// Helper function to resolve OpenMU class codes
function get_mu_class_name($class_id) {
    switch ((int)$class_id) {
        case 0: return 'Dark Wizard';
        case 1: case 2: return (int)$class_id === 3 ? 'Grand Master' : 'Soul Master';
        case 3: return 'Grand Master';
        case 4: case 16: return 'Dark Knight';
        case 6: case 17: return 'Blade Knight';
        case 7: case 18: return 'Blade Master';
        case 8: case 32: return 'Fairy Elf';
        case 10: case 33: return 'Muse Elf';
        case 11: case 34: return 'High Elf';
        case 12: case 48: return 'Magic Gladiator';
        case 13: case 50: return 'Duel Master';
        case 16: case 64: return 'Dark Lord';
        case 17: case 66: return 'Lord Emperor';
        case 20: case 80: return 'Summoner';
        case 22: case 81: return 'Bloody Summoner';
        case 23: case 82: return 'Dimension Master';
        case 24: case 96: return 'Rage Fighter';
        case 25: case 98: return 'Fist Master';
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

if (isset($_COOKIE["usuario"]) && isset($_COOKIE["senha"])) {
    $user_login = htmlspecialchars($_COOKIE["usuario"]);
    $sql_dados = @mssql_query("SELECT img from memb_info where LOWER(memb___id)=LOWER('$user_login')"); 
    $login_dados = @mssql_fetch_row($sql_dados);
    if (!empty($login_dados[0])) {
        $user_avatar = "avatar/thumb.php?imagem=" . urlencode($login_dados[0]) . "&y=30&x=30&qualidade=100";
    }
    $is_logged = true;
}

// Subpage router (NO IFRAMES!)
$page = isset($_GET['p']) ? strtolower(trim($_GET['p'])) : 'home';
$allowed_pages = ['home', 'painel', 'loja', 'shop', 'cadastro', 'download', 'info', 'ranking', 'comandos', 'contato', 'suporte', 'dicas', 'eventos', 'guilds', 'mudar_senha'];
if (!in_array($page, $allowed_pages)) {
    $page = 'home';
}

$subpage_meta = [
    'painel'      => ['short' => 'Painel', 'title' => 'PAINEL DO <span>JOGADOR</span>', 'desc' => 'Gerencie seus personagens, resets, distribuição de pontos e atributos da conta.'],
    'loja'        => ['short' => 'WebShop', 'title' => 'LOJA DE ITENS & <span>WEBSHOP</span>', 'desc' => 'Planos VIP, Sets +13 Full, Armas Raras, Asas Level 3, Jóias e Doações PIX.'],
    'shop'        => ['short' => 'WebShop', 'title' => 'LOJA DE ITENS & <span>WEBSHOP</span>', 'desc' => 'Planos VIP, Sets +13 Full, Armas Raras, Asas Level 3, Jóias e Doações PIX.'],
    'cadastro'    => ['short' => 'Cadastro', 'title' => 'CRIAR <span>NOVA CONTA</span>', 'desc' => 'Cadastre-se gratuitamente agora e receba 3 Dias VIP para turbinar seu início!'],
    'download'    => ['short' => 'Download', 'title' => 'DOWNLOAD <span>DO CLIENTE</span>', 'desc' => 'Baixe o instalador oficial completo com som HD e anti-hack integrado.'],
    'info'        => ['short' => 'Informações', 'title' => 'INFORMAÇÕES <span>DO SERVIDOR</span>', 'desc' => 'Configurações oficiais de experiência, taxas, drops, invasões e regras do jogo.'],
    'ranking'     => ['short' => 'Rankings', 'title' => 'RANKINGS <span>OFICIAIS</span>', 'desc' => 'Classificação em tempo real sincronizada diretamente com o banco de dados.'],
    'comandos'    => ['short' => 'Comandos', 'title' => 'COMANDOS <span>IN-GAME</span>', 'desc' => 'Guia completo de todos os comandos disponíveis no servidor MU Dravaryn.'],
    'contato'     => ['short' => 'Suporte', 'title' => 'SUPORTE & <span>ATENDIMENTO</span>', 'desc' => 'Canais oficiais de atendimento ao jogador: Discord, WhatsApp e Suporte Técnico.'],
    'suporte'     => ['short' => 'Suporte', 'title' => 'SUPORTE & <span>ATENDIMENTO</span>', 'desc' => 'Canais oficiais de atendimento ao jogador: Discord, WhatsApp e Suporte Técnico.'],
    'dicas'       => ['short' => 'Dicas', 'title' => 'DICAS PARA <span>INICIANTES</span>', 'desc' => 'Dicas essenciais de evolução rápida, melhores spots e valorização de jóias.'],
    'eventos'     => ['short' => 'Eventos', 'title' => 'HORÁRIOS DOS <span>EVENTOS</span>', 'desc' => 'Cronograma completo dos eventos automáticos, chefes lendários e Castle Siege.'],
    'guilds'      => ['short' => 'Guildas', 'title' => 'GUILDAS & <span>ALIANÇAS</span>', 'desc' => 'As guildas mais poderosas e temidas do continente de Dravaryn.'],
];

$page_meta = isset($subpage_meta[$page]) ? $subpage_meta[$page] : [
    'short' => strtoupper($page),
    'title' => strtoupper($page),
    'desc'  => 'Portal Oficial MU Dravaryn Season 6 Episode 3'
];

// Handle Registration POST
$reg_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_register'])) {
    $r_login = isset($_POST['ps_loginname']) ? strtolower(trim($_POST['ps_loginname'])) : '';
    $r_name  = isset($_POST['ps_name']) ? trim($_POST['ps_name']) : '';
    $r_email = isset($_POST['ps_email']) ? strtolower(trim($_POST['ps_email'])) : '';
    $r_email2= isset($_POST['ps_email2']) ? strtolower(trim($_POST['ps_email2'])) : '';
    $r_pwd   = isset($_POST['ps_password']) ? trim($_POST['ps_password']) : '';
    $r_pwd2  = isset($_POST['ps_re_password']) ? trim($_POST['ps_re_password']) : (isset($_POST['ps_repassword']) ? trim($_POST['ps_repassword']) : '');
    $r_ip    = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '127.0.0.1';

    if (empty($r_login) || empty($r_name) || empty($r_email) || empty($r_pwd)) {
        $reg_error = "Preencha todos os campos obrigatórios!";
    } elseif (strlen($r_login) < 4 || strlen($r_login) > 10) {
        $reg_error = "O login deve conter entre 4 e 10 caracteres alfanuméricos!";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $r_login)) {
        $reg_error = "O login não pode conter espaços ou caracteres especiais!";
    } elseif (strlen($r_pwd) < 4 || strlen($r_pwd) > 20) {
        $reg_error = "A senha deve conter entre 4 e 20 caracteres!";
    } elseif ($r_pwd !== $r_pwd2) {
        $reg_error = "A confirmação de senha não confere com a senha digitada!";
    } elseif (!empty($r_email2) && $r_email !== $r_email2) {
        $reg_error = "A confirmação de e-mail não confere com o e-mail digitado!";
    } elseif (!filter_var($r_email, FILTER_VALIDATE_EMAIL)) {
        $reg_error = "Informe um endereço de e-mail válido!";
    } else {
        $safe_login = addslashes($r_login);
        $check_login = @mssql_query("SELECT memb___id FROM MEMB_INFO WHERE LOWER(memb___id) = LOWER('$safe_login')");
        $exists = ($check_login && @mssql_num_rows($check_login) > 0);

        if (!$exists) {
            $check_openmu = @mssql_query("SELECT \"LoginName\" FROM data.\"Account\" WHERE LOWER(\"LoginName\") = LOWER('$safe_login')");
            $exists = ($check_openmu && @mssql_num_rows($check_openmu) > 0);
        }

        if ($exists) {
            $reg_error = "Este login já está cadastrado por outro jogador! Escolha outro login.";
        } else {
            $safe_email = addslashes($r_email);
            $check_mail = @mssql_query("SELECT mail_addr FROM MEMB_INFO WHERE LOWER(mail_addr) = LOWER('$safe_email')");
            if ($check_mail && @mssql_num_rows($check_mail) > 0) {
                $reg_error = "Este e-mail já foi utilizado em outra conta cadastrada!";
            } else {
                $hash = password_hash($r_pwd, PASSWORD_BCRYPT);
                $safe_hash = addslashes($hash);
                $safe_name = addslashes($r_name);

                @mssql_query("SELECT public.fn_register_account('$safe_login', '$safe_hash', '$safe_name', '$safe_email', '$r_ip')");

                // Auto login the newly registered user
                $cookie_pass = md5($hash);
                setcookie("usuario", $r_login, time() + (86400 * 30), "/");
                setcookie("senha", $cookie_pass, time() + (86400 * 30), "/");
                $_SESSION['usuario'] = $r_login;
                $_SESSION['senha']   = $cookie_pass;

                if (!headers_sent()) {
                    header("Location: site.php?p=painel&cadastro=sucesso");
                }
                echo "<script>window.location.href='site.php?p=painel&cadastro=sucesso';</script>";
                exit();
            }
        }
    }
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
  <link rel="stylesheet" href="css/site.css?v=6.0">
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
        <li class="<?=$page=='painel'?'active':'';?>">
          <a href="<?=$is_logged?'site.php?p=painel':'#';?>" <?=$is_logged?'':'data-toggle="modal" data-target="#loginModal"';?> style="color:var(--gold-light); font-weight:700;">
            <i class="fa fa-dashboard text-gold"></i> PAINEL
          </a>
        </li>
        <li class="<?=(in_array($page, ['loja', 'shop']))?'active':'';?>">
          <a href="site.php?p=loja" style="color:#52e591; font-weight:700;">
            <i class="fa fa-shopping-cart" style="color:#52e591;"></i> WEBSHOP
          </a>
        </li>

        <li class="dropdown <?=(in_array($page, ['info', 'comandos', 'dicas', 'eventos', 'guilds']))?'active':'';?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            O JOGO <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="site.php?p=info"><i class="fa fa-info-circle text-gold"></i> Informações do Servidor</a></li>
            <li><a href="site.php?p=comandos"><i class="fa fa-terminal text-gold"></i> Comandos In-Game</a></li>
            <li><a href="site.php?p=dicas"><i class="fa fa-lightbulb-o text-gold"></i> Dicas para Iniciantes</a></li>
            <li><a href="site.php?p=eventos"><i class="fa fa-clock-o text-gold"></i> Horários dos Eventos</a></li>
            <li><a href="site.php?p=guilds"><i class="fa fa-shield text-gold"></i> Guildas & Alianças</a></li>
          </ul>
        </li>

        <li class="<?=$page=='download'?'active':'';?>"><a href="site.php?p=download"><i class="fa fa-download text-gold"></i> DOWNLOAD</a></li>
        <li class="<?=$page=='cadastro'?'active':'';?>"><a href="site.php?p=cadastro"><i class="fa fa-user-plus text-gold"></i> CADASTRO</a></li>
        <li class="<?=$page=='ranking'?'active':'';?>"><a href="site.php?p=ranking"><i class="fa fa-trophy text-gold"></i> RANKINGS</a></li>
        <li class="<?=(in_array($page, ['contato', 'suporte']))?'active':'';?>"><a href="site.php?p=contato"><i class="fa fa-life-ring text-gold"></i> SUPORTE</a></li>
      </ul>

      <div class="nav navbar-nav navbar-right nav-auth-actions">
        <?php if ($is_logged): ?>
          <div class="dropdown">
            <button class="btn btn-user-pill dropdown-toggle" type="button" data-toggle="dropdown">
              <img src="<?=$user_avatar;?>" class="user-pill-avatar" alt="Avatar">
              <span class="user-pill-name"><?=$user_login;?></span>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right luxury-dropdown">
              <li class="dropdown-header text-gold font-cinzel"><i class="fa fa-user-circle"></i> Conta: <?=strtoupper($user_login);?></li>
              <li role="separator" class="divider"></li>
              <li><a href="site.php?p=painel"><i class="fa fa-dashboard text-gold"></i> Painel do Jogador</a></li>
              <li><a href="site.php?p=loja"><i class="fa fa-shopping-cart text-gold"></i> Loja de Itens / WebShop</a></li>
              <li><a href="painel/index.php" target="_blank"><i class="fa fa-external-link text-gold"></i> Painel Clássico</a></li>
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
          <?php if (isset($_GET['login_error'])): ?>
            <div class="alert alert-danger" style="background:rgba(239,85,119,0.2);border:1px solid #ef5577;color:#fff;border-radius:6px;padding:10px 14px;margin-bottom:15px;font-size:13px;">
              <i class="fa fa-exclamation-triangle"></i>
              <?php if ($_GET['login_error'] == 'blocked'): ?>
                Esta conta está bloqueada pela administração!
              <?php else: ?>
                Usuário ou senha incorretos! Verifique seus dados.
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <div class="form-group">
            <label class="control-label text-gold">Login / Conta:</label>
            <input type="text" name="login" class="form-control luxury-input" placeholder="Digite seu usuário" value="<?=isset($_GET['login_user']) ? htmlspecialchars($_GET['login_user']) : '';?>" required>
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

<?php if ($page == 'home'): ?>

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

      <a href="<?=$is_logged?'site.php?p=painel':'#';?>" <?=$is_logged?'':'data-toggle="modal" data-target="#loginModal"';?> class="btn-cta-gold" style="background: linear-gradient(135deg, rgba(20,29,51,0.95) 0%, rgba(30,41,59,0.95) 100%); border-color: rgba(212,175,55,0.7);">
        <i class="fa fa-dashboard fa-lg text-gold"></i>
        <div>
          <span class="text-gold">PAINEL DO JOGADOR</span>
          <span class="btn-cta-sub">Resets, Pontos & Chars</span>
        </div>
      </a>

      <a href="site.php?p=loja" class="btn-cta-blue" style="background: linear-gradient(135deg, rgba(16,24,40,0.95) 0%, rgba(20,83,45,0.8) 100%); border-color: rgba(82,229,145,0.7);">
        <i class="fa fa-shopping-cart fa-lg" style="color:#52e591;"></i>
        <div>
          <span style="color:#52e591;">LOJA DE ITENS</span>
          <span class="btn-cta-sub">VIP, Asas, Armas & Jóias</span>
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

<?php else: ?>

<!-- SUBPAGE SLEEK HERO BANNER -->
<header class="subpage-hero-banner">
  <div class="container">
    <div class="subpage-breadcrumb">
      <a href="site.php"><i class="fa fa-home"></i> INÍCIO</a>
      <span class="sep">/</span>
      <span class="current"><?=$page_meta['short'];?></span>
    </div>
    <h1 class="subpage-title"><?=$page_meta['title'];?></h1>
    <p class="subpage-desc"><?=$page_meta['desc'];?></p>
  </div>
</header>

<?php endif; ?>

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

          <?php if (!empty($reg_error)): ?>
            <div class="alert alert-danger" style="background: rgba(239,68,68,0.25); border: 1px solid #ef4444; color: #fff; font-size: 15px; margin-bottom: 25px; padding: 15px; border-radius: 6px;">
              <i class="fa fa-exclamation-circle" style="color: #ef4444; margin-right: 8px;"></i> <?=$reg_error;?>
            </div>
          <?php endif; ?>

          <form action="site.php?p=cadastro" method="post" class="form-horizontal" style="max-width:700px;margin:30px auto 0;">
            <input type="hidden" name="action_register" value="1">
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

    <?php elseif ($page == 'painel'): ?>

      <!-- PAINEL DO JOGADOR NATIVO -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <?php include("painel_jogador.php"); ?>
      </section>

    <?php elseif ($page == 'loja' || $page == 'shop'): ?>

      <!-- WEBSHOP NATIVO -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <?php include("shop_loja.php"); ?>
      </section>

    <?php elseif ($page == 'ranking'): ?>

      <?php
        $rank_type = isset($_GET['tipo']) ? strtolower(trim($_GET['tipo'])) : 'resets';
        $rank_class = isset($_GET['classe']) ? (int)$_GET['classe'] : -1;

        $where_clauses = [];
        if ($rank_class >= 0) {
            switch ($rank_class) {
                case 0:  $where_clauses[] = '"Class" IN (0, 1, 2, 3)'; break;
                case 16: $where_clauses[] = '"Class" IN (16, 17, 18)'; break;
                case 32: $where_clauses[] = '"Class" IN (32, 33, 34)'; break;
                case 48: $where_clauses[] = '"Class" IN (48, 50)'; break;
                case 64: $where_clauses[] = '"Class" IN (64, 66)'; break;
                case 80: $where_clauses[] = '"Class" IN (80, 81, 82)'; break;
                case 96: $where_clauses[] = '"Class" IN (96, 98)'; break;
            }
        }

        $order_by = '"ResetCount" DESC, "cLevel" DESC';
        if ($rank_type === 'level') {
            $order_by = '"cLevel" DESC, "ResetCount" DESC';
        } elseif ($rank_type === 'mresets') {
            $order_by = '"MasterResets" DESC, "ResetCount" DESC, "cLevel" DESC';
        }

        $where_sql = !empty($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) : '';
        $full_rank_query = "SELECT \"Name\", \"cLevel\", \"ResetCount\", \"Class\", COALESCE(\"MasterResets\", 0) as mresets FROM public.character $where_sql ORDER BY $order_by LIMIT 50";
        $rank_exec = @mssql_query($full_rank_query);
        $rank_list = [];
        if ($rank_exec) {
            while ($row = @mssql_fetch_assoc($rank_exec)) {
                $rank_list[] = $row;
            }
        }
        if (empty($rank_list)) {
            $rank_list = $top_characters;
        }
      ?>

      <!-- RANKING NATIVO COMPLETO -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-trophy text-gold"></i> CLASSIFICAÇÃO <span>OFICIAL DE HERÓIS</span></h3>
            <p>Dados ao vivo sincronizados diretamente com o banco de dados oficial OpenMU</p>
          </div>

          <!-- Ranking Filter Tabs -->
          <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:15px;margin:25px 0;padding-bottom:20px;border-bottom:1px solid rgba(212,175,55,0.25);">
            <div style="display:flex;gap:8px;flex-wrap:wrap;">
              <a href="site.php?p=ranking&tipo=resets<?=$rank_class>=0?'&classe='.$rank_class:'';?>" class="btn <?=$rank_type=='resets'?'btn-cta-gold':'btn-nav-login';?>" style="padding:8px 16px;font-size:12px;">
                <i class="fa fa-star"></i> TOP RESETS
              </a>
              <a href="site.php?p=ranking&tipo=mresets<?=$rank_class>=0?'&classe='.$rank_class:'';?>" class="btn <?=$rank_type=='mresets'?'btn-cta-gold':'btn-nav-login';?>" style="padding:8px 16px;font-size:12px;">
                <i class="fa fa-bolt"></i> MASTER RESETS
              </a>
              <a href="site.php?p=ranking&tipo=level<?=$rank_class>=0?'&classe='.$rank_class:'';?>" class="btn <?=$rank_type=='level'?'btn-cta-gold':'btn-nav-login';?>" style="padding:8px 16px;font-size:12px;">
                <i class="fa fa-arrow-up"></i> TOP NÍVEL
              </a>
              <a href="site.php?p=ranking&tipo=diario" class="btn <?=$rank_type=='diario'?'btn-cta-gold':'btn-nav-login';?>" style="padding:8px 16px;font-size:12px;">
                <i class="fa fa-clock-o"></i> TOP DIÁRIO
              </a>
              <a href="site.php?p=ranking&tipo=semanal" class="btn <?=$rank_type=='semanal'?'btn-cta-gold':'btn-nav-login';?>" style="padding:8px 16px;font-size:12px;">
                <i class="fa fa-calendar"></i> TOP SEMANAL
              </a>
            </div>

            <form action="site.php" method="get" style="display:flex;align-items:center;gap:8px;">
              <input type="hidden" name="p" value="ranking">
              <input type="hidden" name="tipo" value="<?=$rank_type;?>">
              <select name="classe" class="form-control luxury-input" onchange="this.form.submit()" style="height:38px;padding:6px 12px;font-size:12px;width:180px;">
                <option value="-1">Todas as Classes</option>
                <option value="0"  <?=$rank_class===0?'selected':'';?>>Dark Wizard / GM</option>
                <option value="16" <?=$rank_class===16?'selected':'';?>>Dark Knight / BM</option>
                <option value="32" <?=$rank_class===32?'selected':'';?>>Fairy Elf / High Elf</option>
                <option value="48" <?=$rank_class===48?'selected':'';?>>Magic Gladiator / DM</option>
                <option value="64" <?=$rank_class===64?'selected':'';?>>Dark Lord / LE</option>
                <option value="80" <?=$rank_class===80?'selected':'';?>>Summoner / Dimension</option>
                <option value="96" <?=$rank_class===96?'selected':'';?>>Rage Fighter / Fist</option>
              </select>
            </form>
          </div>

          <!-- Table -->
          <div class="table-responsive">
            <table class="vanguard-table">
              <thead>
                <tr>
                  <th style="width:50px;">POS</th>
                  <th>PERSONAGEM</th>
                  <th>CLASSE</th>
                  <th style="text-align:center;">NÍVEL</th>
                  <th style="text-align:center;">RESETS</th>
                  <th style="text-align:center;">M. RESETS</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $pos = 1;
                foreach ($rank_list as $row): 
                  $badge_cls = $pos == 1 ? 'rank-badge-1' : ($pos == 2 ? 'rank-badge-2' : ($pos == 3 ? 'rank-badge-3' : ''));
                  $c_name = get_mu_class_name(isset($row['Class']) ? $row['Class'] : 0);
                  $mr = isset($row['mresets']) ? $row['mresets'] : (isset($row['MasterResets']) ? $row['MasterResets'] : 0);
                ?>
                  <tr>
                    <td>
                      <?php if ($badge_cls): ?>
                        <span class="<?=$badge_cls;?>"><?=$pos;?></span>
                      <?php else: ?>
                        <span style="color:#7d8c9e;font-weight:700;"><?=$pos;?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <strong style="color:#fff;font-size:15px;"><?=$row['Name'];?></strong>
                    </td>
                    <td>
                      <span class="class-badge"><?=$c_name;?></span>
                    </td>
                    <td style="text-align:center;font-weight:700;color:var(--gold-light);">
                      <?=$row['cLevel'];?>
                    </td>
                    <td style="text-align:center;font-weight:800;color:#52e591;">
                      <?=$row['ResetCount'];?>
                    </td>
                    <td style="text-align:center;font-weight:700;color:#38bdf8;">
                      <?=$mr;?>
                    </td>
                  </tr>
                <?php 
                  $pos++;
                endforeach; 
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </section>

    <?php elseif ($page == 'comandos'): ?>

      <!-- COMANDOS NATIVOS -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-terminal text-gold"></i> COMANDOS <span>IN-GAME</span></h3>
            <p>Lista oficial de comandos disponíveis dentro do servidor MU Dravaryn</p>
          </div>

          <div class="row" style="margin-top: 25px;">
            <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
              <div style="background: rgba(10, 20, 35, 0.75); border: 1px solid var(--border-gold); border-radius: 10px; padding: 22px;">
                <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 15px; border-bottom: 1px solid rgba(212,175,55,0.25); padding-bottom: 10px;">
                  <i class="fa fa-bolt text-gold"></i> EVOLUÇÃO & RESETS
                </h4>
                <table class="table" style="color: #cbd5e1; font-size: 13.5px; margin: 0;">
                  <tr>
                    <td style="width: 140px;"><code style="background:rgba(212,175,55,0.15);color:var(--gold-light);font-size:13px;padding:3px 8px;border:1px solid rgba(212,175,55,0.3);border-radius:4px;">/reset</code></td>
                    <td>Reseta o personagem no Level 400. Pontos e status mantidos conforme regra do servidor.</td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(212,175,55,0.15);color:var(--gold-light);font-size:13px;padding:3px 8px;border:1px solid rgba(212,175,55,0.3);border-radius:4px;">/reset auto</code></td>
                    <td>Ativa/desativa o reset automático contínuo sempre que atingir o nível 400.</td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(212,175,55,0.15);color:var(--gold-light);font-size:13px;padding:3px 8px;border:1px solid rgba(212,175,55,0.3);border-radius:4px;">/mreset</code></td>
                    <td>Master Reset oficial (Requer 300 Resets). Bonifica a conta com WCoins e status nobres.</td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(212,175,55,0.15);color:var(--gold-light);font-size:13px;padding:3px 8px;border:1px solid rgba(212,175,55,0.3);border-radius:4px;">/post &lt;msg&gt;</code></td>
                    <td>Envia mensagem global no chat de todo o servidor (Visível a todos os jogadores).</td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(212,175,55,0.15);color:var(--gold-light);font-size:13px;padding:3px 8px;border:1px solid rgba(212,175,55,0.3);border-radius:4px;">/limparpk</code></td>
                    <td>Limpa o status de PK (Assassino) do personagem instantaneamente.</td>
                  </tr>
                </table>
              </div>
            </div>

            <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
              <div style="background: rgba(10, 20, 35, 0.75); border: 1px solid var(--border-gold); border-radius: 10px; padding: 22px;">
                <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 15px; border-bottom: 1px solid rgba(212,175,55,0.25); padding-bottom: 10px;">
                  <i class="fa fa-plus-circle text-gold"></i> ADICIONAR ATRIBUTOS
                </h4>
                <table class="table" style="color: #cbd5e1; font-size: 13.5px; margin: 0;">
                  <tr>
                    <td style="width: 140px;"><code style="background:rgba(82,229,145,0.15);color:#52e591;font-size:13px;padding:3px 8px;border:1px solid rgba(82,229,145,0.3);border-radius:4px;">/f &lt;pontos&gt;</code></td>
                    <td>Adiciona pontos em Força (Strength). Ex: <code>/f 500</code></td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(82,229,145,0.15);color:#52e591;font-size:13px;padding:3px 8px;border:1px solid rgba(82,229,145,0.3);border-radius:4px;">/a &lt;pontos&gt;</code></td>
                    <td>Adiciona pontos em Agilidade (Agility). Ex: <code>/a 500</code></td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(82,229,145,0.15);color:#52e591;font-size:13px;padding:3px 8px;border:1px solid rgba(82,229,145,0.3);border-radius:4px;">/v &lt;pontos&gt;</code></td>
                    <td>Adiciona pontos em Vitalidade (Vitality). Ex: <code>/v 500</code></td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(82,229,145,0.15);color:#52e591;font-size:13px;padding:3px 8px;border:1px solid rgba(82,229,145,0.3);border-radius:4px;">/e &lt;pontos&gt;</code></td>
                    <td>Adiciona pontos em Energia (Energy). Ex: <code>/e 500</code></td>
                  </tr>
                  <tr>
                    <td><code style="background:rgba(82,229,145,0.15);color:#52e591;font-size:13px;padding:3px 8px;border:1px solid rgba(82,229,145,0.3);border-radius:4px;">/c &lt;pontos&gt;</code></td>
                    <td>Adiciona pontos em Comando (Command - Apenas Dark Lord). Ex: <code>/c 500</code></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div style="background: rgba(10, 20, 35, 0.75); border: 1px solid var(--border-gold); border-radius: 10px; padding: 22px; margin-top: 10px;">
            <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 15px; border-bottom: 1px solid rgba(212,175,55,0.25); padding-bottom: 10px;">
              <i class="fa fa-cubes text-gold"></i> UTILITÁRIOS, BAÚS & GUILDAS
            </h4>
            <div class="row">
              <div class="col-md-4 col-sm-6" style="margin-bottom: 15px;">
                <code style="background:rgba(0,180,255,0.15);color:#38bdf8;font-size:13px;padding:3px 8px;border:1px solid rgba(0,180,255,0.3);border-radius:4px;">/bau &lt;número&gt;</code>
                <p style="color:#94a3b8;font-size:13px;margin-top:6px;">Alterna entre os baús extras da conta (Ex: <code>/bau 1</code>, <code>/bau 2</code> - Recurso VIP).</p>
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom: 15px;">
                <code style="background:rgba(0,180,255,0.15);color:#38bdf8;font-size:13px;padding:3px 8px;border:1px solid rgba(0,180,255,0.3);border-radius:4px;">/pack &lt;bless|soul&gt; &lt;10|20|30&gt;</code>
                <p style="color:#94a3b8;font-size:13px;margin-top:6px;">Compacta jóias avulsas do inventário em pacotes compactados no NPC Lahap.</p>
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom: 15px;">
                <code style="background:rgba(0,180,255,0.15);color:#38bdf8;font-size:13px;padding:3px 8px;border:1px solid rgba(0,180,255,0.3);border-radius:4px;">/unpack &lt;bless|soul&gt; &lt;10|20|30&gt;</code>
                <p style="color:#94a3b8;font-size:13px;margin-top:6px;">Descompacta pacotes de jóias de volta para jóias individuais no inventário.</p>
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom: 15px;">
                <code style="background:rgba(0,180,255,0.15);color:#38bdf8;font-size:13px;padding:3px 8px;border:1px solid rgba(0,180,255,0.3);border-radius:4px;">/war &lt;nome_guild&gt;</code>
                <p style="color:#94a3b8;font-size:13px;margin-top:6px;">Desafia uma guilda oponente para batalha de Guild War.</p>
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom: 15px;">
                <code style="background:rgba(0,180,255,0.15);color:#38bdf8;font-size:13px;padding:3px 8px;border:1px solid rgba(0,180,255,0.3);border-radius:4px;">/soccer &lt;nome_guild&gt;</code>
                <p style="color:#94a3b8;font-size:13px;margin-top:6px;">Inicia partida de Battle Soccer no estádio de Arena contra a guilda rival.</p>
              </div>
              <div class="col-md-4 col-sm-6" style="margin-bottom: 15px;">
                <code style="background:rgba(0,180,255,0.15);color:#38bdf8;font-size:13px;padding:3px 8px;border:1px solid rgba(0,180,255,0.3);border-radius:4px;">/online</code>
                <p style="color:#94a3b8;font-size:13px;margin-top:6px;">Exibe a quantidade de jogadores conectados em tempo real.</p>
              </div>
            </div>
          </div>

        </div>
      </section>

    <?php elseif ($page == 'eventos'): ?>

      <!-- HORÁRIOS DOS EVENTOS NATIVO -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-clock-o text-gold"></i> HORÁRIOS DOS <span>EVENTOS</span></h3>
            <p>Cronograma oficial e automático de todos os eventos e invasões de MU Dravaryn</p>
          </div>

          <div class="row" style="margin-top: 25px;">
            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="event-card-box">
                <div class="event-card-header">
                  <span class="event-badge-time">A CADA 2 HORAS</span>
                  <h4><i class="fa fa-fort-awesome text-gold"></i> Blood Castle</h4>
                </div>
                <p class="event-desc">Atravesse a ponte sangrenta, destrua os portões do castelo e devolva a arma sagrada ao Arcanjo.</p>
                <div class="event-info-line"><strong>Horários:</strong> 00:00 · 02:00 · 04:00 · 06:00 · 08:00 · 10:00 · 12:00 · 14:00 · 16:00 · 18:00 · 20:00 · 22:00</div>
                <div class="event-reward-line"><strong>Recompensas:</strong> Chaos Box + Jóias nobres</div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="event-card-box">
                <div class="event-card-header">
                  <span class="event-badge-time">A CADA 2 HORAS</span>
                  <h4><i class="fa fa-fire text-gold"></i> Devil Square</h4>
                </div>
                <p class="event-desc">Sobreviva a hordas implacáveis de monstros ferozes e ganhe bônus de experiência acelerada e jóias.</p>
                <div class="event-info-line"><strong>Horários:</strong> 01:00 · 03:00 · 05:00 · 07:00 · 09:00 · 11:00 · 13:00 · 15:00 · 17:00 · 19:00 · 21:00 · 23:00</div>
                <div class="event-reward-line"><strong>Recompensas:</strong> EXP Máxima + Drop de Jóias</div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="event-card-box">
                <div class="event-card-header">
                  <span class="event-badge-time">A CADA 4 HORAS</span>
                  <h4><i class="fa fa-shield text-gold"></i> Chaos Castle</h4>
                </div>
                <p class="event-desc">Arena de sobrevivência total sem distinção de aliados ou guildas. O último sobrevivente leva a glória.</p>
                <div class="event-info-line"><strong>Horários:</strong> 01:00 · 05:00 · 09:00 · 13:00 · 17:00 · 21:00</div>
                <div class="event-reward-line"><strong>Recompensas:</strong> Itens Ancient originais + Jóias</div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="event-card-box">
                <div class="event-card-header">
                  <span class="event-badge-time">A CADA 2 HORAS</span>
                  <h4><i class="fa fa-diamond text-gold"></i> Golden Invasion</h4>
                </div>
                <p class="event-desc">Invasões de monstros dourados (Golden Dragon, Titan, Lizard King, Tantalos) em Lorencia, Noria, Devias e Tarkan.</p>
                <div class="event-info-line"><strong>Horários:</strong> A cada 2 horas pares (00:00, 02:00, ...)</div>
                <div class="event-reward-line"><strong>Recompensas:</strong> Box of Kundun +1 a +5</div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="event-card-box">
                <div class="event-card-header">
                  <span class="event-badge-time">A CADA 3 HORAS</span>
                  <h4><i class="fa fa-magic text-gold"></i> White Wizard</h4>
                </div>
                <p class="event-desc">O temido Mago Branco e seu exército de Destruction Orcs marcham sobre os continentes iniciais.</p>
                <div class="event-info-line"><strong>Horários:</strong> 02:15 · 05:15 · 08:15 · 11:15 · 14:15 · 17:15 · 20:15 · 23:15</div>
                <div class="event-reward-line"><strong>Recompensas:</strong> Wizard's Ring (+10% Dano) + Jóias</div>
              </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="event-card-box" style="border-color: rgba(212,175,55,0.7); background: linear-gradient(145deg, rgba(30,20,10,0.95), rgba(15,10,5,0.95));">
                <div class="event-card-header">
                  <span class="event-badge-time" style="background:#d4af37;color:#000;">DOMINGO 20H00</span>
                  <h4><i class="fa fa-crown text-gold"></i> Castle Siege</h4>
                </div>
                <p class="event-desc">A maior e mais épica guerra de alianças pelo domínio da fortaleza de Valley of Loren e da sagrada Land of Trials.</p>
                <div class="event-info-line"><strong>Horário:</strong> Todos os Domingos às 20h00 (Brasília)</div>
                <div class="event-reward-line"><strong>Recompensas:</strong> Land of Trials + Impostos do Servidor</div>
              </div>
            </div>
          </div>

        </div>
      </section>

    <?php elseif ($page == 'dicas'): ?>

      <!-- DICAS NATIVAS -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-lightbulb-o text-gold"></i> DICAS & GUIAS <span>PARA INICIANTES</span></h3>
            <p>Acelere sua evolução e domine os segredos do continente de Dravaryn</p>
          </div>

          <div class="row" style="margin-top: 25px;">
            <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
              <div style="background: rgba(10,20,35,0.75); border: 1px solid var(--border-gold); border-radius: 10px; padding: 22px;">
                <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 12px;"><i class="fa fa-map-marker text-gold"></i> ROTA RECOMENDADA DE SPOTS</h4>
                <p style="color: #cbd5e1; font-size: 13.5px; line-height: 1.7;">
                  Nosso servidor conta com <strong>1.399 spots balanceados</strong>. Siga este roteiro para subir de nível com máxima eficiência:
                </p>
                <ul style="color: #94a3b8; font-size: 13px; line-height: 1.8; padding-left: 20px;">
                  <li><strong class="text-gold">Nível 1 a 100:</strong> Lorencia / Noria (Aranhas e Golems) ou Elbeland.</li>
                  <li><strong class="text-gold">Nível 100 a 180:</strong> Devias 3, LostTower 1 e LostTower 7 (Shadows & Death Knights).</li>
                  <li><strong class="text-gold">Nível 180 a 250:</strong> Atlans 2/3 e Tarkan 1 (Mutants & Iron Wheel).</li>
                  <li><strong class="text-gold">Nível 250 a 330:</strong> Tarkan 2 (Zaikan), Aida 1 e Aida 2 (Hell Maine).</li>
                  <li><strong class="text-gold">Nível 330 a 400:</strong> Kanturu Relics, Karutan 1 e 2, Swamp of Peace.</li>
                </ul>
              </div>
            </div>

            <div class="col-md-6 col-sm-12" style="margin-bottom: 25px;">
              <div style="background: rgba(10,20,35,0.75); border: 1px solid var(--border-gold); border-radius: 10px; padding: 22px;">
                <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 12px;"><i class="fa fa-diamond text-gold"></i> ECONOMIA & JOALHERIA</h4>
                <p style="color: #cbd5e1; font-size: 13.5px; line-height: 1.7;">
                  Em MU Dravaryn a economia é <strong>100% valorizada</strong>:
                </p>
                <ul style="color: #94a3b8; font-size: 13px; line-height: 1.8; padding-left: 20px;">
                  <li><strong class="text-gold">Bug Bless OFF:</strong> Jóias não são vendidas em NPC. Colete cada Bless, Soul e Chaos com sabedoria!</li>
                  <li><strong class="text-gold">Party com Bônus:</strong> Upar em grupo (Party com diferentes classes) concede bônus de EXP extra para todos.</li>
                  <li><strong class="text-gold">Chaos Machine:</strong> Use Jewel of Chaos e itens com Luck para aumentar as chances de sucesso de refino.</li>
                  <li><strong class="text-gold">Participe de Blood Castle:</strong> Excelente fonte de jóias e Chaos Boxes para negociar com outros jogadores.</li>
                </ul>
              </div>
            </div>
          </div>

        </div>
      </section>

    <?php elseif ($page == 'contato' || $page == 'suporte'): ?>

      <!-- SUPORTE & ATENDIMENTO NATIVO -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-life-ring text-gold"></i> CENTRAL DE <span>SUPORTE & ATENDIMENTO</span></h3>
            <p>Precisa de ajuda, dúvidas sobre doações ou suporte técnico? Estamos à disposição!</p>
          </div>

          <div class="row" style="margin-top: 30px;">
            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="support-channel-card">
                <div class="channel-icon" style="background: rgba(88, 101, 242, 0.15); border-color: rgba(88, 101, 242, 0.4); color: #5865f2;">
                  <i class="fa fa-comments"></i>
                </div>
                <h4>DISCORD OFICIAL</h4>
                <p>Tire dúvidas, abra tickets com a moderação, confira notícias em tempo real e interaja com os outros jogadores.</p>
                <a href="https://discord.gg" target="_blank" class="btn btn-discord btn-block">
                  <i class="fa fa-external-link"></i> ENTRAR NO DISCORD
                </a>
              </div>
            </div>

            <div class="col-md-4 col-sm-6" style="margin-bottom: 20px;">
              <div class="support-channel-card">
                <div class="channel-icon" style="background: rgba(37, 211, 102, 0.15); border-color: rgba(37, 211, 102, 0.4); color: #25d366;">
                  <i class="fa fa-whatsapp"></i>
                </div>
                <h4>WHATSAPP ADMINISTRAÇÃO</h4>
                <p>Atendimento direto para doações, ativação instantânea de pacotes VIP / WCoins e recuperação de contas.</p>
                <a href="https://wa.me/" target="_blank" class="btn btn-whatsapp btn-block">
                  <i class="fa fa-whatsapp"></i> FALAR NO WHATSAPP
                </a>
              </div>
            </div>

            <div class="col-md-4 col-sm-12" style="margin-bottom: 20px;">
              <div class="support-channel-card">
                <div class="channel-icon" style="background: rgba(212, 175, 55, 0.15); border-color: rgba(212, 175, 55, 0.4); color: var(--gold-light);">
                  <i class="fa fa-envelope-o"></i>
                </div>
                <h4>E-MAIL DE CONTATO</h4>
                <p>Para contatos institucionais, parcerias com influenciadores, denúncias formais e assuntos administrativos.</p>
                <a href="mailto:suporte@mudravaryn.com.br" class="btn btn-nav-login btn-block" style="text-align:center;justify-content:center;padding:12px;">
                  <i class="fa fa-envelope"></i> suporte@mudravaryn.com.br
                </a>
              </div>
            </div>
          </div>

          <div class="alert alert-info" style="background: rgba(14, 28, 48, 0.85); border: 1px solid rgba(212, 175, 55, 0.35); color: #cbd5e1; border-radius: 8px; margin: 25px 0 35px; padding: 18px 22px;">
            <h5 style="color: var(--gold-light); font-weight: 700; margin: 0 0 8px 0; font-family: var(--font-heading); letter-spacing: 1px;">
              <i class="fa fa-shield"></i> DIRETRIZES DE SEGURANÇA AO JOGADOR
            </h5>
            <ul style="margin: 0; padding-left: 20px; font-size: 13px; line-height: 1.7;">
              <li>A equipe <strong>MU Dravaryn NUNCA solicita sua senha</strong> pessoal de jogo ou painel.</li>
              <li>Nunca informe seus dados para terceiros ou em links suspeitos que prometam itens gratuitos.</li>
              <li>Transações financeiras devem ser realizadas exclusivamente pelos canais oficiais descritos neste site.</li>
            </ul>
          </div>

          <div style="background: rgba(10, 18, 30, 0.8); border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; padding: 30px; max-width: 800px; margin: 0 auto;">
            <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 20px; text-align: center;">
              <i class="fa fa-send text-gold"></i> ENVIE UMA MENSAGEM DIRETA À STAFF
            </h4>

            <?php if (isset($_POST['msg_enviada'])): ?>
              <div class="alert alert-success" style="background: rgba(34,197,94,0.2); border: 1px solid #22c55e; color: #fff; font-size: 14px;">
                <i class="fa fa-check-circle"></i> Sua mensagem foi enviada com sucesso! Responderemos no e-mail informado em até 24 horas.
              </div>
            <?php endif; ?>

            <form action="site.php?p=contato" method="post">
              <input type="hidden" name="msg_enviada" value="1">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="control-label text-gold">Seu Nome / Personagem:</label>
                  <input type="text" name="nome" class="form-control luxury-input" placeholder="Ex: GuerreiroDravaryn" required>
                </div>
                <div class="col-md-6 form-group">
                  <label class="control-label text-gold">Seu Login / Conta:</label>
                  <input type="text" name="login" class="form-control luxury-input" placeholder="Ex: login123" value="<?=$user_login;?>">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="control-label text-gold">Seu E-mail para Resposta:</label>
                  <input type="email" name="email" class="form-control luxury-input" placeholder="seu-email@dominio.com" required>
                </div>
                <div class="col-md-6 form-group">
                  <label class="control-label text-gold">Assunto:</label>
                  <select name="assunto" class="form-control luxury-input" style="height:46px;">
                    <option value="Dúvida Geral">Dúvida Geral do Jogo</option>
                    <option value="Doação / VIP / WCoins">Doação / VIP / WCoins</option>
                    <option value="Problema Técnico">Problema Técnico / Conexão</option>
                    <option value="Recuperação de Conta">Recuperação de Conta</option>
                    <option value="Denúncia de Jogador">Denúncia de Jogador</option>
                    <option value="Outro">Outro Assunto</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label text-gold">Mensagem detalhada:</label>
                <textarea name="mensagem" class="form-control luxury-input" rows="5" placeholder="Descreva sua solicitação com o máximo de detalhes possível..." required style="height:auto;"></textarea>
              </div>
              <div style="text-align:center;margin-top:20px;">
                <button type="submit" class="btn btn-cta-gold" style="padding: 12px 35px; font-size: 14px; border: none; cursor: pointer;">
                  <i class="fa fa-paper-plane"></i> ENVIAR MENSAGEM
                </button>
              </div>
            </form>
          </div>

        </div>
      </section>

    <?php elseif ($page == 'guilds'): ?>

      <?php
        $guilds_res = @mssql_query("SELECT g.\"G_Name\", g.\"G_Master\", g.\"G_Score\", (SELECT COUNT(*) FROM data.\"GuildMember\" gm WHERE gm.\"GuildId\" = g.\"Id\") as total_membros FROM data.\"Guild\" g ORDER BY g.\"G_Score\" DESC, total_membros DESC LIMIT 20");
        $guilds_list = [];
        if ($guilds_res) {
            while ($grow = @mssql_fetch_assoc($guilds_res)) {
                $guilds_list[] = $grow;
            }
        }
      ?>

      <!-- GUILDAS NATIVO -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <div class="subpage-glass-box">
          <div class="section-vanguard-header">
            <h3><i class="fa fa-shield text-gold"></i> GUILDAS & <span>ALIANÇAS</span></h3>
            <p>As guildas mais respeitadas e influentes em disputa pelo continente de Dravaryn</p>
          </div>

          <div class="table-responsive" style="margin-top:25px;">
            <table class="vanguard-table">
              <thead>
                <tr>
                  <th style="width:50px;">POS</th>
                  <th>NOME DA GUILDA</th>
                  <th>GUILD MASTER</th>
                  <th style="text-align:center;">MEMBROS</th>
                  <th style="text-align:center;">PONTUAÇÃO</th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($guilds_list)): ?>
                  <tr>
                    <td colspan="5" style="text-align:center;padding:30px;color:#94a3b8;">
                      Nenhuma guilda cadastrada no momento. Crie sua guilda in-game no NPC de Davias ou Lorencia!
                    </td>
                  </tr>
                <?php else: ?>
                  <?php 
                  $gpos = 1;
                  foreach ($guilds_list as $g): 
                    $gbadge = $gpos == 1 ? 'rank-badge-1' : ($gpos == 2 ? 'rank-badge-2' : ($gpos == 3 ? 'rank-badge-3' : ''));
                  ?>
                    <tr>
                      <td>
                        <?php if ($gbadge): ?>
                          <span class="<?=$gbadge;?>"><?=$gpos;?></span>
                        <?php else: ?>
                          <span style="color:#7d8c9e;font-weight:700;"><?=$gpos;?></span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <strong style="color:var(--gold-light);font-size:15px;letter-spacing:1px;"><?=$g['G_Name'];?></strong>
                      </td>
                      <td>
                        <span style="color:#fff;font-weight:600;"><i class="fa fa-crown text-gold"></i> <?=$g['G_Master'];?></span>
                      </td>
                      <td style="text-align:center;font-weight:700;color:#38bdf8;">
                        <?=$g['total_membros'];?>
                      </td>
                      <td style="text-align:center;font-weight:800;color:#52e591;">
                        <?=$g['G_Score'];?>
                      </td>
                    </tr>
                  <?php 
                    $gpos++;
                  endforeach; 
                  ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>

    <?php else: ?>

      <!-- SUBPÁGINA GENÉRICA -->
      <section class="subpage-container" style="padding: 20px 0 60px;">
        <div class="subpage-glass-box text-center">
          <h3 style="color:#fff;font-family:var(--font-heading);"><i class="fa fa-info-circle text-gold"></i> PÁGINA NÃO ENCONTRADA</h3>
          <p style="color:#94a3b8;margin:15px auto 25px;max-width:500px;">A página solicitada não existe ou está temporariamente indisponível.</p>
          <a href="site.php" class="btn btn-cta-gold"><i class="fa fa-home"></i> VOLTAR AO INÍCIO</a>
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

<?php if (isset($_GET['login_error']) || isset($_GET['login'])): ?>
<script>
  $(document).ready(function() {
    $('#loginModal').modal('show');
  });
</script>
<?php endif; ?>

</body>
</html>
