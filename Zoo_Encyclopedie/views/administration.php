<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>⚙️ Administration du Zoo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    
    <nav class="bg-gray-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h2 class="text-xl font-bold">Tableau de Bord Admin</h2>
            <div class="space-x-4">
                <a href="index.html" class="hover:text-blue-400">Voir le Zoo</a>
                <a href="#animaux" class="text-blue-300 hover:text-blue-400 font-semibold">Gérer Animaux</a>
                <a href="#habitats" class="hover:text-blue-400">Gérer Habitats</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        
        <section id="animaux" class="mb-10 bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Gérer les Animaux 🦍</h3>

            <form action="gestion_animaux.php" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-lg mb-6 border">
                <h4 class="col-span-full text-xl font-semibold mb-3 text-blue-700">Ajouter/Modifier un Animal</h4>
                
                <input type="hidden" name="id_animal" value=""> <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'animal</label>
                    <input type="text" name="nom" id="nom" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                </div>
                
                <div>
                    <label for="type_alimentaire" class="block text-sm font-medium text-gray-700">Type Alimentaire</label>
                    <select name="type_alimentaire" id="type_alimentaire" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="Carnivore">Carnivore</option>
                        <option value="Herbivore">Herbivore</option>
                        <option value="Omnivore">Omnivore</option>
                    </select>
                </div>

                <div>
                    <label for="idhab" class="block text-sm font-medium text-gray-700">Habitat</label>
                    <select name="idhab" id="idhab" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="1">Savane</option>
                        <option value="2">Jungle</option>
                        <option value="3">Désert</option>
                    </select>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image (JPG/PNG)</label>
                    <input type="file" name="image" id="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="mt-1 text-xs text-gray-500">Note: Laissez vide pour ne pas changer l'image.</p>
                </div>

                <div class="col-span-full pt-4">
                    <button type="submit" name="action" value="ajouter" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        ➕ Ajouter l'Animal
                    </button>
                    <button type="submit" name="action" value="modifier" class="ml-4 bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300 hidden">
                        ✏️ Modifier
                    </button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Habitat</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">1</td>
                            <td class="px-6 py-4 whitespace-nowrap"><img src="../assets/images/lion.jpg" alt="Lion" class="h-10 w-10 rounded-full object-cover"></td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Lion</td>
                            <td class="px-6 py-4 whitespace-nowrap">Carnivore</td>
                            <td class="px-6 py-4 whitespace-nowrap">Savane</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                <a href="?edit=1" class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                <a href="?delete=1" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce Lion ?')">Supprimer</a>
                            </td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </section>

        <section id="habitats" class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Gérer les Habitats 🌿</h3>
            
            <form action="gestion_habitats.php" method="POST" class="bg-gray-50 p-6 rounded-lg mb-6 border">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="nomhab" class="block text-sm font-medium text-gray-700">Nom de l'Habitat</label>
                        <input type="text" name="nomhab" id="nomhab" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    </div>
                    <div class="md:col-span-2">
                        <label for="description_hab" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description_hab" id="description_hab" rows="1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"></textarea>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" name="action" value="ajouter" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        ➕ Ajouter l'Habitat
                    </button>
                </div>
            </form>
            
            </section>

    </div>
</body>
</html>