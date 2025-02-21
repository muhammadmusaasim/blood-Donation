<?php
require 'db.php';  // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $status = $_POST['status'];

    // Update request status
    $stmt = $pdo->prepare("UPDATE blood_requests SET status = :status WHERE request_id = :request_id");
    $stmt->execute([
        ':status' => $status,
        ':request_id' => $request_id
    ]);

    echo "Request status updated successfully!";
}
?>
