<?php
session_start();

// Check if the donor is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Donor') {
    header('Location: login.php');
    exit();
}

// Include the database connection
include('db.php');

// Handle request actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['request_id'])) {
    $action = $_POST['action'];
    $request_id = $_POST['request_id'];

    if ($action === 'accept') {
        // Update blood request status and assign donor
        $sql = "UPDATE blood_requests SET status = 'Accepted', donor_id = :donor_id, donor_info_shared = TRUE WHERE id = :request_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':donor_id' => $_SESSION['user_id'], ':request_id' => $request_id]);
    } elseif ($action === 'reject') {
        // Update status to Rejected
        $sql = "UPDATE blood_requests SET status = 'Rejected' WHERE id = :request_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':request_id' => $request_id]);
    }
}

// Fetch pending blood requests
$sql = "SELECT r.*, p.username AS patient_name 
        FROM blood_requests r 
        JOIN users p ON r.patient_id = p.id 
        WHERE r.status = 'Pending'";
$stmt = $pdo->query($sql);
$pending_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch donation history
$sql = "SELECT r.*, p.username AS patient_name 
        FROM blood_requests r 
        JOIN users p ON r.patient_id = p.id 
        WHERE r.donor_id = :donor_id AND r.status != 'Pending'";
$stmt = $pdo->prepare($sql);
$stmt->execute([':donor_id' => $_SESSION['user_id']]);
$donation_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Donor Dashboard</h2>
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <hr>

        <h4>Pending Blood Requests</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Blood Type</th>
                    <th>Quantity</th>
                    <th>Required Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($pending_requests) > 0): ?>
                    <?php foreach ($pending_requests as $request): ?>
                        <tr>
                            <td><?= htmlspecialchars($request['patient_name']) ?></td>
                            <td><?= htmlspecialchars($request['blood_type']) ?></td>
                            <td><?= htmlspecialchars($request['quantity']) ?></td>
                            <td><?= htmlspecialchars($request['required_date']) ?></td>
                            <td>
                                <form action="donor_dashboard.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                                    <button type="submit" name="action" value="accept" class="btn btn-success btn-sm">Accept</button>
                                </form>
                                <form action="donor_dashboard.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                                    <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No pending requests.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <hr>

        <h4>Donation History</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Blood Type</th>
                    <th>Quantity</th>
                    <th>Required Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($donation_history) > 0): ?>
                    <?php foreach ($donation_history as $history): ?>
                        <tr>
                            <td><?= htmlspecialchars($history['patient_name']) ?></td>
                            <td><?= htmlspecialchars($history['blood_type']) ?></td>
                            <td><?= htmlspecialchars($history['quantity']) ?></td>
                            <td><?= htmlspecialchars($history['required_date']) ?></td>
                            <td><?= htmlspecialchars($history['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No donation history available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
