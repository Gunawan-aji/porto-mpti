<?php
require_once '../config/functions.php';
requireLogin();

$settings = getSettings();
$categories = getAllCategories();

// Handle category filtering
$category_id = isset($_GET['category']) ? (int) $_GET['category'] : null;

if ($category_id) {
    $products = getProductsByCategory($category_id);
} else {
    $products = getAllProducts();
}

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cart_total = 0;
foreach ($cart as $item) {
    $cart_total += $item['subtotal'];
}

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = (int) $_POST['product_id'];
    $jumlah = (int) $_POST['jumlah'];

    $product = getProductById($product_id);
    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['jumlah'] += $jumlah;
            $_SESSION['cart'][$product_id]['subtotal'] = $_SESSION['cart'][$product_id]['jumlah'] * $_SESSION['cart'][$product_id]['harga'];
        } else {
            $_SESSION['cart'][$product_id] = [
                'produk_id' => $product_id,
                'nama_produk' => $product['nama_produk'],
                'harga' => $product['harga'],
                'jumlah' => $jumlah,
                'subtotal' => $product['harga'] * $jumlah
            ];
        }

        redirect('pos.php');
    }
}

// Handle remove from cart
if (isset($_GET['remove'])) {
    $product_id = (int) $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    redirect('pos.php');
}

// Handle checkout
if (isset($_POST['checkout'])) {
    $nama_pelanggan = sanitize($_POST['nama_pelanggan']);
    $nomor_meja = isset($_POST['nomor_meja']) && !empty($_POST['nomor_meja']) ? sanitize($_POST['nomor_meja']) : '-';
    $metode_pembayaran = sanitize($_POST['metode_pembayaran']);

    if (!empty($_SESSION['cart']) && !empty($nama_pelanggan)) {
        $kode_order = generateKodeOrder();
        $user_id = $_SESSION['admin_id'];
        $items = [];

        foreach ($_SESSION['cart'] as $item) {
            $items[] = [
                'produk_id' => $item['produk_id'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
                'subtotal' => $item['subtotal']
            ];
        }

        if (createOrder($kode_order, $user_id, $nama_pelanggan, $cart_total, $metode_pembayaran, $items, 'offline', $nomor_meja)) {
            $_SESSION['cart'] = [];
            echo "<script>alert('Pesanan berhasil! Kode: $kode_order'); window.location.href='pos.php';</script>";
        }
    }
}

// Clear cart
if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    redirect('pos.php');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir / POS -
        <?= $settings['site_name'] ?>
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6F4E37;
            --primary-dark: #5D4037;
            --secondary: #C4A77D;
            --dark: #2C1810;
            --white: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-600: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--gray-100);
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background: var(--dark);
            color: var(--white);
            z-index: 100;
        }

        .sidebar-brand {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand span {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-section {
            padding: 10px 20px;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 1px;
        }

        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-left-color: var(--secondary);
        }

        .menu-item i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            margin-left: 260px;
        }

        .pos-container {
            display: grid;
            grid-template-columns: 1fr 400px;
            height: 100vh;
        }

        .products-section {
            padding: 20px;
            overflow-y: auto;
        }

        .cart-section {
            background: var(--white);
            border-left: 1px solid var(--gray-200);
            display: flex;
            flex-direction: column;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid var(--gray-200);
            border-radius: 10px;
            font-size: 1rem;
        }

        .category-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .category-tab {
            padding: 8px 16px;
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 20px;
            text-decoration: none;
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .category-tab:hover,
        .category-tab.active {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }

        .product-card {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow);
            padding: 15px;
            text-align: center;
            transition: all 0.3s;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .product-icon {
            width: 60px;
            height: 60px;
            background: #F5DEB3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 1.5rem;
            color: var(--primary);
        }

        .product-name {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .product-price {
            color: var(--primary);
            font-weight: 700;
            font-size: 1.1rem;
        }

        .cart-header {
            padding: 20px;
            border-bottom: 1px solid var(--gray-200);
        }

        .cart-header h2 {
            font-size: 1.25rem;
            color: var(--dark);
        }

        .cart-items {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-name {
            font-weight: 500;
            color: var(--dark);
        }

        .cart-item-price {
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .cart-item-qty {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-item-qty button {
            width: 25px;
            height: 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: var(--gray-200);
        }

        .cart-item-subtotal {
            font-weight: 600;
            color: var(--primary);
            min-width: 80px;
            text-align: right;
        }

        .cart-item-remove {
            color: var(--danger);
            cursor: pointer;
            margin-left: 10px;
        }

        .cart-footer {
            padding: 20px;
            border-top: 1px solid var(--gray-200);
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .cart-total-label {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .cart-total-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .cart-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .cart-actions input,
        .cart-actions select {
            padding: 12px;
            border: 2px solid var(--gray-200);
            border-radius: 8px;
        }

        .btn-checkout {
            padding: 15px;
            background: var(--success);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-checkout:hover {
            background: #218838;
        }

        .btn-clear {
            padding: 10px;
            background: var(--danger);
            color: var(--white);
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .empty-cart {
            text-align: center;
            padding: 50px;
            color: var(--gray-600);
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .pos-container {
                grid-template-columns: 1fr;
            }

            .cart-section {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 50vh;
            }
        }
    </style>
    <script>
        function addToCart(productId, productName, price) {
            const jumlah = prompt('Jumlah:', '1');
            if (jumlah && jumlah > 0) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="add_to_cart" value="1">
                    <input type="hidden" name="product_id" value="${productId}">
                    <input type="hidden" name="jumlah" value="${jumlah}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</head>

<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="logo-icon"><i class="fas fa-coffee"></i></div>
            <span>Kasir</span>
        </div>
        <nav class="sidebar-menu">
            <div class="menu-section">Menu</div>
            <a href="index.php" class="menu-item"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            <a href="pos.php" class="menu-item active"><i class="fas fa-cash-register"></i><span>Kasir / POS</span></a>
            <a href="orders/index.php" class="menu-item"><i class="fas fa-shopping-cart"></i><span>Riwayat
                    Pesanan</span></a>
            <div class="menu-section">Lainnya</div>
            <a href="../index.php" class="menu-item" target="_blank"><i class="fas fa-external-link-alt"></i><span>Lihat
                    Menu</span></a>
            <a href="logout.php" class="menu-item"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
        </nav>
    </aside>

    <main class="main-content">
        <div class="pos-container">
            <div class="products-section">
                <div class="search-bar">
                    <input type="text" placeholder="Cari produk..." id="searchProduct">
                </div>

                <div class="category-tabs">
                    <a href="pos.php" class="category-tab <?= !$category_id ? 'active' : '' ?>">Semua</a>
                    <?php foreach ($categories as $cat): ?>
                        <a href="?category=<?= $cat['id'] ?>"
                            class="category-tab <?= $category_id == $cat['id'] ? 'active' : '' ?>">
                            <?= $cat['nama_kategori'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="products-grid">
                    <?php foreach ($products as $product): ?>
                        <?php if ($product['status'] == 'active'): ?>
                            <div class="product-card"
                                onclick="addToCart(<?= $product['id'] ?>, '<?= $product['nama_produk'] ?>', <?= $product['harga'] ?>)">
                                <div class="product-icon"><i class="fas fa-coffee"></i></div>
                                <div class="product-name">
                                    <?= $product['nama_produk'] ?>
                                </div>
                                <div class="product-price">
                                    <?= formatCurrency($product['harga']) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="cart-section">
                <div class="cart-header">
                    <h2><i class="fas fa-shopping-cart"></i> Keranjang</h2>
                </div>

                <div class="cart-items">
                    <?php if (empty($cart)): ?>
                        <div class="empty-cart">
                            <i class="fas fa-shopping-basket" style="font-size: 3rem; margin-bottom: 15px;"></i>
                            <p>Keranjang kosong</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($cart as $id => $item): ?>
                            <div class="cart-item">
                                <div class="cart-item-info">
                                    <div class="cart-item-name">
                                        <?= $item['nama_produk'] ?>
                                    </div>
                                    <div class="cart-item-price">
                                        <?= formatCurrency($item['harga']) ?> x
                                        <?= $item['jumlah'] ?>
                                    </div>
                                </div>
                                <div class="cart-item-subtotal">
                                    <?= formatCurrency($item['subtotal']) ?>
                                </div>
                                <a href="?remove=<?= $id ?>" class="cart-item-remove"><i class="fas fa-times"></i></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <?php if (!empty($cart)): ?>
                    <div class="cart-footer">
                        <div class="cart-total">
                            <span class="cart-total-label">Total:</span>
                            <span class="cart-total-value">
                                <?= formatCurrency($cart_total) ?>
                            </span>
                        </div>

                        <form method="POST">
                            <div class="cart-actions">
                                <input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
                                <input type="text" name="nomor_meja" placeholder="Nomor Meja (opsional)" value="">
                                <select name="metode_pembayaran" required>
                                    <option value="tunai">Tunai</option>
                                    <option value="qris">QRIS</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                                <button type="submit" name="checkout" class="btn-checkout"><i class="fas fa-check"></i>
                                    Checkout</button>
                                <a href="?clear=1" class="btn-clear"
                                    style="text-align: center; text-decoration: none;">Batal</a>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>

</html>