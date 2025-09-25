<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // ✅ Store user ID so cart.php and product.php can use it
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // ✅ If there's a redirect param → go back there
        if (!empty($_GET['redirect'])) {
            header("Location: " . $_GET['redirect']);
            exit;
        }

        // ✅ Otherwise redirect by role
        if ($user['role'] === 'admin') {
            header("Location: /e-commerce-PHP/admin/admin_dashboard.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>
