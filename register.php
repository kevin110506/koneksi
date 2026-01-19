<?php
session_start();
// Include koneksi database
include('koneksi.php');

$error = '';
$success = '';

if (isset($_POST['register'])) {
    // Ambil data dari form - SESUAI DENGAN NAMA KOLOM TABEL
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $gmail = mysqli_real_escape_string($koneksi, $_POST['gmail']);
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password']; // TAMBAHKAN INI!
    
    // Validasi input
    if (empty($username) || empty($gmail) || empty($password) || empty($konfirmasi_password)) {
        $error = 'Semua field harus diisi!';
    } elseif (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    } elseif ($password !== $konfirmasi_password) { // VALIDASI KONFIRMASI PASSWORD
        $error = 'Password dan konfirmasi password tidak cocok!';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter!';
    } else {
        // Cek apakah email (gmail) sudah terdaftar
        $cek_gmail = mysqli_query($koneksi, "SELECT * FROM user WHERE gmail='$gmail'");
        
        if (!$cek_gmail) {
            $error = 'Error query: ' . mysqli_error($koneksi);
        } elseif (mysqli_num_rows($cek_gmail) > 0) {
            $error = 'Email sudah terdaftar!';
        } else {
            // Enkripsi password dengan md5
            $password_hash = md5($password);
            
            // Insert data ke database - SESUAI DENGAN NAMA KOLOM
            $sql = "INSERT INTO user (username, gmail, password) 
                    VALUES ('$username', '$gmail', '$password_hash')";
            
            if (mysqli_query($koneksi, $sql)) {
                $success = 'Pendaftaran berhasil! Silakan login.';
                // Redirect setelah 2 detik
                header("refresh:2;url=login.php");
                exit();
            } else {
                $error = 'Gagal mendaftar: ' . mysqli_error($koneksi);
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
    <title>Registrasi Akun - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px;
        }
        .register-container {
            max-width: 500px;
            margin: 0 auto;
        }
        .register-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 30px;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4090 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="card register-card">
                <div class="card-header register-header">
                    <h3 class="mb-1">Daftar Akun Baru</h3>
                    <p class="mb-0">Buat akun untuk mengakses Sistem Akademik</p>
                </div>
                <div class="card-body p-4">
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" 
                                   name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                                   placeholder="Masukkan username" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="gmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="gmail" 
                                   name="gmail" value="<?php echo isset($_POST['gmail']) ? htmlspecialchars($_POST['gmail']) : ''; ?>" 
                                   placeholder="contoh@gmail.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" 
                                   name="password" placeholder="Minimal 6 karakter" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="konfirmasi_password" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="konfirmasi_password" 
                                   name="konfirmasi_password" placeholder="Ulangi password" required>
                        </div>
                        
                        <button type="submit" name="register" class="btn btn-primary btn-lg w-100 mb-3">
                            Daftar Sekarang
                        </button>
                        
                        <div class="text-center">
                            <p class="mb-0">
                                Sudah punya akun? 
                                <a href="login.php" class="text-decoration-none fw-bold">Login di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4 text-muted">
                <small>&copy; 2025 Sistem Akademik - Politeknik Negeri Padang</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('konfirmasi_password').value;
            const email = document.getElementById('gmail').value;
            
            // Validasi email
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert('Format email tidak valid!');
                return false;
            }
            
            // Validasi password minimal 6 karakter
            if (password.length < 6) {
                alert('Password minimal 6 karakter!');
                return false;
            }
            
            // Validasi password sama
            if (password !== confirmPassword) {
                alert('Password dan konfirmasi password tidak cocok!');
                return false;
            }
            
            return true;
        }
    </script>
</body>
</html>