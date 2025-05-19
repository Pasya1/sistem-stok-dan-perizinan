<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/MES/visitor/index.php') !== false || strpos($requestURI, '/MES/visitor/') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>