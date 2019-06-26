<?php
require_once('issueAlert.php');
function newissue_sucess()
{
  echo '<div style="color:green;"><b>New Issue Created Successfully</b><div>';
}

function displayerror($message, $source = 'undefined')
{
  if($source == 'addissue')
  {
    echo '<div style="color:red;"><b>Unable to Add New Issue. Please Try Again.</b><div>';
  }
  elseif($source == 'login')
  {
    echo '<div style="color:red;"><b>Incorrect Username/Password.</b><div>';
  }
  elseif($source == 'noaccess')
  {
    echo '<div style="color:red;"><b>Please Login First.</b><div>';
  }
  else
  {
    echo '<div style="color:red;"><b>'.$message.'</b><div>';
  }
}

function newissue_mailer($title, $description, $resolution, $auth_id, $isReminder = false)
{
  $from = "saurabhyadav9535@gmail.com";
  $to_emails = array("saurabhyadav338@gmail.com","yf.yousuf95@gmail.com");
  if($isReminder)
  {
    $subject = "Issue Approval Reminder";
  }
  else
  {
    $subject = "New Issue Created";
  }
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  // Create email headers
  $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
  $state = 1;
  foreach($to_emails as $index => $to_email)
  {
    if($auth_id[$index] != 0)
    {
      $message = generateEmail($title, $description, $resolution, $auth_id[$index], $isReminder);
      if(!mail($to_email, $subject, $message, $headers))
      {
        $state = 0;
      }
    }
  }
  return $state;
}
?>
