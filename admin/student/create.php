<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(!empty($_POST)){
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $lev = isset($_POST['level']) ? $_POST['level'] : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['adr']) ? $_POST['adr'] : '';
    $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : 0;
    $stmt = $pdo->prepare('INSERT INTO srms.student (id,lname,fname,grp,adress,password,id_lev,sy) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email, $phone,$title,$pwd,$lev,$date]);

    $msg ='Ajout avec Succes!!!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Ajouter Un Etudiant</h2>
    <form action="create.php" method="post">
        <label for="level">Niveau</label>
        <select name="level" id="level"><?php
                $connection = connect();
                $req = "SELECT id,name FROM level";
                $res = $connection-> query($req);
                while($row = $res -> fetch_assoc()){
                    echo "<option value = ".$row['id'].">".$row['name']."</option>";
                }
            ?>
        </select>
        <label for="date">Anne Universetaire :</label>
        <input type="number" name="date" min="1900" max="2099" step="1" value="2021">
        <label for="id">ID</label>
        <label for="name">Nom</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="name" id="name">
        <label for="email">Prenom</label>
        <label for="adr">Adresse</label>
        <input type="text" name="email" id="email">
        <input type="text" name="adr" id="adr">
        <label for="pwd">Mot De Passe </label>
        <label for="phone">Group</label>
        <input type="password" name="pwd" id="title">
        <input type="text" name="phone" id="phone">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>