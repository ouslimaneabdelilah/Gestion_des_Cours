<?php
$page_title = "Connexion";
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
<body class="bg-gradient-to-r from-blue-600 to-indigo-700 min-h-screen flex items-center justify-center">
  <div class="container mx-auto px-4 sm:px-8 max-w-md">
    <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
      <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-8 px-6 text-center">
        <i class="fas fa-graduation-cap text-white text-5xl mb-3"></i>
        <h2 class="text-3xl font-bold text-white">Connexion</h2>
        <p class="text-blue-100 mt-2">Accédez à votre espace de gestion</p>
      </div>
      
      <div class="p-8">
        <div class="bg-red-100 mb-4 invisible border border-red-400 text-red-700 px-4 py-3 rounded relative alert_error" role="alert">
          <ul id="loginErrors" class="font-medium text-sm">
          </ul>
        </div>

        <form id="loginForm" action="/login" method="POST" class="space-y-6">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
              <i class="fas fa-envelope mr-2 text-indigo-600"></i>Adresse Email
            </label>
            <input 
              type="email" 
              name="email" 
              id="email" 
              class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out"
              placeholder="exemple@email.com"
            >
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
              <i class="fas fa-lock mr-2 text-indigo-600"></i>Mot de passe
            </label>
            <div class="relative">
              <input 
                type="password" 
                name="password" 
                id="password" 
                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out"
                placeholder="••••••••"
              >
              <button 
                type="button" 
                id="togglePassword" 
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
              >
                <i class="fas fa-eye" id="eyeIcon"></i>
              </button>
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input 
                id="remember" 
                name="remember" 
                type="checkbox" 
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
              >
              <label for="remember" class="ml-2 block text-sm text-gray-700">
                Se souvenir de moi
              </label>
            </div>
            <div class="text-sm">
              <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                Mot de passe oublié?
              </a>
            </div>
          </div>

          <div>
            <button 
              type="submit" 
              class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out"
            >
              <i class="fas fa-sign-in-alt mr-2"></i>
              Se connecter
            </button>
          </div>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Vous n'avez pas de compte?
            <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500">
              S'inscrire maintenant
            </a>
          </p>
        </div>
      </div>
    </div>

    <div class="mt-8 text-center">
      <a href="/courses" class="text-white hover:text-blue-100 text-sm">
        <i class="fas fa-arrow-left mr-2"></i>Retour à l'accueil
      </a>
    </div>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      eyeIcon.classList.toggle('fa-eye');
      eyeIcon.classList.toggle('fa-eye-slash');
    });

    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();
      
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const ulErrors = document.getElementById('loginErrors');
      const divErrors = document.querySelector('.alert_error');
      const errors = [];

      if (email === '') {
        errors.push('L\'adresse email est requise !');
      } else if (!isValidEmail(email)) {
        errors.push('L\'adresse email n\'est pas valide !');
      }

      if (password === '') {
        errors.push('Le mot de passe est requis !');
      } else if (password.length < 6) {
        errors.push('Le mot de passe doit contenir au moins 6 caractères !');
      }

      if (errors.length > 0) {
        divErrors.classList.remove('invisible');
        ulErrors.innerHTML = '';
        errors.forEach(error => {
          ulErrors.innerHTML += `<li>${error}</li>`;
        });
      } else {
        divErrors.classList.add('invisible');
        loginForm.submit();
      }
    });

    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
  </script>
</body>
</html>