<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/AHG/index.php') !== false || strpos($requestURI, '/AHG/') !== false || strpos($requestURI, '/AHG') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>