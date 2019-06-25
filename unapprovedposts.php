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
$post = $dbconnection->getallunapproved();
$num_matches = count($post);
?>
<!Doctype html>
<html>
<?php
 // echo $_SESSION['error'];
 // unset($_SESSION['error']);
 ?>
<head>
  <!-- <title><?php echo $post['title'].' - Knowledge Center'; ?></title> -->
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
  <form method = "GET" action='delete.php'>
<?php
echo('<table border="1">'."\n");
echo("<tr>");
echo("<th>Name</th>");
echo("<th>Headline</th>");
echo("<th>Action</th>");
echo("</tr>");
for($i = 0 ; $i < $num_matches ; $i++){
 $row = $post[$i];
  echo "<tr><td>";
  echo htmlentities($row['title']);
  echo("</td><td>");
  echo(htmlentities($row['description']));
  echo("</td><td>");
  echo('<a href="editpost.php?post_id='.$row['post_id'].'">Edit</a>');
  echo '|';
  echo('<a href="delete.php?post_id='.$row['post_id'].'">Delete</a>');
  echo("</td></tr>\n");
}
?>
</table>
</form>
</main>
</body>
</html>
