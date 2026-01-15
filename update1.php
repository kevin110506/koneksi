<?php
include('../koneksi.php');

$id = $_GET['id'];
$edit = mysqli_query($koneksi, "SELECT * FROM prodi WHERE id=$id");
$data = mysqli_fetch_array($edit);

if (isset($_POST['submit'])) {
    $nama_prodi = $_POST['nama_prodi'];
    $jenjang = $_POST['jenjang'];
    $keterangan = $_POST['keterangan'];
    
    $update = mysqli_query($koneksi, "UPDATE prodi SET 
        nama_prodi='$nama_prodi', 
        jenjang='$jenjang', 
        keterangan='$keterangan' 
        WHERE id=$id");
    
    if ($update) {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Data Prodi</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Nama Prodi</label>
                <input type="text" class="form-control" name="nama_prodi" value="<?php echo $data['nama_prodi']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenjang</label>
                <select name="jenjang" class="form-control" required>
                    <option value="D2" <?php if($data['jenjang']=='D2') echo 'selected'; ?>>D2</option>
                    <option value="D3" <?php if($data['jenjang']=='D3') echo 'selected'; ?>>D3</option>
                    <option value="D4" <?php if($data['jenjang']=='D4') echo 'selected'; ?>>D4</option>
                    <option value="S2" <?php if($data['jenjang']=='S2') echo 'selected'; ?>>S2</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" value="<?php echo $data['keterangan']; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>