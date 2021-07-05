<?php
    include'../connect.php';
    $std = $_POST['std'];
    $mod = $_POST['mod'];
    $exam = $_POST['exam'];
    $td = $_POST['td'];
    $cc = $_POST['cc'];
    $tp = $_POST['tp'];
    $moy = ((($td+$tp+$cc)/3)*0.4)+($exam*0.6);
    $req = "INSERT INTO results (id_std,id_mod,tp,td,cc,exam,result)
     Values ($std,$mod,$tp,$td,$cc,$exam,$moy)";

    if($res = $connection->query($req)){
        echo "Ajout avec succes";
    }else{
        echo "Erreur";
    }
    $req = "SELECT m.titre as module,m.coeficient as coef,r.result as res
    FROM module m, results r WHERE r.id_std = '".$std."' and m.id = r.id_mod";

    $res = $connection -> query($req);
    $total = 0;
    $scoef = 0;
    while($row=$res-> fetch_assoc()){
        $tot = $row['coef']*$row['res'];
        $total+=$tot;
        $scoef+=$row['coef'];
    }?>
    <?php
    $fres = $total/$scoef;
    $sql = "SELECT id_std FROM average WHERE id_std =".$std;
    $test= mysqli_query($connection,$sql);
    if (mysqli_num_rows($test)>0){
        $req = "UPDATE average SET sum = $total,sumc = $scoef,fres = $fres
        WHERE id_std=$std";
            if($res = $connection->query($req)){
            echo "Ajout avec succes 1";
        }else{
            echo "Erreur 1";
        }
    }
    else{
        $req = "INSERT INTO average (id_std,sum,sumc,fres) VALUES ($std,$total,$scoef,$fres)";
            if($res = $connection->query($req)){
            echo "Ajout avec succes 2";
        }else{
            echo "Erreur 2";
        }
    }
    header('refresh:2;url=add-result.php');
?>