<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/MHG/visitor/index.php') !== false || strpos($requestURI, '/MHG/visitor/') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>