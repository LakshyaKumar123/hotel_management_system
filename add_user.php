<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "Lakshya2003@shiv#";  // Change this to your actual password
$dbname = "hotel";

// Create a connection to the database
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $employee_id = $_POST["employee_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $position = $_POST["position"];

    // Prepare the SQL statement to insert data into the login table
    $sql = "INSERT INTO login (employee_id, username, password, position) VALUES (?, ?, ?, ?)";

    // Use a prepared statement to execute the SQL query
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("isss", $employee_id, $username, $password, $position);

        // Execute the query
        if ($stmt->execute()) {
            echo "New user record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Could not prepare the SQL statement.";
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - Hotel Management System</title>
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="add_employee_css.css">
</head>

<body>
    <div class="grid-container">
        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-left">
                <span class="material-icons-outlined">search</span>
            </div>
            <div class="header-right">
                <a href="hotel_login.html">
                    <span class="material-icons-outlined">logout</span>
                </a>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
      <aside id="sidebar">
        <div class="sidebar-title">
          <!--<div class="sidebar-brand">
            <span class="material-icons-outlined">shopping_cart</span> STORE
          </div>--> 
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="index_admin.html">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="guests1.php">
                <span class="material-icons-outlined">king_bed</span> Bookings
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="view_complaints.php">
                <span class="material-icons-outlined">report_problem</span> Complaints
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="add_user.php">
                <span class="material-icons-outlined">account_circle</span> Add Users
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="add_employee.html">
                <span class="material-icons-outlined">group_add</span> Add Employees
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="employees.php">
                <span class="material-icons-outlined">badge</span> Employees
            </a>
          </li>
          <li class="sidebar-list-item">
            <a href="https://app.powerbi.com/reportEmbed?reportId=e545454d-b6df-44d6-b8f4-bb5756462876&autoAuth=true&ctid=c417d8b4-fcf6-40b1-97ec-e8353a820310">
                <span class="material-icons-outlined">query_stats</span> Reports
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <h2>Add User</h2>
            </div>
            <section id="add-user">
                <div class="container">
                    <h2>Add User</h2>
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <div class="form-group">
                            <label for="employee_id">Employee ID:</label>
                            <input type="number" id="employee_id" name="employee_id" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="position">Position:</label>
                            <input type="text" id="position" name="position" required>
                        </div>
                        <button type="submit" class="btn-hover color-8">Add User</button>
                    </form>
                </div>
            </section>
        </main>
        <!-- End Main -->
    </div>

    <!-- Custom JS -->
    <script src="index_js.js"></script>
</body>

</html>
