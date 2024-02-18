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
                        <a href="dashboard.php"  class="margin-top">
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
                    <li class="active">
                        <a href="budget.php" class="margin-top " aria-current="page" id="budget">
                            <i class="fa-solid fa-file-invoice-dollar" style="font-weight: 900; font-size: 2rem; color: #3838E8;"></i>
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
                        <a href="logout.php" class="margin-top open-button">
                            <img class="images open-button" src="images/logout.png" alt="logout">
                            <div class="title">Logout</div>
                        </a>
                    </li>



                </ul>
            </div>
        </div>



        <main class="main">
   
<!-- ------------------------------------------------------------------------------------------------------------------------------ -->
            <div class="modal" id="budgetModal">
                <h2> Budget</h2>
                <!-- <button class="close-button" onclick="closeModal()">&times;</button> -->
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
                        <button type="submit" name="set-budget">Set Budget</button>
                        <!-- <button type="submit" name="Update" >Update</button> -->
                    </div>
                </form>

            </div>

        </main>
    </div>


<?php
if (isset($_POST['set-budget'])) {
    // Retrieve form data
    $budgetAmount = $_POST['amount'];
    $allocation = $_POST['allocation'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    // Assuming user_id is available in your session
    $userId = $_SESSION['myuser'];

    // Check if there's existing data for the user
    $existingDataQuery = "SELECT * FROM budget WHERE user_IId = '$userId'";
    $existingDataResult = mysqli_query($conn, $existingDataQuery);

    if (mysqli_num_rows($existingDataResult) > 0) {
        // Update existing data
        $updateQuery = "UPDATE budget SET 
                        budget_amount = '$budgetAmount', 
                        allocation = '$allocation', 
                        start_date = '$startDate', 
                        end_date = '$endDate' 
                        WHERE user_IId = '$userId'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Budget updated successfully.')</script>";
        } else {
            echo "<script>alert('Error updating budget: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        // Insert new data
        $insertQuery = "INSERT INTO budget (budget_amount, allocation, start_date, end_date, user_IId)
                        VALUES ('$budgetAmount', '$allocation', '$startDate', '$endDate', '$userId')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Budget set successfully.')</script>";
        } else {
            echo "<script>alert('Error setting budget: " . mysqli_error($conn) . "');</script>";
        }
    }

    // Redirect to dashboard after processing
    echo "<meta http-equiv='refresh' content='0;url=dashboard.php'>";
}
?>
<?php
$_SESSION['budgetAmount'] = $_POST['amount'];
$_SESSION['allocation'] = $_POST['allocation'];
$_SESSION['startDate'] = $_POST['startDate'];
$_SESSION['endDate'] = $_POST['endDate'];?>

  <script src="main1.js"></script>

    </body>
    </html>