<?php
// Database connection
$servername = "localhost:3307";
$username = "root";  // replace with your username
$password = "";      // replace with your password
$dbname = "fms";     // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all employees from the database
$sql = "SELECT * FROM employees";  // Make sure you use the correct table name `employees`
$result = $conn->query($sql);

// Calculate total employees
$totalEmployees = $result->num_rows;

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Employee Report</title>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Full-page background */
        html, body {
            width: 100%;
            height: 100vh;
            background: #f4f7f9; /* Light grayish-white */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Glassmorphism Container */
        .container {
            box-shadow: 0px 5px 20px rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.21);
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 800px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 34px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: rgb(39, 75, 114);
            color: white;
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }

        .total-employees {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Employee Report</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Position</th>
                    <th>Department</th>
                    <th>Salary</th>
                    <th>Hire Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['employee_name']; ?></td>
                            <td><?php echo $row['position']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['salary']; ?></td>
                            <td><?php echo $row['hire_date']; ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6">No employee records found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="total-employees">
        <p>Total Employees: <?php echo $totalEmployees; ?></p>
    </div>
</div>

<script>
    // Display success/error message using SweetAlert2 if any
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get("message");
        const status = urlParams.get("status");

        if (message) {
            Swal.fire({
                title: status === "success" ? "Success" : "Error",
                text: message,
                icon: status,
                confirmButtonColor: status === "success" ? "#28a745" : "#dc3545"
            });
        }
    });
</script>

</body>
</html>
