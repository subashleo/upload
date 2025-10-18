<?php
// upload.php - Handle File Upload
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit;
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = $_POST['description'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats (e.g., images, pdfs - customize as needed)
    if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" && $fileType != "pdf") {
        echo "Sorry, only JPG, JPEG, PNG, GIF & PDF files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Insert into database
            $sql = "INSERT INTO uploads (filename, description) VALUES ('$target_file', '$description')";
            if ($conn->query($sql) === TRUE) {
                echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
header("Location: dashboard.php"); // Redirect back to dashboard
?>