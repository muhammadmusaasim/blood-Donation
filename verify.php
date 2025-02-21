<?php
require 'db.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token exists
    $stmt = $pdo->prepare("SELECT * FROM Donors WHERE token = ?");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        // Mark donor as verified
        $stmt = $pdo->prepare("UPDATE Donors SET verified = 1, token = '' WHERE token = ?");
        $stmt->execute([$token]);

        echo "<script>alert('Email verified successfully! You can now log in.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Invalid or expired token!'); window.location.href='register.php';</script>";
    }
} else {
    echo "<script>alert('No token provided!'); window.location.href='register.php';</script>";
}
?>
