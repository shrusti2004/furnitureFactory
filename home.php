<!DOCTYPE html>
<html>
<head>
    <title>Factory Management System</title>
  <style>

    /* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;600&display=swap'); 

 /* Reset default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
}

/* Full-Page Background Image */
body {
    height: 100vh;
    display: flex;
    box-sizing: border-box; 
    justify-content: center;
    align-items: center;
    background: url('images/Factory.jpeg') no-repeat center center/cover;
    position: relative;
}

/* Dark Overlay for better visibility */
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6); /* Dark overlay effect */
    z-index: 1;
}

/* Centered Glass Container */
.container {
    position: relative;
    z-index: 2;
    width: 90%;
    height: 60%;
    max-width: 500px;
    background: rgba(255, 255, 255, 0.2); /* Glassmorphism effect */
    padding: 30px;
    border-radius: 15px;
    backdrop-filter: blur(12px);
    text-align: center;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Logo Styling */
.logo {
    width: 120px;
    margin-bottom: 15px;
}

/* Heading Style */
h1 {
    font-size: 30px;
    font-family: 'Oswald', sans-serif; /* Stylish font */
    color: white;
    font-weight: 600;
    margin-bottom: 20px;
    letter-spacing: 1px; /* Adds spacing for better readability */
    text-transform: uppercase; /* Makes text look bold and professional */
}


/* Buttons Container */
.buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 70px;

}

/* Modern Button Styling */
.btn {
    display: inline-block;
    background: linear-gradient(45deg,rgb(16, 54, 80),rgb(16, 54, 80));
    color: white;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    width: 45%;
    text-align: center;
   
}


/* Button Hover Effect */
.btn:hover {
    background: linear-gradient(45deg,rgb(123, 217, 254),)rgb(123, 217, 254);
    transform: scale(1.05);
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
}

</style>
</head>
<body>


<div class="container">
        <img src="images/factory_logo.png" alt="Factory Logo" class="logo">
        <h1>Factory Management System</h1>
        <div class="buttons">
            <a href="login.php" class="btn left-btn">Login</a>
            <a href="register.php" class="btn right-btn">Register</a>
        </div>
    </div>


</body>
</html>



