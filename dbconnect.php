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
      $dblink = new mysqli("localhost","root","","kb_storage");//DATABASE CONNECTION
      if($dblink == false)
      {
        die("ERROR: Could not connect. " . mysqli_connect_error());//shows error on erroneous connection
      }
    }

    public function checkLogin($username, $password)//checks username and password from the table of the databse
    {
      global $dblink;
      $query = $dblink->prepare("SELECT id, username, name, role_type FROM login_credentials WHERE username = ? AND password = ?");
      $query->bind_param("ss", $username, $password);
      $query->execute();
      return $query->get_result();
    }

    public function addIssue($title, $description, $resolution, $user_id, $auth_id1, $auth_id2)//SQL in php for insertion of new data in posts table
    {
      global $dblink;
      $currenttime = time();
      $query = $dblink->prepare("INSERT INTO posts (title, description, resolution, user_id, auth_id1, auth_id2, creation_time, lastemail_time) values(?, ?, ?, ?, ?, ?, now(), $currenttime)");
      $query->bind_param("sssiii", $title, $description, $resolution, $user_id, $auth_id1, $auth_id2);
      return array($query->execute(), $dblink->insert_id);

    }

    public function search($query)//accessing posts table from kb databse to give search results
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
      $query = $dblink->prepare("SELECT post_id ,title, description, resolution, approved FROM posts WHERE post_id = ?");//showing of the local results after accessing results from the posts table
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

  public function approvepost($id, $is_superadmin){
  global $dblink;
  if($is_superadmin)
  {
    $query = $dblink->prepare("SELECT approved FROM posts WHERE post_id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    if($result->num_rows > 0)
    {
      $query = $dblink->prepare("UPDATE posts SET approved = 1 WHERE post_id = ?");
      $query->bind_param("i", $id);
      $query->execute();
      return 1;
    }
    else
    {
      return 0;
    }
  }
  else
  {
  $query = $dblink->prepare("SELECT post_id, auth_id1, auth_id2 FROM posts WHERE auth_id1 = ? OR auth_id2 = ?");
  $query->bind_param("ii", $id, $id);
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

  public function getallPosts()
  {
    global $dblink;
    $query = $dblink->prepare("SELECT login_credentials.name, post_id ,title, description, resolution, approved FROM posts INNER JOIN login_credentials ON posts.user_id=login_credentials.id");
    $query->execute();
    return ($query->get_result())->fetch_all(MYSQLI_ASSOC);
  }

  public function deletePost($post_id)
  {
    global $dblink;
    $query = $dblink->prepare("DELETE FROM posts WHERE post_id = ?");
    $query->bind_param("s", $post_id);
    $query->execute();
  }

  public function editPost($title, $description, $resolution, $post_id)
{
  global $dblink;
  $query = $dblink->prepare("UPDATE posts SET title = ?, description = ?, resolution = ? WHERE post_id = ?");
  $query->bind_param("ssss", $title,$description,$resolution,$post_id);
  $query->execute();
}

public function getUsers()
{
  global $dblink;
  $query = $dblink->prepare("SELECT id, name, username, role_type FROM login_credentials");
  $query->execute();
  return ($query->get_result())->fetch_all(MYSQLI_ASSOC);
}

}
