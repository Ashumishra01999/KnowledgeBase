<?php
require_once("dbconnect.php");
require_once("util.php");
$dbconnection = new dbconnector;
$dbconnection->connect();
$result = $dbconnection->getallunapproved();
$num_matches = count($result);

$currenttime = time();
// echo $currenttime;

for( $i = 0 ; $i < $num_matches ; $i++){
  $row = $result[$i];
  if( $row['auth_id1'] != 0  || $row['auth_id2'] != 0)
  {
  if(1){
      echo newissue_mailer($row['title'], $row['description'], $row['resolution'], array($row['auth_id1'],$row['auth_id2']));
    }
  }

  // if($row['auth_id2'] != 0])
  // {
  //   if($currenttime - $row['lastemail_time'] >= 432000){
  //     newissue_mailer($row['title'], $row['description'], $row['resolution'], $row['auth_id2']);
  //   }
  }








// if($currenttime - $timestamp >= 432000){}
// if( $row[auth_id1] != NULL)
// {
// newissue_mailer($row['title'], $row['description'], $row['resolution'], $row['auth_id1']);
// }
// elseif ($row[auth_id2] != NULL) {
//   newissue_mailer($row['title'], $row['description'], $row['resolution'], $row['auth_id2']);
// }
// else{
//   die();
// }
// }

// $currentdate = date('d-m-Y');
// echo $currentdate;
// echo "<br>";
// $currenttime = time();
// echo $currenttime;
 ?>
