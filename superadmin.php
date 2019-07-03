<?php

// Start session, import database and util files and check for user login

session_start();
require_once('dbconnect.php');
require_once('util.php');

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
if($_SESSION['role_type'] != 'superadmin')
{
  echo "<strong>Unauthorised Access</strong>";
  die();
}

// Get all posts and users from databse

$dbconnection = new dbconnector;
$dbconnection->connect();
$allposts = $dbconnection->getallPosts();
$userlist = $dbconnection->getUsers();
?>
<!Doctype html>
<html>
<head>
  <title>Super-Admin Dashboard - Knowledge Center</title>
  <link rel="stylesheet" href="css\style.css">
  <link rel="icon" type="image/png" href="images/favicon.png">
  <script src="js/javascript.js"></script>
</head>
<body>
  <header>
    <div class="logo">
        <a href="dashboard.php" class="logo-link"><p>AIS Knowledge Base </p></a>
    </div>

    <!-- Nav bar -->
            <nav class="searchres-bar">
                <ul class="nav-list">
                  <li>
                    <form class="searchform searchform-nav" action="search.php" method="get">
                        <div class="form-group">
                            <input type="text" name="query" class="searchbox searchbox-nav" id="username" placeholder="Search..." <?php if(isset($_GET['query'])) {echo 'value="'.$_GET['query'].'"';}?>>
                            <button type="submit" class="btn btn-secondary searchbtn searchbtn-nav">Search</button>
                        </div>
                    </form>
                  </li>
                    <li><a class = "nav-darklnk" href="addissue.php"><button type="submit" class="nav-btn">Add Issue</button></a></li>
                    <li>
                      <div class="dropdown">
                        <button type="submit" class="nav-btn"><?php echo $_SESSION['name']; ?></button>
                        <div class="dropdown-content">
                        <a href="logout.php">Logout</a>
                        </div>
                      </div>
                    </li>
                </ul>
            </nav>
  </header>

<!-- Tabs for unapproved, approved and users -->

  <main class="dash-main">
    <div class="dash-container">
      <ul class="tabs">

<!-- Approved posts tab -->

        <li class="tab">
          <input type="radio" name="tabs" checked="checked" id="tab1" />
          <label for="tab1">Approved Posts</label>
          <div id="tab-content1" class="content">
              <?php
              if(isset($_SESSION['success']))
              {
                // if($_SESSION['success'] == 'RecordDeleted')
                  echo '<div class = message><b>'.$_SESSION['success'].'</b><div>';
                  unset($_SESSION['success']);
                }
              ?>
              <table class="postlist">
                <tr>
                  <th class="text-center">User</th>
                  <th class="text=center">Date</th>
                  <th class="text-center">Issue Title</th>
                  <th class="text-center">Description</th>
                  <th class="text-center">Action</th>
                </tr>
                <?php
                $found = 0;
                foreach($allposts as $post){
                  if($post['approved'] == 1)
                  {
                    $found++;
                    echo "<tr><td class='text-left'>";
                    echo htmlentities($post['name']);
                    echo "</td><td class='text-left'>";
                    echo (htmlentities (date('d-m-Y', strtotime($post['creation_time']))));
                    echo ("</td><td class='text-left'>");
                    echo (htmlentities($post['title']));
                    echo ("</td><td class='text-left'>");
                    echo (htmlentities($post['description']));
                    echo ("</td><td class='text-left'>");
                    ?>
                    <label class="dropdown">
                        <div class="dd-button">
                          Action
                        </div>
                        <ul class="dd-menu">
                          <li><?php echo('<a href="post.php?post_id='.$post['post_id'].'">View</a>'); ?> </li>
                          <li><?php echo('<a href="editpost.php?post_id='.$post['post_id'].'">Edit</a>'); ?> </li>
                          <li><?php echo('<a href="delete.php?post_id='.$post['post_id'].'">Delete</a>'); ?> </li>

                        </ul>
                      </label>
                    <?php
                    echo("</td></tr>\n");
                  }
                }
                if(!$found)
                {
                  echo "<tr><td class='text-center' colspan='4'>No Issues Found</td></tr>";
                }
                ?>
              </table>
          </div>
        </li>

<!-- Unapproved posts tab -->

        <li class="tab">
          <input type="radio" name="tabs" id="tab2" />
          <label for="tab2">Unapproved Posts</label>
          <div id="tab-content2" class="content">
              <table class="postlist">
                <tr>
                  <th class="text-center">User</th>
                  <th class="text-center">Date</th>
                  <th class="text-center">Issue Title</th>
                  <th class="text-center">Description</th>
                  <th class="text-center">Action</th>
                </tr>
                <?php
                $found = 0;
                foreach($allposts as $post){
                  if($post['approved'] == 0)
                  {
                    $found++;
                    echo "<tr><td class='text-left'>";
                    echo htmlentities($post['name']);
                    echo "</td><td class='text-left'>";
                    echo (htmlentities (date('d-m-Y', strtotime($post['creation_time']))));
                    echo("</td><td class='text-left'>");
                    echo(htmlentities($post['title']));
                    echo("</td><td class='text-left'>");
                    echo(htmlentities($post['description']));
                    echo("</td><td class='text-left'>");
                    ?>
                    <label class="dropdown">
                        <div class="dd-button">
                          Action
                        </div>
                        <ul class="dd-menu">
                          <li><?php echo('<a href="post.php?post_id='.$post['post_id'].'">Review</a>'); ?> </li>
                          <li><?php echo('<a href="editpost.php?post_id='.$post['post_id'].'">Edit</a>'); ?> </li>
                          <li><?php echo('<a href="delete.php?post_id='.$post['post_id'].'">Delete</a>'); ?> </li>

                        </ul>
                      </label>
                    <?php
                    echo("</td></tr>\n");
                  }
                }
                if(!$found)
                {
                  echo "<tr><td class='text-center' colspan='4'>No Issues Found</td></tr>";
                }
                ?>
              </table>
          </div>
        </li>

<!-- User management tab -->

        <li class="tab">
          <input type="radio" name="tabs" id="tab3" />
          <label for="tab3">User Management</label>
          <div id="tab-content3" class="content">
            <div class="table-link">
              <a class="nav-darklnk" href="register.php"><button type="submit" class="nav-btn">Add New User</button></a>
              <a class="nav-darklnk" href="#"><button type="submit" class="nav-btn">Delete User</button></a>
              <a class="nav-darklnk" href="#"><button type="submit" class="nav-btn">Edit User</button></a>
            </div>
              <table class="postlist">
                <tr>
                  <th class="text-center">User ID</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">Role</th>
                </tr>
                <?php
                $found = 0;
                foreach($userlist as $user){
                  if($post['approved'] == 0)
                  {
                    $found++;
                    echo "<tr><td class='text-left'>";
                    echo htmlentities($user['id']);
                    echo "</td><td class='text-left'>";
                    echo htmlentities($user['name']);
                    echo("</td><td class='text-left'>");
                    echo(htmlentities($user['username']));
                    echo("</td><td class='text-left'>");
                    echo(htmlentities($user['role_type']));
                    echo("</td></tr>");
                  }
                }
                if(!$found)
                {
                  echo "<tr><td class='text-center' colspan='3'>No Issues Found</td></tr>";
                }
                ?>
              </table>
          </div>
        </li>

      </ul>
    </div>
  </main>
