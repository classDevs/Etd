<?php
session_start();
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$pwd = $_POST['pwd'];

include 'connect.php';

$req = "SELECT id,fname,lname,password,grp FROM student WHERE fname = '".$fname."' and lname = '".$lname."' and password ='".$pwd."'";

 $nb = 0;
 $id = 0;
 if($res = mysqli_query($connection,$req)){
     $nb = mysqli_num_rows($res);

 }
 if($nb >= 1){
     header('location:result.php');
     $_SESSION['id'] = $fname; 
 }else{
     echo'Le Nom ou le Mot de passe est incorrect';
 }


?>