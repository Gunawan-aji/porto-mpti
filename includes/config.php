<?php
// Konfigurasi Situs
define('SITE_NAME', 'Development Teknologi Yogyakarta');
define('SITE_URL', 'http://localhost:8000');
define('EMAIL_FROM', 'noreply@timdev.com');

// Data Layanan
$services = [
    'websites' => [
        'title' => 'Website',
        'desc' => 'Profil Perusahaan & E-Commerce/Toko Online',
        'features' => ['Desain Responsif', 'Integrasi Payment Gateway', 'SEO Optimized']
    ],
    'sistem' => [
        'title' => 'Sistem Informasi',
        'desc' => 'Aplikasi Kasir/POS & Kelola Stok/Inventori',
        'features' => ['Real-time Reporting', 'User Management', 'Database Terintegrasi']
    ],
    'mobile' => [
        'title' => 'Aplikasi Mobile',
        'desc' => 'Aplikasi Android & iOS Custom',
        'features' => ['Cross-Platform', 'Push Notifications', 'Offline Mode']
    ]
];

// Data Portfolio diperluas
$portfolio = [
    ['title' => 'Kopi Kenangan', 'desc' => 'Kopi Kenangan: Website kafe kopi modern dengan menu lengkap, POS kasir, admin panel, dan galeri cozy. Nikmati kopi berkualitas!', 'img' => 'assets/images/web2.png', 'category' => 'websites & sistem', 'url' => 'https://kopi-kenangan.gnwn.web.ida', 'full_desc' => ''],
    ['title' => 'Outdoor Adventure', 'desc' => 'Situs Outdoor Adventure: sewa alat outdoor berkualitas, open trip hiking/camping gunung populer Indonesia dengan guide profesional.', 'img' => 'assets/images/web3.png', 'category' => 'websites', 'url' => 'https://outdoor.gnwn.web.id', 'full_desc' => ''],
    ['title' => 'Dashboard Admin', 'desc' => 'SB Admin 2 merupakan template dashboard admin Bootstrap 4 gratis dengan fitur lengkap untuk manajemen web.', 'img' => 'assets/images/web4.png', 'category' => 'sistem admin', 'url' => '../web/admin/adm/index.html', 'full_desc' => ''],
    ['title' => 'iPortfolio', 'desc' => 'iPortfolio adalah template Bootstrap responsif untuk portofolio pribadi yang profesional, menampilkan layanan, karya, resume, dan kontak.', 'img' => 'assets/images/web5.png', 'category' => 'websites', 'url' => '../web/portofolio/porto/index.html', 'full_desc' => 'Deskripsi lengkap project Sistem Inventori ini...'],
    ['title' => 'App Mobile Delivery', 'desc' => 'Aplikasi pengiriman cross-platform.', 'img' => 'assets/images/p.jpg', 'category' => 'mobile', 'url' => '#', 'full_desc' => ''],
];

// Data Team (5 anggota contoh - ganti foto/info real)
$team = [
    ['name' => 'Ahmad Santoso', 'role' => 'Fullstack Developer', 'bio' => '5+ tahun pengalaman PHP, JS, React Native.', 'img' => 'assets/images/pp.jpg', 'social' => '@ahmad_dev'],
    ['name' => 'Siti Nurhaliza', 'role' => 'UI/UX Designer', 'bio' => 'Spesialis desain modern responsif Figma.', 'img' => 'assets/images/pp.jpg', 'social' => '@siti_design'],
    ['name' => 'Budi Hartono', 'role' => 'Backend PHP Expert', 'bio' => 'Master MySQL, API RESTful, Laravel native.', 'img' => 'assets/images/pp.jpg', 'social' => '@budi_php'],
    ['name' => 'Dewi Sartika', 'role' => 'Mobile Developer', 'bio' => 'Android/iOS Flutter & React Native.', 'img' => 'assets/images/pp.jpg', 'social' => '@dewi_mobile'],
    ['name' => 'Rudi Kurniawan', 'role' => 'Project Manager', 'bio' => 'Pemimpin tim agile, delivery tepat waktu.', 'img' => 'assets/images/pp.jpg', 'social' => '@rudi_pm']
];
?>