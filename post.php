<?php
require_once('dbconnect.php');
session_start();

if(!isset($_SESSION['username']))
{
  die("<h3>Unauthorised Access<h3>");
}
else
{
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $post = $dbconnection->getPost($_GET['post_id']);
}
?>
<!Doctype html>
<html>
<head>
  <style>
  .wrapper {
    display: flex;
  }

  .wrapper>section {
    font-size: 4vh;
    color: black;
    margin: .1em;
    padding: .3em;
    border-radius: 3px;
    flex: 1;
  }
div.postcontainer{
  display: block;
  margin: 2% auto;
  margin-left:10%;
  border: 2px solid #3498db;
  padding: 14px 10px;
  width: 45%;
  outline: none;
  color: black;
  border-radius: 20px;
  }
  div.navbar{
    display: block;
    text-align:right;
    padding: 14px 10px;
    width: 100%;
    outline: none;
    color: black;
  }
  div.backbuttondiv {
    width: 5%;
    height: 4%;
  }
  input.backbutton{
    display: inline-block;
    margin: 20px auto;
    border: 2px solid #2ecc71;
    background: #2ecc71;
    padding: 14px 10px;
    width: 100%;
    outline: none;
    color: white;
    border-radius: 20px;
    cursor: pointer;

}
</style>
</head>
<body>
  <section class="wrapper">
  <div class="navbar">
    <?php
    echo "<h3>Logged in as user - {$_SESSION['username']}</h3>";
    echo '<a href="logout.php">Logout</a>';
    ?>
  </div>
  </section>
  <hr>
  <section class="wrapper">
    <div class="postcontainer">
    <p class="titlelabel"><b>Title</b></p>
    <p class="title"><?php echo $post['title']; ?></p>
    <p class="descriptionlabel"><b>Description</b></p>
    <p class="description"><?php echo $post['description']; ?></p>
    <p class="resolutionlabel"><b>Resolution</b></p>
    <p class="resolution"><?php echo $post['resolution']; ?></p>
  </div>
  <div class="backbuttondiv">
  <a href=<?php if(isset($_SERVER['HTTP_REFERER'])) { echo htmlspecialchars($_SERVER['HTTP_REFERER']); } else { echo htmlspecialchars($_SERVER["PHP_SELF"]."?post_id=".$_GET['post_id']); } ?>><input type="button" class="backbutton" value="Back" /></a>
</div>
  </section>








</body>
<footer>



</footer>
</html>
