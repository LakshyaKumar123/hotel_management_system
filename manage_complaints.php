<?php
// Configure the MySQL database connection details
$host = 'localhost';
$db_username = 'root'; // Replace with your MySQL user
$db_password = 'Lakshya2003@shiv#'; // Replace with your MySQL password
$dbname = 'hotel';
$port = 3306; // Default MySQL port

// Retrieve form data
$complainant_name = $_POST['complainant_name'];
$complaint_type = $_POST['complaint_type'];
$complaint_description = $_POST['complaint_description'];

// Establish a connection to the MySQL database
$mysqli = new mysqli($host, $db_username, $db_password, $dbname, $port);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare a statement to prevent SQL injection
$sql = "INSERT INTO complaint (complainant_name, complaint_type, complaint_description) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($sql);
if ($stmt === false) {
    die("Error preparing statement: " . $mysqli->error);
}

$stmt->bind_param('sss', $complainant_name, $complaint_type, $complaint_description);
if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
}


// Execute the prepared statement
if ($stmt->execute()) {
    // Send a success response back to the client
    echo json_encode(["success" => true]);
} else {
    // Send an error response back to the client
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

// Close the prepared statement and database connection
$stmt->close();
$mysqli->close();
?>
