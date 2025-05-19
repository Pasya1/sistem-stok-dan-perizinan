<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/HTG/visitor/index.php') !== false || strpos($requestURI, '/HTG/visitor/') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>