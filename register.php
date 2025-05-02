<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Full-page gradient background */
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            height: 100vh;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg,rgb(30, 37, 49),rgb(33, 46, 70),rgb(54, 78, 83));
            font-family: 'Poppins', sans-serif;
        }

        /* Compact Glassmorphism Container */
        .container {
            background: rgba(255, 255, 255, 0.3); /* Brighter glass effect */
            backdrop-filter: blur(15px);
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0px 5px 20px rgba(255, 255, 255, 0.3);
            text-align: center;
            width: 90%;
            max-width: 380px;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Heading */
        h1 {
            font-size: 35px;
            color: white;
            margin-bottom: 15px;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Label */
        label {
            text-align: left;
            font-size: 12px;
            font-weight: bold;
            color: black;
            font-size:18px;
        }

        /* Input Fields */
        input, select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: none;
            outline: none;
            font-size: 14px;
            background: rgba(255, 255, 255, 0.4);
            color: black;
            transition: 0.7s ease-in-out;
        }

        input:focus, select:focus {
            background: rgba(255, 255, 255, 0.6);
        }

        /* Submit Button */
        input[type="submit"] {
            background: linear-gradient(45deg,rgb(16, 54, 80),rgb(16, 54, 80));
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s ease-in-out;
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(247, 255, 252, 0.5);
            width: 300px;
            display: inline-block;
            margin: 10px auto;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .container {
                width: 90%;
                max-width: 280px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Register">
        </form>
        <p style="text-align:center; margin-top:10px;">
            Already have an account? <a href="login.php" style="color: blue; text-decoration: none; font-weight: bold;">Login</a>
        </p>
    </div>

    <?php
    // Database connection
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "FMS";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $message = ""; // Message to show in the pop-up
    $type = ""; // Type of message (success or error)

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Check if passwords match
        if ($password != $confirm_password) {
            $message = "⚠️ Passwords do not match!";
            $type = "error";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO user (emailid, username, cpassword) VALUES ('$email', '$username', '$hashed_password')";

            if ($conn->query($sql) === TRUE) {
                $message = "✅ Registration Successful! Please Log in to Continue...";
                $type = "success";

                // Auto redirect to login page after 3 seconds
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'login.php';
                        }, 3000);
                      </script>";
            } else {
                $message = "❌ Error: " . $conn->error;
                $type = "error";
            }
        }
    }

    // Close connection
    $conn->close();

    // Show the SweetAlert pop-up if there's a message
    if ($message != "") {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: '$type',
                        title: '$message',
                        confirmButtonText: 'OK'
                    });
                });
              </script>";
    }
    ?>

</body>
</html>
