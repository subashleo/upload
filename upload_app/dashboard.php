<?php
// dashboard.php - Protected Page
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <a href="logout.php">Logout</a>
        
        <h3>Upload File</h3>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="file">Select File:</label>
            <input type="file" id="file" name="file" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            
            <button type="submit">Upload</button>
        </form>
        
        <h3>View Uploaded Files</h3>
        <a href="view.php">View Files</a>
    </div>
</body>
</html>