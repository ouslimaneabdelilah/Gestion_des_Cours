<?php
require_once "./app/Models/Course.php";
class CourseController
{
    private $courseModel;
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
        include "./resources/views/courses/courses_create.php";
    }

    // ajouter un course 
    public function store($data)
    {
        $this->courseModel->create($data["title"], $data["description"], $data["level"]);
        header("Location:./resources/views/courses/courses_list.php");
    }

    // envoyer a la page d'edit
    public function edit($id)
    {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: /courses");
            exit();
        }
        $id = $_GET['id'];
        $course = $this->courseModel->find($id);
        $levels = ["Débutant", "Intermédiaire", "Avancé"];
        include "./resources/views/courses/courses_edit.php";
    }
    // update un course
    public function update($id, $data)
    {
        $levels = ["Débutant", "Intermédiaire", "Avancé"];
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location:/courses");
            exit();
        }
        $id = $_POST["id"];
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

        $this->courseModel->update($id, $title, $description, $level);
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

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /courses");
            exit();
        }

        $id = $_POST['course_id'] ?? null;

        if (!$id) {
            $_SESSION['message'] = "Erreur: Aucun cours sélectionné.";
            header("Location: /courses");
            exit();
        }

        $this->courseModel->delete($id);

        $_SESSION['message'] = "Succès! Le cours est supprimé.";
        header("Location: /courses");
        exit();
    }
}
