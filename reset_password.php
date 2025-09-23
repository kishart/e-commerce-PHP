<?php

include("db.php");
session_start();

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $email = $_SESSION['reset_email'];

    $sql = "UPDATE users SET password='$newPassword' WHERE email='$email'";
    if (mysqli_query($conn, $sql)) {
        echo "Password updated successfully. <a href='login.php'>Login</a>";
        session_destroy();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    New Password: <input type="password" name="new_password" required>
    <button type="submit">Change Password</button>
</form>
