<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
        $stmt = $pdo->prepare('UPDATE srms.student SET id = ?, lname = ?, fname = ?, grp = ? , password = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email, $phone,$pwd, $_GET['id']]);
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
        <label for="id">ID</label>
        <label for="name">Nom</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="name" value="<?=$contact['lname']?>" id="name">
        <label for="email">Prenom</label>
        <label for="phone">Group</label>
        <input type="text" name="email" value="<?=$contact['fname']?>" id="email">
        <input type="text" name="phone" value="<?=$contact['grp']?>" id="phone">
        <label for="pwd">Mot De Passe</label>
        <input type="text" name="pwd" value="<?=$contact['password']?>" id="title">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>