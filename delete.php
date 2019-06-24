<?php
session_start();
require_once('dbconnect.php');
require_once('util.php');

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
$dbconnection = new dbconnector;
$dbconnection->connect();
if ( isset($_POST['delete']) && isset($_POST['post_id']) ){
  $dbconnection->deletePost($_POST['post_id']);
  $_SESSION['success'] = 'RecordDeleted';
  header('Location:superadmin.php');
}

if ( !isset($_GET['post_id']) ) {
  $_SESSION['error'] = "Missing  post_id";
  header('Location:superadmin.php');
  return;
}
$post = $dbconnection->getPost($_GET['post_id']);


?>

<html>
<head>
<title>Delete</title>
</head>
<body>
<p>Confirm: Deleting Post With title : <?php echo $post['title']; ?></p>

<form method="post">
<input type="hidden" name="post_id" value="<?= $_GET['post_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="superadmin.php">Cancel</a>
</form>
</body>
</html>
