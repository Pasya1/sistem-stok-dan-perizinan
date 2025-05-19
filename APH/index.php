<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/APH/index.php') !== false || strpos($requestURI, '/APH/') !== false || strpos($requestURI, '/APH') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>