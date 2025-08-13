<?php
  require_once "connect.php";

  $sql = "SELECT * FROM transfers ORDER BY date desc, transfer_id desc";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) 
  {
    while ($row = $result->fetch_assoc()) 
    {
      $transfer_id = $row["transfer_id"];
      $title = $row["title"];
      $description = $row["description"];
      $amount = $row["amount"];
      $sender_account_number = $row["sender_account_number"];
      $receiver_account_number = $row["receiver_account_number"];
      $sender_address = $row["sender_address"];
      $receiver_address = $row["receiver_address"];
      $date = $row["date"];
      $sender_id = $row["sender_id"];
      $receiver_id = $row["receiver_id"];
      $transfer_type = $row["transfer_type"];

      echo <<< DATA
        <div>
          <table>
            <tr><td colspan="2" class="table-header"><b>Transaction ID:</b> $transfer_id</td></tr>
            <tr><td><b>Title:</b></td><td>$title</td></tr>
            <tr><td><b>Description:</b></td><td>$description</td></tr>
            <tr><td><b>Amount:</b></td><td>$amount</td></tr>
            <tr><td><b>Sender Account:</b></td><td>$sender_account_number</td></tr>
            <tr><td><b>Receiver Account:</b></td><td>$receiver_account_number</td></tr>
            <tr><td><b>Sender Address:</b></td><td>$sender_address</td></tr>
            <tr><td><b>Receiver Address:</b></td><td>$receiver_address</td></tr>
            <tr><td><b>Date:</b></td><td>$date</td></tr>
            <tr><td><b>Sender ID:</b></td><td>$sender_id</td></tr>
            <tr><td><b>Receiver ID:</b></td><td>$receiver_id</td></tr>
            <tr><td><b>Transfer Type:</b></td><td>$transfer_type</td></tr>
            <tr>
            <td colspan="2">
              <a href="../../scripts/edit_transaction.php?transfer_id=$transfer_id">Edit</a>
              <a href="../../scripts/delete_transaction.php?transfer_id=$transfer_id">Delete</a>
            </td>
            </tr>
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