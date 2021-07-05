<?php
    include'../connect.php';
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $adr = $_POST['adr'];
    $spc = $_POST['spc'];
    $grp = $_POST['grp'];
    $pwd = $_POST['pwd'];
    
    $req = "INSERT INTO student (fname,lname,adress,spc,grp,password)
     Values ('$fname','$lname','$adr','$spc','$grp','$pwd')";

    if($res = $connection->query($req)){
        echo "Etudiant Ajout avec succes";
        header('refresh:2;url=add-student.php');
    }else{
        echo "Erreur Empalcement 1";
    }
    //header('refresh:2;url=add-student.php');
?>