<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

    public function checkLogin($username, $password)
    {
      global $dblink;
      $query = $dblink->prepare("SELECT id, username, name FROM login_credentials WHERE username = ? AND password = ?");
      $query->bind_param("ss", $username, $password);
      $query->execute();
      return $query->get_result();
    }

    public function addIssue($title, $description, $resolution, $user_id, $auth_id1, $auth_id2)
    {
      global $dblink;
      $currenttime = time();
      $query = $dblink->prepare("INSERT INTO posts (title, description, resolution, user_id, auth_id1, auth_id2, creation_time, lastemail_time) values(?, ?, ?, ?, ?, ?, now(), $currenttime)");
      $query->bind_param("sssiii", $title, $description, $resolution, $user_id, $auth_id1, $auth_id2);
      return array($query->execute(), $dblink->insert_id);

    }

    public function search($query)
    {
      global $dblink;
      $keyword = explode(" ", $query);
      $query ="SELECT post_id, title, description FROM posts WHERE title like '%" . $keyword[0] . "%'";

     for($i = 1; $i < count($keyword); $i++)
     {
        if(!empty($keyword[$i]))
        {
            $query .= " AND title like '%" . $keyword[$i] . "%'";
        }
      }
      $query .= 'AND approved = 1';
      $result = $dblink->query($query);
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPost($post_id)
    {
      global $dblink;
      $query = $dblink->prepare("SELECT title, description, resolution FROM posts WHERE post_id = ?");
      $query->bind_param("s", $post_id);
      $query->execute();
      return ($query->get_result())->fetch_array(MYSQLI_ASSOC);
    }

    public function getunapproved($auth_id){
    global $dblink;
    $query = $dblink->prepare("SELECT post_id, title, description, resolution FROM posts WHERE auth_id1 = ? OR auth_id2 = ?");
    $query->bind_param("ss", $auth_id, $auth_id);
    $query->execute();
    return ($query->get_result());
  }

  public function getallunapproved(){
  global $dblink;
  $query = $dblink->prepare("SELECT post_id, title, description, resolution, auth_id1, auth_id2, lastemail_time FROM posts");
  $query->execute();
  return ($query->get_result())->fetch_all(MYSQLI_ASSOC);
}

  public function approvepost($auth_id){
  global $dblink;
  $query = $dblink->prepare("SELECT post_id, title, description, resolution, auth_id1, auth_id2 FROM posts WHERE auth_id1 = ? OR auth_id2 = ?");
  $query->bind_param("ss", $auth_id, $auth_id);
  $query->execute();
  $result = $query->get_result();
  if($result->num_rows > 0)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if($row['auth_id1'] == $auth_id)
    {
      $target = 'auth_id1';
      $other_authid = 'auth_id2';
    }
    else
    {
      $target = 'auth_id2';
      $other_authid = 'auth_id1';
    }
    $query = $dblink->prepare("UPDATE posts SET $target = 0 WHERE auth_id1 = ? OR auth_id2 = ?");
    $query->bind_param("ss", $auth_id, $auth_id);
    $query->execute();
    if($row[$other_authid] == 0)
    {
      $query = $dblink->prepare("UPDATE posts SET approved = 1 WHERE post_id = ".$row['post_id']);
      $query->execute();
    }
    return 1;
  }
  else
  {
    return 0;
  }
  }
}
