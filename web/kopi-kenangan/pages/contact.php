<?php
require_once '../config/functions.php';

$settings = getSettings();
$message_sent = false;
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $conn;

    $nama = sanitize($_POST['nama']);
    $email = sanitize($_POST['email']);
    $subject = sanitize($_POST['subject']);
    $pesan = sanitize($_POST['pesan']);

    // Validate
    if (empty($nama) || empty($email) || empty($subject) || empty($pesan)) {
        $error_message = 'Semua field wajib diisi!';
    } else {
        $stmt = $conn->prepare("INSERT INTO messages (nama, email, subject, pesan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $email, $subject, $pesan);

        if ($stmt->execute()) {
            $message_sent = true;
        } else {
            $error_message = 'Gagal mengirim pesan. Silakan coba lagi.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak -
        <?= $settings['site_name'] ?>
    </title>
    <meta name="description" content="Hubungi Kopi Kenangan - Kami siap melayani Anda">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .page-header {
            background: linear-gradient(rgba(44, 24, 16, 0.8), rgba(44, 24, 16, 0.8)),
                url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=1920') center/cover;
            padding: 150px 0 80px;
            text-align: center;
            color: var(--white);
        }

        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .page-breadcrumb {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .page-breadcrumb a:hover {
            color: var(--secondary);
        }

        /* Cart Button in Header */
        .cart-header-btn {
            position: relative;
            padding: 10px 15px;
            background: var(--secondary);
            color: var(--dark);
            border-radius: 50px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
        }

        .cart-header-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger);
            color: white;
            font-size: 0.75rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .contact-section {
            padding: 80px 0;
            background: var(--white);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
        }

        .contact-info h3 {
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: var(--dark);
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 25px;
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .contact-text h4 {
            font-size: 1rem;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .contact-text p {
            color: var(--gray-600);
        }

        .map-container {
            margin-top: 30px;
            height: 200px;
            background: var(--gray-200);
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-form-container {
            background: var(--light);
            padding: 40px;
            border-radius: var(--border-radius);
        }

        .contact-form-container h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group label .required {
            color: var(--danger);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid var(--gray-200);
            border-radius: var(--border-radius-sm);
            font-size: 1rem;
            transition: var(--transition);
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: var(--border-radius-sm);
            margin-bottom: 20px;
            display: none;
            border: 1px solid #c3e6cb;
        }

        .form-success.show {
            display: block;
        }

        .form-error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: var(--border-radius-sm);
            margin-bottom: 20px;
            display: none;
            border: 1px solid #f5c6cb;
        }

        .form-error.show {
            display: block;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: #e74c3c;
            color: #ffffff;
            border: none;
            border-radius: var(--border-radius-sm);
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            background: #c0392b;
        }

        .btn-submit:disabled {
            background: var(--gray-400);
            cursor: not-allowed;
        }

        .btn-loading {
            position: relative;
            pointer-events: none;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 2px solid transparent;
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            to {
                transform: translateY(-50%) rotate(360deg);
            }
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="../index.php" class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <span>
                        <?= $settings['site_name'] ?>
                    </span>
                </a>

                <ul class="nav-menu">
                    <li><a href="../index.php#home" class="nav-link">Beranda</a></li>
                    <li><a href="menu.php" class="nav-link">Menu</a></li>
                    <li><a href="about.php" class="nav-link">Tentang</a></li>
                    <li><a href="gallery.php" class="nav-link">Galeri</a></li>
                    <li><a href="contact.php" class="nav-link active">Kontak</a></li>
                    <li>
                        <button class="cart-header-btn" id="cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Keranjang</span>
                            <span class="cart-count" id="cart-count" style="display: none;">0</span>
                        </button>
                    </li>
                </ul>

                <div class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1 class="page-title">Hubungi Kami</h1>
            <div class="page-breadcrumb">
                <a href="../index.php">Beranda</a>
                <span>/</span>
                <span>Kontak</span>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>Informasi Kontak</h3>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Alamat</h4>
                            <p>
                                <?= $settings['address'] ?>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Telepon</h4>
                            <p>
                                <?= $settings['phone'] ?>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>
                                <?= $settings['email'] ?>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Jam Buka</h4>
                            <p>
                                <?= $settings['opening_hours'] ?>
                            </p>
                        </div>
                    </div>

                    <div class="map-container">
                        <div style="text-align: center; color: var(--gray-600);">
                            <i class="fas fa-map" style="font-size: 2rem; margin-bottom: 10px;"></i>
                            <p>Peta Lokasi</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form-container">
                    <h3>Kirim Pesan</h3>

                    <?php if ($message_sent): ?>
                        <div class="form-success show" id="formSuccess">
                            Pesan Anda berhasil dikirim! Kami akan segera menghubungi Anda.
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error_message)): ?>
                        <div class="form-error show">
                            <?= $error_message ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" id="contactForm">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" id="nama" name="nama" required placeholder="Masukkan nama Anda">
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required placeholder="Masukkan email Anda">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subjek <span class="required">*</span></label>
                            <input type="text" id="subject" name="subject" required placeholder="Masukkan subjek pesan">
                        </div>

                        <div class="form-group">
                            <label for="pesan">Pesan <span class="required">*</span></label>
                            <textarea id="pesan" name="pesan" required
                                placeholder="Tulis pesan Anda di sini..."></textarea>
                        </div>

                        <button type="submit" class="btn-submit" id="btnSubmit">
                            <i class="fas fa-paper-plane"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="../index.php" class="logo">
                        <div class="logo-icon">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <span>
                            <?= $settings['site_name'] ?>
                        </span>
                    </a>
                    <p>
                        Kopi berkualitas tinggi dengan suasana nyaman.
                        Tempat sempurna untuk menikmati kopi favoritmu.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="footer-links">
                    <h4 class="footer-title">Menu</h4>
                    <ul>
                        <li><a href="../index.php#home">Beranda</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="about.php">Tentang</a></li>
                        <li><a href="gallery.php">Galeri</a></li>
                        <li><a href="contact.php">Kontak</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4 class="footer-title">Jam Buka</h4>
                    <ul>
                        <li>Senin - Jumat: 07:00 - 22:00</li>
                        <li>Sabtu: 08:00 - 23:00</li>
                        <li>Minggu: 08:00 - 21:00</li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4 class="footer-title">Lokasi</h4>
                    <ul>
                        <li>
                            <?= $settings['address'] ?>
                        </li>
                        <li>
                            <?= $settings['phone'] ?>
                        </li>
                        <li>
                            <?= $settings['email'] ?>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy;
                    <?= date('Y') ?>
                    <?= $settings['site_name'] ?>. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Cart Modal -->
    <div class="cart-modal" id="cart-modal" style="display: none;">
        <div class="cart-modal-content" style="max-width: 400px; transform: translateX(100%);">
            <div class="cart-modal-header"
                style="padding: 15px 20px; background: #2C1810; color: white; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-size: 1.1rem;"><i class="fas fa-shopping-cart"></i> Keranjang</h3>
                <button onclick="closeCartModal()"
                    style="background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>
            <div class="cart-modal-body" id="cart-items" style="padding: 20px; flex: 1; overflow-y: auto;">
                <div style="text-align: center; padding: 20px; color: #6c757d;">
                    <i class="fas fa-shopping-basket" style="font-size: 3rem; margin-bottom: 10px;"></i>
                    <p>Keranjang kosong</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/cart.js"></script>
    <script>
        // Close cart modal
        function closeCartModal() {
            document.getElementById('cart-modal').style.display = 'none';
        }
    </script>
</body>

</html>