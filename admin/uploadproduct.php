<!DOCTYPE html>
<html>
<head>
    <title>Upload Photo</title>
</head>
<body>
    <h2>Upload Photo</h2>
    <form action="/e-commerce-php/uploadsaved.php" method="post" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" required><br><br>

        <label>Price:</label>
        <input type="number" step="0.01" name="price" required><br><br>

        <label>Select Photo:</label>
        <input type="file" name="photo" accept="image/*" required><br><br>

        <button type="submit" name="upload">Upload</button>
    </form>

    <br>
    <a href="/e-commerce-php/admin/viewpAdmin.php">View Uploaded Photos</a>
</body>
</html>
