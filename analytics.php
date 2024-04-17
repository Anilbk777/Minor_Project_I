<?php
session_start();

include("connection.php");
$user_id = $_SESSION['myuser'];
$query = "SELECT budget_amount FROM budget WHERE user_IId = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
  echo "
       <div class='analytics'>
       <div class='analytic open-button cursor'>
        <div class='analytic-info cursor' onclick='openPopup3()'>
           <div class='two'>
            <button class='open-modal-button cursor'>
                <i class='fa-solid fa-file-invoice-dollar' style='font-weight: 900; font-size: 2rem; color: #3838E8;'></i>
            </button>
            <h4 class='cursor'>Total Budget</h4>
        </div>";
?>
  <?php
  include("connection.php");

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

  $user_id = $_SESSION['myuser'];

  $totalBudget = getTotalBudget($conn, $user_id);
  ?>
  <h1 style="margin-top: 5px;"><?php echo '$' . number_format($totalBudget, 2); ?></h1>
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
            <path fill="currentColor" d="m8 0l2 3H9v2H7V3H6zm7 7v8H1V7zm1-1H0v10h16z" />
            <path fill="currentColor" d="M8 8a3 3 0 1 1 0 6h5v-1h1V9h-1V8zm-3 3a3 3 0 0 1 3-3H3v1H2v4h1v1h5a3 3 0 0 1-3-3" />
          </svg>
        </div>

        </svg>

        <h4>Total Expense</h4>
      </div>
      <div class="exp">
        <h1 style="margin-top: 5px;"><?php echo "-$" . number_format($totalExpenseAmount, 2); ?></h1>
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
  ">
          <path fill="currentColor" d="m8 16l-2-3h1v-2h2v2h1zm7-15v8H1V1zm1-1H0v10h16z" />
          <path fill="currentColor" d="M8 2a3 3 0 1 1 0 6h5V7h1V3h-1V2zM5 5a3 3 0 0 1 3-3H3v1H2v4h1v1h5a3 3 0 0 1-3-3" />
        </svg>
        <h4>Total Income</h4>
      </div>
      <div class="inc">
        <h1 style="margin-top: 9px;"><?php echo "+$" . number_format($totalIncomeAmount, 2); ?></h1>
      </div>
    </div>
  </div>
  <!-- =================================================================================================================================================================== -->



  <div class="analytic">


    <div class="analytic-info balance-section">
      <div class="two">
        <button class="open-modal-button cursor" onclick="openModal2()">
          <svg id='color-budget' xmlns="http://www.w3.org/2000/svg" width="34" height="33.5" viewBox="0 0 24 24" style="    position: relative;
  bottom: 0px;">
            <path fill="currentColor" d="M3.005 3.003h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-18a1 1 0 0 1-1-1v-16a1 1 0 0 1 1-1m5.5 11v2h2.5v2h2v-2h1a2.5 2.5 0 1 0 0-5h-4a.5.5 0 1 1 0-1h5.5v-2h-2.5v-2h-2v2h-1a2.5 2.5 0 1 0 0 5h4a.5.5 0 0 1 0 1z" />
          </svg>
        </button>

        <?php

        // =================================================================================================================
        echo "           
    <h4 class='cursor' onclick='openPopup()'>Total Balance</h4>
     </div>
   <div class='balance'>";
        include("connection.php");
        session_start();

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

        function displayTotalBalance($conn, $user_id)
        {
          $totalBalance = 0;

          $totalIncome = getTotalIncome($conn, $user_id);
          $totalExpense = getTotalExpense($conn, $user_id);

          $totalBalance += $totalIncome;
          $totalBalance -= $totalExpense;

          echo '<h1>$' . number_format($totalBalance, 2) . '</h1>';
        }

        if (isset($_SESSION['myuser'])) {
          $user_id = $_SESSION['myuser'];
          displayTotalBalance($conn, $user_id);
        }

        ?>

      </div>
    </div>
  </div>
  </div>


<?php
}












// <!-- ================================================================================================================================================================= -->
// <!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
// <!-- =========================================================================================================================================== -->


else {
  include("connection.php");
  $user_id = $_SESSION['myuser'];

  echo "
   <div class='analytics'>
   <div class='analytic open-button cursor'>
    <div class='analytic-info cursor' onclick='openPopup3()'>
       <div class='two'>
        <button class='open-modal-button cursor'>
            <i class='fa-solid fa-file-invoice-dollar' style='font-weight: 900; font-size: 2rem; color: #3838E8;'></i>
        </button>
        <h4 class='cursor'>Total Budget</h4>
    </div>";

  include("connection.php");
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

  $user_id = $_SESSION['myuser'];

  $totalBudget = getTotalBudget($conn, $user_id);
?>
  <h1 style="margin-top: 5px;"><?php echo '$' . number_format($totalBudget, 2); ?></h1>
  <!-- ----------------------------modal-------------------------------------------------------------------------------- -->
  </div>
  </div>


  <div class="analytic">
    <div class="analytic-info">
      <div class="two">
        <div class="svg-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="34" height="28.5" viewBox="0 0 16 16" style="    position: relative;
bottom: 11px;">
            <path fill="currentColor" d="m8 0l2 3H9v2H7V3H6zm7 7v8H1V7zm1-1H0v10h16z" />
            <path fill="currentColor" d="M8 8a3 3 0 1 1 0 6h5v-1h1V9h-1V8zm-3 3a3 3 0 0 1 3-3H3v1H2v4h1v1h5a3 3 0 0 1-3-3" />
          </svg>
        </div>

        </svg>

        <h4>Total Expense</h4>
      </div>
      <div class="exp">
        <?php
        include "connection.php";
        session_start();
        $user_id = $_SESSION['myuser'];

        $d_query = "SELECT start_date, end_date FROM budget WHERE user_IId = $user_id";
        $d_result = mysqli_query($conn, $d_query);


        $row = mysqli_fetch_assoc($d_result);
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];

        $totalExpenseAmount = 0;

        $expenseQuery = "SELECT amount FROM expense WHERE user_id = $user_id AND date BETWEEN '$start_date' AND '$end_date' ";
        $expenseData = mysqli_query($conn, $expenseQuery);
        $e = mysqli_num_rows($expenseData);
        while ($expenseResult = mysqli_fetch_assoc($expenseData)) {
          $totalExpenseAmount += $expenseResult['amount'];
        }

        echo "<h1 style='margin-top: 5px;'>";
        echo "-$" . number_format($totalExpenseAmount, 2);

        echo "</h1>
        </div>
     
    </div>
  </div>";
        ?>
        <?php
        ?>
        <!-- ==================================================================================================================================== -->
        <div class="analytic">
          <div class="analytic-info  balance-section">
            <div class="two">
              <svg id='color-income' xmlns="http://www.w3.org/2000/svg" width="34" height="28.5" viewBox="0 0 16 16" style="    position: relative;
">
                <path fill="currentColor" d="m8 16l-2-3h1v-2h2v2h1zm7-15v8H1V1zm1-1H0v10h16z" />
                <path fill="currentColor" d="M8 2a3 3 0 1 1 0 6h5V7h1V3h-1V2zM5 5a3 3 0 0 1 3-3H3v1H2v4h1v1h5a3 3 0 0 1-3-3" />
              </svg>
              <h4>Total Income</h4>
            </div>
            <div class="inc">
              <?php
              include "connection.php";
              session_start();
              $user_id = $_SESSION['myuser'];

              $d_query = "SELECT start_date, end_date FROM budget WHERE user_IId = $user_id";
              $d_result = mysqli_query($conn, $d_query);


              $row = mysqli_fetch_assoc($d_result);
              $start_date = $row['start_date'];
              $end_date = $row['end_date'];

              $totalIncomeAmount = 0;

              $incomeQuery = "SELECT amount FROM income WHERE user_Id = $user_id  AND date BETWEEN '$start_date' AND '$end_date'";
              $incomeData = mysqli_query($conn, $incomeQuery);

              while ($incomeResult = mysqli_fetch_assoc($incomeData)) {
                $totalIncomeAmount += $incomeResult['amount'];
              } ?>
              <h1 style="margin-top: 9px;"><?php echo "+$" . number_format($totalIncomeAmount, 2); ?></h1>
            </div>
          </div>
        </div>
        <!-- =================================================================================================================================================================== -->

        <div class="analytic">

          <div class="analytic-info balance-section">
            <div class="two">
              <button class="open-modal-button cursor" onclick="openModal2()">
                <svg id='color-budget' xmlns="http://www.w3.org/2000/svg" width="34" height="33.5" viewBox="0 0 24 24" style="    position: relative;
bottom: 0px;">
                  <path fill="currentColor" d="M3.005 3.003h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1h-18a1 1 0 0 1-1-1v-16a1 1 0 0 1 1-1m5.5 11v2h2.5v2h2v-2h1a2.5 2.5 0 1 0 0-5h-4a.5.5 0 1 1 0-1h5.5v-2h-2.5v-2h-2v2h-1a2.5 2.5 0 1 0 0 5h4a.5.5 0 0 1 0 1z" />
                </svg>
              </button>

              <?php

              // =================================================================================================================
              echo "           
<h4 class='cursor' onclick='openPopup()'>Total Balance</h4>
 </div>
<div class='balance'>";

              include "connection.php";
              session_start();
              $user_id = $_SESSION['myuser'];

              $da_query = "SELECT start_date, end_date FROM budget WHERE user_IId = $user_id";
              $da_result = mysqli_query($conn, $da_query);


              $row = mysqli_fetch_assoc($da_result);
              $start_date = $row['start_date'];
              $end_date = $row['end_date'];

              function getTotalIncome($conn, $user_id,  $start_date, $end_date)
              {
                $incomeQuery = "SELECT SUM(amount) AS total_income FROM income WHERE user_Id = $user_id AND date BETWEEN ' $start_date' AND '$end_date'";
                $incomeData = mysqli_query($conn, $incomeQuery);
                $incomeResult = mysqli_fetch_assoc($incomeData);

                if ($incomeResult) {
                  return $incomeResult['total_income'];
                }

                return 0;
              }

              function getTotalExpense($conn, $user_id,  $start_date, $end_date)
              {
                $expenseQuery = "SELECT SUM(amount) AS total_expense FROM expense WHERE user_id = $user_id   AND date BETWEEN ' $start_date' AND '$end_date'";
                $expenseData = mysqli_query($conn, $expenseQuery);
                $expenseResult = mysqli_fetch_assoc($expenseData);

                if ($expenseResult) {
                  return $expenseResult['total_expense'];
                }

                return 0;
              }

              function displayTotalBalance($conn, $user_id,  $start_date, $end_date)
              {
                $totalBalance = 0;

                $totalIncome = getTotalIncome($conn, $user_id,  $start_date, $end_date);
                $totalExpense = getTotalExpense($conn, $user_id,  $start_date, $end_date);

                $totalBalance += $totalIncome;
                $totalBalance -= $totalExpense;

                echo '<h1>$' . number_format($totalBalance, 2) . '</h1>';
              }

              if (isset($_SESSION['myuser'])) {
                $user_id = $_SESSION['myuser'];
                displayTotalBalance($conn, $user_id,  $start_date, $end_date);
              }

              ?>

            </div>
          </div>
        </div>
      </div>



    <?php
  }
    ?>







    <!-- -=-=-=-=-=-=-=-=-=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=============================--------------------------------= -->
    <dialog class="popup3">

      <h2>Budget Details</h2>
      <span class="close" onclick="closePopup3()">&times;</span>
      <div class="budget-container">
        <?php
        $user_id = $_SESSION['myuser'];
        $fetchQuery = "SELECT * FROM budget WHERE user_IId = '$user_id'";
        $result = mysqli_query($conn, $fetchQuery);
        if (!$result) {
          echo "Error: " . mysqli_error($conn);
        } else {
          if ($row = mysqli_fetch_assoc($result)) {
            echo "<p><strong>Budget Amount:</strong> $" . number_format($row['budget_amount'], 2) . "</p>";
            echo "<p><strong>Budget Allocation:</strong> " . $row['allocation'] . "</p>";
            echo "<p><strong>Start Date:</strong> " . $row['start_date'] . "</p>";
            echo "<p><strong>End Date:</strong> " . $row['end_date'] . "</p>";

            echo "  </div>";
            echo "
                            <div class='budget-btn'>
                               <button >
                                  <a href='budget.php'>New Budget</a>
                               </button>
                               <form id='delete-budget-form' method='post' style='display: inline;' onsubmit='return confirmDelete()'>
                               <button type='submit' name='delete-budget'>Delete budget</button>
                           </form>
                              
                            </div>
                            ";
          } else {
            echo "<p>No budget data found </p>";
            echo "
                            <div class='budget-btn'>
                               <button >
                                  <a href='budget.php'>New Budget</a>
                               </button>
                               
                            </div>
                            ";
          }
        }
        ?>

    </dialog>

    <!-- <dialog id="modal3" class="popup3">
            <span class="close close-button" onclick="closePopup3()">&times;</span>
              
            <h1>hello</h1></dialog> -->
    <script>
      function confirmDelete() {
        if (confirm("Are you sure you want to delete the budget?")) {
          return true;
        }
        return false;
      }
    </script>

    <?php
    if (isset($_POST['delete-budget'])) {
      $userId = $_SESSION['myuser'];

      $deleteQuery = "DELETE FROM budget WHERE user_IId = '$userId'";
      if (mysqli_query($conn, $deleteQuery)) {
        // echo "<script>alert('Budget deleted successfully.')</script>";
      } else {
        echo "<script>alert('Error deleting budget: " . mysqli_error($conn) . "');</script>";
      }
      echo "<meta http-equiv='refresh' content='0;url=dashboard.php'>";
    }
    ?>
    <!-- ------------------------------------------------------------------------------------------------------------------------------------------ -->