<?php

require 'header.php';

if (!isset($_SESSION['user'])) {
    header('Location: authentication.php');
    exit;
}

use crazy\dispatch\DispatcherCompte;

$_GET['action'] = $_GET['action'] ?? "";
$dispatcher = new DispatcherCompte($_GET['action']);
$dispatcher->run();

require 'footer.php';