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
    'sets' => [
        'title' => 'Sets de Armadura (+13 Full)',
        'icon' => 'fa-shield',
        'items' => [
            [
                'id' => 'set_bronze',
                'name' => 'Set Bronze (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_dragon',
                'name' => 'Set Dragon (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_pad',
                'name' => 'Set Pad (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_legendary',
                'name' => 'Set Legendary (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_bone',
                'name' => 'Set Bone (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_leather',
                'name' => 'Set Leather (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_scale',
                'name' => 'Set Scale (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_sphinx',
                'name' => 'Set Sphinx (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_brass',
                'name' => 'Set Brass (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_plate',
                'name' => 'Set Plate (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_vine',
                'name' => 'Set Vine (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_silk',
                'name' => 'Set Silk (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_wind',
                'name' => 'Set Wind (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_spirit',
                'name' => 'Set Spirit (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_guardian',
                'name' => 'Set Guardian (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_storm_crow',
                'name' => 'Set Storm Crow (+13 Full)',
                'desc' => 'Set Completo para Magic Gladiator • Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'MG',
                'class_filter' => 'mg',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_black_dragon',
                'name' => 'Set Black Dragon (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_dark_phoenix',
                'name' => 'Set Dark Phoenix (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_grand_soul',
                'name' => 'Set Grand Soul (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_divine',
                'name' => 'Set Divine (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_thunder_hawk',
                'name' => 'Set Thunder Hawk (+13 Full)',
                'desc' => 'Set Completo para Magic Gladiator • Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'MG',
                'class_filter' => 'mg',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_great_dragon',
                'name' => 'Set Great Dragon (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_dark_soul',
                'name' => 'Set Dark Soul (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_hurricane',
                'name' => 'Set Hurricane (+13 Full)',
                'desc' => 'Set Completo para Magic Gladiator • Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'MG',
                'class_filter' => 'mg',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_red_spirit',
                'name' => 'Set Red Spirit (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_light_plate',
                'name' => 'Set Light Plate (+13 Full)',
                'desc' => 'Set Completo para Dark Lord • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'DL',
                'class_filter' => 'dl',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_adamantine',
                'name' => 'Set Adamantine (+13 Full)',
                'desc' => 'Set Completo para Dark Lord • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'DL',
                'class_filter' => 'dl',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_dark_steel',
                'name' => 'Set Dark Steel (+13 Full)',
                'desc' => 'Set Completo para Dark Lord • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'DL',
                'class_filter' => 'dl',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_dark_master',
                'name' => 'Set Dark Master (+13 Full)',
                'desc' => 'Set Completo para Dark Lord • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'DL',
                'class_filter' => 'dl',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_dragon_knight',
                'name' => 'Set Dragon Knight (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_venom_mist',
                'name' => 'Set Venom Mist (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_sylphid_ray',
                'name' => 'Set Sylphid Ray (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_volcano',
                'name' => 'Set Volcano (+13 Full)',
                'desc' => 'Set Completo para Magic Gladiator • Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'MG',
                'class_filter' => 'mg',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_sunlight',
                'name' => 'Set Sunlight (+13 Full)',
                'desc' => 'Set Completo para Dark Lord • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'DL',
                'class_filter' => 'dl',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_ashcrow',
                'name' => 'Set Ashcrow (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_eclipse',
                'name' => 'Set Eclipse (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_iris',
                'name' => 'Set Iris (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_valiant',
                'name' => 'Set Valiant (+13 Full)',
                'desc' => 'Set Completo para Magic Gladiator • Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'MG',
                'class_filter' => 'mg',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_glorious',
                'name' => 'Set Glorious (+13 Full)',
                'desc' => 'Set Completo para Dark Lord • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'DL',
                'class_filter' => 'dl',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_mistery',
                'name' => 'Set Mistery (+13 Full)',
                'desc' => 'Set Completo para Summoner • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SUM',
                'class_filter' => 'sum',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_red_wing',
                'name' => 'Set Red Wing (+13 Full)',
                'desc' => 'Set Completo para Summoner • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SUM',
                'class_filter' => 'sum',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_ancient',
                'name' => 'Set Ancient (+13 Full)',
                'desc' => 'Set Completo para Summoner • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SUM',
                'class_filter' => 'sum',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_black_rose',
                'name' => 'Set Black Rose (+13 Full)',
                'desc' => 'Set Completo para Summoner • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SUM',
                'class_filter' => 'sum',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_aura',
                'name' => 'Set Aura (+13 Full)',
                'desc' => 'Set Completo para Summoner • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SUM',
                'class_filter' => 'sum',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_lilium',
                'name' => 'Set Lilium (+13 Full)',
                'desc' => 'Set Completo para Summoner • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SUM',
                'class_filter' => 'sum',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_titan',
                'name' => 'Set Titan (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_brave',
                'name' => 'Set Brave (+13 Full)',
                'desc' => 'Set Completo para Blade Knight • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'BK',
                'class_filter' => 'bk',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_destroy',
                'name' => 'Set Destroy (+13 Full)',
                'desc' => 'Set Completo para Magic Gladiator • Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'MG',
                'class_filter' => 'mg',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_phantom',
                'name' => 'Set Phantom (+13 Full)',
                'desc' => 'Set Completo para Magic Gladiator • Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'MG',
                'class_filter' => 'mg',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_seraphim',
                'name' => 'Set Seraphim (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_faith',
                'name' => 'Set Faith (+13 Full)',
                'desc' => 'Set Completo para Muse Elf • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'ELF',
                'class_filter' => 'elf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_paewang',
                'name' => 'Set Paewang (+13 Full)',
                'desc' => 'Set Completo para Dark Lord • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'DL',
                'class_filter' => 'dl',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_hades',
                'name' => 'Set Hades (+13 Full)',
                'desc' => 'Set Completo para Soul Master • Helm, Armor, Pants, Gloves, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'SM',
                'class_filter' => 'sm',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_sacred',
                'name' => 'Set Sacred (+13 Full)',
                'desc' => 'Set Completo para Rage Fighter • Helm, Armor, Pants, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'RF',
                'class_filter' => 'rf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_storm_hard',
                'name' => 'Set Storm Hard (+13 Full)',
                'desc' => 'Set Completo para Rage Fighter • Helm, Armor, Pants, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'RF',
                'class_filter' => 'rf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_piercing',
                'name' => 'Set Piercing (+13 Full)',
                'desc' => 'Set Completo para Rage Fighter • Helm, Armor, Pants, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'RF',
                'class_filter' => 'rf',
                'subcat' => 'sets'
            ],
            [
                'id' => 'set_phoenix_soul',
                'name' => 'Set Phoenix Soul (+13 Full)',
                'desc' => 'Set Completo para Rage Fighter • Helm, Armor, Pants, Boots.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional de Defesa +28', 'Taxa de Sucesso de Defesa +10%', 'Diminuição de Dano 4%', 'Reflete Dano 5%'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'RF',
                'class_filter' => 'rf',
                'subcat' => 'sets'
            ]
        ]
    ],
    'weapons' => [
        'title' => 'Armas & Escudos (+13 Full)',
        'icon' => 'fa-crosshairs',
        'items' => [
            [
                'id' => 'wpn_kris',
                'name' => 'Kris +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_short_sword',
                'name' => 'Short Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_rapier',
                'name' => 'Rapier +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_sword_of_assassin',
                'name' => 'Sword of Assassin +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_blade',
                'name' => 'Blade +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_gladius',
                'name' => 'Gladius +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_falchion',
                'name' => 'Falchion +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_serpent_sword',
                'name' => 'Serpent Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_sword_of_salamander',
                'name' => 'Sword of Salamander +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_light_saber',
                'name' => 'Light Saber +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_legendary_sword',
                'name' => 'Legendary Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_heliacal_sword',
                'name' => 'Heliacal Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_double_blade',
                'name' => 'Double Blade +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_lighting_sword',
                'name' => 'Lighting Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_giant_sword',
                'name' => 'Giant Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_sword_of_destruction',
                'name' => 'Sword of Destruction +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_dark_breaker',
                'name' => 'Dark Breaker +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_thunder_blade',
                'name' => 'Thunder Blade +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_divine_sword_of_archangel',
                'name' => 'Divine Sword of Archangel +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_knight_blade',
                'name' => 'Knight Blade +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_dark_reign_blade',
                'name' => 'Dark Reign Blade +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_bone_blade',
                'name' => 'Bone Blade +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_daybreak',
                'name' => 'Daybreak +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_sword_dancer',
                'name' => 'Imperial Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_rune_blade',
                'name' => 'Rune Bastard Sword +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'sword'
            ],
            [
                'id' => 'wpn_crescent_axe',
                'name' => 'Chaos Dragon Axe +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'axe'
            ],
            [
                'id' => 'wpn_battle_scepter',
                'name' => 'Crystal Morning Star +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Espada',
                'class_filter' => 'all',
                'subcat' => 'mace'
            ],
            [
                'id' => 'wpn_great_lord_scepter',
                'name' => 'Great Lord Scepter +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cetro',
                'class_filter' => 'all',
                'subcat' => 'scepter'
            ],
            [
                'id' => 'wpn_divine_scepter_of_archangel',
                'name' => 'Divine Scepter of Archangel +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cetro',
                'class_filter' => 'all',
                'subcat' => 'scepter'
            ],
            [
                'id' => 'wpn_soleil_scepter',
                'name' => 'Soleil Scepter +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cetro',
                'class_filter' => 'all',
                'subcat' => 'scepter'
            ],
            [
                'id' => 'wpn_shining_scepter',
                'name' => 'Shining Scepter +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cetro',
                'class_filter' => 'all',
                'subcat' => 'scepter'
            ],
            [
                'id' => 'wpn_battle_bow',
                'name' => 'Elven Bow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_tiger_bow',
                'name' => 'Battle Bow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_silver_bow',
                'name' => 'Tiger Bow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_chaos_nature_bow',
                'name' => 'Silver Bow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_bolt',
                'name' => 'Chaos Nature Bow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_crossbow',
                'name' => 'Celestial Bow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_golden_crossbow',
                'name' => 'Aquagold Crossbow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_saint_crossbow',
                'name' => 'Saint Crossbow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_divine_crossbow_of_archangel',
                'name' => 'Divine Crossbow of Archangel +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_arrow_viper_bow',
                'name' => 'Albatross Bow +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Arco',
                'class_filter' => 'all',
                'subcat' => 'bow'
            ],
            [
                'id' => 'wpn_skull_staff',
                'name' => 'Skull Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_angelic_staff',
                'name' => 'Angelic Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_serpent_staff',
                'name' => 'Serpent Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_thunder_staff',
                'name' => 'Thunder Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_gorgon_staff',
                'name' => 'Gorgon Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_legendary_staff',
                'name' => 'Legendary Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_staff_of_resurrection',
                'name' => 'Resurrection Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_chaos_lightning_staff',
                'name' => 'Chaos Lightning Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_staff_of_destruction',
                'name' => 'Platina Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_dragon_soul_staff',
                'name' => 'Staff of Kundun +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_divine_staff_of_archangel',
                'name' => 'Divine Staff of Archangel +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_staff_of_kundun',
                'name' => 'Grand Viper Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_grand_viper_staff',
                'name' => 'Imperial Staff +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-crosshairs',
                'badge' => 'Cajado',
                'class_filter' => 'all',
                'subcat' => 'staff'
            ],
            [
                'id' => 'wpn_small_shield',
                'name' => 'Small Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_horn_shield',
                'name' => 'Horn Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_kite_shield',
                'name' => 'Kite Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_elven_shield',
                'name' => 'Skull Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 1800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_buckler',
                'name' => 'Spiked Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_dragon_slayer_shield',
                'name' => 'Tower Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_skull_shield',
                'name' => 'Plate Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_spiked_shield',
                'name' => 'Buckler +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_tower_shield',
                'name' => 'Serpent Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_plate_shield',
                'name' => 'Bronze Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 2800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_big_round_shield',
                'name' => 'Dragon Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_serpent_shield',
                'name' => 'Legendary Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 3500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_bronze_shield',
                'name' => 'Grand Soul Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_elemental_shield',
                'name' => 'Crimson Glory Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ],
            [
                'id' => 'wpn_crimson_glory',
                'name' => 'Salamander Shield +13 Full',
                'desc' => 'Arma / Escudo Sagrado • Ataque/Defesa Extrema +13 com todas as opções excelentes e Sorte.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +28', 'Dano Excelente +10%', 'Aumento de Dano +2%', 'Velocidade de Ataque +7'],
                'price_wc' => 4500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-shield',
                'badge' => 'Escudo',
                'class_filter' => 'all',
                'subcat' => 'shield'
            ]
        ]
    ],
    'wings' => [
        'title' => 'Asas & Capas (+13 Full)',
        'icon' => 'fa-feather',
        'items' => [
            [
                'id' => 'wing_wings_of_elf',
                'name' => 'Wings of Elf (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 1 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 20%', 'Aumento de Dano 20%'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 1',
                'class_filter' => 'all',
                'subcat' => 'lvl1'
            ],
            [
                'id' => 'wing_wings_of_heaven',
                'name' => 'Wings of Heaven (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 1 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 20%', 'Aumento de Dano 20%'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 1',
                'class_filter' => 'all',
                'subcat' => 'lvl1'
            ],
            [
                'id' => 'wing_wings_of_satan',
                'name' => 'Wings of Satan (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 1 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 20%', 'Aumento de Dano 20%'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 1',
                'class_filter' => 'all',
                'subcat' => 'lvl1'
            ],
            [
                'id' => 'wing_wings_of_curse',
                'name' => 'Wings of Curse (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 1 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 20%', 'Aumento de Dano 20%'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 1',
                'class_filter' => 'all',
                'subcat' => 'lvl1'
            ],
            [
                'id' => 'wing_wings_of_spirits',
                'name' => 'Wings of Spirits (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 2 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 32%', 'Aumento de Dano 32%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 2',
                'class_filter' => 'all',
                'subcat' => 'lvl2'
            ],
            [
                'id' => 'wing_wings_of_soul',
                'name' => 'Wings of Soul (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 2 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 32%', 'Aumento de Dano 32%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 2',
                'class_filter' => 'all',
                'subcat' => 'lvl2'
            ],
            [
                'id' => 'wing_wings_of_dragon',
                'name' => 'Wings of Dragon (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 2 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 32%', 'Aumento de Dano 32%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 2',
                'class_filter' => 'all',
                'subcat' => 'lvl2'
            ],
            [
                'id' => 'wing_wings_of_darkness',
                'name' => 'Wings of Darkness (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 2 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 32%', 'Aumento de Dano 32%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 2',
                'class_filter' => 'all',
                'subcat' => 'lvl2'
            ],
            [
                'id' => 'wing_wings_of_despair',
                'name' => 'Wings of Despair (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 2 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 32%', 'Aumento de Dano 32%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 2',
                'class_filter' => 'all',
                'subcat' => 'lvl2'
            ],
            [
                'id' => 'wing_cape_of_fighter',
                'name' => 'Cape of Fighter (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 2 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 32%', 'Aumento de Dano 32%'],
                'price_wc' => 2000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 2',
                'class_filter' => 'all',
                'subcat' => 'lvl2'
            ],
            [
                'id' => 'wing_wing_of_storm',
                'name' => 'Wing of Storm (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 3 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 45%', 'Aumento de Dano 45%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 3',
                'class_filter' => 'all',
                'subcat' => 'lvl3'
            ],
            [
                'id' => 'wing_wing_of_eternal',
                'name' => 'Wing of Eternal (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 3 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 45%', 'Aumento de Dano 45%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 3',
                'class_filter' => 'all',
                'subcat' => 'lvl3'
            ],
            [
                'id' => 'wing_wing_of_illusion',
                'name' => 'Wing of Illusion (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 3 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 45%', 'Aumento de Dano 45%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 3',
                'class_filter' => 'all',
                'subcat' => 'lvl3'
            ],
            [
                'id' => 'wing_wing_of_ruin',
                'name' => 'Wing of Ruin (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 3 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 45%', 'Aumento de Dano 45%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 3',
                'class_filter' => 'all',
                'subcat' => 'lvl3'
            ],
            [
                'id' => 'wing_cape_of_emperor',
                'name' => 'Cape of Emperor (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 3 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 45%', 'Aumento de Dano 45%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 3',
                'class_filter' => 'all',
                'subcat' => 'lvl3'
            ],
            [
                'id' => 'wing_wing_of_dimension',
                'name' => 'Wing of Dimension (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 3 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 45%', 'Aumento de Dano 45%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 3',
                'class_filter' => 'all',
                'subcat' => 'lvl3'
            ],
            [
                'id' => 'wing_cape_of_overrule',
                'name' => 'Cape of Overrule (+13 Full)',
                'desc' => 'Asa / Capa Lendária Level 3 • Amplificação massiva de dano e absorção extrema.',
                'options' => ['+13 + Sorte (Luck)', 'Adicional +16 / +28', 'Absorção de Dano 45%', 'Aumento de Dano 45%'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-feather',
                'badge' => 'Asa Lv 3',
                'class_filter' => 'all',
                'subcat' => 'lvl3'
            ]
        ]
    ],
    'accessories' => [
        'title' => 'Acessórios & Kits Ancient',
        'icon' => 'fa-circle-o',
        'items' => [
            [
                'id' => 'kit_ancient_rings',
                'name' => 'Kit Completo Acessórios Ancient (+13 Full)',
                'desc' => 'Kit Triplo Sagrado: Ring of Ice + Ring of Poison + Pendant of Lighting Full +13.',
                'options' => ['3 Acessórios Sagrados', 'Absorção Máxima de Dano + Vida', 'Resistência a Gelo, Veneno e Raio', 'Recuperação Automática de HP'],
                'price_wc' => 2800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Kit 3x Ancient',
                'class_filter' => 'all',
                'subcat' => 'kit'
            ],
            [
                'id' => 'acc_ring_of_ice',
                'name' => 'Ring of Ice (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Anel',
                'class_filter' => 'all',
                'subcat' => 'ring'
            ],
            [
                'id' => 'acc_ring_of_poison',
                'name' => 'Ring of Poison (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Anel',
                'class_filter' => 'all',
                'subcat' => 'ring'
            ],
            [
                'id' => 'acc_wizard_s_ring',
                'name' => 'Wizard\'s Ring Special',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Anel',
                'class_filter' => 'all',
                'subcat' => 'ring'
            ],
            [
                'id' => 'acc_ring_of_fire',
                'name' => 'Ring of Fire (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Anel',
                'class_filter' => 'all',
                'subcat' => 'ring'
            ],
            [
                'id' => 'acc_ring_of_earth',
                'name' => 'Ring of Earth (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Anel',
                'class_filter' => 'all',
                'subcat' => 'ring'
            ],
            [
                'id' => 'acc_ring_of_wind',
                'name' => 'Ring of Wind (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Anel',
                'class_filter' => 'all',
                'subcat' => 'ring'
            ],
            [
                'id' => 'acc_ring_of_magic',
                'name' => 'Ring of Magic (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Anel',
                'class_filter' => 'all',
                'subcat' => 'ring'
            ],
            [
                'id' => 'acc_pendant_of_lighting',
                'name' => 'Pendant of Lighting (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Pendente',
                'class_filter' => 'all',
                'subcat' => 'pendant'
            ],
            [
                'id' => 'acc_pendant_of_fire',
                'name' => 'Pendant of Fire (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Pendente',
                'class_filter' => 'all',
                'subcat' => 'pendant'
            ],
            [
                'id' => 'acc_pendant_of_ice',
                'name' => 'Pendant of Ice (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Pendente',
                'class_filter' => 'all',
                'subcat' => 'pendant'
            ],
            [
                'id' => 'acc_pendant_of_wind',
                'name' => 'Pendant of Wind (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Pendente',
                'class_filter' => 'all',
                'subcat' => 'pendant'
            ],
            [
                'id' => 'acc_pendant_of_water',
                'name' => 'Pendant of Water (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Pendente',
                'class_filter' => 'all',
                'subcat' => 'pendant'
            ],
            [
                'id' => 'acc_pendant_of_ability',
                'name' => 'Pendant of Ability (+13 Full)',
                'desc' => 'Acessório Sagrado +13 • Resistência elemental e amplificação de defesa/vida.',
                'options' => ['+13 Full', 'Taxa de Esquiva +10%', 'Diminuição de Dano 4%', 'Aumento de Vida +4%', 'Recuperação Automática'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-circle-o',
                'badge' => 'Pendente',
                'class_filter' => 'all',
                'subcat' => 'pendant'
            ]
        ]
    ],
    'pets' => [
        'title' => 'Pets & Montarias Lendárias',
        'icon' => 'fa-paw',
        'items' => [
            [
                'id' => 'pet_fenrir_gold',
                'name' => 'Horn of Fenrir Gold (+Illusion)',
                'desc' => 'Fenrir Dourado de Ilusão • A montaria suprema com dano e defesa ampliados.',
                'options' => ['Montaria Lendária', 'Aumento de Dano +33%', 'Absorção de Dano +33%', 'Velocidade Extrema'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_fenrir_black',
                'name' => 'Horn of Fenrir Black (+Destruction)',
                'desc' => 'Fenrir Preto da Destruição • Focado em causar o máximo de dano em PvP.',
                'options' => ['Montaria de Ataque', 'Aumento de Dano Final +33%', 'Ataque de Plasma Flamejante'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_fenrir_blue',
                'name' => 'Horn of Fenrir Blue (+Protect)',
                'desc' => 'Fenrir Azul da Proteção • Reduz o dano recebido em situações extremas.',
                'options' => ['Montaria de Defesa', 'Absorção de Dano Final 33%', 'Alta Resistência a Impacto'],
                'price_wc' => 4000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_fenrir_red',
                'name' => 'Horn of Fenrir Red (Clássico)',
                'desc' => 'O clássico lobo de chamas vermelhas de MU Online.',
                'options' => ['Montaria Clássica', 'Aumento de Dano & Velocidade', 'Skill Plasma Storm'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_dinorant',
                'name' => 'Horn of Dinorant (Com Skill)',
                'desc' => 'Montaria alada clássica que permite voar e lutar com ataque especial.',
                'options' => ['Voo Habilitado', 'Absorção de Dano 15%', 'Skill de Ataque Embutida'],
                'price_wc' => 500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_dark_horse',
                'name' => 'Dark Horse de Dark Lord (Lv 50)',
                'desc' => 'O lendário cavalo negro de Dark Lord com a habilidade Earthquake.',
                'options' => ['Exclusivo Dark Lord', 'Skill Earthquake (Pisotão em Área)', 'Aumento de Defesa & Velocidade'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_dark_raven',
                'name' => 'Dark Raven de Dark Lord (Lv 50)',
                'desc' => 'Corvo de combate sagrado de Dark Lord com ataque automático.',
                'options' => ['Exclusivo Dark Lord', 'Ataque Aéreo Automático', 'Comandos de Combate'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_panda',
                'name' => 'Pet Panda Sagrado (30 Dias)',
                'desc' => 'Panda fofinho que aumenta +50% a experiência ganha e coleta zen.',
                'options' => ['+50% Bônus de EXP', 'Coleta Zen Automática', 'Defesa +50'],
                'price_wc' => 800,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_demon',
                'name' => 'Pet Demon (+40% Dano)',
                'desc' => 'Demônio sagrado que amplia o poder ofensivo em combate.',
                'options' => ['+40% de Dano Físico/Mágico', '+10 Velocidade de Ataque'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ],
            [
                'id' => 'pet_spirit_guardian',
                'name' => 'Spirit of Guardian (+30% Defesa)',
                'desc' => 'Anjo guardião avançado que absorve grandes impactos.',
                'options' => ['Absorção de Dano 30%', '+500 de Vida Máxima'],
                'price_wc' => 1000,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-paw',
                'badge' => 'Pet / Montaria',
                'class_filter' => 'all',
                'subcat' => 'pets'
            ]
        ]
    ],
    'jewels_boxes' => [
        'title' => 'Jóias, Boxes & Upgrades',
        'icon' => 'fa-gem',
        'items' => [
            [
                'id' => 'pack_bless_30',
                'name' => 'Pack 30x Jewel of Bless',
                'desc' => 'Pacote com 30 Jóias da Benção para refinar itens até +6 sem falha.',
                'options' => ['Quantidade: 30x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 300,
                'price_gp' => 500,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Jóias',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'pack_soul_30',
                'name' => 'Pack 30x Jewel of Soul',
                'desc' => 'Pacote com 30 Jóias da Alma para refinar itens até +9.',
                'options' => ['Quantidade: 30x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 300,
                'price_gp' => 500,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Jóias',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'pack_chaos_30',
                'name' => 'Pack 30x Jewel of Chaos',
                'desc' => 'Pacote com 30 Jóias do Caos para combinações na Chaos Machine.',
                'options' => ['Quantidade: 30x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 250,
                'price_gp' => 400,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Jóias',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'pack_life_30',
                'name' => 'Pack 30x Jewel of Life',
                'desc' => 'Pacote com 30 Jóias da Vida para adicionar opcionais até +28.',
                'options' => ['Quantidade: 30x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 400,
                'price_gp' => 600,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Jóias',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'pack_creation_30',
                'name' => 'Pack 30x Jewel of Creation',
                'desc' => 'Pacote com 30 Jóias da Criação para criar frutas e sementes.',
                'options' => ['Quantidade: 30x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 400,
                'price_gp' => 600,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Jóias',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'pack_harmony_30',
                'name' => 'Pack 30x Jewel of Harmony',
                'desc' => 'Pacote com 30 Jóias da Harmonia para inserir opções amarelas de PvP.',
                'options' => ['Quantidade: 30x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 600,
                'price_gp' => 900,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Jóias',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'pack_guardian_30',
                'name' => 'Pack 30x Jewel of Guardian',
                'desc' => 'Pacote com 30 Jóias do Guardião para restaurações e Castle Siege.',
                'options' => ['Quantidade: 30x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 500,
                'price_gp' => 800,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Jóias',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'box_kundun_1',
                'name' => 'Pack 5x Box of Kundun +1',
                'desc' => 'Caixas de Kundun +1 • Drops de itens básicos excelentes e jóias.',
                'options' => ['Quantidade: 5x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 150,
                'price_gp' => 200,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Box Kundun',
                'class_filter' => 'all',
                'subcat' => 'boxes'
            ],
            [
                'id' => 'box_kundun_2',
                'name' => 'Pack 5x Box of Kundun +2',
                'desc' => 'Caixas de Kundun +2 • Drops de armas e armaduras intermediárias excelentes.',
                'options' => ['Quantidade: 5x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 250,
                'price_gp' => 350,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Box Kundun',
                'class_filter' => 'all',
                'subcat' => 'boxes'
            ],
            [
                'id' => 'box_kundun_3',
                'name' => 'Pack 5x Box of Kundun +3',
                'desc' => 'Caixas de Kundun +3 • Drops de sets clássicos (Dragon, Legendary, Guardian).',
                'options' => ['Quantidade: 5x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 400,
                'price_gp' => 600,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Box Kundun',
                'class_filter' => 'all',
                'subcat' => 'boxes'
            ],
            [
                'id' => 'box_kundun_4',
                'name' => 'Pack 5x Box of Kundun +4',
                'desc' => 'Caixas de Kundun +4 • Drops de armaduras e armas avançadas excelentes.',
                'options' => ['Quantidade: 5x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 600,
                'price_gp' => 900,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Box Kundun',
                'class_filter' => 'all',
                'subcat' => 'boxes'
            ],
            [
                'id' => 'box_kundun_5',
                'name' => 'Pack 5x Box of Kundun +5',
                'desc' => 'Caixas de Kundun +5 • Drops dos equipamentos mais raros e cobiçados do jogo!',
                'options' => ['Quantidade: 5x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 900,
                'price_gp' => 1400,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Box Kundun',
                'class_filter' => 'all',
                'subcat' => 'boxes'
            ],
            [
                'id' => 'mat_feather_condor',
                'name' => 'Feather of Condor (Pena Sagrada)',
                'desc' => 'Pena de Condor necessária para a criação das Asas Level 3 na Chaos Machine.',
                'options' => ['Quantidade: 1x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 1200,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Material 3rd',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'mat_flame_condor',
                'name' => 'Flame of Condor (Chama Sagrada)',
                'desc' => 'Chama de Condor raríssima para a criação das Asas Level 3.',
                'options' => ['Quantidade: 1x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Material 3rd',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ],
            [
                'id' => 'mat_lochs_feather',
                'name' => 'Loch\'s Feather (Pena de Ícaro)',
                'desc' => 'Pena azul lendária para a criação de Asas Level 2 e Dinorant.',
                'options' => ['Quantidade: 1x', '100% Original', 'Entrega Imediata no Baú'],
                'price_wc' => 400,
                'price_gp' => 600,
                'type' => 'item',
                'icon_fa' => 'fa-gem',
                'badge' => 'Material 3rd',
                'class_filter' => 'all',
                'subcat' => 'jewels'
            ]
        ]
    ],
    'vip' => [
        'title' => 'Planos VIP & Privilégios',
        'icon' => 'fa-diamond',
        'items' => [
            [
                'id' => 'vip_bronze',
                'name' => 'Plano VIP Bronze (30 Dias)',
                'desc' => '+30% EXP Geral • +10% Drop • Reset Lv. 380 • Pontos: 400/reset',
                'options' => ['+30% Bônus de Experiência', '+10% Taxa de Drop & Jóias', 'Reset no Nível 380', '400 Pontos por Reset'],
                'price_wc' => 1500,
                'price_gp' => 0,
                'type' => 'vip',
                'vip_lvl' => 1,
                'icon_fa' => 'fa-shield',
                'badge' => 'Iniciante',
                'class_filter' => 'all',
                'subcat' => 'vip'
            ],
            [
                'id' => 'vip_prata',
                'name' => 'Plano VIP Prata (30 Dias)',
                'desc' => '+50% EXP Geral • +20% Drop • Reset Lv. 350 • Pontos: 450/reset • Comandos Exclusivos',
                'options' => ['+50% Bônus de Experiência', '+20% Taxa de Drop & Jóias', 'Reset no Nível 350', '450 Pontos por Reset', 'Comandos Especiais no Chat'],
                'price_wc' => 3000,
                'price_gp' => 0,
                'type' => 'vip',
                'vip_lvl' => 2,
                'icon_fa' => 'fa-star',
                'badge' => 'Mais Popular',
                'class_filter' => 'all',
                'subcat' => 'vip'
            ],
            [
                'id' => 'vip_ouro',
                'name' => 'Plano VIP Ouro (30 Dias)',
                'desc' => '+100% EXP Geral • +35% Drop • Reset Lv. 300 • Pontos: 500/reset • Sala VIP Exclusiva',
                'options' => ['+100% Bônus de Experiência', '+35% Taxa de Drop & Jóias', 'Reset no Nível 300', '500 Pontos por Reset', 'Acesso à Sala VIP com Spots Raros'],
                'price_wc' => 5000,
                'price_gp' => 0,
                'type' => 'vip',
                'vip_lvl' => 3,
                'icon_fa' => 'fa-trophy',
                'badge' => 'Máxima Vantagem',
                'class_filter' => 'all',
                'subcat' => 'vip'
            ],
            [
                'id' => 'seal_ascension_7d',
                'name' => 'Seal of Ascension (7 Dias)',
                'desc' => 'Selo de Ascensão • +50% de Experiência obtida em todos os monstros por 7 dias.',
                'options' => ['Duração: 7 Dias Corridos', '+50% Bônus de XP Ativo', 'Cumulativo com VIP'],
                'price_wc' => 500,
                'price_gp' => 800,
                'type' => 'item',
                'icon_fa' => 'fa-bolt',
                'badge' => '+50% EXP',
                'class_filter' => 'all',
                'subcat' => 'buffs'
            ],
            [
                'id' => 'seal_wealth_7d',
                'name' => 'Seal of Wealth (7 Dias)',
                'desc' => 'Selo da Riqueza • +100% de Taxa de Drop e Jóias por 7 dias corridos.',
                'options' => ['Duração: 7 Dias Corridos', '+100% de Drop & Jóias', 'Dobro de itens lendários'],
                'price_wc' => 600,
                'price_gp' => 900,
                'type' => 'item',
                'icon_fa' => 'fa-money',
                'badge' => '+100% DROP',
                'class_filter' => 'all',
                'subcat' => 'buffs'
            ],
            [
                'id' => 'cherry_blossom_wine',
                'name' => 'Vinho Flor de Cerejeira (10x)',
                'desc' => 'Consumível especial que confere +700 de Vida Máxima por 1 hora por garrafa.',
                'options' => ['Pacote com 10 Garrafas', '+700 de Vida (HP) por Garrafa', 'Duração: 1 Hora cada'],
                'price_wc' => 200,
                'price_gp' => 300,
                'type' => 'item',
                'icon_fa' => 'fa-glass',
                'badge' => 'Buff PvP',
                'class_filter' => 'all',
                'subcat' => 'buffs'
            ]
        ]
    ]
];

// 2.1 Mapping of OpenMU Item Definitions for In-Game Vault Delivery
$catalog_delivery_items = [
    'set_bronze' => [
        [
            'name' => 'Bronze Helm',
            'def' => '00000080-0007-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bronze Armor',
            'def' => '00000080-0008-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bronze Pants',
            'def' => '00000080-0009-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bronze Gloves',
            'def' => '00000080-000a-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bronze Boots',
            'def' => '00000080-000b-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_dragon' => [
        [
            'name' => 'Dragon Helm',
            'def' => '00000080-0007-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Armor',
            'def' => '00000080-0008-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Pants',
            'def' => '00000080-0009-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Gloves',
            'def' => '00000080-000a-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Boots',
            'def' => '00000080-000b-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_pad' => [
        [
            'name' => 'Pad Helm',
            'def' => '00000080-0007-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Pad Armor',
            'def' => '00000080-0008-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Pad Pants',
            'def' => '00000080-0009-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Pad Gloves',
            'def' => '00000080-000a-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Pad Boots',
            'def' => '00000080-000b-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_legendary' => [
        [
            'name' => 'Legendary Helm',
            'def' => '00000080-0007-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Legendary Armor',
            'def' => '00000080-0008-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Legendary Pants',
            'def' => '00000080-0009-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Legendary Gloves',
            'def' => '00000080-000a-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Legendary Boots',
            'def' => '00000080-000b-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_bone' => [
        [
            'name' => 'Bone Helm',
            'def' => '00000080-0007-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bone Armor',
            'def' => '00000080-0008-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bone Pants',
            'def' => '00000080-0009-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bone Gloves',
            'def' => '00000080-000a-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Bone Boots',
            'def' => '00000080-000b-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_leather' => [
        [
            'name' => 'Leather Helm',
            'def' => '00000080-0007-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Leather Armor',
            'def' => '00000080-0008-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Leather Pants',
            'def' => '00000080-0009-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Leather Gloves',
            'def' => '00000080-000a-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Leather Boots',
            'def' => '00000080-000b-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_scale' => [
        [
            'name' => 'Scale Helm',
            'def' => '00000080-0007-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Scale Armor',
            'def' => '00000080-0008-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Scale Pants',
            'def' => '00000080-0009-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Scale Gloves',
            'def' => '00000080-000a-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Scale Boots',
            'def' => '00000080-000b-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_sphinx' => [
        [
            'name' => 'Sphinx Helm',
            'def' => '00000080-0007-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sphinx Armor',
            'def' => '00000080-0008-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sphinx Pants',
            'def' => '00000080-0009-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sphinx Gloves',
            'def' => '00000080-000a-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sphinx Boots',
            'def' => '00000080-000b-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_brass' => [
        [
            'name' => 'Brass Helm',
            'def' => '00000080-0007-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brass Armor',
            'def' => '00000080-0008-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brass Pants',
            'def' => '00000080-0009-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brass Gloves',
            'def' => '00000080-000a-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brass Boots',
            'def' => '00000080-000b-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_plate' => [
        [
            'name' => 'Plate Helm',
            'def' => '00000080-0007-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Plate Armor',
            'def' => '00000080-0008-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Plate Pants',
            'def' => '00000080-0009-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Plate Gloves',
            'def' => '00000080-000a-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Plate Boots',
            'def' => '00000080-000b-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_vine' => [
        [
            'name' => 'Vine Helm',
            'def' => '00000080-0007-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Vine Armor',
            'def' => '00000080-0008-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Vine Pants',
            'def' => '00000080-0009-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Vine Gloves',
            'def' => '00000080-000a-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Vine Boots',
            'def' => '00000080-000b-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_silk' => [
        [
            'name' => 'Silk Helm',
            'def' => '00000080-0007-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Silk Armor',
            'def' => '00000080-0008-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Silk Pants',
            'def' => '00000080-0009-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Silk Gloves',
            'def' => '00000080-000a-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Silk Boots',
            'def' => '00000080-000b-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_wind' => [
        [
            'name' => 'Wind Helm',
            'def' => '00000080-0007-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Wind Armor',
            'def' => '00000080-0008-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Wind Pants',
            'def' => '00000080-0009-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Wind Gloves',
            'def' => '00000080-000a-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Wind Boots',
            'def' => '00000080-000b-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_spirit' => [
        [
            'name' => 'Spirit Helm',
            'def' => '00000080-0007-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Spirit Armor',
            'def' => '00000080-0008-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Spirit Pants',
            'def' => '00000080-0009-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Spirit Gloves',
            'def' => '00000080-000a-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Spirit Boots',
            'def' => '00000080-000b-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_guardian' => [
        [
            'name' => 'Guardian Helm',
            'def' => '00000080-0007-000e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Guardian Armor',
            'def' => '00000080-0008-000e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Guardian Pants',
            'def' => '00000080-0009-000e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Guardian Gloves',
            'def' => '00000080-000a-000e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Guardian Boots',
            'def' => '00000080-000b-000e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_storm_crow' => [
        [
            'name' => 'Storm Crow Armor',
            'def' => '00000080-0008-000f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Storm Crow Pants',
            'def' => '00000080-0009-000f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Storm Crow Gloves',
            'def' => '00000080-000a-000f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Storm Crow Boots',
            'def' => '00000080-000b-000f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_black_dragon' => [
        [
            'name' => 'Black Dragon Helm',
            'def' => '00000080-0007-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Dragon Armor',
            'def' => '00000080-0008-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Dragon Pants',
            'def' => '00000080-0009-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Dragon Gloves',
            'def' => '00000080-000a-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Dragon Boots',
            'def' => '00000080-000b-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_dark_phoenix' => [
        [
            'name' => 'Dark Phoenix Helm',
            'def' => '00000080-0007-0011-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Phoenix Armor',
            'def' => '00000080-0008-0011-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Phoenix Pants',
            'def' => '00000080-0009-0011-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Phoenix Gloves',
            'def' => '00000080-000a-0011-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Phoenix Boots',
            'def' => '00000080-000b-0011-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_grand_soul' => [
        [
            'name' => 'Grand Soul Helm',
            'def' => '00000080-0007-0012-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Grand Soul Armor',
            'def' => '00000080-0008-0012-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Grand Soul Pants',
            'def' => '00000080-0009-0012-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Grand Soul Gloves',
            'def' => '00000080-000a-0012-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Grand Soul Boots',
            'def' => '00000080-000b-0012-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_divine' => [
        [
            'name' => 'Divine Helm',
            'def' => '00000080-0007-0013-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Divine Armor',
            'def' => '00000080-0008-0013-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Divine Pants',
            'def' => '00000080-0009-0013-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Divine Gloves',
            'def' => '00000080-000a-0013-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Divine Boots',
            'def' => '00000080-000b-0013-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_thunder_hawk' => [
        [
            'name' => 'Thunder Hawk Armor',
            'def' => '00000080-0008-0014-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Thunder Hawk Pants',
            'def' => '00000080-0009-0014-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Thunder Hawk Gloves',
            'def' => '00000080-000a-0014-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Thunder Hawk Boots',
            'def' => '00000080-000b-0014-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_great_dragon' => [
        [
            'name' => 'Great Dragon Helm',
            'def' => '00000080-0007-0015-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Great Dragon Armor',
            'def' => '00000080-0008-0015-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Great Dragon Pants',
            'def' => '00000080-0009-0015-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Great Dragon Gloves',
            'def' => '00000080-000a-0015-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Great Dragon Boots',
            'def' => '00000080-000b-0015-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_dark_soul' => [
        [
            'name' => 'Dark Soul Helm',
            'def' => '00000080-0007-0016-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Soul Armor',
            'def' => '00000080-0008-0016-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Soul Pants',
            'def' => '00000080-0009-0016-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Soul Gloves',
            'def' => '00000080-000a-0016-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Soul Boots',
            'def' => '00000080-000b-0016-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_hurricane' => [
        [
            'name' => 'Hurricane Armor',
            'def' => '00000080-0008-0017-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Hurricane Pants',
            'def' => '00000080-0009-0017-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Hurricane Gloves',
            'def' => '00000080-000a-0017-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Hurricane Boots',
            'def' => '00000080-000b-0017-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_red_spirit' => [
        [
            'name' => 'Red Spirit Helm',
            'def' => '00000080-0007-0018-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Spirit Armor',
            'def' => '00000080-0008-0018-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Spirit Pants',
            'def' => '00000080-0009-0018-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Spirit Gloves',
            'def' => '00000080-000a-0018-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Spirit Boots',
            'def' => '00000080-000b-0018-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_light_plate' => [
        [
            'name' => 'Light Plate Helm',
            'def' => '00000080-0007-0019-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Light Plate Armor',
            'def' => '00000080-0008-0019-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Light Plate Pants',
            'def' => '00000080-0009-0019-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Light Plate Gloves',
            'def' => '00000080-000a-0019-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Light Plate Boots',
            'def' => '00000080-000b-0019-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_adamantine' => [
        [
            'name' => 'Adamantine Helm',
            'def' => '00000080-0007-001a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Adamantine Armor',
            'def' => '00000080-0008-001a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Adamantine Pants',
            'def' => '00000080-0009-001a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Adamantine Gloves',
            'def' => '00000080-000a-001a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Adamantine Boots',
            'def' => '00000080-000b-001a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_dark_steel' => [
        [
            'name' => 'Dark Steel Helm',
            'def' => '00000080-0007-001b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Steel Armor',
            'def' => '00000080-0008-001b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Steel Pants',
            'def' => '00000080-0009-001b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Steel Gloves',
            'def' => '00000080-000a-001b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Steel Boots',
            'def' => '00000080-000b-001b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_dark_master' => [
        [
            'name' => 'Dark Master Helm',
            'def' => '00000080-0007-001c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Master Armor',
            'def' => '00000080-0008-001c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Master Pants',
            'def' => '00000080-0009-001c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Master Gloves',
            'def' => '00000080-000a-001c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dark Master Boots',
            'def' => '00000080-000b-001c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_dragon_knight' => [
        [
            'name' => 'Dragon Knight Helm',
            'def' => '00000080-0007-001d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Knight Armor',
            'def' => '00000080-0008-001d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Knight Pants',
            'def' => '00000080-0009-001d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Knight Gloves',
            'def' => '00000080-000a-001d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Dragon Knight Boots',
            'def' => '00000080-000b-001d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_venom_mist' => [
        [
            'name' => 'Venom Mist Helm',
            'def' => '00000080-0007-001e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Venom Mist Armor',
            'def' => '00000080-0008-001e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Venom Mist Pants',
            'def' => '00000080-0009-001e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Venom Mist Gloves',
            'def' => '00000080-000a-001e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Venom Mist Boots',
            'def' => '00000080-000b-001e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_sylphid_ray' => [
        [
            'name' => 'Sylphid Ray Helm',
            'def' => '00000080-0007-001f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sylphid Ray Armor',
            'def' => '00000080-0008-001f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sylphid Ray Pants',
            'def' => '00000080-0009-001f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sylphid Ray Gloves',
            'def' => '00000080-000a-001f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sylphid Ray Boots',
            'def' => '00000080-000b-001f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_volcano' => [
        [
            'name' => 'Volcano Armor',
            'def' => '00000080-0008-0020-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Volcano Pants',
            'def' => '00000080-0009-0020-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Volcano Gloves',
            'def' => '00000080-000a-0020-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Volcano Boots',
            'def' => '00000080-000b-0020-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_sunlight' => [
        [
            'name' => 'Sunlight Helm',
            'def' => '00000080-0007-0021-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sunlight Armor',
            'def' => '00000080-0008-0021-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sunlight Pants',
            'def' => '00000080-0009-0021-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sunlight Gloves',
            'def' => '00000080-000a-0021-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sunlight Boots',
            'def' => '00000080-000b-0021-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_ashcrow' => [
        [
            'name' => 'Ashcrow Helm',
            'def' => '00000080-0007-0022-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ashcrow Armor',
            'def' => '00000080-0008-0022-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ashcrow Pants',
            'def' => '00000080-0009-0022-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ashcrow Gloves',
            'def' => '00000080-000a-0022-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ashcrow Boots',
            'def' => '00000080-000b-0022-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_eclipse' => [
        [
            'name' => 'Eclipse Helm',
            'def' => '00000080-0007-0023-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Eclipse Armor',
            'def' => '00000080-0008-0023-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Eclipse Pants',
            'def' => '00000080-0009-0023-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Eclipse Gloves',
            'def' => '00000080-000a-0023-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Eclipse Boots',
            'def' => '00000080-000b-0023-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_iris' => [
        [
            'name' => 'Iris Helm',
            'def' => '00000080-0007-0024-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Iris Armor',
            'def' => '00000080-0008-0024-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Iris Pants',
            'def' => '00000080-0009-0024-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Iris Gloves',
            'def' => '00000080-000a-0024-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Iris Boots',
            'def' => '00000080-000b-0024-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_valiant' => [
        [
            'name' => 'Valiant Armor',
            'def' => '00000080-0008-0025-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Valiant Pants',
            'def' => '00000080-0009-0025-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Valiant Gloves',
            'def' => '00000080-000a-0025-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Valiant Boots',
            'def' => '00000080-000b-0025-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_glorious' => [
        [
            'name' => 'Glorious Helm',
            'def' => '00000080-0007-0026-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Glorious Armor',
            'def' => '00000080-0008-0026-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Glorious Pants',
            'def' => '00000080-0009-0026-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Glorious Gloves',
            'def' => '00000080-000a-0026-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Glorious Boots',
            'def' => '00000080-000b-0026-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_mistery' => [
        [
            'name' => 'Mistery Helm',
            'def' => '00000080-0007-0027-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Mistery Armor',
            'def' => '00000080-0008-0027-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Mistery Pants',
            'def' => '00000080-0009-0027-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Mistery Gloves',
            'def' => '00000080-000a-0027-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Mistery Boots',
            'def' => '00000080-000b-0027-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_red_wing' => [
        [
            'name' => 'Red Wing Helm',
            'def' => '00000080-0007-0028-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Wing Armor',
            'def' => '00000080-0008-0028-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Wing Pants',
            'def' => '00000080-0009-0028-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Wing Gloves',
            'def' => '00000080-000a-0028-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Red Wing Boots',
            'def' => '00000080-000b-0028-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_ancient' => [
        [
            'name' => 'Ancient Helm',
            'def' => '00000080-0007-0029-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ancient Armor',
            'def' => '00000080-0008-0029-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ancient Pants',
            'def' => '00000080-0009-0029-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ancient Gloves',
            'def' => '00000080-000a-0029-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Ancient Boots',
            'def' => '00000080-000b-0029-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_black_rose' => [
        [
            'name' => 'Black Rose Helm',
            'def' => '00000080-0007-002a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Rose Armor',
            'def' => '00000080-0008-002a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Rose Pants',
            'def' => '00000080-0009-002a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Rose Gloves',
            'def' => '00000080-000a-002a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Black Rose Boots',
            'def' => '00000080-000b-002a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_aura' => [
        [
            'name' => 'Aura Helm',
            'def' => '00000080-0007-002b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Aura Armor',
            'def' => '00000080-0008-002b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Aura Pants',
            'def' => '00000080-0009-002b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Aura Gloves',
            'def' => '00000080-000a-002b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Aura Boots',
            'def' => '00000080-000b-002b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_lilium' => [
        [
            'name' => 'Lilium Helm',
            'def' => '00000080-0007-002c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Lilium Armor',
            'def' => '00000080-0008-002c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Lilium Pants',
            'def' => '00000080-0009-002c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Lilium Gloves',
            'def' => '00000080-000a-002c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Lilium Boots',
            'def' => '00000080-000b-002c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_titan' => [
        [
            'name' => 'Titan Helm',
            'def' => '00000080-0007-002d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Titan Armor',
            'def' => '00000080-0008-002d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Titan Pants',
            'def' => '00000080-0009-002d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Titan Gloves',
            'def' => '00000080-000a-002d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Titan Boots',
            'def' => '00000080-000b-002d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_brave' => [
        [
            'name' => 'Brave Helm',
            'def' => '00000080-0007-002e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brave Armor',
            'def' => '00000080-0008-002e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brave Pants',
            'def' => '00000080-0009-002e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brave Gloves',
            'def' => '00000080-000a-002e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Brave Boots',
            'def' => '00000080-000b-002e-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_destroy' => [
        [
            'name' => 'Destroy Armor',
            'def' => '00000080-0008-002f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Destroy Pants',
            'def' => '00000080-0009-002f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Destroy Gloves',
            'def' => '00000080-000a-002f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Destroy Boots',
            'def' => '00000080-000b-002f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_phantom' => [
        [
            'name' => 'Phantom Armor',
            'def' => '00000080-0008-0030-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Phantom Pants',
            'def' => '00000080-0009-0030-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Phantom Gloves',
            'def' => '00000080-000a-0030-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Phantom Boots',
            'def' => '00000080-000b-0030-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_seraphim' => [
        [
            'name' => 'Seraphim Helm',
            'def' => '00000080-0007-0031-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Seraphim Armor',
            'def' => '00000080-0008-0031-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Seraphim Pants',
            'def' => '00000080-0009-0031-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Seraphim Gloves',
            'def' => '00000080-000a-0031-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Seraphim Boots',
            'def' => '00000080-000b-0031-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_faith' => [
        [
            'name' => 'Faith Helm',
            'def' => '00000080-0007-0032-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Faith Armor',
            'def' => '00000080-0008-0032-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Faith Pants',
            'def' => '00000080-0009-0032-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Faith Gloves',
            'def' => '00000080-000a-0032-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Faith Boots',
            'def' => '00000080-000b-0032-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_paewang' => [
        [
            'name' => 'Paewang Helm',
            'def' => '00000080-0007-0033-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Paewang Armor',
            'def' => '00000080-0008-0033-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Paewang Pants',
            'def' => '00000080-0009-0033-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Paewang Gloves',
            'def' => '00000080-000a-0033-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Paewang Boots',
            'def' => '00000080-000b-0033-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_hades' => [
        [
            'name' => 'Hades Helm',
            'def' => '00000080-0007-0034-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Hades Armor',
            'def' => '00000080-0008-0034-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Hades Pants',
            'def' => '00000080-0009-0034-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Hades Gloves',
            'def' => '00000080-000a-0034-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Hades Boots',
            'def' => '00000080-000b-0034-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_sacred' => [
        [
            'name' => 'Sacred Helm',
            'def' => '00000080-0007-003b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sacred Armor',
            'def' => '00000080-0008-003b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sacred Pants',
            'def' => '00000080-0009-003b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Sacred Boots',
            'def' => '00000080-000b-003b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_storm_hard' => [
        [
            'name' => 'Storm Hard Helm',
            'def' => '00000080-0007-003c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Storm Hard Armor',
            'def' => '00000080-0008-003c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Storm Hard Pants',
            'def' => '00000080-0009-003c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Storm Hard Boots',
            'def' => '00000080-000b-003c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_piercing' => [
        [
            'name' => 'Piercing Helm',
            'def' => '00000080-0007-003d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Piercing Armor',
            'def' => '00000080-0008-003d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Piercing Pants',
            'def' => '00000080-0009-003d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Piercing Boots',
            'def' => '00000080-000b-003d-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'set_phoenix_soul' => [
        [
            'name' => 'Phoenix Soul Helm',
            'def' => '00000080-0007-0049-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Phoenix Soul Armor',
            'def' => '00000080-0008-0049-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Phoenix Soul Pants',
            'def' => '00000080-0009-0049-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ],
        [
            'name' => 'Phoenix Soul Boots',
            'def' => '00000080-000b-0049-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_kris' => [
        [
            'name' => 'Kris',
            'def' => '00000080-0000-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_short_sword' => [
        [
            'name' => 'Short Sword',
            'def' => '00000080-0000-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_rapier' => [
        [
            'name' => 'Rapier',
            'def' => '00000080-0000-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_sword_of_assassin' => [
        [
            'name' => 'Sword of Assassin',
            'def' => '00000080-0000-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_blade' => [
        [
            'name' => 'Blade',
            'def' => '00000080-0000-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_gladius' => [
        [
            'name' => 'Gladius',
            'def' => '00000080-0000-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_falchion' => [
        [
            'name' => 'Falchion',
            'def' => '00000080-0000-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_serpent_sword' => [
        [
            'name' => 'Serpent Sword',
            'def' => '00000080-0000-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_sword_of_salamander' => [
        [
            'name' => 'Sword of Salamander',
            'def' => '00000080-0000-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_light_saber' => [
        [
            'name' => 'Light Saber',
            'def' => '00000080-0000-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_legendary_sword' => [
        [
            'name' => 'Legendary Sword',
            'def' => '00000080-0000-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_heliacal_sword' => [
        [
            'name' => 'Heliacal Sword',
            'def' => '00000080-0000-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_double_blade' => [
        [
            'name' => 'Double Blade',
            'def' => '00000080-0000-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_lighting_sword' => [
        [
            'name' => 'Lighting Sword',
            'def' => '00000080-0000-000e-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_giant_sword' => [
        [
            'name' => 'Giant Sword',
            'def' => '00000080-0000-000f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_sword_of_destruction' => [
        [
            'name' => 'Sword of Destruction',
            'def' => '00000080-0000-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_dark_breaker' => [
        [
            'name' => 'Dark Breaker',
            'def' => '00000080-0000-0011-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_thunder_blade' => [
        [
            'name' => 'Thunder Blade',
            'def' => '00000080-0000-0012-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_divine_sword_of_archangel' => [
        [
            'name' => 'Divine Sword of Archangel',
            'def' => '00000080-0000-0013-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_knight_blade' => [
        [
            'name' => 'Knight Blade',
            'def' => '00000080-0000-0014-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_dark_reign_blade' => [
        [
            'name' => 'Dark Reign Blade',
            'def' => '00000080-0000-0015-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_bone_blade' => [
        [
            'name' => 'Bone Blade',
            'def' => '00000080-0000-0016-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_daybreak' => [
        [
            'name' => 'Daybreak',
            'def' => '00000080-0000-0018-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_sword_dancer' => [
        [
            'name' => 'Sword Dancer',
            'def' => '00000080-0000-0019-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_rune_blade' => [
        [
            'name' => 'Rune Blade',
            'def' => '00000080-0000-001f-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_crescent_axe' => [
        [
            'name' => 'Crescent Axe',
            'def' => '00000080-0001-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_battle_scepter' => [
        [
            'name' => 'Battle Scepter',
            'def' => '00000080-0002-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_great_lord_scepter' => [
        [
            'name' => 'Great Lord Scepter',
            'def' => '00000080-0002-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_divine_scepter_of_archangel' => [
        [
            'name' => 'Divine Scepter of Archangel',
            'def' => '00000080-0002-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_soleil_scepter' => [
        [
            'name' => 'Soleil Scepter',
            'def' => '00000080-0002-000e-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_shining_scepter' => [
        [
            'name' => 'Shining Scepter',
            'def' => '00000080-0002-000f-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_battle_bow' => [
        [
            'name' => 'Battle Bow',
            'def' => '00000080-0004-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_tiger_bow' => [
        [
            'name' => 'Tiger Bow',
            'def' => '00000080-0004-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_silver_bow' => [
        [
            'name' => 'Silver Bow',
            'def' => '00000080-0004-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_chaos_nature_bow' => [
        [
            'name' => 'Chaos Nature Bow',
            'def' => '00000080-0004-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_bolt' => [
        [
            'name' => 'Bolt',
            'def' => '00000080-0004-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_crossbow' => [
        [
            'name' => 'Crossbow',
            'def' => '00000080-0004-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_golden_crossbow' => [
        [
            'name' => 'Golden Crossbow',
            'def' => '00000080-0004-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_saint_crossbow' => [
        [
            'name' => 'Saint Crossbow',
            'def' => '00000080-0004-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_divine_crossbow_of_archangel' => [
        [
            'name' => 'Divine Crossbow of Archangel',
            'def' => '00000080-0004-0012-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_arrow_viper_bow' => [
        [
            'name' => 'Arrow Viper Bow',
            'def' => '00000080-0004-0014-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_skull_staff' => [
        [
            'name' => 'Skull Staff',
            'def' => '00000080-0005-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_angelic_staff' => [
        [
            'name' => 'Angelic Staff',
            'def' => '00000080-0005-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_serpent_staff' => [
        [
            'name' => 'Serpent Staff',
            'def' => '00000080-0005-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_thunder_staff' => [
        [
            'name' => 'Thunder Staff',
            'def' => '00000080-0005-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_gorgon_staff' => [
        [
            'name' => 'Gorgon Staff',
            'def' => '00000080-0005-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_legendary_staff' => [
        [
            'name' => 'Legendary Staff',
            'def' => '00000080-0005-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_staff_of_resurrection' => [
        [
            'name' => 'Staff of Resurrection',
            'def' => '00000080-0005-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_chaos_lightning_staff' => [
        [
            'name' => 'Chaos Lightning Staff',
            'def' => '00000080-0005-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_staff_of_destruction' => [
        [
            'name' => 'Staff of Destruction',
            'def' => '00000080-0005-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_dragon_soul_staff' => [
        [
            'name' => 'Dragon Soul Staff',
            'def' => '00000080-0005-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_divine_staff_of_archangel' => [
        [
            'name' => 'Divine Staff of Archangel',
            'def' => '00000080-0005-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_staff_of_kundun' => [
        [
            'name' => 'Staff of Kundun',
            'def' => '00000080-0005-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_grand_viper_staff' => [
        [
            'name' => 'Grand Viper Staff',
            'def' => '00000080-0005-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 4,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => false
        ]
    ],
    'wpn_small_shield' => [
        [
            'name' => 'Small Shield',
            'def' => '00000080-0006-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_horn_shield' => [
        [
            'name' => 'Horn Shield',
            'def' => '00000080-0006-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_kite_shield' => [
        [
            'name' => 'Kite Shield',
            'def' => '00000080-0006-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_elven_shield' => [
        [
            'name' => 'Elven Shield',
            'def' => '00000080-0006-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_buckler' => [
        [
            'name' => 'Buckler',
            'def' => '00000080-0006-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_dragon_slayer_shield' => [
        [
            'name' => 'Dragon Slayer Shield',
            'def' => '00000080-0006-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_skull_shield' => [
        [
            'name' => 'Skull Shield',
            'def' => '00000080-0006-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_spiked_shield' => [
        [
            'name' => 'Spiked Shield',
            'def' => '00000080-0006-0007-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_tower_shield' => [
        [
            'name' => 'Tower Shield',
            'def' => '00000080-0006-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_plate_shield' => [
        [
            'name' => 'Plate Shield',
            'def' => '00000080-0006-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_big_round_shield' => [
        [
            'name' => 'Big Round Shield',
            'def' => '00000080-0006-000a-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_serpent_shield' => [
        [
            'name' => 'Serpent Shield',
            'def' => '00000080-0006-000b-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_bronze_shield' => [
        [
            'name' => 'Bronze Shield',
            'def' => '00000080-0006-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_elemental_shield' => [
        [
            'name' => 'Elemental Shield',
            'def' => '00000080-0006-0010-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wpn_crimson_glory' => [
        [
            'name' => 'Crimson Glory',
            'def' => '00000080-0006-0011-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 2,
            'skill' => true,
            'dur' => 255,
            'luck' => true,
            'opt' => 7,
            'opt_def' => true
        ]
    ],
    'wing_wings_of_elf' => [
        [
            'name' => 'Wings of Elf',
            'def' => '00000080-000c-0000-0000-000000000000',
            'lvl' => 13,
            'w' => 3,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_heaven' => [
        [
            'name' => 'Wings of Heaven',
            'def' => '00000080-000c-0001-0000-000000000000',
            'lvl' => 13,
            'w' => 5,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_satan' => [
        [
            'name' => 'Wings of Satan',
            'def' => '00000080-000c-0002-0000-000000000000',
            'lvl' => 13,
            'w' => 5,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_curse' => [
        [
            'name' => 'Wings of Curse',
            'def' => '00000080-000c-0029-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_spirits' => [
        [
            'name' => 'Wings of Spirits',
            'def' => '00000080-000c-0003-0000-000000000000',
            'lvl' => 13,
            'w' => 5,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_soul' => [
        [
            'name' => 'Wings of Soul',
            'def' => '00000080-000c-0004-0000-000000000000',
            'lvl' => 13,
            'w' => 5,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_dragon' => [
        [
            'name' => 'Wings of Dragon',
            'def' => '00000080-000c-0005-0000-000000000000',
            'lvl' => 13,
            'w' => 3,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_darkness' => [
        [
            'name' => 'Wings of Darkness',
            'def' => '00000080-000c-0006-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 2,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wings_of_despair' => [
        [
            'name' => 'Wings of Despair',
            'def' => '00000080-000c-002a-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_cape_of_fighter' => [
        [
            'name' => 'Cape of Fighter',
            'def' => '00000080-000c-0031-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wing_of_storm' => [
        [
            'name' => 'Wing of Storm',
            'def' => '00000080-000c-0024-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wing_of_eternal' => [
        [
            'name' => 'Wing of Eternal',
            'def' => '00000080-000c-0025-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wing_of_illusion' => [
        [
            'name' => 'Wing of Illusion',
            'def' => '00000080-000c-0026-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wing_of_ruin' => [
        [
            'name' => 'Wing of Ruin',
            'def' => '00000080-000c-0027-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_cape_of_emperor' => [
        [
            'name' => 'Cape of Emperor',
            'def' => '00000080-000c-0028-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_wing_of_dimension' => [
        [
            'name' => 'Wing of Dimension',
            'def' => '00000080-000c-002b-0000-000000000000',
            'lvl' => 13,
            'w' => 4,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'wing_cape_of_overrule' => [
        [
            'name' => 'Cape of Overrule',
            'def' => '00000080-000c-0032-0000-000000000000',
            'lvl' => 13,
            'w' => 2,
            'h' => 3,
            'skill' => false,
            'dur' => 255,
            'luck' => true,
            'opt' => 4,
            'opt_def' => false
        ]
    ],
    'acc_ring_of_ice' => [
        [
            'name' => 'Ring of Ice',
            'def' => '00000080-000d-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_ring_of_poison' => [
        [
            'name' => 'Ring of Poison',
            'def' => '00000080-000d-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_wizard_s_ring' => [
        [
            'name' => 'Wizard\'s Ring',
            'def' => '00000080-000d-0014-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_ring_of_fire' => [
        [
            'name' => 'Ring of Fire',
            'def' => '00000080-000d-0015-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_ring_of_earth' => [
        [
            'name' => 'Ring of Earth',
            'def' => '00000080-000d-0016-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_ring_of_wind' => [
        [
            'name' => 'Ring of Wind',
            'def' => '00000080-000d-0017-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_ring_of_magic' => [
        [
            'name' => 'Ring of Magic',
            'def' => '00000080-000d-0018-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_pendant_of_lighting' => [
        [
            'name' => 'Pendant of Lighting',
            'def' => '00000080-000d-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_pendant_of_fire' => [
        [
            'name' => 'Pendant of Fire',
            'def' => '00000080-000d-000d-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_pendant_of_ice' => [
        [
            'name' => 'Pendant of Ice',
            'def' => '00000080-000d-0019-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_pendant_of_wind' => [
        [
            'name' => 'Pendant of Wind',
            'def' => '00000080-000d-001a-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_pendant_of_water' => [
        [
            'name' => 'Pendant of Water',
            'def' => '00000080-000d-001b-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'acc_pendant_of_ability' => [
        [
            'name' => 'Pendant of Ability',
            'def' => '00000080-000d-001c-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'kit_ancient_rings' => [
        [
            'name' => 'Ring of Ice',
            'def' => '00000080-000d-0008-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Ring of Poison',
            'def' => '00000080-000d-0009-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pendant of Lighting',
            'def' => '00000080-000d-000c-0000-000000000000',
            'lvl' => 13,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_fenrir_gold' => [
        [
            'name' => 'Horn of Fenrir Gold (+Illusion)',
            'def' => '00000080-000d-0025-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_fenrir_black' => [
        [
            'name' => 'Horn of Fenrir Black (+Destruction)',
            'def' => '00000080-000d-0025-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_fenrir_blue' => [
        [
            'name' => 'Horn of Fenrir Blue (+Protect)',
            'def' => '00000080-000d-0025-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_fenrir_red' => [
        [
            'name' => 'Horn of Fenrir Red (Clássico)',
            'def' => '00000080-000d-0025-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_dinorant' => [
        [
            'name' => 'Horn of Dinorant (Com Skill)',
            'def' => '00000080-000d-0003-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_dark_horse' => [
        [
            'name' => 'Dark Horse de Dark Lord (Lv 50)',
            'def' => '00000080-000d-0004-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_dark_raven' => [
        [
            'name' => 'Dark Raven de Dark Lord (Lv 50)',
            'def' => '00000080-000d-0005-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_panda' => [
        [
            'name' => 'Pet Panda Sagrado (30 Dias)',
            'def' => '00000080-000d-0050-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_demon' => [
        [
            'name' => 'Pet Demon (+40% Dano)',
            'def' => '00000080-000d-0040-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pet_spirit_guardian' => [
        [
            'name' => 'Spirit of Guardian (+30% Defesa)',
            'def' => '00000080-000d-0041-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => true,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pack_bless_30' => [
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Bless',
            'def' => '00000080-000e-000d-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pack_soul_30' => [
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Soul',
            'def' => '00000080-000e-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pack_chaos_30' => [
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Chaos',
            'def' => '00000080-000c-000f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pack_life_30' => [
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Life',
            'def' => '00000080-000e-0010-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pack_creation_30' => [
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Creation',
            'def' => '00000080-000e-0016-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pack_harmony_30' => [
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Harmony',
            'def' => '00000080-000e-002a-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'pack_guardian_30' => [
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 30x Jewel of Guardian',
            'def' => '00000080-000e-001f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'box_kundun_1' => [
        [
            'name' => 'Pack 5x Box of Kundun +1',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 1,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +1',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 1,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +1',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 1,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +1',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 1,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +1',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 1,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'box_kundun_2' => [
        [
            'name' => 'Pack 5x Box of Kundun +2',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 2,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +2',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 2,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +2',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 2,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +2',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 2,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +2',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 2,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'box_kundun_3' => [
        [
            'name' => 'Pack 5x Box of Kundun +3',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 3,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +3',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 3,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +3',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 3,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +3',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 3,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +3',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 3,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'box_kundun_4' => [
        [
            'name' => 'Pack 5x Box of Kundun +4',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 4,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +4',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 4,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +4',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 4,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +4',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 4,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +4',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 4,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'box_kundun_5' => [
        [
            'name' => 'Pack 5x Box of Kundun +5',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 5,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +5',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 5,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +5',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 5,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +5',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 5,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ],
        [
            'name' => 'Pack 5x Box of Kundun +5',
            'def' => '00000080-000e-000b-0000-000000000000',
            'lvl' => 5,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'mat_feather_condor' => [
        [
            'name' => 'Feather of Condor (Pena Sagrada)',
            'def' => '00000080-000d-0035-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'mat_flame_condor' => [
        [
            'name' => 'Flame of Condor (Chama Sagrada)',
            'def' => '00000080-000d-0034-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'mat_lochs_feather' => [
        [
            'name' => 'Loch\'s Feather (Pena de Ícaro)',
            'def' => '00000080-000d-000e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'seal_ascension_7d' => [
        [
            'name' => 'Seal of Ascension',
            'def' => '00000080-000e-002e-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'seal_wealth_7d' => [
        [
            'name' => 'Seal of Wealth',
            'def' => '00000080-000e-002f-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
        ]
    ],
    'cherry_blossom_wine' => [
        [
            'name' => 'Cherry Blossom Wine',
            'def' => '00000080-000e-0055-0000-000000000000',
            'lvl' => 0,
            'w' => 1,
            'h' => 1,
            'skill' => false,
            'dur' => 255,
            'luck' => false,
            'opt' => 0,
            'opt_def' => false
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
    height: 220px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(180deg, #0e1526 0%, #070b14 100%);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 8px;
    margin-bottom: 14px;
    overflow: hidden;
}
.item-3d-glow {
    display: none !important;
}
.item-3d-pedestal {
    position: absolute;
    bottom: 8px;
    width: 140px;
    height: 22px;
    border-radius: 50%;
    background: radial-gradient(ellipse at center, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.2) 50%, transparent 75%);
    border: none;
    box-shadow: none;
    transform: perspective(200px) rotateX(40deg);
    pointer-events: none;
}
.item-3d-render {
    max-height: 195px;
    max-width: 88%;
    width: auto;
    height: auto;
    object-fit: contain;
    z-index: 2;
    filter: drop-shadow(0 8px 18px rgba(0,0,0,0.85));
    transition: transform 0.3s ease, filter 0.3s ease;
    animation: itemHoverFloat 3.5s ease-in-out infinite;
}
.shop-item-card:hover .item-3d-render {
    transform: scale(1.08) translateY(-6px);
    filter: drop-shadow(0 14px 24px rgba(0,0,0,0.95));
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

<!-- SEARCH BAR & QUICK FILTERS -->
<div class="shop-nav-toolbar" style="margin-bottom: 25px;">
    <!-- LIVE SEARCH INPUT -->
    <div style="position: relative; max-width: 550px; margin-bottom: 18px;">
        <i class="fa fa-search" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: rgba(212,175,55,0.7); font-size: 15px;"></i>
        <input type="text" id="shopSearchInput" onkeyup="filterShopLive()" placeholder="🔍 Buscar por nome, set, arma, classe (ex: Great Dragon, Kundun, Fenrir, Asa)..." style="width: 100%; background: rgba(15,23,42,0.92); border: 1px solid rgba(212,175,55,0.45); border-radius: 25px; padding: 11px 40px 11px 45px; color: #fff; font-size: 13.5px; outline: none; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
        <button type="button" onclick="clearShopLiveSearch()" id="shopSearchClearBtn" style="display: none; position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94a3b8; font-size: 15px; cursor: pointer;"><i class="fa fa-times"></i></button>
    </div>

    <!-- CLASS FILTER PILLS (Visible when viewing Sets or All) -->
    <div id="shopClassPills" style="display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-bottom: 15px; padding: 10px 14px; background: rgba(15,23,42,0.6); border: 1px solid rgba(212,175,55,0.2); border-radius: 8px;">
        <span style="font-size: 12px; font-weight: 700; color: #d4af37; margin-right: 4px;"><i class="fa fa-filter"></i> CLASSE:</span>
        <button type="button" class="btn btn-xs btn-class-pill active" onclick="filterClass('all', this)" style="background: rgba(212,175,55,0.28); border: 1px solid #d4af37; color: #ffd700; font-weight: 700; padding: 5px 12px; border-radius: 4px;">TODAS</button>
        <button type="button" class="btn btn-xs btn-class-pill" onclick="filterClass('bk', this)" style="background: rgba(15,23,42,0.8); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 600; padding: 5px 12px; border-radius: 4px;">🗡️ BLADE KNIGHT</button>
        <button type="button" class="btn btn-xs btn-class-pill" onclick="filterClass('sm', this)" style="background: rgba(15,23,42,0.8); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 600; padding: 5px 12px; border-radius: 4px;">🔮 SOUL MASTER</button>
        <button type="button" class="btn btn-xs btn-class-pill" onclick="filterClass('elf', this)" style="background: rgba(15,23,42,0.8); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 600; padding: 5px 12px; border-radius: 4px;">🏹 MUSE ELF</button>
        <button type="button" class="btn btn-xs btn-class-pill" onclick="filterClass('mg', this)" style="background: rgba(15,23,42,0.8); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 600; padding: 5px 12px; border-radius: 4px;">⚔️ MAGIC GLAD.</button>
        <button type="button" class="btn btn-xs btn-class-pill" onclick="filterClass('dl', this)" style="background: rgba(15,23,42,0.8); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 600; padding: 5px 12px; border-radius: 4px;">👑 DARK LORD</button>
        <button type="button" class="btn btn-xs btn-class-pill" onclick="filterClass('sum', this)" style="background: rgba(15,23,42,0.8); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 600; padding: 5px 12px; border-radius: 4px;">🩸 SUMMONER</button>
        <button type="button" class="btn btn-xs btn-class-pill" onclick="filterClass('rf', this)" style="background: rgba(15,23,42,0.8); border: 1px solid rgba(255,255,255,0.15); color: #cbd5e1; font-weight: 600; padding: 5px 12px; border-radius: 4px;">🥊 RAGE FIGHTER</button>
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
        <div class="col-md-4 col-sm-6 shop-item-col" style="margin-bottom:25px;" data-cat="<?=$cat_key;?>" data-class="<?=$item['class_filter'] ?? 'all';?>" data-name="<?=htmlspecialchars(strtolower($item['name']));?>">
            <div class="shop-item-card">
                <div>
                    <!-- 3D ITEM SHOWCASE STAGE -->
                    <div class="item-3d-stage">
                        <div class="item-3d-glow"></div>
                        <div class="item-3d-pedestal"></div>
                        <img src="img/items/<?=$item['id'];?>.png?v=<?=file_exists('img/items/'.$item['id'].'.png') ? filemtime('img/items/'.$item['id'].'.png') : 2;?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" class="item-3d-render" alt="<?=$item['name'];?>">
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

let currentCatFilter = 'all';
let currentClassFilter = 'all';

function filterShopLive() {
    const q = (document.getElementById('shopSearchInput').value || '').toLowerCase().trim();
    const clearBtn = document.getElementById('shopSearchClearBtn');
    if (clearBtn) clearBtn.style.display = q.length > 0 ? 'block' : 'none';

    const cols = document.querySelectorAll('.shop-item-col');
    let visibleCount = 0;

    cols.forEach(col => {
        const itemCat = col.getAttribute('data-cat');
        const itemClass = col.getAttribute('data-class');
        const itemName = col.getAttribute('data-name');

        const matchCat = (currentCatFilter === 'all' || itemCat === currentCatFilter);
        const matchClass = (currentClassFilter === 'all' || itemClass === currentClassFilter || itemClass === 'all');
        const matchSearch = (q === '' || itemName.includes(q));

        if (matchCat && matchClass && matchSearch) {
            col.style.display = 'block';
            visibleCount++;
        } else {
            col.style.display = 'none';
        }
    });

    // Toggle category sections if empty
    document.querySelectorAll('.shop-category-section').forEach(sec => {
        const hasVisible = sec.querySelectorAll('.shop-item-col[style*="display: block"]').length > 0;
        sec.style.display = (visibleCount === 0 || hasVisible) ? 'block' : 'none';
    });
}

function clearShopLiveSearch() {
    document.getElementById('shopSearchInput').value = '';
    filterShopLive();
}

function filterClass(cls, btn) {
    currentClassFilter = cls;
    document.querySelectorAll('.btn-class-pill').forEach(b => {
        b.classList.remove('active');
        b.style.background = 'rgba(15,23,42,0.8)';
        b.style.borderColor = 'rgba(255,255,255,0.15)';
        b.style.color = '#cbd5e1';
    });
    btn.classList.add('active');
    btn.style.background = 'rgba(212,175,55,0.28)';
    btn.style.borderColor = '#d4af37';
    btn.style.color = '#ffd700';

    filterShopLive();
}

function filterCategory(cat, btn) {
    currentCatFilter = cat;
    document.querySelectorAll('.btn-shop-filter').forEach(b => {
        b.classList.remove('active');
        b.style.background = 'rgba(15,23,42,0.8)';
        b.style.borderColor = 'rgba(255,255,255,0.15)';
        b.style.color = '#cbd5e1';
    });
    btn.classList.add('active');
    btn.style.background = 'rgba(212,175,55,0.25)';
    btn.style.borderColor = 'rgba(212,175,55,0.7)';
    btn.style.color = '#ffd700';

    // Show/hide class pills bar based on category
    const classPills = document.getElementById('shopClassPills');
    if (classPills) {
        classPills.style.display = (cat === 'all' || cat === 'sets') ? 'flex' : 'none';
    }

    filterShopLive();
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
