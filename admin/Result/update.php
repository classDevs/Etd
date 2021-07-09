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
        $moy = (($id+$name+$email)/3)*0.4 + $title*0.6;
        $stmt = $pdo->prepare('UPDATE student.results SET tp = ?, td = ?, cc = ?,exam = ?,result = ? WHERE id = ?');
        $stmt->execute([$id, $name, $email,$title,$moy, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM student.results WHERE id = ?');
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
	<h2>Mise A Jour La Resulta d'Etudiant #<?=$contact['id_std']?> Dans Le Module #<?=$contact['id_mod']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">Note TP</label>
        <label for="name">Note TD</label>
        <input type="number" name="id" min="0" max="20" id="id" step="0.05" value="<?=$contact['tp'] ?>">
        <input type="number" name="name" id="name" min="0" max="20" step="0.05" value="<?=$contact['td'] ?>">
        <label for="email">Note CC</label>
        <label for="adr">Note Exam</label>
        <input type="number" name="email" id="email" min="0" max="20" step="0.25" value="<?=$contact['cc'] ?>">
        <input type="number" name="adr" id="adr" min="0" max="20" step="0.25" value="<?=$contact['exam'] ?>">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>