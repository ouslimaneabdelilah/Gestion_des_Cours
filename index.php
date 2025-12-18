<?php
session_start();
require_once "./Core/kernel/Autoloading.php";
use Core\Kernel;
$kernel = new Kernel();

$kernel->handle();
