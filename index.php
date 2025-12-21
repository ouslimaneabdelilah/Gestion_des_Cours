<?php
session_start();
require_once "./Core/kernel/autoloading.php";
use Core\Kernel;
$kernel = new Kernel();

$kernel->handle();
