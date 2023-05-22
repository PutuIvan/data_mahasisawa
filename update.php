<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
        $NIM = isset($_POST['NIM']) ? $_POST['NIM'] : '';
        $Alamat = isset($_POST['Alamat']) ? $_POST['Alamat'] : '';
        $Hobi = isset($_POST['Hobi']) ? $_POST['Hobi'] : '';
        
        
        $stmt = $pdo->prepare('UPDATE mahasiswa SET id = ?, Nama = ?, NIM = ?, Alamat = ?, Hobi = ? WHERE id = ?');
        $stmt->execute([$id, $Nama, $NIM, $Alamat, $Hobi, $_GET['id']]);
        $msg = 'Updated Berhasil!';
    }
   
    $stmt = $pdo->prepare('SELECT * FROM mahasiswa WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Read')?>

<div class="content update">
	<h2>Update Data <?=$contact['Nama']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">ID</label>
        <label for="Nama">Nama</label>
        <input type="text" name="id" value="<?=$contact['id']?>" id="id">
        <input type="text" name="Nama" value="<?=$contact['Nama']?>" id="Nama">
        <label for="NIM">NIM</label>
        <label for="Alamat">Alamat</label>
        <input type="text" name="NIM" value="<?=$contact['NIM']?>" id="NIM">
        <input type="text" name="Alamat" value="<?=$contact['Alamat']?>" id="Alamat">
        <label for="Hobi">Hobi</label>
        <input type="text" name="Hobi" value="<?=$contact['Hobi']?>" id="title">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>