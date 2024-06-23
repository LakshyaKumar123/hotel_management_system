<?php
// Database connection configuration
$host = 'localhost';
$dbname = 'hotel';
$username = 'root';
$password = 'Lakshya2003@shiv#';

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $e->getMessage()]);
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data from POST request
    $guestName = $_POST['guest_name'];
    $guestContact = $_POST['guest_contact'];
    $guestIdType = $_POST['guest_id_type'];
    $guestIdNo = $_POST['guest_id_number'];
    $bookingDate = $_POST['booking_date'];
    $checkInDate = $_POST['check_in_date'];
    $checkOutDate = $_POST['check_out_date'];
    $roomId = $_POST['room_id'];
    $amountPaid = $_POST['amount_paid'];

    // Check if the room is available for the specified date range
    $availabilityQuery = "
        SELECT COUNT(*) 
        FROM guest
        WHERE room_id = ?
        AND (
            (check_in <= ? AND check_out >= ?) OR
            (check_in <= ? AND check_out >= ?)
        )
    ";

    try {
        // Prepare the availability query
        $availabilityStmt = $pdo->prepare($availabilityQuery);
        // Bind values to the statement
        $availabilityStmt->execute([$roomId, $checkInDate, $checkInDate, $checkOutDate, $checkOutDate]);

        // Fetch the count result
        $count = $availabilityStmt->fetchColumn();

        // Check if the room is available
        if ($count > 0) {
            // Room is not available, send an error response
            echo json_encode(["success" => false, "message" => "The selected room is already booked during the specified date range."]);
        } else {
            // Room is available, proceed with booking

            // Prepare the SQL statement to insert data into the guest table
            $sql = "INSERT INTO guest (guest_name, guest_contact, guest_idtype, guest_idno, booking_date, check_in, check_out, room_id, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Prepare the SQL statement
            $stmt = $pdo->prepare($sql);

            // Bind values to the statement and execute the query
            $stmt->execute([
                $guestName,
                $guestContact,
                $guestIdType,
                $guestIdNo,
                $bookingDate,
                $checkInDate,
                $checkOutDate,
                $roomId,
                $amountPaid,
            ]);

            // Send a success response
            echo json_encode(["success" => true, "message" => "Booking data saved successfully!"]);
        }
    } catch (PDOException $e) {
        // Send an error response
        echo json_encode(["success" => false, "message" => "Error during room availability check: " . $e->getMessage()]);
    }
}

// Close the database connection
$pdo = null;
?>
