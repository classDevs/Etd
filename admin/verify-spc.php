<?php
include('../connect.php');

$spc = $_POST['titre'];

$req = "INSERT INTO spec (name) Values ('$spc')";

    if($res = $connection->query($req)){
        echo "Specialité Ajout avec succes";
        header('refresh:2;url=add-spc.php');
    }else{
        echo "Erreur Empalcement 1";
    }
?>