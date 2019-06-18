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

    public function addIssue($title, $description, $resolution, $user_id, $UID1, $UID2)
    {
      global $dblink;
      $query = $dblink->prepare("INSERT INTO unapproved (title, description, resolution, user_id, UniqueID1, UniqueID2, flag) values(?, ?, ?, ?, ?, ?, 3)");
      $query->bind_param("sssiii", $title, $description, $resolution, $user_id, $UID1, $UID2);
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
    $query = $dblink->prepare("SELECT post_id, title, description, resolution FROM unapproved WHERE UniqueID1 = ? OR UniqueID2 = ?");
    $query->bind_param("ss", $auth_id, $auth_id);
    $query->execute();
    return ($query->get_result());
  }

  public function approvepost($auth_id, $mode){
  global $dblink;
  $query = $dblink->prepare("SELECT post_id, title, description, resolution, flag FROM unapproved WHERE UniqueID1 = ? OR UniqueID2 = ?");
  $query->bind_param("ss", $auth_id, $auth_id);
  $query->execute();
  $result = $query->get_result());
  if($result->num_rows > 0)
  {
    if($row['UniqueID1'] == $auth_id)
    {
      $target = 'UniqueID1';
    }
    else
    {
      $target = 'UniqueID2';
    }
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $query = $dblink->prepare("UPDATE unapproved SET flag = ?, ? = ? WHERE UniqueID1 = ? OR UniqueID2 = ?");
    $query->bind_param("issss", $row['flag']-1, $target, '', $auth_id, $auth_id);
    if($row['flag']-1 == 1)
    {
      $query = $dblink->prepare("INSERT INTO posts (title, description, resolution, user_id) values(?, ?, ?, ?)");
      $query->bind_param("sssi", $row['title'], $row['description'], $row['resolution'], $row['user_id']);
      if($query->execute())
      {
        $query = $dblink->prepare("DELETE FROM unapproved WHERE post_id = ?");
        $query->bind_param("s", $row['post_id']);
        if($query->execute())
        {
          return 1;
        }
      }
    }
  }
  else
  {
    return 0;
  }
}
