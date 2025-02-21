<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'db.php';
require 'vendor/autoload.php'; 
$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $blood_group = $_POST['blood_group'];
    $last_donation_date = $_POST['last_donation_date'];
    $availability = $_POST['availability'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $ngo_id = $_POST['ngo_id'];
    $token = bin2hex(random_bytes(32)); // Generate a secure random token

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT * FROM donors WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('This email is already registered!');</script>";
    } else {
        // Save donor details with verified = 0
        $stmt = $pdo->prepare("INSERT INTO donors (name, email, blood_group, last_donation_date, availability, contact, address, ngo_id, token, verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
        if ($stmt->execute([$name, $email, $blood_group, $last_donation_date, $availability, $contact, $address, $ngo_id, $token])) {
            
            // Send verification email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'your_email@gmail.com'; 
                $mail->Password = 'your_app_password'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('your_email@gmail.com', 'Blood Donation');
                $mail->addAddress($email, $name);
                $mail->Subject = 'Verify Your Email - Blood Donation';
                $mail->Body = "Click the link below to verify your email:\n\n" .
                    "http://yourwebsite.com/verify.php?token=" . $token;

                $mail->send();
                echo "<script>alert('A verification email has been sent to your email. Please check your inbox!');</script>";
            } catch (Exception $e) {
                echo "<script>alert('Error sending verification email: {$mail->ErrorInfo}');</script>";
            }
        } else {
            echo "<script>alert('Error: Could not register!');</script>";
        }
    }
}
?>
