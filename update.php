<<<<<<< HEAD
<?php
include('koneksi.php');

$nim = $_GET['nim'];
$edit = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$data = mysqli_fetch_array($edit);

if (isset($_POST['submit'])) {
    $new_nim = $_POST['nim'];
    $nama_mhs = $_POST['nama'];
    $tgl_lahir = $_POST['tanggal'];
    $alamat = $_POST['alamat'];
    
    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
        nim='$new_nim', 
        nama_mhs='$nama_mhs', 
        tgl_lahir='$tgl_lahir', 
        alamat='$alamat' 
        WHERE nim='$nim'");
    
    if ($update) {
        header("Location: list.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Data Mahasiswa</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control" name="nim" value="<?php echo $data['nim']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $data['nama_mhs']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal" value="<?php echo $data['tgl_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="list.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
=======
<?php
include('../koneksi.php');

$nim = $_GET['nim'];
$edit = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");
$data = mysqli_fetch_array($edit);

if (isset($_POST['submit'])) {
    $new_nim = $_POST['nim'];
    $nama_mhs = $_POST['nama'];
    $tgl_lahir = $_POST['tanggal'];
    $alamat = $_POST['alamat'];
    
    $update = mysqli_query($koneksi, "UPDATE mahasiswa SET 
        nim='$new_nim', 
        nama_mhs='$nama_mhs', 
        tgl_lahir='$tgl_lahir', 
        alamat='$alamat' 
        WHERE nim='$nim'");
    
    if ($update) {
        header("Location: list.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Data Mahasiswa</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control" name="nim" value="<?php echo $data['nim']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $data['nama_mhs']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal" value="<?php echo $data['tgl_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="list.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
>>>>>>> aa7c42a201588abc3fdbace896d27c78d877051d
</html>