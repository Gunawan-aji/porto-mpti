<?php
require_once '../config/functions.php';

$settings = getSettings();
$gallery = getAllGallery();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - <?= $settings['site_name'] ?></title>
    <meta name="description" content="Galeri foto Kopi Kenangan - Momen-momen indah di cafe kami">

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

        .gallery-section {
            padding: 80px 0;
            background: var(--light);
        }

        .gallery-filters {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 12px 25px;
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: 50px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--white);
        }

        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .lightbox.active {
            display: flex;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: var(--border-radius);
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: var(--white);
            border: none;
            border-radius: 50%;
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .lightbox-close:hover {
            background: var(--primary);
            color: var(--white);
        }

        .lightbox-caption {
            text-align: center;
            color: var(--white);
            margin-top: 20px;
            font-size: 1.25rem;
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
                    <span><?= $settings['site_name'] ?></span>
                </a>

                <ul class="nav-menu">
                    <li><a href="../index.php#home" class="nav-link">Beranda</a></li>
                    <li><a href="menu.php" class="nav-link">Menu</a></li>
                    <li><a href="about.php" class="nav-link">Tentang</a></li>
                    <li><a href="gallery.php" class="nav-link active">Galeri</a></li>
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
            <h1 class="page-title">Galeri Kami</h1>
            <div class="page-breadcrumb">
                <a href="../index.php">Beranda</a>
                <span>/</span>
                <span>Galeri</span>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <div class="gallery-filters">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="interior">Interior</button>
                <button class="filter-btn" data-filter="drinks">Minuman</button>
                <button class="filter-btn" data-filter="food">Makanan</button>
                <button class="filter-btn" data-filter="events">Acara</button>
            </div>

            <div class="gallery-grid">
                <?php foreach ($gallery as $item): ?>
                    <div class="gallery-item" data-category="<?= strtolower(explode(' ', $item['judul'])[0]) ?>">
                        <div class="gallery-placeholder">
                            <i class="fas fa-camera"></i>
                        </div>
                        <div class="gallery-overlay">
                            <h3 class="gallery-title">
                                <?= $item['judul'] ?>
                            </h3>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Additional gallery items for demo -->
                <div class="gallery-item" data-category="interior">
                    <div class="gallery-placeholder">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Ruang Utama</h3>
                    </div>
                </div>
                <div class="gallery-item" data-category="interior">
                    <div class="gallery-placeholder">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Area Outdoor</h3>
                    </div>
                </div>
                <div class="gallery-item" data-category="drinks">
                    <div class="gallery-placeholder">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Signature Drinks</h3>
                    </div>
                </div>
                <div class="gallery-item" data-category="food">
                    <div class="gallery-placeholder">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="gallery-overlay">
                        <h3 class="gallery-title">Pastry Segar</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <button class="lightbox-close" onclick="closeLightbox()">
            <i class="fas fa-times"></i>
        </button>
        <div class="lightbox-content">
            <div class="gallery-placeholder" style="width: 600px; height: 400px; border-radius: 12px;">
                <i class="fas fa-camera" style="font-size: 4rem;"></i>
            </div>
            <div class="lightbox-caption" id="lightboxCaption"></div>
        </div>
    </div>

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
    <script>
        // Gallery filter
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;

                galleryItems.forEach(item => {
                    if (filter === 'all' || item.dataset.category === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Lightbox
        const lightbox = document.getElementById('lightbox');
        const lightboxCaption = document.getElementById('lightboxCaption');

        document.querySelectorAll('.gallery-item').forEach(item => {
            item.addEventListener('click', function () {
                const title = this.querySelector('.gallery-title').textContent;
                lightboxCaption.textContent = title;
                lightbox.classList.add('active');
            });
        });

        function closeLightbox() {
            lightbox.classList.remove('active');
        }

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });
    </script>
</body>

</html>