<?php
    require_once "connect.php";

    session_start();

    if ($_SESSION['verification_email'] === 'u') {
        header("Location: ../pages/panels/user_panel.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $entered_code = $_POST['activation_code'];
        $saved_code = $_SESSION['saved_activation_code'];
        $role_id = $_SESSION['verification_role_id'];
        $email = $_SESSION['verification_email'];

        if ($entered_code === $saved_code) {
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE user SET role_id = 'u' WHERE email = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("s", $email);

            $stmt->execute();

            $stmt->close();
            $conn->close();
            
            $_SESSION["role_id"] = 'u';
            $_SESSION['success_message'] = 'Activation successful';

            header("Location: ../pages/panels/user_panel.php");

            exit;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }

            h1 {
                color: #333333;
                text-align: center;
                margin-top:20vh;
            }

            p {
                color: #666666;
                text-align: center;
            }

            form {
                text-align: center;
                margin-top: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                color: #333333;
            }

            input[type="text"] {
                padding: 5px;
                width: 200px;
                font-size: 14px;
                border: 1px solid #ccc;
                border-radius: 6px;
            }

            input[type="submit"] {
                padding: 10px 20px;
                background-color: #0353a4;
                color: #ffffff;
                border: none;
                font-size: 16px;
                cursor: pointer;
                border: 1px solid #ccc;
                border-radius: 6px;
            }

            input[type="submit"]:hover {
                background-color: #2a83dd;
                border: 1px solid #ccc;
                border-radius: 6px;
            }
    </style>
</head>
<body>
    <h1>Account Activation</h1>
    <p>Re-login after successful activation</p>
    <form method="POST" action="">
        <label for="activation_code">Enter your activation code:</label><br>
        <input type="text" name="activation_code" id="activation_code" required><br><br>
        <input type="submit" value="Activate">
    </form>
</body>
</html>