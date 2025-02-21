<?php
session_start();
// Check if the patient is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header('Location: login.php'); // Redirect to login if not logged in or role is not 'patient'
    exit();
}

// Include the database connection
include('db.php');

// Handle the blood request form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blood_type = $_POST['blood_type'];
    $quantity = $_POST['quantity'];
    $required_date = $_POST['required_date'];
    $patient_id = $_SESSION['user_id']; // Logged-in patient ID

    $sql = "INSERT INTO blood_requests (patient_id, blood_type, quantity, required_date, status) 
            VALUES (:patient_id, :blood_type, :quantity, :required_date, 'Pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':patient_id' => $patient_id,
        ':blood_type' => $blood_type,
        ':quantity' => $quantity,
        ':required_date' => $required_date,
    ]);

    $message = "Blood request submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container dashboard-container">
        <div class="logout-container">
            <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!</p>
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger logout-btn">Logout</button>
            </form>
        </div>

        <h2 class="text-center">Patient Dashboard</h2>

        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="patient_dashboard.php" method="POST">
            <div class="mb-3">
                <label for="blood_type" class="form-label">Blood Type</label>
                <select name="blood_type" id="blood_type" class="form-control" required>
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
                <label for="quantity" class="form-label">Quantity (in units)</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="required_date" class="form-label">Required Date</label>
                <input type="date" name="required_date" id="required_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit Request</button>
        </form>

        <hr>

        <h4>Your Requests</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Blood Type</th>
                    <th>Quantity</th>
                    <th>Required Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM blood_requests WHERE patient_id = :patient_id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':patient_id' => $_SESSION['user_id']]);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                        <td>{$row['blood_type']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['required_date']}</td>
                        <td>{$row['status']}</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
