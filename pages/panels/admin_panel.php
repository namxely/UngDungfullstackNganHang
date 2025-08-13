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
            case "a":
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
          <a href="admin_panel.php">
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
                  echo isset($_SESSION["current_user_role"]) ? "Admin" : "Unknown";
                ?>
              </div>
            </div>
          </div>
          <a href="../../scripts/logout.php" class="logout-button w-button">LOG OUT</a>
        </div>
      </div>
    </div>
    <div>
        <h3>Table of Users:</h3>
        <form action="admin_panel.php" method="GET">
            <input type="text" name="search" placeholder="Search">
            <svg xmlns="http://www.w3.org/2000/svg"
            height="20"
            name="search-icon" 
            fill="#505050" 
            viewBox="0 0 256 256">
            <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,
            0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,
            112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z">
          </path>
        </svg>
            <!-- <input type="submit" value="Search"> -->
        </form>
        <div class="table-controls"><a href="./admin_panel.php"><svg xmlns="http://www.w3.org/2000/svg" 
        width="36" 
        height="36" 
        fill="#0353a4" 
        viewBox="0 0 256 256">
        <path d="M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,
        8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z">
      </path>
      </svg></a>
        <a href="create_user_page.php"><input type="button" value="Add User"></a><br></br>
      </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Password</th>
                <th>Address</th>
                <th>PESEL</th>
                <th>Email</th>
                <th>Balance</th>
                <th>Phone number</th>
                <th>Date opened</th>
                <th>Role ID</th>
                <th>Account number</th>
                <th class = "action-th">Action</th>
            </tr>

            <?php require_once "../../scripts/print_user_table.php"; ?>
            
        </table>
    </div>
    <script src="./scipts.js" type="text/javascript"></script>
  </body>
</html>