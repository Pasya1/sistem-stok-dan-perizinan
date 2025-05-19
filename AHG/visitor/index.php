<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/AHG/visitor/index.php') !== false || strpos($requestURI, '/AHG/visitor/') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>