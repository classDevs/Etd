<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM srms.results WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            $stmt = $pdo->prepare('DELETE FROM srms.results WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the contact!';
            header('refresh:2;url=index.php');
        } else {
            header('Location: index.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content delete">
	<h2>Supprimer l'Etudiant #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Êtes-vous sûr de vouloir supprimer La Resultat  D'Etudiant  #<?=$contact['id_std']?> Dans le Module #<?=$contact['id_mod']?>? </p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Oui</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">Non</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>