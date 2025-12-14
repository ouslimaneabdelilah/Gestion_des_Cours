<?php 
require_once "basedao.php";
require_once "./app/Models/Course.php";
class CourseDAO extends BaseDAO{
    public function __construct($pdo)
    {
        return parent::__construct($pdo, "Course", "courses");
    }
    public function getSections($courseId) {
        $sql = "SELECT c.title as course_title, s.* FROM sections s 
                INNER JOIN courses c ON s.course_id = c.id
                WHERE s.course_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS,"Course");
    }
}
?>