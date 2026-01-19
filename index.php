<<<<<<< HEAD
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
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prodi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Data Program Studi</h2>
        <a href="proses.php" class="btn btn-primary mb-3">Tambah Data</a>
        
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
                include('../koneksi.php');
                $tampil = mysqli_query($koneksi, 'SELECT * FROM prodi');
                $no = 1;
                while ($data = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data["nama_prodi"]; ?></td>
                    <td><?php echo $data['jenjang']; ?></td>
                    <td><?php echo $data['keterangan']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
>>>>>>> aa7c42a201588abc3fdbace896d27c78d877051d
</html>