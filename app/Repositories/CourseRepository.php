<?php
namespace App\Repositories;

use App\Models\Course;
use Core\Database\EntityManager;

class CourseRepository {
    private $em;
    private $pdo;

    public function __construct(\PDO $pdo, EntityManager $em) {
        $this->pdo = $pdo;
        $this->em = $em;
    }

    public function all() {
        return $this->em->findAll(Course::class);
    }

    public function insert(Course $course) {
        return $this->em->save($course);
    }
    
    public function delete($id) {
        return $this->em->delete($id, Course::class);
    }
    
    public function find($id) {
        return $this->em->find($id, Course::class);
    }
    
    public function update(Course $course) {
        return $this->em->update($course);
    }    
    public function getSections($courseId) {
        $sql = "SELECT c.title as course_title, s.* FROM sections s
                INNER JOIN courses c ON s.course_id = c.id
                WHERE s.course_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>