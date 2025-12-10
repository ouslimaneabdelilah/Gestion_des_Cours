<?php
session_start();
require "./core/router.php";
$router = new Router();
require "./routes/web.php";

$router->run();
