<?php
session_start();
require_once('dbconnect.php');
require_once('util.php');

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}

if ( isset($_POST['delete']) && isset($_POST['post_id']) ){
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $dbconnection->deletePost($_POST['post_id']);
  $_SESSION['success'] = 'Record deleted';
  header( 'Location: approvedposts.php' ) ;
  return;
}

if ( ! isset($_GET['post_id']) ) {
  $_SESSION['error'] = "Missing  post_id";
  header('Location: approvedposts.php');
  return;
}

$dbconnection = new dbconnector;
$dbconnection->connect();
$row = $dbconnection->getPost($_GET['post_id']);


?>

<html>
<head>
<title>Delete</title>
</head>
<body>
<?php
 // echo $_SESSION['error']; ?>
<p>Confirm: Deleting Post With title : <?php echo $row['title']; ?></p>

<form method="post">
<input type="hidden" name="post_id" value="<?= $_GET['post_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="approvedposts.php">Cancel</a>
</form>
</body>
</html>
