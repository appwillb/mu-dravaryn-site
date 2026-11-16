<?php
date_default_timezone_set("America/Sao_Paulo");

require_once(dirname(__FILE__) . "/protecao.php");
require_once(dirname(__FILE__) . '/../lib.php');

define('CLASSTPATH', "http://" . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost') . ROOT_URL . '/');

// Configurações do Banco de Dados PostgreSQL (OpenMU)
$DB_login   = getenv('DB_USER') ?: 'postgres';
$DB_senha   = getenv('DB_PASSWORD') ?: 'postgres';
$DB_db      = getenv('DB_NAME') ?: 'openmu';
$DB_host    = getenv('DB_HOST') ?: '187.127.26.213';

// MySQL alias (reutiliza PostgreSQL via compat.php)
$MySql_host = $DB_host;
$MySql_db   = $DB_db;
$MySql_login= $DB_login;
$MySql_senha= $DB_senha;

// Configurações de Cadastro & Bônus
$CONFIG_BONUS_CADASTRO = 1;
$CONFIG_VIP_CADASTRO   = 15;

// Nomes dos VIPs
$CONFIG_VIP0 = "FREE";
$CONFIG_VIP1 = "VIP SIMPLES";
$CONFIG_VIP2 = "VIP SUPER";
$CONFIG_VIP3 = "VIP PREMIUM";

// Notícias
$tabela_news = "noticias";

// Estilo Geral
$fundo_tab_cor = '#191c23';
$font_color1   = '#e74c3c';
$font_color2   = '#2ecc71';

// Informações Oficiais do MU Dravaryn Season 6
$CONFIG_SITE    = "mu-dravaryn.com";
$CONFIG_TITLE   = "MU Dravaryn - Season 6 Medium Slow";
$CONFIG_FOOTER  = "MU Dravaryn Season 6 © 2026 - Todos os direitos reservados";
$CONFIG_NOME_MU = "MU Dravaryn";

if (!isset($NO_TITLE)) {
    echo "<title>$CONFIG_TITLE</title>";
}
?>