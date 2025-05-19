<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/MHG/index.php') !== false || strpos($requestURI, '/MHG/') !== false || strpos($requestURI, '/MHG') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>