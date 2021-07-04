<?php
    include('../connect.php');
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
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
    </style>
</head>
<body>
<div class="topnav">
    <a class = "active" href="home.php">Administration</a>
    <a href="./Student/">Gerer les Etudiants</a>
    <a href="./Module/">Gerer les Modules</a>
    <a href="./Result/">Gerer les Resultats</a>
</div>
    <main>
        
    <form id="adminaction" method="POST" action="verify-list.php">
        <div class="row">
        <div class="col-25">
        <label for="mod">Module:</label>
        </div>
        <div class="col-75">
                <select name="mod">
                <option value="0">0 : Général </option>
                <?php 
                    $req = "SELECT id,titre FROM module";
                    $res = $connection-> query($req);        
                    while($row = $res -> fetch_assoc()){
                        echo "<option value = ".$row['id'].">".$row['id']." : ".$row['titre'] ."</option>";
                    }
                ?></select>
        </div>
    </div>
    <div class="row">
        <div class="col-25">
        <label for="mod">Liste De Recherche:</label>
        </div>
        <div class="col-75">
                <select name="list">
                    <option value="Admitted">Les Etudiants Admis </option>
                    <option value="No_Admitted">Les Etudiants Non Admis </option>
                </select>
        </div>
    </div>
    <div class="row">
        <input type="submit" value="Submit">
    </div>
    </form>
    </main>
<div class="footer">
  <p>Copyright &copy;: univ-saida</p>
</div>
</body>
</html>