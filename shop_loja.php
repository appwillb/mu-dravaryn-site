<?php
/**
 * MU Dravaryn - Official Modern WebShop (Loja de Itens do Jogo)
 * Direct database integration with OpenMU PostgreSQL
 * Complete Expanded Catalog: Classic Sets, S6 Sets, Archangel Weapons, Fenrirs, Wings & 3D Render Showcase
 */

if (!defined('DRAVARYN_PORTAL')) {
    header("Location: site.php?p=loja");
    exit();
}

$shop_feedback = '';
$shop_feedback_type = 'info';

// 1. Fetch user coin balance and VaultId if logged in
$user_wcoinc = 0;
$user_gp = 0;
$acc_id = null;
$vault_id = null;

if ($is_logged) {
    $safe_login = addslashes($user_login);
    $sql_coins = @mssql_query("SELECT a.\"Id\", a.\"VaultId\", COALESCE(a.\"WCoinC\", 0) as wcoinc, COALESCE(a.\"GoblinPoints\", 0) as gp 
        FROM data.\"Account\" a 
        WHERE LOWER(a.\"LoginName\") = LOWER('$safe_login')");
    $coin_data = ($sql_coins) ? @mssql_fetch_assoc($sql_coins) : null;
    if ($coin_data) {
        $acc_id      = $coin_data['Id'];
        $vault_id    = $coin_data['VaultId'];
        $user_wcoinc = (int)$coin_data['wcoinc'];
        $user_gp     = (int)$coin_data['gp'];
    }
}

// 2. Comprehensive Item Catalog Definition
$catalog = [
    'vip' => [
        'title' => 'Planos VIP & Privilégios',
        'icon'  => 'fa-diamond',
        'items' => [
            [
                'id'       => 'vip_bronze',
                'name'     => 'Plano VIP Bronze (30 Dias)',
                'desc'     => '+30% EXP Geral • +10% Drop • Reset Lv. 380 • Pontos: 400/reset',
                'options'  => ['+30% Bônus de Experiência', '+10% Taxa de Drop & Jóias', 'Reset no Nível 380', '400 Pontos por Reset'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type'     => 'vip',
                'vip_lvl'  => 1,
                'icon_fa'  => 'fa-shield',
                'badge'    => 'Iniciante'
            ],
            [
                'id'       => 'vip_prata',
                'name'     => 'Plano VIP Prata (30 Dias)',
                'desc'     => '+50% EXP Geral • +20% Drop • Reset Lv. 350 • Pontos: 450/reset • Comandos Exclusivos',
                'options'  => ['+50% Bônus de Experiência', '+20% Taxa de Drop & Jóias', 'Reset no Nível 350', '450 Pontos por Reset', 'Comandos Especiais no Chat'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type'     => 'vip',
                'vip_lvl'  => 2,
                'icon_fa'  => 'fa-star',
                'badge'    => 'Mais Popular'
            ],
            [
                'id'       => 'vip_ouro',
                'name'     => 'Plano VIP Ouro (30 Dias)',
                'desc'     => '+100% EXP Geral • +35% Drop • Reset Lv. 300 • Pontos: 500/reset • Sala VIP Exclusiva',
                'options'  => ['+100% Bônus de Experiência', '+35% Taxa de Drop & Jóias', 'Reset no Nível 300', '500 Pontos por Reset', 'Acesso à Sala VIP com Spots Raros'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'vip',
                'vip_lvl'  => 3,
                'icon_fa'  => 'fa-trophy',
                'badge'    => 'Máxima Vantagem'
            ],
        ]
    ],
    'sets' => [
        'title' => 'Sets de Armadura Completos (+13 Full)',
        'icon'  => 'fa-shield',
        'items' => [
            // --- SETS CLÁSSICOS LENDÁRIOS ---
            [
                'id'       => 'set_great_dragon',
                'name'     => 'Set Great Dragon (+13 Full)',
                'desc'     => 'O set mais clássico e temido de Blade Knight • Helm, Armor, Pants, Gloves e Boots.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'BK Clássico'
            ],
            [
                'id'       => 'set_dark_phoenix',
                'name'     => 'Set Dark Phoenix (+13 Full)',
                'desc'     => 'Set lendário de chamas sombrias para Blade Knight • Proteção e imponência máxima.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%'],
                'price_wc' => 5500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'BK Lendário'
            ],
            [
                'id'       => 'set_dark_soul',
                'name'     => 'Set Dark Soul (+13 Full)',
                'desc'     => 'O icônico set cósmico azul do Soul Master • Máxima amplificação de poder arcano.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Aumento de Mana +4%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'SM Clássico'
            ],
            [
                'id'       => 'set_grand_soul',
                'name'     => 'Set Grand Soul (+13 Full)',
                'desc'     => 'Armadura celestial prateada de Soul Master • Tradição e equilíbrio místico.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'SM Tradição'
            ],
            [
                'id'       => 'set_red_spirit',
                'name'     => 'Set Red Spirit (+13 Full)',
                'desc'     => 'O set vermelho alado supremo da Muse Elf • Agilidade, esquiva e beleza inigualável.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Esquiva e Buffs +4%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-leaf',
                'badge'    => 'ME Clássica'
            ],
            [
                'id'       => 'set_hurricane',
                'name'     => 'Set Hurricane (+13 Full)',
                'desc'     => 'Set das tempestades para Magic Gladiator • Armor, Pants, Gloves e Boots Full.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Poder Físico e Mágico'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-bolt',
                'badge'    => 'MG Clássico'
            ],
            [
                'id'       => 'set_dark_master',
                'name'     => 'Set Dark Master (+13 Full)',
                'desc'     => 'O manto imperial do Lord Emperor • Soberania absoluta e poder das trevas.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Liderança e Bônus Pet'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-crown',
                'badge'    => 'DL Clássico'
            ],

            // --- SETS SEASON 6 MODERNOS ---
            [
                'id'       => 'set_dragon_knight',
                'name'     => 'Set Dragon Knight (+13 Full)',
                'desc'     => 'Set Completo (Helm, Armor, Pants, Gloves, Boots) para Blade Master.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 6000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'Blade Master'
            ],
            [
                'id'       => 'set_venom_mist',
                'name'     => 'Set Venom Mist (+13 Full)',
                'desc'     => 'Set Completo (Helm, Armor, Pants, Gloves, Boots) para Grand Master.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%'],
                'price_wc' => 6000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'Grand Master'
            ],
            [
                'id'       => 'set_sylphid_ray',
                'name'     => 'Set Sylphid Ray (+13 Full)',
                'desc'     => 'Set Completo (Helm, Armor, Pants, Gloves, Boots) para High Elf.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%'],
                'price_wc' => 6000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-leaf',
                'badge'    => 'High Elf'
            ],
            [
                'id'       => 'set_volcano',
                'name'     => 'Set Volcano (+13 Full)',
                'desc'     => 'Set Completo (Armor, Pants, Gloves, Boots) para Duel Master.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 6000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-fire',
                'badge'    => 'Duel Master'
            ],
            [
                'id'       => 'set_storm_crow',
                'name'     => 'Set Storm Crow (+13 Full)',
                'desc'     => 'Set Completo (Helm, Armor, Pants, Gloves, Boots) para Lord Emperor.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Liderança + Bônus Pet'],
                'price_wc' => 5500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-crown',
                'badge'    => 'Lord Emperor'
            ],
            [
                'id'       => 'set_red_wing',
                'name'     => 'Set Red Wing (+13 Full)',
                'desc'     => 'Set Completo (Helm, Armor, Pants, Gloves, Boots) para Dimension Master.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Aumento de Mana/Vida'],
                'price_wc' => 6000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-tint',
                'badge'    => 'Dimension Master'
            ],
            [
                'id'       => 'set_phoenix_soul',
                'name'     => 'Set Phoenix Soul (+13 Full)',
                'desc'     => 'Set Completo (Helm, Armor, Pants, Boots) para Fist Master.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Poder Físico Bruto'],
                'price_wc' => 6000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-hand-rock-o',
                'badge'    => 'Fist Master'
            ]
        ]
    ],
    'weapons' => [
        'title' => 'Armas Lendárias & Archangel (+13 Full)',
        'icon'  => 'fa-crosshairs',
        'items' => [
            // --- ARMAS ARCHANGEL SAGRADAS ---
            [
                'id'       => 'wpn_archangel_sword',
                'name'     => 'Divine Sword of Archangel +13 Full',
                'desc'     => 'A lendária espada sagrada do Arcanjo • Luz divina, poder absoluto e velocidade.',
                'options'  => ['+13 + Sorte + Skill + Adicional 28', 'Dano Excelente +10%', 'Aumento de Velocidade +7', 'Dano Crítico Divino'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'Arcanjo Sagrado'
            ],
            [
                'id'       => 'wpn_archangel_staff',
                'name'     => 'Divine Staff of Archangel +13 Full',
                'desc'     => 'O cajado celestial do Arcanjo • Amplificação pura de feitiços arcanos.',
                'options'  => ['+13 + Sorte + Skill + Adicional 28', 'Dano Mágico Excelente +10%', 'Velocidade de Conjuração +7', 'Poder Sagrado'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'Arcanjo Sagrado'
            ],
            [
                'id'       => 'wpn_archangel_crossbow',
                'name'     => 'Divine Crossbow of Archangel +13 Full',
                'desc'     => 'A balestra divina do Arcanjo • Disparos perfurantes com alcance supremo.',
                'options'  => ['+13 + Sorte + Skill + Adicional 28', 'Dano Excelente +10%', 'Velocidade de Ataque +7', 'Flechas Iluminadas'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-crosshairs',
                'badge'    => 'Arcanjo Sagrado'
            ],
            [
                'id'       => 'wpn_archangel_scepter',
                'name'     => 'Divine Scepter of Archangel +13 Full',
                'desc'     => 'O cetro da graça divina para Lord Emperor • Comando celestial supremo.',
                'options'  => ['+13 + Sorte + Skill + Adicional 28', 'Dano Excelente +10%', 'Bônus de Ataque dos Pets', 'Liderança Sagrada'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-gavel',
                'badge'    => 'Arcanjo Sagrado'
            ],

            // --- ARMAS LENDÁRIAS CLÁSSICAS & S6 ---
            [
                'id'       => 'wpn_kundun_staff',
                'name'     => 'Staff of Kundun +13 Full',
                'desc'     => 'O cajado negro forjado nas trevas de Kundun • Poder mágico destrutivo.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Dano Mágico Excelente +10%', 'Aumento de Dano Mágico +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'Grand Master'
            ],
            [
                'id'       => 'wpn_knight_blade',
                'name'     => 'Knight Blade +13 Full',
                'desc'     => 'A poderosa espada de duas mãos do Blade Knight clássico.',
                'options'  => ['+13 + Sorte + Skill + Adicional 28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Taxa de Acerto +10%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'Blade Knight'
            ],
            [
                'id'       => 'wpn_daybreak',
                'name'     => 'Daybreak +13 Full',
                'desc'     => 'A lâmina da alvorada dourada • Lâmina nobre com corte afiado e brilho solar.',
                'options'  => ['+13 + Sorte + Skill + Adicional 28', 'Dano Excelente +10%', 'Velocidade de Ataque +7', 'Dano Crítico +2%'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-sun-o',
                'badge'    => 'Blade Master'
            ],
            [
                'id'       => 'wpn_rune_bastard',
                'name'     => 'Rune Bastard Sword +13 Full',
                'desc'     => 'Espada bastarda rúnica milenar • Equilíbrio perfeito entre força e peso.',
                'options'  => ['+13 + Sorte + Skill + Adicional 28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade +7'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-bolt',
                'badge'    => 'BM / MG'
            ],
            [
                'id'       => 'wpn_bone_blade',
                'name'     => 'Bone Blade +13 Full',
                'desc'     => 'Espada de uma mão para Blade Master • Taxa de Ataque + Sorte + Dano Crítico.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Taxa de Ataque Excelente'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'Blade Master'
            ],
            [
                'id'       => 'wpn_imperial_sword',
                'name'     => 'Imperial Sword +13 Full',
                'desc'     => 'Espada de alta precisão para Blade Master e Magic Gladiator.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Dano Excelente +10%', 'Aumento de Velocidade +7', 'Aumento de Dano +2%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'BM / MG'
            ],
            [
                'id'       => 'wpn_grand_viper',
                'name'     => 'Grand Viper Staff +13 Full',
                'desc'     => 'Cajado supremo de duas mãos para Grand Master • Poder Mágico Transcendental.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Dano Mágico Excelente +10%', 'Aumento de Dano Mágico +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'Grand Master'
            ],
            [
                'id'       => 'wpn_shining_scepter',
                'name'     => 'Shining Scepter +13 Full',
                'desc'     => 'Cetro de comando divino para Lord Emperor • Bônus de Dano e Pet Dano.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Dano Excelente +10%', 'Aumento de Pet Dano', 'Aumento de Dano +2%'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-gavel',
                'badge'    => 'Lord Emperor'
            ],
            [
                'id'       => 'wpn_albatross_bow',
                'name'     => 'Albatross Bow +13 Full',
                'desc'     => 'Arco de precisão lendário para High Elf • Velocidade e Dano Máximo.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Dano Excelente +10%', 'Velocidade de Ataque +7', 'Dano Crítico Aumentado'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-crosshairs',
                'badge'    => 'High Elf'
            ],
            [
                'id'       => 'wpn_dark_reign',
                'name'     => 'Dark Reign Blade +13 Full',
                'desc'     => 'Espada rúnica mística exclusiva para Duel Master.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Dano Excelente +10%', 'Dano Mágico + Físico Bônus', 'Aumento de Velocidade +7'],
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-bolt',
                'badge'    => 'Duel Master'
            ],
            [
                'id'       => 'shield_dragon',
                'name'     => 'Dragon Shield +13 Full',
                'desc'     => 'Escudo colossal com máxima absorção de impacto.',
                'options'  => ['+13 + Sorte + Adicional 28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2500,
                'price_gp' => 4000,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'Escudo'
            ]
        ]
    ],
    'pets' => [
        'title' => 'Montarias & Pets Lendários',
        'icon'  => 'fa-paw',
        'items' => [
            [
                'id'       => 'pet_fenrir_gold',
                'name'     => 'Horn of Fenrir Dourado (Gold Fenrir)',
                'desc'     => 'O lendário Lobo Dourado • A montaria mais rara e cobiçada de todo o MU Online.',
                'options'  => ['Velocidade Máxima de Movimento', 'Aumento de Dano Absoluto', 'Resistência a Atordoamento', 'Imponência Dourada'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-paw',
                'badge'    => 'Montaria Mítica'
            ],
            [
                'id'       => 'pet_fenrir_black',
                'name'     => 'Horn of Fenrir Preto (Destruction)',
                'desc'     => 'Fenrir da Destruição • Focado em perfurar armaduras e aniquilar oponentes em PvP.',
                'options'  => ['Aumento de Dano Final +10%', 'Aumento de Taxa de Ataque', 'Habilidade Especial Plasma Storm', 'Aceleração de Montaria'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-paw',
                'badge'    => 'PvP Ataque'
            ],
            [
                'id'       => 'pet_fenrir_blue',
                'name'     => 'Horn of Fenrir Azul (Protection)',
                'desc'     => 'Fenrir da Proteção • Barreira blindada com máxima redução de dano sofrido.',
                'options'  => ['Absorção de Dano +10%', 'Defesa Reforçada em Batalhas', 'Habilidade Especial Plasma Storm', 'Aceleração de Montaria'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-paw',
                'badge'    => 'PvP Defesa'
            ],
            [
                'id'       => 'pet_fenrir_red',
                'name'     => 'Horn of Fenrir Vermelho',
                'desc'     => 'O clássico Lobo de Fogo • Montaria veloz e feroz com ataque de tempestade.',
                'options'  => ['Velocidade de Deslocamento Rápida', 'Habilidade Especial Plasma Storm', 'Aumento de Dano em Monstros', 'Resistência Física'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-paw',
                'badge'    => 'Montaria'
            ],
            [
                'id'       => 'pet_dinorant',
                'name'     => 'Horn of Dinorant (+15 Voador)',
                'desc'     => 'Montaria alada clássica • Permite planar por Icarus e disparar esferas de fogo.',
                'options'  => ['Voo Livre (Acesso a Icarus)', 'Absorção de Dano +15%', 'Ataque de Fogo à Distância', 'Durabilidade 255'],
                'price_wc' => 1200,
                'price_gp' => 2000,
                'type'     => 'item',
                'icon_fa'  => 'fa-plane',
                'badge'    => 'Voador'
            ],
            [
                'id'       => 'pet_dark_horse',
                'name'     => 'Dark Horse Level 50 (Cavalo do DL)',
                'desc'     => 'O temido Corcel das Sombras exclusivo para Dark Lord • Nível 50 Máximo.',
                'options'  => ['Nível 50 Full Poder', 'Habilidade Especial Earthshake', 'Absorção de Impacto Superior', 'Defesa por Comando'],
                'price_wc' => 2500,
                'price_gp' => 3500,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'Dark Lord'
            ],
            [
                'id'       => 'pet_dark_raven',
                'name'     => 'Dark Raven Level 50 (Corvo do DL)',
                'desc'     => 'O Corvo de Ataque Imperial exclusivo para Dark Lord • Nível 50 Máximo.',
                'options'  => ['Nível 50 Full Dano', 'Ataque Automático e Focado', 'Dano Rápido Contínuo', 'Bônus de Liderança'],
                'price_wc' => 2000,
                'price_gp' => 3000,
                'type'     => 'item',
                'icon_fa'  => 'fa-feather-alt',
                'badge'    => 'Dark Lord'
            ]
        ]
    ],
    'wings' => [
        'title' => 'Asas & Capas (Level 2 e 3)',
        'icon'  => 'fa-feather-alt',
        'items' => [
            [
                'id'       => 'wing_storm_lvl3',
                'name'     => 'Wings of Storm Level 3 (+13)',
                'desc'     => 'Asa Level 3 para Blade Master • +13 + Sorte + Adicional + 2 Opções Excelentes.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Recuperação +28', 'Ignora Defesa do Oponente 3%', 'Dano Excelente Aumentado'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-bolt',
                'badge'    => 'BM Lvl 3'
            ],
            [
                'id'       => 'wing_spacetime_lvl3',
                'name'     => 'Wings of Eternal / Space-Time (+13)',
                'desc'     => 'Asa Level 3 para Grand Master • +13 + Sorte + Adicional + 2 Opções Excelentes.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Recuperação +28', 'Ignora Defesa do Oponente 3%', 'Poder Mágico Amplificado'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'GM Lvl 3'
            ],
            [
                'id'       => 'wing_illusion_lvl3',
                'name'     => 'Wings of Illusion Level 3 (+13)',
                'desc'     => 'Asa Level 3 para High Elf • +13 + Sorte + Adicional + 2 Opções Excelentes.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Recuperação +28', 'Ignora Defesa do Oponente 3%', 'Aumento de Velocidade de Disparo'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-leaf',
                'badge'    => 'HE Lvl 3'
            ],
            [
                'id'       => 'cape_emperor_lvl3',
                'name'     => 'Cape of Emperor Level 3 (+13)',
                'desc'     => 'Capa Level 3 para Lord Emperor • +13 + Sorte + Adicional + Liderança Máxima.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Ignora Defesa do Oponente 3%', 'Bônus de Comando & Pet'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-crown',
                'badge'    => 'LE Lvl 3'
            ],
            [
                'id'       => 'wing_ruin_lvl3',
                'name'     => 'Wings of Downfall / Ruin (+13)',
                'desc'     => 'Asa Level 3 para Duel Master • +13 + Sorte + Adicional + 2 Opções Excelentes.',
                'options'  => ['+13 + Sorte (Luck)', 'Adicional de Ataque +28', 'Ignora Defesa do Oponente 3%', 'Dano Híbrido Físico e Mágico'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-fire',
                'badge'    => 'DM Lvl 3'
            ],
            [
                'id'       => 'wing_dragon_lvl2',
                'name'     => 'Dragon Wings Level 2 (+11)',
                'desc'     => 'Asa Level 2 para Blade Knight / Magic Gladiator • +11 + Sorte + Adicional.',
                'options'  => ['+11 + Sorte (Luck)', 'Adicional +16', 'Absorção de Dano 32%', 'Aumento de Dano 32%'],
                'price_wc' => 1500,
                'price_gp' => 2500,
                'type'     => 'item',
                'icon_fa'  => 'fa-fire',
                'badge'    => 'Lvl 2 Clássica'
            ],
            [
                'id'       => 'wing_angel_lvl2',
                'name'     => 'Soul Wings Level 2 (+11)',
                'desc'     => 'Asa Level 2 para Soul Master / Magic Gladiator • +11 + Sorte + Adicional.',
                'options'  => ['+11 + Sorte (Luck)', 'Adicional +16', 'Absorção de Dano 32%', 'Aumento de Dano Mágico 32%'],
                'price_wc' => 1500,
                'price_gp' => 2500,
                'type'     => 'item',
                'icon_fa'  => 'fa-tint',
                'badge'    => 'Lvl 2 Clássica'
            ]
        ]
    ],
    'jewels' => [
        'title' => 'Jóias & Acessórios Ancient',
        'icon'  => 'fa-gem',
        'items' => [
            [
                'id'       => 'kit_ancient_rings',
                'name'     => 'Kit Acessórios Ancient (+13 Full)',
                'desc'     => 'Kit Completo: Ring of Ice + Ring of Poison + Pendant of Lighting Full +13.',
                'options'  => ['3 Acessórios Sagrados', 'Absorção Máxima de Dano + Vida', 'Resistência a Gelo, Veneno e Raio', 'Recuperação Automática de HP'],
                'price_wc' => 2800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-circle-o',
                'badge'    => 'Kit 3x Ancient'
            ],
            [
                'id'       => 'pack_bless_30',
                'name'     => 'Pack 30x Jewel of Bless',
                'desc'     => 'Pacote com 30 Jóias da Benção para aprimorar seus equipamentos até +6.',
                'options'  => ['30 Unidades Lacradas', '100% de Sucesso até +6', 'Pode ser descompactado no jogo'],
                'price_wc' => 300,
                'price_gp' => 500,
                'type'     => 'item',
                'icon_fa'  => 'fa-diamond',
                'badge'    => 'Essencial'
            ],
            [
                'id'       => 'pack_soul_30',
                'name'     => 'Pack 30x Jewel of Soul',
                'desc'     => 'Pacote com 30 Jóias da Alma para refinar seus itens até +9.',
                'options'  => ['30 Unidades Lacradas', 'Refinamento avançado até +9', 'Pode ser descompactado no jogo'],
                'price_wc' => 300,
                'price_gp' => 500,
                'type'     => 'item',
                'icon_fa'  => 'fa-diamond',
                'badge'    => 'Essencial'
            ],
            [
                'id'       => 'pack_chaos_30',
                'name'     => 'Pack 30x Jewel of Chaos',
                'desc'     => 'Pacote com 30 Jóias do Caos para combinações e criações na Chaos Machine.',
                'options'  => ['30 Unidades Lacradas', 'Ingrediente vital na Chaos Machine', 'Criação de Asas e Itens +10 a +13'],
                'price_wc' => 200,
                'price_gp' => 350,
                'type'     => 'item',
                'icon_fa'  => 'fa-circle-o',
                'badge'    => 'Refino'
            ],
            [
                'id'       => 'pack_life_30',
                'name'     => 'Pack 30x Jewel of Life',
                'desc'     => 'Pacote com 30 Jóias da Vida para adicionar opcionais adicionais aos seus itens.',
                'options'  => ['30 Unidades Lacradas', 'Adiciona e sobe Option até +28', 'Valoriza o mercado de trocas'],
                'price_wc' => 400,
                'price_gp' => 600,
                'type'     => 'item',
                'icon_fa'  => 'fa-heart',
                'badge'    => 'Opção Extra'
            ],
            [
                'id'       => 'pack_harmony_30',
                'name'     => 'Pack 30x Jewel of Harmony',
                'desc'     => 'Pacote com 30 Jóias da Harmonia para inserir opções amarelas especiais.',
                'options'  => ['30 Unidades', 'Opções amarelas de PVP e PVM', 'Reforça ataque e defesa'],
                'price_wc' => 600,
                'price_gp' => 900,
                'type'     => 'item',
                'icon_fa'  => 'fa-sun-o',
                'badge'    => 'PVP High End'
            ]
        ]
    ],
    'buffs' => [
        'title' => 'Buffs & Consumíveis',
        'icon'  => 'fa-flask',
        'items' => [
            [
                'id'       => 'seal_ascension_7d',
                'name'     => 'Seal of Ascension (7 Dias)',
                'desc'     => 'Selo de Ascensão • +50% de Experiência obtida em todos os monstros por 7 dias.',
                'options'  => ['Duração: 7 Dias Corridos', '+50% Bônus de XP Ativo', 'Cumulativo com VIP'],
                'price_wc' => 500,
                'price_gp' => 800,
                'type'     => 'item',
                'icon_fa'  => 'fa-bolt',
                'badge'    => '+50% EXP'
            ],
            [
                'id'       => 'seal_wealth_7d',
                'name'     => 'Seal of Wealth (7 Dias)',
                'desc'     => 'Selo da Riqueza • +100% de Taxa de Drop e Jóias por 7 dias corridos.',
                'options'  => ['Duração: 7 Dias Corridos', '+100% de Drop & Jóias', 'Dobro de itens lendários'],
                'price_wc' => 600,
                'price_gp' => 900,
                'type'     => 'item',
                'icon_fa'  => 'fa-money',
                'badge'    => '+100% DROP'
            ],
            [
                'id'       => 'cherry_blossom_wine',
                'name'     => 'Vinho Flor de Cerejeira (10x)',
                'desc'     => 'Consumível especial que confere +700 de Vida Máxima por 1 hora por garrafa.',
                'options'  => ['Pacote com 10 Garrafas', '+700 de Vida (HP) por Garrafa', 'Duração: 1 Hora cada'],
                'price_wc' => 200,
                'price_gp' => 300,
                'type'     => 'item',
                'icon_fa'  => 'fa-glass',
                'badge'    => 'Buff PvP'
            ]
        ]
    ]
];

// 2.1 Mapping of OpenMU Item Definitions for In-Game Vault Delivery
$catalog_delivery_items = [
    // --- SETS CLÁSSICOS ---
    'set_great_dragon' => [
        ['name' => 'Great Dragon Helm',   'def' => '00000080-0007-0015-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Great Dragon Armor',  'def' => '00000080-0008-0015-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Great Dragon Pants',  'def' => '00000080-0009-0015-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Great Dragon Gloves', 'def' => '00000080-000a-0015-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Great Dragon Boots',  'def' => '00000080-000b-0015-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_dark_phoenix' => [
        ['name' => 'Dark Phoenix Helm',   'def' => '00000080-0007-0011-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Phoenix Armor',  'def' => '00000080-0008-0011-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Phoenix Pants',  'def' => '00000080-0009-0011-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Phoenix Gloves', 'def' => '00000080-000a-0011-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Phoenix Boots',  'def' => '00000080-000b-0011-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_dark_soul' => [
        ['name' => 'Dark Soul Helm',   'def' => '00000080-0007-0016-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Soul Armor',  'def' => '00000080-0008-0016-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Soul Pants',  'def' => '00000080-0009-0016-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Soul Gloves', 'def' => '00000080-000a-0016-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Soul Boots',  'def' => '00000080-000b-0016-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_grand_soul' => [
        ['name' => 'Grand Soul Helm',   'def' => '00000080-0007-0012-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Grand Soul Armor',  'def' => '00000080-0008-0012-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Grand Soul Pants',  'def' => '00000080-0009-0012-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Grand Soul Gloves', 'def' => '00000080-000a-0012-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Grand Soul Boots',  'def' => '00000080-000b-0012-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_red_spirit' => [
        ['name' => 'Red Spirit Helm',   'def' => '00000080-0007-0018-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Spirit Armor',  'def' => '00000080-0008-0018-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Spirit Pants',  'def' => '00000080-0009-0018-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Spirit Gloves', 'def' => '00000080-000a-0018-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Spirit Boots',  'def' => '00000080-000b-0018-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_hurricane' => [
        ['name' => 'Hurricane Armor',  'def' => '00000080-0008-0017-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Hurricane Pants',  'def' => '00000080-0009-0017-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Hurricane Gloves', 'def' => '00000080-000a-0017-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Hurricane Boots',  'def' => '00000080-000b-0017-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_dark_master' => [
        ['name' => 'Dark Master Helm',   'def' => '00000080-0007-001c-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Master Armor',  'def' => '00000080-0008-001c-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Master Pants',  'def' => '00000080-0009-001c-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Master Gloves', 'def' => '00000080-000a-001c-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dark Master Boots',  'def' => '00000080-000b-001c-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],

    // --- SETS SEASON 6 ---
    'set_dragon_knight' => [
        ['name' => 'Dragon Knight Helm',   'def' => '00000080-0007-001d-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dragon Knight Armor',  'def' => '00000080-0008-001d-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dragon Knight Pants',  'def' => '00000080-0009-001d-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dragon Knight Gloves', 'def' => '00000080-000a-001d-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Dragon Knight Boots',  'def' => '00000080-000b-001d-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_venom_mist' => [
        ['name' => 'Venom Mist Helm',   'def' => '00000080-0007-001e-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Venom Mist Armor',  'def' => '00000080-0008-001e-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Venom Mist Pants',  'def' => '00000080-0009-001e-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Venom Mist Gloves', 'def' => '00000080-000a-001e-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Venom Mist Boots',  'def' => '00000080-000b-001e-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_sylphid_ray' => [
        ['name' => 'Sylphid Ray Helm',   'def' => '00000080-0007-001f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Sylphid Ray Armor',  'def' => '00000080-0008-001f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Sylphid Ray Pants',  'def' => '00000080-0009-001f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Sylphid Ray Gloves', 'def' => '00000080-000a-001f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Sylphid Ray Boots',  'def' => '00000080-000b-001f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_volcano' => [
        ['name' => 'Volcano Armor',  'def' => '00000080-0008-0020-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Volcano Pants',  'def' => '00000080-0009-0020-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Volcano Gloves', 'def' => '00000080-000a-0020-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Volcano Boots',  'def' => '00000080-000b-0020-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_storm_crow' => [
        ['name' => 'Storm Crow Armor',  'def' => '00000080-0008-000f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Storm Crow Pants',  'def' => '00000080-0009-000f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Storm Crow Gloves', 'def' => '00000080-000a-000f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Storm Crow Boots',  'def' => '00000080-000b-000f-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_red_wing' => [
        ['name' => 'Red Wing Helm',   'def' => '00000080-0007-0028-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Wing Armor',  'def' => '00000080-0008-0028-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Wing Pants',  'def' => '00000080-0009-0028-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Wing Gloves', 'def' => '00000080-000a-0028-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Red Wing Boots',  'def' => '00000080-000b-0028-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],
    'set_phoenix_soul' => [
        ['name' => 'Phoenix Soul Helmet', 'def' => '00000080-0007-0049-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Phoenix Soul Armor',  'def' => '00000080-0008-0049-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Phoenix Soul Pants',  'def' => '00000080-0009-0049-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Phoenix Soul Boots',  'def' => '00000080-000b-0049-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
    ],

    // --- ARMAS ARCHANGEL ---
    'wpn_archangel_sword' => [
        ['name' => 'Divine Sword of Archangel +13 Full', 'def' => '00000080-0000-0013-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_archangel_staff' => [
        ['name' => 'Divine Staff of Archangel +13 Full', 'def' => '00000080-0005-000a-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_archangel_crossbow' => [
        ['name' => 'Divine Crossbow of Archangel +13 Full', 'def' => '00000080-0004-0012-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 3, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_archangel_scepter' => [
        ['name' => 'Divine Scepter of Archangel +13 Full', 'def' => '00000080-0002-000d-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],

    // --- ARMAS LENDÁRIAS ---
    'wpn_kundun_staff' => [
        ['name' => 'Staff of Kundun +13 Full', 'def' => '00000080-0005-000b-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_knight_blade' => [
        ['name' => 'Knight Blade +13 Full', 'def' => '00000080-0000-0014-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_daybreak' => [
        ['name' => 'Daybreak +13 Full', 'def' => '00000080-0000-0018-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_rune_bastard' => [
        ['name' => 'Rune Bastard Sword +13 Full', 'def' => '00000080-0000-001c-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_bone_blade' => [
        ['name' => 'Bone Blade +13 Full', 'def' => '00000080-0000-0016-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_imperial_sword' => [
        ['name' => 'Imperial Sword +13 Full', 'def' => '00000080-0000-001c-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_grand_viper' => [
        ['name' => 'Grand Viper Staff +13 Full', 'def' => '00000080-0005-000c-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_shining_scepter' => [
        ['name' => 'Shining Scepter +13 Full', 'def' => '00000080-0002-000f-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_albatross_bow' => [
        ['name' => 'Albatross Bow +13 Full', 'def' => '00000080-0004-0016-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wpn_dark_reign' => [
        ['name' => 'Dark Reign Blade +13 Full', 'def' => '00000080-0000-0015-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 4, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'shield_dragon' => [
        ['name' => 'Dragon Shield +13 Full', 'def' => '00000080-0006-000d-0000-000000000000', 'lvl' => 13, 'w' => 2, 'h' => 2, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true]
    ],

    // --- MONTARIAS & PETS ---
    'pet_fenrir_gold' => [
        ['name' => 'Horn of Fenrir Gold', 'def' => '00000080-000d-0025-0000-000000000000', 'lvl' => 0, 'w' => 2, 'h' => 2, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 0]
    ],
    'pet_fenrir_black' => [
        ['name' => 'Horn of Fenrir Black', 'def' => '00000080-000d-0025-0000-000000000000', 'lvl' => 0, 'w' => 2, 'h' => 2, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 0]
    ],
    'pet_fenrir_blue' => [
        ['name' => 'Horn of Fenrir Blue', 'def' => '00000080-000d-0025-0000-000000000000', 'lvl' => 0, 'w' => 2, 'h' => 2, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 0]
    ],
    'pet_fenrir_red' => [
        ['name' => 'Horn of Fenrir Red', 'def' => '00000080-000d-0025-0000-000000000000', 'lvl' => 0, 'w' => 2, 'h' => 2, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 0]
    ],
    'pet_dinorant' => [
        ['name' => 'Horn of Dinorant +15', 'def' => '00000080-000d-0003-0000-000000000000', 'lvl' => 15, 'w' => 1, 'h' => 1, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 0]
    ],
    'pet_dark_horse' => [
        ['name' => 'Dark Horse Lvl 50', 'def' => '00000080-000d-0004-0000-000000000000', 'lvl' => 50, 'w' => 1, 'h' => 1, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 0]
    ],
    'pet_dark_raven' => [
        ['name' => 'Dark Raven Lvl 50', 'def' => '00000080-000d-0005-0000-000000000000', 'lvl' => 50, 'w' => 1, 'h' => 1, 'skill' => true, 'dur' => 255, 'luck' => true, 'opt' => 0]
    ],

    // --- ASAS & CAPAS ---
    'wing_storm_lvl3' => [
        ['name' => 'Wing of Storm Lvl 3', 'def' => '00000080-000c-0024-0000-000000000000', 'lvl' => 13, 'w' => 3, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wing_spacetime_lvl3' => [
        ['name' => 'Wing of Eternal Lvl 3', 'def' => '00000080-000c-0025-0000-000000000000', 'lvl' => 13, 'w' => 3, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wing_illusion_lvl3' => [
        ['name' => 'Wing of Illusion Lvl 3', 'def' => '00000080-000c-0026-0000-000000000000', 'lvl' => 13, 'w' => 3, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wing_ruin_lvl3' => [
        ['name' => 'Wing of Ruin Lvl 3', 'def' => '00000080-000c-0027-0000-000000000000', 'lvl' => 13, 'w' => 3, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'cape_emperor_lvl3' => [
        ['name' => 'Cape of Emperor Lvl 3', 'def' => '00000080-000c-0028-0000-000000000000', 'lvl' => 13, 'w' => 3, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false]
    ],
    'wing_dragon_lvl2' => [
        ['name' => 'Dragon Wings Lvl 2', 'def' => '00000080-000c-0005-0000-000000000000', 'lvl' => 11, 'w' => 3, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 4, 'opt_def' => false]
    ],
    'wing_angel_lvl2' => [
        ['name' => 'Soul Wings Lvl 2', 'def' => '00000080-000c-0004-0000-000000000000', 'lvl' => 11, 'w' => 3, 'h' => 3, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 4, 'opt_def' => false]
    ],

    // --- JÓIAS & ACESSÓRIOS ---
    'kit_ancient_rings' => [
        ['name' => 'Ring of Ice +13',        'def' => '00000080-000d-0008-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Ring of Poison +13',     'def' => '00000080-000d-0009-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => true],
        ['name' => 'Pendant of Lighting +13','def' => '00000080-000d-000c-0000-000000000000', 'lvl' => 13, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 255, 'luck' => true, 'opt' => 7, 'opt_def' => false],
    ],
    'pack_bless_30' => [
        ['name' => 'Pack 30x Jewel of Bless', 'def' => '00000080-000c-001e-0000-000000000000', 'lvl' => 2, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 1, 'luck' => false, 'opt' => 0]
    ],
    'pack_soul_30' => [
        ['name' => 'Pack 30x Jewel of Soul', 'def' => '00000080-000c-001f-0000-000000000000', 'lvl' => 2, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 1, 'luck' => false, 'opt' => 0]
    ],
    'pack_life_30' => [
        ['name' => 'Pack 30x Jewel of Life', 'def' => '00000080-000c-0088-0000-000000000000', 'lvl' => 2, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 1, 'luck' => false, 'opt' => 0]
    ],
    'pack_chaos_30' => [
        ['name' => 'Pack 30x Jewel of Chaos', 'def' => '00000080-000c-008d-0000-000000000000', 'lvl' => 2, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 1, 'luck' => false, 'opt' => 0]
    ],
    'pack_harmony_30' => [
        ['name' => 'Pack 30x Jewel of Harmony', 'def' => '00000080-000c-008c-0000-000000000000', 'lvl' => 2, 'w' => 1, 'h' => 1, 'skill' => false, 'dur' => 1, 'luck' => false, 'opt' => 0]
    ],
];

// 3. Process Purchase POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_item_id'])) {
    if (!$is_logged) {
        $shop_feedback = "Você precisa estar conectado para realizar compras na loja!";
        $shop_feedback_type = "danger";
    } else {
        $item_id   = trim($_POST['buy_item_id']);
        $pay_type  = isset($_POST['pay_type']) ? trim($_POST['pay_type']) : 'wc'; // 'wc' or 'gp'

        $found_item = null;
        foreach ($catalog as $cat) {
            foreach ($cat['items'] as $it) {
                if ($it['id'] === $item_id) {
                    $found_item = $it;
                    break 2;
                }
            }
        }

        if (!$found_item) {
            $shop_feedback = "Item não encontrado no catálogo!";
            $shop_feedback_type = "danger";
        } else {
            $price = ($pay_type === 'gp') ? $found_item['price_gp'] : $found_item['price_wc'];
            $user_balance = ($pay_type === 'gp') ? $user_gp : $user_wcoinc;
            $coin_label = ($pay_type === 'gp') ? 'Goblin Points' : 'WCoins';

            if ($price <= 0) {
                $shop_feedback = "Método de pagamento inválido para este item!";
                $shop_feedback_type = "danger";
            } elseif ($user_balance < $price) {
                $shop_feedback = "Saldo insuficiente! Este item custa $price $coin_label, mas você possui apenas $user_balance $coin_label.";
                $shop_feedback_type = "warning";
            } else {
                // If it is a physical item, verify delivery items and vault capacity first
                $delivery_items = isset($catalog_delivery_items[$item_id]) ? $catalog_delivery_items[$item_id] : null;

                if ($found_item['type'] === 'item' && empty($delivery_items)) {
                    $shop_feedback = "Este item está temporariamente indisponível para entrega automática no baú.";
                    $shop_feedback_type = "warning";
                } elseif ($found_item['type'] === 'item' && empty($vault_id)) {
                    $shop_feedback = "Erro ao localizar o baú da sua conta. Por favor, logue no jogo pelo menos uma vez para ativar o baú.";
                    $shop_feedback_type = "danger";
                } else {
                    $vault_slots_assigned = [];

                    if ($found_item['type'] === 'item') {
                        // Build vault grid (8 cols x 15 rows = 120 slots)
                        $grid = array_fill(0, 15, array_fill(0, 8, false));
                        $q_v = @mssql_query("SELECT i.\"ItemSlot\", d.\"Width\", d.\"Height\" 
                            FROM data.\"Item\" i 
                            JOIN config.\"ItemDefinition\" d ON i.\"DefinitionId\" = d.\"Id\" 
                            WHERE i.\"ItemStorageId\" = '$vault_id'");
                        if ($q_v) {
                            while ($vr = @mssql_fetch_assoc($q_v)) {
                                $vs = (int)$vr['ItemSlot'];
                                $vw = max(1, (int)$vr['Width']);
                                $vh = max(1, (int)$vr['Height']);
                                $vr_row = (int)($vs / 8);
                                $vr_col = $vs % 8;
                                for ($r = 0; $r < $vh && ($vr_row + $r) < 15; $r++) {
                                    for ($c = 0; $c < $vw && ($vr_col + $c) < 8; $c++) {
                                        $grid[$vr_row + $r][$vr_col + $c] = true;
                                    }
                                }
                            }
                        }

                        // Check fit for each item in the package
                        $all_fit = true;
                        foreach ($delivery_items as $sub_item) {
                            $iw = max(1, (int)$sub_item['w']);
                            $ih = max(1, (int)$sub_item['h']);
                            $found_slot = -1;

                            for ($r = 0; $r <= (15 - $ih); $r++) {
                                for ($c = 0; $c <= (8 - $iw); $c++) {
                                    $fits = true;
                                    for ($dr = 0; $dr < $ih; $dr++) {
                                        for ($dc = 0; $dc < $iw; $dc++) {
                                            if ($grid[$r + $dr][$c + $dc]) {
                                                $fits = false;
                                                break 2;
                                            }
                                        }
                                    }
                                    if ($fits) {
                                        $found_slot = $r * 8 + $c;
                                        for ($dr = 0; $dr < $ih; $dr++) {
                                            for ($dc = 0; $dc < $iw; $dc++) {
                                                $grid[$r + $dr][$c + $dc] = true;
                                            }
                                        }
                                        break 2;
                                    }
                                }
                            }

                            if ($found_slot >= 0) {
                                $vault_slots_assigned[] = [
                                    'slot' => $found_slot,
                                    'item' => $sub_item
                                ];
                            } else {
                                $all_fit = false;
                                break;
                            }
                        }

                        if (!$all_fit) {
                            $shop_feedback = "Seu Baú (Vault) não possui espaço livre suficiente para receber este item! Libere espaço no seu baú dentro do jogo e tente novamente.";
                            $shop_feedback_type = "warning";
                            goto end_purchase_flow;
                        }
                    }

                    // Deduct currency
                    if ($pay_type === 'gp') {
                        @mssql_query("UPDATE data.\"Account\" SET \"GoblinPoints\" = \"GoblinPoints\" - $price WHERE \"Id\" = '$acc_id'");
                        $user_gp -= $price;
                    } else {
                        @mssql_query("UPDATE data.\"Account\" SET \"WCoinC\" = \"WCoinC\" - $price WHERE \"Id\" = '$acc_id'");
                        $user_wcoinc -= $price;
                    }

                    // If VIP, grant VIP status
                    if ($found_item['type'] === 'vip') {
                        $vlvl = (int)$found_item['vip_lvl'];
                        @mssql_query("UPDATE data.\"Account\" SET \"State\" = 0 WHERE \"Id\" = '$acc_id'");
                        @mssql_query("UPDATE public.\"MEMB_INFO\" 
                            SET \"AccountLevel\" = $vlvl,
                                \"vip\" = $vlvl,
                                \"AccountExpireDate\" = (NOW() + INTERVAL '30 days'),
                                \"dias_vip\" = (NOW() + INTERVAL '30 days')
                            WHERE LOWER(memb___id) = LOWER('$safe_login')");

                        $shop_feedback = "Parabéns! <strong>{$found_item['name']}</strong> adquirido com sucesso! Seus 30 dias de VIP já estão ativos.";
                        $shop_feedback_type = "success";
                    } else {
                        // Deliver all items into data."Item"
                        $delivered_count = 0;
                        foreach ($vault_slots_assigned as $assign) {
                            $slot_num = (int)$assign['slot'];
                            $it_sub   = $assign['item'];
                            $def_id   = $it_sub['def'];
                            $lvl      = isset($it_sub['lvl']) ? (int)$it_sub['lvl'] : 0;
                            $dur      = isset($it_sub['dur']) ? (int)$it_sub['dur'] : 255;
                            $skill    = !empty($it_sub['skill']) ? 'true' : 'false';

                            $item_uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                                mt_rand(0, 0xffff),
                                mt_rand(0, 0x0fff) | 0x4000,
                                mt_rand(0, 0x3fff) | 0x8000,
                                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
                            );

                            @mssql_query("INSERT INTO data.\"Item\" 
                                (\"Id\", \"ItemStorageId\", \"DefinitionId\", \"ItemSlot\", \"Durability\", \"Level\", \"HasSkill\", \"SocketCount\", \"StorePrice\", \"PetExperience\", \"StorePriceCoinType\") 
                                VALUES ('$item_uuid', '$vault_id', '$def_id', $slot_num, $dur, $lvl, $skill, 0, 0, 0, 0)");

                            // Luck Option Link
                            if (!empty($it_sub['luck'])) {
                                @mssql_query("INSERT INTO data.\"ItemOptionLink\" (\"Id\", \"ItemId\", \"ItemOptionId\", \"Level\", \"Index\") 
                                    VALUES (gen_random_uuid(), '$item_uuid', '00000088-0001-0000-0000-000000000000', 0, 0)");
                            }

                            // Option Link (+28 or +16)
                            if (isset($it_sub['opt']) && $it_sub['opt'] > 0) {
                                $opt_type_uuid = (!empty($it_sub['opt_def'])) ? '00000088-0002-0000-0000-000000000000' : '00000088-0003-0000-0000-000000000000';
                                $opt_lvl = (int)$it_sub['opt'];
                                @mssql_query("INSERT INTO data.\"ItemOptionLink\" (\"Id\", \"ItemId\", \"ItemOptionId\", \"Level\", \"Index\") 
                                    VALUES (gen_random_uuid(), '$item_uuid', '$opt_type_uuid', $opt_lvl, 0)");
                            }

                            $delivered_count++;
                        }

                        $shop_feedback = "Parabéns! <strong>{$found_item['name']}</strong> ($delivered_count item(s)) foi entregue diretamente no seu <strong>Baú (Vault)</strong>!<br><small style='color:#52e591;'><i class='fa fa-info-circle'></i> <strong>Atenção:</strong> Se o jogo estiver aberto, <strong>relogue o seu personagem</strong> para que o baú carregue os novos itens!</small>";
                        $shop_feedback_type = "success";
                    }
                }
                end_purchase_flow: ;
            }
        }
    }
}
?>

<style>
/* Modern 3D Item Showcase & Glowing Pedestals */
.shop-item-card {
    background: rgba(15,23,42,0.88);
    border: 1px solid rgba(212,175,55,0.3);
    border-radius: 10px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0,0,0,0.5);
    position: relative;
    overflow: hidden;
}
.shop-item-card:hover {
    border-color: rgba(212,175,55,0.85);
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(212,175,55,0.28), 0 0 25px rgba(0,0,0,0.85);
}
.item-3d-stage {
    position: relative;
    width: 100%;
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: radial-gradient(circle at 50% 65%, rgba(212,175,55,0.18) 0%, rgba(15,23,42,0.85) 65%, rgba(10,15,30,0.98) 100%);
    border: 1px solid rgba(212,175,55,0.28);
    border-radius: 8px;
    margin-bottom: 14px;
    overflow: hidden;
}
.item-3d-glow {
    position: absolute;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(212,175,55,0.28) 0%, transparent 70%);
    filter: blur(14px);
    animation: itemPulseGlow 3s ease-in-out infinite alternate;
}
.item-3d-pedestal {
    position: absolute;
    bottom: 10px;
    width: 120px;
    height: 28px;
    border-radius: 50%;
    background: radial-gradient(ellipse at center, rgba(212,175,55,0.4) 0%, rgba(212,175,55,0.1) 60%, transparent 80%);
    border: 1px solid rgba(212,175,55,0.55);
    box-shadow: 0 0 16px rgba(212,175,55,0.4), inset 0 0 8px rgba(212,175,55,0.3);
    transform: perspective(200px) rotateX(40deg);
}
.item-3d-render {
    max-height: 125px;
    max-width: 145px;
    object-fit: contain;
    z-index: 2;
    filter: drop-shadow(0 6px 14px rgba(0,0,0,0.9)) drop-shadow(0 0 10px rgba(212,175,55,0.38));
    transition: transform 0.35s ease, filter 0.35s ease;
    animation: itemHoverFloat 3.5s ease-in-out infinite;
}
.shop-item-card:hover .item-3d-render {
    transform: scale(1.1) translateY(-6px);
    filter: drop-shadow(0 12px 24px rgba(0,0,0,0.95)) drop-shadow(0 0 20px rgba(212,175,55,0.7));
}
.item-3d-fallback {
    z-index: 2;
    font-size: 50px;
    color: #ffd700;
    text-shadow: 0 0 20px rgba(212,175,55,0.7);
}
.item-tier-badge {
    position: absolute;
    top: 8px;
    right: 8px;
    background: rgba(15,23,42,0.92);
    border: 1px solid rgba(212,175,55,0.65);
    color: #ffd700;
    font-size: 10.5px;
    font-weight: 800;
    padding: 3px 8px;
    border-radius: 4px;
    z-index: 3;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.6);
}
.item-stars {
    color: #ffd700;
    font-size: 10px;
    margin-bottom: 5px;
    letter-spacing: 2px;
}
@keyframes itemHoverFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-6px) rotate(1deg); }
}
@keyframes itemPulseGlow {
    0% { opacity: 0.5; transform: scale(0.9); }
    100% { opacity: 1.0; transform: scale(1.15); }
}
</style>

<!-- FEEDBACK ALERTS -->
<?php if (!empty($shop_feedback)): ?>
<div class="alert alert-<?=$shop_feedback_type;?> alert-dismissible" role="alert" style="background: rgba(15,23,42,0.95); border-color: <?=$shop_feedback_type=='success'?'#52e591':($shop_feedback_type=='danger'?'#ef4444':'#f59e0b');?>; color:#fff; font-size:15px; margin-bottom:25px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:#fff;"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-<?=$shop_feedback_type=='success'?'check-circle':($shop_feedback_type=='danger'?'exclamation-circle':'info-circle');?>" style="font-size:18px; margin-right:8px; color:<?=$shop_feedback_type=='success'?'#52e591':($shop_feedback_type=='danger'?'#ef4444':'#f59e0b');?>;"></i>
    <?=$shop_feedback;?>
</div>
<?php endif; ?>

<!-- SHOP HEADER & BALANCE -->
<div class="shop-header-card" style="background: rgba(15,23,42,0.9); border: 1px solid rgba(212,175,55,0.4); border-radius: 8px; padding: 20px 25px; margin-bottom: 25px; box-shadow: 0 8px 30px rgba(0,0,0,0.5);">
    <div class="row" style="display:flex; align-items:center; flex-wrap:wrap;">
        <div class="col-md-5 col-sm-12" style="margin-bottom:15px;">
            <h3 class="font-cinzel text-gold" style="margin:0 0 5px 0; font-size:24px; font-weight:800;">
                <i class="fa fa-shopping-bag"></i> LOJA DE ITENS & VANTAGENS
            </h3>
            <p style="color:#94a3b8; font-size:13px; margin:0;">Sets Clássicos e Season 6, Armas do Archangel, Fenrirs, Asas e Jóias para seu personagem.</p>
        </div>

        <div class="col-md-4 col-sm-12" style="margin-bottom:15px;">
            <?php if ($is_logged): ?>
            <div style="display:flex; gap:12px;">
                <div style="flex:1; background:rgba(0,0,0,0.4); border:1px solid rgba(82,229,145,0.4); border-radius:6px; padding:8px 12px; text-align:center;">
                    <div style="font-size:11px; color:#94a3b8; text-transform:uppercase;">Seu Saldo WCoins</div>
                    <div style="font-size:20px; font-weight:800; color:#52e591;"><?=number_format($user_wcoinc, 0, ',', '.');?></div>
                </div>
                <div style="flex:1; background:rgba(0,0,0,0.4); border:1px solid rgba(56,189,248,0.4); border-radius:6px; padding:8px 12px; text-align:center;">
                    <div style="font-size:11px; color:#94a3b8; text-transform:uppercase;">Goblin Points</div>
                    <div style="font-size:20px; font-weight:800; color:#38bdf8;"><?=number_format($user_gp, 0, ',', '.');?></div>
                </div>
            </div>
            <?php else: ?>
            <div style="background:rgba(0,0,0,0.3); border:1px dashed rgba(212,175,55,0.4); border-radius:6px; padding:12px; text-align:center; color:#cbd5e1; font-size:13px;">
                <i class="fa fa-lock text-gold"></i> Faça login na sua conta para visualizar seu saldo e comprar itens.
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-3 col-sm-12 text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-nav-register btn-block" style="padding:12px; font-size:14px; font-weight:800;" data-toggle="modal" data-target="#donatePixModal">
                <i class="fa fa-qrcode"></i> RECARREGAR WCOINS (PIX)
            </button>
        </div>
    </div>
</div>

<!-- VAULT DELIVERY INFO NOTICE -->
<div class="shop-delivery-notice" style="background: rgba(14,24,42,0.85); border: 1px solid rgba(82,229,145,0.35); border-radius: 8px; padding: 14px 20px; margin-bottom: 25px; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
    <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(82,229,145,0.15); border: 1px solid #52e591; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #52e591; flex-shrink: 0;">
        <i class="fa fa-archive"></i>
    </div>
    <div style="flex: 1 1 300px;">
        <strong style="color: #fff; font-size: 14px;"><i class="fa fa-check-circle" style="color: #52e591;"></i> Entrega Automática Direto no seu Baú (Vault):</strong>
        <p style="color: #94a3b8; font-size: 12.5px; margin: 3px 0 0; line-height: 1.5;">
            Todos os itens comprados são inseridos instantaneamente no <strong>Baú</strong> da sua conta. Se você estiver conectado no jogo no momento da compra, basta <strong>relogar seu personagem</strong> (sair da conta e entrar de novo) para que o baú carregue os novos itens do servidor!
        </p>
    </div>
</div>

<!-- CATEGORY FILTER BUTTONS -->
<div class="shop-filter-bar" style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:30px;">
    <button type="button" class="btn btn-sm btn-shop-filter active" onclick="filterCategory('all', this)" style="background:rgba(212,175,55,0.25); border:1px solid rgba(212,175,55,0.7); color:#ffd700; font-weight:700; padding:8px 16px; border-radius:6px;">
        <i class="fa fa-th-large"></i> TODOS OS ITENS
    </button>
    <?php foreach ($catalog as $cat_key => $cat): ?>
    <button type="button" class="btn btn-sm btn-shop-filter" onclick="filterCategory('<?=$cat_key;?>', this)" style="background:rgba(15,23,42,0.8); border:1px solid rgba(255,255,255,0.15); color:#cbd5e1; font-weight:700; padding:8px 16px; border-radius:6px;">
        <i class="fa <?=$cat['icon'];?> text-gold"></i> <?=strtoupper($cat['title']);?> (<?=count($cat['items']);?>)
    </button>
    <?php endforeach; ?>
</div>

<!-- ALL ITEMS DISPLAYED BY SECTION -->
<?php foreach ($catalog as $cat_key => $cat): ?>
<div class="shop-category-section" id="section_<?=$cat_key;?>" style="margin-bottom:40px;">
    <div style="border-bottom:1px solid rgba(212,175,55,0.3); padding-bottom:10px; margin-bottom:20px; display:flex; justify-content:space-between; align-items:center;">
        <h4 class="font-cinzel text-gold" style="margin:0; font-size:20px; font-weight:800;">
            <i class="fa <?=$cat['icon'];?>" style="margin-right:8px;"></i> <?=$cat['title'];?>
        </h4>
        <span style="font-size:12px; color:#94a3b8;"><?=count($cat['items']);?> produtos</span>
    </div>

    <div class="row">
        <?php foreach ($cat['items'] as $item): ?>
        <div class="col-md-4 col-sm-6" style="margin-bottom:25px;">
            <div class="shop-item-card">
                <div>
                    <!-- 3D ITEM SHOWCASE STAGE -->
                    <div class="item-3d-stage">
                        <div class="item-3d-glow"></div>
                        <div class="item-3d-pedestal"></div>
                        <img src="img/items/<?=$item['id'];?>.png" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" class="item-3d-render" alt="<?=$item['name'];?>">
                        <div class="item-3d-fallback" style="display:none;">
                            <i class="fa <?=$item['icon_fa'];?>"></i>
                        </div>
                        <span class="item-tier-badge"><?=$item['badge'];?></span>
                    </div>

                    <div class="item-stars">
                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                    </div>

                    <h4 class="font-cinzel text-gold" style="margin:0 0 8px 0; font-size:17px; font-weight:800; min-height:42px; line-height:1.3;">
                        <?=$item['name'];?>
                    </h4>

                    <p style="color:#94a3b8; font-size:12px; margin-bottom:12px; line-height:1.4;">
                        <?=$item['desc'];?>
                    </p>

                    <!-- SPEC OPTIONS LIST -->
                    <?php if (!empty($item['options'])): ?>
                    <div style="background:rgba(0,0,0,0.35); border-radius:6px; padding:8px 12px; margin-bottom:12px; font-size:11px;">
                        <?php foreach ($item['options'] as $opt): ?>
                            <div style="color:#cbd5e1; margin-bottom:3px; display:flex; align-items:center;">
                                <i class="fa fa-check text-gold" style="margin-right:6px; font-size:10px;"></i>
                                <span><?=$opt;?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:12px; margin-top:8px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                        <span style="font-size:12px; color:#cbd5e1;">Valor:</span>
                        <div>
                            <?php if ($item['price_wc'] > 0): ?>
                                <span style="font-size:18px; font-weight:800; color:#52e591;"><?=number_format($item['price_wc'], 0, ',', '.');?> <small style="color:#52e591; font-size:11px;">WC</small></span>
                            <?php endif; ?>
                            <?php if ($item['price_gp'] > 0): ?>
                                <span style="font-size:14px; font-weight:700; color:#38bdf8; margin-left:6px;">/ <?=number_format($item['price_gp'], 0, ',', '.');?> <small style="color:#38bdf8; font-size:10px;">GP</small></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if ($is_logged): ?>
                    <form method="post" style="display:flex; gap:6px;">
                        <input type="hidden" name="buy_item_id" value="<?=$item['id'];?>">
                        <input type="hidden" name="pay_type" value="wc">
                        <button type="submit" class="btn btn-nav-register btn-block" style="padding:10px; font-weight:700;" onclick="return confirm('Confirmar a compra de <?=$item['name'];?> por <?=$item['price_wc'];?> WCoins?');">
                            <i class="fa fa-shopping-cart"></i> COMPRAR
                        </button>
                        <?php if ($item['price_gp'] > 0): ?>
                        <button type="submit" class="btn btn-default" name="pay_type" value="gp" title="Comprar com Goblin Points" style="background:rgba(56,189,248,0.15); border-color:rgba(56,189,248,0.4); color:#38bdf8; font-weight:700;" onclick="return confirm('Deseja comprar com <?=$item['price_gp'];?> Goblin Points?');">
                            GP
                        </button>
                        <?php endif; ?>
                    </form>
                    <?php else: ?>
                    <button type="button" class="btn btn-nav-login btn-block" data-toggle="modal" data-target="#loginModal" style="padding:10px; font-size:13px;">
                        <i class="fa fa-lock"></i> FAZER LOGIN PARA COMPRAR
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>

<!-- JAVASCRIPT CATEGORY FILTER -->
<script>
function filterCategory(cat, btn) {
    var buttons = document.querySelectorAll('.btn-shop-filter');
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].style.background = 'rgba(15,23,42,0.8)';
        buttons[i].style.borderColor = 'rgba(255,255,255,0.15)';
        buttons[i].style.color = '#cbd5e1';
    }
    btn.style.background = 'rgba(212,175,55,0.25)';
    btn.style.borderColor = 'rgba(212,175,55,0.7)';
    btn.style.color = '#ffd700';

    var sections = document.querySelectorAll('.shop-category-section');
    for (var j = 0; j < sections.length; j++) {
        if (cat === 'all') {
            sections[j].style.display = 'block';
        } else {
            if (sections[j].id === 'section_' + cat) {
                sections[j].style.display = 'block';
            } else {
                sections[j].style.display = 'none';
            }
        }
    }
}
</script>

<!-- MODAL DOAÇÃO PIX AUTOMÁTICO -->
<div class="modal fade" id="donatePixModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" style="background:#0f172a; border:1px solid rgba(212,175,55,0.6); color:#fff; box-shadow:0 0 35px rgba(212,175,55,0.3);">
            <div class="modal-header" style="border-bottom:1px solid rgba(212,175,55,0.3);">
                <button type="button" class="close" data-dismiss="modal" style="color:#fff;">&times;</button>
                <h4 class="modal-title font-cinzel text-gold"><i class="fa fa-qrcode"></i> ADQUIRIR WCOINS VIA PIX</h4>
            </div>
            <div class="modal-body" style="padding:25px;">
                <p style="color:#94a3b8; font-size:13px; margin-bottom:20px;">
                    O sistema de recarga via PIX é instantâneo e automatizado. Escolha o pacote desejado, realize a transferência e seus WCoins cairão direto na sua conta.
                </p>

                <div class="row" style="margin-bottom:20px;">
                    <div class="col-xs-6" style="margin-bottom:12px;">
                        <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:6px; padding:12px; text-align:center;">
                            <div style="font-size:11px; color:#94a3b8;">PACOTE BRONZE</div>
                            <div style="font-size:18px; font-weight:800; color:#52e591;">1.000 WCoins</div>
                            <div style="font-size:14px; font-weight:700; color:var(--gold); margin-top:4px;">R$ 10,00</div>
                        </div>
                    </div>
                    <div class="col-xs-6" style="margin-bottom:12px;">
                        <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(82,229,145,0.3); border-radius:6px; padding:12px; text-align:center;">
                            <div style="font-size:11px; color:#52e591;">+300 BÔNUS!</div>
                            <div style="font-size:18px; font-weight:800; color:#52e591;">2.800 WCoins</div>
                            <div style="font-size:14px; font-weight:700; color:var(--gold); margin-top:4px;">R$ 25,00</div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(212,175,55,0.5); border-radius:6px; padding:12px; text-align:center;">
                            <div style="font-size:11px; color:#ffd700;">+1.000 BÔNUS!</div>
                            <div style="font-size:18px; font-weight:800; color:#52e591;">6.000 WCoins</div>
                            <div style="font-size:14px; font-weight:700; color:var(--gold); margin-top:4px;">R$ 50,00</div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div style="background:rgba(255,255,255,0.04); border:1px solid rgba(56,189,248,0.5); border-radius:6px; padding:12px; text-align:center;">
                            <div style="font-size:11px; color:#38bdf8;">+3.000 BÔNUS!</div>
                            <div style="font-size:18px; font-weight:800; color:#52e591;">13.000 WCoins</div>
                            <div style="font-size:14px; font-weight:700; color:var(--gold); margin-top:4px;">R$ 100,00</div>
                        </div>
                    </div>
                </div>

                <div style="background:rgba(0,0,0,0.5); border:1px dashed rgba(212,175,55,0.5); border-radius:6px; padding:15px; text-align:center;">
                    <div style="font-size:12px; color:#94a3b8; margin-bottom:5px;">CHAVE PIX OFICIAL (E-MAIL):</div>
                    <code style="font-size:15px; color:#ffd700; background:rgba(0,0,0,0.4); padding:4px 8px; border-radius:4px; display:inline-block;">pix@mudravaryn.com.br</code>
                    <p style="font-size:11px; color:#64748b; margin-top:8px;">Envie o comprovante informando seu Login pelo WhatsApp ou Discord da administração para liberação imediata!</p>
                </div>
            </div>
            <div class="modal-footer" style="border-top:1px solid rgba(255,255,255,0.1);">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
