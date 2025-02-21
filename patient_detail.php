<?php
require 'db.php';  // Include your database connection

// Get Patient ID from URL
$patient_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($patient_id === 0) {
    // Redirect to patients list if no valid ID is passed
    header('Location: patients.php');
    exit;
}

// Fetch Patient Details from Database
$stmt = $pdo->prepare("SELECT * FROM patients WHERE id = :id");
$stmt->execute([':id' => $patient_id]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch associated NGO details
$ngo_stmt = $pdo->prepare("SELECT * FROM ngos WHERE id = :ngo_id");
$ngo_stmt->execute([':ngo_id' => $patient['ngo_id']]);
$ngo = $ngo_stmt->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
    echo "Patient not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .patient-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .patient-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }
        .patient-card h3 {
            margin-bottom: 20px;
            color: #007bff;
        }
        .patient-card .details p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        .patient-card .details strong {
            color: #555;
        }
        .ngo-info {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .ngo-info img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Thalassemia Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="patients.php">Back to Patients</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Patient Details Section -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Patient Card -->
                <div class="patient-card">
                    <div class="row">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            <!-- Patient Info -->
                            <h3><?php echo htmlspecialchars($patient['name']); ?></h3>
                            <div class="details">
                                <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($patient['blood_group']); ?></p>
                                <p><strong>Required Date:</strong> <?php echo htmlspecialchars($patient['required_date']); ?></p>
                                <p><strong>Status:</strong> <?php echo htmlspecialchars($patient['status']); ?></p>
                            </div>

                            <!-- NGO Info -->
                            <?php if ($ngo): ?>
                                <div class="ngo-info">
                                    <h5>NGO Details</h5>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="uploads/<?php echo htmlspecialchars($ngo['image']); ?>" alt="NGO Image">
                                        </div>
                                        <div class="col-md-10">
                                            <p><strong>NGO Name:</strong> <?php echo htmlspecialchars($ngo['name']); ?></p>
                                            <p><strong>Contact:</strong> <?php echo htmlspecialchars($ngo['contact']); ?></p>
                                            <p><strong>Address:</strong> <?php echo htmlspecialchars($ngo['address']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p><strong>No associated NGO found.</strong></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
