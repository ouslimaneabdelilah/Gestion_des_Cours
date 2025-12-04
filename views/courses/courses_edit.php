<?php
$page_title = "Modifier le Cours";
include_once '../layout/header.php';
require_once '../../database/config/config.php';
require_once '../../core/courses.php';
session_start();
$levels = ["Débutant","Intermédiaire","Avancé"];

if(!isset($_GET['id']) ||empty($_GET['id'])){
    header("Location: courses_list.php");
    exit();
}
$id= $_GET['id'];
$course = getCoursebyId($mysqli,$id);

if(empty($course)){
    header("Location: courses_edit.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $title = htmlspecialchars($_POST["title"]);
    $description = htmlspecialchars($_POST["description"]);
    $level = htmlspecialchars($_POST["level"]);
    editCourse($mysqli,$id,$title,$description,$level);
    $_SESSION["message"] = "la modification est Succes";
    header("Location: courses_list.php");
}
?>

<div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Modifier le Cours</h2>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="#" method="POST">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3">
                                <label for="title" class="block text-sm font-medium text-gray-700">Titre du cours</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" value="<?= $course["title"] ?>" name="title" id="title" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md"><?= $course["description"] ?></textarea>
                            </div>
                        </div>

                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700">Niveau</label>
                            <select id="level" name="level" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <?php foreach($levels as $level):?>
                                    <option value="<?= $level ?>" <?= $level === $course["level"] ? "selected" : ""?>><?= $level ?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="courses_list.php" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>
