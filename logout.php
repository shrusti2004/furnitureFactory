<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Page</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #222;
            flex-direction: column;
            color: white;
            font-family: Arial, sans-serif;
        }

        .logout-container {
            position: relative;
            display: flex;
            align-items: center;
            background: #ff4d4d;
            padding: 12px 40px;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0px 5px 15px rgba(255, 77, 77, 0.4);
            transition: 0.3s;
            overflow: hidden;
        }

        .logout-container:hover {
            background: #d62828;
            transform: scale(1.05);
        }

        .logout-container span {
            color: white;
            font-size: 18px;
            font-weight: bold;
            margin-left: 10px;
            text-transform: uppercase;
        }

        .gear {
            width: 24px;
            height: 24px;
            background: url('https://cdn-icons-png.flaticon.com/512/126/126472.png') no-repeat center;
            background-size: contain;
            animation: rotateGear 2s linear infinite;
        }

        @keyframes rotateGear {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="logout-container" onclick="confirmLogout()">
        <div class="gear"></div>
        <span>Logout</span>
    </div>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: "Are you sure?",
                text: "You will be logged out!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, Logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Logged Out!",
                        text: "You have been logged out successfully.",
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(() => {
                        window.location.href = "home.php"; // Redirect to home page
                    }, 2000);
                }
            });
        }
    </script>
</body>
</html>
