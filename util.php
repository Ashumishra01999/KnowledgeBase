<?php
require_once('newissueEmail.php');
function newissue_sucess()
{
  echo '<p style="color:green;"><b>New Issue Created Successfully</b><p>';
}

function displayerror($source)
{
  if($source == 'addissue')
  {
    echo '<p style="color:red;"><b>Unable to Add New Issue. Please Try Again.</b><p>';
  }
  elseif($source == 'login')
  {
    echo '<p style="color:red;"><b>Incorrect Username/Password.</b><p>';
  }
  elseif($source == 'noaccess')
  {
    echo '<p style="color:red;"><b>Please Login First.</b><p>';
  }
}

function newissue_mailer($title, $description, $resolution, $auth_id)
{
  $from = "saurabhyadav9535@gmail.com";
  $to_emails = array("saurabhyadav338@gmail.com","yf.yousuf95@gmail.com");
  $subject = "New Issue Created";
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
      $message = generateEmail($title, $description, $resolution, $auth_id[$index]);
      if(!mail($to_email, $subject, $message, $headers))
      {
        $state = 0;
      }
    }
  }
  return $state;
}
?>
