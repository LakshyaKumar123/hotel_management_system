<?php
// Database connection
$servername = "localhost"; // Your MySQL server address
$username = "root"; // Your MySQL username
$password = "Lakshya2003@shiv#"; // Your MySQL password
$database = "hotel"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$employee_id = $_POST['employee_id'];
$name = $_POST['name'];
$position = $_POST['position'];
$contact_no = $_POST['contact_no'];
$address = $_POST['address'];
$salary = $_POST['salary'];

// Prepare the SQL query to insert data into the employee table
$sql = "INSERT INTO employee (`employee_id`, `name`, `position`, `contact_no`, `address`, `salary`)
        VALUES ('$employee_id', '$name', '$position', '$contact_no', '$address', '$salary')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Employee added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
