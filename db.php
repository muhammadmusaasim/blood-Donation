<?php
// Example database connection using PDO
$host = 'localhost';
$dbname = 'bloodlines_db';
$username = 'bloodlines_user';
$password = 'asim@musa';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>