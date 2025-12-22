<?php
$page_title = "Bienvenue";
require_once "./resources/views/layouts/header.php";
?>
<div class="min-h-screen bg-gray-100">
  <section class="max-w-5xl mx-auto py-16 px-4 text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Bienvenue sur la plateforme Cours & Sections</h1>
    <p class="text-lg text-gray-600 mb-8">
      Gérez vos cours, sections et inscriptions en toute simplicité. Connectez-vous ou créez un compte pour commencer.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="/login" class="px-6 py-3 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700">Se connecter</a>
      <a href="/register" class="px-6 py-3 bg-white text-indigo-700 border border-indigo-600 rounded-md shadow hover:bg-indigo-50">Créer un compte</a>
    </div>
  </section>
</div>
<?php require_once "./resources/views/layouts/footer.php"; ?>