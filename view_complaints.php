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

// Query to fetch data from the complaint table
$sql = "SELECT * FROM complaint";
$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Complaint Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Additional code starts here -->

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="view_complaints_css.css">

    <!-- Additional code ends here -->
</head>

<body>

<div class="grid-container">
    <!-- Header starts here -->
    <header class="header">
        <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
        </div>
        <!--<div class="header-left">
            <span class="material-icons-outlined">search</span>
        </div>-->
        <div class="header-right">
            <a href="hotel_login.html">
                <span class="material-icons-outlined">logout</span>
            </a>
        </div>
    </header>
    <!-- Header ends here -->

    <!-- Sidebar starts here -->
    <aside id="sidebar">
        <div class="sidebar-title">
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
    <!-- Sidebar ends here -->



    <main>
        <section id="complaint-information">
            <div class="container">
                <h2>Complaint Information</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Complaint ID</th>
                            <th>Complainant Name</th>
                            <th>Complaint Type</th>
                            <th>Complaint Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Check if there are any results
                        if ($result->num_rows > 0) {
                            // Iterate through each row of the result set
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["complaint_id"] . "</td>";
                                echo "<td>" . $row["complainant_name"] . "</td>";
                                echo "<td>" . $row["complaint_type"] . "</td>";
                                echo "<td>" . $row["complaint_description"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            // Display a message if there are no complaints
                            echo "<tr><td colspan='4'>No complaints found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    
    </main>
</div>

    <!-- Scripts -->
    <!-- Include any additional scripts you need -->

</body>
</html>

<?php
// Close the database connection
$mysqli->close();
?>
