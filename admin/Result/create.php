<?php
function connect()
{
    $databaseHost = '127.0.0.1';//or localhost
    $databaseName = 'student';
    $databaseUsername = 'root';
    $databasePassword = '';
    
    if($connection = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName)){
        return $connection;
    }else{
        echo "La Connexion au base de donnes est impossible";
    }   
}
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(!empty($_POST)){
    $id = isset($_POST['id']) ? $_POST['id'] : 0;
    $std = isset($_POST['std']) ? $_POST['std'] : 0;
    $mod = isset($_POST['mod']) ? $_POST['mod'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : 0;
    $email = isset($_POST['email']) ? $_POST['email'] : 0;
    $title = isset($_POST['adr']) ? $_POST['adr'] : 0;
    $moy = (($id+$name+$email)/3)*0.4 + $title*0.6;
    $stmt = $pdo->prepare('INSERT INTO student.results (id_std,id_mod,tp,td,cc,exam,result) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$std,$mod,$id, $name, $email,$title,$moy]);

    $msg ='Created Successfully!!!';
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
        <label for="id">Note TP</label>
        <label for="name">Note TD</label>
        <input type="number" name="id" min="0" max="20" step="0.05" id="id">
        <input type="number" name="name" id="name" min="0" max="20" step="0.05">
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