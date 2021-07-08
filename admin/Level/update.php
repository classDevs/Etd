<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $name = isset($_POST['name']) ? $_POST['name'] : 0;
        $stmt = $pdo->prepare('UPDATE srms.level SET name = ? WHERE id = ?');
        $stmt->execute([$name, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM srms.level WHERE id = ?');
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
	<h2>Mise A Jour Le Niveau #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="name">Niveau</label>
        <input type="text" name="name" id="name" value="<?=$contact['name'] ?>">
        <input type="submit" value="Sauvgarder">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>