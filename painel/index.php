<?php
/**
 * MU Dravaryn - Panel Gateway
 * Seamless redirect to user panel or login modal
 */
ob_start();
session_start();
$NO_TITLE = 1;
require_once("../inclu/config_index.php");

// Logout handling
if (isset($_GET['deslogar'])) {
    setcookie("usuario", "", time() - 86400, "/");
    setcookie("senha", "", time() - 86400, "/");
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    if (!headers_sent()) {
        header("Location: ../site.php");
    }
    echo "<script>window.location.href='../site.php';</script>";
    exit();
}

// Check active session / cookie
$user = isset($_COOKIE["usuario"]) ? trim($_COOKIE["usuario"]) : (isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '');

if (!empty($user)) {
    // Verified session, proceed directly to account dashboard
    if (!headers_sent()) {
        header("Location: conta2.php");
    }
    echo "<script>window.location.href='conta2.php';</script>";
    exit();
}

// Handle POST login from within panel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mid = isset($_POST['login']) ? trim(stripslashes($_POST['login'])) : '';
    $mpw = isset($_POST['oldpwd']) ? trim(stripslashes($_POST['oldpwd'])) : '';
    $ip  = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '127.0.0.1';

    if (!empty($mid) && !empty($mpw)) {
        $safe_mid = addslashes($mid);
        $sql_user = mssql_query("SELECT memb___id, memb__pwd, bloc_code FROM MEMB_INFO WHERE LOWER(memb___id) = LOWER('$safe_mid')");
        $user_row = ($sql_user) ? mssql_fetch_assoc($sql_user) : false;

        if (!$user_row) {
            $sql_openmu = mssql_query("SELECT \"LoginName\" as memb___id, \"PasswordHash\" as memb__pwd, \"State\" as bloc_code FROM data.\"Account\" WHERE LOWER(\"LoginName\") = LOWER('$safe_mid')");
            $user_row = ($sql_openmu) ? mssql_fetch_assoc($sql_openmu) : false;
        }

        $authenticated = false;
        if ($user_row && !empty($user_row['memb__pwd'])) {
            $stored = $user_row['memb__pwd'];
            if (password_verify($mpw, $stored) || md5($mpw) === $stored || $mpw === $stored) {
                $authenticated = true;
            }
        }

        if ($authenticated) {
            $token = md5($user_row['memb__pwd']);
            setcookie("usuario", $user_row['memb___id'], time() + (86400 * 30), "/");
            setcookie("senha", $token, time() + (86400 * 30), "/");
            if (!headers_sent()) {
                header("Location: conta2.php");
            }
            echo "<script>window.location.href='conta2.php';</script>";
            exit();
        }
    }
}

// If unauthenticated, redirect to site.php?p=painel
if (!headers_sent()) {
    header("Location: ../site.php?p=painel");
}
echo "<script>window.location.href='../site.php?p=painel';</script>";
exit();
?>