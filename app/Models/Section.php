<?php
class Section
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function all()
    {
        $stm = $this->pdo->prepare("SELECT s.*, c.title as course_title FROM sections s JOIN courses c ON s.course_id = c.id ORDER BY c.title, s.position");
        $stm->execute();
        return $stm->fetchAll();
    }
    public function find($id)
    {
        $stm = $this->pdo->prepare("SELECT * FROM sections WHERE id = :id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch();
    }
    public function create($course_id, $title, $content, $position)
    {
        $stm = $this->pdo->prepare("INSERT INTO sections (course_id, title, content, position) VALUES (:course_id, :title, :content, :position)");
        $stm->bindParam(":course_id", $course_id, PDO::PARAM_INT);
        $stm->bindParam(":title", $title, PDO::PARAM_STR);
        $stm->bindParam(":content", $content, PDO::PARAM_STR);
        $stm->bindParam(":position", $position, PDO::PARAM_STR);
        return $stm->execute();
    }
    public function update($id, $course_id, $title, $content, $position)
    {
        $stm = $this->pdo->prepare("UPDATE sections SET course_id =:course_id, title =:title, content =:content, position=:position WHERE id=:id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->bindParam(":course_id", $course_id, PDO::PARAM_INT);
        $stm->bindParam(":title", $title, PDO::PARAM_STR);
        $stm->bindParam(":content", $content, PDO::PARAM_STR);
        $stm->bindParam(":position", $position, PDO::PARAM_STR); 
        return $stm->execute();
    }

    public function checkPostion($id, $course_id, $position)
    {
        $stm = $this->pdo->prepare("SELECT id FROM sections WHERE course_id= :course_id AND position =:position AND id!=:id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->bindParam(":course_id", $course_id, PDO::PARAM_INT);
        $stm->bindParam(":position", $position, PDO::PARAM_INT);
        return $stm->execute();
    }

    public function delete($id)
    {
        $stm = $this->pdo->prepare("DELETE FROM sections WHERE id = :id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        return $stm->execute();;
    }
}
