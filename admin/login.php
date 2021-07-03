<?php
session_start();
$name = $_POST['name'];
$pwd = $_POST['pwd'];

include '../connect.php';

$req = "SELECT id,name,password FROM admin WHERE name = '".$name."' and password ='".$pwd."'";

 $nb = 0;
 $id = 0;
 if($res = mysqli_query($connection,$req)){
     $nb = mysqli_num_rows($res);

 }
 if($nb >= 1){
     header('location:home.php');
 }else{
     echo'Le Nom ou le Mot de passe est incorrect';
 }


?>