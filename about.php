<?php
// about.php - About Page for Blood Donation App
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Thalassemia Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css"> <!-- Custom Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="patients.php">Patients</a></li>
                <li class="nav-item"><a class="nav-link" href="donors.php">Donors</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
            </ul>
                       <!-- Login Button -->
            <div class="d-flex">
              <form action="login.php" method="post">
              <!-- Your input fields go here -->
              <button type="submit" class="btn btn-login">Login</button>
            </form>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
  <section class="hero1-section text-center bg-primary text-white py-5">
  <!-- <h1>About Thalassemia Manager</h1>
    <p>Empowering Lives Through Blood Donation</p>-->
</section>

<!-- About Content -->
<section class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <h2>Our Mission</h2>
            <p>We are committed to helping thalassemia patients by providing a streamlined platform to connect them with willing blood donors. Our goal is to make blood donation more efficient and accessible.</p>
        </div>
        <div class="col-md-6">
           <!-- <img src="uploads/about-mission.jpg" class="img-fluid rounded shadow" alt="Our Mission">-->
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
           <!-- <img src="uploads/about-howitworks.jpg" class="img-fluid rounded shadow" alt="How It Works">-->
        </div>
        <div class="col-md-6">
            <h2>How It Works</h2>
            <ul class="list-unstyled">
                <li><i class="fas fa-user-plus text-primary"></i> <strong>Step 1:</strong> Donors and patients register on our platform.</li>
                <li><i class="fas fa-tint text-danger"></i> <strong>Step 2:</strong> Patients request blood based on their needs.</li>
                <li><i class="fas fa-hand-holding-heart text-success"></i> <strong>Step 3:</strong> Donors receive requests and can accept or decline.</li>
                <li><i class="fas fa-hospital text-warning"></i> <strong>Step 4:</strong> Donors visit hospitals to complete donations.</li>
            </ul>
        </div>
    </div>

    <div class="row mt-5 text-center">
        <div class="col-12">
            <h2>Why Donate Blood?</h2>
            <p>Every blood donation can save up to three lives. By donating, you make a difference in the lives of thalassemia patients who rely on regular transfusions.</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<div class="text-center my-5">
    <a href="register_donor.php" class="btn btn-primary btn-lg">Become a Donor</a>
</div>

<!-- Footer -->
<div class="footer mt-5 bg-light py-4">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 mb-3">
                <h5>About Thalassemia Manager</h5>
                <p>We connect blood donors with thalassemia patients to ensure timely blood donations.</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="home.php" class="text-decoration-none">Home</a></li>
                    <li><a href="patients.php" class="text-decoration-none">Patients</a></li>
                    <li><a href="donors.php" class="text-decoration-none">Donors</a></li>
                    <li><a href="contact.php" class="text-decoration-none">Contact</a></li>
                    <li><a href="about.php" class="text-decoration-none">About</a></li>
                    <li><a href="privacy.php" class="text-decoration-none">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div class="col-md-4 mb-3">
                <h5>Follow Us</h5>
                <p>Stay connected through our social media channels:</p>
                <a href="https://facebook.com" target="_blank" class="text-decoration-none me-3">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://x.com" target="_blank" class="text-decoration-none me-3">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
                <a href="https://instagram.com" target="_blank" class="text-decoration-none me-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://linkedin.com" target="_blank" class="text-decoration-none">
                    <i class="fab fa-linkedin fa-2x"></i>
                </a>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p class="mb-0">&copy; 2025 Thalassemia Manager. All rights reserved. <a href="terms.php" class="text-decoration-none">Terms of Service</a></p>
        </div>
    </div>
</div>

</body>
</html>
