<?php include("connection.php");
session_start();
if (!isset($_SESSION['myuser'])) {
  // Redirect to the login page if the user is not logged in
  header("Location: doc.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART FINANCE</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  

  <link rel="stylesheet" href="style111.css">
  <link rel="stylesheet" href="style22.css">

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
            <a href="charts.php" class="margin-top">
              <img class="images" src="imageschart.png" alt="chart">
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
      <!-- ==================================================================================================================== -->
      <div class="analytics">
      
        <div class="analytic open-button">
          <div class="analytic-info">

<div class="two">
  <button class="open-modal-button cursor" onclick="openModal()">
  
  <i class="fa-solid fa-file-invoice-dollar"></i>
</button>
<h4 class='cursor' onclick="openPopup3()" >Total Budget</h4>
</div>
        
<?php
include("connection.php"); // Include your database connection file

// Assuming you have a function to get the total budget, adjust it accordingly
function getTotalBudget($conn, $user_id)
{
    $budgetQuery = "SELECT budget_amount FROM budget WHERE user_IId = $user_id";
    $budgetData = mysqli_query($conn, $budgetQuery);
    $budgetResult = mysqli_fetch_assoc($budgetData);

    if ($budgetResult) {
        return $budgetResult['budget_amount'];
    }

    return 0;
}

// Assuming user_id is available in your session
$user_id = $_SESSION['myuser'];

// Get the total budget
$totalBudget = getTotalBudget($conn, $user_id);
?>

<h1 style="margin-top: 5px;"><?php echo'$'. number_format($totalBudget, 2); ?></h1>



        

<!-- Modal --------------------------------------------------------------------------------------------------------------->


  <dialog   class="modal" id="budgetModal">
    <h2> Budget</h2>
    <button class="close-button" onclick="closeModal()">&times;</button>
    <form class="set-budget" method="post" action="">
  
                <label for="amount">Budget Amount:</label>
                <input type="number" id="amount" name="amount" required>

                <label for="allocation">Budget Allocation:</label>
                <select id="allocation" name="allocation">
                <option value="day">day</option>
                  <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="year">year</option>
                </select>

                <label for="startDate">Start Date:</label>
                <input type="date" id="startDate" name="startDate">

                <label for="endDate">End Date:</label>
                <input type="date" id="endDate" name="endDate">

                <div class="btn">
                <button type="submit" name="set-budget" >Set Budget</button>
                <!-- <button type="submit" name="Update" >Update</button> -->
               </div>
      </form>

      </dialog>
      <?php
 

 if (isset($_POST['set-budget'])) {
     // Retrieve form data
     $budgetAmount = $_POST['amount'];
     $allocation = $_POST['allocation'];
     $startDate = $_POST['startDate'];
     $endDate = $_POST['endDate'];
 
     // Assuming user_id is available in your session
     $userId = $_SESSION['myuser'];
 
     // Insert data into the database
     $insertQuery = "INSERT INTO budget (budget_amount, allocation, start_date, end_date, user_IId)
                     VALUES ('$budgetAmount', '$allocation', '$startDate', '$endDate', '$userId')";
     if (mysqli_query($conn, $insertQuery)) {
         echo "<script>alert('Budget set successfully.')</script>";
       
       ?>
         <meta http-equiv='refresh' content='0;url=dashboard.php'>
<?php
        } else {
          echo "<script>alert('Error setting budget: " . mysqli_error($conn) . "');</script>";
        }
   
      }
     
?>


   




<!-- ----------------------------modal-------------------------------------------------------------------------------- -->
          </div>
        </div>
       
        <?php

$totalExpenseAmount = 0;
$user_id = $_SESSION['myuser'];


$expenseQuery = "SELECT amount FROM expense WHERE user_id = $user_id ";
$expenseData = mysqli_query($conn, $expenseQuery);

while ($expenseResult = mysqli_fetch_assoc($expenseData)) {
    $totalExpenseAmount += $expenseResult['amount'];
}

?>

        
        <div class="analytic">
          <div class="analytic-info">
        <div class="two">   
          <div class="svg-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="34" height="28.5" viewBox="0 0 16 16" style="    position: relative;
    bottom: 11px;">
            <path fill="currentColor" d="m8 0l2 3H9v2H7V3H6zm7 7v8H1V7zm1-1H0v10h16z"/><path fill="currentColor" d="M8 8a3 3 0 1 1 0 6h5v-1h1V9h-1V8zm-3 3a3 3 0 0 1 3-3H3v1H2v4h1v1h5a3 3 0 0 1-3-3"/></svg></div>   
  
</svg>

<h4>Total Expense</h4>
</div>
          <div class="exp">
              <h1 style="margin-top: 5px;"><?php echo "-$".number_format($totalExpenseAmount, 2); ?></h1>
              </div>
           
          </div>
        </div>

        <?php

$totalIncomeAmount = 0;

$incomeQuery = "SELECT amount FROM income WHERE user_Id = $user_id";
$incomeData = mysqli_query($conn, $incomeQuery);

while ($incomeResult = mysqli_fetch_assoc($incomeData)) {
    $totalIncomeAmount += $incomeResult['amount'];
}

?>
<!-- ==================================================================================================================================== -->
        <div class="analytic">
          <div class="analytic-info  balance-section">
 <div class="two"> 
          <svg id='color-income' xmlns="http://www.w3.org/2000/svg" width="34" height="28.5" viewBox="0 0 16 16" style="    position: relative;
    "><path fill="currentColor" d="m8 16l-2-3h1v-2h2v2h1zm7-15v8H1V1zm1-1H0v10h16z"/><path fill="currentColor" d="M8 2a3 3 0 1 1 0 6h5V7h1V3h-1V2zM5 5a3 3 0 0 1 3-3H3v1H2v4h1v1h5a3 3 0 0 1-3-3"/></svg>
    <h4>Total Income</h4>
  </div>
          <div class="inc">
                <h1 style="margin-top: 9px;"><?php echo "+$".number_format($totalIncomeAmount, 2); ?></h1>
              </div>
          </div>
        </div>
<!-- =================================================================================================================================================================== -->
      


        <div class="analytic"  >
  <!-- <div class="clickable-element" onclick="openPopup()">Click me!</div> -->


          <div class="analytic-info balance-section">
            <div class="two">
  <button class="open-modal-button cursor" onclick="openModal2()">
          <svg id='color-budget' xmlns="http://www.w3.org/2000/svg" width="34" height="33.5" viewBox="0 0 24 24" style="    position: relative;
    bottom: 0px;"><path fill="currentColor" d="M3.005 3.003h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-18a1 1 0 0 1-1-1v-16a1 1 0 0 1 1-1m5.5 11v2h2.5v2h2v-2h1a2.5 2.5 0 1 0 0-5h-4a.5.5 0 1 1 0-1h5.5v-2h-2.5v-2h-2v2h-1a2.5 2.5 0 1 0 0 5h4a.5.5 0 0 1 0 1z"/></svg>
</button>
<dialog class="modal2" id="budgetModal2"> 
  <h2 style="padding:1rem;">Set Balance</h2> 
  <button class="close-button2" onclick="closeModal2()">&times;</button>
  <div class="blc">
  <form class="set-balance-form" method="post">
                    <label for="balance" style="font-weight: 600;">Current Balance:</label>
                    <input type="number" id="balance" name="balance" required>
                    <button class="blc-btn" type="submit" name="set-balance">Set Balance</button>
                </form>
              </dialog>
              <?php
include("connection.php");
session_start();

if (!isset($_SESSION['myuser'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: doc.php");
    exit();
}



// Function to get total income
function getTotalIncome($conn, $user_id)
{
    $incomeQuery = "SELECT SUM(amount) AS total_income FROM income WHERE user_Id = $user_id";
    $incomeData = mysqli_query($conn, $incomeQuery);
    $incomeResult = mysqli_fetch_assoc($incomeData);

    if ($incomeResult) {
        return $incomeResult['total_income'];
    }

    return 0;
}

// Function to get total expense
function getTotalExpense($conn, $user_id)
{
    $expenseQuery = "SELECT SUM(amount) AS total_expense FROM expense WHERE user_id = $user_id";
    $expenseData = mysqli_query($conn, $expenseQuery);
    $expenseResult = mysqli_fetch_assoc($expenseData);

    if ($expenseResult) {
        return $expenseResult['total_expense'];
    }

    return 0;
}
function getTotalBalance($conn, $user_id)
{


  $balanceQuery = "SELECT current_blc FROM balance WHERE user_id4 = $user_id";
  $balanceData = mysqli_query($conn, $balanceQuery);
  $balanceResult = mysqli_fetch_assoc($balanceData);
  if ($balanceResult) {
    $totalBalance = $balanceResult['current_blc'];

    // Get total income and expense
    $totalIncome = getTotalIncome($conn, $user_id);
    $totalExpense = getTotalExpense($conn, $user_id);

    // Adjust the total balance based on income and expense
    $totalBalance += $totalIncome;
    $totalBalance -= $totalExpense;

    return $totalBalance;
}

    return 0;
}
// Function to display total balance
function displayTotalBalance($conn, $user_id)
{
    echo '<h1>$' . number_format(getTotalBalance($conn, $user_id), 2) . '</h1>';
}

// Update total balance if the form is submitted
if (isset($_POST['set-balance'])) {
    $newBalance = $_POST['balance'];
    $user_id = $_SESSION['myuser'];

    echo"           
    <h4 class='cursor' onclick='openPopup()'>Total Balance</h4>
</div>
<div class='balance'>";

    // Check if there are no income and expense records for the user
    $noIncome = getTotalIncome($conn, $user_id) == 0;
    $noExpense = getTotalExpense($conn, $user_id) == 0;

    // If there are no income and expense records, insert the current balance into the database
    if ($noIncome && $noExpense) {
        $insertBalanceQuery = "INSERT INTO balance (current_blc, user_id4) VALUES ($newBalance, $user_id)";
        mysqli_query($conn, $insertBalanceQuery);
        echo "<script>alert('Balance is set.')</script>";
    } 
    else{
      echo "<script>alert(' You alredy entered your current balance and cannot enter twice. so, total balance will be display accordingly')</script>";
      // $insertBalanceQuery = "INSERT INTO balance (current_blc, user_id4) VALUES ($newBalance, $user_id)";
      //   mysqli_query($conn, $insertBalanceQuery);

      $balanceQuery = "SELECT current_blc FROM balance WHERE user_id4 = $user_id";
      $balanceData = mysqli_query($conn, $balanceQuery);
      $balanceResult = mysqli_fetch_assoc($balanceData);
      if ($balanceResult) {
        $totalBalance = $balanceResult['current_blc'];
    
        // Get total income and expense
        $totalIncome = getTotalIncome($conn, $user_id);
        $totalExpense = getTotalExpense($conn, $user_id);
    
        // Adjust the total balance based on income and expense
        $totalBalance += $totalIncome;
        $totalBalance -= $totalExpense;
    
    }

  }

  
    // Display the updated total balance
    displayTotalBalance($conn, $user_id);
}
  

     else {
      echo"           
      <h4 class='cursor' onclick='openPopup()'>Total Balance</h4>
  </div>
  <div class='balance'>";
    // If there are no income and expense records, display the initial balance
    $noIncome = getTotalIncome($conn, $_SESSION['myuser']) == 0;
    $noExpense = getTotalExpense($conn, $_SESSION['myuser']) == 0;

    if ($noIncome && $noExpense) {
        // Display the initial balance
        displayTotalBalance($conn, $_SESSION['myuser']);
    } else {
  
        // Display the updated total balance
        displayTotalBalance($conn, $_SESSION['myuser']);
    }
}


                    ?>


  
  </div>
            </div>
          </div>
        </div>
        <!-- ------------------------------------------------------------------------------------------------------------------------------------------ -->
        <dialog class="popup3">
    <div>
        <span class="close" onclick="closePopup3()">&times;</span>
        <?php
         $user_id = $_SESSION['myuser'];
$fetchQuery = "SELECT * FROM budget WHERE user_IId = '$user_id'";

$result = mysqli_query($conn, $fetchQuery);

if (!$result) {
    // Query failed, display error details
    echo "Error: " . mysqli_error($conn);
} else {
    // Rest of your code for displaying data
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<p><strong>Budget Amount:</strong> $" . number_format($row['budget_amount'], 2) . "</p>";
        echo "<p><strong>Budget Allocation:</strong> " . $row['allocation'] . "</p>";
        echo "<p><strong>Start Date:</strong> " . $row['start_date'] . "</p>";
        echo "<p><strong>End Date:</strong> " . $row['end_date'] . "</p>";
    } else {
        echo "<p>No budget data found </p>";
    }
}
?>

    </div>
</dialog>

   <!-- ========================================================================================================================================================== -->
        <dialog class='popup'>  
<div class="popup-content">
  <div class="popup-1">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>My Balance</h2>
        </div>
        <p>Previously set Balance:
         <?php
        $balanceQuery = "SELECT current_blc FROM balance WHERE user_id4 = $user_id";
        $balanceData = mysqli_query($conn, $balanceQuery);
        $balanceResult = mysqli_fetch_assoc($balanceData);
    // Display Total Balance
  //  echo "<p>"; 
    // Display Total Balance
    echo'$'. $balanceResult['current_blc'];
    
    ?> </p>
    </div>
</dialog>
         
        <!-- 
          ===================================================================================================================================== -->
          <?php 
if(isset($_POST['search']) == 0){
        echo "  <div class='expense-container'>
            <div class='expense-table'>";
              

 echo "<h2>Expense</h2>
 <table id='tbl'>
  <thead>
    <tr>
      <th>Category</th>
      <th>Description</th>
      <th>Date</th>
      <th>Amount</th>
      <th colspan='2'>Action</th>
    </tr>
  </thead>
  <tbody> ";
  $user_id = $_SESSION['myuser'];
    $expenseQuery = "SELECT * FROM expense WHERE user_id = $user_id ORDER BY id DESC";
    $expenseData = mysqli_query($conn, $expenseQuery);

    $expenseTotal = mysqli_num_rows($expenseData);
    if($expenseTotal == 0){
      echo "<tr><td colspan='4'> No records found!</td></tr>";
    }
    $limit = 5;
    $page = 1;

    if(isset($_GET['page'])){
      $page = $_GET['page'];
    }

    $offset = ($page-1) * $limit;

    $query_limit = "SELECT * FROM expense WHERE user_id= $user_id ORDER BY id DESC LIMIT $offset,$limit";
    $result_limit = mysqli_query($conn, $query_limit);
    
    while ($expenseResult = mysqli_fetch_assoc($result_limit)) {
        echo "<tr class='trow '>
                 <td>".$expenseResult['category']."</td>
                 <td>" . $expenseResult['descripition']."</td>
                 <td>" . $expenseResult['date'] . "</td>
                 <td>"."-$" . $expenseResult['amount'] . "</td>
                 <td><a href='Eedit.php?id1=$expenseResult[id]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
                 <td><a href='delete.php?id1=$expenseResult[id]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
               </tr>";
    }

 
        
        echo "  </tbody>
          
        </table>
      <div class='page-container'>";
       

        $total_pages =ceil($expenseTotal / $limit) ;
        echo "<h4> pages:$page/$total_pages </h4>";
        
        $pagination="<nav> 
        <ul class='pagination>'";

        if($expenseTotal>$limit){

          $disabled = ($page==1) ? "disabled" : "";
          $prev = $page-1;
          if ($disabled == ""){
          
          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='?page=1'>First</a></Button></li>"; 
          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='?page=$prev'>Previous</a></Button></li>"; 
        }
        

          $disabled = ($page==$total_pages) ? "disabled" : "";
          $next = $page+1;
          if ($disabled == ""){
          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='dashboard.php?page=$next'>Next</a></Button></li>"; 
          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='?page=$total_pages'>Last</a></Button></li>"; 
        }
        }

        $pagination .="</ul></nav>";
        echo $pagination;
        
      echo "</div>";  






 echo"
 </div>
 </div> ";
  // ========================================================================================================= 
  echo "<div class='income-container'>
  <div class='income-table'>
    
  <h2>Income</h2>
  <table id='tbl'>
    <thead>
      <tr>
        <th>Category</th>
        <th>Description</th>
        <th>Date</th>
        <th>Amount</th>
        <th colspan='2'>Action</th>
      </tr>
    </thead>
    <tbody>";
      
    $incomeQuery = "SELECT * FROM income WHERE user_Id = $user_id ORDER BY ID DESC";
    $incomeData = mysqli_query($conn, $incomeQuery);
    
    $incomeTotal = mysqli_num_rows($incomeData);
    
    if($incomeTotal == 0){
      echo "<tr><td colspan='4'> No records found!</td></tr>";
    }
    $limit1 = 5;
    $page1 = 1;
    
    if(isset($_GET['pagei'])){
      $page1 = $_GET['pagei'];
    }
    
    $offset1 = ($page1-1) * $limit1;

    $query_limit1 = "SELECT * FROM income WHERE user_Id = $user_id ORDER BY ID DESC LIMIT $offset1,$limit1";
    $result_limit1 = mysqli_query($conn, $query_limit1);
    
    while ($incomeResult = mysqli_fetch_assoc($result_limit1)) {
      echo" 
      <tr class='trow '>
      <td>".$incomeResult['category']."</td>
      <td>" . $incomeResult['descripition']."</td>
      <td>" . $incomeResult['date'] . "</td>
      <td>"."+$" . $incomeResult['amount'] . "</td>
      <td><a href='edit1.php?id2=$incomeResult[ID]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
      <td><a href='delete.php?id2=$incomeResult[ID]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
      </tr>";
      
 }






 echo "     
 </tbody>
 </table>
 <div class='page-container'>"; 
  
 $total_pages1 =ceil($incomeTotal / $limit1) ;
 echo "<h4> pages:$page1/$total_pages1 </h4>";

 $pagination1="<nav> 
 <ul class='pagination>'";

        if($incomeTotal>$limit1){
          
          $disabled1 = ($page1==1) ? "disabled" : "";
          $prev1 = $page1-1;
          if ($disabled1 == ""){
          
          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='?pagei=1'>First</a></Button></li>"; 
          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='?pagei=$prev1'>Previous</a></Button></li>"; 
        }
        
        
        $disabled1 = ($page1==$total_pages1) ? "disabled" : "";
        $next1 = $page1+1;
        if ($disabled1 == ""){
          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='dashboard.php?pagei=$next1'>Next</a></Button></li>"; 
          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='?pagei=$total_pages1'>Last</a></Button></li>"; 
        }
      }
      
      $pagination1 .="</ul></nav>";
      echo $pagination1;
      
      
      echo "
    </div> 
  </div>
 </div>";

}
// ==================================SSSEARCHHHHHHHHHHHHHHHHHHHH==========================================================================
else{
  $search = $_POST['search'];

  if($sql = "SELECT * FROM expense WHERE category='$search'  "){
    // echo "Search";
    $result = mysqli_query($conn,$sql); 
    
    echo "  <div class='expense-container'>
    <div class='expense-table'>";
    echo "<h2>Expense</h2>
   <table id='tbl'>
    <thead>
      <tr>
        <th>Category</th>
        <th>Description</th>
        <th>Date</th>
        <th>Amount</th>
        <th colspan='2'>Action</th>
      </tr>
    </thead>
    <tbody> ";
  
  
  
  
    if ($expenseTotal2 = mysqli_num_rows($result)){
    if($expenseTotal2 == 0){
      echo "<tr><td colspan='4'> No records found!</td></tr>";
    }
    $limit2 = 5;
    $page2 = 1;
  
    if(isset($_GET['page'])){
      $page2 = $_GET['page'];
    }
  
    $offset2 = ($page2-1) * $limit2;
  
    $query_limit2 = "SELECT * FROM expense WHERE category='$search' ORDER BY id DESC LIMIT $offset2,$limit2";
    $result_limit2 = mysqli_query($conn, $query_limit2);
    
    while ($expenseResult2 = mysqli_fetch_assoc($result_limit2)) {
        echo "<tr class='trow '>
                 <td>".$expenseResult2['category']."</td>
    
                 <td>" . $expenseResult2['descripition']."</td>
                 <td>" . $expenseResult2['date'] . "</td>
                 <td>"."-$" . $expenseResult2['amount'] . "</td>
                 <td><a href='edit.php?id1=$expenseResult2[id]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
                 <td><a href='delete.php?id1=$expenseResult2[id]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
               </tr>";
    }
  
  
        
        echo "  </tbody>
          
        </table>
      <div class='page-container'>";
       
  
        $total_pages2 =ceil($expenseTotal2 / $limit2) ;
        echo "<h4> pages:$page2/$total_pages2 </h4>";
        
        $pagination2="<nav> 
        <ul class='pagination'>";
  
        if($expenseTotal2>$limit2){
  
          $disabled2 = ($page2==1) ? "disabled" : "";
          $prev2 = $page2-1;
          if ($disabled2 == ""){
          
          $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='?page=1'>First</a></Button></li>"; 
          $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='?page=$prev2'>Previous</a></Button></li>"; 
        }
        
  
          $disabled2 = ($page2==$total_pages2) ? "disabled" : "";
          $next2 = $page2+1;
          if ($disabled2 == ""){
          $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='dashboard.php?page=$next2'>Next</a></Button></li>"; 
          $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='?page=$total_pages2'>Last</a></Button></li>"; 
        }
        }
  
        $pagination2 .="</ul></nav>";
        echo $pagination2;
        
      echo "</div>";  
  
    }
  
  
  else{
  echo "<tr colspan='5'><td>Transaction Not Found</td></tr>
  
  ";
  
  echo "  </tbody>
    
  </table>";
  }
  echo"
  </div>
  </div> ";
  
  }
       
  // ========================================================================================================
  if($sql3 = "SELECT * FROM income WHERE category='$search' "){
    $result3 = mysqli_query($conn,$sql3); 
    
    echo "<div class='income-container'>
    <div class='income-table'>
      
    <h2>Income</h2>
    <table id='tbl'>
      <thead>
        <tr>
          <th>Category</th>
          <th>Description</th>
          <th>Date</th>
          <th>Amount</th>
          <th colspan='2'>Action</th>
        </tr>
      </thead>
      <tbody>";
  
  
     if ( $incomeTotal3 = mysqli_num_rows($result3)){
           if($incomeTotal3 == 0){
             echo "<tr><td colspan='4'> No records found!</td></tr>";
                }
            $limit3 = 5;
             $page3 = 1;
    
           if(isset($_GET['pagei'])){
           $page3 = $_GET['pagei'];
        }
  
          $offset3 = ($page3-1) * $limit3;
  
           $query_limit3 = "SELECT * FROM income WHERE category='$search' ORDER BY ID DESC LIMIT $offset3,$limit3";
           $result_limit3 = mysqli_query($conn, $query_limit3);
    
            while ($incomeResult3 = mysqli_fetch_assoc($result_limit3)) {
             echo "<tr class='trow '>
                 <td>".$incomeResult3['category']."</td>
                 <td>" . $incomeResult3['descripition']."</td>
                 <td>" . $incomeResult3['date'] . "</td>
                 <td>"."-$" . $incomeResult3['amount'] . "</td>
                 <td><a href='edit1.php?id2=$incomeResult3[ID]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
                 <td><a href='delete.php?id2=$incomeResult3[I3]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
               </tr>";
     }
  
  
        
        echo "  </tbody>
          
        </table>
      <div class='page-container'>";
       
  
        $total_pages3 =ceil($incomeTotal3 / $limit3) ;
        echo "<h4> pages:$page3/$total_pages3 </h4>";
        
        $pagination3="<nav> 
        <ul class='pagination'>";
        if($incomeTotal3>$limit3){
  
          $disabled3 = ($page3==1) ? "disabled" : "";
          $prev3 = $page3-1;
          if ($disabled3 == ""){
          
          $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='?page=1'>First</a></Button></li>"; 
          $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='?page=$prev3'>Previous</a></Button></li>"; 
        }
        
  
          $disabled3 = ($page3==$total_pages3) ? "disabled" : "";
          $next3 = $page3+1;
          if ($disabled3 == ""){
          $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='dashboard.php?page=$next3'>Next</a></Button></li>"; 
          $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='?page=$total_pages3'>Last</a></Button></li>"; 
        }
        }
  
        $pagination3 .="</ul></nav>";
        echo $pagination3;
        
      echo "</div>";  
  
      }
  
      else{
        echo "<tr colspan='5'><td>Transaction Not Found</td></tr>
        
        ";
        
        echo "  </tbody>
          
        </table>";
        }
        echo"
        </div>
        </div> ";
        
        }



 
}
          
      ?>
  
</main>
 </div>
  <script src="main11.js"></script>
  <script>
    function checkdelete(){
        return confirm('Are you sure you want to delete this record?');
    }
</script>
</body>

</html>




<?php 
mysqli_close($conn);
?>