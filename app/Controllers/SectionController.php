<?php
require_once "./app/Models/Section.php";
require_once "./app/Models/Course.php";
require_once "./app/Database/Database.php";

class SectionController
{
    private $sectionModel;
    private $courseModal;
    public function __construct()
    {
        $db = new Database();
        $pdo = $db->getConnection();
        $this->sectionModel = new Section($pdo);
        $this->courseModal = new Course($pdo);
    }

    public function index()
    {
        $sections = $this->sectionModel->all();
        include "./resources/views/sections/sections_list.php";
    }

    public function create()
    {
        $courses = $this->courseModal->all();
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
        $this->sectionModel->create($course_id, $title, $content, $position);
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
        print_r($course_id);
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
