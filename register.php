<?php
include("db.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $question = $_POST['security_question'];
    $answer = password_hash (strtolower($_POST['security_answer']), PASSWORD_DEFAULT); // hash answer for security

    $sql = "INSERT INTO users (fname, email, password, security_question, security_answer)
            VALUES ('$fname', '$email', '$password', '$question', '$answer')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Registered successfully. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    Name: <input type="text" name="fname" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Security Question: <input type="text" name="security_question" required><br>
    Security Answer: <input type="text" name="security_answer" required><br>
    <button type="submit">Register</button>
</form>
