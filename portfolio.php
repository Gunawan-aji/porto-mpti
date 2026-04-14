<?php
$current_page = 'portfolio';
$page_title = 'Portfolio';
include 'includes/config.php';
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-white"><i class="fas fa-briefcase"></i> Portfolio Kami</h1>
            <p class="lead text-white-50">Karya-karya yang telah kami ciptakan dengan bangga.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($portfolio as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm bg-dark border-0">
                        <a href="<?php echo $item['url']; ?>" target="_blank" class="text-decoration-none text-white">
                            <img src="<?php echo $item['img']; ?>" class="card-img-top" alt="<?php echo $item['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title text-white"><?php echo $item['title']; ?></h5>
                                <p class="card-text text-white-50"><?php echo $item['desc']; ?></p>
                                <p class="card-text text-white-50 small"><?php echo $item['full_desc']; ?></p>
                            </div>
                        </a>
                        <div class="card-footer bg-dark border-top border-secondary">
                            <small class="text-white-50">Kategori: <?php echo ucfirst($item['category']); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>