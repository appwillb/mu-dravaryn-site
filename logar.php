<?php
/**
 * MU Dravaryn - Ultra-Modern Authentication Gateway
 * Validates BCrypt (OpenMU), MD5, and plaintext. Zero blank pages.
 */
ob_start();
session_start();
$NO_TITLE = 1;

require_once("inclu/config_index.php");

// 1. Handle Logout
if (isset($_GET['deslogar'])) {
    setcookie("usuario", "", time() - 86400, "/");
    setcookie("senha", "", time() - 86400, "/");
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
    if (!headers_sent()) {
        header("Location: site.php");
    }
    echo "<script>window.location.href='site.php';</script>";
    exit();
}

// 2. Handle Login Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mid = isset($_POST['login']) ? trim(stripslashes($_POST['login'])) : '';
    $mpw = isset($_POST['oldpwd']) ? trim(stripslashes($_POST['oldpwd'])) : '';
    $ip  = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '127.0.0.1';

    if (empty($mid) || empty($mpw)) {
        if (!headers_sent()) {
            header("Location: site.php?login_error=empty");
        }
        echo "<script>window.location.href='site.php?login_error=empty';</script>";
        exit();
    }

    // Query account in MEMB_INFO (or fallback to OpenMU data.Account)
    $safe_mid = addslashes($mid);
    $sql_user = @mssql_query("SELECT memb___id, memb__pwd, bloc_code, mail_chek FROM MEMB_INFO WHERE LOWER(memb___id) = LOWER('$safe_mid')");
    $user_row = ($sql_user) ? @mssql_fetch_assoc($sql_user) : false;

    // Fallback: check directly in OpenMU data.Account
    if (!$user_row) {
        $sql_openmu = @mssql_query("SELECT \"LoginName\" as memb___id, \"PasswordHash\" as memb__pwd, \"State\" as bloc_code FROM data.\"Account\" WHERE LOWER(\"LoginName\") = LOWER('$safe_mid')");
        $user_row = ($sql_openmu) ? @mssql_fetch_assoc($sql_openmu) : false;
        
        // Sync into MEMB_INFO if found in OpenMU
        if ($user_row) {
            $h = $user_row['memb__pwd'];
            @mssql_query("INSERT INTO public.\"MEMB_INFO\" (memb___id, memb__pwd, appl_days, mail_chek, bloc_code, ctl1_code, code, ip_cadastro) VALUES ('$safe_mid', '$h', NOW(), '1', '0', '1', '0', '$ip') ON CONFLICT (memb___id) DO NOTHING");
        }
    }

    $authenticated = false;

    if ($user_row && !empty($user_row['memb__pwd'])) {
        $stored_hash = $user_row['memb__pwd'];

        // A. Native BCrypt check (OpenMU standard $2a$, $2y$, $2b$)
        if (password_verify($mpw, $stored_hash)) {
            $authenticated = true;
        }
        // B. MD5 check
        elseif (md5($mpw) === $stored_hash || md5($mpw) === strtolower($stored_hash)) {
            $authenticated = true;
        }
        // C. Plaintext match fallback
        elseif ($mpw === $stored_hash) {
            $authenticated = true;
        }
    }

    if ($authenticated) {
        // Check if account is blocked
        if (isset($user_row['bloc_code']) && (int)$user_row['bloc_code'] > 0) {
            $target = "site.php?login_error=blocked&login_user=" . urlencode($mid);
            if (!headers_sent()) {
                header("Location: $target");
            }
            echo "<script>window.location.href='$target';</script>";
            exit();
        }

        // Set persistent session cookies
        $cookie_user = $user_row['memb___id'];
        $cookie_pass = md5($user_row['memb__pwd']);

        setcookie("usuario", $cookie_user, time() + (86400 * 30), "/");
        setcookie("senha", $cookie_pass, time() + (86400 * 30), "/");
        $_SESSION['usuario'] = $cookie_user;
        $_SESSION['senha']   = $cookie_pass;

        $target = "site.php?p=painel";
        if (!headers_sent()) {
            header("Location: $target");
        }
        echo "<script>window.location.href='$target';</script>";
        exit();
    } else {
        // Failed login: redirect back to site.php with error query string
        $target = "site.php?login_error=invalid&login_user=" . urlencode($mid);
        if (!headers_sent()) {
            header("Location: $target");
        }
        echo "<script>window.location.href='$target';</script>";
        exit();
    }
}

// 3. Fallback for direct GET access: redirect to site.php
if (!headers_sent()) {
    header("Location: site.php");
}
echo "<script>window.location.href='site.php';</script>";
exit();
?>