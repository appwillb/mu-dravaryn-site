<?php
/**
 * MU Dravaryn - Official Modern Player Panel (Painel do Jogador)
 * Direct database integration with OpenMU PostgreSQL
 */

if (!defined('DRAVARYN_PORTAL')) {
    // If accessed directly, forward to site.php?p=painel
    header("Location: site.php?p=painel");
    exit();
}

$feedback_msg = '';
$feedback_type = 'info';

if (!$is_logged) {
?>
    <div class="panel-auth-required text-center" style="padding: 50px 20px; background: rgba(10,14,24,0.7); border: 1px solid rgba(212,175,55,0.3); border-radius: 8px;">
        <i class="fa fa-shield" style="font-size: 50px; color: var(--gold); margin-bottom: 20px;"></i>
        <h3 class="font-cinzel text-gold" style="font-size: 24px; margin-bottom: 10px;">ACESSO RESTRITO AO PAINEL DO JOGADOR</h3>
        <p style="color: #94a3b8; max-width: 500px; margin: 0 auto 25px;">
            Você precisa estar conectado em sua conta para gerenciar seus personagens, distribuir pontos, resetar e acessar suas moedas.
        </p>
        <button type="button" class="btn btn-nav-register" style="padding: 12px 30px; font-size: 15px;" data-toggle="modal" data-target="#loginModal">
            <i class="fa fa-lock"></i> FAZER LOGIN AGORA
        </button>
        <a href="site.php?p=cadastro" class="btn btn-nav-login" style="padding: 12px 30px; font-size: 15px; margin-left: 10px;">
            <i class="fa fa-user-plus"></i> CRIAR CONTA GRÁTIS
        </a>
    </div>
<?php
    return;
}

// 1. Fetch Logged User Account Details
$safe_login = trim(addslashes($user_login));
$sql_acc = @mssql_query("SELECT a.\"Id\", a.\"LoginName\", a.\"EMail\", a.\"RegistrationDate\", COALESCE(a.\"WCoinC\", 0) as wcoinc, COALESCE(a.\"WCoinP\", 0) as wcoinp, COALESCE(a.\"GoblinPoints\", 0) as gp, m.\"AccountLevel\", m.\"AccountExpireDate\", m.\"vip\", m.\"dias_vip\" 
    FROM data.\"Account\" a 
    LEFT JOIN public.\"MEMB_INFO\" m ON LOWER(m.memb___id) = LOWER(a.\"LoginName\") 
    WHERE LOWER(a.\"LoginName\") = LOWER('$safe_login')");
$acc_data = ($sql_acc) ? @mssql_fetch_assoc($sql_acc) : null;

// Fallback: If join query fails or returns empty, query directly from data."Account"
if (!$acc_data) {
    $sql_acc2 = @mssql_query("SELECT a.\"Id\", a.\"LoginName\", a.\"EMail\", a.\"RegistrationDate\", COALESCE(a.\"WCoinC\", 0) as wcoinc, COALESCE(a.\"WCoinP\", 0) as wcoinp, COALESCE(a.\"GoblinPoints\", 0) as gp 
        FROM data.\"Account\" a 
        WHERE LOWER(a.\"LoginName\") = LOWER('$safe_login')");
    $acc_data = ($sql_acc2) ? @mssql_fetch_assoc($sql_acc2) : null;
    if ($acc_data) {
        $acc_data['AccountLevel'] = 0;
        $acc_data['AccountExpireDate'] = null;
        $acc_data['vip'] = 0;
        $acc_data['dias_vip'] = null;
    }
}

if (!$acc_data) {
    echo "<div class='alert alert-danger' style='background:rgba(239,68,68,0.2);border:1px solid #ef4444;color:#fff;padding:16px 20px;border-radius:8px;'>
        <i class='fa fa-exclamation-triangle' style='margin-right:8px;'></i> 
        Não foi possível localizar os dados da conta <strong>" . htmlspecialchars($user_login) . "</strong>. Por favor, <a href='logar.php?deslogar=ok' style='color:#ffd700;text-decoration:underline;'>clique aqui para deslogar</a> e faça login novamente.
    </div>";
    return;
}

$acc_id = $acc_data['Id'];
$wcoinc = (int)$acc_data['wcoinc'];
$wcoinp = (int)$acc_data['wcoinp'];
$gp     = (int)$acc_data['gp'];

// Check VIP status
$is_vip = false;
$vip_name = 'Conta Comum (Free)';
$vip_expire = '--';
if (!empty($acc_data['AccountExpireDate'])) {
    $exp_time = strtotime($acc_data['AccountExpireDate']);
    if ($exp_time > time()) {
        $is_vip = true;
        $lvl = (int)$acc_data['AccountLevel'];
        if ($lvl == 3) $vip_name = 'VIP Ouro 👑';
        elseif ($lvl == 2) $vip_name = 'VIP Prata 🥈';
        else $vip_name = 'VIP Bronze 🥉';
        $vip_expire = date('d/m/Y H:i', $exp_time);
    }
}

// 2. Process POST Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['panel_action'])) {
    $action    = trim($_POST['panel_action']);
    $char_name = isset($_POST['char_name']) ? trim(addslashes($_POST['char_name'])) : '';

    // Verify character ownership
    $char_query = @mssql_query("SELECT c.\"Id\", c.\"Name\", c.\"Experience\", c.\"LevelUpPoints\", c.\"PlayerKillCount\", c.\"State\", c.\"Resets\", c.\"MasterResets\" 
        FROM data.\"Character\" c 
        WHERE c.\"AccountId\" = '$acc_id' AND c.\"Name\" = '$char_name'");
    $char_row = ($char_query) ? @mssql_fetch_assoc($char_query) : null;

    if ($action === 'change_pwd') {
        $old_pwd = isset($_POST['old_pwd']) ? trim($_POST['old_pwd']) : '';
        $new_pwd = isset($_POST['new_pwd']) ? trim($_POST['new_pwd']) : '';
        $cfm_pwd = isset($_POST['cfm_pwd']) ? trim($_POST['cfm_pwd']) : '';

        // Fetch stored password hash
        $pwd_query = @mssql_query("SELECT \"PasswordHash\" FROM data.\"Account\" WHERE \"Id\" = '$acc_id'");
        $pwd_row = ($pwd_query) ? @mssql_fetch_assoc($pwd_query) : null;
        $stored_hash = $pwd_row ? $pwd_row['PasswordHash'] : '';

        if (empty($old_pwd) || empty($new_pwd) || empty($cfm_pwd)) {
            $feedback_msg = "Preencha todos os campos para alterar a senha!";
            $feedback_type = "danger";
        } elseif ($new_pwd !== $cfm_pwd) {
            $feedback_msg = "A nova senha e a confirmação não conferem!";
            $feedback_type = "danger";
        } elseif (strlen($new_pwd) < 4 || strlen($new_pwd) > 20) {
            $feedback_msg = "A nova senha deve ter entre 4 e 20 caracteres!";
            $feedback_type = "danger";
        } elseif (!password_verify($old_pwd, $stored_hash) && md5($old_pwd) !== $stored_hash && $old_pwd !== $stored_hash) {
            $feedback_msg = "Sua senha atual está incorreta!";
            $feedback_type = "danger";
        } else {
            $new_hash = password_hash($new_pwd, PASSWORD_BCRYPT);
            $safe_new_hash = addslashes($new_hash);
            @mssql_query("UPDATE data.\"Account\" SET \"PasswordHash\" = '$safe_new_hash' WHERE \"Id\" = '$acc_id'");
            @mssql_query("UPDATE public.\"MEMB_INFO\" SET memb__pwd = '$safe_new_hash' WHERE LOWER(memb___id) = LOWER('$safe_login')");
            setcookie("senha", md5($new_hash), time() + (86400 * 30), "/");
            $feedback_msg = "Senha alterada com sucesso!";
            $feedback_type = "success";
        }
    } elseif ($char_row) {
        $char_id = $char_row['Id'];
        $exp     = (float)$char_row['Experience'];
        $level   = (int)(1 + min(399, floor(pow($exp / 250000.0, 0.4))));

        if ($action === 'reset_char') {
            $req_level = $is_vip ? 300 : 350;
            $pts_reward = $is_vip ? 450 : 350;

            if ($level < $req_level) {
                $feedback_msg = "Nível insuficiente! Você precisa de Nível $req_level para resetar. Nível atual: $level.";
                $feedback_type = "warning";
            } else {
                @mssql_query("UPDATE data.\"Character\" 
                    SET \"Resets\" = COALESCE(\"Resets\", 0) + 1,
                        \"LevelUpPoints\" = COALESCE(\"LevelUpPoints\", 0) + $pts_reward,
                        \"Experience\" = 0,
                        \"PositionX\" = 125,
                        \"PositionY\" = 125,
                        \"CurrentMapId\" = '00000300-0000-0000-0000-000000000000' 
                    WHERE \"Id\" = '$char_id'");
                
                // Update StatAttribute level and resets if tracked
                @mssql_query("UPDATE data.\"StatAttribute\" SET \"Value\" = \"Value\" + 1 WHERE \"DefinitionId\" = '89a891a7-f9f9-4ab5-af36-12056e53a5f7' AND \"CharacterId\" = '$char_id'");
                @mssql_query("UPDATE data.\"StatAttribute\" SET \"Value\" = 1 WHERE \"DefinitionId\" = '560931ad-0901-4342-b7f4-fd2e2fcc0563' AND \"CharacterId\" = '$char_id'");

                $feedback_msg = "Parabéns! O personagem <strong>$char_name</strong> foi resetado com sucesso! Ganhou <strong>+$pts_reward pontos</strong>!";
                $feedback_type = "success";
            }
        } elseif ($action === 'master_reset') {
            $current_resets = (int)$char_row['Resets'];
            if ($current_resets < 100 || $level < 400) {
                $feedback_msg = "Requisitos não atingidos! O Master Reset exige 100 Resets e Nível 400. (Seus resets: $current_resets, Nível: $level)";
                $feedback_type = "warning";
            } else {
                @mssql_query("UPDATE data.\"Character\" 
                    SET \"MasterResets\" = COALESCE(\"MasterResets\", 0) + 1,
                        \"Resets\" = 0,
                        \"Experience\" = 0,
                        \"PositionX\" = 125,
                        \"PositionY\" = 125,
                        \"CurrentMapId\" = '00000300-0000-0000-0000-000000000000' 
                    WHERE \"Id\" = '$char_id'");

                // Reward 500 WCoins
                @mssql_query("UPDATE data.\"Account\" SET \"WCoinC\" = COALESCE(\"WCoinC\", 0) + 500 WHERE \"Id\" = '$acc_id'");
                $wcoinc += 500;

                $feedback_msg = "Épico! Master Reset executado com sucesso no personagem <strong>$char_name</strong>! Você recebeu <strong>+500 WCoins</strong>!";
                $feedback_type = "success";
            }
        } elseif ($action === 'clear_pk') {
            @mssql_query("UPDATE data.\"Character\" SET \"PlayerKillCount\" = 0, \"State\" = 0, \"StateRemainingSeconds\" = 0 WHERE \"Id\" = '$char_id'");
            $feedback_msg = "Status de PK (Assassino) do personagem <strong>$char_name</strong> foi limpo com sucesso!";
            $feedback_type = "success";
        } elseif ($action === 'move_char') {
            $dest = isset($_POST['dest']) ? trim($_POST['dest']) : 'lorencia';
            $map_uuid = '00000300-0000-0000-0000-000000000000';
            $posX = 125; $posY = 125; $dest_name = 'Lorencia';

            if ($dest === 'noria') {
                $map_uuid = '00000300-0003-0000-0000-000000000000';
                $posX = 176; $posY = 110; $dest_name = 'Noria';
            } elseif ($dest === 'devias') {
                $map_uuid = '00000300-0002-0000-0000-000000000000';
                $posX = 222; $posY = 62; $dest_name = 'Devias';
            }

            @mssql_query("UPDATE data.\"Character\" SET \"CurrentMapId\" = '$map_uuid', \"PositionX\" = $posX, \"PositionY\" = $posY WHERE \"Id\" = '$char_id'");
            $feedback_msg = "Personagem <strong>$char_name</strong> teletransportado com sucesso para <strong>$dest_name</strong> ($posX, $posY)!";
            $feedback_type = "success";
        } elseif ($action === 'distribute_points') {
            $add_str = max(0, (int)$_POST['add_str']);
            $add_agi = max(0, (int)$_POST['add_agi']);
            $add_vit = max(0, (int)$_POST['add_vit']);
            $add_ene = max(0, (int)$_POST['add_ene']);
            $add_cmd = max(0, (int)$_POST['add_cmd']);

            $total_pts = $add_str + $add_agi + $add_vit + $add_ene + $add_cmd;
            $avail_pts = (int)$char_row['LevelUpPoints'];

            if ($total_pts <= 0) {
                $feedback_msg = "Informe ao menos 1 ponto para distribuir!";
                $feedback_type = "warning";
            } elseif ($total_pts > $avail_pts) {
                $feedback_msg = "Pontos insuficientes! Você tentou distribuir $total_pts pontos, mas só possui $avail_pts pontos livres.";
                $feedback_type = "danger";
            } else {
                // Deduct available points
                @mssql_query("UPDATE data.\"Character\" SET \"LevelUpPoints\" = \"LevelUpPoints\" - $total_pts WHERE \"Id\" = '$char_id'");

                // Stat Definition UUIDs
                $defs = [
                    '123282fe-fead-448e-ad2c-baece939b4b1' => $add_str, // Base Strength
                    '1ae9c014-e3cd-4703-bd05-1b65f5f94ceb' => $add_agi, // Base Agility
                    '6ca5c3a6-b109-45a5-87a7-fdcb107b4982' => $add_vit, // Base Vitality
                    '01b0ef28-f7a0-46b5-97ba-2b624a54cd75' => $add_ene, // Base Energy
                    '6af2c9df-3ae4-4721-8462-9a8ec7f56fe4' => $add_cmd  // Base Leadership
                ];

                foreach ($defs as $def_uuid => $val) {
                    if ($val > 0) {
                        @mssql_query("UPDATE data.\"StatAttribute\" SET \"Value\" = \"Value\" + $val WHERE \"DefinitionId\" = '$def_uuid' AND \"CharacterId\" = '$char_id'");
                    }
                }

                $feedback_msg = "Distribuídos <strong>$total_pts pontos</strong> com sucesso no personagem <strong>$char_name</strong>!";
                $feedback_type = "success";
            }
        }
    }
}

// 3. Query All Characters for this Account
$sql_chars = @mssql_query("SELECT c.\"Id\", c.\"Name\", c.\"Experience\", c.\"LevelUpPoints\", c.\"PlayerKillCount\", c.\"State\", c.\"PositionX\", c.\"PositionY\", COALESCE(c.\"Resets\", 0) as resets, COALESCE(c.\"MasterResets\", 0) as mresets, cc.\"Number\" as class_num, cc.\"Name\" as class_raw_name, m.\"Name\" as map_raw_name 
    FROM data.\"Character\" c 
    LEFT JOIN config.\"CharacterClass\" cc ON c.\"CharacterClassId\" = cc.\"Id\" 
    LEFT JOIN config.\"GameMapDefinition\" m ON c.\"CurrentMapId\" = m.\"Id\" 
    WHERE c.\"AccountId\" = '$acc_id' 
    ORDER BY c.\"Experience\" DESC");

$characters = [];
if ($sql_chars) {
    while ($cr = @mssql_fetch_assoc($sql_chars)) {
        $characters[] = $cr;
    }
}
?>

<!-- REGISTRATION SUCCESS ALERT -->
<?php if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'sucesso'): ?>
<div class="alert alert-success" style="background: linear-gradient(135deg, rgba(16,185,129,0.2) 0%, rgba(5,150,105,0.3) 100%); border: 1px solid #10b981; color: #fff; font-size: 16px; margin-bottom: 25px; padding: 20px; border-radius: 8px; box-shadow: 0 4px 20px rgba(16,185,129,0.3);">
    <h4 class="font-cinzel" style="margin: 0 0 8px 0; color: #6ee7b7; font-weight: 800;"><i class="fa fa-check-circle"></i> CONTA CRIADA COM SUCESSO!</h4>
    <p style="margin: 0; color: #e2e8f0; font-size: 14px;">
        Parabéns, <strong><?=htmlspecialchars(strtoupper($user_login));?></strong>! Sua conta foi criada no servidor e seus <strong>3 Dias de VIP Grátis</strong> já estão ativados. Você já está conectado no seu <strong>Painel do Jogador</strong>.
    </p>
</div>
<?php endif; ?>

<!-- FEEDBACK ALERTS -->
<?php if (!empty($feedback_msg)): ?>
<div class="alert alert-<?=$feedback_type;?> alert-dismissible" role="alert" style="background: rgba(15,23,42,0.9); border-color: <?=$feedback_type=='success'?'#52e591':($feedback_type=='danger'?'#ef4444':'#f59e0b');?>; color:#fff; font-size:15px; margin-bottom:25px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:#fff;"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-<?=$feedback_type=='success'?'check-circle':($feedback_type=='danger'?'exclamation-circle':'info-circle');?>" style="font-size:18px; margin-right:8px; color:<?=$feedback_type=='success'?'#52e591':($feedback_type=='danger'?'#ef4444':'#f59e0b');?>;"></i>
    <?=$feedback_msg;?>
</div>
<?php endif; ?>

<!-- TOP HUD: WALLET & ACCOUNT STATUS -->
<div class="panel-account-hud" style="background: linear-gradient(135deg, rgba(16,24,40,0.85) 0%, rgba(20,29,51,0.85) 100%); border: 1px solid rgba(212,175,55,0.4); border-radius: 10px; padding: 25px; margin-bottom: 30px; box-shadow: 0 8px 32px rgba(0,0,0,0.5);">
    <div class="row" style="display:flex; flex-wrap:wrap; align-items:center;">
        <div class="col-md-5 col-sm-12" style="margin-bottom:15px;">
            <div style="display:flex; align-items:center;">
                <img src="<?=$user_avatar;?>" alt="Avatar" style="width:64px; height:64px; border-radius:50%; border:2px solid var(--gold); margin-right:15px; box-shadow:0 0 15px rgba(212,175,55,0.4);">
                <div>
                    <h3 class="font-cinzel text-gold" style="margin:0; font-size:22px; font-weight:800; letter-spacing:1px;"><?=htmlspecialchars(strtoupper($user_login));?></h3>
                    <span class="badge" style="background:rgba(212,175,55,0.2); border:1px solid rgba(212,175,55,0.5); color:#ffd700; font-size:12px; margin-top:5px; padding:4px 8px;">
                        <i class="fa fa-diamond"></i> <?=$vip_name;?>
                    </span>
                    <?php if ($is_vip): ?>
                        <span style="font-size:11px; color:#94a3b8; margin-left:6px;">Expira em: <?=$vip_expire;?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-sm-12" style="margin-bottom:15px;">
            <div style="display:flex; gap:12px;">
                <div style="flex:1; background:rgba(0,0,0,0.4); border:1px solid rgba(82,229,145,0.3); border-radius:6px; padding:8px 12px; text-align:center;">
                    <div style="font-size:11px; color:#94a3b8; text-transform:uppercase;"><i class="fa fa-coins text-gold"></i> WCoins</div>
                    <div style="font-size:18px; font-weight:800; color:#52e591;"><?=number_format($wcoinc, 0, ',', '.');?></div>
                </div>
                <div style="flex:1; background:rgba(0,0,0,0.4); border:1px solid rgba(56,189,248,0.3); border-radius:6px; padding:8px 12px; text-align:center;">
                    <div style="font-size:11px; color:#94a3b8; text-transform:uppercase;"><i class="fa fa-shield"></i> Goblin Points</div>
                    <div style="font-size:18px; font-weight:800; color:#38bdf8;"><?=number_format($gp, 0, ',', '.');?></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12 text-right" style="margin-bottom:15px;">
            <a href="site.php?p=loja" class="btn btn-nav-register btn-block" style="padding:10px; font-size:13px; margin-bottom:6px;">
                <i class="fa fa-shopping-cart"></i> ABRIR WEBSHOP
            </a>
            <button type="button" class="btn btn-nav-login btn-block" data-toggle="modal" data-target="#pwdModal" style="padding:8px; font-size:12px;">
                <i class="fa fa-key"></i> ALTERAR SENHA
            </button>
        </div>
    </div>
</div>

<!-- CHARACTERS LISTING -->
<div class="section-vanguard-header" style="margin-bottom:20px;">
    <h3><i class="fa fa-users text-gold"></i> MEUS PERSONAGENS (<?=count($characters);?>)</h3>
    <p style="color:#94a3b8; font-size:13px; margin:0;">Selecione uma ação rápida para resetar, distribuir pontos, limpar PK ou mover para zona segura.</p>
</div>

<?php if (empty($characters)): ?>
    <div class="subpage-glass-box text-center" style="padding:40px 20px;">
        <i class="fa fa-user-times" style="font-size:40px; color:#64748b; margin-bottom:15px;"></i>
        <h4 style="color:#cbd5e1;">Nenhum personagem encontrado nesta conta!</h4>
        <p style="color:#94a3b8; font-size:13px;">Abra o client do MU Dravaryn no seu jogo, crie seu personagem e ele aparecerá aqui instantaneamente!</p>
    </div>
<?php else: ?>

<div class="row">
    <?php foreach ($characters as $c): 
        $char_id   = $c['Id'];
        $cname     = $c['Name'];
        $exp       = (float)$c['Experience'];
        $clevel    = (int)(1 + min(399, floor(pow($exp / 250000.0, 0.4))));
        $resets    = (int)$c['resets'];
        $mresets   = (int)$c['mresets'];
        $pk_count  = (int)$c['PlayerKillCount'];
        $free_pts  = (int)$c['LevelUpPoints'];
        $class_num = isset($c['class_num']) ? (int)$c['class_num'] : 0;
        $class_fmt = get_mu_class_name($class_num);

        // Fetch character stats
        $stats_query = @mssql_query("SELECT sa.\"DefinitionId\", sa.\"Value\" FROM data.\"StatAttribute\" sa WHERE sa.\"CharacterId\" = '$char_id'");
        $st_str = 0; $st_agi = 0; $st_vit = 0; $st_ene = 0; $st_cmd = 0;
        if ($stats_query) {
            while ($sr = @mssql_fetch_assoc($stats_query)) {
                $def = $sr['DefinitionId'];
                $val = (int)$sr['Value'];
                if ($def === '123282fe-fead-448e-ad2c-baece939b4b1') $st_str = $val;
                elseif ($def === '1ae9c014-e3cd-4703-bd05-1b65f5f94ceb') $st_agi = $val;
                elseif ($def === '6ca5c3a6-b109-45a5-87a7-fdcb107b4982') $st_vit = $val;
                elseif ($def === '01b0ef28-f7a0-46b5-97ba-2b624a54cd75') $st_ene = $val;
                elseif ($def === '6af2c9df-3ae4-4721-8462-9a8ec7f56fe4') $st_cmd = $val;
            }
        }
    ?>
    <div class="col-md-6 col-sm-12" style="margin-bottom:25px;">
        <div class="character-card-vanguard" style="background: rgba(15,23,42,0.85); border: 1px solid rgba(212,175,55,0.3); border-radius: 8px; padding: 20px; transition: transform 0.2s; box-shadow: 0 4px 20px rgba(0,0,0,0.4);">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; border-bottom:1px solid rgba(255,255,255,0.1); padding-bottom:12px; margin-bottom:15px;">
                <div>
                    <h4 class="font-cinzel text-gold" style="margin:0; font-size:20px; font-weight:800;"><?=$cname;?></h4>
                    <span class="class-badge" style="margin-top:4px; display:inline-block;"><?=$class_fmt;?></span>
                </div>
                <div class="text-right">
                    <span style="font-size:20px; font-weight:800; color:var(--gold-light);">Lv. <?=$clevel;?></span>
                    <div style="font-size:11px; color:#94a3b8;">Max 400</div>
                </div>
            </div>

            <!-- STATS ROW -->
            <div class="row text-center" style="margin-bottom:15px;">
                <div class="col-xs-3" style="border-right:1px solid rgba(255,255,255,0.08);">
                    <div style="font-size:10px; color:#94a3b8; text-transform:uppercase;">Resets</div>
                    <div style="font-size:16px; font-weight:800; color:#52e591;"><?=$resets;?></div>
                </div>
                <div class="col-xs-3" style="border-right:1px solid rgba(255,255,255,0.08);">
                    <div style="font-size:10px; color:#94a3b8; text-transform:uppercase;">M.Resets</div>
                    <div style="font-size:16px; font-weight:800; color:#38bdf8;"><?=$mresets;?></div>
                </div>
                <div class="col-xs-3" style="border-right:1px solid rgba(255,255,255,0.08);">
                    <div style="font-size:10px; color:#94a3b8; text-transform:uppercase;">Pontos</div>
                    <div style="font-size:16px; font-weight:800; color:#ffd700;"><?=$free_pts;?></div>
                </div>
                <div class="col-xs-3">
                    <div style="font-size:10px; color:#94a3b8; text-transform:uppercase;">Status PK</div>
                    <div style="font-size:13px; font-weight:700; color:<?=$pk_count>0?'#ef4444':'#94a3b8';?>;">
                        <?=$pk_count>0 ? "PK ($pk_count)" : 'Herói/Normal';?>
                    </div>
                </div>
            </div>

            <!-- ATTRIBUTES SUMMARY -->
            <div style="background:rgba(0,0,0,0.3); border-radius:6px; padding:10px; font-size:12px; margin-bottom:15px; color:#cbd5e1; display:flex; justify-content:space-around;">
                <span><strong>FOR:</strong> <?=$st_str;?></span>
                <span><strong>AGI:</strong> <?=$st_agi;?></span>
                <span><strong>VIT:</strong> <?=$st_vit;?></span>
                <span><strong>ENE:</strong> <?=$st_ene;?></span>
                <?php if (in_array($class_num, [16, 17])): ?>
                    <span><strong>CMD:</strong> <?=$st_cmd;?></span>
                <?php endif; ?>
            </div>

            <!-- ACTION BUTTONS -->
            <div style="display:flex; flex-wrap:wrap; gap:8px;">
                <!-- RESET BUTTON -->
                <form method="post" style="flex:1; min-width:120px;">
                    <input type="hidden" name="panel_action" value="reset_char">
                    <input type="hidden" name="char_name" value="<?=$cname;?>">
                    <button type="submit" class="btn btn-success btn-block btn-sm" style="font-weight:700;" onclick="return confirm('Confirmar reset do personagem <?=$cname;?>?');">
                        <i class="fa fa-refresh"></i> RESETAR
                    </button>
                </form>

                <!-- MASTER RESET -->
                <form method="post" style="flex:1; min-width:120px;">
                    <input type="hidden" name="panel_action" value="master_reset">
                    <input type="hidden" name="char_name" value="<?=$cname;?>">
                    <button type="submit" class="btn btn-warning btn-block btn-sm" style="font-weight:700;" onclick="return confirm('Confirmar MASTER RESET do personagem <?=$cname;?>? (Requer 100 Resets e Lv 400)');">
                        <i class="fa fa-trophy"></i> M. RESET
                    </button>
                </form>

                <!-- DISTRIBUTE POINTS MODAL TRIGGER -->
                <button type="button" class="btn btn-primary btn-sm" style="flex:1; min-width:120px; font-weight:700;" data-toggle="modal" data-target="#distModal_<?=md5($cname);?>">
                    <i class="fa fa-plus-circle"></i> PONTOS (<?=$free_pts;?>)
                </button>

                <!-- CLEAR PK -->
                <?php if ($pk_count > 0): ?>
                <form method="post" style="flex:1; min-width:120px;">
                    <input type="hidden" name="panel_action" value="clear_pk">
                    <input type="hidden" name="char_name" value="<?=$cname;?>">
                    <button type="submit" class="btn btn-danger btn-block btn-sm" style="font-weight:700;">
                        <i class="fa fa-gavel"></i> LIMPAR PK
                    </button>
                </form>
                <?php endif; ?>

                <!-- MOVE / UNSTUCK -->
                <form method="post" style="flex:1; min-width:120px;">
                    <input type="hidden" name="panel_action" value="move_char">
                    <input type="hidden" name="char_name" value="<?=$cname;?>">
                    <input type="hidden" name="dest" value="lorencia">
                    <button type="submit" class="btn btn-default btn-block btn-sm" style="background:rgba(255,255,255,0.05); color:#cbd5e1; border-color:rgba(255,255,255,0.15);">
                        <i class="fa fa-map-marker text-gold"></i> DESBUGAR
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DISTRIBUIR PONTOS -->
    <div class="modal fade" id="distModal_<?=md5($cname);?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" style="background:#0f172a; border:1px solid rgba(212,175,55,0.5); color:#fff;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                    <h4 class="modal-title font-cinzel text-gold"><i class="fa fa-bolt"></i> DISTRIBUIR PONTOS: <?=$cname;?></h4>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <input type="hidden" name="panel_action" value="distribute_points">
                        <input type="hidden" name="char_name" value="<?=$cname;?>">
                        <p style="font-size:12px; color:#94a3b8;">Pontos Livres Disponíveis: <strong style="color:#52e591; font-size:14px;"><?=$free_pts;?></strong></p>
                        
                        <div class="form-group">
                            <label style="font-size:12px; color:#ffd700;">Força (Strength):</label>
                            <input type="number" name="add_str" class="form-control luxury-input" min="0" max="<?=$free_pts;?>" value="0">
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px; color:#ffd700;">Agilidade (Agility):</label>
                            <input type="number" name="add_agi" class="form-control luxury-input" min="0" max="<?=$free_pts;?>" value="0">
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px; color:#ffd700;">Vitalidade (Vitality):</label>
                            <input type="number" name="add_vit" class="form-control luxury-input" min="0" max="<?=$free_pts;?>" value="0">
                        </div>
                        <div class="form-group">
                            <label style="font-size:12px; color:#ffd700;">Energia (Energy):</label>
                            <input type="number" name="add_ene" class="form-control luxury-input" min="0" max="<?=$free_pts;?>" value="0">
                        </div>
                        <?php if (in_array($class_num, [16, 17])): ?>
                        <div class="form-group">
                            <label style="font-size:12px; color:#ffd700;">Comando (Leadership):</label>
                            <input type="number" name="add_cmd" class="form-control luxury-input" min="0" max="<?=$free_pts;?>" value="0">
                        </div>
                        <?php else: ?>
                            <input type="hidden" name="add_cmd" value="0">
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-nav-register" <?=$free_pts<=0?'disabled':'';?>>CONFIRMAR DISTRIBUIÇÃO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<!-- MODAL ALTERAR SENHA -->
<div class="modal fade" id="pwdModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="background:#0f172a; border:1px solid rgba(212,175,55,0.5); color:#fff;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4 class="modal-title font-cinzel text-gold"><i class="fa fa-key"></i> ALTERAR SENHA</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="panel_action" value="change_pwd">
                    <div class="form-group">
                        <label style="font-size:12px; color:#ffd700;">Senha Atual:</label>
                        <input type="password" name="old_pwd" class="form-control luxury-input" placeholder="Digite sua senha atual" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px; color:#ffd700;">Nova Senha:</label>
                        <input type="password" name="new_pwd" class="form-control luxury-input" placeholder="4 a 20 caracteres" required>
                    </div>
                    <div class="form-group">
                        <label style="font-size:12px; color:#ffd700;">Confirmar Nova Senha:</label>
                        <input type="password" name="cfm_pwd" class="form-control luxury-input" placeholder="Repita a nova senha" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-nav-register">SALVAR NOVA SENHA</button>
                </div>
            </form>
        </div>
    </div>
</div>
