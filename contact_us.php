<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
       /* Reset styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* Background */
.contact-body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, rgb(30, 37, 49), rgb(33, 46, 70), rgb(54, 78, 83));
    padding: 20px;
}

/* Glassmorphism Container */
.contact-container {
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(15px);
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0px 5px 20px rgba(255, 255, 255, 0.3);
    text-align: center;
    width: 95%;
    max-width: 450px;
    border: 1px solid rgba(255, 255, 255, 0.5);
}

/* Heading */
.contact-heading {
    font-size: 42px;
    color: white;
    font-weight: 700;
    margin-bottom: 25px;
}

/* Input Fields */
.contact-input, .contact-textarea {
    width: 100%;
    padding: 14px;
    margin: 12px 0;
    border-radius: 12px;
    border: none;
    outline: none;
    font-size: 17px;
    background: rgba(255, 255, 255, 0.5);
    color: black;
    font-weight: bold;
    box-shadow: 0px 4px 10px rgba(247, 255, 252, 0.57);
}

.contact-textarea {
    resize: none;
    height: 120px;
}

/* Submit Button */
.contact-button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    background: linear-gradient(45deg, rgb(16, 54, 80), rgb(16, 54, 80));
    color: white;
    box-shadow: 0px 4px 10px rgba(247, 255, 252, 0.5);
    margin-top: 10px;
}

 /* Social Media Icons */
 .social-icons {
            margin-top: 25px;
            text-align: center;
        }

        .social-icons a {
            color: white;
            font-size: 35px;
            margin: 0 12px;
            transition: color 0.3s ease;
            text-decoration: none;
        }

        .social-icons a:hover {
            color: #007bff;
        }

    </style>
</head>
<body class="contact-body">

    <div class="contact-container">
        <h1 class="contact-heading">Contact Us</h1>
        
        <form action="" method="POST">
            <input type="text" name="name" class="contact-input" placeholder="Your Name" required>
            <input type="email" name="email" class="contact-input" placeholder="Your Email" required>
            <textarea name="message" class="contact-textarea" placeholder="Your Message" required></textarea>
            <button type="submit" name="submit" class="contact-button">Send Message</button>
        </form>

        <!-- Social Media Icons -->
        <!-- <div class="contact-social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div> -->
        <div class="social-icons">
        <a href="https://www.instagram.com/" target="_blank">
            <i class="fab fa-instagram"></i>
        </a>
        <a href="https://www.facebook.com/" target="_blank">
            <i class="fab fa-facebook"></i>
        </a>
        <a href="https://twitter.com/" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://www.linkedin.com/" target="_blank">
            <i class="fab fa-linkedin"></i>
        </a>
    </div>


    </div>

    

</body>
</html>





<?php
// Database connection
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert Data
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                title: 'Success!',
                text: 'Your message has been sent successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong. Please try again.',
                icon: 'error',
                confirmButtonText: 'Retry'
            });
        </script>";
    }
}

$conn->close();
?>



