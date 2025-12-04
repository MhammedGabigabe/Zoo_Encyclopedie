<?php
include("controllers/gestion_animals.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🦁 Zoo Encyclopédie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .header-bg {
            background-color: #3b82f6;
        }

        .card-shadow {  
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 10px 15px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <header class="header-bg text-white py-6 shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight">🦓 Le Zoo de la Crèche</h1>
            <nav>
                <a href="#admin"
                    class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-full font-semibold transition duration-300">Administration</a>
                <a href="#jeu"
                    class="ml-4 bg-yellow-400 text-gray-900 hover:bg-yellow-300 px-4 py-2 rounded-full font-semibold transition duration-300">🎮
                    Jeu Quiz</a>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-4 my-8">
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">🔎 Rechercher et Filtrer</h2>
            <div class="flex flex-wrap md:flex-nowrap gap-4 items-center">
                <div class="w-full md:w-1/3">
                    <label for="habitat-filter" class="block text-sm font-medium text-gray-600">Habitat :</label>
                    <select id="habitat-filter"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Tous les Habitats</option>
                        <?php
//necessaire de fixer
                            for($i=0;$i<count($liste_animals);$i++){
                                echo "<option value=''>{$liste_animals[$i]['nom_habitat']}</option>";
                            }
                            
                        ?>    
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <label for="food-filter" class="block text-sm font-medium text-gray-600">Type Alimentaire :</label>
                    <select id="food-filter"
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                        <option value="">Tous les Types</option>
                        <option value="carnivore">Carnivore 🥩</option>
                        <option value="herbivore">Herbivore 🌿</option>
                        <option value="omnivore">Omnivore 🍔</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3 p-2 bg-blue-50 rounded-lg text-center border-l-4 border-blue-400">
                    <p class="text-sm font-semibold text-blue-700">Statistiques Rapides:</p>
                    <div class="text-xs text-gray-600">
                        <canvas id="animalStatsChart" style="max-height: 100px;"></canvas>
                        <p class="mt-1">Affichage de la répartition (ex: Herbivore vs Carnivore)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 pb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Liste Complète des Animaux</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            <?php

                $colors =['Carnivore' => 'red', 'Omnivore' => 'yellow','Herbivore' => 'green'];
                for($i =0;$i<count($liste_animals);$i++){
                    echo "<div class='bg-white rounded-xl overflow-hidden card-shadow hover:shadow-xl transition duration-300 transform hover:scale-[1.02]'>
                        <img class='w-full h-48 object-cover'
                        src='images/{$liste_animals[$i]['image_animal']}'
                        alt='Image {$liste_animals[$i]['nom_animal']}'>
                        <div class='p-5'>
                            <h3 class='text-2xl font-bold text-gray-800 mb-1'>{$liste_animals[$i]['nom_animal']}</h3>
                            <p class='text-sm font-semibold text-{$colors[$liste_animals[$i]['type_alimen_animal']]}-600 mb-3'>Type : {$liste_animals[$i]['type_alimen_animal']}</p>
                            <p class='text-gray-600'>Habitat : {$liste_animals[$i]['nom_habitat']}</p>
                        </div>
                    </div>";
                }
                
            ?>

        </div>
    </div>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Zoo Encyclopédie. Créé pour les petits explorateurs.</p>
            <div class="mt-2">
                <a href="?lang=en" class="text-gray-400 hover:text-white mx-2">English</a> |
                <a href="?lang=fr" class="text-white hover:text-gray-300 mx-2 font-bold">Français</a>
            </div>
        </div>
    </footer>
</body>

</html>