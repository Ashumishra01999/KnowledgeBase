<?php
session_start();

if(isset($_SESSION['username']))
{
     echo "<h3>Logged in as user - {$_SESSION['username']}</h3>";
     echo "<hr>";
     echo '<a href="logout.php">Logout</a>';
}
else
{
  die("<h3>Unauthorised Access<h3>");
}
require_once('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Search Results</title>
  </head>
  <body>
    <?php
    $dbconnection = new dbconnector;
    $dbconnection->connect();
    $rows = $dbconnection->search($_GET['query']);
    echo '<table>';
    if(count($rows) > 0){
      echo '<tr>';
      echo "<td>$rows[0]->['title']";
      echo '</td>';
      echo '</tr>';
    }

     ?>
  </body>
</html>
