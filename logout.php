<?php include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logout</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style1.css">
  <link rel="stylesheet" href="style/style2.css">

</head>
<body>
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
          <li >
            <a href="dashboard.php" class="margin-top">
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
          <li >
            <a href="budget.php" class="margin-top" id="budget" >
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <div class="title">Budget</div>
             </a>
          </li>
          <li>
            <a href="charts.php" class="margin-top">
              <img class="images" src="images/chart.png" alt="chart">
              <div class="title">Charts</div>
            </a>
          </li>
          <li class="active">
            <a href="logout.php"  aria-current="page" class="margin-top open-button">
              <img class="images open-button" src="images/logout.png" alt="logout">
              <div class="title">Logout</div>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <main class="main">
    <div class="logout-container">
 <div  class="logout" id="'logout">
        <h1>Logout Form</h1>
        <div class="para">Are you sure you want to logout from your account? Once you logged out, you need to login again. <b>Are you ok?</b></div>
        <!-- <button class="close-button">Cancel</button> -->
        <form method="post">
            <button type="submit" name="logout">Yes, logout</button>
        </form>
    </div>
</div>
</main>
</div>
  <script src="main1.js"></script>
</body>
</html>
<?php
session_start();
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location: doc.php");
    exit;
}


?>