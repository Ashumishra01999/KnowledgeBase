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
      <p class="titlelabel"><b>Title</b></p>
      <p class="title"><?php echo htmlentities($post['title']); ?></p>
      <p class="descriptionlabel"><b>Description</b></p>
      <p class="description"><?php echo htmlentities($post['description']); ?></p>
      <p class="resolutionlabel"><b>Resolution</b></p>
      <p class="resolution"><?php echo htmlentities($post['resolution']); ?></p>
    </div>
  <div class="backbuttondiv">
  <a class="back-btn" href=<?php if(isset($_SERVER['HTTP_REFERER'])) { echo htmlspecialchars($_SERVER['HTTP_REFERER']); } else { echo htmlspecialchars($_SERVER["PHP_SELF"]."?post_id=".$_GET['post_id']); } ?>><button type="submit" class="nav-btn backbutton">Back</button></a>
</div>
</main>
</body>
</html>
