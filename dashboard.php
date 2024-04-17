<?php include("connection.php");
session_start();
if (!isset($_SESSION['myuser'])) {
  header("Location: index.php");
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


  <link rel="stylesheet" href="style/style1.css">
  <link rel="stylesheet" href="style/style2.css">
  <style>
    .comment {
      color: #777;
      font-style: italic;

    }
  </style>

</head>

<body>
  <?php
  require "dashboard1.php";
  ?>
  <!-- ==================================================================================================================== -->
  <?php

  require "analytics.php";
  ?>

  <!--===================================================================================================================================== -->
  <?php

  $userId = $_SESSION['myuser'];

  $existingDataQuery = "SELECT * FROM budget WHERE user_IId = '$userId'";
  $existingDataResult = mysqli_query($conn, $existingDataQuery);
  if (mysqli_num_rows($existingDataResult) == 0) {
    if (isset($_POST['search']) == 0) {
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



      $expenseQuery = "SELECT * FROM expense WHERE user_id = $user_id ORDER BY id DESC ";
      $expenseData = mysqli_query($conn, $expenseQuery);

      $expenseTotal = mysqli_num_rows($expenseData);
      if ($expenseTotal == 0) {
        echo "<tr><td colspan='4' class='comment'> No records found!</td></tr>";
      }
      $limit = 5;
      $page = 1;

      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      }

      $offset = ($page - 1) * $limit;

      $query_limit = "SELECT * FROM expense WHERE user_id= $user_id ORDER BY id DESC LIMIT $offset,$limit ";
      $result_limit = mysqli_query($conn, $query_limit);

      while ($expenseResult = mysqli_fetch_assoc($result_limit)) {
        echo "<tr class='trow '>
                 <td>" . $expenseResult['category'] . "</td>
                 <td>" . $expenseResult['descripition'] . "</td>
                 <td>" . $expenseResult['date'] . "</td>
                 <td>" . "-$" . $expenseResult['amount'] . "</td>
                 <td><a href='Eedit.php?id1=$expenseResult[id]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
                 <td><a href='delete.php?id1=$expenseResult[id]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
               </tr>";
      }



      echo "  </tbody>
          
        </table>
      <div class='page-container'>";


      $total_pages = ceil($expenseTotal / $limit);
      echo "<h4> pages:$page/$total_pages </h4>";

      $pagination = "<nav> 
        <ul class='pagination>'";

      if ($expenseTotal > $limit) {

        $disabled = ($page == 1) ? "disabled" : "";
        $prev = $page - 1;
        if ($disabled == "") {

          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='?page=1'>First</a></Button></li>";
          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='?page=$prev'>Previous</a></Button></li>";
        }


        $disabled = ($page == $total_pages) ? "disabled" : "";
        $next = $page + 1;
        if ($disabled == "") {
          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='dashboard.php?page=$next'>Next</a></Button></li>";
          $pagination .= "<li class='page-item $disabled'><Button class='pg-btn'><a class='page-link' href='?page=$total_pages'>Last</a></Button></li>";
        }
      }

      $pagination .= "</ul></nav>";
      echo $pagination;

      echo "</div>";

      echo "
 </div>
 </div> ";
      // =================================================================================================================================== 
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



      $incomeQuery = "SELECT * FROM income WHERE user_Id = $user_id ORDER BY ID DESC  ";
      $incomeData = mysqli_query($conn, $incomeQuery);

      $incomeTotal = mysqli_num_rows($incomeData);

      if ($incomeTotal == 0) {
        echo "<tr><td colspan='4' class='comment'> No records found!</td></tr>";
      }
      $limit1 = 5;
      $page1 = 1;

      if (isset($_GET['pagei'])) {
        $page1 = $_GET['pagei'];
      }

      $offset1 = ($page1 - 1) * $limit1;

      $query_limit1 = "SELECT * FROM income WHERE user_Id = $user_id ORDER BY ID DESC LIMIT $offset1,$limit1";
      $result_limit1 = mysqli_query($conn, $query_limit1);

      while ($incomeResult = mysqli_fetch_assoc($result_limit1)) {
        echo " 
      <tr class='trow '>
      <td>" . $incomeResult['category'] . "</td>
      <td>" . $incomeResult['descripition'] . "</td>
      <td>" . $incomeResult['date'] . "</td>
      <td>" . "+$" . $incomeResult['amount'] . "</td>
      <td><a href='edit1.php?id2=$incomeResult[ID]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
      <td><a href='delete.php?id2=$incomeResult[ID]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
      </tr>";
      }






      echo "     
 </tbody>
 </table>
 <div class='page-container'>";

      $total_pages1 = ceil($incomeTotal / $limit1);
      echo "<h4> pages:$page1/$total_pages1 </h4>";

      $pagination1 = "<nav> 
 <ul class='pagination>'";

      if ($incomeTotal > $limit1) {

        $disabled1 = ($page1 == 1) ? "disabled" : "";
        $prev1 = $page1 - 1;
        if ($disabled1 == "") {

          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='?pagei=1'>First</a></Button></li>";
          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='?pagei=$prev1'>Previous</a></Button></li>";
        }


        $disabled1 = ($page1 == $total_pages1) ? "disabled" : "";
        $next1 = $page1 + 1;
        if ($disabled1 == "") {
          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='dashboard.php?pagei=$next1'>Next</a></Button></li>";
          $pagination1 .= "<li class='page-item $disabled1'><Button class='pg-btn'><a class='page-link' href='?pagei=$total_pages1'>Last</a></Button></li>";
        }
      }

      $pagination1 .= "</ul></nav>";
      echo $pagination1;


      echo "
    </div> 
  </div>
 </div>";
    }
    // <!-- TODO:=======TODO:=========TODO:=============SSSEARCHHHHHHHHHHHHHHHHHHHH========================================================================== -->


    else {
      $search = $_POST['search'];

      if ($sql = "SELECT * FROM expense WHERE user_id= $user_id AND category='$search' OR user_id= $user_id AND date = '$search'  ") {
        // echo "Search";
        $result = mysqli_query($conn, $sql);

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




        if ($expenseTotal2 = mysqli_num_rows($result)) {
          if ($expenseTotal2 == 0) {
            echo "<tr><td colspan='4' class='comment'> No records found!</td></tr>";
          }
          $limit2 = 5;
          $page2 = 1;

          if (isset($_GET['page'])) {
            $page2 = $_GET['page'];
          }

          $offset2 = ($page2 - 1) * $limit2;

          $query_limit2 = "SELECT * FROM expense  WHERE user_id = $user_id AND category='$search'OR  user_id= $user_id AND date = '$search' ORDER BY id DESC LIMIT $offset2,$limit2";
          $result_limit2 = mysqli_query($conn, $query_limit2);

          while ($expenseResult2 = mysqli_fetch_assoc($result_limit2)) {
            echo "<tr class='trow '>
                 <td>" . $expenseResult2['category'] . "</td>
    
                 <td>" . $expenseResult2['descripition'] . "</td>
                 <td>" . $expenseResult2['date'] . "</td>
                 <td>" . "-$" . $expenseResult2['amount'] . "</td>
                 <td><a href='edit.php?id1=$expenseResult2[id]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
                 <td><a href='delete.php?id1=$expenseResult2[id]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
               </tr>";
          }



          echo "  </tbody>
          
        </table>
      <div class='page-container'>";


          $total_pages2 = ceil($expenseTotal2 / $limit2);
          echo "<h4> pages:$page2/$total_pages2 </h4>";

          $pagination2 = "<nav> 
        <ul class='pagination'>";

          if ($expenseTotal2 > $limit2) {

            $disabled2 = ($page2 == 1) ? "disabled" : "";
            $prev2 = $page2 - 1;
            if ($disabled2 == "") {

              $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='?page=1'>First</a></Button></li>";
              $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='?page=$prev2'>Previous</a></Button></li>";
            }


            $disabled2 = ($page2 == $total_pages2) ? "disabled" : "";
            $next2 = $page2 + 1;
            if ($disabled2 == "") {
              $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='dashboard.php?page=$next2'>Next</a></Button></li>";
              $pagination2 .= "<li class='page-item $disabled2'><Button class='pg-btn'><a class='page-link' href='?page=$total_pages2'>Last</a></Button></li>";
            }
          }

          $pagination2 .= "</ul></nav>";
          echo $pagination2;

          echo "</div>";
        } else {
          echo "<tr colspan='5' class='comment'><td>Transaction Not Found!</td></tr>
  
  ";

          echo "  </tbody>
    
  </table>";
        }
        echo "
  </div>
  </div> ";
      }

      // ===============================================================================================================================
      if ($sql3 = "SELECT * FROM income WHERE user_ID = $user_id AND category='$search' OR user_ID = $user_id AND date = '$search' ") {
        $result3 = mysqli_query($conn, $sql3);

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


        if ($incomeTotal3 = mysqli_num_rows($result3)) {
          if ($incomeTotal3 == 0) {
            echo "<tr><td colspan='4' class='comment'> No records found!</td></tr>";
          }
          $limit3 = 5;
          $page3 = 1;

          if (isset($_GET['pagei'])) {
            $page3 = $_GET['pagei'];
          }

          $offset3 = ($page3 - 1) * $limit3;

          $query_limit3 = "SELECT * FROM income WHERE user_ID = $user_id AND category='$search' OR user_ID = $user_id AND date = '$search' ORDER BY ID DESC LIMIT $offset3,$limit3";
          $result_limit3 = mysqli_query($conn, $query_limit3);

          while ($incomeResult3 = mysqli_fetch_assoc($result_limit3)) {
            echo "<tr class='trow '>
                 <td>" . $incomeResult3['category'] . "</td>
                 <td>" . $incomeResult3['descripition'] . "</td>
                 <td>" . $incomeResult3['date'] . "</td>
                 <td>" . "-$" . $incomeResult3['amount'] . "</td>
                 <td><a href='edit1.php?id2=$incomeResult3[ID]'><img class='edit' src='images/edit.png' alt='edit'></a></td>
                 <td><a href='delete.php?id2=$incomeResult3[I3]' onclick='return checkdelete()'><img class='delete redimg' src='images/delete.png' alt='delete'></a></td>
               </tr>";
          }



          echo "  </tbody>
          
        </table>
      <div class='page-container'>";


          $total_pages3 = ceil($incomeTotal3 / $limit3);
          echo "<h4> pages:$page3/$total_pages3 </h4>";

          $pagination3 = "<nav> 
        <ul class='pagination'>";
          if ($incomeTotal3 > $limit3) {

            $disabled3 = ($page3 == 1) ? "disabled" : "";
            $prev3 = $page3 - 1;
            if ($disabled3 == "") {

              $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='?page=1'>First</a></Button></li>";
              $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='?page=$prev3'>Previous</a></Button></li>";
            }


            $disabled3 = ($page3 == $total_pages3) ? "disabled" : "";
            $next3 = $page3 + 1;
            if ($disabled3 == "") {
              $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='dashboard.php?page=$next3'>Next</a></Button></li>";
              $pagination3 .= "<li class='page-item $disabled3'><Button class='pg-btn'><a class='page-link' href='?page=$total_pages3'>Last</a></Button></li>";
            }
          }

          $pagination3 .= "</ul></nav>";
          echo $pagination3;

          echo "</div>";
        } else {
          echo "<tr colspan='5' class='comment'><td>Transaction Not Found!</td></tr>

        
        ";

          echo "  </tbody>
          
        </table>";
        }
        echo "
        </div>
        </div> ";
      }
    }
  }

  include "after_budget.php";
  ?>



  </main>
  </div>

  <script src="main1.js"></script>

  <script>
    function checkdelete() {
      return confirm('Are you sure you want to delete this record?');
    }
  </script>

</body>

</html>


<?php
mysqli_close($conn);
?>