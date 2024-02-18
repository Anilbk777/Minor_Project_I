
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
            <a href="logout.php" class="margin-top open-button">
              <img class="images open-button" src="images/logout.png" alt="logout">
              <div class="title">Logout</div>
            </a>
          </li>
   
       

        </ul>
      </div>
    </div>
    <!-- =======================main========================================================================================================= -->
    <main class="main">
      <div  class="topbar">
        <span class="menu"><img  src="images/menu.webp" alt="menu"></span>
        <div class="top-nav">
          <div id="dashboard">Dashboard</div>
          <div id="search">
            <form method="post">
            <label for="intext"><input class="intext" id="intext" name="search" placeholder = "Search for transaction"  type="text"  >
            <img class="img-2"src="images/search.png" alt="search">
            </label>
            </form>
          </div>
          <div class="right">
            <span id="bell"><img class="img-2" src="images/bell.png" alt="bell"></span>
            <span id="user"><img class="img-2" src="images/user.png" alt="user"><div>Admin</div></span>
          </div>
        </div>
      </div>