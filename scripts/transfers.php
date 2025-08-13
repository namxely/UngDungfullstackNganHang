<?php
    require_once "connect.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $amount = $_POST["amount"];
        $receiver_account_number = $_POST["receiver_account_number"];
        $sender_address = $_POST["sender_address"];
        $receiver_address = $_POST["receiver_address"];
        $date = date("Y-m-d");
        $transfer_type = "S";

        $sender_query = "SELECT account_id, balance FROM user WHERE account_number = '{$_SESSION["account_number"]}'";
        $sender_result = $conn->query($sender_query);
        $sender_row = $sender_result->fetch_assoc();
        $sender_id = $sender_row["account_id"];
        $sender_balance = $sender_row["balance"];

        if ($sender_balance >= $amount)
        {
            $update_query = "UPDATE user SET balance = balance - $amount WHERE account_id = $sender_id";
            $conn->query($update_query);

            $receiver_query = "SELECT account_id FROM user WHERE account_number = '$receiver_account_number'";
            $receiver_result = $conn->query($receiver_query);
            $receiver_row = $receiver_result->fetch_assoc();
            $receiver_id = $receiver_row["account_id"];

            $insert_query = "INSERT INTO transfers (title, description, amount, sender_account_number, receiver_account_number, sender_address, receiver_address, date, sender_id, receiver_id, transfer_type)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
            $stmt = $conn->prepare($insert_query);

            $stmt->bind_param(
                'ssssssssiis',
                $title,
                $description,
                $amount,
                $_SESSION["account_number"],
                $receiver_account_number,
                $sender_address,
                $receiver_address,
                $date,
                $sender_id,
                $receiver_id,
                $transfer_type
            );

            $stmt->execute();

            $new_update_query = "UPDATE user SET balance = balance + $amount WHERE account_id = $receiver_id";
            $conn->query($new_update_query);

            $_SESSION["success_message"] = "Transfer completed successfully!";
            $_SESSION["balance"] = $sender_balance - $amount;

            header("Location: transfers_panel_user.php");
            exit();
            
        }else{

            $_SESSION["success_message"] = "Insufficient funds. Transfer cannot be completed";
            header("Location: transfers_panel_user.php");
            exit();

        }
    }

    $conn->close();
?>