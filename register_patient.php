<?php
require 'db.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Check database connection
        if (!$pdo) {
            die("Database connection failed!");
        }

        // Collect and sanitize form data
        $name = $_POST['name'] ?? '';
        $blood_group = $_POST['blood_group'] ?? '';
        $required_date = $_POST['required_date'] ?? '';
        $status = $_POST['status'] ?? 'Pending';
        $contact = $_POST['contact'] ?? '';
        $address = $_POST['address'] ?? '';
        $email = $_POST['email'] ?? '';
        $ngo_id = $_POST['ngo_id'] ?? NULL; // Allow NULL if not provided

        // Validate required fields
        if (empty($name) || empty($blood_group) || empty($required_date) || empty($status) || empty($contact) || empty($address) || empty($email)) {
            die("Error: All fields except NGO ID are required.");
        }

        // Debugging: Check values before inserting
        ob_start();  // Start output buffering
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        ob_end_clean();  // Clear output buffer to prevent header issues

        // Prepare SQL Query
        $stmt = $pdo->prepare("INSERT INTO patients (name, blood_group, required_date, status, contact, address, email, ngo_id) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Execute Query
        if ($stmt->execute([$name, $blood_group, $required_date, $status, $contact, $address, $email, $ngo_id])) {
            header('Location: patients.php');  // Redirect AFTER clearing output
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
    <title>Register as Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-danger text-white text-center">
                <h2>Register as Patient</h2>
                <p>We are here to support you with blood donation needs.</p>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
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
                        <label for="required_date" class="form-label">Required Date</label>
                        <input type="date" class="form-control" id="required_date" name="required_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="contact" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger w-50">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
