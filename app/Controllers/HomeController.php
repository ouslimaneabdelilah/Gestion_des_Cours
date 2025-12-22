<?php
namespace App\Controllers;

class HomeController {
    public function welcome() {
        include "./resources/views/home/welcome.php";
    }
}