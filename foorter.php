<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Footer Example</title>
    <link rel="stylesheet" href="styles.css">

<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Basic Styles for the Page */
body, html {
    height: 100%;
    font-family: Arial, sans-serif;
}

.content {
    min-height: 100%;  /* Ensure content takes at least full screen height */
    padding-bottom: 50px;  /* Prevent content from hiding behind the footer */
}

/* Footer Styling */
footer {
    position: relative;  /* Ensures footer stays at the bottom of the page */
    bottom: 0;
    width: 100%;
    height: 50px;
    background-color: #333;
    color: white;
    text-align: center;
    line-height: 50px;  /* Vertically centers the text inside the footer */
    font-size: 16px;
}

footer p {
    margin: 0;
}
</style>
</head>
<body>

    <div class="content">
        <!-- Your page content goes here -->
        <h1>Welcome to My Website</h1>
        <p>This is the content area of the page.</p>
        <!-- Add more content here -->
    </div>

    <footer>
        <p>© 2025 My Website | All Rights Reserved</p>
    </footer>

</body>
</html>
