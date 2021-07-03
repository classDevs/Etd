<?php
    session_start();
    $list = $_POST['list'];
    $_SESSION['mod'] = $_POST['mod'];
    if($list == 'Admitted'){
        echo "2 secondes";
        header('refresh:2;url=admitted-list.php');
    }else{
        echo "2 secondes";
        header('refresh:2;url=Non-admitted-list.php');    
    }
?>