<?php 
if (!isset($page_title)) { $page_title = 'Gestions des courses'; } 
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title><?= htmlspecialchars($page_title) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
  <nav class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <a href="index.php" class="font-bold text-xl tracking-wider flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Cours & Sections
                </a>
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="views/courses/courses_list.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-500 hover:bg-opacity-75 transition duration-150 ease-in-out">Cours</a>
                    <a href="views/sections/sections_list.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-500 hover:bg-opacity-75 transition duration-150 ease-in-out">Sections</a>
                    <a href="views/courses/courses_create.php" class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                        <i class="fas fa-plus-circle mr-1"></i> Créer un Cours
                    </a>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <button type="button" id="mobile-menu-button" class="bg-indigo-600 inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
                    <span class="sr-only">Open main menu</span>
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="views/courses/courses_list.php" class="text-white hover:bg-indigo-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium">Cours</a>
            <a href="views/sections/sections_list.php" class="text-white hover:bg-indigo-500 hover:bg-opacity-75 block px-3 py-2 rounded-md text-base font-medium">Sections</a>
            <a href="views/courses/courses_create.php" class="text-white bg-green-500 hover:bg-green-600 block px-3 py-2 rounded-md text-base font-medium"><i class="fas fa-plus-circle mr-1"></i> Créer un Cours</a>
        </div>
    </div>
  </nav>
  <main class="max-w-7xl mx-auto p-4 animate-fade-in-down">

</body>
</html>