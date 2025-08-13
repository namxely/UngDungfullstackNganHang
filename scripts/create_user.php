<?php
    require_once "connect.php";

    $first_name = "";
    $last_name = "";
    $password = "";
    $address = "";
    $PESEL = "";
    $email = "";
    $balance = "";
    $phone_number = "";
    $date_opened = "";
    $role_id = "";
    $account_number = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $password = $_POST["password"];
        $address = $_POST["address"];
        $PESEL = $_POST["PESEL"];
        $email = $_POST["email"];
        $balance = $_POST["balance"];
        $phone_number = $_POST["phone_number"];
        $date_opened = $_POST["date_opened"];
        $role_id = $_POST["role_id"];
        $account_number = $_POST["account_number"];

        do {
            if(empty($first_name) || empty($last_name) || empty($password)
            || empty($address) || empty($PESEL) || empty($email) || empty($balance) || empty($phone_number)
            || empty($date_opened) || empty($role_id) || empty($account_number))
            {
                echo "<script>alert('Error, all fiels are needed');</script>";
                break;
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO user (first_name, last_name, password, address, PESEL,
                email, balance, phone_number, date_opened, role_id, account_number) " .
                "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param('ssssssdsiss',
                $first_name,
                $last_name,
                $hashed_password,
                $address,
                $PESEL,
                $email,
                $balance,
                $phone_number,
                $date_opened,
                $role_id,
                $account_number
            );

            $stmt->execute();

            $result = $stmt->get_result();

            if($stmt->error)
            {
                echo "<script>alert('Error, Invalid query');</script>";
                break;
            }

            header("Location: ./admin_panel.php");
            exit;

        } while(false);
    }
?>