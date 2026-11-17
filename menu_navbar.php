<?php
header('Content-Type: text/html; charset=utf-8');
?>
<nav class="navbar menucls navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#dravaryn-navbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand d-flex align-items-center" href="site.php">
        <img src="img/logoJM.png" alt="MU Dravaryn" class="nav-logo">
        <span class="brand-text">MU <span>DRAVARYN</span></span>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="dravaryn-navbar">
      <ul class="nav navbar-nav nav-center-links">
        <li><a href="site.php"><i class="fa fa-home"></i> INÍCIO</a></li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-gamepad"></i> O JOGO <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="cadastro.php" target="main2"><i class="fa fa-user-plus text-gold"></i> Criar Conta</a></li>
            <li><a href="dwn.php" target="main2"><i class="fa fa-download text-gold"></i> Download do Jogo</a></li>
            <li><a href="info.php" target="main2"><i class="fa fa-info-circle text-gold"></i> Informações do Servidor</a></li>
            <li><a href="comandos.php" target="main2"><i class="fa fa-terminal text-gold"></i> Comandos do Jogo</a></li>
            <li><a href="dicas.php" target="main2"><i class="fa fa-lightbulb-o text-gold"></i> Dicas para Iniciantes</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-shield"></i> EVENTOS <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="evento_arena.php" target="main2"><i class="fa fa-crosshairs text-gold"></i> Rei do PvP</a></li>
            <li><a href="ranking_castle.php" target="main2"><i class="fa fa-fort-awesome text-gold"></i> Castle Siege</a></li>
            <li><a href="evento_goldens.php" target="main2"><i class="fa fa-star text-gold"></i> Invasões Douradas</a></li>
            <li><a href="evento_bc_semanal.php" target="main2"><i class="fa fa-fire text-gold"></i> Blood Castle Semanal</a></li>
            <li><a href="evento_devil_semanal.php" target="main2"><i class="fa fa-bolt text-gold"></i> Devil Square Semanal</a></li>
            <li><a href="evento_cc_semanal.php" target="main2"><i class="fa fa-trophy text-gold"></i> Chaos Castle Semanal</a></li>
            <li><a href="eventos.php" target="main2"><i class="fa fa-clock-o text-gold"></i> Horários dos Eventos</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-trophy"></i> RANKINGS <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="ranking.php" target="main2"><i class="fa fa-list-ol text-gold"></i> Ranking Geral</a></li>
            <li><a href="guilds.php" target="main2"><i class="fa fa-users text-gold"></i> Ranking de Guilds</a></li>
            <li><a href="tops_diario.php" target="main2"><i class="fa fa-calendar-check-o text-gold"></i> Top Diário</a></li>
            <li><a href="tops_semanal.php" target="main2"><i class="fa fa-calendar text-gold"></i> Top Semanal</a></li>
            <li><a href="tops_mensal.php" target="main2"><i class="fa fa-calendar-o text-gold"></i> Top Mensal</a></li>
            <li><a href="ranking_duelo.php" target="main2"><i class="fa fa-gavel text-gold"></i> Ranking de Duelos</a></li>
          </ul>
        </li>

        <li><a href="contato.php" target="main2"><i class="fa fa-envelope-o"></i> SUPORTE</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right auth-section">
        <?php if ((isset($_COOKIE["usuario"])) && (isset($_COOKIE["senha"])) && !empty($login)): ?>
        <li class="dropdown user-logged-dropdown">
          <a href="#" class="dropdown-toggle user-btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <img src="<?=$avatar;?>" class="user-avatar-mini" alt="User">
            <span class="user-name-label"><?=$login;?></span>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li><a href="painel/index.php" target="_blank"><i class="fa fa-dashboard text-gold"></i> Painel da Conta</a></li>
            <li><a href="painel/mudar_senha.php" target="main2"><i class="fa fa-key text-gold"></i> Alterar Senha</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="logar.php?deslogar=ok" target="main2" class="text-danger"><i class="fa fa-sign-out"></i> Desconectar</a></li>
          </ul>
        </li>
        <?php else: ?>
        <form class="navbar-form navbar-right login-form-modern" action="logar.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control nav-input" name="login" id="login" placeholder="Usuário" required>
            <input type="password" class="form-control nav-input" name="oldpwd" id="oldpwd" placeholder="Senha" required>
          </div>
          <button type="submit" class="btn btn-login-gold">ENTRAR</button>
          <a href="cadastro.php" target="main2" class="btn btn-register-nav">REGISTRAR</a>
        </form>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
