<?php
session_start();
include('koneksi.php');

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Ambil data user dari database
$query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$user_id'");
$user_data = mysqli_fetch_assoc($query_user);

// Proses update profil
if (isset($_POST['update_profil'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];
    
    // Validasi
    if (empty($username)) {
        $message = '<div class="alert alert-danger">Username tidak boleh kosong!</div>';
    } else {
        // Cek apakah password baru diisi
        if (!empty($password_baru)) {
            if ($password_baru !== $konfirmasi_password) {
                $message = '<div class="alert alert-danger">Password baru dan konfirmasi tidak cocok!</div>';
            } elseif (strlen($password_baru) < 6) {
                $message = '<div class="alert alert-danger">Password minimal 6 karakter!</div>';
            } else {
                // Update dengan password baru
                $password_hash = md5($password_baru);
                $query_update = "UPDATE user SET username='$username', password='$password_hash' WHERE id='$user_id'";
            }
        } else {
            // Update tanpa password
            $query_update = "UPDATE user SET username='$username' WHERE id='$user_id'";
        }
        
        // Jalankan query update jika ada
        if (isset($query_update)) {
            if (mysqli_query($koneksi, $query_update)) {
                // Update session
                $_SESSION['username'] = $username;
                $message = '<div class="alert alert-success">Profil berhasil diperbarui!</div>';
                
                // Refresh data user
                $query_user = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$user_id'");
                $user_data = mysqli_fetch_assoc($query_user);
            } else {
                $message = '<div class="alert alert-danger">Gagal memperbarui profil!</div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .profile-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 25px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4090 100%);
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="beranda.php">Sistem Akademik</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="editprofil.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="profile-container">
            <div class="card profile-card">
                <div class="card-header profile-header">
                    <h4 class="mb-0"><i class="bi bi-person-circle"></i> Edit Profil</h4>
                    <p class="mb-0">Kelola informasi akun Anda</p>
                </div>
                <div class="card-body p-4">
                    <?php echo $message; ?>
                    
                    <div class="info-box">
                        <h6>Informasi Akun</h6>
                        <p class="mb-1"><strong>ID:</strong> <?php echo $user_data['id']; ?></p>
                        <p class="mb-1"><strong>Email:</strong> <?php echo htmlspecialchars($user_data['gmail']); ?></p>
                        <p class="mb-0"><strong>Terdaftar sejak:</strong> 
                            <?php echo date('d-m-Y', strtotime($user_data['created_at'] ?? 'now')); ?>
                        </p>
                    </div>
                    
                    <form method="POST" action="" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" 
                                   value="<?php echo htmlspecialchars($user_data['username']); ?>" 
                                   placeholder="Masukkan username baru" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email_display" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_display" 
                                   value="<?php echo htmlspecialchars($user_data['gmail']); ?>" 
                                   readonly style="background-color: #e9ecef;">
                            <small class="text-muted">Email tidak dapat diubah</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_baru" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password_baru" 
                                   name="password_baru" placeholder="Kosongkan jika tidak ingin mengubah">
                            <small class="text-muted">Minimal 6 karakter</small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="konfirmasi_password" 
                                   name="konfirmasi_password" placeholder="Ulangi password baru">
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="beranda.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                            </a>
                            <button type="submit" name="update_profil" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Informasi Keamanan</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <small>
                            <i class="bi bi-info-circle"></i> 
                            <strong>Tips keamanan:</strong> Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function validateForm() {
            const password = document.getElementById('password_baru').value;
            const confirmPassword = document.getElementById('konfirmasi_password').value;
            const username = document.getElementById('username').value;
            
            // Validasi username
            if (username.trim() === '') {
                alert('Username tidak boleh kosong!');
                return false;
            }
            
            // Validasi password jika diisi
            if (password !== '') {
                if (password.length < 6) {
                    alert('Password minimal 6 karakter!');
                    return false;
                }
                
                if (password !== confirmPassword) {
                    alert('Password baru dan konfirmasi password tidak cocok!');
                    return false;
                }
            }
            
            return true;
        }
    </script>
</body>
</html>