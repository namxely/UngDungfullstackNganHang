<?php
    require_once "connect.php";

    $account_id = "";
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

    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(!isset($_GET["account_id"]))
        {
            header("Location: ./admin_panel.php");
            exit;
        }

        $account_id = $_GET["account_id"];

        $sql = "SELECT * FROM user WHERE account_id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param('i', $account_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        if(!$row)
        {
            header("Location: ./admin_panel.php");
            exit;
        }

        $account_id = $row["account_id"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $password = $row["password"];
        $address = $row["address"];
        $PESEL = $row["PESEL"];
        $email = $row["email"];
        $balance = $row["balance"];
        $phone_number = $row["phone_number"];
        $date_opened = $row["date_opened"];
        $role_id = $row["role_id"];
        $account_number = $row["account_number"];

    }
    else{

        $account_id = $_POST["account_id"];
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

        do{
            if( empty($account_id) || empty($first_name) || empty($last_name) || empty($password)
            || empty($address) || empty($PESEL) || empty($email) || empty($balance) || empty($phone_number)
            || empty($date_opened) || empty($role_id) || empty($account_number))
            {
                echo "<script>alert('Error, all fiels are needed');</script>";
                break;
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $sql = "UPDATE user ". 
            "SET account_id = '$account_id', first_name = '$first_name', last_name = '$last_name', password = '$hashed_password',
            address = '$address', PESEL = '$PESEL', email = '$email', balance = '$balance', phone_number = '$phone_number', 
            date_opened = '$date_opened', role_id = '$role_id', account_number = '$account_number'".
            "WHERE account_id = $account_id";
            $result = $conn->query($sql);

            if(!$result)
            {
                echo "<script>alert('Error, Invalid query');</script>";
                break;
            }

            $account_id = "";
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

            header("Location: ./admin_panel.php");
            exit;

        }while(false);
    }
?>