<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Factory Management</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            flex-direction: column;  /* Stack elements vertically */
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(135deg, #16222a, #3a6073);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center; 
            padding: 20px;  
            height: 90px;  
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            font-size: 22px;
            font-weight: bold;
        }

        .navbar .logo img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .navbar .nav-buttons {
            display: flex;
            gap: 15px;
        }

        .navbar .nav-btn {
            background: rgb(179, 56, 86);
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: 0.2s;
        }

        .navbar .nav-btn:hover {
            background-color: rgb(160, 29, 40);
            color: white;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #16222a, #3a6073);
            color: white;
            position: fixed;
            left: 0;
            top: 90px;
            height: calc(100vh - 90px);
            padding: 20px 10px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }

        .menu, .submenu {
            list-style: none;
            padding: 0;
        }

        .menu li {
            cursor: pointer;
            padding: 12px 15px;
            font-size: 16px;
            font-weight: 800;
            transition: 0.3s;
            border-radius: 5px;
        }

        .menu li:hover, .submenu li:hover {
            background: rgb(156, 42, 52);
        }

        .submenu {
            display: none;
            padding-left: 20px;
        }

        .submenu.active {
            display: block;
        }

        .content {
            margin-left: 260px;
            padding: 100px 20px 20px;
            flex: 1;
            display: flex;
        }

        footer {
            background: #16222a;
            color: white;
            text-align: center;
            padding: 10px;
            width :100%;
            margin-top: auto;  
            position:sticky;
        }

    </style>
</head>
<body>
    
    <navbar>
        <div class="navbar">
            <div class="logo">
                <img src="images/factory_logo.png" alt="Factory Logo">
                <h2>Furniture Factory Management</h2>
            </div>
            <div class="nav-buttons">
                <button class="nav-btn" onclick="location.href='home.php'">Home</button>
                <button class="nav-btn" onclick="location.href='contact_us.php'">Contact Us</button>
                <button class="nav-btn" onclick="location.href='about_us.php'">About Us</button>
                <button class="nav-btn" onclick="location.href='logout.php'">Logout</button>
            </div>
        </div>
    </navbar> 

    <div class="sidebar">
        <ul class="menu">
            <li onclick="toggleSubMenu('product-master')">Product Master</li>
            <ul id="product-master" class="submenu">
                <li onclick="loadPage('housing_furniture.php')">Housing Furniture</li>
                <li onclick="loadPage('office_furniture.php')">Office Furniture</li>
                <li onclick="loadPage('hospital_furniture.php')">Hospital Furniture</li>
            </ul>
            
            <li onclick="toggleSubMenu('inventory-master')">Inventory Master</li>
            <ul id="inventory-master" class="submenu">
                <li onclick="loadPage('sales.php')">Sales</li>
                <li onclick="loadPage('purchase.php')">Purchase</li>
            </ul>

            <li onclick="toggleSubMenu('employee-master')">Employee Master</li>
            <ul id="employee-master" class="submenu">
                <li onclick="loadPage('employees.php')">Employee Details</li>
            </ul>

            <li onclick="toggleSubMenu('supplier-master')">Supplier Master</li>
            <ul id="supplier-master" class="submenu">
                <li onclick="loadPage('supplier_categories.php')">Supplier Categories</li>
                <li onclick="loadPage('supplier_entry.php')">Supplier Entry</li>   
            </ul>

            <li onclick="toggleSubMenu('customer-master')">Customer Master</li>
            <ul id="customer-master" class="submenu">
                <li onclick="loadPage('customer_categories.php')">Customer Categories</li>
                <li onclick="loadPage('customer_entry.php')">Customer Entry</li>  
            </ul>

            <li onclick="toggleSubMenu('reports')">Reports</li>
            <ul id="reports" class="submenu">
                <li onclick="loadPage('sales_reports.php')">Sales Report</li>
                <li onclick="loadPage('purchase_reports.php')">Purchase Report</li>
                <li onclick="loadPage('employee_reports.php')">Employee Report</li>
            </ul>
        </ul>
    </div>
        
    <div class="content" id="dashboard-content">
        <img src="images/in4.png" height="100%" width="50%" />
        <img src="images/in5.webp" height="100%" width="50%" />
    </div>

    <footer>
        <p >© 1999 Furniture Factory Management | All Rights Reserved</p>
    </footer>

    <script>
        function toggleSubMenu(menuId) {
            var submenu = document.getElementById(menuId);
            submenu.classList.toggle("active");
        }

        function loadPage(page) {
            document.getElementById("dashboard-content").innerHTML = `<iframe src="${page}" width="100%" height="600px" style="border:none;"></iframe>`;
        }
    </script>
</body>
</html>
