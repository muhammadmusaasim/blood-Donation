<?php
require 'db.php';

if (isset($_GET['id'])) {
    $donor_id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM Donors WHERE id = :id");
        $stmt->execute([':id' => $donor_id]);
        $donor = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($donor) {
            echo "<h2>" . $donor['name'] . "</h2>";
            echo "<p><strong>Blood Group:</strong> " . $donor['blood_group'] . "</p>";
            echo "<p><strong>Last Donation:</strong> " . $donor['last_donation_date'] . "</p>";
            echo "<p><strong>Contact:</strong> " . $donor['contact'] . "</p>";
        } else {
            echo "<p>Donor not found.</p>";
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo "<p>No donor ID provided.</p>";
}
?>
