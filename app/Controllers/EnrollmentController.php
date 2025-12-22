<?php

namespace App\Controllers;

use App\Repositories\EnrollmentRepository;

class EnrollmentController {
    private $repo;

    public function __construct(EnrollmentRepository $repo) {
        $this->repo = $repo;
    }

    public function toggleEnroll($courseId) {
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userId = $_SESSION['user_id'];

        if ($this->repo->isUserEnrolled($userId, $courseId)) {
            $this->repo->unenroll($userId, $courseId);
            $_SESSION['message'] = "Desinscription reussie.";
        } else {
            $this->repo->enroll($userId, $courseId);
            $_SESSION['message'] = "Inscription reussie au courss.";
        }

        header("Location: /courses");
        exit();
    }
}