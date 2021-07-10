<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resultat</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #ddd;
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
        header{
            background-color: #000000;
        }
        h1{
            text-align: center;
            font-size: 35px;
            background-color: #000000;
            color: #ddd;
            padding: 10px;
        }
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
    <header><h1>Resultats D'Etudiant</h1></header>
    <table align="center" border="0.5" id="note">
        <tr><td>Etudiant Id :</td><td>
        <?php
            include('connect.php');
            $req = "SELECT id,fname,lname,grp FROM student WHERE fname = '".$_SESSION['id']."'";

            $res = $connection -> query($req);
            while($row=$res-> fetch_assoc()){
                $id = $row['id'] ;
                echo $row['id'];
            }
        ?>
        </td></tr>
        <tr><td>Nom d'Etudiant :</td><td>
        <?php
            include('connect.php');
            $req = "SELECT id,fname,lname,grp FROM student WHERE fname = '".$_SESSION['id']."'";

            $res = $connection -> query($req);
            while($row=$res-> fetch_assoc()){
                $name =$row['lname'] ;
                echo $row['lname'];
            }
        ?>
        </td></tr>
        <tr><td>Prenom d'Etudiant :</td><td>
        <?php
            include('connect.php');
            $req = "SELECT id,fname,lname,grp FROM student WHERE fname = '".$_SESSION['id']."'";

            $res = $connection -> query($req);
            while($row=$res-> fetch_assoc()){
                $name =$row['fname'] ;
                echo $row['fname'];
            }
        ?>
        </td></tr>
        <tr><td>Groupe :</td><td>
        <?php
            include('connect.php');
            $req = "SELECT id,fname,grp FROM student WHERE fname = '".$_SESSION['id']."'";

            $res = $connection -> query($req);
            while($row=$res-> fetch_assoc()){
                echo $row['grp'];
            }
        ?>
        </td></tr>
    </table>
    <br><br><br>
    <table align="center" id="note">
            <tr>
                <th>Unites</th>
                <th>Matiere</th>
                <th>Coeficients</th>
                <th>Moyens Modules</th>
                <th>Credit</th>
                <th>Totale</th>
            </tr>
            <?php
                 include('connect.php');
                 $req = "SELECT m.unit as unit, m.titre as module,m.coeficient as coef,r.result as res, m.credit as credit
                 FROM module m, results r WHERE r.id_std = '".$id."' and m.id = r.id_mod";
     
                 $res = $connection -> query($req);
                 $total = 0;
                 $scoef = 0;
                 $credit = 0;
                 while($row=$res-> fetch_assoc()){
                     $tot = $row['coef']*$row['res'];
                     if($row['res']>=10){
                        $credit += $row['credit'];
                        $creditmod = $row['credit'];
                    }else{
                        $creditmod = 0;
                    }
                     echo "<tr>
                     <td>".$row['unit']."</td>
                     <td>".$row['module']."</td>
                     <td>".$row['coef']."</td>
                     <td>".$row['res']."</td>
                     <td>".$creditmod."</td>
                     <td>".$tot."</td>
                     </tr>";
                     $total+=$tot;
                     
                     $scoef+=$row['coef'];
                 }
                 $fres = $total/$scoef;
                 echo"<tr>
                 <td>Totale et Moyenne</td><td></td>
                 <td>".$scoef."</td>
                 <td>".$total."</td>
                 <td>".$credit."</td>
                 <td>".$fres."</td>
                 </tr>";
            ?>
    </table>
    <?php
    if($fres >= 10){
        echo"<br><h3 style ='text-align: center; font-size: 15px;color: #04AA6D;'>L'Etudiant ".$name." est Admis<h3>";
    }else{
       echo"<br><h3 style ='text-align: center; font-size: 15px;color: #AA0404;'>L'Etudiant ".$name." est Ajournée<h3>";
    }
    /*$sql = "SELECT id_std FROM average WHERE id_std =".$_SESSION['id'];
    $test= mysqli_query($connection,$sql);
    if ($test){
        $req = "UPDATE average SET sum = $total,sumc = $scoef,fres = $fres";
            if($res = $connection->query($req)){
            echo "Ajout avec succes";
        }else{
            echo "Erreur 1";
        }
    }
    else{
        $req = "INSERT INTO average (id_std,sum,sumc,fres) VALUES ($id,$total,$scoef,$fres)";
            if($res = $connection->query($req)){
            echo "Ajout avec succes";
        }else{
            echo "Erreur 2";
        }
    }*/
    ?>


</body>
</html>