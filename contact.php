<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .contact-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
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
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="patients.php">Patients</a></li>
                <li class="nav-item"><a class="nav-link" href="donors.php">Donors</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="text-center mb-4">Contact Us</h1>
    
    <div class="row">
        <!-- Contact Information -->
        <div class="col-md-6 mb-4">
            <div class="contact-info">
                <h4>Our Contact Details</h4>
                <p><strong>Address:</strong> 123 Fake Street, Example City, Country</p>
                <p><strong>Email:</strong> contact@thalassemiamanager.com</p>
                <p><strong>Phone:</strong> +1 234 567 890</p>
                <p><strong>Working Hours:</strong> Mon-Fri, 9:00 AM - 6:00 PM</p>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="col-md-6">
            <h4>Send Us a Message</h4>
            <form action="submit_contact.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter subject" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" rows="5" class="form-control" placeholder="Write your message here" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer mt-5 bg-light py-3">
    <div class="container text-center">
        <p>&copy; 2025 Thalassemia Manager. All rights reserved.</p>
    </div>
</div>

</body>
</html>
