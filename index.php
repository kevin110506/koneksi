<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Program Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Data Program Studi</h2>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="beranda.php" class="btn btn-secondary">Kembali ke Beranda</a>
            <a href="list.php" class="btn btn-primary">Tambah Prodi</a>
        </div>
        
        <?php
        if(isset($_GET['success'])) {
            echo '<div class="alert alert-success">'.$_GET['success'].'</div>';
        }
        ?>
        
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Prodi</th>
                    <th>Jenjang</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include('koneksi.php');
                $tampil = mysqli_query($koneksi, 'SELECT * FROM prodi ORDER BY id DESC');
                $no = 1;
                while ($data = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($data["nama_prodi"]); ?></td>
                    <td><?php echo $data['jenjang']; ?></td>
                    <td><?php echo htmlspecialchars($data['keterangan']); ?></td>
                    <td>
                        <a href="update1.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus1.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" 
                           onclick="return confirm('Hapus data prodi?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>