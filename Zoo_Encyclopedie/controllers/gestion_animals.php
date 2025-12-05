<?php
include __DIR__ . '/../config/db.php';


$result = mysqli_query($cnx,"select a.*,nom_habitat from animal a, habitat ha where a.id_hab_animal = ha.id_habitat;");

$liste_animals = [];
if($result){
    while($enregistrement = mysqli_fetch_assoc($result)){
        array_push($liste_animals, $enregistrement);
    }
}

$result = mysqli_query($cnx,"select nom_habitat from habitat");

$noms_habitat = [];
if($result){
    while($enregistrement = mysqli_fetch_assoc($result)){
        array_push($noms_habitat, $enregistrement);
    }
}
  


?>      