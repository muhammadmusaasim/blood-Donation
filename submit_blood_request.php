<?php
session_start();
include('db_connection.php'); // Include the database connection file

// Check if patient_id exists in session, if not redirect to login page
if (!isset($_SESSION['patient_id'])) {
    header('Location: login.php'); // Adjust to your login page
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $blood_group = $_POST['blood_group'];
    $required_date = $_POST['required_date'];
    $comments = $_POST['comments'];
    $patient_id = $_SESSION['patient_id']; // Patient ID from session

    // Prepare the SQL query to insert the blood request
    $sql = "INSERT INTO blood_requests (patient_id, blood_group, required_date, comments) 
            VALUES (:patient_id, :blood_group, :required_date, :comments)";

    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':patient_id' => $patient_id,
        ':blood_group' => $blood_group,
        ':required_date' => $required_date,
        ':comments' => $comments
    ]);

    // Redirect to success page after submission
    header('Location: success.php'); // Change this to the page you want to redirect after success
    exit();
}

?>

<!-- HTML form for blood request -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Blood Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Request Blood</h2>
        <form action="submit_blood_request.php" method="POST">
            <div class="mb-3">
                <label for="blood_group" class="form-label">Blood Group</label>
                <select name="blood_group" id="blood_group" class="form-control" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="required_date" class="form-label">Required Date</label>
                <input type="date" name="required_date" id="required_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="comments" class="form-label">Additional Comments</label>
                <textarea name="comments" id="comments" class="form-control" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
