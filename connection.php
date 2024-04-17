<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smart_finance";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) {
  //  echo" connection ok";
} else {
  echo " connection failed";
}
