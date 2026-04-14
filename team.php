<?php
$current_page = 'team';
$page_title = 'Tim Kami';
include 'includes/config.php';
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-white"><i class="fas fa-users"></i> Tim Kami</h1>
            <p class="lead text-white-50">Bertemu dengan tim berpengalaman kami yang siap mewujudkan ide Anda menjadi
                solusi teknologi
                terbaik.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($team as $member): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 text-center shadow-sm">
                        <img src="<?php echo $member['img']; ?>" class="card-img-top rounded-circle w-50 mx-auto mt-4"
                            alt="<?php echo $member['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title fw-bold"><?php echo $member['name']; ?></h5>
                            <p class="card-text text-primary"><?php echo $member['role']; ?></p>
                            <p class="card-text"><?php echo $member['bio']; ?></p>
                        </div>
                        <div class="card-footer">
                            <a href="#" class="text-dark"><?php echo $member['social']; ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>