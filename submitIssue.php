<?php
include("dbconnect.php");
$dbconnection = new dbconnector;
$dbconnection->connect();
$sucess = $dbconnection->addIssue($_POST['title'], $_POST['description'],$_POST['resolution'],$_SESSION['user_id']);
if($sucess)
{
  echo "<p><b>Issue created successfully.</b> Redirecting to Dashboard....<p>";
  sleep(3);
  header("Location:dashboard.php");
}
else {
  echo "<p><b>An error occurred while adding the Issue. Please try again</b></p>";
  sleep(3);
  header("Location:addissue.php");
}
?>
