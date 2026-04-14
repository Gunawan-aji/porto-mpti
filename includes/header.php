<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?><?php echo SITE_NAME; ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
</head>

<body data-bs-theme="dark" data-bs-spy="scroll" data-bs-target="#navbar">
    <header class="header fixed-top">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php"><?php echo SITE_NAME; ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'home') ? 'active' : ''; ?>"
                                href="index.php"><i class="fas fa-home"></i> Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'services') ? 'active' : ''; ?>"
                                href="services.php"><i class="fas fa-concierge-bell"></i> Layanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'portfolio') ? 'active' : ''; ?>"
                                href="portfolio.php"><i class="fas fa-briefcase"></i> Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'team') ? 'active' : ''; ?>"
                                href="team.php"><i class="fas fa-users"></i> Tim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>"
                                href="contact.php"><i class="fas fa-envelope"></i> Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>