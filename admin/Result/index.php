<?php
    include 'functions.php';
    $pdo = pdo_connect_mysql();
    $stmt = $pdo->prepare('SELECT srms.results.id as id,id_std,id_mod,cc,exam,result,fname,lname,titre,grp 
    FROM srms.results INNER JOIN srms.student ON srms.results.id_std = srms.student.id INNER JOIN srms.module ON srms.results.id_mod = srms.module.id');
    $stmt->execute();
    $contacts = $stmt->fetchAll();
    $nums_contacts = $pdo->query('SELECT COUNT(*) FROM srms.results') ->fetchColumn();
?>
<?=template_header('Etudiant')?>

<div class="content read">
	<h2>Liste des Resultats</h2>
	<a href="create.php" class="create-contact">Ajouter Un Resultat</a>
	<table id="mod">
        <thead>
            <tr>
                <td>#</td>
                <td>Matricule</>
                <td>Groupe</td>
                <td>Nom/Prenom Etudiant</td>
                <td>Module</td>
                <td>Note CC</td>
                <td>Note Examen</td>
                <td>Moyen Module</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['id_std']?></td>
                <td><?=$contact['grp']?></td>
                <td><?=$contact['lname']?>  <?=$contact['fname']?></td>
                <td><?=$contact['titre']?></td>
                <td><?=$contact['cc']?></td>
                <td><?=$contact['exam']?></td>
                <td><?=$contact['result']?></td>
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
