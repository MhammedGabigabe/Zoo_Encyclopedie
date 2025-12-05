<?php
include("controllers/gestion_animals.php");
include("controllers/gestion_habitats.php");
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>


<script>
    document.addEventListener('DOMContentLoaded', function () {

    const animalStats = <?php echo json_encode(array_values($stats)); ?>;
    const animalLabels = <?php echo json_encode(array_keys($stats)); ?>;

    const canvas = document.getElementById('animalStatsChart');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: animalLabels,
            datasets: [{
                data: animalStats,
                backgroundColor: [
                    '#ef4444', // Carnivore
                    '#22c55e', // Herbivore
                    '#eab308'  // Omnivore
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Répartition des animaux'
                }
            }
        }
    });
});
</script>



<body class="bg-gray-50 font-sans">

    <header class="header-bg text-white py-6 shadow-lg">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight">🦓 Le Zoo de la Crèche</h1>
            <nav>
                <a href="views/administration.php"
                    class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-full font-semibold transition duration-300">Administration</a>
                <a href="#jeu"
                    class="ml-4 bg-yellow-400 text-gray-900 hover:bg-yellow-300 px-4 py-2 rounded-full font-semibold transition duration-300">🎮
                    Jeu Quiz</a>
            </nav>
        </div>
    </header>

    <div class="container mx-auto px-4 my-8">
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 flex flex-col md:flex-row gap-6">

            <div class="w-full md:w-1/2 flex flex-col gap-4">
                <form method="POST" class="flex flex-col gap-4">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600">Habitat :</label>
                        <select name="habitat" class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 rounded-md">
                            <option value="">Tous les Habitats</option>
                            <?php
                              foreach($liste_habitats as $habitat){
                                $selected = (isset($_POST['habitat']) && $_POST['habitat'] == $habitat['id_habitat']) ? 'selected' : '';
                                echo "<option value='{$habitat['id_habitat']}' $selected>{$habitat['nom_habitat']}</option>";
                               }
                            ?>
                        </select>
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600">Type Alimentaire :</label>
                        <select name="type" class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 rounded-md">
                            <option value="">Tous les Types</option>
                            <?php 
                                $types = ['Carnivore','Herbivore','Omnivore'];
                                foreach($types as $t){
                                    $selected = (isset($_POST['type']) && $_POST['type'] == $t) ? 'selected' : '';
                                    echo "<option value=$t $selected>$t</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="w-full">
                        <button type="submit" name= "filtrer" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg">
                            🔍 Appliquer le filtre
                        </button>
                    </div>
                </form>
            </div>

            <div class="w-full md:w-1/2 p-4 bg-blue-50 rounded-lg text-center border-l-4 border-blue-400">
                <p class="text-sm font-semibold text-blue-700">Statistiques Rapides:</p>
                <canvas id="animalStatsChart" style="max-height: 100px;"></canvas>
                
            </div>

        </div>
    </div>



    <div class="container mx-auto px-4 pb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Liste Complète des Animaux</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

            <?php

                $colors =['Carnivore' => 'red', 'Omnivore' => 'yellow','Herbivore' => 'green'];
                for($i =0;$i<count($liste_animals);$i++){
                    echo "
                    <div class='bg-white rounded-xl overflow-hidden card-shadow hover:shadow-xl transition duration-300 transform hover:scale-[1.02]'>
                        <img class='w-full h-48 object-cover'
                        src='{$liste_animals[$i]['image_animal']}'
                        alt='Image'>
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