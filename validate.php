<?php
session_start();
include("dbconnect.php");
$dbconnection = new dbconnector;
$dbconnection->connect();

$result = $dbconnection->checkLogin($_POST['username'], $_POST['password']);
$row = $result->fetch_array(MYSQLI_ASSOC);
if($result->num_rows > 0)
{
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['user_id'] = $row['id'];
  $_SESSION['name'] = $row['name'];
  header("Location:dashboard.php");
}
else
{
  $_SESSION['error']='login';
  header("Location:login.php");
}
?>
