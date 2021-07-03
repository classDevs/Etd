<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un module</title>
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
    <a href="home.php">Administration</a>
    <a href="add-student.php">Ajouter un Etudiant</a>
    <a href="add-spc.php">Ajouter une Specialité</a>
    <a class = "active" href="add-module.php">Ajouter un Module</a>
    <a href="add-result.php">Ajouter une Resultat</a>
</div>
<form id="addmod" method="POST" action="verify-module.php">
<div class="row">
    <div class="col-25">
      <label for="spc">Specialité :</label>
    </div>
    <div class="col-75">
            <select name="spc"><?php 
                include'functions.php';
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
      <label for="sem">Semestre :</label>
    </div>
    <div class="col-75">
            <select name="sem">
                <option value="1 Licence">Semestre 1 : Licence</option>
                <option value="2 Licence">Semestre 2 : Licence</option>
                <option value="3 Licence">Semestre 3 : Licence</option>
                <option value="4 Licence">Semestre 4 : Licence</option>
                <option value="5 Licence">Semestre 5 : Licence</option>
                <option value="6 Licence">Semestre 6 : Licence</option>
                <option value="1 Master">Semestre 1 : Master</option>
                <option value="2 Master">Semestre 2 : Master</option>
                <option value="3 Master">Semestre 3 : Master</option>
                <!--<option value="4 Master">Semestre 4 Master</option>-->
            </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="titre">Titre De Module</label>
    </div>
    <div class="col-75">
            <input name="titre" type="text"></input>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="Coef">Coefficient</label>
    </div>
    <div class="col-75">
            <input type="number" min="1" name="Coef"></input>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Ajouter">
  </div>
</form>
<div class="footer">
  <p>Copyright &copy;: univ-saida</p>
</div>
</body>
</html>