<?php
session_start();
include '../db.php'; // adjust path if needed

// Must be logged in (we use session id from users table)
if (!isset($_SESSION['id'])) {
    // if not logged in, redirect to login with redirect back to product
    $redirect = 'product.php' . (isset($_POST['product_id']) ? '?id=' . intval($_POST['product_id']) : '');
    header("Location: /e-commerce-PHP/login.php?redirect=" . urlencode($redirect));
    exit;
}

$user_id = intval($_SESSION['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);
    if ($quantity < 1) $quantity = 1;

    // verify product exists (optional but recommended)
    $pstmt = $conn->prepare("SELECT id FROM photos WHERE id = ?");
    $pstmt->bind_param("i", $product_id);
    $pstmt->execute();
    $pres = $pstmt->get_result();
    if ($pres->num_rows === 0) {
        // product doesn't exist
        header("Location: index.php");
        exit;
    }

    // Check if item already in cart for this user
    $stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        // update quantity
        $newQty = $row['quantity'] + $quantity;
        $u = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $u->bind_param("ii", $newQty, $row['id']);
        $u->execute();
    } else {
        // insert new
        $i = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $i->bind_param("iii", $user_id, $product_id, $quantity);
        $i->execute();
    }

    // go to cart page
    header("Location: /e-commerce-PHP/user/cart.php");
    exit;
}

// fallback
header("Location: /e-commerce-PHP/index.php");
exit;
