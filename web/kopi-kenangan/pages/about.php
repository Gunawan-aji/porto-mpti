<?php
require_once '../config/functions.php';

$settings = getSettings();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - <?= $settings['site_name'] ?></title>
    <meta name="description" content="Tentang Kopi Kenangan - Kopi berkualitas dengan suasana cozy">

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

        .about-section {
            padding: 80px 0;
            background: var(--white);
        }

        .about-story {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .about-story h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .about-story p {
            color: var(--gray-600);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
            margin-top: 60px;
        }

        .stat-item {
            text-align: center;
            padding: 30px;
            background: var(--light);
            border-radius: var(--border-radius);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
        }

        .stat-label {
            color: var(--gray-600);
            font-weight: 500;
        }

        .team-section {
            padding: 80px 0;
            background: var(--light);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .team-card {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }

        .team-avatar {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: var(--white);
        }

        .team-name {
            font-size: 1.25rem;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .team-role {
            color: var(--primary);
            font-weight: 500;
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
                    <li><a href="about.php" class="nav-link active">Tentang</a></li>
                    <li><a href="gallery.php" class="nav-link">Galeri</a></li>
                    <li><a href="contact.php" class="nav-link">Kontak</a></li>
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
            <h1 class="page-title">Tentang Kami</h1>
            <div class="page-breadcrumb">
                <a href="../index.php">Beranda</a>
                <span>/</span>
                <span>Tentang Kami</span>
            </div>
        </div>
    </section>

    <!-- About Story -->
    <section class="about-section">
        <div class="container">
            <div class="about-story">
                <span class="section-tag">Cerita Kami</span>
                <h2>Kopi Kenangan</h2>
                <p>
                    Didirikan pada tahun 2020, Kopi Kenangan bermula dari kecintaan kami terhadap
                    kopi berkualitas tinggi. Kami percaya bahwa setiap cangkir kopi memiliki
                    ceritanya sendiri - dari petani yang menanamnya, hingga barista yang menyusunnya.
                </p>
                <p>
                    Kami berkomitmen untuk menggunakan biji kopi pilihan dari petani lokal terpercaya,
                    dipanggang dengan teknik profesional, dan disajikan dengan penuh cinta oleh
                    tim barista berpengalaman kami.
                </p>
                <p>
                    Saat ini, Kopi Kenangan telah menjadi tempat favorit bagi mahasiswa, profesional,
                    dan pecinta kopi di seluruh kota. Kami terus berinovasi untuk memberikan pengalaman
                    kopi terbaik bagi setiap pelanggan kami.
                </p>
            </div>

            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">5+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Menu Variatif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">10k+</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Tim Profesional</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">Tim Kami</span>
                <h2 class="section-title">Kenali Tim Kami</h2>
                <p class="section-subtitle">
                    Tim profesional yang siap melayani Anda
                </p>
            </div>

            <div class="team-grid">
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="team-name">Ahmad Fauzi</h3>
                    <p class="team-role">Head Barista</p>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="team-name">Siti Rahayu</h3>
                    <p class="team-role">Pastry Chef</p>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="team-name">Budi Santoso</h3>
                    <p class="team-role">Coffee Roaster</p>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 class="team-name">Dewi Lestari</h3>
                    <p class="team-role">Store Manager</p>
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

    <!-- Scripts -->
    <script src="../assets/js/main.js"></script>
</body>

</html>