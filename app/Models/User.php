<?php
namespace App\Models;

class User {
    public $id;
    public $username;
    public $email;
    public $password;
    public $role;

    public function __construct($username = null, $email = null, $password = null, $role = 'Student') {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
}