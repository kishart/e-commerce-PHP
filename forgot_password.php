<?php

include("db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        // Step 1: find user
        $email = $_POST['email'];
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['reset_email'] = $user['email'];
            $_SESSION['security_question'] = $user['security_question'];
            $_SESSION['security_answer'] = strtolower($user['security_answer']);
            header("Location: security_question.php");
            exit();
        } else {
            echo "Email not found!";
        }
    }
}
?>

<form method="POST">
    Enter your email: <input type="email" name="email" required>
    <button type="submit">Submit</button>
</form>
