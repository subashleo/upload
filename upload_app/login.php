<?php
// login.php - Handle Login
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Simple hardcoded admin credentials (change these in production!)
    // For demo: username=admin, password=admin123
    if ($username == "admin" && $password == "admin123") {
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid credentials!";
    }
}
?>