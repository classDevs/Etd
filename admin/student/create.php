<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(!empty($_POST)){
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $title = isset($_POST['adr']) ? $_POST['adr'] : '';
    $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $stmt = $pdo->prepare('INSERT INTO srms.student (id,lname,fname,grp,adress,password) VALUES (?, ?, ?,?, ?,?)');
    $stmt->execute([$id, $name, $email, $phone,$title,$pwd]);

    $msg ='Created Successfully!!!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Ajouter Un Etudiant</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Nom</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="name" id="name">
        <label for="email">Prenom</label>
        <label for="phone">Group</label>
        <input type="text" name="email" id="email">
        <input type="text" name="phone" id="phone">
        <label for="adr">Adresse</label>
        <label for="pwd">Mot De Passe </label>
        <input type="text" name="adr" id="adr">
        <input type="password" name="pwd" id="title">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>