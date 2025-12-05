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

// insertion et modification
if(isset($_POST['inser_modif_habitat'])){

    $id =$_POST['id_habitat'];
    
    if($id == ""){

        $nomhab = mysqli_real_escape_string($cnx, $_POST['nomhab']);
        $description = mysqli_real_escape_string($cnx, $_POST['description_hab']);
        
        mysqli_query($cnx,"INSERT INTO habitat(nom_habitat, descrip_habitat) 
                        VALUES ('$nomhab', '$description');");

        echo "<script>
        alert('Habitat ajouté avec succès !!');
        setTimeout(function(){
            window.location.href = '../views/administration.php';
        }, 100);
        </script>";
                    
    }else{

        $nomhab = mysqli_real_escape_string($cnx, $_POST['nomhab']);
        $description = mysqli_real_escape_string($cnx, $_POST['description_hab']);
        mysqli_query($cnx,"UPDATE habitat 
                           SET nom_habitat ='$nomhab', descrip_habitat ='$description'
                           WHERE id_habitat = $id;");
        
        echo "<script>
        alert('Habitat modifié avec succès !!');
        setTimeout(function(){
            window.location.href = '../views/administration.php';
        }, 100);
        </script>";  

    }
    exit;
}


//suppression
if(isset($_POST['delete_habitat'])){
    $id_a_supprimer = $_POST["id_habitat_sup"];
    mysqli_query($cnx,"delete from habitat where id_habitat = $id_a_supprimer");
    echo "<script>
    alert('Habitat supprimé avec succès !!');
    setTimeout(function(){
        window.location.href = '../views/administration.php';
    }, 100);
    </script>";

}

?>