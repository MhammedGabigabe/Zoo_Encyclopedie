<?php
include __DIR__ . '/../config/db.php';

// recupperer les animaux
$result = mysqli_query($cnx,"select a.*,ha.nom_habitat from animal a, habitat ha 
                             where a.id_hab_animal = ha.id_habitat
                             ORDER by a.id_animal ASC;");

$liste_animals = [];
if($result){
    while($enregistrement = mysqli_fetch_assoc($result)){
        array_push($liste_animals, $enregistrement);
    }
}

// recupperer les habitats
$result = mysqli_query($cnx,"select * from habitat");

$liste_habitats = [];
if($result){
    while($enregistrement = mysqli_fetch_assoc($result)){
        array_push($liste_habitats, $enregistrement);
    }
}

// insertion
if(isset($_POST['insertion'])){
    $nom = $_POST["nom"];
    $type_alimentaire = $_POST["type_alimentaire"];
    $idhab = $_POST["idhab"];
    $image = $_POST["image"];

    mysqli_query($cnx,"INSERT INTO animal(nom_animal, image_animal, type_alimen_animal, id_hab_animal) 
                        VALUES('$nom', '$image', '$type_alimentaire', $idhab);");

    echo "<script>
    alert('Animal ajouté avec succès !');
    setTimeout(function(){
        window.location.href = '../views/administration.php';
    }, 100);
    </script>";                
}

//suppression
if(isset($_POST['suppression'])){
    $id_a_supprimer = $_POST["id_animal_sup"];
    mysqli_query($cnx,"delete from animal where id_animal = $id_a_supprimer");
    echo "<script>
    alert('Animal supprimé avec succès !');
    setTimeout(function(){
        window.location.href = '../views/administration.php';
    }, 100);
    </script>";

}
   
// modification
if(isset($_POST["modification"])){
    $id_a_modifier = $_POST["id_animal_mod"];
    $animal_a_chercher = mysqli_query($cnx,"SELECT nom_animal, image_animal, type_alimen_animal, id_hab_animal FROM animal WHERE id_animal = $id_a_modifier;");
    $animal_a_modifier = mysqli_fetch_assoc($animal_a_chercher);
}


?>      