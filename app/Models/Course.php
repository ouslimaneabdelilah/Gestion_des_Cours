<?php
require_once "./app/Database/Database.php";
class Course
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }
    public function all()
    {
        $stm = $this->pdo->prepare("SELECT * FROM courses");
        $stm->execute();
        return $stm->fetchAll();
    }
    public function find($id)
    {
        $stm = $this->pdo->prepare("SELECT * FROM courses WHERE id = :id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch();
    }
    public function create($title, $description, $level, $image)
    {
        $stm = $this->pdo->prepare("INSERT INTO courses (title, description, level,image) VALUES (:title, :description, :level,:image)");
        $stm->bindParam(":title", $title, PDO::PARAM_STR);
        $stm->bindParam(":description", $description, PDO::PARAM_STR);
        $stm->bindParam(":level", $level, PDO::PARAM_STR);
        $stm->bindParam(":image", $image, PDO::PARAM_STR);
        return $stm->execute();
    }
    public function update($id, $title, $description, $level, $image)
    {
        $stm = $this->pdo->prepare("UPDATE courses SET title =:title, description=:description, level = :level, image= :image WHERE id=:id");
        $stm->bindParam(":id", $id, PDO::PARAM_STR);
        $stm->bindParam(":title", $title, PDO::PARAM_STR);
        $stm->bindParam(":description", $description, PDO::PARAM_STR);
        $stm->bindParam(":image", $image, PDO::PARAM_STR);

        $stm->bindParam(":level", $level, PDO::PARAM_STR);
        return $stm->execute();;
    }
    public function delete($id)
    {
        $stm = $this->pdo->prepare("DELETE FROM courses WHERE id = :id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        return $stm->execute();;
    }
    public function getSections($courseId)
    {
        $stm = $this->pdo->prepare("SELECT * FROM sections WHERE course_id = :course_id");
        $stm->bindParam(":course_id", $courseId, PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetchAll();
    }
}
