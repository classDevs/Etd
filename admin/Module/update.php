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
        $stmt = $pdo->prepare('UPDATE srms.module SET id = ?, titre = ?, coeficient = ?,semseter = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email,$title, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM srms.module WHERE id = ?');
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
        <input type="text" name="name" value="<?=$contact['titre']?>" id="name">
        <label for="email">Coefecient</label>
        <input type="number" name="email" value="<?=$contact['coeficient']?>" id="email" min = "1">
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
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>