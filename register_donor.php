<?php
require 'db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Debugging: Check if the database connection is working
        if (!$pdo) {
            die("Database connection failed!");
        }

        // Collect and sanitize form data
        $name = $_POST['name'] ?? '';
        $blood_group = $_POST['blood_group'] ?? '';
        $last_donation_date = !empty($_POST['last_donation_date']) ? $_POST['last_donation_date'] : NULL;
        $availability = $_POST['availability'] ?? 'Available';
        $contact = $_POST['contact'] ?? '';
        $address = $_POST['address'] ?? '';
        $ngo_id = !empty($_POST['ngo_id']) ? $_POST['ngo_id'] : NULL; // Allow NULL

        // Validate required fields
        if (empty($name) || empty($blood_group) || empty($availability) || empty($contact) || empty($address)) {
            die("Error: Required fields are missing.");
        }

        // Debugging: Output form data before insertion
        ob_start(); // Start output buffering
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        ob_end_clean(); // Clear output buffer to prevent header issues

        // Prepare SQL Query
        $stmt = $pdo->prepare("INSERT INTO donors (name, blood_group, last_donation_date, availability, contact, address, ngo_id) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Execute Query
        if ($stmt->execute([$name, $blood_group, $last_donation_date, $availability, $contact, $address, $ngo_id])) {
            header('Location: donors.php'); // Redirect AFTER clearing output
            exit();
        } else {
            echo "Error: Failed to insert data.";
        }

    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as Donor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h2>Register as Blood Donor</h2>
                <p>Join our life-saving mission and make a difference!</p>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <select class="form-select" id="blood_group" name="blood_group" required>
                            <option value="" disabled selected>Select your blood group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="last_donation_date" class="form-label">Last Donation Date</label>
                        <input type="date" class="form-control" id="last_donation_date" name="last_donation_date">
                    </div>
                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select class="form-select" id="availability" name="availability" required>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter your contact number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="ngo_id" class="form-label">NGO ID</label>
                        <input type="text" class="form-control" id="ngo_id" name="ngo_id" placeholder="Enter your NGO ID" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary w-50">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
