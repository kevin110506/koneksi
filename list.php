<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Data Mahasiswa</h2>
        <a href="proses.php" class="btn btn-primary mb-3">Tambah Data</a>
        
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('../koneksi.php');
                $tampil = mysqli_query($koneksi, 'SELECT * FROM mahasiswa');
                $no = 1;
                while ($data = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data["nim"]; ?></td>
                    <td><?php echo $data['nama_mhs']; ?></td>
                    <td><?php echo $data['tgl_lahir']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td>
                        <a href="update.php?nim=<?php echo $data['nim']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?nim=<?php echo $data['nim']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>