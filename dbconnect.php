<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

  class dbconnector
  {
    var $dblink;
    function connect()
    {
      global $dblink;
      $dblink = new mysqli("localhost","root","","kb_storage");
      if($dblink == false)
      {
        die("ERROR: Could not connect. " . mysqli_connect_error());
      }
    }

    public function chechLogin($username, $password)
    {
      global $dblink;
      $query = $dblink->prepare("SELECT id, username FROM login_credentials WHERE username = ? AND password = ?");
      $query->bind_param("ss", $username, $password);
      $query->execute();
      return $query->get_result();
    }
    public function addIssue($title, $description, $resolution, $user_id)
    {
      global $dblink;
      $query = $dblink->prepare("INSERT INTO posts (title, description, resolution, user_id) values("?", "?", "?", "?")");
      $query->bind_param("sssi", $title, $description, $resolution, $user_id);
      $query->execute();
    }
  }
 ?>
