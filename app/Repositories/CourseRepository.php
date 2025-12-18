<?php 
namespace App\Dao;
use App\Dao\BaseDAO;
use App\Models\Course;
class CourseDAO extends BaseDAO{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Course::class, "courses");
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