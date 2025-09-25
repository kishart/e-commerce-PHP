<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id'])) {
    header("Location: /e-commerce-PHP/login.php");
    exit;
}

if (isset($_GET['cart_id'])) {
    $cart_id = intval($_GET['cart_id']);
    $user_id = $_SESSION['id'];

    // Delete only the cart item that belongs to this user
    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_id, $user_id);
    $stmt->execute();

    header("Location: /e-commerce-PHP/user/cart.php");
    exit;
}
?>
