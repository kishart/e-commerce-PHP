<?php
include '../db.php';

$id = $_GET['id'];
$stmt = $conn->query("SELECT * FROM photos WHERE id = $id");
$row = $stmt->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="/e-commerce-php/admin/update.php" method="post" enctype="multipart/form-data">
        <!-- Hidden ID -->
        <input type="hidden" name="id" value="<?= $row['id']; ?>">

        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($row['title']); ?>" required><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="<?= $row['price']; ?>" required><br><br>

        <label>Current Photo:</label><br>
        <img src="../<?= $row['image']; ?>" width="150"><br><br>

        <label>Change Photo (optional):</label>
        <input type="file" name="photo" accept="image/*"><br><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
