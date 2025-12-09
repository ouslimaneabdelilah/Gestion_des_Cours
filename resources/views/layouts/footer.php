</main>
<footer class="mt-8 py-6 bg-gray-800 text-center text-sm text-gray-400">
    &copy; <?= date('Y') ?> Gestions Cours & Sections - Tous droits réservés
  </footer>
  <script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('mobile-menu');
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
        }
    });
  </script>
</body>
</html>
