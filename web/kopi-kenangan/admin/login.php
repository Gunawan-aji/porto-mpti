<?php
require_once '../config/functions.php';

$error = '';

// Generate CSRF token if not exists
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    redirect('index.php');
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Token keamanan tidak valid. Silakan coba lagi.';
    } else {
        $username = sanitize($_POST['username']);
        $password = $_POST['password'];

        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify password (using password_verify for bcrypt hash)
            if (password_verify($password, $user['password'])) {
                // Check if user is active
                if ($user['status'] != 'active') {
                    $error = 'Akun Anda tidak aktif! Silakan hubungi administrator.';
                } else {
                    // Regenerate session ID for security
                    session_regenerate_id(true);

                    $_SESSION['admin_id'] = $user['id'];
                    $_SESSION['admin_nama'] = $user['nama_lengkap'];
                    $_SESSION['admin_username'] = $user['username'];
                    $_SESSION['admin_role'] = $user['role'];
                    $_SESSION['login_time'] = time();

                    // Redirect based on role
                    if ($user['role'] == 'kasir') {
                        redirect('../kasir/index.php');
                    } else {
                        redirect('index.php');
                    }
                }
            } else {
                $error = 'Password yang Anda masukkan salah!';
            }
        } else {
            $error = 'Username tidak ditemukan!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin
        <?= getSettings()['site_name'] ?>
    </title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6F4E37, #C4A77D);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            padding: 50px 40px;
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6F4E37, #C4A77D);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2.5rem;
            color: var(--white);
        }

        .login-title {
            font-size: 1.75rem;
            color: #2C1810;
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display:
                <?= $error ? 'block' : 'none' ?>
            ;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2C1810;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6F4E37;
            box-shadow: 0 0 0 3px rgba(111, 78, 55, 0.1);
        }

        .form-group .input-icon {
            position: relative;
        }

        .form-group .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .form-group .input-icon input {
            padding-left: 45px;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #6F4E37, #8D6E63);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #5D4037, #6F4E37);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(111, 78, 55, 0.3);
        }

        .login-footer {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
            font-size: 0.875rem;
        }

        .login-footer a {
            color: #6F4E37;
            font-weight: 500;
        }

        .back-to-site {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-site a {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .back-to-site a:hover {
            color: #6F4E37;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">
                <i class="fas fa-coffee"></i>
            </div>
            <h1 class="login-title">Admin Login</h1>
            <p class="login-subtitle">Masuk ke panel admin
                <?= getSettings()['site_name'] ?>
            </p>
        </div>

        <?php if ($error): ?>
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Masuk
            </button>
        </form>

        <div class="back-to-site">
            <a href="../index.php">
                <i class="fas fa-arrow-left"></i> Kembali ke website
            </a>
        </div>
    </div>
</body>

</html>