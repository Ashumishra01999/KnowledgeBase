<?php
session_start();

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
require_once("dbconnect.php");
require_once("util.php");
$dbconnection = new dbconnector;
$dbconnection->connect();
$UID1= mt_rand(1000000,9999999);
$UID2= mt_rand(1000000,9999999);
$success = $dbconnection->addIssue($_POST['title'], $_POST['description'],$_POST['resolution'],$_SESSION['user_id'], $UID1, $UID2);
if($success[0])
{
  $_SESSION['newissue']='true';
  if(newissue_mailer($_POST['title'], $_POST['description'], $_POST['resolution'], array($UID1, $UID2)))
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
