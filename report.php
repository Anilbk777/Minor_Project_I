<?php include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART FINANCE</title>
  <!-- <link rel="stylesheet" href="style.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style/style1.css">
  <link rel="stylesheet" href="style/style2.css">
  <style>
    .top-section {
      display: flex;
    }

    .header {
      box-shadow: rgb(136 136 198 / 70%) 0px 3px 4px;
      border-top: 3px solid var(--blue);
      border-radius: 1rem;
      padding: 1.5rem;
      margin: 5px 15px 7px 17px;
      width: 100%;
    }

    #reportForm {
      width: 950px;
      margin: 20px auto 0px auto;
      padding: 16px;
      display: flex;
      justify-content: center;
      gap: 18px;
      border-radius: 14px;
      font-size: 18px;
      font-weight: 600;
      box-shadow: rgb(136 136 198 / 70%) 0px 3px 4px;
      border-top: 3px solid var(--blue);
    }

    .btn {
      background-color: #3498db;
      color: #fff;
      padding: 9px;
      cursor: pointer;
      border: none;
      border-radius: 10px;
      transition: background-color 0.3s, color 0.3s;
      width: 118px;
    }

    .btn:hover {
      background-color: #3838E8;
      box-shadow: rgba(56, 56, 232, 0.7) 0 0 10px;
    }

    #reportForm input {
      padding: 5px;
      width: 175px;
      border: 1px solid #3838E8;
      border-radius: 10px;
      box-sizing: border-box;
      font-size: 1rem;

    }

    .msg {
      width: 950px;
      margin: 40px auto 0px auto;
      padding: 16px;
      display: flex;
      justify-content: center;
      gap: 18px;
      border-radius: 14px;
      font-size: 18px;
      font-weight: 600;
      box-shadow: rgb(136 136 198 / 70%) 0px 3px 4px;
      border-top: 3px solid var(--blue);
      color: #777;
      font-style: italic;
    }

    .report {
      margin: 20px 15px 0px 65px;
      border-radius: 1rem;
      max-width: 1440px;
      width: 93.5%;
      background: var(--white);
      box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.12);
    }

    .report h2 {
      padding: 0.5rem;
      font-size: 2.5rem;
      text-align: center;
    }

    .report table {
      width: 100%;
      border-collapse: collapse;
    }

    .report th {
      padding: 0.8rem;
      letter-spacing: 0.2rem;
      vertical-align: top;
      border: 0px solid #aab7b8;

      background: var(--blue);
      color: #fff;
    }

    .report td {
      font-size: 1rem;
      letter-spacing: 0.2rem;
      font-weight: normal;
      text-align: center;
      border: none;
      border-bottom: 1px solid var(--blue);
      padding: 1.1rem;
    }

    .report tr:hover {
      border-radius: 1rem;
      transition: all 0.3s ease-in;
      cursor: pointer;
      box-shadow: 2px 2px 12px rgba(56, 56, 232, 0.25), -1px -1px 8px rgba(56, 56, 232, 0.25);
      transform: scale(1.02);
    }

    .printrepo {
      margin-top: 15px;
      position: relative;
      left: 50%;
    }

    @media print {

      body {
        font-size: 14px;
      }

      .report th,
      .report td {
        font-size: 0.9em;
        padding: 0.8em;
      }
    }
  </style>
</head>

</style>

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
          <li>
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
          <li>
            <a href="budget.php" class="margin-top" id="budget">
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
            <a href="report.php" aria-current="page" class="margin-top open-button">
              <img class="images open-button" src="images/report.png" alt="report">
              <div class="title">Report</div>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <main class="main">
      <div class="top-section">
        <span class="menu"><img src="images/menu.webp" alt="menu"></span>
        <header class="header">
          <h1>Report</h1>
        </header>
      </div>




      <!-- =================================================================================================================================================== -->

      <form id="reportForm" method="post">
        <div class="form-group">
          <label for="startDate">FROM:</label>
          <input type="date" id="startDate" name="start_date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
        </div>
        <div class="form-group">
          <label for="endDate">TO:</label>
          <input type="date" id="endDate" name="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
        </div>
        <div class="form-group">
          <label for="category">Category:</label>
          <input type="text" id="category" name="category" placeholder="Enter category" value="<?php echo isset($_POST['category']) ? $_POST['category'] : ''; ?>">
        </div>
        <button class="btn" type="submit" name="submit">Generate Report</button>

      </form>


      <?php
      include("connection.php");

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $category = $_POST['category'];
        $user_id = $_SESSION['myuser'];

        if (!empty($start_date) || !empty($end_date) || !empty($category)) {

          if (empty($start_date) && empty($end_date) && empty($category)) {
            $expenseQuery = "SELECT * FROM expense WHERE user_id = ?";
            $incomeQuery = "SELECT * FROM income WHERE user_ID = ?";
            $stmt_expense = $conn->prepare($expenseQuery);
            $stmt_income = $conn->prepare($incomeQuery);
            $stmt_expense->bind_param("i", $user_id);
            $stmt_income->bind_param("i", $user_id);
          } else {
            if (!empty($start_date) && !empty($end_date) && !empty($category)) {
              $expenseQuery = "SELECT * FROM expense WHERE user_id = ? AND category = ? AND date BETWEEN ? AND ?";
              $incomeQuery = "SELECT * FROM income WHERE user_ID = ? AND category = ? AND date BETWEEN ? AND ?";
              $stmt_expense = $conn->prepare($expenseQuery);
              $stmt_income = $conn->prepare($incomeQuery);
              $stmt_expense->bind_param("isss", $user_id, $category, $start_date, $end_date);
              $stmt_income->bind_param("isss", $user_id, $category, $start_date, $end_date);
            } elseif (!empty($start_date) && !empty($end_date)) {
              $expenseQuery = "SELECT * FROM expense WHERE user_id = ? AND date BETWEEN ? AND ?";
              $incomeQuery = "SELECT * FROM income WHERE user_ID = ? AND date BETWEEN ? AND ?";
              $stmt_expense = $conn->prepare($expenseQuery);
              $stmt_income = $conn->prepare($incomeQuery);
              $stmt_expense->bind_param("iss", $user_id, $start_date, $end_date);
              $stmt_income->bind_param("iss", $user_id, $start_date, $end_date);
            } elseif (!empty($category)) {
              $expenseQuery = "SELECT * FROM expense WHERE user_id = ? AND category = ?";
              $incomeQuery = "SELECT * FROM income WHERE user_ID = ? AND category = ?";
              $stmt_expense = $conn->prepare($expenseQuery);
              $stmt_income = $conn->prepare($incomeQuery);
              $stmt_expense->bind_param("is", $user_id, $category);
              $stmt_income->bind_param("is", $user_id, $category);
            }
          }

          $stmt_expense->execute();
          $expenseResult = $stmt_expense->get_result();

          $stmt_income->execute();
          $incomeResult = $stmt_income->get_result();

          $total_expense = 0;
          while ($row = $expenseResult->fetch_assoc()) {
            $total_expense += $row['amount'];
          }

          $total_income = 0;
          while ($row = $incomeResult->fetch_assoc()) {
            $total_income += $row['amount'];
          }

          if ($expenseResult->num_rows > 0) {
            echo "<div class='report'  id='expenseReport' >";
            echo "<h2>Expense</h2>";
            echo "<table>";
            echo "<tr><th>Category</th><th>Description</th><th>Date</th><th>Amount</th></tr>";
            $expenseResult->data_seek(0);
            while ($row = $expenseResult->fetch_assoc()) {
              echo "<tr><td>" . $row['category'] . "</td><td>" . $row['descripition'] . "</td><td>" . $row['date'] . "</td><td>" . $row['amount'] . "</td></tr>";
            }
            echo "<tr><td colspan='3'><strong>Total Expenses</strong></td><td><strong>$" . $total_expense . "</strong></td></tr>";
            echo "</table>";
            echo "</div>";
            echo "<button class='btn printrepo' id='printExpense'>Print Expense Report</button>";
          }

          if ($incomeResult->num_rows > 0) {
            echo "<div class='report' id='incomeReport'>";
            echo "<h2>Income</h2>";
            echo "<table>";
            echo "<tr><th>Category</th><th>Description</th><th>Date</th><th>Amount</th></tr>";
            $incomeResult->data_seek(0);
            while ($row = $incomeResult->fetch_assoc()) {
              echo "<tr><td>" . $row['category'] . "</td><td>" . $row['descripition'] . "</td><td>" . $row['date'] . "</td><td>" . $row['amount'] . "</td></tr>";
            }
            echo "<tr><td colspan='3'><strong>Total Income</strong></td><td><strong>$" . $total_income . "</strong></td></tr>";
            echo "</table>";
            echo "</div>";
            echo "<button class='btn printrepo' id='printIncome'>Print Income Report</button>";
          }

          if ($expenseResult->num_rows == 0 && $incomeResult->num_rows == 0) {
            echo "<p class='msg'>No records found for the provided criteria.</p>";
          }

          $stmt_expense->close();
          $stmt_income->close();
        } else {
          echo "<p class='msg'>Please enter search criteria to generate a report.</p>";
        }
      } else {
        echo "<p class='msg'>Please enter search criteria to generate a report.</p>";
      }
      ?>


    </main>
  </div>

  <script>
    const printExpenseBtn = document.getElementById('printExpense');
    const printIncomeBtn = document.getElementById('printIncome');

    printExpenseBtn.addEventListener('click', function() {
      printReport('expenseReport', 'Expense Report');
    });

    printIncomeBtn.addEventListener('click', function() {
      printReport('incomeReport', 'Income Report');
    });

    function printReport(reportId, title) {
      const reportContent = document.getElementById(reportId);
      if (reportContent) {
        const clonedContent = reportContent.cloneNode(true);
        const printWindow = window.open('', '_self');
        printWindow.document.write('<html><head><title>' + title + '</title>');
        printWindow.document.write('<style>table { border-collapse: collapse; width: 100%; }');
        printWindow.document.write('th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }');
        printWindow.document.write('th { text-align: center; }</style>'); // Center align table headers
        printWindow.document.write('</head><body>');
        printWindow.document.write(clonedContent.innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        setTimeout(() => {
          printWindow.print();
          location.reload();
        }, 1000);
      } else {
        console.error('Report content not found');
      }
    }



    document.addEventListener('DOMContentLoaded', function() {
      const navigation = document.querySelector('.navigation');
      const main = document.querySelector('.main');

      const menuIcon = document.querySelector('.menu');

      menuIcon.addEventListener('click', function() {
        navigation.classList.toggle('active');
        main.classList.toggle('active');
      });
    });
  </script>

</body>

</html>