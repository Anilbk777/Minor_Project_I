<?php include("connection.php");
session_start();
// Check if the user is logged in and if the user_id is available in the session
if (!isset($_SESSION['myuser'])) {
  // Redirect to the login page or handle the authentication logic
  header("Location: doc.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SMART FINANCE </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style1.css">
  <link rel="stylesheet" href="style/style2.css">

  <style>

    .top-section{
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

  .transaction {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 1rem;
  }

  .form {
    display: flex;
    flex-direction: column;
  }

  .form label {
    margin-bottom: 8px;
    font-weight: 600;
  }

  .form input, .form textarea {
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #3838E8;
    border-radius: 10px;
    box-sizing: border-box;
    font-size: 1rem;
  }
  .form input:hover, .form textarea:hover{
    border: 1px solid #3838E8;
    box-shadow:  rgba(56, 56, 232, 0.12) 0 0 10px;
  }
  .form input:focus, .form textarea:focus{
    outline: none;
    border: 3px solid #3838E8;
    box-shadow:  rgba(56, 56, 232, 0.12) 0 0 10px;
  }
  .btn{
      display: flex;
      justify-content: center;
      gap: 0.5rem;
  }

 .btn input {
    background-color: #3498db;
    color: #fff;
    padding: 12px;
    cursor: pointer;
    border: none;
    border-radius: 10px;
    transition: background-color 0.3s, color 0.3s;
    width: 100%;
  }

  .btn input:hover { 
    background-color: #3838E8;
    box-shadow:  rgba(56, 56, 232, 0.7) 0 0 10px;
  } 
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
          <li class="active">
            <a href="transaction.php" aria-current="page" class="margin-top">
              <img class="images" src="images/transaction.webp" alt="transaction">
              <div class="title">Transactions</div>
            </a>
          </li>
          <li>
            <a href="budget.php" class="margin-top  " id="budget">
            <i class="fa-solid fa-file-invoice-dollar" ></i>
              <div class="title">Budget</div>
            </a>
          </li>
          <li>
            <a href="charts.php" class="margin-top">
              <img class="images" src="images/chart.png" alt="chart">
              <div class="title">Charts</div>
            </a>
          </li>
          <li>
            <a href="logout.php" class="margin-top">
              <img class="images" src="images/logout.png" alt="logout">
              <div class="title">Logout</div>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <!-- =======================main========================================================================================================= -->
    <main class="main">
      <div class="top-section">
        <span class="menu"><img src="images/menu.webp" alt="menu"></span>
        <header class="header">
          <h1>Transaction</h1>
        </header>
      </div>

      <div class="transaction">

        <form class="form" id="expenseForm" action="#" method="POST">
          <label for="category">Category:</label>
          <input type="text" id="category" placeholder="Enter category" required name="category">

          <label for="date">Date:</label>
          <input type="date" id="date"  required name="date">

          <label for="amount">Amount:</label>
          <input type="number" id="amount" step="any" required name="amount">

          <label for="description">Description:</label>
          <textarea id="description" rows="4" name="descripition"></textarea>

          <div class="button-container btn">
            <input type="submit" value="Add expense" name="expense" onclick="submitEntry('expense')"></input>
            <input type="submit" value="Add Income" name="income" onclick="submitEntry('income')"></input>
          </div>

        </form>
      </div>



    </main>


  </div>
  <script src="main1.js"></script>
</body>

</html>
<?php



if (isset($_POST['expense'])) {
  $category = $_POST['category'];
  $date = $_POST['date'];
  $amount = $_POST['amount'];
  $description = $_POST['descripition'];
  $user_id = $_SESSION['myuser'];

    $query = "INSERT INTO expense (category, date, amount, descripition, user_id) VALUES ('$category', '$date', '$amount', '$description', $user_id)";
    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script>alert('Transaction inserted.')</script>";
    } else {
        echo "<script>alert('Transaction insertion Failed.')</script>";
    }
} elseif (isset($_POST['income'])) {
    $category1 = $_POST['category'];
    $date1 = $_POST['date'];
    $amount1 = $_POST['amount'];
    $description1 = $_POST['descripition'];
  $user_id = $_SESSION['myuser'];


    // Insert data into the 'income' table with no 'user_id' foreign key (assuming 'income' table has no such foreign key)
    $query1 = "INSERT INTO income (category, date, amount, descripition, user_Id) VALUES ('$category1', '$date1', '$amount1', '$description1', $user_id)";
    $data1 = mysqli_query($conn, $query1);

    if ($data1) {
        echo "<script>alert('Transaction inserted.')</script>";
    } else {
        echo "<script>alert('Transaction insertion Failed." . mysqli_error($conn) . "')</script>";
    }
}


?>

