<?php
require_once "./app/Database/Database.php";
class Course{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }
    public function all(){
        $stm = $this->pdo->prepare("SELECT * FROM courses");
        $stm->execute();
        return $stm->fetchAll();
    }
    public function find($id){
        $stm = $this->pdo->prepare("SELECT * FROM courses WHERE id = :id");
        $stm->bindParam(":id",$id,PDO::PARAM_INT);
        $stm->execute();
        return $stm->fetch();
    }
    public function create($title, $description, $level){
        $stm = $this->pdo->prepare("INSERT INTO courses (title, description, level) VALUES (:title, :description, :level)");
        $stm->bindParam(":title",$title,PDO::PARAM_STR);
        $stm->bindParam(":description",$description,PDO::PARAM_STR);
        $stm->bindParam(":level",$level,PDO::PARAM_STR);
        return $stm->execute();
    }
    public function update($id,$title,$description,$level){
        $stm = $this->pdo->prepare("UPDATE courses SET title =:title, description=:description, level = :level WHERE id=:id");
        $stm->bindParam(":id",$id,PDO::PARAM_STR);
        $stm->bindParam(":title",$title,PDO::PARAM_STR);
        $stm->bindParam(":description",$description,PDO::PARAM_STR);
        $stm->bindParam(":level",$level,PDO::PARAM_STR);
        return $stm->execute();;
    }
}
?>