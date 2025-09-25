<?php
// Database connection
include '../db.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM photos ORDER BY uploaded_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Photos</title>
    <style>
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .item {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            width: 200px;
        }
        .item img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h2>Uploaded Photos</h2>
    <a href="/e-commerce-php/admin/uploadproduct.php">Upload New Photo</a>
    <br><br>

    <div class="gallery">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="item">
                  <a href="product.php?id=<?php echo $row['id']; ?>">
           
                <img src="../<?php echo $row['image']; ?>" alt="photo">
                <p><strong><?php echo htmlspecialchars($row['title']); ?></strong></p>
                <p>₱<?php echo number_format($row['price'], 2); ?></p>
                
               

            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
