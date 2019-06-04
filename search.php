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
?>
