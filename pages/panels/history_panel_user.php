<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Transaction History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../../style/styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="body">
    <?php
      session_start();

      if (isset($_SESSION["success_message"]))
      {
        echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
        unset($_SESSION["success_message"]);
      }
    ?>
    <div class="navbar-logo-left">
      <div class="container">
        <div class="navbar-wrapper">
          <a href="user_panel.php">
            <img src="../img//brand-name.svg" alt="" />
          </a>
          <nav role="navigation">
            <ul role="list" class="nav-menu-two w-list-unstyled">
              <li class="list-item">
                <a href="user_panel.php" class="nav-link">Desktop</a>
              </li>
              <li><a href="history_panel_user.php"class="nav-link">History</a></li>
              <li><a href="transfers_panel_user.php" class="nav-link">Transfers</a></li>
            </ul>
          </nav>
          <div class="div-block-account-info">
            <img src="../img/user-icon.svg" width="40" class="user-icon" />
            <div class="div-block-account-info-text">
              <div class="user-name">
                <b>
                  <?php echo isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]) ? $_SESSION["first_name"] . " " . $_SESSION["last_name"] : ""; ?>
                </b>
              </div>
              <div class="user-type">
              <?php 
                  echo isset($_SESSION["role_id"]) ? "" : "Unknown";
                  switch ($_SESSION["role_id"])
                  {
                    case "u":
                      echo "User";
                      break;
                    default:
                      header("Location: ../error.php");
                      break;
                  }
                ?>
              </div>
            </div>
          </div>
          <a href="../../scripts/logout.php" class="logout-button w-button">LOG OUT</a>
        </div>
      </div>
    </div>
    <section class="section">
      <h1 class="heading">Transaction History</h1>
      <?php include "../../scripts/history.php"; ?>
    </section>
    <script src="./scipts.js" type="text/javascript"></script>
  </body>
</html>