<?php
require_once "header-and-footer/header.php";
?>



<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-green-900 text-center mb-6">Liste des
        Étudiants (Student2)</h1>
    <!-- Formulaire de recherche -->
    <form method="" action="" class="mb-4 flex flex-col md:flex-row
items-center gap-4">
        <div class="flex flex-col md:flex-row items-center gap-4">
            <a href="create.php" class="px-4 py-2 bg-green-600 text-white rounded
hover:bg-green-700">
                Créer un nouvel étudiant
            </a>
            <a href="" class="px-4 py-2 bg-green-600 text-white rounded
hover:bg-green-700">
                Actualiser
            </a>
        </div>
        <div class="flex flex-col md:flex-row items-center gap-4">
            <input type="text" name="search" placeholder="Rechercher par nom ou
email"
                value="" class="px-4 py-2 border
rounded-lg w-full md:w-1/3">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded
hover:bg-green-700">
                Rechercher
            </button>
        </div>
    </form>
    <!-- Tableau des étudiants -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead class="bg-green-200">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">ID</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Nom</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Prénom</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Email</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Adresse</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Téléphone</th>

                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Date de naissance</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Genre</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Langues</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Niveau d'étude</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Intérêts</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Photo</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Document</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Créé le</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-green-700
uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-green-100">

                <tr class="hover:bg-green-50">
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm text-green-900">

                        <img src=""
                            alt="Photo de " class="w16 h-16 object-cover rounded">



                    </td>
                    <td class="px-4 py-2 text-sm text-green-900">

                    </td>

                    <td class="px-4 py-2 text-sm text-green-900"></td>
                    <td class="px-4 py-2 text-sm">
                        <a href=""
                            class="text-green-600 hover:text-green-900 font-medium mr2">Modifier</a>
                        <a href=""

                            class="text-red-600 hover:text-red-900 font-medium">Supprimer</a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
<?php
require_once "header-and-footer/footer.php";
?>