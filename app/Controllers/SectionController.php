<?php
namespace App\Controllers;

use App\Models\Section;
use App\Models\Course;
use App\Repositories\SectionRepository;
use App\Repositories\CourseRepository;

class SectionController
{
    private $sectionRepo;
    private $courseRepo;

    public function __construct(SectionRepository $sectionRepo, CourseRepository $courseRepo)
    {
        $this->sectionRepo = $sectionRepo;
        $this->courseRepo = $courseRepo;
    }

    public function index()
    {
        $sections = $this->sectionRepo->getAllWithCourse();
       
        include "./resources/views/sections/sections_list.php";
    }

    public function create()
    {
        $courses = $this->courseRepo->all();
        include "./resources/views/sections/sections_create.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /sections");
            exit();
        }

        $course_id = $_POST["course_id"];
        $title = $_POST["title"];
        $content = $_POST["content"];
        $position = $_POST["position"];

        if ($position === "" || $title === "" || $content === "" || $course_id === "") {
            $courses = $this->courseRepo->all();
            $error_message = "Tous les champs sont requis.";
            include "./resources/views/sections/sections_create.php";
            return;
        }

        if ($this->sectionRepo->checkPosition(0, $course_id, $position)) {
            $courses = $this->courseRepo->all();
            $error_message = "La position est déjà occupée pour ce cours.";
            include "./resources/views/sections/sections_create.php";
            return;
        }

        $section = new Section($id=null, $course_id,$title,$content, $position);
        $section->content = $content;
        $this->sectionRepo->insert($section);
        $_SESSION["message"] = "La section a été créée avec succès.";
        header("Location: /sections");
        exit();
    }

    public function edit($id)
    {
        if (!$id) {
            header("Location: /sections");
            exit();
        }

        $section = $this->sectionRepo->getsectionWithCourse($id);
        $courses = $this->courseRepo->all();

        if (!$section) {
            $_SESSION['message'] = "Section introuvable.";
            header("Location: /sections");
            exit();
        }

        include "./resources/views/sections/sections_edit.php";
    }

    public function update($id)
    {
        if (!$id || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /sections");
            exit();
        }

        $title = $_POST["title"];
        $content = $_POST["content"];
        $position = $_POST["position"];
        $course_id = $_POST["course_id"];

        if ($this->sectionRepo->checkPosition($id, $course_id, $position)) {
            $section = $this->sectionRepo->getsectionWithCourse($id);
            $courses = $this->courseRepo->all();
            $error_message = "S'il vous plaît, la position est déjà affectée.";
            include "./resources/views/sections/sections_edit.php";
            return;
        }

        $section = new Section($id, $course_id,$title,$content, $position); 
        $this->sectionRepo->update($section);

        $_SESSION["message"] = "La modification de section est réussie.";
        header("Location: /sections");
        exit();
    }

    public function confirmDelete($id)
    {
        $section = $this->sectionRepo->find($id);
        if (!$section) {
            $_SESSION['message'] = "Section introuvable.";
            header("Location: /sections");
            exit();
        }
        include "./resources/views/sections/sections_delete.php";
    }

    public function destroy($id)
    {
        if (!$id || $_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /sections");
            exit();
        }
        $this->sectionRepo->delete($id);
        $_SESSION["message"] = "Succès! La section est supprimée.";
        header("Location: /sections");
        exit();
    }
}