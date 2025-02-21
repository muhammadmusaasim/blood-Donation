<?php
require 'db.php';  // Include your database connection

// Fetch all pending requests for the donor
$donor_id = $_GET['donor_id'];  // Example: Fetch donor ID from session or URL
$request_stmt = $pdo->prepare("SELECT * FROM blood_requests WHERE donor_id = :donor_id AND status = 'Pending'");
$request_stmt->execute([':donor_id' => $donor_id]);
$requests = $request_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Pending Blood Requests</h2>
        <div class="list-group">
            <?php foreach ($requests as $request): ?>
                <div class="list-group-item">
                    <h5>Patient ID: <?php echo $request['patient_id']; ?></h5>
                    <p><strong>Comments:</strong> <?php echo $request['comments']; ?></p>
                    <form action="update_request.php" method="POST">
                        <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
                        <button type="submit" name="status" value="Accepted" class="btn btn-success">Accept</button>
                        <button type="submit" name="status" value="Rejected" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
