<?php
$page_title = "Tableau de Bord Admin";
include_once './resources/views/layouts/header.php';

?>

<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Tableau de Bord Administratif</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Total Cours</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $totalCourses ?></p>
                    </div>
                    <div class="text-4xl text-blue-500 opacity-20">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Utilisateurs</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $totalUsers ?></p>
                    </div>
                    <div class="text-4xl text-green-500 opacity-20">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Inscriptions</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $totalEnrollments ?></p>
                    </div>
                    <div class="text-4xl text-purple-500 opacity-20">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold uppercase">Moy. Sections/Cours</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2"><?= $avgSections ?></p>
                    </div>
                    <div class="text-4xl text-orange-500 opacity-20">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-star text-yellow-500 mr-2"></i> Cours le Plus Populaire
                </h3>
                <?php if ($popularCourse): ?>
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-lg border-l-4 border-yellow-500">
                        <p class="font-semibold text-gray-800"><?= htmlspecialchars($popularCourse['title']) ?></p>
                        <p class="text-2xl font-bold text-orange-600 mt-2">
                            <?= $popularCourse['total'] ?> inscriptions
                        </p>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">Aucun cours avec inscriptions</p>
                <?php endif; ?>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> Cours Sans Inscriptions
                </h3>
                <?php if (!empty($emptyCourses)): ?>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        <?php foreach ($emptyCourses as $course): ?>
                            <div class="bg-red-50 p-3 rounded border-l-4 border-red-500">
                                <p class="text-sm text-gray-700"><?= htmlspecialchars($course['title']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-green-600 font-semibold">✓ Tous les cours ont des inscriptions!</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-bar text-blue-500 mr-2"></i> Inscriptions par Cours
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b-2">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Cours</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Nombre d'Inscriptions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($enrollmentsPerCourse as $enrollment): ?>
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($enrollment['title']) ?></td>
                                <td class="px-4 py-3 text-center">
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        <?= $enrollment['total'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if (!empty($heavyCourses)): ?>
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-list text-green-500 mr-2"></i> Cours Avec +5 Sections
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach ($heavyCourses as $course): ?>
                    <div class="bg-gradient-to-r from-green-50 to-teal-50 p-4 rounded-lg border-l-4 border-green-500">
                        <p class="font-semibold text-gray-800"><?= htmlspecialchars($course['title']) ?></p>
                        <p class="text-lg font-bold text-green-600 mt-1">
                            <i class="fas fa-layer-group"></i> <?= $course['section_count'] ?> sections
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-clock text-purple-500 mr-2"></i> 5 Dernières Inscriptions
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b-2">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Utilisateur</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Cours</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($latestEnrollments as $enrollment): ?>
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-800">
                                    <span class="font-semibold"><?= htmlspecialchars($enrollment['username']) ?></span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($enrollment['title']) ?></td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    <?= date('d/m/Y H:i', strtotime($enrollment['enrolled_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if (!empty($usersThisYear)): ?>
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-calendar-alt text-indigo-500 mr-2"></i> Inscriptions Cette Année (<?= date('Y') ?>)
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b-2">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Utilisateur</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Cours</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usersThisYear as $user): ?>
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['username']) ?></td>
                                <td class="px-4 py-3 text-sm text-gray-800"><?= htmlspecialchars($user['title']) ?></td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    <?= date('d/m/Y', strtotime($user['enrolled_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include_once './resources/views/layouts/footer.php'; ?>