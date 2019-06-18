<?php
require_once("dbconnect.php");
if(isset($_POST['auth_id']))
{
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $status = $dbconnection->approvepost($_POST['auth_id'], 1);
  if($status == 1)
  {
    echo 'Issue Approved Successfully';
  }
  else
  {
    echo '1Post unavailable or already approved';
  }
}
else{
  echo "2Post unavailable or already approved";
  }
