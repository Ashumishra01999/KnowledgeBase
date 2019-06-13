
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

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="style.css">
<!--
<style>
.searchcontainer {
  overflow: hidden;
  font-size: 20%;
  text-align: center;
  margin-top: 15%;
  padding: 6px;
}
.searchcontainer input[type=text] {

  font-size: 50px;
  background-color: rgba(0, 0, 0, 0.1);
  border: 2px solid #FFFF

}
.searchcontainer button {
  float: none;
  padding: 6px;
  background: #2196F3;
  color: white;
  border-left: none; /* Pevent double borders */
  cursor: pointer;
}
.searchcontainer button[type=submit] {

  font-size: 48px;
  background-color: rgba(0, 0, 0, 0.1);
  border: 2px solid #FFFF

}
.searchcontainer button:hover {
  background: #0b7dda;
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
</style> -->
</head>

<body>

<div class="container">
    <form action="search.php" method="get" name="searchform" class="searchform">
  <input type="text"  placeholder="Search.." class="searchbox" name="query">
  <input type="submit" name="submitButton" class="submitButton" value="Search">
</div>
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
