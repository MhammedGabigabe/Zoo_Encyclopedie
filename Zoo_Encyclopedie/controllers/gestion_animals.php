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

// recupperer l'animal a modifier
$mode = "ajout";
$animal_a_modifier = [];
$id_a_modifier = -1;

if(isset($_POST["edit_animal"])){
    $mode = "modification";   
    $id_a_modifier = $_POST["id_animal_mod"]; 

    $result_requete = mysqli_query($cnx,"SELECT * FROM animal WHERE id_animal = $id_a_modifier;");
    $animal_a_modifier = mysqli_fetch_assoc($result_requete);
    
}


// insertion et modification
if(isset($_POST['inser_modif_animal'])){

    $id =$_POST['id_animal'];
    
    if($id == ""){
        
        mysqli_query($cnx,"INSERT INTO animal(nom_animal, image_animal, type_alimen_animal, id_hab_animal) 
                        VALUES('$_POST[nom]', '$_POST[image]', '$_POST[type_alimentaire]', '$_POST[idhab]');");

        echo "<script>
        alert('Animal ajouté avec succès !!');
        setTimeout(function(){
            window.location.href = '../views/administration.php';
        }, 100);
        </script>";
                    
    }else{

        mysqli_query($cnx,"UPDATE animal 
                           SET nom_animal ='$_POST[nom]', image_animal ='$_POST[image]',type_alimen_animal ='$_POST[type_alimentaire]', id_hab_animal='$_POST[idhab]'
                           WHERE id_animal = $id;");
        
        echo "<script>
        alert('Animal modifié avec succès !!');
        setTimeout(function(){
            window.location.href = '../views/administration.php';
        }, 100);
        </script>";  

    }
    exit;
}


//suppression
if(isset($_POST['delete_animal'])){
    $id_a_supprimer = $_POST["id_animal_sup"];
    mysqli_query($cnx,"delete from animal where id_animal = $id_a_supprimer");
    echo "<script>
    alert('Animal supprimé avec succès !!');
    setTimeout(function(){
        window.location.href = '../views/administration.php';
    }, 100);
    </script>";

}




?>      