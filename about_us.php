<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Furniture Factory Management</title>
    <link rel="stylesheet" href="style.css">
    
    <!-- Correct FontAwesome Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        /* Reset & General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: rgb(213, 222, 231);
        }

        /* Hero Section */
        .hero {
            position: relative;
            width: 100%;
            height: 350px;
            background: url('aboutus.jpg') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        /* About Content */
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            display: flex;
            gap: 30px;
        }
        .left, .right {
            flex: 1;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .right ul {
            list-style: none;
            padding: 0;
        }
        .right ul li {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
        }
        .right ul li i {
            color: #007bff;
            font-size: 18px;
        }

        /* Footer */
        .footer {
            background: black;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
        .footer p {
            margin: 5px 0;
        }

        /* Social Media Icons */
        .social-icons {
            margin-top: 15px;
            text-align: center;
        }
        .social-icons a {
            color: white;
            font-size: 30px;
            margin: 0 15px;
            transition: color 0.3s ease;
            text-decoration: none;
        }
        .social-icons a:hover {
            color: #007bff;
        }

        /* Box Animation */
.container .left, .container .right {
    opacity: 0;
    transform: translateY(50px);
    animation: fadeInUp 1s ease-out forwards;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* About Us Image Animation */
.hero {
    animation: zoomIn 1.2s ease-in-out;
}

@keyframes zoomIn {
    0% {
        opacity: 0;
        transform: scale(0.8);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

    </style>
</head>
<body>

<div class="hero">
        <img src="images/aboutus.jpg" alt="about us">
        <!-- <h1>About Us</h1> -->
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="left">
            <h2>Our Company</h2>
            <p>Furniture Factory Management System is a comprehensive solution designed to streamline and automate the 
                entire factory workflow. From raw material procurement to finished product delivery, our system helps
                 factories increase efficiency, reduce costs, and improve productivity.
            </p>
            <h2>Our Mission</h2>
            <p>Our mission is to digitize and modernize factory operations by providing a smart, data-driven platform that enables businesses to manage their production, inventory, employees, and sales effortlessly.</p>
        </div>
        <div class="right">
            <h2>Key Features</h2>
            <ul>
                <li><i class="fas fa-cogs"></i> Advanced Inventory Management</li>
                <li><i class="fas fa-truck"></i> Seamless Logistics Tracking</li>
                <li><i class="fas fa-chart-line"></i> Real-time Business Insights</li>
                <li><i class="fas fa-users"></i> User-Friendly Interface</li>
            </ul>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 1999 Furniture Factory Management | Contact: furniturefactory@gmail.com | Phone: +91 12344 67890</p>
        <div class="social-icons">
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>

</body>
</html>
