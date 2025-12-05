<?php
include("../controllers/gestion_animals.php");
include("../controllers/gestion_habitats.php");
?>


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
                <a href="../index.php" class="hover:text-blue-400">Voir le Zoo</a>
                <a href="#animaux" class="text-blue-300 hover:text-blue-400 font-semibold">Gérer Animaux</a>
                <a href="#habitats" class="hover:text-blue-400">Gérer Habitats</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        
        <section id="animaux" class="mb-10 bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Gérer les Animaux 🦍</h3>

            <form method="POST" enctype="multipart/form-data" 
                class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-6 rounded-lg mb-6 border">
                <h4 class="col-span-full text-xl font-semibold mb-3 text-blue-700">
                    <?php echo ($mode == "ajout") ? "Ajouter un animal" : "Modifier un animal"; ?>
                </h4>
                
                <input type="hidden" name="id_animal" value="<?php if ($mode == 'modification') echo $animal_a_modifier['id_animal']; ?>"> 
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'animal</label>
                    <?php if ($mode == "modification") { ?>
                    <input type="text" name="nom" value= "<?php echo $animal_a_modifier['nom_animal']; ?>" id="nom" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <?php }else{ ?>
                    <input type="text" name="nom" id="nom" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <?php } ?>
                </div>
                
                <div>
                    <label for="type_alimentaire" class="block text-sm font-medium text-gray-700">Type Alimentaire</label>
                    <?php if ($mode == "ajout") { ?>
                    <select name="type_alimentaire" id="type_alimentaire" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="">-- Choisissez un type alimentaire --</option>
                        <option value="Carnivore">Carnivore</option>
                        <option value="Herbivore">Herbivore</option>
                        <option value="Omnivore">Omnivore</option>
                    </select>
                    <?php }else{ ?>
                    <select name="type_alimentaire" id="type_alimentaire" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="Carnivore" <?php if ($animal_a_modifier['type_alimen_animal'] == 'Carnivore') echo 'selected'; ?>>Carnivore</option>
                        <option value="Herbivore" <?php if ($animal_a_modifier['type_alimen_animal'] == 'Herbivore') echo 'selected'; ?>>Herbivore</option>
                        <option value="Omnivore" <?php if ($animal_a_modifier['type_alimen_animal'] == 'Omnivore') echo 'selected'; ?>>Omnivore</option>
                    </select>
                    <?php } ?>
                </div>

                <div>
                    <label for="idhab" class="block text-sm font-medium text-gray-700">Habitat</label>
                    <?php if ($mode == "ajout") { ?>
                    <select name="idhab" id="idhab" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <option value="">-- Choisissez un habitat --</option>
                        <?php

                            for($i=0;$i<count($liste_habitats);$i++){
                                echo "<option value='{$liste_habitats[$i]['id_habitat']}'> {$liste_habitats[$i]['nom_habitat']} </option>";
                            }
                            
                        ?>
                    </select>
                    <?php }else{ ?>
                    <select name="idhab" id="idhab" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <?php

                            for($i=0;$i<count($liste_habitats);$i++){
                               
                                $selected = "";
                                if($animal_a_modifier['id_hab_animal'] == $liste_habitats[$i]['id_habitat'])
                                    $selected= "selected";

                                echo "<option value='{$liste_habitats[$i]['id_habitat']}' $selected>
                                        {$liste_habitats[$i]['nom_habitat']}
                                      </option>";
                            }
                            
                        ?>
                    </select>
                    <?php } ?>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image (URL)</label>
                    <?php if ($mode == "modification") { ?>
                       <input type="text" name="image" value= "<?php echo $animal_a_modifier['image_animal']; ?>" id="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <?php }else{ ?>
                       <input type="text" name="image" id="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <?php } ?> 
                </div>

                <div class="col-span-full pt-4">
                    <button type="submit" name="inser_modif_animal" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        <?php echo ($mode == "ajout") ? "➕ Ajouter un animal" : "⚙️ Mettre à jour"; ?>
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
                        <?php for($i=0; $i<count($liste_animals);$i++){ 
                                                  
                        echo "
                        <tr>
                            <td class='px-6 py-4 whitespace-nowrap'> {$liste_animals[$i]['id_animal']} </td>
                            <td class='px-6 py-4 whitespace-nowrap'><img src='{$liste_animals[$i]['image_animal']}' alt='image' class='h-10 w-10 rounded-full object-cover'></td>
                            <td class='px-6 py-4 whitespace-nowrap font-medium text-gray-900'> {$liste_animals[$i]['nom_animal']} </td>
                            <td class='px-6 py-4 whitespace-nowrap'> {$liste_animals[$i]['type_alimen_animal']} </td>
                            <td class='px-6 py-4 whitespace-nowrap'> {$liste_animals[$i]['nom_habitat']} </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2'>
            
                                <div class ='flex justify-center gap-6'>
                                <form method='POST'>
                                    <input type='text' name='id_animal_sup' value='{$liste_animals[$i]['id_animal']}' class='hidden'>
                                    <button type='submit' name='delete_animal' value='ajouter' class='text-red-600'>Supprimer</button>
                                </form>

                                <form method='POST'>
                                    <input type='text' name='id_animal_mod' value='{$liste_animals[$i]['id_animal']}' class='hidden'>
                                    <button type='submit' name='edit_animal' class='text-green-600'>Modifier</button>
                                </form>
                                </div>
                        </tr>";
                        } 

                        ?>
                        </tbody>
                </table>
            </div>
        </section>

        <section id="habitats" class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Gérer les Habitats 🌿</h3>
            
            <form method="POST" class="bg-gray-50 p-6 rounded-lg mb-6 border">
                <h4 class="col-span-full text-xl font-semibold mb-3 text-blue-700">
                    <?php echo ($mode_habitat == "ajout") ? "Ajouter un habitat" : "Modifier un habitat"; ?>
                </h4>

                <input type="hidden" name="id_habitat" value="<?php if ($mode_habitat == 'modification') echo $habitat_a_modifier['id_habitat']; ?>">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="nomhab" class="block text-sm font-medium text-gray-700">Nom de l'Habitat</label>
                        <?php if ($mode_habitat == "modification") { ?>
                            <input type="text" name="nomhab" value= "<?php echo $habitat_a_modifier['nom_habitat']; ?>" id="nomhab" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <?php }else{ ?>
                            <input type="text" name="nomhab" id="nomhab" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <?php } ?>
                    </div>
                    <div class="md:col-span-2">
                        <label for="description_hab" class="block text-sm font-medium text-gray-700">Description</label>
                        <?php if ($mode_habitat == "modification") { ?>
                            <input name="description_hab" value = "<?= $habitat_a_modifier['descrip_habitat']?>" id="description_hab" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"> 
                        <?php }else{ ?>
                            <input name="description_hab" id="description_hab" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                        <?php } ?>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" name="inser_modif_habitat" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        <?php echo ($mode_habitat == "ajout") ? "➕ Ajouter un habitat" : "⚙️ Mettre à jour"; ?>
                    </button>
                </div>
            </form>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php for($i=0; $i<count($liste_habitats);$i++){ 
                                                  
                        echo "
                        <tr>
                            <td class='px-6 py-4 whitespace-nowrap'> {$liste_habitats[$i]['id_habitat']} </td>
                            <td class='px-6 py-4 whitespace-nowrap font-medium text-gray-900'> {$liste_habitats[$i]['nom_habitat']} </td>
                            <td class='px-6 py-4 whitespace-nowrap'> {$liste_habitats[$i]['descrip_habitat']} </td>
                            <td class='px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2'>
            
                                <div class ='flex justify-center gap-6'>
                                <form method='POST'>
                                    <input type='text' name='id_habitat_sup' value='{$liste_habitats[$i]['id_habitat']}' class='hidden'>
                                    <button type='submit' name='delete_habitat' value='ajouter' class='text-red-600'>Supprimer</button>
                                </form>

                                <form method='POST'>
                                    <input type='text' name='id_habitat_mod' value='{$liste_habitats[$i]['id_habitat']}' class='hidden'>
                                    <button type='submit' name='edit_habitat' class='text-green-600'>Modifier</button>
                                </form>
                                </div>
                        </tr>";
                        } 

                        ?>
                        </tbody>
                </table>
            </div>
        </section>

    </div>
</body>
</html>