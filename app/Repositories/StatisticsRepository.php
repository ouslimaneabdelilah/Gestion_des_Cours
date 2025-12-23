<?php

namespace App\Repositories;

class StatisticsRepository {
    private $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function nombreTotaldeCours() {
        return $this->pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
    }

    public function nombreUsers() {
        return $this->pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    }

    public function totalInsc() {
        return $this->pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn();
    }

    public function inscriptionsParCours() {
        $sql = "SELECT c.title, COUNT(e.id) as total 
                FROM courses c 
                LEFT JOIN enrollments e ON c.id = e.course_id 
                GROUP BY c.id";
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function popularCourse() {
        $sql = "SELECT c.title, COUNT(e.id) as total 
                FROM courses c 
                LEFT JOIN enrollments e ON c.id = e.course_id 
                GROUP BY c.id 
                ORDER BY total DESC LIMIT 1";
        return $this->pdo->query($sql)->fetch(\PDO::FETCH_ASSOC);
    }

    public function moyenneSectionsCours() {
        $sql = "SELECT AVG(section_count) FROM (
                    SELECT COUNT(*) as section_count FROM sections GROUP BY course_id
                ) as subquery";
        return round($this->pdo->query($sql)->fetchColumn(), 2);
    }

    public function coursRiche() {
        $sql = "SELECT c.title, COUNT(s.id) as section_count 
                FROM courses c 
                JOIN sections s ON c.id = s.course_id 
                GROUP BY c.id 
                HAVING section_count > 5";
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function inscriptionsCetteAnne() {
        $sql = "SELECT u.username, c.title, e.enrolled_at 
                FROM enrollments e 
                JOIN users u ON e.user_id = u.id 
                JOIN courses c ON e.course_id = c.id 
                WHERE YEAR(e.enrolled_at) = YEAR(CURDATE())";
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function coursSansInscriptions() {
        $sql = "SELECT c.title FROM courses c 
                LEFT JOIN enrollments e ON c.id = e.course_id 
                WHERE e.id IS NULL";
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function dernieresInscriptions() {
        $sql = "SELECT u.username, c.title, e.enrolled_at 
                FROM enrollments e 
                JOIN users u ON e.user_id = u.id 
                JOIN courses c ON e.course_id = c.id 
                ORDER BY e.enrolled_at DESC LIMIT 5";
        return $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
}