<?php
    require_once "connect.php";

    if (isset($_GET["transfer_id"])) 
    {
        $transfer_id = $_GET["transfer_id"];
        $sql = "DELETE FROM transfers WHERE transfer_id = $transfer_id";

        if ($conn->query($sql) === TRUE) 
        {
            header("Location: ../pages/panels/consultant_panel.php");
            exit();
        }else{
            echo "<script>alert('Error deleting transaction');</script>";
        }
    }

    $conn->close();
?>