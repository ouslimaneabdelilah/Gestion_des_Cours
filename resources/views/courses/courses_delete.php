<?php
$page_title = "Supprimer le Cours";
include_once "./resources/views/layouts/header.php";

?>


<div class="container mx-auto px-4 sm:px-8 max-w-lg">
    <div class="py-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold leading-tight text-center">Confirmer la Suppression</h2>
            <p class="text-gray-600 mt-4 text-center">
                Êtes-vous sûr de vouloir supprimer le cours suivant ? Cette action est irréversible.
            </p>
            
            <div class="mt-6 bg-gray-50 p-4 rounded-lg border">
                <p class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($course["title"]) ?></p>
                <p class="text-sm text-gray-600 mt-1"><?= htmlspecialchars($course["description"]) ?></p>
                <div class="mt-2">
                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                        <?= htmlspecialchars($course["level"]) ?>
                    </span>
                </div>
            </div>

            <div class="mt-8 flex justify-center gap-4">
                <a href="/courses" class="px-6 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Annuler
                </a>
                <form action="/course/<?= $course["id"] ?>/delete" method="POST">
                    <button type="submit" class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once './resources/views/layouts/footer.php'; ?>
