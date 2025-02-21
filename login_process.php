<?php
session_start();

// Include the database connection file
include('db.php'); // Adjust this path if necessary

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;
    $role = isset($_POST['role']) ? strtolower($_POST['role']) : null; // Convert role to lowercase

    // echo "Submitted Data: <br>";
    // echo "Email: $email <br>";
    // echo "Password: $password <br>";
    // echo "Role: $role <br>";

    // Validate the database connection
    if ($pdo) {
        // Prepare the SQL query to check user credentials
        $sql = "SELECT * FROM users WHERE email = :email AND LOWER(role) = LOWER(:role)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email, ':role' => $role]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // // Debug output
        // echo "Database Query Executed<br>";
        // if ($user) {
        //     echo "User Found: <br>";
        //     print_r($user); // Print user data
        // } else {
        //     echo "No user found for the provided email and role.<br>";
        // }

        // Verify the password (direct comparison)
        if ($user && $password === $user['password']) {
          //  echo "Password Matched<br>";
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Redirect to the appropriate dashboard based on role
            switch ($user['role']) {
                case 'Patient':
                   // echo "Redirecting to patient_dashboard.php<br>";
                    header('Location: patient_dashboard.php');
                    break;
                case 'Donor':
                   // echo "Redirecting to donor_dashboard.php<br>";
                    header('Location: donor_dashboard.php');
                    break;
                case 'Ngo':
                  //  echo "Redirecting to ngo_dashboard.php<br>";
                    header('Location: ngo_dashboard.php');
                    break;
                default:
                   // echo "Redirecting to dashboard.php<br>";
                    header('Location: dashboard.php');
            }
            exit();
        } else {
            echo "Invalid email, password, or role.<br>";
        }
    } else {
        echo "Database connection failed.<br>";
    }
}
?>
