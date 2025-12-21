<?php
namespace App\Repositories;

use Core\Database\EntityManager;
use App\Models\User;

class UserRepository {
    private $em;
    private $pdo;

    public function __construct(\PDO $pdo, EntityManager $em) {
        $this->pdo = $pdo;
        $this->em = $em;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, User::class);
        return $stmt->fetch();
    }

    public function save(User $user) {
        return $this->em->save($user);
    }
}