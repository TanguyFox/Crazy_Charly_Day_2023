<?php
declare(strict_types=1);
require 'vendor/autoload.php';
session_start();

use crazy\dispatch\Dispatcher;

$_GET['action'] = $_GET['action'] ?? "";
$dispatcher = new Dispatcher($_GET['action']);
$dispatcher->run();