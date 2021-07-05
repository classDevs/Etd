<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un etudiant</title>
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
        input[type=number] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
        input[type=password] {
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
    <a href="home.php">Administration</a>
    <a class = "active" href="student.php">Ajouter un Etudiant</a>
    <a href="add-spc.php">Ajouter une Specialité</a>
    <a href="add-module.php">Ajouter un Module</a>
    <a href="add-result.php">Ajouter une Resultat</a>
</div>
<form id="addstd" method="POST" action="verify-student.php">
  <div class="row">
    <div class="col-25">
      <label for="fname">Prenom:</label>
    </div>
    <div class="col-75">
            <input type="text" name="fname"></input>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Nom:</label>
    </div>
    <div class="col-75">
            <input type="text" name="lname"></input>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="adr">Adresse:</label>
    </div>
    <div class="col-75">
            <input type="text" name="adr"></input>
    </div>
  </div>
  <div class="row">
  <div class="row">
    <div class="col-25">
      <label for="std">Specialité :</label>
    </div>
    <div class="col-75">
            <select name="spc"><?php 
                include'../connect.php';
                $req = "SELECT id,name FROM spec";
                $res = $connection-> query($req);
                while($row = $res -> fetch_assoc()){
                    echo "<option value = ".$row['id'].">".$row['name'] ."</option>";
                }
            ?></select>
    </div>
  </div>
  <div class="row">
  <div class="col-25">
      <label for="grp">Groupe:</label>
    </div>
    <div class="col-75">
      <input type="text" name="grp" >
  </div>
  </div>
  <div class="row">
  <div class="col-25">
      <label for="pwd">Mot de Passe:</label>
    </div>
    <div class="col-75">
      <input type="password" name="pwd" >
  </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
<div class="footer">
  <p>Copyright &copy;: univ-saida</p>
</div>
</body>
</html>