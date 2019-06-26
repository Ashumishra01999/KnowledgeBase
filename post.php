<?php
session_start();
require_once('dbconnect.php');
require_once('util.php');

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
$dbconnection = new dbconnector;
$dbconnection->connect();
$post = $dbconnection->getPost($_GET['post_id']);

?>
<!Doctype html>
<html>
<head>
  <title><?php echo $post['title'].' - Knowledge Center'; ?></title>
  <link rel="stylesheet" href="css\style.css">
  <link rel="icon" type="image/png" href="images\favicon.png">
</head>
<body>
  <header>
    <div class="logo">
        <a href="dashboard.php" class="logo-link"><p>AIS Knowledge Base </p></a>
    </div>
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
                    <li><a class = "nav-darklnk" href="addissue.php"><button type="submit" class="nav-btn">Add Issue</a></li>
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


<main class="post-main">
    <div class="postcontainer">

      <?php
      if(isset($_SESSION['approved']) && $_SESSION['approved'] == true)
      {
        echo '<p class="success">Issue approved successfully.</p>';
        unset($_SESSION['approved']);
      }
        if($post['approved'] == 1 || $_SESSION['role_type'] == 'superadmin')
        {
      ?>
      <p class="titlelabel"><b>Title</b></p>
      <p class="title"><?php echo htmlentities($post['title']); ?></p>
      <p class="descriptionlabel"><b>Description</b></p>
      <p class="description"><?php echo htmlentities($post['description']); ?></p>
      <p class="resolutionlabel"><b>Resolution</b></p>
      <p class="resolution"><?php echo htmlentities($post['resolution']); ?></p>
      <?php
        }
        else
        {
          displayerror('Unauthorised Access');
        }
      ?>
    </div>
<?php
  if(isset($_SERVER['HTTP_REFERER']))
  {
    $backlink = htmlspecialchars($_SERVER['HTTP_REFERER']);
  }
  else
  {
    $backlink = htmlspecialchars($_SERVER["PHP_SELF"]."?post_id=".$_GET['post_id']);
  }
  if($_SESSION['role_type'] == 'superadmin')
  {
    echo '<div class="postpanel">
          <a class="btn2link" href="superadmin.php" ><button type="submit" class="nav-btn btn2">Admin Dashboard</button></a>';
    echo '<a class="btn2link" href='.$backlink.'><button type="submit" class="nav-btn btn2">Back</button></a>';
    if($post['approved'] == 0)
    {
      echo '<form action="approve.php" method="post">
            <input type="hidden" name="post_id" value="'.htmlentities($_GET['post_id']).'">
            <button type="submit" class="nav-btn btn2">Approve</button>
            </form>';
    }
    echo '<a class="btn2link" href="editpost.php?post_id='.$post['post_id'].'"><button type="submit" class="nav-btn btn2 btn2">Edit</button></a>';
  }
  else
  {
    if(isset($_SERVER['HTTP_REFERER']))
    {
      $backlink = htmlspecialchars($_SERVER['HTTP_REFERER']);
    }
    else
    {
      $backlink = htmlspecialchars($_SERVER["PHP_SELF"]."?post_id=".$_GET['post_id']);
    }
    echo '<div class="postpanel">
          <a class="btn2link" href='.$backlink.'><button type="submit" class="nav-btn btn2">Back</button></a>';
  }
?>
</div>
</main>
</body>
</html>
