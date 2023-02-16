<?php

require 'vendor/autoload.php';

use crazy\dispatch\Dispatcher;

$_GET['action'] = $_GET['action'] ?? "";
$dispatcher = new Dispatcher($_GET['action']);
$dispatcher->run();