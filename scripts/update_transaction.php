<?php
    require_once "connect.php";

    if (isset($_GET["transfer_id"])) 
    {
        $transfer_id = $_GET["transfer_id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $amount = $_POST["amount"];
        $sender_account_number = $_POST["sender_account_number"];
        $receiver_account_number = $_POST["receiver_account_number"];
        $sender_address = $_POST["sender_address"];
        $receiver_address = $_POST["receiver_address"];
        $date = $_POST["date"];
        $sender_id = $_POST["sender_id"];
        $receiver_id = $_POST["receiver_id"];
        $transfer_type = $_POST["transfer_type"];
        $sql = "UPDATE transfers SET title='$title', description='$description',
        amount='$amount', sender_account_number='$sender_account_number',
        receiver_account_number='$receiver_account_number', sender_address='$sender_address',
        receiver_address='$receiver_address', date='$date',
        sender_id='$sender_id', receiver_id='$receiver_id', transfer_type='$transfer_type'
        WHERE transfer_id = $transfer_id";
       
        if ($conn->query($sql) === TRUE) 
        {
            header("Location: ../pages/panels/consultant_panel.php");
            exit();
        }else{
            echo "<script>alert('Error updating transaction');</script>";
            header("Location: ../pages/panels/consultant_panel.php");
            exit();
        }
    }

    $conn->close();
?>