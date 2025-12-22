<?php
namespace App\Controllers;

use App\Services\AuthService;

class AuthController {
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function showRegister() {
        include "./resources/views/auth/register.php";
    }

    public function register() {
        if ($this->authService->register($_POST)) {
            $_SESSION['message'] = "Compte créé, vous pouvez vous connecter.";
            header("Location: /login");
            exit;
        }
        $_SESSION['error'] = "Impossible de créer le compte (email déjà utilisé ou données invalides).";
        header("Location: /register");
        exit;
    }

    public function showLogin() {
        include "./resources/views/auth/login.php";
    }

    public function login() {
        if ($this->authService->login($_POST['email'], $_POST['password'])) {
            header("Location: /courses");
            exit;
        } else {
            $_SESSION['error'] = "Email ou mot de passe incorrect.";
            header("Location: /login");
            exit;
        }
    }

    public function logout() {
        $this->authService->logout();
        header("Location: /login");
        exit;
    }
}