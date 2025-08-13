<?php
    if(isset($_GET["account_id"]))
    {
        require_once "connect.php";

        $account_id = $_GET["account_id"];

        $sql = "DELETE FROM user WHERE account_id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param('i', $account_id);

        $stmt->execute();
    }

    header("Location: ../pages/panels/admin_panel.php");
    exit;
?>