<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/MES/index.php') !== false || strpos($requestURI, '/MES/') !== false || strpos($requestURI, '/MES') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>