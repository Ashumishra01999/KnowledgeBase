<?php
require_once("dbconnect.php");
if isset($_GET['auth_id']){
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $result = $dbconnection->approvepost($_GET['auth_id', 1]);
  $rows = $result->fetch_array(MYSQLI_ASSOC);
}
else{
  echo "Post unavailable or already approved";
  }
