<?php
session_start();
include('koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$gmail = $_SESSION['gmail'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Beranda - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Sistem Akademik - Beranda</h2>
        
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                Selamat Datang, <?php echo htmlspecialchars($username); ?>
            </div>
            <div class="card-body">
                <p>Email: <?php echo htmlspecialchars($gmail); ?></p>
                <p>Waktu login: <?php echo date('d-m-Y H:i:s'); ?></p>
                
                <hr>
                
                <h5>Menu Utama:</h5>
                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>Program Studi</h5>
                                <p>Kelola data program studi</p>
                                <a href="index.php" class="btn btn-primary">Lihat Data</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>Data Mahasiswa</h5>
                                <p>Kelola data mahasiswa</p>
                                <a href="list.php" class="btn btn-primary">Lihat Data</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5>Profil Saya</h5>
                                <p>Kelola profil akun</p>
                                <a href="editprofil.php" class="btn btn-info">Edit Profil</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="text-center">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>