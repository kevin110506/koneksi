<?php
include ("koneksi.php");

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM tamu WHERE id='$id'");
$row = mysqli_fetch_array($data);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $komentar = $_POST['komentar'];
    
    mysqli_query($koneksi, "UPDATE tamu SET nama='$nama', email='$email', komentar='$komentar' WHERE id='$id'");
    echo "<script>alert('Data diperbarui'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tamu</title>
    <style>
        body { font-family: Arial; margin: 20px; max-width: 600px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 20px; background: #ffc107; color: black; border: none; border-radius: 4px; cursor: pointer; }
        .btn-kembali { background: #6c757d; margin-left: 10px; }
    </style>
</head>
<body>
    <h1>✏️ Edit Data Tamu</h1>
    
    <form method="POST">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="<?= $row['nama'] ?>" required>
        </div>
        
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?= $row['email'] ?>" required>
        </div>
        
        <div class="form-group">
            <label>Komentar</label>
            <textarea name="komentar" rows="5" required><?= $row['komentar'] ?></textarea>
        </div>
        
        <button type="submit">💾 Update</button>
        <a href="index.php" class="btn-kembali" style="padding:10px 20px; background:#6c757d; color:white; text-decoration:none; border-radius:4px;">⬅️ Kembali</a>
    </form>
</body>
</html>