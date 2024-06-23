<?php
$servername = "localhost";
$username = "root";
$password = "Lakshya2003@shiv#";
$dbname = "hotel";
$port = 3306;
$username = $_POST["username"];
$password = $_POST["password"];
$mysqli = new mysqli($servername, $username, $password, $dbname, $port);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM employee WHERE username='$username' AND password='$password'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $position = $row['position']; // Update the variable to match the column name
    
    if ($position === 'admin') {
        header("Location: index.html"); // Redirect admin users to admin dashboard
        exit();
    } else {
        header("Location: index.html"); // Redirect regular users to their dashboard
        exit();
    }
} else {
    echo "<br>No Record Found";
}

$mysqli->close();
?>
