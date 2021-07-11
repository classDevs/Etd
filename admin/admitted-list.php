<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Les Etudiants Admis </title>
    <style>
         body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #ddd;
        }
        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }
        * {
            box-sizing: border-box;
        }

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
        input[type=number], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

            /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

            /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .col-25, .col-75, input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: black;
            color: white;
            text-align: center;
        }
        #note {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #note td, #note th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #note tr:nth-child(even){
            background-color: #f2f2f2;
        }

        #note tr:hover {
            background-color: #ddd;
        }

        #note th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
<div class="topnav">
    <a class = "active" href="home.php">Administration</a>
    <a href="./Student/">Gerer les Etudiants</a>
    <a href="./Module/">Gerer les Modules</a>
    <a href="./Result/">Gerer les Resultats</a>
</div>
    <center><h3>Les Etudiants Admis du Module <?php
        include ('../connect.php');
        if($_SESSION['mod']!=0){
            $mod = "SELECT titre FROM module WHERE id = ".$_SESSION['mod']."";
            $con = $connection -> query($mod);
            while($row=$con->fetch_assoc()){
                echo $row['titre'];
            }
        }else{
            header('refresh:1;url=general-admitted-list.php');    
        }
    ?></h3></center>
   <table id="note" align="center">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Notes CC</th>
            <th>Notes Examen</th>
            <th>Moyens</th>
        </tr>
            <?php

                include('../connect.php');
                //$req = "SELECT id FROM module WHERE titre = ".$mod."";
                $req = "SELECT s.id as id,s.fname as fname,s.lname as lname,r.result as res
                ,r.cc as cc,r.exam as exam
                 FROM student s, results r WHERE id_mod = ".$_SESSION['mod']." 
                 and r.result >= 10 and s.id = r.id_std";
                $res = $connection -> query($req);
                $count = 0;
                while($row=$res->fetch_assoc()){
                    echo "<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['lname']."   ".$row['fname']."</td>
                    <td>".$row['cc']."</td>
                    <td>".$row['exam']."</td>
                    <td>".$row['res']."</td>
                    </tr>";
                    $count +=1;
                }
            ?> 
    </table>
    <?php
        if($count == 0){
            echo "<br><br><br><center><h2>Il n'y a pas des etudiants admis</h2></center> ";
        }
    ?>
<div class="footer">
  <p>Copyright &copy;: univ-saida</p>
</div>
</body>
</html>
