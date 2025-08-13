<?php
    require_once "connect.php";
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap");

            body {
            margin: 0;
            font-family: "Montserrat", sans-serif;
            }

            .div-block-cu {
            /* margin 0 auto; */
            /* justify-content: c */
            display: flex;
            }

            .left-info-cu {
            max-width: 50%;
            margin-right: 40px;
            }

            .right-info-cu {
            max-width: 50%;
            display: block;
            padding-right: 25px;
            }

            .create_user {
            max-width: 400px;
            margin: 10vh auto;
            background-color: white;
            border-radius: 7%;
            box-shadow: 20px 20px 95px #cecece, -20px -20px 95px #f2f2f2;
            padding: 5vh;
            }

            .create_user form {
            display: flex;
            flex-direction: column;
            align-items: center;
            }

            .create_user label {
            display: block;
            margin-bottom: 5px;
            }

            .create_user input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            }

            .buttons-container {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            }

            input[type="submit"],
            input[type="button"] {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-weight: 500;
            text-transform: uppercase;
            padding: 8px 20px;
            margin: 0 2.5px;
            background-color: #0353a4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            width: 50%;
            }

            input[type="submit"]:hover,
            input[type="button"]:hover{
            background-color: #2a83dd;
            border: none;
            }
            
        </style>
    </head>
    <body>
    <?php
    if (isset($_GET["transfer_id"])) 
    {
        $transfer_id = $_GET["transfer_id"];
        $sql = "SELECT * FROM transfers WHERE transfer_id = $transfer_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();

            echo <<< FORM
                <form method="POST" action="update_transaction.php?transfer_id=$transfer_id">
                <div class="create_user">
                <div class = "div-block-cu">
                <div class = "left-info-cu">
                    <label for="title">Title:</label>
                    <input type="text" name="title" value="{$row["title"]}" required><br>
                    <label for="description">Description:</label>
                    <input type="text" name="description" value="{$row["description"]}" required><br>
                    <label for="amount">Amount:</label>
                    <input type="number" name="amount" name="account_id" value="{$row["amount"]}" readonly><br>
                    <label for="sender_account_number">sender_account_number:</label>
                    <input type="text" name="sender_account_number" minlength=26 maxlength=26 value="{$row["sender_account_number"]}" required><br>
                    <label for="receiver_account_number">receiver_account_number:</label>
                    <input type="text" name="receiver_account_number" minlength=26 maxlength=26 value="{$row["receiver_account_number"]}" required><br>
                    <label for="sender_address">sender_address:</label>
                    <input type="text" name="sender_address" value="{$row["sender_address"]}" required><br>
                </div>
                <div class = "right-info-cu">
                    <label for="receiver_address">receiver_address:</label>
                    <input type="text" name="receiver_address" value="{$row["receiver_address"]}" required><br>
                    <label for="date">date:</label>
                    <input type="date" name="date" value="{$row["date"]}" required><br>
                    <label for="sender_id">sender_id:</label>
                    <input type="text" name="sender_id" value="{$row["sender_id"]}" required><br>
                    <label for="receiver_id">receiver_id:</label>
                    <input type="text" name="receiver_id" value="{$row["receiver_id"]}" required><br>
                    <label for="transfer_type">transfer_type:</label>
                    <input type="text" name="transfer_type" value="{$row["transfer_type"]}" required><br>
                </div>
                </div>
                <div class="buttons-container">
                    <input type="submit" value="Update">
                    <input type="button" value="Cancel" onclick="location.href='../pages/panels/consultant_panel.php';"/>
                </div>
                </div>
                </form>
            FORM;
        }else{
            echo "Transaction not found";
        }
    }

    $conn->close();
?>