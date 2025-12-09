<?php
session_start();
$page_title = "Sections du Cours";
require_once '../../database/config/config.php';
require_once '../../core/sections.php';
require_once '../../core/courses.php';
include_once '../layout/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../courses/courses_list.php");
    exit();
}

$course_id = $_GET['id'];
$sections = getSectionsByCourse($mysqli, $course_id);
$course_title = !empty($sections) ? $sections[0]['course_title'] : "Cours non trouvé";

?>

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div>
            <a href="../courses/courses_list.php" class="text-indigo-600 hover:text-indigo-900 mb-4 inline-block">&larr; Retour à la liste des cours</a>
            <h2 class="text-2xl font-semibold leading-tight">Sections pour le cours : "<?= htmlspecialchars($course_title) ?>"</h2>
        </div>
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Position</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Titre</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Contenu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sections)) : ?>
                            <?php foreach ($sections as $section) : ?>
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= htmlspecialchars($section['position']) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= htmlspecialchars($section['title']) ?></p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"><?= htmlspecialchars($section['content']) ?></p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center py-10">
                                    <p class="text-gray-500">Aucune section trouvée pour ce cours.</p>
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