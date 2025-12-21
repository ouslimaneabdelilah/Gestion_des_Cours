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
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $user = new User($data['username'], $data['email'], $hashedPassword);
        return $this->userRepo->save($user);
    }

    public function login($email, $password) {
        $user = $this->userRepo->findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['role'] = $user->role;
            return true;
        }
        return false;
    }

    public function logout() {
        session_destroy();
    }
}