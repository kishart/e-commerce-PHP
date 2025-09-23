<?php
session_start();
include '../db.php';

// redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$username = $_SESSION['username'];

// fetch details from DB
$sql = "SELECT username, role FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
</head>
<body>
  <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
  <p>Role: <?php echo htmlspecialchars($user['role']); ?></p>
  <a href="../logout.php">Logout</a>
</body>
</html>
