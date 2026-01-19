<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Data Mahasiswa</h3>
        
        <div class="mb-3">
            <a href="index.php" class="btn btn-secondary">Kembali</a>
            <a href="proses.php" class="btn btn-primary">Tambah Data</a>
        </div>
        
        <p>Halo, 
        <?php
        session_start();
        echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User';
        ?>
        </p>
        
        <?php
        // Cek apakah file koneksi.php ada
        if (file_exists('koneksi.php')) {
            include('koneksi.php');
        } else {
            echo '<div class="alert alert-danger">File koneksi.php tidak ditemukan!</div>';
            exit();
        }
        
        // Cek koneksi database
        if (!$koneksi) {
            echo '<div class="alert alert-danger">Koneksi database gagal!</div>';
            exit();
        }
        ?>
        
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
                $tampil = mysqli_query($koneksi, 'SELECT * FROM mahasiswa');
                
                if (!$tampil) {
                    echo '<tr><td colspan="6" class="text-danger">Error: ' . mysqli_error($koneksi) . '</td></tr>';
                } else {
                    $no = 1;
                    if (mysqli_num_rows($tampil) > 0) {
                        while ($data = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['nim']; ?></td>
                    <td><?php echo $data['nama_mhs']; ?></td>
                    <td><?php echo $data['tgl_lahir']; ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td>
                        <a href="update.php?nim=<?php echo $data['nim']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?nim=<?php echo $data['nim']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" class="text-center">Tidak ada data mahasiswa</td></tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>