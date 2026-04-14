<?php
$current_page = 'contact';
$page_title = 'Kontak';
include 'includes/config.php';

if ($_POST) {
    $to = 'gunawanwjynto5@gmail.com'; // Ganti dengan email Anda
    $subject = 'Pesan Kontak dari ' . $_POST['name'];
    $message = "Nama: " . $_POST['name'] . "\nEmail: " . $_POST['email'] . "\nLayanan: " . $_POST['service'] . "\nPesan: " . $_POST['message'];
    $headers = "From: " . $_POST['email'];

    if (mail($to, $subject, $message, $headers)) {
        $success = 'Pesan berhasil dikirim! Terima kasih.';
    } else {
        $error = 'Gagal mengirim pesan. Coba lagi.';
    }
}
include 'includes/header.php';
?>

<main class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-white"><i class="fas fa-envelope"></i> Hubungi Kami</h1>
            <p class="lead">Punya pertanyaan atau ingin memulai proyek? Kami siap membantu.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if (isset($success)): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="service" class="form-label">Layanan yang Diinginkan</label>
                                <select class="form-select" id="service" name="service" required>
                                    <option value="">Pilih Layanan...</option>
                                    <?php foreach ($services as $key => $service): ?>
                                        <option value="<?php echo $service['title']; ?>">
                                            <?php echo $service['title']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan Anda</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>