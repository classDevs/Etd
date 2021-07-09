<?php
    $databaseHost = '127.0.0.1';//or localhost
    $databaseName = 'srms';
    $databaseUsername = 'root';
    $databasePassword = '';
    
    if($connection = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName)){
    }else{
        echo "La Connexion au base de donnes est impossible";
    }
?>