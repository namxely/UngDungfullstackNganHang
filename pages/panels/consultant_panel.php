<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Main Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="../../style/styles.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="body">

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
            case "c":
              break;
            default:
              header("Location: ../error.php");
              break;
          }
        ?>
    </div>
    <div class="navbar-logo-left">
      <div class="container">
        <div class="navbar-wrapper">
          <a href="consultant_panel.php">
            <img src="../img//brand-name.svg" alt="" />
          </a>
          <nav role="navigation"></nav>
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
                  echo isset($_SESSION["current_user_role"]) ? "Consultant" : "Unknown";
                ?>
              </div>
            </div>
          </div>
          <a href="../../scripts/logout.php" class="logout-button w-button">LOG OUT</a>
        </div>
      </div>
    </div>
    <section class="transaction-history-section">
      <h1 class="transaction-history-heading">Transaction History</h1>
      <?php include "../../scripts/history_consultant.php"; ?>
    </section>
    <script src="./scipts.js" type="text/javascript"></script>
  </body>
</html>