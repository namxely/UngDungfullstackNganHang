<?php
  require_once "connect.php";

  $user_account_number = $_SESSION["account_number"];
  $sql = "SELECT * FROM transfers WHERE sender_account_number = '$user_account_number' OR receiver_account_number = '$user_account_number' ORDER BY date desc, transfer_id desc";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
    while ($row = $result->fetch_assoc()) 
    {
      $title = $row["title"];
      $description = $row["description"];
      $amount = $row["amount"];
      $sender_account_number = $row["sender_account_number"];
      $receiver_account_number = $row["receiver_account_number"];
      $sender_address = $row["sender_address"];
      $receiver_address = $row["receiver_address"];
      $date = $row["date"];
      $transfer_type = $row["transfer_type"];

      echo <<< DATA
        <div>
          <table>
            <tr><td colspan="2" class="table-header"><b>Title:</b> $title</td></tr>
            <tr><td><b>Description:</b></td><td>$description</td></tr>
            <tr><td><b>Amount:</b></td><td>$amount</td></tr>
            <tr><td><b>Sender Account:</b></td><td>$sender_account_number</td></tr>
            <tr><td><b>Receiver Account:</b></td><td>$receiver_account_number</td></tr>
            <tr><td><b>Sender Address:</b></td><td>$sender_address</td></tr>
            <tr><td><b>Receiver Address:</b></td><td>$receiver_address</td></tr>
            <tr><td><b>Date:</b></td><td>$date</td></tr>
            <tr><td><b>Transfer Type:</b></td><td>$transfer_type</td></tr>
          </table>
        </div>
        <br></br>
      DATA;
    }
  }else{
    echo "No transaction history available.";
  }

  $conn->close();
?>