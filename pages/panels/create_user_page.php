<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Savemander</title>
    <link rel="stylesheet" href="../../style/styles.css">
</head>
    <body>
        <?php require_once "../../scripts/create_user.php"; ?>
        <div class="user-name">
            <b>
                <?php echo isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]) ? $_SESSION["first_name"] . " " . $_SESSION["last_name"] : ""; ?>
            </b>
            </div>
            <div class="user-type">
            <?php 
                session_start();
                
                echo isset($_SESSION["role_id"]) ? "" : "Unknown";
                switch ($_SESSION["role_id"])
                {
                case "a":
                    break;
                default:
                    header("Location: ../error.php");
                    break;
                }
            ?>
        </div>
        <div class="create_user">
            <h1 class = "cu-heading">Table of Users:</h1>
            <form method="post">
                <div class = "div-block-cu">
                    <div class = "left-info-cu">
                        <div>
                            <label>Name</label>
                            <input type="text" name="first_name" value="<?php echo $first_name ?>" required>
                        </div>
                        <div>
                            <label>Surname</label>
                            <input type="text" name="last_name" value="<?php echo $last_name ?>" required>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password" name="password" value="<?php echo $password ?>" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$" required>
                        </div>
                        <div>
                            <label>Address</label>
                            <input type="text" name="address" value="<?php echo $address ?>" required>
                        </div>
                        <div>
                            <label>PESEL</label>
                            <input type="text" name="PESEL" minlength="11" maxlength="11" value="<?php echo $PESEL ?>" required>
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $email ?>" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" required>
                        </div>
                    </div>
                    <div class = "right-info-cu">
                        <div>
                            <label>Balance</label>
                            <input type="number" step=0.01 name="balance" min=0.01 value="<?php echo $balance ?>" required>
                        </div>
                        <div>
                            <label>Phone number</label>
                            <input type="tel" name="phone_number" minlength="9" maxlength="9" value="<?php echo $phone_number ?>" required>
                        </div>
                        <div>
                            <label>Date opened</label>
                            <input type="date" name="date_opened" value="<?php echo $date_opened ?>" required>
                        </div>
                        <div>
                            <label>Role ID</label>
                            <input type="text" name="role_id" minlength="1" maxlength="1" value="<?php echo $role_id ?>" required>
                        </div>
                        <div>
                            <label>Account number</label>
                            <input type="text" name="account_number" minlength="26" maxlength="26" value="<?php echo 'SAVE220' ?>" required>
                        </div>
                    </div>
                </div>
                <div class="buttons-container">
                    <div>
                        <button type="submit">Submit</button>
                        <a href="./admin_panel.php" type="submit">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>