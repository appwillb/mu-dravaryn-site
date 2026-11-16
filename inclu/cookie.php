<?php 

if (!isset($_COOKIE['usuario']) || !isset($_COOKIE['senha'])){

echo "
<script>
top.location.href = 'index.php';
</script>
";

?>

<? 

Die();
}

if ($_COOKIE['usuario'] && $_COOKIE['senha']) {
$login = $_COOKIE['usuario'];
$psw   = $_COOKIE['senha'];

}
?>