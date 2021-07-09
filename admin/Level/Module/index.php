<?php
    include 'functions.php';
    $pdo = pdo_connect_mysql();

    $stmt = $pdo->prepare('SELECT * FROM srms.module ORDER BY id');
    $stmt->execute();
    $contacts = $stmt->fetchAll();
    $nums_contacts = $pdo->query('SELECT COUNT(*) FROM srms.module') ->fetchColumn();
?>
<?=template_header('Etudiant')?>
<div class="content read">
	<h2>Liste des Modules</h2>
	<a href="create.php" class="create-contact">Ajouter un Module</a>
	<table id="mod">
        <thead>
            <tr>
                <td>#</td>
                <td>Uniter</td>
                <td>Libelle</td>
                <td>Crédit</td>
                <td>Coefecient</td>
                <td>Semestre</td>
                <td>Niveau</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['Unit']?></td>
                <td><?=$contact['titre']?></td>
                <td><?=$contact['credit']?></td>
                <td><?=$contact['coeficient']?></td>
                <td><?=$contact['semseter']?></td>
                <td><?php
                    $stmt2 = $pdo->prepare('SELECT * FROM srms.level WHERE id = '.$contact['id_lev']);
                    $stmt2->execute();
                    $lev = $stmt2->fetchAll();
                    $levels = $pdo->query('SELECT COUNT(*) FROM srms.level') ->fetchColumn();
                    foreach ($lev as $level):
                    ?>
                    
                    <?=$level['name']?>
                    <?php endforeach;?>
                </td>
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