<?php
require 'db.php';  // Include your database connection

// Fetch available donors with matching blood group
$patient_id = $_GET['patient_id'];  // Example: Fetch patient ID from session or URL
$patient_stmt = $pdo->prepare("SELECT * FROM patients WHERE patient_id = :patient_id");
$patient_stmt->execute([':patient_id' => $patient_id]);
$patient = $patient_stmt->fetch();

$donor_stmt = $pdo->prepare("SELECT * FROM donors WHERE blood_group = :blood_group AND availability = 'Available'");
$donor_stmt->execute([':blood_group' => $patient['blood_group']]);
$donors = $donor_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blood Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Create Blood Request</h2>
        <form action="submit_request.php" method="POST">
            <div class="mb-3">
                <label for="donor_id" class="form-label">Select Donor</label>
                <select name="donor_id" id="donor_id" class="form-select">
                    <?php foreach ($donors as $donor): ?>
                        <option value="<?php echo $donor['donor_id']; ?>"><?php echo $donor['name']; ?> (<?php echo $donor['blood_group']; ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="comments" class="form-label">Comments (Optional)</label>
                <textarea name="comments" id="comments" class="form-control"></textarea>
            </div>

            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
            <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
