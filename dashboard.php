//https://www.w3schools.com/howto/howto_css_search_button.asp
<?php
session_start();

if(isset($_SESSION['username']))
{
     echo "<h3>Logged in as user - {$_SESSION['username']}</h3>";
     echo "<hr>";
     echo '<a href="logout.php">Logout</a>';
?>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.centernav {
  overflow: hidden;
  font-size: 20%;
  text-align: center;
  margin-top: 15%;
  padding: 6px;
}
.centernav input[type=text] {

  font-size: 50px;
  background-color: rgba(0, 0, 0, 0.1);
  border: 2px solid #FFFF

}
.centernav button {
  float: none;
  width: 5%;
  padding: 25px;
  background: #2196F3;
  color: white;
  font-size: 20px;
  border: 2px solid grey;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}
.centernave button:hover {
  background: #0b7dda;
}
.centernav::after {
  content: "";
  clear: both;
  display: table;
}
.addnew{
  width:100%;
  overflow: hidden;
  font-size: 20px;
  text-align: right;
  position: absolute;
  top:0;
  right:0;
  margin-top: 5px;
  margin-right: 3px;
}
.addnew a {
  float: right;
  display: block;
  text-align: center;
  padding: 2px;
  text-decoration: none;
  font-size: 17px;
  border: 2px solid ;
}
</style>
</head>

<body>

<div class="centernav">
    <form action="validate.php" method="get" name="centernav">
  <input type="text"  placeholder="Search.." class="searchbox">
  <button type="submit"><i class="fa fa-search"></i></button>
<div class="addnew">
    <a href="addissue.php" class="active">Add issue</a>
    <form action="addissue.php" method="post" name="Add issue">
</div>
  </div>
</body>
</html>
<?php
}
else
{
echo "<h3>Unauthorised Access<h3>";
}



?>
