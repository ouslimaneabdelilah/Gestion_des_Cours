<?php
$page_title = "Inscription";
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
<body class="bg-gradient-to-r from-blue-600 to-indigo-700 min-h-screen flex items-center justify-center py-12">
  <div class="container mx-auto px-4 sm:px-8 max-w-md">
    <div class="bg-white rounded-lg shadow-2xl overflow-hidden">
      <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-8 px-6 text-center">
        <i class="fas fa-user-plus text-white text-5xl mb-3"></i>
        <h2 class="text-3xl font-bold text-white">Inscription</h2>
        <p class="text-blue-100 mt-2">Créez votre compte gratuitement</p>
      </div>
      
      <div class="p-8">
        <!-- Alert Error (hidden by default) -->
        <div class="bg-red-100 mb-4 invisible border border-red-400 text-red-700 px-4 py-3 rounded relative alert_error" role="alert">
          <ul id="registerErrors" class="font-medium text-sm">
          </ul>
        </div>

        <form id="registerForm" action="/register" method="POST" class="space-y-5">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
              <i class="fas fa-user mr-2 text-indigo-600"></i>Nom complet
            </label>
            <input 
              type="text" 
              name="name" 
              id="name" 
              class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out"
              placeholder="Jean Dupont"
            >
          </div>

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
            <p class="mt-1 text-xs text-gray-500">
              <i class="fas fa-info-circle mr-1"></i>Au moins 6 caractères
            </p>
          </div>

          <div>
            <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-2">
              <i class="fas fa-check-circle mr-2 text-indigo-600"></i>Confirmer le mot de passe
            </label>
            <div class="relative">
              <input 
                type="password" 
                name="confirm_password" 
                id="confirm_password" 
                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out"
                placeholder="••••••••"
              >
              <button 
                type="button" 
                id="toggleConfirmPassword" 
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
              >
                <i class="fas fa-eye" id="eyeIconConfirm"></i>
              </button>
            </div>
          </div>

          <div class="flex items-start">
            <div class="flex items-center h-5">
              <input 
                id="terms" 
                name="terms" 
                type="checkbox" 
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
              >
            </div>
            <div class="ml-3 text-sm">
              <label for="terms" class="text-gray-700">
                J'accepte les 
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                  conditions d'utilisation
                </a>
                et la
                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                  politique de confidentialité
                </a>
              </label>
            </div>
          </div>

          <div>
            <button 
              type="submit" 
              class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out"
            >
              <i class="fas fa-user-plus mr-2"></i>
              Créer mon compte
            </button>
          </div>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Vous avez déjà un compte?
            <a href="/login" class="font-medium text-indigo-600 hover:text-indigo-500">
              Se connecter
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


    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const eyeIconConfirm = document.getElementById('eyeIconConfirm');

    toggleConfirmPassword.addEventListener('click', function() {
      const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPasswordInput.setAttribute('type', type);
      eyeIconConfirm.classList.toggle('fa-eye');
      eyeIconConfirm.classList.toggle('fa-eye-slash');
    });

    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', (e) => {
      e.preventDefault();
      
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const confirmPassword = document.getElementById('confirm_password').value.trim();
      const terms = document.getElementById('terms').checked;
      const ulErrors = document.getElementById('registerErrors');
      const divErrors = document.querySelector('.alert_error');
      const errors = [];

      if (name === '') {
        errors.push('Le nom complet est requis !');
      }

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

      if (confirmPassword === '') {
        errors.push('La confirmation du mot de passe est requise !');
      } else if (password !== confirmPassword) {
        errors.push('Les mots de passe ne correspondent pas !');
      }

      if (!terms) {
        errors.push('Vous devez accepter les conditions d\'utilisation !');
      }

      if (errors.length > 0) {
        divErrors.classList.remove('invisible');
        ulErrors.innerHTML = '';
        errors.forEach(error => {
          ulErrors.innerHTML += `<li>${error}</li>`;
        });
      } else {
        divErrors.classList.add('invisible');
        registerForm.submit();
      }
    });

    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
  </script>
</body>
</html>