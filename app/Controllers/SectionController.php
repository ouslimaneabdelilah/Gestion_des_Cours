<?php
require_once "./app/Models/Section.php";
require_once "./app/Models/Course.php";
class SectionController
{
    private $sectionModel;
    private $courseModal;
    public function __construct()
    {
        $this->sectionModel = new Section();
        $this->courseModal = new Course();
    }

    public function index()
    {
        $sections = $this->sectionModel->all();
        include "./resources/views/sections/sections_list.php";
    }

    public function create()
    {
        include "./resources/views/sections/sections_create.php";
    }
    public function store($data)
    {
        $this->sectionModel->create($data["course_id"], $data["title"], $data["content"], $data["position"]);
        header("Location:./resources/views/sections/sections_list.php");
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
        if ($course_id === "" || $content === "" || $title=== "" || $position === "") {
            $error_message = "Tous les champs sont requis.";
            header("Location: /sections");
            exit();
        }
        print_r($course_id);
        $this->sectionModel->update($id, $course_id, $title, $content, $position);
        $_SESSION["message"] = "La  modification de section est sucess.";
        header("Location: /sections");
    }

    public function destroy($id)
    {
        $this->sectionModel->delete($id);
        header("Location:./resources/views/sections/sections_list.php");
    }
}
