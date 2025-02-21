<?php
require 'db.php';  // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $patient_id = $_POST['patient_id'];
    $donor_id = $_POST['donor_id'];
    $comments = $_POST['comments'];

    // Insert request into the database
    $stmt = $pdo->prepare("INSERT INTO blood_requests (patient_id, donor_id, comments) VALUES (:patient_id, :donor_id, :comments)");
    $stmt->execute([
        ':patient_id' => $patient_id,
        ':donor_id' => $donor_id,
        ':comments' => $comments
    ]);

    echo "Request submitted successfully!";
}
?>
