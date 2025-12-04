<?php
session_start();
$page_title = "Liste des Sections";
require_once '../../database/config/config.php';
require_once '../../core/sections.php';
include_once '../layout/header.php';

$sections = getAllSections($mysqli);

if (isset($_SESSION["message"])) {
    echo "<div class='bg-green-100 border mb-2 border-green-400 text-green-700 px-4 py-3 rounded relative' role='alert'>
            <strong class='font-bold'>Succès !</strong>
            <span class='block sm:inline'> " . htmlspecialchars($_SESSION['message']) . "</span>
        </div>";
    unset($_SESSION["message"]);
}
?>

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-semibold leading-tight">Liste des Sections</h2>
            <a href="sections_create.php" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus"></i> Ajouter une Section
            </a>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Titre</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cours Associé</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Position</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sections)) : ?>
                            <?php foreach ($sections as $section) : ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= htmlspecialchars($section['title']) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= htmlspecialchars($section['course_title']) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= htmlspecialchars($section['position']) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <a href="sections_edit.php?id=<?= $section['id'] ?>" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                        <a href="sections_delete.php?id=<?= $section['id'] ?>" class="text-red-600 hover:text-red-900 ml-4">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center py-10">
                                    <p class="text-gray-500">Aucune section trouvée.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once '../layout/footer.php'; ?>