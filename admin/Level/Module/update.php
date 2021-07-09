<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $title = isset($_POST['adr']) ? $_POST['adr'] : '';
        $level = isset($_POST['lev']) ? $_POST['lev'] : 0;
        $sem = isset($_POST['sem']) ? $_POST['sem'] : 0;
        $stmt = $pdo->prepare('UPDATE student.module SET id = ?, titre = ?, coeficient = ?, unit = ?,credit = ?, id_lev = ?, semseter = ?  WHERE id = ?');
        $stmt->execute([$id, $name, $email,$title, $level, $sem, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM student.module WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Etudiant')?>

<div class="content update">
	<h2>Mise A Jour Le Module #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="name">Libelle</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="name" id="name" value ="<?=$contact['titre']?>">
        <label for="email">Coeficient</label>
        <label for="crd">Crédit:</label>
        <input type="number" name="email" id="email" min="1" value="<?=$contact['coeficient']?>">
        <input type="number" name="crd" id="crd" step="1" value="<?=$contact['credit']?>">
        <label for="lev">Niveau :</label>
        <select name="lev" id="lev"><?php
                $connection = connect();
                $req = "SELECT id,name FROM level";
                $res = $connection-> query($req);
                while($row = $res -> fetch_assoc()){
                    if($row['id'] === $contact['id_lev']){
                        echo "<option selected = 'selected' value = ".$row['id'].">".$row['name']."</option>";    
                    }else{
                        echo "<option value = ".$row['id'].">".$row['name']."</option>";
                    }
                }
            ?>
        </select>
        <label for="adr">Unite :</label>
        <select name="adr" id="adr">
            <option value="fondamentale">Fondamentale</option>
            <option value="methodologie ">Méthodologie </option>
            <option value="transversale ">Transversale </option>
        </select>
        <label for="sem">Semestre :</label>
        <select name="adr" id="adr">
            <option value="1">Semestre 1</option>
            <option value="2 ">Semestre 2</option>
        </select>
        
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>