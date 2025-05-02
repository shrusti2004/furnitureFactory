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
$status = "";

// Get max ID for manual numbering
$id_query = "SELECT MAX(id) AS max_id FROM employees";
$id_result = mysqli_query($conn, $id_query);

if (!$id_result) {
    die("Query failed: " . mysqli_error($conn)); // If query fails, show the error
}

$row = mysqli_fetch_assoc($id_result);
$next_id = $row['max_id'] ? $row['max_id'] + 1 : 1; // If no records, start from 1

// Check if form is submitted
if (isset($_POST['submit'])) {
    $employee_name = $_POST['employee_name'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $hire_date = $_POST['hire_date'];

    // Insert data into the database
    $query = "INSERT INTO employees (id, employee_name, position, department, salary, hire_date) 
              VALUES ('$next_id', '$employee_name', '$position', '$department', '$salary', '$hire_date')";
   
    if (mysqli_query($conn, $query)) {
        $message = "Employee added successfully!";
        $status = "success";
    } else {
        $message = "Error: " . mysqli_error($conn);
        $status = "error";
    }
}

// Fetch all employee records ordered by ID ASC
$employee_query = "SELECT * FROM employees ORDER BY id ASC";
$employee_result = mysqli_query($conn, $employee_query);

if (!$employee_result) {
    die("Query failed: " . mysqli_error($conn)); // If query fails, show the error
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 Library -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background: #f4f7f9;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: auto;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            min-height: 500px;
            overflow: visible;
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"], 
        input[type="number"], 
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            outline: none;
            font-size: 16px;
            background: #ffffff;
            color: #2c3e50;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            background: linear-gradient(135deg, rgb(28, 58, 78), #1c5980);
            color: white;
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, rgb(35, 83, 116), #1c5980);
        }

        .table-container {
            width: 100%;
            max-width: 800px;
            margin-top: 20px;
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

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f4f7f9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Employee Details</h1>
        <form method="POST" action="">
            <label for="employee_name">Employee Name:</label>
            <input type="text" id="employee_name" name="employee_name" required>

            <label for="position">Position:</label>
            <input type="text" id="position" name="position" required>

            <label for="department">Department:</label>
            <input type="text" id="department" name="department" required>

            <label for="salary">Salary:</label>
            <input type="number" id="salary" name="salary" required>

            <label for="hire_date">Hire Date:</label>
            <input type="date" id="hire_date" name="hire_date" required>

            <input type="submit" name="submit" value="Add Employee">
        </form>
    </div>

    <!-- Employee Table -->
    <div class="table-container">
        <h1>Employee Records</h1>
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
                <?php
                    // Fetch and display employee records
                    while ($row = mysqli_fetch_assoc($employee_result)) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['employee_name']; ?></td>
                        <td><?php echo $row['position']; ?></td>
                        <td><?php echo $row['department']; ?></td>
                        <td><?php echo $row['salary']; ?></td>
                        <td><?php echo $row['hire_date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        var message = "<?php echo $message; ?>";
        var status = "<?php echo $status; ?>";

        if (message.trim() !== "") {
            Swal.fire({
                title: status === "success" ? "Success" : "Error",
                text: message,
                icon: status,
                confirmButtonColor: status === "success" ? "#28a745" : "#dc3545"
            });
        }
    </script>
</body>
</html>
