<?php

require 'vendor/autoload.php';
require 'header.php';

use netvod\dispatch\Dispatcher;

session_start();
$_GET['action'] = $_GET['action'] ?? "";
$dispatcher = new Dispatcher($_GET['action']);
$dispatcher->run();