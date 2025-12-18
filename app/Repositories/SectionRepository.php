<?php
namespace App\Dao;
use App\Dao\BaseDAO;
use App\Models\Section;
class SectionDAO extends BaseDAO{
    public function __construct($pdo)
    {
        parent::__construct($pdo, Section::class, "sections");
    }
    public function checkPostion($id, $course_id, $position)
    {
        $stm = $this->pdo->prepare("SELECT id FROM sections WHERE course_id= :course_id AND position =:position AND id!=:id");
        $stm->bindParam(":id", $id, \PDO::PARAM_INT);
        $stm->bindParam(":course_id", $course_id, \PDO::PARAM_INT);
        $stm->bindParam(":position", $position, \PDO::PARAM_INT);
        return $stm->execute();
    }
}
?>