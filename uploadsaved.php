<?php
include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];

    $targetDir = __DIR__ . "/uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // create if not exists
    }

    $fileName = time() . "_" . basename($_FILES["photo"]["name"]);
    $targetFile = $targetDir . $fileName;

    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Allowed formats
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedTypes)) {
        die("Only JPG, JPEG, PNG & GIF allowed.");
    }

    // Move file
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
        $relativePath = "uploads/" . $fileName;

        $stmt = $conn->prepare("INSERT INTO photos (title, price, image) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $title, $price, $relativePath);

        if ($stmt->execute()) {
            // ✅ Alert + redirect back to upload.php
            echo "<script>
                    alert('Upload Success');
                    window.location.href = '/e-commerce-php/admin/uploadproduct.php';
                  </script>";
            exit;
        } else {
            echo "Database error: " . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
