<?php
include '../db.php';

if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];

    // Check if user uploaded a new photo
    if (!empty($_FILES["photo"]["name"])) {
        $targetDir = __DIR__ . "/../uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName   = time() . "_" . basename($_FILES["photo"]["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType   = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                $relativePath = "uploads/" . $fileName;
                $stmt = $conn->prepare("UPDATE photos SET title=?, price=?, image=? WHERE id=?");
                $stmt->bind_param("sdsi", $title, $price, $relativePath, $id);
            } else {
                die("Error uploading new file.");
            }
        } else {
            die("Invalid file type. Only JPG, JPEG, PNG, GIF allowed.");
        }
    } else {
        // No new image → only update title and price
        $stmt = $conn->prepare("UPDATE photos SET title=?, price=? WHERE id=?");
        $stmt->bind_param("sdi", $title, $price, $id);
    }

    if ($stmt->execute()) {
        echo "<script>
                alert('Product updated successfully!');
                window.location.href = '/e-commerce-php/admin/viewpadmin.php';
              </script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
