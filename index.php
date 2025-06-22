<?php
session_start();
// error_reporting(E_ALL);
ini_set('display_errors', 1);

$controller = $_GET['c'] ?? 'Dashboard';
$method = $_GET['m'] ?? 'index';

require_once "controller/Controller.class.php";
require_once "controller/$controller.class.php";

$c = new $controller;
$c->$method();
?>