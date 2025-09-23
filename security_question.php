<?php
session_start();

if (!isset($_SESSION['security_question'])) {
    header("Location: forgot_password.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer = $_POST['answer'];

    if (password_verify($answer, $_SESSION['security_answer'])) {
        header("Location: reset_password.php");
        exit();
    } else {
        echo "Incorrect answer!";
    }
}
?>

<p>Security Question: <?php echo $_SESSION['security_question']; ?></p>
<form method="POST">
    Your Answer: <input type="text" name="answer" required>
    <button type="submit">Verify</button>
</form>
