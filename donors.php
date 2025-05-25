<?php
require 'db.php';  // Include your database connection

// Pagination Setup
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$offset = ($page - 1) * $records_per_page;

// Handle Search Query
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch Total Record Count
$total_stmt = $pdo->prepare("SELECT COUNT(*) FROM donors WHERE name LIKE :search");
$total_stmt->execute([':search' => "%$search%"]);
$total_records = $total_stmt->fetchColumn();
$total_pages = ceil($total_records / $records_per_page);

// Fetch Donors for Current Page
$stmt = $pdo->prepare("SELECT * FROM donors WHERE name LIKE :search LIMIT :limit OFFSET :offset");
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$donors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-body {
            padding: 20px;
        }

        .card-title {
            margin-bottom: 15px;
        }

        .pagination {
            justify-content: center;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .mb-4 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F5F5F5;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Thalassemia Manager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="patients.php">Patients</a></li>
                    <li class="nav-item"><a class="nav-link active" href="donors.php">Donors</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container mt-4">
        <h2>Donors</h2>

        <!-- Search Form -->
        <form method="GET" action="donors.php" class="mb-3 search-bar">
            <input type="text" name="search" placeholder="Search donors..." class="form-control" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary mt-2">Search</button>
            <?php if (!empty($search)): ?>
                <a href="donors.php" class="btn btn-secondary mt-2">Back</a>
            <?php endif; ?>
        </form>

        <!-- Donors List -->
        <div class="row">
            <?php if (!empty($donors)): ?>
                <?php foreach ($donors as $donor): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Donor Name and Details -->
                                <h5 class="card-title"><?php echo htmlspecialchars($donor['name']); ?></h5>
                                <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($donor['blood_group']); ?></p>
                                <p><strong>Last Donation Date:</strong> <?php echo htmlspecialchars($donor['last_donation_date']); ?></p>
                                <p><strong>Contact:</strong> <?php echo htmlspecialchars($donor['contact']); ?></p>
                                <p><strong>Address:</strong> <?php echo htmlspecialchars($donor['address']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No donors found.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="donors.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>">Previous</a>
                    </li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="donors.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="donors.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>">Next</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
