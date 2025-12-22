<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;

class AuthService {
    private $userRepo;

    public function __construct(UserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function register($data) {
        $username = trim($data['username'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $confirm = $data['confirm_password'] ?? '';
        
        if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
            $_SESSION['error'] = "Tous les champs sont requis.";
            return false;
        }
        
        if ($password !== $confirm) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
            return false;
        }
        
        if (strlen($password) < 6) {
            $_SESSION['error'] = "Le mot de passe doit contenir au moins 6 caractères.";
            return false;
        }
        
        if ($this->userRepo->findByEmail($email)) {
            $_SESSION['error'] = "Cette adresse email est déjà utilisée.";
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($username, $email, $hashedPassword);
        
        if ($this->userRepo->save($user)) {
            return true;
        }
        
        $_SESSION['error'] = "Une erreur s'est produite lors de l'inscription.";
        return false;
    }

    public function login($email, $password) {
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = "Email et mot de passe requis.";
            return false;
        }

        $user = $this->userRepo->findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['role'] = $user->role;
            return true;
        }
        
        $_SESSION['error'] = "Email ou mot de passe incorrect.";
        return false;
    }

    public function logout() {
        session_destroy();
    }
}