<?php
session_start();
include('koneksi.php');

$error = '';

if (isset($_POST['login'])) {
    $gmail = mysqli_real_escape_string($koneksi, $_POST['gmail']);
    $password = $_POST['password'];
    
    if (empty($gmail) || empty($password)) {
        $error = 'Email dan password harus diisi!';
    } else {
        // MD5 password untuk dibandingkan dengan database
        $password_md5 = md5($password);
        
        // Cari user
        $sql = "SELECT * FROM user WHERE gmail='$gmail' AND password='$password_md5'";
        $result = mysqli_query($koneksi, $sql);
        
        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['gmail'] = $user['gmail'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect ke beranda
            header("Location: beranda.php");
            exit();
        } else {
            $error = 'Email atau password salah!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
        }
        .login-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 25px;
            text-align: center;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 10px;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4090 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="card login-card">
                <div class="card-header login-header">
                    <h4 class="mb-0">Login Sistem Akademik</h4>
                </div>
                <div class="card-body p-4">
                    <?php if ($error): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="gmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="gmail" name="gmail" 
                                   placeholder="contoh@gmail.com" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Masukkan password" required>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="mb-0">
                            Belum punya akun? 
                            <a href="register.php" class="text-decoration-none fw-bold">Daftar di sini</a>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-3">
                <small class="text-muted">Gunakan email dan password yang sudah didaftarkan</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>