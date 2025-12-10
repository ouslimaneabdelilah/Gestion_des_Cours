<?php
require_once "./app/Models/Course.php";
class CourseController
{
    private $courseModel;
    private $levels = ["Débutant", "Intermédiaire", "Avancé"];

    public function __construct()
    {
        $this->courseModel = new Course();
    }


    // affichier tout les course
    public function index()
    {

        $courses = $this->courseModel->all();
        include "./resources/views/courses/courses_list.php";
    }


    // envoyer a la page de create
    public function create()
    {

        $levels = ["Débutant", "Intermédiaire", "Avancé"];
        include "./resources/views/courses/courses_create.php";
    }

    // ajouter un course 
    public function store()
    {
        print_r($_POST);
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



            $this->courseModel->create($title, $description, $level, $imageName);
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
        $course = $this->courseModel->find($id);
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
        $course = $this->courseModel->find($id);
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
            $imageName = $course["image"];
        }

        $this->courseModel->update($id, $title, $description, $level, $imageName);
        $_SESSION["message"] = "Modification réussie.";
        header("Location: /courses");
        exit;
    }


    public function confirmDelete($id)
    {
        $course = $this->courseModel->find($id);
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

        $this->courseModel->delete($id);

        $_SESSION['message'] = "Succès! Le cours est supprimé.";
        header("Location: /courses");
        exit();
    }
}
