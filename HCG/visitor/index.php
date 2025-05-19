<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/HCG/visitor/index.php') !== false || strpos($requestURI, '/HCG/visitor/') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>