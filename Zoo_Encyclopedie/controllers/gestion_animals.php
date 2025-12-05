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


if(isset($_POST['insertion'])){
    $nom = $_POST["nom"];
    $type_alimentaire = $_POST["type_alimentaire"];
    $idhab = $_POST["idhab"];
    $image = $_POST["image"];

    mysqli_query($cnx,"INSERT INTO animal(nom_animal, image_animal, type_alimen_animal, id_hab_animal) 
                        VALUES('$nom', '$image', '$type_alimentaire', $idhab);");
}
    



?>      