<?php
// view.php - View Uploaded Files
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.html");
    exit;
}

include 'db.php';

$sql = "SELECT id, filename, description, upload_date FROM uploads ORDER BY upload_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Files</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Uploaded Files</h2>
        <a href="dashboard.php">Back to Dashboard</a>
        
        <table>
            <tr>
                <th>ID</th>
                <th>Filename</th>
                <th>Description</th>
                <th>Upload Date</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["filename"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["upload_date"] . "</td>";
                    echo "<td><a href='" . $row["filename"] . "' target='_blank'>View</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No files uploaded yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>