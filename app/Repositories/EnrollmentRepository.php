<?php

namespace App\Repositories;

use App\Models\Enrollment;

class EnrollmentRepository
{
    private $pdo;
    public function __construct(\PDO $pdo)
    {

        $this->pdo = $pdo;
    }
    public function enroll($userId, $courseId)
    {

        $sql = "INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$userId, $courseId]);
    }
    public function unenroll($userId, $courseId)
    {

        $sql = "DELETE FROM enrollments WHERE user_id = ? AND course_id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$userId, $courseId]);
    }
    public function isUserEnrolled($userId, $courseId)
    {

        $sql = "SELECT id FROM enrollments WHERE user_id = ? AND course_id = ?";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([$userId, $courseId]);

        return $stmt->fetch() !== false;
    }
    public function getTotalEnrollments()
    {

        return $this->pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn();
    }

    public function getEnrollmentsThisYear()
    {

        $sql = "SELECT u.username, c.title, e.enrolled_at FROM enrollments e JOIN users u ON e.user_id = u.id JOIN courses c ON e.course_id = c.id WHERE YEAR(e.enrolled_at) = YEAR(CURDATE())";

        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}
