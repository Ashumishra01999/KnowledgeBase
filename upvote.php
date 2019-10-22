<?php
require_once("dbconnect.php");
session_start();
if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
$dbconnection = new dbconnector;
$dbconnection->connect();
if(!isset($_POST['post_id']) || !isset($_POST['user_id']) || !isset($_POST['upvote']) || !isset($_POST['likes']))
{
  echo 'Invalid Request';
  die();
}
if($_POST['upvote'] == '1')
{
  if($dbconnection->upvotepost($_POST['post_id'], $_POST['user_id'], $_POST['likes']))
  {
    echo '1';
  }
  else
  {
    echo '0';
  }
}
else
{
  if($dbconnection->removeupvote($_POST['post_id'], $_POST['user_id'], $_POST['likes']))
  {
    echo '1';
  }
  else
  {
    echo '0';
  }
}
