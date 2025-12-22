<?php

namespace App\Controllers;

use App\Models\Course;
use App\Repositories\CourseRepository;
use App\Repositories\EnrollmentRepository;
class CourseController
{
    private $enrollmentRepo;
    private $repo;
    private $levels = ["Débutant", "Intermédiaire", "Avancé"];


    public function __construct(CourseRepository $repo,EnrollmentRepository $enrollmentRepo)
    {
        $this->repo = $repo;
        $this->enrollmentRepo = $enrollmentRepo;
    }


    // affichier tout les course
    public function index()
    {

        $courses = $this->repo->all(Course::class);
        $enrollmentRepo = $this->enrollmentRepo;
        include "./resources/views/courses/courses_list.php";
    }


    public function create()
    {

        $levels = $this->levels;
        include "./resources/views/courses/courses_create.php";
    }
    // show sections 
    public function showSections($id)
    {
        if (!$id) {
            header("Location: /courses");
            exit();
        }
        $sections = $this->repo->getSections($id);
        include "./resources/views/sections/sections_by_course.php";
    }

    // ajouter un course 
    public function store()
    {

        $levels = $this->levels;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST["title"]);
            $description = trim($_POST["description"]);
            $level = trim($_POST["level"]);
            if (empty($title) || empty($description) || empty($level)) {
                $error_message = "Tous les champs sont requis.";
                include "./resources/views/courses/courses_create.php";
                return;
            }

            if (!in_array($level, $levels)) {
                $error_message = "Level qui choisir n'est pas exect.";
                include "./resources/views/courses/courses_create.php";
                return;
            }

            $imageName = "image.png";

            if (!empty($_FILES["image"]["name"])) {

                $imageName = uniqid() . "_" . $_FILES["image"]["name"];
                $destination = "./public/uploads/" . $imageName;

                move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
            }


            $course = new Course($title, $description, $level, $imageName);
            $this->repo->insert($course);
            $_SESSION["message"] = "Le cours a été ajouté avec succès.";
            header("Location: /courses");
            exit();
        }
    }

    // envoyer a la page d'edit
    public function edit($id)
    {
        if (!$id) {
            header("Location: /courses");
            exit();
        }
        $course = $this->repo->find($id);  
        if (!$course) {
            $_SESSION['message'] = "Cours introuvable.";
            header("Location: /courses");
            exit();
        }
        $levels = $this->levels;
        include "./resources/views/courses/courses_edit.php";
    }

    // update un course
    public function update($id)
    {
        $course = $this->repo->find($id, Course::class);
        $levels = $this->levels;
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location:/courses");
            exit();
        }
        $title = trim($_POST["title"]);
        $description = trim($_POST["description"]);
        $level = trim($_POST["level"]);

        if ($title === "" || $description === "" || $level === "") {
            $error_message = "Tous les champs sont requis.";
            include "./resources/views/courses/courses_edit.php";
            return;
        }

        if (!in_array($level, $levels)) {
            $error_message = "Le niveau sélectionné est incorrect.";
            include "./resources/views/courses/courses_edit.php";
            return;
        }
        if (!empty($_FILES["image"]["name"])) {

            $imageName = uniqid() . "_" . $_FILES["image"]["name"];
            $destination = "./public/uploads/" . $imageName;

            move_uploaded_file($_FILES["image"]["tmp_name"], $destination);
        } else {
            $imageName = $course->image;
        }
        $courseIns = new Course($id, $title, $description, $level, $imageName);
        $this->repo->update($courseIns);
        $_SESSION["message"] = "Modification réussie.";
        header("Location: /courses");
        exit;
    }


    public function confirmDelete($id)
    {
        $course = $this->repo->find($id);  
        if (!$course) {
            $_SESSION['message'] = "Cours introuvable.";
            header("Location: /courses");
            exit;
        }
        include "./resources/views/courses/courses_delete.php";
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /courses");
            exit();
        }

        if (!$id) {
            header("Location: /courses");
            exit();
        }

        $this->repo->delete($id);
        $_SESSION['message'] = "Succès! Le cours est supprimé.";
        header("Location: /courses");
        exit();
    }
}
