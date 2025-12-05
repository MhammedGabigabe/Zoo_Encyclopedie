<?php 
include __DIR__ . '/../config/db.php';

// recupperer les habitats
$result = mysqli_query($cnx,"select * from habitat");

$liste_habitats = [];
if($result){
    while($enregistrement = mysqli_fetch_assoc($result)){
        array_push($liste_habitats, $enregistrement);
    }
}

?>