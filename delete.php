<?php
include("connection.php");
$id1 = $_GET['id1'];

$expenseQuery = "DELETE  FROM expense WHERE id = '$id1' ";
$expenseData = mysqli_query($conn, $expenseQuery);

$id2 = $_GET['id2'];
$incomeQuery = "DELETE FROM income WHERE ID = '$id2' ";
$incomeData = mysqli_query($conn, $incomeQuery);

if($expenseData || $incomeData)
{
    echo"<script>alert('Record Deleted')</script>";
    header("Location: http://localhost/minor_project-I/dashboard.php"); // Redirect to the dashboard
    exit();
    ?>


    <?php
}
else{
    echo"<script>alert('Fail to Delete')</script>";
}
?>