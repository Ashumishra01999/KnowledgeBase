<?php
session_start();
require_once("dbconnect.php");
require_once("util.php");
$dbconnection = new dbconnector;
$dbconnection->connect();
$success = $dbconnection->addIssue($_POST['title'], $_POST['description'],$_POST['resolution'],$_SESSION['user_id']);
if($success[0])
{
  $_SESSION['newissue']='true';
  if(newissue_mailer($_POST['title'], $_POST['description'], $_POST['resolution']))
  {
    echo "Email sent successfully";
  }
  else
  {
    echo "Email failed";
  }
  header("Location:post.php?post_id=".$success[1]);
}
else {
  $_SESSION['error']='add_issue_failed';
  header("Location:addissue.php");
}
?>
