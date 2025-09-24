<?php
include '../db.php';

$id = $_GET['id'];
  $stmt = $conn->prepare("DELETE FROM photos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: /e-commerce-php/admin/viewpadmin.php");
    exit;
    ?>
