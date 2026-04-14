<?php
$current_page = 'home';
$page_title = 'Beranda';
include 'includes/config.php';
include 'includes/header.php';
?>

<main>
    <!-- Hero Section -->
    <section id="hero" class="d-flex align-items-center text-center bg-dark text-white"
        style="min-height: 80vh; background: url('assets/images/hero-bg.jpg') no-repeat center center; background-size: cover;">
        <div class="container">
            <h1 class="display-3 fw-bold">Selamat Datang di Development Teknologi Yogyakarta</h1>
            <p class="lead col-lg-8 mx-auto">Kami spesialis dalam pengembangan Website, Sistem Informasi, dan Aplikasi
                Mobile dengan solusi modern dan profesional.</p>
            <a href="#services" class="btn btn-primary btn-lg mt-3">Lihat Layanan Kami</a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white"><i class="fas fa-concierge-bell"></i> Layanan Kami</h2>
                <p class="lead text-white-50">Solusi yang kami tawarkan untuk bisnis Anda.</p>
            </div>
            <div class="row g-4">
                <?php foreach ($services as $key => $service): ?>
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="card w-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary"><?php echo $service['title']; ?></h5>
                                <p class="card-text"><?php echo $service['desc']; ?></p>
                                <ul class="list-unstyled">
                                    <?php foreach ($service['features'] as $feature): ?>
                                        <li><i class="fas fa-check-circle text-success me-2"></i><?php echo $feature; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <a href="services.php#<?php echo $key; ?>" class="btn btn-outline-primary mt-auto">Detail
                                    Lebih Lanjut</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Portfolio Teaser Section -->
    <section id="portfolio-teaser" class="py-5 bg-dark">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white"><i class="fas fa-briefcase"></i> Portfolio Terbaru</h2>
                <p class="lead text-white-50">Beberapa proyek yang telah kami selesaikan.</p>
            </div>
            <div class="row g-4">
                <?php foreach (array_slice($portfolio, 0, 3) as $item): ?>
                    <div class="col-md-4">
                        <div class="card h-100 bg-dark border-0">
                            <a href="<?php echo $item['url']; ?>" target="_blank" class="text-decoration-none text-white">
                                <img src="<?php echo $item['img']; ?>" class="card-img-top"
                                    alt="<?php echo $item['title']; ?>">
                                <div class="card-body">
                                    <h5 class="card-title text-white"><?php echo $item['title']; ?></h5>
                                    <p class="card-text text-white-50"><?php echo $item['desc']; ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-5">
                <a href="portfolio.php" class="btn btn-primary btn-lg">Lihat Semua Portfolio</a>
            </div>
        </div>
    </section>

    <!-- Team Teaser Section -->
    <section id="team-teaser" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-white"><i class="fas fa-users"></i> Kenalan dengan Tim Kami</h2>
                <p class="lead text-white-50">Para profesional di balik proyek-proyek sukses kami.</p>
            </div>
            <div class="row g-4 text-center">
                <?php foreach (array_slice($team, 0, 3) as $member): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="<?php echo $member['img']; ?>" class="card-img-top rounded-circle w-50 mx-auto mt-3"
                                alt="<?php echo $member['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $member['name']; ?></h5>
                                <p class="card-text text-muted"><?php echo $member['role']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-5">
                <a href="team.php" class="btn btn-primary btn-lg">Lihat Seluruh Tim</a>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>