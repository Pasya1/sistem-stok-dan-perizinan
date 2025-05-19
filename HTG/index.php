<?php
$requestURI = $_SERVER['REQUEST_URI'];

if (strpos($requestURI, '/HTG/index.php') !== false || strpos($requestURI, '/HTG/') !== false || strpos($requestURI, '/HTG') !== false) {
    header('Location: dashboard.php');
    exit;
}
?>