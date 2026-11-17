<?php
/**
 * MU Dravaryn - Official Modern WebShop (Loja de Itens do Jogo)
 * Direct database integration with OpenMU PostgreSQL
 */

if (!defined('DRAVARYN_PORTAL')) {
    header("Location: site.php?p=loja");
    exit();
}

$shop_feedback = '';
$shop_feedback_type = 'info';

// 1. Fetch user coin balance if logged in
$user_wcoinc = 0;
$user_gp = 0;
$acc_id = null;

if ($is_logged) {
    $safe_login = addslashes($user_login);
    $sql_coins = @mssql_query("SELECT a.\"Id\", COALESCE(a.\"WCoinC\", 0) as wcoinc, COALESCE(a.\"GoblinPoints\", 0) as gp 
        FROM data.\"Account\" a 
        WHERE LOWER(a.\"LoginName\") = LOWER('$safe_login')");
    $coin_data = ($sql_coins) ? @mssql_fetch_assoc($sql_coins) : null;
    if ($coin_data) {
        $acc_id      = $coin_data['Id'];
        $user_wcoinc = (int)$coin_data['wcoinc'];
        $user_gp     = (int)$coin_data['gp'];
    }
}

// 2. Item Catalog Definition
$catalog = [
    'vip' => [
        'title' => 'Planos VIP & Vantagens',
        'icon'  => 'fa-diamond',
        'items' => [
            [
                'id'       => 'vip_bronze',
                'name'     => 'Plano VIP Bronze (30 Dias)',
                'desc'     => '+30% EXP Geral • +10% Drop • Reset no Lv. 380 • Pontos: 400/reset',
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
                'desc'     => '+50% EXP Geral • +20% Drop • Reset no Lv. 350 • Pontos: 450/reset • Comandos Exclusivos',
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
                'desc'     => '+100% EXP Geral • +35% Drop • Reset no Lv. 300 • Pontos: 500/reset • Sala VIP Exclusiva',
                'price_wc' => 5000,
                'price_gp' => 0,
                'type'     => 'vip',
                'vip_lvl'  => 3,
                'icon_fa'  => 'fa-trophy',
                'badge'    => 'Máxima Vantagem'
            ],
        ]
    ],
    'wings' => [
        'title' => 'Asas & Capas (Level 2 e 3)',
        'icon'  => 'fa-feather-alt',
        'items' => [
            [
                'id'       => 'wing_storm_lvl3',
                'name'     => 'Wings of Storm Level 3 (+13)',
                'desc'     => 'Asa Level 3 para Blade Master • +13 + Sorte + Adicional + 2 Opções Excelentes',
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-bolt',
                'badge'    => 'BM Lvl 3'
            ],
            [
                'id'       => 'wing_spacetime_lvl3',
                'name'     => 'Wings of Space-Time Level 3 (+13)',
                'desc'     => 'Asa Level 3 para Grand Master • +13 + Sorte + Adicional + 2 Opções Excelentes',
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'GM Lvl 3'
            ],
            [
                'id'       => 'wing_illusion_lvl3',
                'name'     => 'Wings of Illusion Level 3 (+13)',
                'desc'     => 'Asa Level 3 para High Elf • +13 + Sorte + Adicional + 2 Opções Excelentes',
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-leaf',
                'badge'    => 'HE Lvl 3'
            ],
            [
                'id'       => 'cape_emperor_lvl3',
                'name'     => 'Cape of Emperor Level 3 (+13)',
                'desc'     => 'Capa Level 3 para Lord Emperor • +13 + Sorte + Adicional + Liderança Máxima',
                'price_wc' => 4500,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-crown',
                'badge'    => 'LE Lvl 3'
            ],
            [
                'id'       => 'wing_dragon_lvl2',
                'name'     => 'Dragon Wings Level 2 (+11)',
                'desc'     => 'Asa Level 2 para Blade Knight / Magic Gladiator • +11 + Sorte + Adicional',
                'price_wc' => 1500,
                'price_gp' => 2500,
                'type'     => 'item',
                'icon_fa'  => 'fa-fire',
                'badge'    => 'Lvl 2 Clássica'
            ],
            [
                'id'       => 'wing_angel_lvl2',
                'name'     => 'Soul Wings Level 2 (+11)',
                'desc'     => 'Asa Level 2 para Soul Master / Magic Gladiator • +11 + Sorte + Adicional',
                'price_wc' => 1500,
                'price_gp' => 2500,
                'type'     => 'item',
                'icon_fa'  => 'fa-tint',
                'badge'    => 'Lvl 2 Clássica'
            ]
        ]
    ],
    'weapons' => [
        'title' => 'Armas Lendárias (+13)',
        'icon'  => 'fa-crosshairs',
        'items' => [
            [
                'id'       => 'wpn_bone_blade',
                'name'     => 'Bone Blade +13 Full',
                'desc'     => 'Espada de uma mão para Blade Master • Taxa de Ataque + Sorte + Dano Crítico',
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-shield',
                'badge'    => 'BM Top'
            ],
            [
                'id'       => 'wpn_grand_viper',
                'name'     => 'Grand Viper Staff +13 Full',
                'desc'     => 'Cajado supremo de duas mãos para Grand Master • Poder Mágico Transcendental',
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-magic',
                'badge'    => 'GM Top'
            ],
            [
                'id'       => 'wpn_shining_scepter',
                'name'     => 'Shining Scepter +13 Full',
                'desc'     => 'Cetro de comando divino para Lord Emperor • Bônus de Dano e Pet Dano',
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-gavel',
                'badge'    => 'LE Top'
            ],
            [
                'id'       => 'wpn_albatross_bow',
                'name'     => 'Albatross Bow +13 Full',
                'desc'     => 'Arco de precisão lendário para High Elf • Velocidade e Dano Máximo',
                'price_wc' => 3800,
                'price_gp' => 0,
                'type'     => 'item',
                'icon_fa'  => 'fa-crosshairs',
                'badge'    => 'HE Top'
            ]
        ]
    ],
    'jewels' => [
        'title' => 'Pacotes de Jóias',
        'icon'  => 'fa-gem',
        'items' => [
            [
                'id'       => 'pack_bless_30',
                'name'     => 'Pack 30x Jewel of Bless',
                'desc'     => 'Pacote com 30 Jóias da Benção para aprimorar seus equipamentos até +6.',
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
                'price_wc' => 400,
                'price_gp' => 600,
                'type'     => 'item',
                'icon_fa'  => 'fa-heart',
                'badge'    => 'Opção Extra'
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
                'price_wc' => 200,
                'price_gp' => 300,
                'type'     => 'item',
                'icon_fa'  => 'fa-glass',
                'badge'    => 'Buff PvP'
            ]
        ]
    ]
];

// 3. Process Purchase POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy_item_id'])) {
    if (!$is_logged) {
        $shop_feedback = "Você precisa estar conectado para realizar compras na loja!";
        $shop_feedback_type = "danger";
    } else {
        $item_id   = trim($_POST['buy_item_id']);
        $pay_type  = isset($_POST['pay_type']) ? trim($_POST['pay_type']) : 'wc'; // 'wc' or 'gp'

        // Locate item in catalog
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
                    $shop_feedback = "Compra realizada com sucesso! <strong>{$found_item['name']}</strong> foi adquirido e entregue na sua conta!";
                    $shop_feedback_type = "success";
                }
            }
        }
    }
}
?>

<!-- FEEDBACK ALERTS -->
<?php if (!empty($shop_feedback)): ?>
<div class="alert alert-<?=$shop_feedback_type;?> alert-dismissible" role="alert" style="background: rgba(15,23,42,0.95); border-color: <?=$shop_feedback_type=='success'?'#52e591':($shop_feedback_type=='danger'?'#ef4444':'#f59e0b');?>; color:#fff; font-size:15px; margin-bottom:25px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="color:#fff;"><span aria-hidden="true">&times;</span></button>
    <i class="fa fa-<?=$shop_feedback_type=='success'?'check-circle':($shop_feedback_type=='danger'?'exclamation-circle':'info-circle');?>" style="font-size:18px; margin-right:8px; color:<?=$shop_feedback_type=='success'?'#52e591':($shop_feedback_type=='danger'?'#ef4444':'#f59e0b');?>;"></i>
    <?=$shop_feedback;?>
</div>
<?php endif; ?>

<!-- SHOP WALLET HUD -->
<div class="shop-wallet-hud" style="background: linear-gradient(135deg, rgba(16,24,40,0.9) 0%, rgba(20,29,51,0.9) 100%); border: 1px solid rgba(212,175,55,0.4); border-radius: 10px; padding: 25px; margin-bottom: 30px; box-shadow: 0 8px 32px rgba(0,0,0,0.5);">
    <div class="row" style="display:flex; flex-wrap:wrap; align-items:center;">
        <div class="col-md-5 col-sm-12" style="margin-bottom:15px;">
            <h3 class="font-cinzel text-gold" style="margin:0 0 5px 0; font-size:24px; font-weight:800;">
                <i class="fa fa-shopping-bag"></i> LOJA DE ITENS & VANTAGENS
            </h3>
            <p style="color:#94a3b8; font-size:13px; margin:0;">Adquira planos VIP, pacotes de jóias, asas e armamentos exclusivos para sua jornada.</p>
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
                <i class="fa fa-lock text-gold"></i> Faça login para visualizar seu saldo e comprar itens.
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-3 col-sm-12 text-right" style="margin-bottom:15px;">
            <button type="button" class="btn btn-nav-register btn-block" style="padding:12px; font-size:14px; font-weight:800;" data-toggle="modal" data-target="#donatePixModal">
                <i class="fa fa-qrcode"></i> ADQUIRIR WCOINS (PIX)
            </button>
        </div>
    </div>
</div>

<!-- CATEGORY TABS -->
<ul class="nav nav-tabs shop-tabs" style="border-bottom: 1px solid rgba(212,175,55,0.3); margin-bottom: 25px;">
    <?php 
    $first_cat = true;
    foreach ($catalog as $cat_key => $cat): 
    ?>
    <li class="<?=$first_cat?'active':'';?>" style="margin-bottom:-1px;">
        <a href="#cat_<?=$cat_key;?>" data-toggle="tab" style="background:<?=$first_cat?'rgba(212,175,55,0.15)':'transparent';?>; border-color:<?=$first_cat?'rgba(212,175,55,0.5)':'transparent';?>; color:#ffd700; font-family:'Cinzel', serif; font-weight:700; font-size:14px; padding:12px 18px;">
            <i class="fa <?=$cat['icon'];?>" style="margin-right:6px;"></i> <?=$cat['title'];?>
        </a>
    </li>
    <?php 
    $first_cat = false;
    endforeach; 
    ?>
</ul>

<!-- TAB CONTENT -->
<div class="tab-content">
    <?php 
    $first_cat_content = true;
    foreach ($catalog as $cat_key => $cat): 
    ?>
    <div class="tab-pane fade in <?=$first_cat_content?'active':'';?>" id="cat_<?=$cat_key;?>">
        <div class="row">
            <?php foreach ($cat['items'] as $item): ?>
            <div class="col-md-4 col-sm-6" style="margin-bottom:25px;">
                <div class="shop-item-card" style="background: rgba(15,23,42,0.85); border: 1px solid rgba(212,175,55,0.3); border-radius: 8px; padding: 20px; display:flex; flex-direction:column; justify-content:space-between; height:100%; transition: all 0.2s; box-shadow: 0 4px 20px rgba(0,0,0,0.4);">
                    <div>
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                            <span class="badge" style="background:rgba(212,175,55,0.2); border:1px solid rgba(212,175,55,0.4); color:#ffd700; font-size:11px; padding:4px 8px;">
                                <?=$item['badge'];?>
                            </span>
                            <i class="fa <?=$item['icon_fa'];?> text-gold" style="font-size:22px;"></i>
                        </div>
                        <h4 class="font-cinzel text-gold" style="margin:0 0 8px 0; font-size:17px; font-weight:800; min-height:42px; line-height:1.3;">
                            <?=$item['name'];?>
                        </h4>
                        <p style="color:#94a3b8; font-size:12px; margin-bottom:20px; line-height:1.5; min-height:45px;">
                            <?=$item['desc'];?>
                        </p>
                    </div>

                    <div style="border-top:1px solid rgba(255,255,255,0.08); padding-top:15px;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                            <span style="font-size:12px; color:#cbd5e1;">Preço:</span>
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
                            <button type="submit" class="btn btn-nav-register btn-block" style="padding:10px; font-weight:700;" onclick="return confirm('Deseja comprar <?=$item['name'];?> por <?=$item['price_wc'];?> WCoins?');">
                                <i class="fa fa-cart-plus"></i> COMPRAR
                            </button>
                            <?php if ($item['price_gp'] > 0): ?>
                            <button type="submit" class="btn btn-default" name="pay_type" value="gp" title="Comprar com Goblin Points" style="background:rgba(56,189,248,0.15); border-color:rgba(56,189,248,0.4); color:#38bdf8; font-weight:700;" onclick="return confirm('Deseja comprar com <?=$item['price_gp'];?> Goblin Points?');">
                                GP
                            </button>
                            <?php endif; ?>
                        </form>
                        <?php else: ?>
                        <button type="button" class="btn btn-nav-login btn-block" data-toggle="modal" data-target="#loginModal" style="padding:10px; font-size:13px;">
                            <i class="fa fa-lock"></i> ENTRAR PARA COMPRAR
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php 
    $first_cat_content = false;
    endforeach; 
    ?>
</div>

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
