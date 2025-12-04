<?php
session_start();
$page_title = "Modifier la Section";
require_once '../../database/config/config.php';
require_once '../../core/courses.php';
require_once '../../core/sections.php';
include_once '../layout/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: sections_list.php");
    exit();
}

$id = $_GET['id'];
$section = getSectionById($mysqli, $id);
$courses = getAllCourses($mysqli);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST["course_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $position = $_POST["position"];

    if (!empty($course_id) && !empty($title) && !empty($content) && isset($position)) {
        $countPosition= checkPostion($mysqli,$position,$course_id,$id);
        if($countPosition === True){
            
            updateSection($mysqli, $id, $course_id, $title, $content, $position);
            $_SESSION["message"] = "La  modification de section est sucess.";
            header("Location: sections_list.php");
            exit();
        }else{
            $error_message = "S'il vous plait le position deja affecte pour un other course";
        }
    } else {
        $error_message = "Tous les champs sont requis.";
    }
}

?>

<div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-8">
        <h2 class="text-2xl font-semibold leading-tight">Modifier la Section</h2>
        <?php if (isset($error_message)) : ?>
            <div class='bg-red-100 border mt-4 mb-3 border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                <strong class='font-bold'>Attention!</strong>
                <span class='block sm:inline'> <?= htmlspecialchars($error_message) ?></span>
            </div>
        <?php endif; ?>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="sections_edit.php?id=<?= $id ?>" method="POST">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div>
                            <label for="course_id" class="block text-sm font-medium text-gray-700">Cours</label>
                            <select id="course_id" name="course_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <?php foreach ($courses as $course) : ?>
                                    <option value="<?= $course['id'] ?>" <?= ($course['id'] == $section['course_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($course['title']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Titre de la section</label>
                            <input type="text" name="title" id="title" value="<?= htmlspecialchars($section['title']) ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Contenu</label>
                            <textarea id="content" name="content" rows="3" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"><?= htmlspecialchars($section['content']) ?></textarea>
                        </div>
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                            <input type="number" name="position" id="position" value="<?= htmlspecialchars($section['position']) ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="sections_list.php" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Annuler</a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>