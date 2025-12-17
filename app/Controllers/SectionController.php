<?php
namespace App\Controllers;
use App\Database\Database;
use App\Models\Course;
use App\Models\Section;
use App\Dao\SectionDAO;
use App\Dao\CourseDAO;
class SectionController
{
    private $sectionModel;
    private $courseModal;
    public function __construct()
    {
        $db = new Database();
        $pdo = $db->getConnection();
        $this->sectionModel = new SectionDAO($pdo);
        $this->courseModal = new CourseDAO($pdo);
        
    }

    public function index()
    {
        $sections = $this->sectionModel->findAll();
        include "./resources/views/sections/sections_list.php";
    }

    public function create()
    {
        $courses = $this->courseModal->findAll();
        include "./resources/views/sections/sections_create.php";
    }
    public function store()
    {
        $course_id = $_POST["course_id"];
        $title = $_POST["title"];
        $content = $_POST["content"];
        $position = $_POST["position"];
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /sections");
            exit();
        }
        if($position === "" || $title === "" || $content === "" || $course_id === ""){
            $error_message = "Tous les champs sont requis.";
            return;

        }
        $_SESSION["message"] = "La section a été créée avec succès.";
        $section = new Section($course_id, $title, $content, $position);
        $this->sectionModel->save($section);
        header("Location:/sections");
    }

    public function edit($id)
    {
        if (!$id) {
            header("Location: /sections");
            exit();
        }
        $section = $this->sectionModel->find($id);
        $courses = $this->courseModal->all();
        if (!$section) {
            $_SESSION['message'] = "Section introuvable.";
            header("Location: /sections");
            exit();
        }

        include "./resources/views/sections/sections_edit.php";
    }
    public function update($id)
    {
        $course_id = $_POST["course_id"];
        $content = $_POST["content"];
        $position = $_POST["position"];
        $title = $_POST["title"];
        $course_id = $_POST["course_id"];
        if (!$id) {
            header("Location: /sections");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /sections");
            exit();
        }
        $checkPosition = $this->sectionModel->checkPostion($id, $course_id, $position);
        if ($checkPosition) {
            $error_message = "S'il vous plait le position deja affecte pour un other course";
        }
        if ($course_id === "" || $content === "" || $title === "" || $position === "") {
            $error_message = "Tous les champs sont requis.";
            header("Location: /sections");
            exit();
        }
        $this->sectionModel->update($id, $course_id, $title, $content, $position);
        $_SESSION["message"] = "La  modification de section est sucess.";
        header("Location: /sections");
    }


    public function confirmDelete($id)
    {
        $section = $this->sectionModel->find($id);
        if (!$section) {
            $_SESSION['message'] = "Section introuvable.";
            header("Location: /section");
            exit;
        }
        include "./resources/views/sections/sections_delete.php";
    }


    public function destroy($id)
    {
        if (!$id || $_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /sections");
            exit();
        }
        $_SESSION["message"] = "Succes! La section est supprimer.";
        $this->sectionModel->delete($id);
        header("Location:/sections");
    }
}
