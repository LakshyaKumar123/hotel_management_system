<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "Lakshya2003@shiv#";
$dbname = "hotel";

// Create a MySQLi connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query the database to get data for the dashboard
// Fetch total rooms
$total_rooms_query = "SELECT COUNT(*) AS total_rooms FROM rooms_table";
$total_rooms_result = $mysqli->query($total_rooms_query);
$total_rooms_row = $total_rooms_result->fetch_assoc();
$total_rooms = $total_rooms_row['total_rooms'];

// Fetch total rooms booked
$rooms_booked_query = "SELECT COUNT(*) AS rooms_booked FROM bookings_table WHERE status='booked'";
$rooms_booked_result = $mysqli->query($rooms_booked_query);
$rooms_booked_row = $rooms_booked_result->fetch_assoc();
$rooms_booked = $rooms_booked_row['rooms_booked'];

// Calculate vacant rooms
$vacant_rooms = $total_rooms - $rooms_booked;

// Fetch total employees
$total_employees_query = "SELECT COUNT(*) AS total_employees FROM employee_table";
$total_employees_result = $mysqli->query($total_employees_query);
$total_employees_row = $total_employees_result->fetch_assoc();
$total_employees = $total_employees_row['total_employees'];

// Close the database connection
$mysqli->close();
?>
