<?php
$page_title = "Tableau de Bord";
require_once 'views/layout/header.php';
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="p-4 bg-blue-100 rounded-full">
                <i class="fas fa-book-open fa-2x text-blue-500"></i>
            </div>
            <div class="ml-6">
                <h3 class="text-lg font-semibold text-gray-600">Total des Cours</h3>
                <p class="text-3xl font-bold text-gray-800">
                    
                </p>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="p-4 bg-green-100 rounded-full">
                <i class="fas fa-list-alt fa-2x text-green-500"></i>
            </div>
            <div class="ml-6">
                <h3 class="text-lg font-semibold text-gray-600">Total des Sections</h3>
                <p class="text-3xl font-bold text-gray-800">
                    
                </p>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1 border-l-4 border-indigo-500">
        <div class="flex items-center">
            <div class="p-4 bg-indigo-100 rounded-full">
                <i class="fas fa-chart-line fa-2x text-indigo-500"></i>
            </div>
            <div class="ml-6">
                <h3 class="text-lg font-semibold text-gray-600">Activité Récente</h3>
                <p class="text-gray-800">Dernière mise à jour: <span class="font-semibold"><?= date('d/m/Y') ?></span></p>
            </div>
        </div>
    </div>
</div>

<div class="mt-12 bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Accès Rapide</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <a href="views/courses/courses_list.php" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-lg hover:bg-blue-100 transition-colors duration-300">
            <i class="fas fa-list-ul fa-3x text-blue-500 mb-3"></i>
            <span class="text-lg font-semibold text-gray-700">Voir les Cours</span>
        </a>
        <a href="views/courses/courses_create.php" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-lg hover:bg-green-100 transition-colors duration-300">
            <i class="fas fa-plus-square fa-3x text-green-500 mb-3"></i>
            <span class="text-lg font-semibold text-gray-700">Ajouter un Cours</span>
        </a>
        <a href="views/sections/sections_list.php" class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-lg hover:bg-indigo-100 transition-colors duration-300">
            <i class="fas fa-stream fa-3x text-indigo-500 mb-3"></i>
            <span class="text-lg font-semibold text-gray-700">Gérer les Sections</span>
        </a>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>