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
      $query = $dblink->prepare("SELECT id, username FROM login_credentials WHERE username = ? AND password = ?");
      $query->bind_param("ss", $username, $password);
      $query->execute();
      return $query->get_result();
    }

    public function addIssue($title, $description, $resolution, $user_id)
    {
      global $dblink;
      $query = $dblink->prepare("INSERT INTO posts (title, description, resolution, user_id) values(?, ?, ?, ?)");
      $query->bind_param("sssi", $title, $description, $resolution, $user_id);
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
  }
 ?>
