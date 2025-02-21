<?php
session_start();

if (!isset($_SESSION['patient_id'])) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Submitted</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Blood Request Submitted Successfully</h2>
        <p>Your blood request has been successfully submitted. You will be notified once a donor accepts your request.</p>
        <a href="patients_request_blood.php" class="btn btn-primary">Go Back to Requests</a>
    </div>
</body>
</html>
