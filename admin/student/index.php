<?php
    include 'functions.php';
    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('SELECT * FROM srms.student ORDER BY id');
    $stmt->execute();
    $contacts = $stmt->fetchAll();
    $nums_contacts = $pdo->query('SELECT COUNT(*) FROM srms.student') ->fetchColumn();
?>
<?=template_header('Etudiant')?>
<div class="topnav">
    <a href="../home.php">Administration</a>
    <a class="active" href="index.php">Gerer les Etudiants</a>
    <a href="../module">Gerer les Modules</a>
    <a href="../results">Gerer les Resultats</a>
</div>
<div class="content read">
	<h2>Liste des Etudiant</h2>
	<a href="create.php" class="create-contact">Ajouter un Etudiant</a>
	<table id="std">
        <thead>
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Groupe</td>
                <td>Mot De Passe</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['lname']?></td>
                <td><?=$contact['fname']?></td>
                <td><?=$contact['grp']?></td>
                <td><?=$contact['password']?></td>
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
        $('#std').DataTable();
    } );
</script>

<?=template_footer()?>