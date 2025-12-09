<?php
session_start();
$page_title = "Supprimer la Section";
require_once '../../database/config/config.php';
require_once '../../core/sections.php';
include_once '../layout/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: sections_list.php");
    exit();
}

$id = $_GET['id'];
$section = getSectionById($mysqli, $id);

if (!$section) {
    header("Location: sections_list.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    deleteSection($mysqli, $id);
    $_SESSION["message"] = "Succes! La section est supprimer.";
    header("Location: sections_list.php");
    exit();
}
?>

<div class="container mx-auto px-4 sm:px-8 max-w-lg">
    <div class="py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold leading-tight text-center">Confirmer la Suppression</h2>
            <p class="text-gray-600 mt-4 text-center">
                Êtes-vous sûr de vouloir supprimer cette section ? Cette action est irréversible.
            </p>
            <div class="mt-6 bg-gray-50 p-4 rounded-lg border">
                <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($section['title']) ?></p>
                <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($section['content']) ?></p>
            </div>
            <div class="mt-8 flex justify-center gap-4">
                <a href="sections_list.php" class="px-6 py-2 border rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100">Annuler</a>
                <form action="sections_delete.php?id=<?= $id ?>" method="POST">
                    <button type="submit" class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>