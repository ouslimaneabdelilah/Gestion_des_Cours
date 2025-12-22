<?php
$page_title = "Connexion";
require_once "./resources/views/layouts/header.php";
?>

<div class="container mx-auto px-4 sm:px-8 max-w-md">
    <div class="py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold leading-tight text-center mb-6">Connexion</h2>
            
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['message'])) : ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <?= $_SESSION['message']; unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <div class="bg-red-100 mb-4 invisible border border-red-400 text-red-700 px-4 py-3 rounded relative alert_error" role="alert">
                <ul id="loginErrors" class="font-medium text-sm"></ul>
            </div>

            <form id="loginForm" action="/login" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Adresse Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="exemple@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Se connecter
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Vous n'avez pas de compte?
                    <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-500">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
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
        }
        if (password === '') {
            errors.push('Le mot de passe est requis !');
        }

        if (errors.length > 0) {
            divErrors.classList.remove('invisible');
            ulErrors.innerHTML = '';
            errors.forEach(error => {
                ulErrors.innerHTML += `<li>${error}</li>`;
            });
            return false;
        } else {
            divErrors.classList.add('invisible');
            loginForm.submit();
        }
    });
</script>

<?php include_once './resources/views/layouts/footer.php'; ?>