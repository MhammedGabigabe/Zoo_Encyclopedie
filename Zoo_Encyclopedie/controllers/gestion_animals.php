<?php
include __DIR__ . '/../config/db.php';

$requete = "select a.*,nom_habitat from animal a, habitat ha where a.id_hab_animal = ha.id_habitat ORDER BY id_animal;";
$result = mysqli_query($cnx,$requete);

$liste_animals = [];

if($result){
    while($enregistrement = mysqli_fetch_assoc($result)){
        array_push($liste_animals, $enregistrement);
    }
}



?>