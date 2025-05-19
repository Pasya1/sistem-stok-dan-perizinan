<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/APH/visitor/index.php') !== false || strpos($requestURI, '/APH/visitor/') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>