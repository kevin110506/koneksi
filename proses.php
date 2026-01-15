<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Tambah Data Prodi</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Prodi</label>
                <input type="text" class="form-control" name="nama_prodi" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenjang</label>
                <select name="jenjang" class="form-control" required>
                    <option value="" selected disabled>-- Pilih Jenjang --</option>
                    <option value="D2">D2</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S2">S2</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="keterangan">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
        
        <?php
        include('../koneksi.php');
        if (isset($_POST['submit'])) {
            $nama_prodi = $_POST['nama_prodi'];
            $jenjang = $_POST['jenjang'];
            $keterangan = $_POST['keterangan'];
            
            $sql = mysqli_query($koneksi, "INSERT INTO prodi(nama_prodi, jenjang, keterangan) 
                    VALUES ('$nama_prodi', '$jenjang', '$keterangan')");
            
            if ($sql) {
                echo "<div class='alert alert-success mt-3'>Data berhasil ditambahkan</div>";
                echo "<a href='index.php' class='btn btn-link'>Lihat Data</a>";
            }
        }
        ?>
    </div>
</body>
</html>