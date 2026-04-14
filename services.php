<?php
$current_page = 'services';
$page_title = 'Layanan';
include 'includes/config.php';
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-white"><i class="fas fa-concierge-bell"></i> Layanan Lengkap Kami</h1>
            <p class="lead text-white-50">Solusi komprehensif untuk mendorong kesuksesan digital Anda.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($services as $key => $service): ?>
                <div id="<?php echo $key; ?>" class="col-lg-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="my-0 fw-normal"><?php echo $service['title']; ?></h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $service['desc']; ?></p>
                            <h5 class="mt-4">Fitur Utama:</h5>
                            <ul class="list-unstyled">
                                <?php foreach ($service['features'] as $feature): ?>
                                    <li><i class="fas fa-check-circle text-success me-2"></i><?php echo $feature; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>