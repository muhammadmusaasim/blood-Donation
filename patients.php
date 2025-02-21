<?php
// Include the database connection
require 'db.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set up pagination variables
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$offset = ($page - 1) * $records_per_page;

// Handle the search query
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch the total number of patients for pagination
$total_stmt = $pdo->prepare("SELECT COUNT(*) FROM patients WHERE name LIKE :search");
$total_stmt->execute([':search' => "%$search%"]);
$total_records = $total_stmt->fetchColumn();
$total_pages = ceil($total_records / $records_per_page);

// Fetch patients along with the associated NGO name and image
$stmt = $pdo->prepare("SELECT patients.*, ngos.name AS ngo_name, ngos.image AS ngo_image 
                       FROM patients 
                       LEFT JOIN ngos ON patients.ngo_id = ngos.id
                       WHERE patients.name LIKE :search 
                       LIMIT :limit OFFSET :offset");
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-content {
            flex: 1;
            padding-right: 15px;
        }

        .right-content {
            text-align: center;
            flex-shrink: 0;
            margin-left: 15px;
        }

        .ngo-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Thalassemia Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="patients.php">Patients</a></li>
                    <li class="nav-item"><a class="nav-link" href="donors.php">Donors</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Patients</h2>

        <!-- Search Form -->
        <form method="GET" action="patients.php" class="input-group search-bar">
            <input type="text" name="search" class="form-control" placeholder="Search patients..." value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-primary" type="submit">Search</button>
            <?php if (!empty($search)): ?>
                <a href="patients.php" class="btn btn-secondary">Clear</a>
            <?php endif; ?>
        </form>

        <!-- Patients List -->
        <div class="row">
            <?php if (!empty($patients)): ?>
                <?php foreach ($patients as $patient): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Left Content (Patient Details) -->
                                <div class="left-content">
                                    <h5 class="card-title"><?php echo htmlspecialchars($patient['name']); ?></h5>
                                    <p class="card-text">
                                        Blood Group: <?php echo htmlspecialchars($patient['blood_group']); ?>
                                    </p>
                                    
                                    <p class="card-text">
                                        Required Date: <?php echo htmlspecialchars($patient['required_date']); ?>
                                    </p>
                                    <p class="card-text">
                                        Status: <?php echo htmlspecialchars($patient['status']); ?>
                                    </p>
                                </div>
                                
                                <!-- Right Content (NGO Image) -->
                                <div class="right-content">
                                    <?php if (!empty($patient['ngo_image'])): ?>
                                        <img src="<?php echo htmlspecialchars($patient['ngo_image']); ?>" alt="NGO Image" class="ngo-image">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    No patients found.
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="patients.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Previous</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="patients.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="patients.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
