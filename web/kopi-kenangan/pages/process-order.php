<?php
/**
 * Process Online Order
 * Handles AJAX order submission from website
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/functions.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$response = [
    'success' => false,
    'message' => '',
    'order_id' => null,
    'kode_order' => ''
];

try {
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Metode request tidak valid');
    }

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // If no JSON, try form data
    if (!$input) {
        $input = $_POST;
    }

    // Validate required fields
    $required_fields = ['nama_pelanggan', 'nomor_meja', 'metode_pembayaran'];
    foreach ($required_fields as $field) {
        if (empty($input[$field])) {
            throw new Exception('Field ' . ucfirst(str_replace('_', ' ', $field)) . ' wajib diisi');
        }
    }

    // Get cart items
    $cart_items = isset($input['cart_items']) ? $input['cart_items'] : [];

    if (empty($cart_items)) {
        throw new Exception('Keranjang belanja kosong');
    }

    // Sanitize inputs
    $nama_pelanggan = sanitize($input['nama_pelanggan']);
    $nomor_meja = sanitize($input['nomor_meja']);
    $metode_pembayaran = sanitize($input['metode_pembayaran']);
    $catatan = isset($input['catatan']) ? sanitize($input['catatan']) : '';

    // Validate payment method
    $allowed_payment_methods = ['tunai', 'qris', 'transfer'];
    if (!in_array($metode_pembayaran, $allowed_payment_methods)) {
        throw new Exception('Metode pembayaran tidak valid');
    }

    // Calculate total price
    $total_harga = 0;
    $order_items = [];

    foreach ($cart_items as $item) {
        $product_id = (int) $item['productId'];
        $quantity = (int) $item['quantity'];
        $price = (float) $item['price'];

        // Get product details to verify price
        $product = getProductById($product_id);
        if (!$product) {
            throw new Exception('Produk tidak ditemukan: ' . $item['productName']);
        }

        $subtotal = $price * $quantity;
        $total_harga += $subtotal;

        $order_items[] = [
            'produk_id' => $product_id,
            'jumlah' => $quantity,
            'harga' => $price,
            'subtotal' => $subtotal
        ];
    }

    // Generate order code
    $kode_order = generateKodeOrder();

    // Create order in database
    $order_id = createOnlineOrder(
        $kode_order,
        $nama_pelanggan,
        $nomor_meja,
        $total_harga,
        $metode_pembayaran,
        $catatan,
        $order_items
    );

    if ($order_id) {
        $response['success'] = true;
        $response['message'] = 'Pesanan berhasil dibuat!';
        $response['order_id'] = $order_id;
        $response['kode_order'] = $kode_order;
    } else {
        throw new Exception('Gagal menyimpan pesanan ke database');
    }

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Return JSON response
echo json_encode($response);
exit;

