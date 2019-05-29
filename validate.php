<?php
include("dbconnect.php");
$dbconnection = new dbconnector;
$dbconnection->connect();

$result = $dbconnection->chechLogin($_POST['username'], $_POST['password']);
if($result->num_rows > 0)
{
  session_start();
  $_SESSION['username'] = $_POST['username'];
  header("Location:dashboard.php");
}
else {
  echo "<p>Invalid Username or Password</p>";
}
?>
