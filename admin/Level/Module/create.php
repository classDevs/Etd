<?php
function connect()
{
    $databaseHost = '127.0.0.1';//or localhost
    $databaseName = 'srms';
    $databaseUsername = 'root';
    $databasePassword = '';
    
    if($connection = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName)){
        return $connection;
    }else{
        echo "La Connexion au base de donnes est impossible";
    }   
}
?>
<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg ='';
if(!empty($_POST)){
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;

    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['crd']) ? $_POST['crd'] : 0;
    $title = isset($_POST['adr']) ? $_POST['adr'] : '';
    $stmt = $pdo->prepare('INSERT INTO srms.module (id,titre,coeficient,credit,unit) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name, $email,$phone,$title]);

    $msg ='Created Successfully!!!';
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Ajouter Un Module</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="name">Libelle</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="name" id="name">
        <label for="email">Coeficient</label>
        <label for="crd">Crédit:</label>
        <input type="number" name="email" id="email" min="1">
        <input type="number" name="crd" id="crd" step="1">
        <label for="lev">Niveau :</label>
        <select name="lev" id="lev"><?php 
                $connection = connect();
                $req = "SELECT id,name FROM level";
                $res = $connection-> query($req);
                while($row = $res -> fetch_assoc()){
                    echo "<option value = ".$row['id'].">".$row['name']."</option>";
                }
            ?>
        </select>
        <label for="adr">Unite :</label>
        <select name="adr" id="adr">
            <option value="fondamentale">Fondamentale</option>
            <option value="methodologie ">Méthodologie </option>
            <option value="transversale ">Transversale </option>
        </select>
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>