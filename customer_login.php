<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <style>
        /* Updated CSS for the body element */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            /* Add background image to cover the entire window */
            background-image: url('de-java-hotel.jpg');
            background-size: cover; /* Cover the entire window */
            background-repeat: no-repeat; /* Don't repeat the image */
            background-position: center; /* Center the image */
            height: 100vh; /* Set body height to viewport height */
            display: flex; /* Use flex layout */
            justify-content: center; /* Center container horizontally */
            align-items: center; /* Center container vertically */
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            padding: 60px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745; /* Green color */
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        p {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <!-- Login form -->

    <div class="container">
        <h2>Login Form</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "Lakshya2003@shiv#";
            $database = "hotel";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and execute SQL statement
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM customer_registration WHERE customer_email = '$email' AND customer_password = '$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Valid login, redirect to customer_booking.php
                header("Location: customer_booking.html");
                exit();
            } else {
                echo "<script>alert('Invalid email or password');</script>";
            }

            $conn->close();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="email" name="email" placeholder="Email"> <br> <br>
            <input type="password" name="password" placeholder="Password"> <br> <br>
            <button type="submit">Login</button><br><br>
        </form>
        <a href="customer_registration.php">
            <button>Create New Account</button>
        </a>
    </div>

    <script>
        // JavaScript for displaying "Invalid email or password" message
        window.onload = function() {
            var queryString = window.location.search;
            var urlParams = new URLSearchParams(queryString);
            var invalidLogin = urlParams.get('invalidLogin');

            if (invalidLogin) {
                alert("Invalid email or password");
            }
        };
    </script>

</body>

</html>
