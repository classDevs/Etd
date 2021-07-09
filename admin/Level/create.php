<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(!empty($_POST)){
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $name = isset($_POST['name']) ? $_POST['name'] : 0;
    $stmt = $pdo->prepare('INSERT INTO student.level (id,name) VALUES (?, ?)');
    $stmt->execute([$id,$name]);

    $msg ='Created Successfully!!!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Ajouter Une Resultat</h2>
    <form action="create.php" method="post">
    <label for="id">ID</label>
    <label for="name">Niveau</label>
    <input type="text" name="id" value="auto" id="id">
    <input type="text" name="name" id="name">
    <input type="submit" value="Creer">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>