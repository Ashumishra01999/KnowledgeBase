<?php

function newissue_sucess()
{
  echo '<p style="color:green;"><b>New Issue Created Successfully</b><p>';
}

function displayerror()
{
  echo '<p style="color:red;"><b>Unable to Add New Issue. Please Try Again.</b><p>';
}

function newissue_mailer($title, $description, $resolution)
{
  $from = "saurabhyadav9535@gmail.com";
  $to_emails = array("saurabhyadav338@gmail.com", "ashumishra01999@gmail.com", "yf.yousuf95@gmail.com");
  $subject = "New Issue Created";
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  // Create email headers
  $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
  $message = '<h2>A new issue has been created with the following details:</h2>';
  $message .= '<p><h3>Title</h3>'.$title.'</p>';
  $message .= '<p><h3>Description</h3>'.$description.'</p>';
  $message .= '<p><h3>Resolution</h3>'.$resolution.'</p>';
  $state = 1;
  foreach($to_emails as $to_email)
  {
    if(!mail($to_email, $subject, $message, $headers))
    {
      $state = 0;
    }
  }
  return $state;
}


?>
