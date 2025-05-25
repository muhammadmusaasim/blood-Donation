<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thalassemia Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .social-links {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        .social-links a {
            display: block;
            margin: 10px 0;
            font-size: 30px;
            color: #fff;
            background-color: #333;
            padding: 10px;
            border-radius: 50%;
            text-align: center;
            transition: background-color 0.0s;
        }

        .social-links a:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #F5F5F5;">

    <div class="container-fluid">
       <a class="navbar-brand" href="index.php">
        <img src="new_images/nav_logo.png" alt="Logo" class="navbar-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link active" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="patients.php">Patients</a></li>
                <li class="nav-item"><a class="nav-link" href="donors.php">Donors</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
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
<div class="hero-section">
    <div class="overlay">
        <h1>Welcome to Thalassemia Manager</h1>
        <p>Your partner in managing Thalassemia with care and precision.</p>
    </div>
</div>


   <section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 text-danger">Our Focus Areas</h2>
        <div class="row">
            <!-- Topic 1 -->
            <div class="col-12 mb-4">
                <div class="d-flex flex-column align-items-center text-center">
                    <i class="fas fa-hand-holding-heart fa-3x text-danger mb-3"></i>
                    <h5 class="mb-2 text-danger">Blood Donation Support</h5>
                    <p>Bloodlines is dedicated to facilitating life-saving blood donations for thalassemia patients. We connect donors and patients through our innovative online platform, ensuring timely support and building a community of care.</p>
                </div>
            </div>
            <!-- Topic 2 -->
            <div class="col-12 mb-4">
                <div class="d-flex flex-column align-items-center text-center">
                    <i class="fas fa-users fa-3x text-danger mb-3"></i>
                    <h5 class="mb-2 text-danger">Donor Engagement</h5>
                    <p>We prioritize engaging with our blood donors, providing them with the necessary information and support throughout their donation journey.</p>
                </div>
            </div>
            <!-- Topic 3 -->
            <div class="col-12 mb-4">
                <div class="d-flex flex-column align-items-center text-center">
                    <i class="fas fa-bullhorn fa-3x text-danger mb-3"></i>
                    <h5 class="mb-2 text-danger">Raising Awareness</h5>
                    <p>Our goal is to raise awareness about the importance of regular blood donations and the impact it has on the lives of thalassemia patients.</p>
                </div>
            </div>
            <!-- Topic 4 -->
            <div class="col-12 mb-4">
                <div class="d-flex flex-column align-items-center text-center">
                    <i class="fas fa-chart-bar fa-3x text-danger mb-3"></i>
                    <h5 class="mb-2 text-danger">Data Analysis</h5>
                    <p>We analyze donation data to optimize our processes and ensure an efficient and effective blood donation system.</p>
                </div>
            </div>
            <!-- Topic 5 -->
            <div class="col-12 mb-4">
                <div class="d-flex flex-column align-items-center text-center">
                    <i class="fas fa-chalkboard-teacher fa-3x text-danger mb-3"></i>
                    <h5 class="mb-2 text-danger">Community Workshops</h5>
                    <p>We conduct workshops to educate the community about thalassemia, the significance of blood donations, and how they can contribute to saving lives.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- "GET INVOLVED" Button -->
<div class="text-center mt-5">
    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#getInvolvedModal">
        GET INVOLVED
    </button>
</div>

    <!-- Modal for Registration -->
    <div class="modal fade" id="getInvolvedModal" tabindex="-1" aria-labelledby="getInvolvedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="getInvolvedModalLabel">Join Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-4">Choose your role to get started:</p>
                    <div class="d-grid gap-3">
                        <!-- Blood Donor Option -->
                        <button class="btn btn-outline-primary btn-lg" onclick="location.href='register_donor.php';">Register as Blood Donor</button>
                        <!-- Patient Option -->
                        <button class="btn btn-outline-danger btn-lg" onclick="location.href='register_patient.php';">Register as Patient</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Team Banner Section -->
<section class="py-5">
  <h2 class="text-center mb-5 text-danger">Our Team</h2>
  <div class="team-banner-container">
    <img src="new_images/musa.jpg" alt="Our Team Banner" class="team-banner">
  </div>
</section>





<!-- Footer -->
<div class="footer mt-5 bg-light py-4">
    <div class="container">
        <div class="row">
            <!-- About Us Section -->
            <div class="col-md-4 mb-3">
                <h5>About Thalassemia Manager</h5>
                <p>
                    Thalassemia Manager is committed to providing a streamlined solution for managing thalassemia. We aim to connect patients with donors and raise awareness.
                </p>
            </div>
            
            <!-- Quick Links Section -->
            <div class="col-md-4 mb-3">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="home.php" class="text-decoration-none">Home</a></li>
                    <li><a href="patients.php" class="text-decoration-none">Patients</a></li>
                    <li><a href="donors.php" class="text-decoration-none">Donors</a></li>
                    <li><a href="contact.php" class="text-decoration-none">Contact</a></li>
                    <li><a href="about.php" class="text-decoration-none">About</a></li>
                  
                </ul>
            </div>
            
            <!-- Social Media Section -->
            <div class="col-md-4 mb-3">
                <h5>Follow Us</h5>
                <p>Stay connected through our social media channels:</p>
                <a href="https://facebook.com" target="_blank" class="text-decoration-none me-3">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://x.com/musaasim07/status/1873652406581637618" target="_blank" class="text-decoration-none me-3">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
                <a href="https://www.instagram.com/reel/DEMkZOsyKw_/?igsh=MThnbGpuYW05NmxycQ==" target="_blank" class="text-decoration-none me-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://www.linkedin.com/posts/muhammad-musa-asim-979954338_project-bloodlines-empowering-thalassemia-activity-7279417899138637824-FNMF?utm_source=share&utm_medium=member_desktop" target="_blank" class="text-decoration-none">
                    <i class="fab fa-linkedin fa-2x"></i>
                </a>
            </div>
        </div>
        <hr>
        <!--<div class="text-center">-->
        <!--    <p class="mb-0">&copy; 2025 Thalassemia Manager. All rights reserved. <a href="terms.php" class="text-decoration-none">Terms of Service</a></p>-->
        <!--</div>-->
    </div>
</div>

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</body>
</html>
