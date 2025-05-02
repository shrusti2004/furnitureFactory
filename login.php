<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Grey Background for Page */
        body {
            height: 100vh;
            display: flex;
            box-sizing: border-box;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg,rgb(30, 37, 49),rgb(33, 46, 70),rgb(54, 78, 83));
        }

        /* Bright Glassmorphism Container */
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
            font-size: 40px;
            color: white;
            font-weight: 700;
            margin-bottom: 40px;
        }

        /* Input Fields */
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.5);
            color: black;
            font-weight: bold;
            box-shadow: 0px 4px 10px rgba(247, 255, 252, 0.5);
        }

        /* Buttons */
        .buttons {
            margin-top: 20px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            background: linear-gradient(45deg,rgb(16, 54, 80),rgb(16, 54, 80));
            color: white;
            box-shadow: 0px 4px 10px rgba(247, 255, 252, 0.5);
        }

        /* Bottom Links */
        .bottom-links {
            margin-top: 15px;
            font-size: 15px;
            color: white;
        }

        .bottom-links a {
            color: rgb(24, 77, 112);
            font-weight: bold;
            text-decoration: none;
        }

        .bottom-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <div class="buttons">
                <input type="submit" value="Login">
            </div>
        </form>

        <div class="bottom-links">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>

    <?php
    // Database connection
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "fms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $message = "";
    $type = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Check credentials
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['cpassword'])) {
                // Redirect to index page
                header("Location: index.php");
                exit();
            } else {
                $message = "❌ Invalid password!";
                $type = "error";
            }
        } else {
            $message = "❌ Invalid username!";
            $type = "error";
        }
    }

    $conn->close();

    // Show SweetAlert if there's a message
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
