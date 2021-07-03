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
    $stmt = $pdo->prepare('INSERT INTO srms.module (id,titre,coeficient,semseter) VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email,$title]);

    $msg ='Created Successfully!!!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Ajouter Un Module</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Libelle</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="name" id="name">
        <label for="email">coeficient</label>
        <input type="number" name="email" id="email" min="1">
        <label for="adr">Semestre</label>
        <select name="adr" id="adr">
            <option value="1 Licence">Semestre 1 : Licence</option>
            <option value="2 Licence">Semestre 2 : Licence</option>
            <option value="3 Licence">Semestre 3 : Licence</option>
            <option value="4 Licence">Semestre 4 : Licence</option>
            <option value="5 Licence">Semestre 5 : Licence</option>
            <option value="6 Licence">Semestre 6 : Licence</option>
            <option value="1 Master">Semestre 1 : Master</option>
            <option value="2 Master">Semestre 2 : Master</option>
            <option value="3 Master">Semestre 3 : Master</option>
        </select>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>