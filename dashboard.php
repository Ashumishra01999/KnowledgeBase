<?php
session_start();

if(isset($_SESSION['username']))
{
     echo "<h3>Logged in as user - {$_SESSION['username']}</h3>";
?>
     <hr>
     <a href="logout.php">Logout</a>
<?php
}
else
{
    echo "<h3>Unauthorised Access<h3>";
}

?>
