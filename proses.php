<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Data Mahasiswa</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" class="form-control" name="nim" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="alamat">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="list.php" class="btn btn-secondary">Kembali</a>
        </form>
        
        <?php
        include('../koneksi.php');
        if (isset($_POST['submit'])) {
            $nim = $_POST['nim'];
            $nama_mhs = $_POST['nama'];
            $tgl_lahir = $_POST['tanggal'];
            $alamat = $_POST['alamat'];
            
            $sql = mysqli_query($koneksi, "INSERT INTO mahasiswa(nim, nama_mhs, tgl_lahir, alamat) 
                    VALUES ('$nim', '$nama_mhs', '$tgl_lahir', '$alamat')");
            
            if ($sql) {
                echo "<div class='alert alert-success mt-3'>Data berhasil ditambahkan</div>";
                echo "<a href='list.php' class='btn btn-link'>Lihat Data</a>";
            }
        }
        ?>
    </div>
</body>
</html>