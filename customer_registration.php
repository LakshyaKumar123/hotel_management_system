<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <style>
        /* Updated CSS for background image and body styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 120px;
            background-color: #f4f4f4;
            /* Add background image */
            background-image: url('de-java-hotel.jpg');
            background-size: cover; /* Cover the whole window */
            background-repeat: no-repeat; /* Don't repeat the image */
            background-position: center; /* Center the image */
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        select {
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
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Sign Up</h2>
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

            // Prepare and bind SQL statement
            $stmt = $conn->prepare("INSERT INTO customer_registration (customer_name, customer_mobile, customer_email, customer_password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $mobile, $email, $password);

            // Set parameters and execute
            $name = $_POST['name'];
            $mobile = $_POST['mobile'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($stmt->execute()) {
                echo "<script>alert('New record inserted successfully');</script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="name" placeholder="Name"> <br> <br>
            <input type="text" name="mobile" placeholder="Mobile number"> <br> <br>
            <input type="text" name="email" placeholder="Email"> <br> <br>
            <input type="password" name="password" placeholder="Password"> <br> <br>

            <button type="submit">Sign Up</button>
        </form>
        <br><br>
        <button onclick="window.location.href='customer_login.php'">Customer Login</button>
    </div>

</body>

</html>
