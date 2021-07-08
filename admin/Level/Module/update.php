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
        $stmt = $pdo->prepare('UPDATE srms.module SET id = ?, titre = ?, coeficient = ?, unit = ? WHERE id = ?');
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
            <option value="fondamentale">Fondamentale</option>
            <option value="methodologie ">Méthodologie </option>
            <option value="transversale ">Transversale </option>
        </select>
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>