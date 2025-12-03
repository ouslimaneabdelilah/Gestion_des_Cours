<?php
$page_title = "Créer un nouveau cours";
include_once '../layout/header.php';
require_once '../../database/config/config.php';
require_once '../../core/courses.php';
$levels = ["Débutant", "Intermédiaire", "Avancé"];
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $level = $_POST["level"];
    if (!empty($title) && !empty($description) && !empty($level)) {
        if (createCourse($mysqli, $title, $description, $level)) {
            $_SESSION["message"] = "Ajouter Le course est success.";
            header("Location: sections_list.php");
            exit();
        } else {
            $error_message = "Erreur lors de la création de le course.";
        }
    } else {
        $error_message = "Tous les champs sont requis.";
    }
}

?>

<div class="container mx-auto px-4 sm:px-8 max-w-3xl">
    <div class="py-8">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">Créer un nouveau cours</h2>
        </div>
        <?php if (isset($error_message)) : ?>
            <div class='bg-red-100 border mt-4 border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>
                <strong class='font-bold'>Attention!</strong>
                <span class='block sm:inline'> <?= htmlspecialchars($error_message) ?></span>
            </div>
        <?php endif; ?>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="#" method="POST">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3">
                                <label for="title" class="block text-sm font-medium text-gray-700">Titre du cours</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text" name="title" id="title" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300" placeholder="e.g. Introduction à PHP">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Décrivez le contenu du cours..."></textarea>
                            </div>
                        </div>

                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700">Niveau</label>
                            <select id="level" name="level" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>-- Sélectionnez un niveau --</option>
                                <?php foreach ($levels as $level) : ?>
                                    <option value="<?= $level ?>"><?= $level ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="courses_list.php" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ajouter le Cours
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>