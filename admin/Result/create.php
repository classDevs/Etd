<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(!empty($_POST)){
    $std = isset($_POST['std']) ? $_POST['std'] : 0;
    $mod = isset($_POST['mod']) ? $_POST['mod'] : 0;
    $email = isset($_POST['email']) ? $_POST['email'] : 0;
    $title = isset($_POST['adr']) ? $_POST['adr'] : 0;
    $moy = $email*0.4 + $title*0.6;
    $stmt = $pdo->prepare('INSERT INTO srms.results (id_std,id_mod,cc,exam,result) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$std,$mod, $email,$title,$moy]);

    $msg ='Ajout avec Succes !!!';
    addRes($std);
}
function addRes($std){
    $req = "SELECT m.titre as module,m.coeficient as coef,r.result as res
    FROM module m, results r WHERE r.id_std = '".$std."' and m.id = r.id_mod";

    $connection = connect();
    $res = $connection -> query($req);
    $total = 0;
    $scoef = 0;
    while($row=$res-> fetch_assoc()){
        $tot = $row['coef']*$row['res'];
        $total+=$tot;
        $scoef+=$row['coef'];
    }
    avg($total,$scoef,$std,$connection);
}
function avg($total,$scoef,$std,$connection){
    $fres = $total/$scoef;
    $sql = "SELECT id_std FROM average WHERE id_std =".$std;
    $test= mysqli_query($connection,$sql);
    if (mysqli_num_rows($test)>0){
        $req = "UPDATE average SET sum = $total,sumc = $scoef,fres = $fres
        WHERE id_std=$std";
            if($res = $connection->query($req)){
        }else{
            echo "Erreur 1";
        }
    }
    else{
        $req = "INSERT INTO average (id_std,sum,sumc,fres) VALUES ($std,$total,$scoef,$fres)";
            if($res = $connection->query($req)){
        }else{
            echo "Erreur 2";
        }
    }
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Ajouter Une Resultat</h2>
    <form action="create.php" method="post">
        <label for="std">Le Nom D'Etudiant</label>
        
        <select name="std"><?php 
                $connection = connect();
                $req = "SELECT id,fname,lname,grp,id_lev FROM student ORDER BY grp";
                $res = $connection-> query($req);
                while($row = $res -> fetch_assoc()){
                    echo "<option value = ".$row['id'].">".$row['id']."-".$row['grp']."-".$row['id_lev'].
                            " : ".$row['fname'] ."  ".$row['lname'] ."</option>";
                }
            ?></select>
        
        <label for="mod">Module</label>
        <select name="mod"><?php 
                $req = "SELECT id,titre,semseter FROM module ORDER BY id";
                $res = $connection-> query($req);
                
                while($row = $res -> fetch_assoc()){
                    echo "<option value = ".$row['id']."> ".$row['id']." :Module ".$row['titre'] ."</option>";
                }
        ?></select>
        <label for="email">Note CC</label>
        <label for="adr">Note Exam</label>
        <input type="number" name="email" id="email" min="0" max="20" step="0.25">
        <input type="number" name="adr" id="adr" min="0" max="20" step="0.25">
        <input type="submit" value="Ajouter">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>