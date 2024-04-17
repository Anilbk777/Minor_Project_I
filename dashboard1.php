<!-- ================================================================================================================================== -->
<div class="container">
  <div class="navigation">
    <!--=============================================sf logo=============================================== -->
    <div class="logo">
      <div class="sf-icon-container">
        <div class="sf-icon">SF</div>
      </div>
      <div class=" smart">Smart Finance</div>
    </div>
    <!-- ===================================================================================================== -->
    <div class="box1">
      <ul>
        <li class="active">
          <a href="dashboard.php" aria-current="page" class="margin-top">
            <img class="images" src="images/dashboard.png" alt="home">
            <div class="title">Dashboard</div>
          </a>
        </li>
        <li>
          <a href="transaction.php" class="margin-top">
            <img class="images" src="images/transaction.webp" alt="transaction">
            <div class="title">Transactions</div>
          </a>
        </li>
        <li>
          <a href="budget.php" class="margin-top" id="budget">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <div class="title">Budget</div>
          </a>
        </li>
        <li>
          <a href="charts.php" class="margin-top ">
            <img class="images" src="images/chart.png" alt="chart">

            <div class="title">Charts</div>
          </a>
        </li>
        <li>
          <a href="report.php" class="margin-top open-button">
            <img class="images bg-color" src="images/report.png" alt="report">
            <div class="title">Report</div>
          </a>
        </li>



      </ul>
    </div>
  </div>
  <!-- =======================main========================================================================================================= -->
  <main class="main">
    <div class="topbar">
      <span class="menu"><img src="images/menu.webp" alt="menu"></span>
      <div class="top-nav">
        <div id="dashboard">Dashboard</div>
        <div id="search">
          <form method="post">
            <label for="intext"><input class="intext" id="intext" name="search" placeholder="Search for transaction" type="text">
              <img class="img-2" src="images/search.png" alt="search">
            </label>
          </form>
        </div>
        <div class="right">

          <span id="bell" onclick="showBudgetDaysLeftPopup(); toggleBellImage()">
            <img class="img-2" src="images/bell-1.png" alt="bell" id="notification">
          </span>

          <?php
          $id = $_SESSION['myuser'];

          function getCurrentDate()
          {
            return date("Y-m-d");
          }

          $startDate = getCurrentDate();
          $endDateQuery = "SELECT end_date FROM budget WHERE user_IId = $id";

          include("connection.php");

          $endDateResult = mysqli_query($conn, $endDateQuery);

          if ($endDateResult && mysqli_num_rows($endDateResult) > 0) {
            $endDateRow = mysqli_fetch_assoc($endDateResult);
            $endDate = $endDateRow['end_date'];
          } else {
            $endDate = null;
          }

          function getDaysLeft($startDate, $endDate)
          {
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);

            $interval = $startDateTime->diff($endDateTime);

            $daysLeft = $interval->days;

            return $daysLeft;
          }
          ?>

          <dialog open id="budgetDaysLeftModal">
            <div class="modal-content">
              <span class="close-b" onclick="closeBudgetDaysLeftPopup()">&times;</span>
              <?php
              if ($endDate !== null) {
                $daysLeft = getDaysLeft($startDate, $endDate);

                if ($daysLeft > 0) {
                  echo "<p>$daysLeft days left until budget end date.</p>";
                } elseif ($daysLeft == 0) {
                  echo "<p>Today is the last day of the budget. </p>";
                } else {
                  echo "<p>Budget end date has passed.</p>";
                }
              } else {
                echo "<p>Budget isn't set yet.</p>";
              }



              ?>
            </div>
          </dialog>




          <!-- =============================================================================================================================== -->
          <?php
          $id = $_SESSION['myuser'];
          $query = mysqli_query($conn, "SELECT * FROM users WHERE Id=$id");

          while ($result = mysqli_fetch_assoc($query)) {
            $res_Uname = $result['username'];
            $res_Email = $result['email'];
            $res_Age = $result['age'];
            $res_id = $result['Id'];
          }
          ?>
          <span id="user"><img class="img-2" src="images/user.png" alt="user" onclick="toggleMenu()">
            <div><b><?php echo $res_Uname ?></b>
              <hr>
            </div>
          </span>

          <div class="sub-menu-wrap " id="subMenu">
            <div class="sub-menu">
              <a href="#" class="sub-menu-link">
                <img src="images/profile.png" alt="profile">
                <p>Edit Profile</p>

              </a>
              <a href="#" class="sub-menu-link">
                <img src="images/help.png" alt="profile">
                <p>Help & Support</p>

              </a>


              <a href="logout.php" class="sub-menu-link">
                <img src="images/logout.png" alt="profile">
                <p>logout</p>

              </a>


            </div>
          </div>

        </div>
      </div>
    </div>

    <script>
      let subMenu = document.getElementById("subMenu");

      function toggleMenu() {
        subMenu.classList.toggle("open-menu");
      }
    </script>