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
$dbconnection = new dbconnector;
$dbconnection->connect();
$post = $dbconnection->getPost($_GET['post_id']);
$upvoted = $dbconnection->upvotestatus($_GET['post_id'], $_SESSION['user_id']);
if($upvoted)
{
  $buttonstatus = 'upvote-active';
  $buttontext = 'Upvoted';
}
else
{
  $buttonstatus = '';
  $buttontext = 'Upvote';
}

?>
<!Doctype html>
<html>
<head>
  <title><?php echo $post['title'].' - Knowledge Center'; ?></title>
  <link rel="stylesheet" href="css\style.css">
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <link rel="icon" type="image/png" href="images\favicon.png">
  <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
  <header>
    <div class="logo">
        <a href="dashboard.php" class="logo-link"><p>AIS Knowledge Base </p></a>
    </div>

    <!-- Nav Bar -->
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


  <!-- Display error if any -->

<main class="post-main">
    <div class="postcontainer">

      <?php
      if(isset($_SESSION['success']))
      {
        echo '<p class="successmessage">'.$_SESSION['success'].'</p>';
        unset($_SESSION['success']);
      }
        if($post['approved'] == 1 || $_SESSION['role_type'] == 'superadmin')
        {
      ?>

<!-- Display the selected issue -->
      <div class="post-details">
        <p class="author"><?php echo 'Author: '.htmlentities($post['name']).'('.htmlentities($post['username']).')';?></p>
        <p class="posttime"><?php echo 'Added on: '.date("F j, Y", strtotime($post['creation_time'])); ?></p>
      </div>
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
      <button type="button" class="upvote-button <?= $buttonstatus ?>" id="<?= $post['upvotes'].'_'.$_SESSION['user_id'] ?>"><i class="fa fa-thumbs-up" aria-hidden="true"></i><?= $buttontext.'('.$post['upvotes'].')' ?></button>
    </div>

<!-- Display admin dashboard, edit and approve button for superadmin account -->

<?php

// Check if user is a superadmin
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
<script>
$(".upvote-button").click(function(){
        var split_id = ($(this).attr('id')).split("_");
        var post_id = new RegExp('[\?&]' + 'post_id' + '=([^&#]*)').exec(window.location.href);
        post_id = post_id[1];
        var like_count = parseInt(split_id[0]);
        var user_id = split_id[1];
        if(!($(".upvote-button").hasClass("upvote-button upvote-active")))
        {
          $.ajax({
              url: 'upvote.php',
              type: 'post',
              data: {post_id:post_id,user_id:user_id,upvote:"1",likes:like_count},
              success: function(response){
                if(response == '1')
                {
                  $(".upvote-button").toggleClass("upvote-active", true);
                  like_count = like_count+1;
                  $(".upvote-button").prop('id', like_count+'_'+user_id);
                  $(".upvote-button").html('<i class="fa fa-thumbs-up" aria-hidden="true"></i>Upvoted('+like_count+')');
                }
              }

          });
        }
        else
        {
          $.ajax({
              url: 'upvote.php',
              type: 'post',
              data: {post_id:post_id,user_id:user_id,upvote:"0",likes:like_count},
              success: function(response){
                if(response == '1')
                {
                  $(".upvote-button").toggleClass("upvote-active", false);
                  like_count = like_count-1;
                  $(".upvote-button").prop('id', like_count+'_'+user_id);
                  $(".upvote-button").html('<i class="fa fa-thumbs-up" aria-hidden="true"></i>Upvote('+like_count+')');
                }
              }

          });
        }
    });
</script>
</body>
</html>
