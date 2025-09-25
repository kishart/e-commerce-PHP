<?php
session_start();
include '../db.php';

if (!isset($_SESSION['id'])) {
    header("Location: /e-commerce-PHP/login.php");
    exit;
}

$user_id = $_SESSION['id'];

$stmt = $conn->prepare("
    SELECT c.id AS cart_id, c.quantity, p.title, p.price, p.image
    FROM cart c
    JOIN photos p ON c.product_id = p.id
    WHERE c.user_id = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head><title>Your Cart</title></head>
<body>
    <?php include 'navbar.php'; ?>
    <h1>Your Cart</h1>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <img src="../<?php echo $row['image']; ?>" width="100">
            <strong><?php echo htmlspecialchars($row['title']); ?></strong>
            <p>₱<?php echo number_format($row['price'], 2); ?></p>
            <p>Quantity: <?php echo $row['quantity']; ?></p>
            <p><a href="/e-commerce-php/user/remove_from_cart.php?cart_id=<?php echo $row['cart_id']; ?>">remove</a></p>
        </div>
    <?php endwhile; ?>
</body>
</html>
