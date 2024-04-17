<?php
include("connection.php");
session_start();
$user_id = $_SESSION['myuser'];

$incomeData = [];
$expenseData = [];
$areaChartData = [];

$incomeDataExists = false;
$expenseDataExists = false;
$areaChartDataExists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $incomeQuery = "SELECT category, SUM(amount) AS total FROM income WHERE user_ID = ? AND date BETWEEN ? AND ? GROUP BY category";
    $stmt_income = $conn->prepare($incomeQuery);
    $stmt_income->bind_param("iss", $user_id, $start_date, $end_date);
    $stmt_income->execute();
    $incomeResult = $stmt_income->get_result();

    $incomeData = [['Category', 'Amount']];
    while ($row = $incomeResult->fetch_assoc()) {
        $incomeData[] = [$row['category'], (float)$row['total']];
    }

    $stmt_income->close();

    $incomeDataExists = !empty($incomeData);

    $expenseQuery = "SELECT category, SUM(amount) AS total FROM expense WHERE user_id = ? AND date BETWEEN ? AND ? GROUP BY category";
    $stmt_expense = $conn->prepare($expenseQuery);
    $stmt_expense->bind_param("iss", $user_id, $start_date, $end_date);
    $stmt_expense->execute();
    $expenseResult = $stmt_expense->get_result();

    $expenseData = [['Category', 'Amount']];
    while ($row = $expenseResult->fetch_assoc()) {
        $expenseData[] = [$row['category'], (float)$row['total']];
    }

    $stmt_expense->close();

    $expenseDataExists = !empty($expenseData);

    $incomeQuery1 = "SELECT date, SUM(amount) AS total FROM income WHERE user_ID = ? AND date BETWEEN ? AND ? GROUP BY date";
    $stmt_income1 = $conn->prepare($incomeQuery1);
    $stmt_income1->bind_param("iss", $user_id, $start_date, $end_date);
    $stmt_income1->execute();
    $incomeResult1 = $stmt_income1->get_result();

    $expenseQuery1 = "SELECT date, SUM(amount) AS total FROM expense WHERE user_id = ? AND date BETWEEN ? AND ? GROUP BY date";
    $stmt_expense1 = $conn->prepare($expenseQuery1);
    $stmt_expense1->bind_param("iss", $user_id, $start_date, $end_date);
    $stmt_expense1->execute();
    $expenseResult1 = $stmt_expense1->get_result();

    $combinedData = [];
    while ($row1 = $incomeResult1->fetch_assoc()) {
        $date = $row1['date'];
        $totalIncome = (float)$row1['total'];
        $combinedData[$date]['income'] = $totalIncome;
    }

    while ($row1 = $expenseResult1->fetch_assoc()) {
        $date = $row1['date'];
        $totalExpense = (float)$row1['total'];
        if (isset($combinedData[$date])) {
            $combinedData[$date]['expense'] = $totalExpense;
        } else {
            $combinedData[$date] = ['income' => 0, 'expense' => $totalExpense];
        }
    }

    foreach ($combinedData as $date => $data) {
        $areaChartData[] = [$date, $data['income'], $data['expense']];
    }

    $areaChartDataExists = !empty($areaChartData);

    $stmt_income1->close();
    $stmt_expense1->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMART FINANCE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style2.css">
    <style>
        /* CSS styles */
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

        #income_chart {
            border: 2px solid blue;
            /* Green border */
            border-radius: 10px;
            padding: 20px;
            width: 45%;
            height: 500px;
            margin-right: 10px;
            margin-top: 20px;
        }

        #expense_chart {
            border: 2px solid blue;
            /* Red border */
            border-radius: 10px;
            padding: 20px;
            width: 45%;
            height: 500px;
            margin-left: 10px;
            margin-top: 20px;
        }

        #piechart {
            width: 45%;
            height: 500px;
            margin: 0 auto;
        }

        form {
            margin: 20px auto;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="date"] {
            padding: 5px;
            margin: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 8px 20px;
            margin-top: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .no-data {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }


        #chartForm {
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

        .btn {
            background-color: #3498db;
            color: #fff;
            padding: 12px;
            cursor: pointer;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s, color 0.3s;
            width: 126px;
            position: relative;
            bottom: 5px;
        }

        .btn:hover {
            background-color: #3838E8;
            box-shadow: rgba(56, 56, 232, 0.7) 0 0 10px;
        }

        #chartForm input {
            padding: 5px;
            width: 175px;
            border: 1px solid #3838E8;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 1rem;
            position: relative;
            bottom: 5px;

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="navigation">
            <div class="logo">
                <div class="sf-icon-container">
                    <div class="sf-icon">SF</div>
                </div>
                <div class=" smart">Smart Finance</div>
            </div>
            <div class="box1">
                <ul>
                    <li>
                        <a href="dashboard.php" class="margin-top">
                            <img class="images" src="images/dashboard.png" alt="home">
                            <div class="title">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <a href="transaction.php" aria-current="page" class="margin-top">
                            <img class="images" src="images/transaction.webp" alt="transaction">
                            <div class="title">Transactions</div>
                        </a>
                    </li>
                    <li>
                        <a href="budget.php" class="margin-top  " id="budget">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            <div class="title">Budget</div>
                        </a>
                    </li>
                    <li class="active">
                        <a href="linegraph2.php" class="margin-top ">
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
        <main class="main">
            <div class="top-section">
                <span class="menu"><img src="images/menu.webp" alt="menu"></span>
                <header class="header">
                    <h1>Chart</h1>
                </header>
            </div>

            <form id="chartForm" method="post" action="">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" required value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">

                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" required value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">

                <button class="btn" type="submit" name="submit">Generate Charts</button>

            </form>


            <?php if (!$areaChartDataExists && !$incomeDataExists) : ?>
                <p class='msg'>Please enter search criteria to generate a report.</p>
            <?php elseif (!$areaChartDataExists && $incomeDataExists) : ?>
                <p class='msg'>No records found for the provided Date.</p>
            <?php else : ?>
                <br><br>
                <div id="area_chart" style="width: 100%; height: 500px;"></div>

                <?php if ($incomeDataExists) : ?>
                    <div style="display: flex;
        justify-content: center;
        width: 98%;
        position: relative;
        left: 40px;">
                        <div id="income_chart" style="width: 45%; height: 500px;"></div>
                        <div id="expense_chart" style="width: 45%; height: 500px;"></div>
                    </div>
                <?php else : ?>
                    <div class="no-data">No income data available for the selected date range.</div>
                <?php endif; ?>
            <?php endif; ?>




            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawCharts);

                function drawCharts() {
                    <?php if ($incomeDataExists) : ?>
                        var incomeData = google.visualization.arrayToDataTable(<?php echo json_encode($incomeData); ?>);
                        var incomeOptions = {
                            title: 'Income by Category',
                            fontSize: 15,
                            chartArea: {
                                left: 50,
                                top: 20,
                                width: '80%',
                                height: '400'
                            }
                        };
                        var incomeChart = new google.visualization.PieChart(document.getElementById('income_chart'));
                        incomeChart.draw(incomeData, incomeOptions);
                    <?php endif; ?>

                    <?php if ($expenseDataExists) : ?>
                        var expenseData = google.visualization.arrayToDataTable(<?php echo json_encode($expenseData); ?>);
                        var expenseOptions = {
                            title: 'Expense by Category',
                            fontSize: 15,
                            chartArea: {
                                left: 50,
                                top: 20,
                                width: '80%',
                                height: '80%'
                            }
                        };
                        var expenseChart = new google.visualization.PieChart(document.getElementById('expense_chart'));
                        expenseChart.draw(expenseData, expenseOptions);
                    <?php endif; ?>

                    <?php if ($areaChartDataExists) : ?>
                        // Draw area chart
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Income', 'Expense'],
                            <?php
                            $unique_dates = array_unique(array_column($areaChartData, 0));
                            foreach ($unique_dates as $date) {
                                $income = 0;
                                $expense = 0;
                                foreach ($areaChartData as $row) {
                                    if ($row[0] === $date) {
                                        $income += $row[1];
                                        $expense += $row[2];
                                    }
                                }
                                echo "['$date', $income, $expense],";
                            }
                            ?>
                        ]);
                        var options = {
                            title: 'Income and Expense Over Time',
                            fontSize: 15,
                            curveType: 'function',
                            legend: {
                                position: 'bottom'
                            },
                            hAxis: {
                                title: 'Date',
                                titleTextStyle: {
                                    color: '#333'
                                }
                            },
                            vAxis: {
                                title: 'Amount',
                                minValue: 0
                            },
                            chartArea: {
                                left: 150,
                                top: 70,
                                width: '80%',
                                height: '70%'
                            }
                        };
                        var chart = new google.visualization.AreaChart(document.getElementById('area_chart'));
                        chart.draw(data, options);
                    <?php endif; ?>
                }
            </script>
        </main>
    </div>
</body>

</html>