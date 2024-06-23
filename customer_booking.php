<?php
// Establish connection to the database
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "Lakshya2003@shiv#"; // Replace with your MySQL password
$dbname = "hotel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching values from the form
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$dob = $_POST['dob'] ?? '';
$age = $_POST['age'] ?? '';
$gender = $_POST['gender'] ?? '';
$country = $_POST['country'] ?? '';
$address = $_POST['address'] ?? '';
$id_type = $_POST['id_type'] ?? '';
$id_number = $_POST['id_number'] ?? '';
$room_type = $_POST['room_type'] ?? '';
$room_number = isset($_POST['room_number']) ? intval($_POST['room_number']) : 0;
$person_number = isset($_POST['person_number']) ? intval($_POST['person_number']) : 0;
$child_number = isset($_POST['child_number']) ? intval($_POST['child_number']) : 0;

// Convert "yes" and "no" values to 1 and 0 for facilities
$res_facilities = ($_POST['res_facilities'] ?? '') === 'yes' ? 1 : 0;

$breakfast = isset($_POST['breakfast']) ? intval($_POST['breakfast']) : 0;
$lunch = isset($_POST['lunch']) ? intval($_POST['lunch']) : 0;
$dinner = isset($_POST['dinner']) ? intval($_POST['dinner']) : 0;

// Validate and format check-in date
$check_in_date_str = $_POST['check_in_date'] ?? '';
$check_in_date = date('Y-m-d', strtotime($check_in_date_str));
if (!$check_in_date) {
    echo "Error: Invalid check-in date";
    exit; // Stop further execution
}

// Validate and format check-out date
$check_out_date_str = $_POST['check_out_date'] ?? '';
$check_out_date = date('Y-m-d', strtotime($check_out_date_str));
if (!$check_out_date) {
    echo "Error: Invalid check-out date";
    exit; // Stop further execution
}

$stay_days = isset($_POST['stay_days']) ? intval($_POST['stay_days']) : 0;

// Calculate total cost
$room_prices = [
    '2' => 1000, // Standard
    '4' => 2000, // Deluxe
    '6' => 3000, // Superior Deluxe
    '7' => 4000, // Premier Deluxe
    '10' => 5000, // Executive Suite
    '11' => 6000, // Junior Suite
    '13' => 7000  // Honeymoon Suite
];

$room_cost = $room_prices[$room_type] ?? 0;
$total_room_cost = $room_cost * $room_number * $stay_days;

$food_cost = ($breakfast + $lunch + $dinner) * $person_number;
$total_food_cost = $res_facilities ? $food_cost * $stay_days : 0;

$total_cost = $total_room_cost + $total_food_cost;

// Prepare and bind statement
$stmt = $conn->prepare("INSERT INTO guest (name, email, phone, dob, age, gender, country, address, id_type, id_number, room_type, room_number, person_number, child_number, res_facilities, breakfast, lunch, dinner, check_in_date, check_out_date, stay_days, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisssssssssssssssss", $name, $email, $phone, $dob, $age, $gender, $country, $address, $id_type, $id_number, $room_type, $room_number, $person_number, $child_number, $res_facilities, $breakfast, $lunch, $dinner, $check_in_date, $check_out_date, $stay_days, $total_cost);

// Execute statement
if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
