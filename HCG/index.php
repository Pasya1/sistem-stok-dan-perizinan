<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/HCG/index.php') !== false || strpos($requestURI, '/HCG/') !== false || strpos($requestURI, '/HCG') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>