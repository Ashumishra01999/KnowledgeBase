<?php
require_once("dbconnect.php");
session_start();
if(isset($_POST['auth_id']))
{
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $status = $dbconnection->approvepost($_POST['auth_id'], 1);
  if($status == 1)
  {
    $_SESSION['approved'] = true;
    header("Location:review.php");
  }
  else
  {
    echo 'Post unavailable or already approved';
  }
}
else
{
  echo "Invalid Request";
}
