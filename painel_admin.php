<?php
/**
 * MU Dravaryn - Official Master Administration Dashboard (Painel de Administração)
 * Full control over Accounts, Characters, WCoins, VIP, Passwords, Bans & Server Security.
 */

if (!defined('DRAVARYN_PORTAL')) {
    header("Location: site.php?p=admin");
    exit();
}

// Master Admin Password (change anytime)
$ADMIN_MASTER_PASS = 'dravaryn2026!';

// Check Admin Authentication
$admin_authenticated = false;

// If logged in as 'mauricio', automatically grant admin session or allow master pass
if (isset($_SESSION['is_super_admin']) && $_SESSION['is_super_admin'] === true) {
    $admin_authenticated = true;
} elseif ($is_logged && strtolower($user_login) === 'mauricio') {
    $_SESSION['is_super_admin'] = true;
    $admin_authenticated = true;
}

// Process Admin Login Form
$admin_login_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_admin_login'])) {
    $in_pass = isset($_POST['admin_pass']) ? trim($_POST['admin_pass']) : '';
    if ($in_pass === $ADMIN_MASTER_PASS || ($is_logged && strtolower($user_login) === 'mauricio')) {
        $_SESSION['is_super_admin'] = true;
        $admin_authenticated = true;
    } else {
        $admin_login_error = "Senha de Administrador incorreta!";
    }
}

// Handle Admin Logout
if (isset($_GET['admin_logout'])) {
    unset($_SESSION['is_super_admin']);
    header("Location: site.php?p=admin");
    exit();
}

// Helper for Class mapping
$class_map = [
    0  => ['name' => 'Dark Wizard',       'uuid' => '00000040-0000-0000-0000-000000000000'],
    2  => ['name' => 'Soul Master',       'uuid' => '00000040-0002-0000-0000-000000000000'],
    3  => ['name' => 'Grand Master',      'uuid' => '00000040-0003-0000-0000-000000000000'],
    4  => ['name' => 'Dark Knight',       'uuid' => '00000040-0004-0000-0000-000000000000'],
    6  => ['name' => 'Blade Knight',      'uuid' => '00000040-0006-0000-0000-000000000000'],
    7  => ['name' => 'Blade Master',      'uuid' => '00000040-0007-0000-0000-000000000000'],
    8  => ['name' => 'Fairy Elf',         'uuid' => '00000040-0008-0000-0000-000000000000'],
    10 => ['name' => 'Muse Elf',          'uuid' => '00000040-000a-0000-0000-000000000000'],
    11 => ['name' => 'High Elf',          'uuid' => '00000040-000b-0000-0000-000000000000'],
    12 => ['name' => 'Magic Gladiator',   'uuid' => '00000040-000c-0000-0000-000000000000'],
    13 => ['name' => 'Duel Master',       'uuid' => '00000040-000d-0000-0000-000000000000'],
    16 => ['name' => 'Dark Lord',         'uuid' => '00000040-0010-0000-0000-000000000000'],
    17 => ['name' => 'Lord Emperor',      'uuid' => '00000040-0011-0000-0000-000000000000'],
    20 => ['name' => 'Summoner',          'uuid' => '00000040-0014-0000-0000-000000000000'],
    22 => ['name' => 'Bloody Summoner',   'uuid' => '00000040-0016-0000-0000-000000000000'],
    23 => ['name' => 'Dimension Master',  'uuid' => '00000040-0017-0000-0000-000000000000'],
    24 => ['name' => 'Rage Fighter',      'uuid' => '00000040-0018-0000-0000-000000000000'],
    25 => ['name' => 'Fist Master',       'uuid' => '00000040-0019-0000-0000-000000000000'],
];

if (!$admin_authenticated):
?>
  <!-- ADMIN LOGIN GATE -->
  <div class="subpage-glass-box" style="max-width: 520px; margin: 40px auto; padding: 40px 30px; text-align: center;">
    <div style="width: 70px; height: 70px; margin: 0 auto 20px; border-radius: 50%; background: rgba(212,175,55,0.15); border: 1px solid var(--gold-primary); display: flex; align-items: center; justify-content: center; font-size: 30px; color: var(--gold-light);">
      <i class="fa fa-shield"></i>
    </div>
    <h3 style="font-family: var(--font-heading); color: #fff; font-size: 22px; margin: 0 0 10px;">ACESSO RESTRITO • ADMIN</h3>
    <p style="color: #94a3b8; font-size: 13px; margin-bottom: 25px;">Informe a Senha Mestra de Administrador para acessar a central de controle de MU Dravaryn.</p>

    <?php if (!empty($admin_login_error)): ?>
      <div class="alert alert-danger" style="background: rgba(239,68,68,0.25); border: 1px solid #ef4444; color: #fff; font-size: 13px; padding: 10px 14px; border-radius: 6px; margin-bottom: 20px;">
        <i class="fa fa-exclamation-circle"></i> <?=$admin_login_error;?>
      </div>
    <?php endif; ?>

    <form action="site.php?p=admin" method="post">
      <input type="hidden" name="action_admin_login" value="1">
      <div class="form-group" style="text-align: left;">
        <label class="control-label text-gold" style="font-size: 12px;">Senha Mestra Admin:</label>
        <input type="password" name="admin_pass" class="form-control luxury-input" placeholder="Digite a chave mestra" required autofocus>
      </div>
      <button type="submit" class="btn btn-cta-gold btn-block" style="padding: 12px; font-size: 14px; margin-top: 20px;">
        <i class="fa fa-unlock-alt"></i> DESBLOQUEAR PAINEL
      </button>
    </form>
  </div>
<?php
  return;
endif;

// --- ADMIN ACTIONS PROCESSING ---
$admin_feedback = '';
$admin_feedback_type = 'info';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Give WCoins / Goblin Points
    if (isset($_POST['action_give_coins'])) {
        $target_acc_id = trim($_POST['target_acc_id']);
        $target_login  = trim($_POST['target_login']);
        $add_wc = (int)$_POST['add_wcoinc'];
        $add_gp = (int)$_POST['add_gp'];

        @mssql_query("UPDATE data.\"Account\" 
            SET \"WCoinC\" = GREATEST(0, COALESCE(\"WCoinC\", 0) + ($add_wc)),
                \"GoblinPoints\" = GREATEST(0, COALESCE(\"GoblinPoints\", 0) + ($add_gp))
            WHERE \"Id\" = '$target_acc_id'");

        $admin_feedback = "Sucesso! Saldo atualizado para a conta <strong>$target_login</strong>: <strong>$add_wc WCoins</strong> e <strong>$add_gp Goblin Points</strong>.";
        $admin_feedback_type = 'success';
    }

    // 2. Set VIP
    if (isset($_POST['action_set_vip'])) {
        $target_login = trim($_POST['target_login']);
        $vip_days = (int)$_POST['vip_days'];
        $vip_level = (int)$_POST['vip_level'];

        $expire_sql = "NOW() + INTERVAL '$vip_days days'";
        @mssql_query("UPDATE public.\"MEMB_INFO\" 
            SET \"AccountLevel\" = $vip_level,
                \"vip\" = $vip_level,
                \"AccountExpireDate\" = $expire_sql,
                \"dias_vip\" = $expire_sql 
            WHERE LOWER(memb___id) = LOWER('$target_login')");

        $admin_feedback = "VIP ativado com sucesso para <strong>$target_login</strong>: Nível $vip_level por <strong>$vip_days dias</strong>!";
        $admin_feedback_type = 'success';
    }

    // 3. Change Account Password
    if (isset($_POST['action_change_pwd'])) {
        $target_acc_id = trim($_POST['target_acc_id']);
        $target_login  = trim($_POST['target_login']);
        $new_pwd       = trim($_POST['new_pwd']);

        if (strlen($new_pwd) >= 4) {
            $hash = password_hash($new_pwd, PASSWORD_BCRYPT);
            if (strpos($hash, '$2y$') === 0) {
                $hash = '$2a$' . substr($hash, 4);
            }
            $safe_h = addslashes($hash);

            @mssql_query("UPDATE data.\"Account\" SET \"PasswordHash\" = '$safe_h' WHERE \"Id\" = '$target_acc_id'");
            @mssql_query("UPDATE public.\"MEMB_INFO\" SET memb__pwd = '$safe_h' WHERE LOWER(memb___id) = LOWER('$target_login')");

            $admin_feedback = "Senha da conta <strong>$target_login</strong> alterada com sucesso!";
            $admin_feedback_type = 'success';
        } else {
            $admin_feedback = "A nova senha deve ter no mínimo 4 caracteres.";
            $admin_feedback_type = 'warning';
        }
    }

    // 4. Toggle Ban Account
    if (isset($_POST['action_toggle_ban'])) {
        $target_acc_id = trim($_POST['target_acc_id']);
        $target_login  = trim($_POST['target_login']);
        $new_state     = (int)$_POST['new_state'];

        @mssql_query("UPDATE data.\"Account\" SET \"State\" = $new_state WHERE \"Id\" = '$target_acc_id'");
        $bloc = $new_state > 0 ? '1' : '0';
        @mssql_query("UPDATE public.\"MEMB_INFO\" SET bloc_code = '$bloc' WHERE LOWER(memb___id) = LOWER('$target_login')");

        $status_txt = $new_state > 0 ? 'BLOQUEADA / BANIDA' : 'DESBLOQUEADA / ATIVA';
        $admin_feedback = "Conta <strong>$target_login</strong> agora está <strong>$status_txt</strong>!";
        $admin_feedback_type = $new_state > 0 ? 'warning' : 'success';
    }

    // 5. Edit Character Stats & Class
    if (isset($_POST['action_edit_char'])) {
        $char_id   = trim($_POST['char_id']);
        $char_name = trim($_POST['char_name']);
        $resets    = (int)$_POST['char_resets'];
        $mresets   = (int)$_POST['char_mresets'];
        $level     = (int)$_POST['char_level'];
        $points    = (int)$_POST['char_points'];
        $class_num = (int)$_POST['char_class_num'];

        if (isset($class_map[$class_num])) {
            $class_uuid = $class_map[$class_num]['uuid'];
            @mssql_query("UPDATE data.\"Character\" 
                SET \"Resets\" = $resets,
                    \"MasterResets\" = $mresets,
                    \"LevelUpPoints\" = $points,
                    \"CharacterClassId\" = '$class_uuid' 
                WHERE \"Id\" = '$char_id'");
        } else {
            @mssql_query("UPDATE data.\"Character\" 
                SET \"Resets\" = $resets,
                    \"MasterResets\" = $mresets,
                    \"LevelUpPoints\" = $points 
                WHERE \"Id\" = '$char_id'");
        }

        // Update Level and Reset in StatAttribute
        @mssql_query("UPDATE data.\"StatAttribute\" SET \"Value\" = $level WHERE \"DefinitionId\" = '560931ad-0901-4342-b7f4-fd2e2fcc0563' AND \"CharacterId\" = '$char_id'");
        @mssql_query("UPDATE data.\"StatAttribute\" SET \"Value\" = $resets WHERE \"DefinitionId\" = '89a891a7-f9f9-4ab5-af36-12056e53a5f7' AND \"CharacterId\" = '$char_id'");

        $admin_feedback = "Personagem <strong>$char_name</strong> atualizado com sucesso! (Resets: $resets, Level: $level, Pontos: $points).";
        $admin_feedback_type = 'success';
    }

    // 6. Clear PK (Admin)
    if (isset($_POST['action_clear_pk'])) {
        $char_id   = trim($_POST['char_id']);
        $char_name = trim($_POST['char_name']);
        @mssql_query("UPDATE data.\"Character\" SET \"PlayerKillCount\" = 0, \"State\" = 0 WHERE \"Id\" = '$char_id'");
        $admin_feedback = "Status de PK do personagem <strong>$char_name</strong> limpo com sucesso!";
        $admin_feedback_type = 'success';
    }

    // 7. Move to Lorencia (Desbugar Coordenadas)
    if (isset($_POST['action_move_lorencia'])) {
        $char_id   = trim($_POST['char_id']);
        $char_name = trim($_POST['char_name']);
        @mssql_query("UPDATE data.\"Character\" 
            SET \"PositionX\" = 125,
                \"PositionY\" = 125,
                \"CurrentMapId\" = '00000300-0000-0000-0000-000000000000' 
            WHERE \"Id\" = '$char_id'");
        $admin_feedback = "Personagem <strong>$char_name</strong> movido com sucesso para Lorencia (125, 125)!";
        $admin_feedback_type = 'success';
    }
}

// Server Statistics
$stat_accs = @mssql_fetch_row(@mssql_query("SELECT COUNT(*) FROM data.\"Account\""));
$stat_chars = @mssql_fetch_row(@mssql_query("SELECT COUNT(*) FROM data.\"Character\""));
$stat_guilds = @mssql_fetch_row(@mssql_query("SELECT COUNT(*) FROM data.\"Guild\""));
$stat_coins = @mssql_fetch_row(@mssql_query("SELECT COALESCE(SUM(\"WCoinC\"), 0) FROM data.\"Account\""));

$total_accs   = isset($stat_accs[0]) ? (int)$stat_accs[0] : 0;
$total_chars  = isset($stat_chars[0]) ? (int)$stat_chars[0] : 0;
$total_guilds = isset($stat_guilds[0]) ? (int)$stat_guilds[0] : 0;
$total_coins  = isset($stat_coins[0]) ? (int)$stat_coins[0] : 0;

// Searched Account
$search_query = isset($_GET['search_account']) ? trim($_GET['search_account']) : '';
$searched_account = null;
$searched_characters = [];

if (!empty($search_query)) {
    $sq = addslashes($search_query);
    $q_acc = @mssql_query("SELECT a.\"Id\", a.\"LoginName\", a.\"EMail\", a.\"RegistrationDate\", a.\"State\", COALESCE(a.\"WCoinC\", 0) as wcoinc, COALESCE(a.\"GoblinPoints\", 0) as gp, m.\"AccountLevel\", m.\"AccountExpireDate\" 
        FROM data.\"Account\" a 
        LEFT JOIN public.\"MEMB_INFO\" m ON LOWER(m.memb___id) = LOWER(a.\"LoginName\") 
        WHERE LOWER(a.\"LoginName\") = LOWER('$sq') OR LOWER(a.\"EMail\") = LOWER('$sq')");
    $searched_account = ($q_acc) ? @mssql_fetch_assoc($q_acc) : null;

    if ($searched_account) {
        $acc_uuid = $searched_account['Id'];
        $q_ch = @mssql_query("SELECT c.\"Id\", c.\"Name\", c.\"Experience\", c.\"LevelUpPoints\", c.\"PlayerKillCount\", c.\"State\", c.\"PositionX\", c.\"PositionY\", COALESCE(c.\"Resets\", 0) as resets, COALESCE(c.\"MasterResets\", 0) as mresets, cc.\"Number\" as class_num, cc.\"Name\" as class_raw_name 
            FROM data.\"Character\" c 
            LEFT JOIN config.\"CharacterClass\" cc ON c.\"CharacterClassId\" = cc.\"Id\" 
            WHERE c.\"AccountId\" = '$acc_uuid' 
            ORDER BY c.\"Experience\" DESC");
        if ($q_ch) {
            while ($c_row = @mssql_fetch_assoc($q_ch)) {
                $searched_characters[] = $c_row;
            }
        }
    }
}
?>

<div class="subpage-glass-box" style="padding: 30px;">

  <!-- TOP ADMIN BAR -->
  <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid rgba(212,175,55,0.25); padding-bottom: 20px; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
    <div>
      <h3 style="font-family: var(--font-heading); color: #fff; margin: 0 0 5px; font-size: 24px;">
        <i class="fa fa-cogs text-gold"></i> PAINEL DE CONTROLE <span>ADMINISTRATIVO</span>
      </h3>
      <p style="color: #94a3b8; font-size: 13px; margin: 0;">Servidor Oficial: <strong>MU Dravaryn Season 6 Episode 3</strong> • Acesso Mestre</p>
    </div>

    <div style="display: flex; gap: 10px; align-items: center;">
      <span class="badge" style="background: rgba(34,197,94,0.2); border: 1px solid #22c55e; color: #4ade80; padding: 8px 12px; font-size: 12px;">
        <i class="fa fa-check-circle"></i> SESSÃO AUTORIZADA
      </span>
      <a href="site.php?p=admin&admin_logout=1" class="btn btn-nav-login" style="padding: 7px 14px; font-size: 12px;">
        <i class="fa fa-sign-out"></i> Sair do Admin
      </a>
    </div>
  </div>

  <?php if (!empty($admin_feedback)): ?>
    <div class="alert alert-<?=$admin_feedback_type;?>" style="border-radius: 8px; font-size: 14px; margin-bottom: 25px;">
      <?=$admin_feedback;?>
    </div>
  <?php endif; ?>

  <!-- 4 STATS CARDS -->
  <div class="row" style="margin-bottom: 30px;">
    <div class="col-md-3 col-sm-6" style="margin-bottom: 15px;">
      <div style="background: rgba(10,20,35,0.85); border: 1px solid var(--border-gold); border-radius: 8px; padding: 20px; text-align: center;">
        <i class="fa fa-users fa-2x text-gold" style="margin-bottom: 10px;"></i>
        <div style="font-size: 26px; font-weight: 800; color: #fff; font-family: var(--font-heading);"><?=$total_accs;?></div>
        <div style="font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Contas Cadastradas</div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6" style="margin-bottom: 15px;">
      <div style="background: rgba(10,20,35,0.85); border: 1px solid var(--border-gold); border-radius: 8px; padding: 20px; text-align: center;">
        <i class="fa fa-shield fa-2x text-gold" style="margin-bottom: 10px;"></i>
        <div style="font-size: 26px; font-weight: 800; color: #fff; font-family: var(--font-heading);"><?=$total_chars;?></div>
        <div style="font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Personagens Criados</div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6" style="margin-bottom: 15px;">
      <div style="background: rgba(10,20,35,0.85); border: 1px solid var(--border-gold); border-radius: 8px; padding: 20px; text-align: center;">
        <i class="fa fa-trophy fa-2x text-gold" style="margin-bottom: 10px;"></i>
        <div style="font-size: 26px; font-weight: 800; color: #fff; font-family: var(--font-heading);"><?=$total_guilds;?></div>
        <div style="font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Guildas Formadas</div>
      </div>
    </div>

    <div class="col-md-3 col-sm-6" style="margin-bottom: 15px;">
      <div style="background: rgba(10,20,35,0.85); border: 1px solid var(--border-gold); border-radius: 8px; padding: 20px; text-align: center;">
        <i class="fa fa-diamond fa-2x" style="color: #52e591; margin-bottom: 10px;"></i>
        <div style="font-size: 26px; font-weight: 800; color: #52e591; font-family: var(--font-heading);"><?=number_format($total_coins, 0, ',', '.');?></div>
        <div style="font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Total WCoins Ativos</div>
      </div>
    </div>
  </div>

  <!-- SEARCH ACCOUNT BOX -->
  <div style="background: rgba(14,24,42,0.9); border: 1px solid var(--border-gold); border-radius: 10px; padding: 25px; margin-bottom: 30px;">
    <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 15px; font-size: 17px;">
      <i class="fa fa-search text-gold"></i> BUSCAR CONTA OU JOGADOR
    </h4>
    <form action="site.php" method="get" class="form-inline" style="display: flex; gap: 10px; flex-wrap: wrap;">
      <input type="hidden" name="p" value="admin">
      <input type="text" name="search_account" class="form-control luxury-input" placeholder="Digite o Login ou E-mail da conta..." value="<?=htmlspecialchars($search_query);?>" style="flex: 1 1 300px; height: 46px;" required>
      <button type="submit" class="btn btn-cta-gold" style="padding: 12px 25px; font-size: 13px; height: 46px; border: none; cursor: pointer;">
        <i class="fa fa-search"></i> PESQUISAR
      </button>
    </form>
  </div>

  <!-- SEARCH RESULTS -->
  <?php if (!empty($search_query)): ?>
    <?php if (!$searched_account): ?>
      <div class="alert alert-warning" style="background: rgba(245,158,11,0.2); border: 1px solid #f59e0b; color: #fff; border-radius: 8px;">
        <i class="fa fa-exclamation-triangle"></i> Nenhuma conta encontrada com o login ou e-mail: <strong><?=htmlspecialchars($search_query);?></strong>.
      </div>
    <?php else: 
      $s_id     = $searched_account['Id'];
      $s_login  = $searched_account['LoginName'];
      $s_mail   = $searched_account['EMail'];
      $s_reg    = $searched_account['RegistrationDate'];
      $s_state  = (int)$searched_account['State'];
      $s_wc     = (int)$searched_account['wcoinc'];
      $s_gp     = (int)$searched_account['gp'];
      $s_viplvl = isset($searched_account['AccountLevel']) ? (int)$searched_account['AccountLevel'] : 0;
      $s_vipexp = !empty($searched_account['AccountExpireDate']) ? date('d/m/Y H:i', strtotime($searched_account['AccountExpireDate'])) : 'Sem VIP Ativo';
    ?>
      <!-- ACCOUNT CARD & QUICK CONTROLS -->
      <div style="background: rgba(10,20,35,0.9); border: 1px solid var(--border-gold); border-radius: 10px; padding: 25px; margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
          <div>
            <span style="font-size: 11px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">CONTA SELECIONADA</span>
            <h3 style="font-family: var(--font-heading); color: var(--gold-light); margin: 2px 0 0; font-size: 22px;">
              <i class="fa fa-user-circle"></i> <?=strtoupper($s_login);?>
            </h3>
          </div>

          <div style="display: flex; gap: 8px; align-items: center;">
            <?php if ($s_state > 0): ?>
              <span class="badge" style="background: #ef4444; padding: 6px 12px; font-size: 12px;"><i class="fa fa-ban"></i> BLOQUEADA / BANIDA</span>
            <?php else: ?>
              <span class="badge" style="background: #22c55e; padding: 6px 12px; font-size: 12px;"><i class="fa fa-check"></i> CONTA ATIVA</span>
            <?php endif; ?>

            <!-- Toggle Ban Form -->
            <form action="site.php?p=admin&search_account=<?=urlencode($s_login);?>" method="post" style="margin: 0;">
              <input type="hidden" name="action_toggle_ban" value="1">
              <input type="hidden" name="target_acc_id" value="<?=$s_id;?>">
              <input type="hidden" name="target_login" value="<?=$s_login;?>">
              <input type="hidden" name="new_state" value="<?=$s_state > 0 ? 0 : 1;?>">
              <button type="submit" class="btn <?=$s_state > 0 ? 'btn-success' : 'btn-danger';?>" style="padding: 6px 14px; font-size: 11.5px; border-radius: 6px;">
                <i class="fa <?=$s_state > 0 ? 'fa-unlock' : 'fa-ban';?>"></i> <?=$s_state > 0 ? 'Desbloquear Conta' : 'Bloquear / Banir';?>
              </button>
            </form>
          </div>
        </div>

        <!-- Details Grid -->
        <div class="row" style="margin-bottom: 25px;">
          <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
            <div style="font-size: 12px; color: #94a3b8;">E-mail:</div>
            <div style="color: #fff; font-weight: 600; font-size: 13.5px;"><?=$s_mail;?></div>
          </div>
          <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
            <div style="font-size: 12px; color: #94a3b8;">Criada em:</div>
            <div style="color: #fff; font-size: 13.5px;"><?=date('d/m/Y H:i', strtotime($s_reg));?></div>
          </div>
          <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
            <div style="font-size: 12px; color: #94a3b8;">Saldo WCoins:</div>
            <div style="color: #52e591; font-weight: 800; font-size: 15px;"><?=number_format($s_wc, 0, ',', '.');?> WCoins</div>
          </div>
          <div class="col-md-3 col-sm-6" style="margin-bottom: 10px;">
            <div style="font-size: 12px; color: #94a3b8;">Status VIP:</div>
            <div style="color: var(--gold-light); font-weight: 700; font-size: 13.5px;">
              <?=$s_viplvl > 0 ? "VIP Nível $s_viplvl (Até $s_vipexp)" : "Sem VIP";?>
            </div>
          </div>
        </div>

        <!-- 3 ACTION PANELS -->
        <div class="row">
          <!-- Give WCoins / GP -->
          <div class="col-md-4 col-sm-12" style="margin-bottom: 20px;">
            <div style="background: rgba(14,24,42,0.7); border: 1px solid rgba(212,175,55,0.3); border-radius: 8px; padding: 18px; height: 100%;">
              <h5 style="color: #fff; font-family: var(--font-heading); margin: 0 0 12px;"><i class="fa fa-diamond" style="color:#52e591;"></i> ADICIONAR MOEDAS</h5>
              <form action="site.php?p=admin&search_account=<?=urlencode($s_login);?>" method="post">
                <input type="hidden" name="action_give_coins" value="1">
                <input type="hidden" name="target_acc_id" value="<?=$s_id;?>">
                <input type="hidden" name="target_login" value="<?=$s_login;?>">
                
                <div class="form-group">
                  <label style="font-size: 11px; color: #94a3b8;">WCoins a adicionar (+ ou -):</label>
                  <input type="number" name="add_wcoinc" class="form-control luxury-input" value="1000" step="100" style="height: 38px;">
                </div>
                <div class="form-group">
                  <label style="font-size: 11px; color: #94a3b8;">Goblin Points a adicionar:</label>
                  <input type="number" name="add_gp" class="form-control luxury-input" value="0" step="50" style="height: 38px;">
                </div>
                <button type="submit" class="btn btn-cta-gold btn-block" style="padding: 8px; font-size: 12px;">
                  <i class="fa fa-plus-circle"></i> CREDITAR MOEDAS
                </button>
              </form>
            </div>
          </div>

          <!-- Set VIP -->
          <div class="col-md-4 col-sm-12" style="margin-bottom: 20px;">
            <div style="background: rgba(14,24,42,0.7); border: 1px solid rgba(212,175,55,0.3); border-radius: 8px; padding: 18px; height: 100%;">
              <h5 style="color: #fff; font-family: var(--font-heading); margin: 0 0 12px;"><i class="fa fa-star text-gold"></i> ATIVAR / RENOVAR VIP</h5>
              <form action="site.php?p=admin&search_account=<?=urlencode($s_login);?>" method="post">
                <input type="hidden" name="action_set_vip" value="1">
                <input type="hidden" name="target_login" value="<?=$s_login;?>">
                
                <div class="form-group">
                  <label style="font-size: 11px; color: #94a3b8;">Plano VIP:</label>
                  <select name="vip_level" class="form-control luxury-input" style="height: 38px; padding: 6px 10px;">
                    <option value="1">VIP Bronze (Nível 1)</option>
                    <option value="2">VIP Prata (Nível 2)</option>
                    <option value="3" selected>VIP Ouro (Nível 3)</option>
                  </select>
                </div>
                <div class="form-group">
                  <label style="font-size: 11px; color: #94a3b8;">Duração em Dias:</label>
                  <select name="vip_days" class="form-control luxury-input" style="height: 38px; padding: 6px 10px;">
                    <option value="7">7 Dias</option>
                    <option value="15">15 Dias</option>
                    <option value="30" selected>30 Dias (1 Mês)</option>
                    <option value="60">60 Dias (2 Meses)</option>
                    <option value="90">90 Dias (3 Meses)</option>
                    <option value="365">365 Dias (1 Ano)</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-cta-gold btn-block" style="padding: 8px; font-size: 12px;">
                  <i class="fa fa-check"></i> ATIVAR VIP NA CONTA
                </button>
              </form>
            </div>
          </div>

          <!-- Change Password -->
          <div class="col-md-4 col-sm-12" style="margin-bottom: 20px;">
            <div style="background: rgba(14,24,42,0.7); border: 1px solid rgba(212,175,55,0.3); border-radius: 8px; padding: 18px; height: 100%;">
              <h5 style="color: #fff; font-family: var(--font-heading); margin: 0 0 12px;"><i class="fa fa-key text-gold"></i> ALTERAR SENHA DA CONTA</h5>
              <form action="site.php?p=admin&search_account=<?=urlencode($s_login);?>" method="post">
                <input type="hidden" name="action_change_pwd" value="1">
                <input type="hidden" name="target_acc_id" value="<?=$s_id;?>">
                <input type="hidden" name="target_login" value="<?=$s_login;?>">
                
                <div class="form-group">
                  <label style="font-size: 11px; color: #94a3b8;">Nova Senha:</label>
                  <input type="text" name="new_pwd" class="form-control luxury-input" placeholder="Digite a nova senha" minlength="4" required style="height: 38px;">
                </div>
                <div style="font-size: 11px; color: #7d8c9e; margin-bottom: 15px;">
                  A senha será imediatamente criptografada e atualizada no OpenMU e no portal.
                </div>
                <button type="submit" class="btn btn-cta-gold btn-block" style="padding: 8px; font-size: 12px;">
                  <i class="fa fa-refresh"></i> REDEFINIR SENHA
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- CHARACTERS LIST FOR THIS ACCOUNT -->
        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 25px; margin-top: 10px;">
          <h4 style="font-family: var(--font-heading); color: #fff; margin: 0 0 15px; font-size: 17px;">
            <i class="fa fa-shield text-gold"></i> PERSONAGENS DESTA CONTA (<?=count($searched_characters);?>)
          </h4>

          <?php if (empty($searched_characters)): ?>
            <p style="color: #94a3b8; font-size: 13px;">Esta conta ainda não possui personagens criados in-game.</p>
          <?php else: ?>
            <div class="row">
              <?php foreach ($searched_characters as $ch): 
                $c_id   = $ch['Id'];
                $c_name = $ch['Name'];
                $c_res  = (int)$ch['resets'];
                $c_mres = (int)$ch['mresets'];
                $c_pts  = (int)$ch['LevelUpPoints'];
                $c_pk   = (int)$ch['PlayerKillCount'];
                $c_cnum = isset($ch['class_num']) ? (int)$ch['class_num'] : 0;
                $c_cname = isset($class_map[$c_cnum]) ? $class_map[$c_cnum]['name'] : 'Guerreiro';

                // Query Level from StatAttribute
                $q_lvl = @mssql_fetch_row(@mssql_query("SELECT \"Value\" FROM data.\"StatAttribute\" WHERE \"DefinitionId\" = '560931ad-0901-4342-b7f4-fd2e2fcc0563' AND \"CharacterId\" = '$c_id'"));
                $c_lvl = isset($q_lvl[0]) ? (int)$q_lvl[0] : 1;
              ?>
                <div class="col-md-6 col-sm-12" style="margin-bottom: 20px;">
                  <div style="background: rgba(14,24,42,0.85); border: 1px solid rgba(212,175,55,0.35); border-radius: 8px; padding: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                      <div>
                        <strong style="font-size: 17px; color: #fff;"><?=$c_name;?></strong>
                        <span class="class-badge" style="margin-left: 6px;"><?=$c_cname;?></span>
                      </div>
                      <span class="badge" style="background: <?=$c_pk > 0 ? '#ef4444' : '#22c55e';?>;">
                        <?=$c_pk > 0 ? "PK: $c_pk" : "Herói Comum";?>
                      </span>
                    </div>

                    <!-- Edit Form -->
                    <form action="site.php?p=admin&search_account=<?=urlencode($s_login);?>" method="post">
                      <input type="hidden" name="action_edit_char" value="1">
                      <input type="hidden" name="char_id" value="<?=$c_id;?>">
                      <input type="hidden" name="char_name" value="<?=$c_name;?>">
                      
                      <div class="row">
                        <div class="col-xs-6 form-group">
                          <label style="font-size: 11px; color: #94a3b8;">Resets:</label>
                          <input type="number" name="char_resets" class="form-control luxury-input" value="<?=$c_res;?>" min="0" style="height: 34px;">
                        </div>
                        <div class="col-xs-6 form-group">
                          <label style="font-size: 11px; color: #94a3b8;">Master Resets:</label>
                          <input type="number" name="char_mresets" class="form-control luxury-input" value="<?=$c_mres;?>" min="0" style="height: 34px;">
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-xs-6 form-group">
                          <label style="font-size: 11px; color: #94a3b8;">Nível (Level):</label>
                          <input type="number" name="char_level" class="form-control luxury-input" value="<?=$c_lvl;?>" min="1" max="400" style="height: 34px;">
                        </div>
                        <div class="col-xs-6 form-group">
                          <label style="font-size: 11px; color: #94a3b8;">Pontos Livres:</label>
                          <input type="number" name="char_points" class="form-control luxury-input" value="<?=$c_pts;?>" min="0" style="height: 34px;">
                        </div>
                      </div>

                      <div class="form-group">
                        <label style="font-size: 11px; color: #94a3b8;">Mudar Classe do Personagem:</label>
                        <select name="char_class_num" class="form-control luxury-input" style="height: 34px; padding: 4px 8px; font-size: 12px;">
                          <?php foreach ($class_map as $c_code => $c_info): ?>
                            <option value="<?=$c_code;?>" <?=$c_code === $c_cnum ? 'selected' : '';?>>
                              <?=$c_info['name'];?> (Código <?=$c_code;?>)
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>

                      <div style="margin-top: 15px;">
                        <button type="submit" class="btn btn-cta-gold btn-block" style="padding: 8px 16px; font-size: 12px;">
                          <i class="fa fa-save"></i> SALVAR STATS & CLASSE
                        </button>
                      </div>
                    </form>

                    <!-- Extra action buttons -->
                    <div style="display: flex; gap: 8px; margin-top: 10px;">
                      <form action="site.php?p=admin&search_account=<?=urlencode($s_login);?>" method="post" style="flex: 1; margin: 0;">
                        <input type="hidden" name="action_clear_pk" value="1">
                        <input type="hidden" name="char_id" value="<?=$c_id;?>">
                        <input type="hidden" name="char_name" value="<?=$c_name;?>">
                        <button type="submit" class="btn btn-nav-login btn-block" style="padding: 7px 10px; font-size: 11.5px;" title="Limpar PK">
                          <i class="fa fa-eraser"></i> Limpar PK
                        </button>
                      </form>

                      <form action="site.php?p=admin&search_account=<?=urlencode($s_login);?>" method="post" style="flex: 1; margin: 0;">
                        <input type="hidden" name="action_move_lorencia" value="1">
                        <input type="hidden" name="char_id" value="<?=$c_id;?>">
                        <input type="hidden" name="char_name" value="<?=$c_name;?>">
                        <button type="submit" class="btn btn-nav-login btn-block" style="padding: 7px 10px; font-size: 11.5px;" title="Desbugar / Mover para Lorencia">
                          <i class="fa fa-map-marker"></i> Mover Lorencia
                        </button>
                      </form>
                    </div>

                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

      </div>
    <?php endif; ?>
  <?php endif; ?>

  <!-- SECURITY & PORT 8088 LOCKDOWN ADVISORY -->
  <div style="background: rgba(15,23,42,0.95); border: 1px solid rgba(239,68,68,0.4); border-radius: 10px; padding: 25px; margin-top: 35px;">
    <h4 style="font-family: var(--font-heading); color: #f87171; margin: 0 0 12px; font-size: 17px;">
      <i class="fa fa-lock"></i> SEGURANÇA MESTRA • FECHAMENTO DA PORTA 8088 (PGWEB)
    </h4>
    <p style="color: #cbd5e1; font-size: 13px; line-height: 1.7; margin-bottom: 15px;">
      A interface roxa que você viu em <code>http://187.127.26.213:8088</code> é o <strong>pgweb</strong> (uma ferramenta técnica de visualização de banco de dados bruto). 
      Você <strong>não precisa usar o pgweb</strong>, pois agora possui este <strong>Painel Administrativo completo</strong> para gerenciar tudo com cliques simples!
    </p>

    <div style="background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.08); border-radius: 6px; padding: 15px; margin-bottom: 15px;">
      <h6 style="color: var(--gold-light); font-weight: 700; margin: 0 0 8px; font-family: var(--font-heading);">
        <i class="fa fa-terminal"></i> Como fechar a porta 8088 contra hackers no terminal da VPS:
      </h6>
      <code style="display: block; background: #070d17; color: #4ade80; padding: 10px 14px; border-radius: 4px; font-size: 13px;">
        sudo ufw deny 8088
      </code>
      <p style="color: #94a3b8; font-size: 12px; margin: 8px 0 0;">
        Executando este comando, o firewall da VPS bloqueará o acesso externo de qualquer visitante à porta 8088, mantendo seu banco de dados 100% blindado e seguro.
      </p>
    </div>
  </div>

</div>
