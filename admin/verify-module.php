<?php
    include'../connect.php';
    $name = $_POST['titre'];
    $coef = $_POST['Coef'];
    $spc = $_POST['spc'];
    $sem = $_POST['sem'];
    
    $req = "INSERT INTO module (titre,coeficient,id_spc,semseter) Values ('$name','$coef','$spc','$sem')";

    $res = $connection->query($req);

    echo "Ajout avec succes";
    header('refresh:2;url=add-module.php');
?>