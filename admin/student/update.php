<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $lev = isset($_POST['level']) ? $_POST['level'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
        $stmt = $pdo->prepare('UPDATE srms.student SET id = ?, lname = ?, fname = ?, grp = ? , password = ?, id_lev = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone,$pwd,$lev, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM srms.student WHERE id = ?');
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
	<h2>Mise A Jour L'Etudiant #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="level">Niveau</label>
        <select name="level" id="level"><?php
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
        <label for="id">ID</label>
        <label for="name">Nom</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id" readonly>
        <input type="text" name="name" id="name" value="<?=$contact['lname']?>">
        <label for="email">Prenom</label>
        <label for="adr">Adresse</label>
        <input type="text" name="email" id="email" value="<?=$contact['fname']?>">
        <input type="text" name="adr" id="adr" value="<?=$contact['adress']?>">
        <label for="pwd">Mot De Passe </label>
        <label for="phone">Group</label>
        <input type="password" name="pwd" id="title" value="<?=$contact['password']?>">
        <input type="text" name="phone" id="phone" value="<?=$contact['grp']?>">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>