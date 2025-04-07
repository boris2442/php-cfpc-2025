

<nav class="bg-white shadow-md p-4">
  <div class="container mx-auto flex items-center justify-between">
    <!-- Logo -->
    <a href="index.php" class="text-2xl font-bold text-blue-600">MonProjet</a>

    <!-- Menu desktop -->
    <div class="hidden md:flex space-x-6">
      <?php if (isset($_SESSION['users'])): ?>
        <a href="profil.php" class="text-gray-700 hover:text-blue-600">Profil</a>
        <a href="editionprofil.php" class="text-gray-700 hover:text-blue-600">Modifier Profil</a>
        <a href="ajout_article4.php" class="text-gray-700 hover:text-blue-600">Ajouter Article</a>
        <a href="deconnexion.php" class="text-red-600 font-semibold hover:text-red-800">Déconnexion</a>
      <?php else: ?>
        <a href="inscription2.php" class="text-gray-700 hover:text-blue-600">Inscription</a>
        <a href="connexion.php" class="text-gray-700 hover:text-blue-600">Connexion</a>
      <?php endif; ?>
    </div>

    <!-- Menu mobile -->
    <div class="md:hidden">
      <button id="menu-btn" class="text-gray-700 focus:outline-none">
        ☰
      </button>
    </div>
  </div>

  <!-- Dropdown Mobile -->
  <div id="mobile-menu" class="hidden md:hidden px-4 pt-4 pb-2 space-y-2">
    <?php if (isset($_SESSION['users'])): ?>
      <a href="profil.php" class="block text-gray-700 hover:text-blue-600">Profil</a>
      <a href="edit_profil.php" class="block text-gray-700 hover:text-blue-600">Modifier Profil</a>
      <a href="ajout_article4.php" class="block text-gray-700 hover:text-blue-600">Ajouter Article</a>
      <a href="deconnexion.php" class="block text-red-600 font-semibold hover:text-red-800">Déconnexion</a>
    <?php else: ?>
      <a href="inscription2.php" class="block text-gray-700 hover:text-blue-600">Inscription</a>
      <a href="connexion.php" class="block text-gray-700 hover:text-blue-600">Connexion</a>
    <?php endif; ?>
  </div>

  <!-- Script pour menu mobile -->
  <script>
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    menuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden");
    });
  </script>
</nav>
