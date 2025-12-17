<?php
session_start();
require_once "./Core/kernel/Autoloading.php";
use Core\Router;
$router = new Router();
require "./routes/web.php";

$router->run();
