

<div class="bg-white p-8 rounded-2xl shadow-lg max-w-2xl mx-auto mt-4 border border-gray-200">
  <h1 class="text-2xl font-bold text-gray-800 mb-6">Créer un nouveau cours</h1>
  <?= $message ?>
  <form method="post" class="space-y-6">
    <div>
      <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Titre du cours</label>
      <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" placeholder="e.g. Introduction à PHP">
    </div>
    <div>
      <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
      <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" placeholder="Décrivez le contenu du cours..."></textarea>
    </div>
    <div>
      <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Niveau</label>
      <select name="level" id="level" class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out">
        <option value="">-- Sélectionnez un niveau --</option>
        
      </select>
    </div>
    <div class="flex items-center justify-end gap-4 pt-4">
      <a href="courses_list.php" class="px-6 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
        <i class="fas fa-times mr-2"></i>Annuler
      </a>
      <button type="submit" name="ajouter" class="inline-flex justify-center items-center px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out transform hover:scale-105">
        <i class="fas fa-plus-circle mr-2"></i>Ajouter le Cours
      </button>
    </div>
  </form>
</div>

<?php include_once '../layout/footer.php'; ?>

