<?php
    include 'functions.php';
    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('SELECT * FROM student.level');
    $stmt->execute();
    $contacts = $stmt->fetchAll();
    $nums_contacts = $pdo->query('SELECT COUNT(*) FROM student.results') ->fetchColumn();
?>
<?=template_header('Etudiant')?>
<div class="content read">
	<h2>Liste des Resultats</h2>
	<a href="create.php" class="create-contact">Ajouter une Resultat</a>
	<table id="mod">
        <thead>
            <tr>
                <td>#</td>
                <td>Niveau</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['name']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<script>
    $(document).ready( function () {
        $('#mod').DataTable();
    } );
</script>

<?=template_footer()?>