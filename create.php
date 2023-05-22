<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (!empty($_POST)) {
   
    
    $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
    $NIM = isset($_POST['NIM']) ? $_POST['NIM'] : '';
    $Alamat = isset($_POST['Alamat']) ? $_POST['Alamat'] : '';
    $Hobi = isset($_POST['Hobi']) ? $_POST['Hobi'] : '';

    
    $stmt = $pdo->prepare('INSERT INTO mahasiswa VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $Nama, $NIM, $Alamat, $Hobi]);
   
    $msg = 'Data Berhasil Ditambahkan!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Masukkan Data Mahasiswa</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="Nama">Nama</label>
        <input type="text" name="id" id="id">
        <input type="text" name="Nama" id="Nama">
        <label for="NIM">NIM</label>
        <label for="Alamat">Alamat</label>
        <input type="text" name="NIM" id="NIM">
        <input type="text" name="Alamat" id="Alamat">
        <label for="Hobi">Hobi</label>
        <input type="text" name="Hobi" id="Hobi">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>