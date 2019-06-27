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

// If all fields in form are set then edit post

if( isset($_POST['title']) && isset($_POST['description']) && isset($_POST['resolution']) && isset($_POST['post_id']))
{
  $dbconnection = new dbconnector;
  $dbconnection->connect();
  $dbconnection->editPost($_POST['title'], $_POST['description'], $_POST['resolution'],$_POST['post_id']);
  $_SESSION['success'] = 'Record Updated';
  header( 'Location: superadmin.php' ) ;
}

// If get id is not set, redirect to superadmin panel

if(! isset($_GET['post_id']))
{
  $_SESSION['error'] = "Missing Post ID";
  header('Location: superadmin.php');
}


// get the post to edit

$dbconnection = new dbconnector;
$dbconnection->connect();
$post = $dbconnection->getPost($_GET['post_id']);

$title = $post['title'];
$description = $post['description'];
$resolution = $post['resolution'];
$post_id = $post['post_id'];



?>
<!doctype html>
<html lang="en">
<head>
        <title>Edit Issue - Knowledge Center</title>
        <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="css\style.css">
        <link rel="icon" type="image/png" href="images\favicon.png">
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
                                <button type="submit" class="btn btn-secondary searchbtn searchbtn-nav">Search</button><!--search box and button field for accessing databse at the same time-->
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

<main>


  <div class="addnew-main">

<!-- Display error if any -->

    <?php
     if(isset($_SESSION['error']))
     {
       if($_SESSION['error']=='add_issue_failed')
       {
         displayerror('addissue');
         unset($_SESSION['error']);
       }
       if($_SESSION['error']=='noerror')
       {
         echo '<p style="color:green;"><b>Issue has been Submitted Successfully for Moderation.</b><p>';
         unset($_SESSION['error']);
       }
     }
    ?>

  <!-- Display issue to edit   -->

  <form class="form-default form-create-topic"  method="post" name="editissue">
          <div class="form-group">
              <label for="title">Topic Title</label>
                  <input type="text" name="title" value="<?= $title ?>"class="form-control issue-title" id="title" placeholder="Title of your Issue">

          </div>
          <div class="form-group">
              <label for="description">Description</label>
                  <textarea name="description" class="form-control form-textarea" rows="5" cols="100" placeholder="Please Describe the Issue"><?= $description ?></textarea>
          </div>
          <div class="form-group">
              <label for="resolution">Resolution</label>
                  <textarea name="resolution" class="form-control form-textarea" rows="5" cols="100" placeholder="Resolution for the Described Issue"><?= $resolution ?></textarea>

          </div>
          <input type="hidden" name="post_id" value="<?= $post_id ?>">
          <button type="submit"class="btn btn-secondary" >Submit</button>
      </form>

<!-- Javascript for form validation -->

<script>
    $(function() {
      // Initialize form validation on the registration form.
      // It has the name attribute "registration"
      $("form[name='addissue']").validate({
      // Specify validation rules
  rules: {
    title: {
      required: true,
      minlength: 10,
      maxlength: 250
    },
    description: {
      required: true,
      minlength: 10
    },
    resolution: {
      required: true,
      minlength: 10
    }
  },
  // Specify validation error messages
  messages: {
    title: {
      required: "<br>Please provide a title",
      minlength: "<br>The title must be at least 10 characters long",
      maxlength: "<br>The title must be less than 250 characters long"
    },
    description: {
      required: "<br>Please provide a description",
      minlength: "<br>The description must be at least 10 characters long"
    },
    resolution: {
      required: "<br>Please provide a resolution",
      minlength: "<br>The resolution must be at least 10 characters long"
    },
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
    form.submit();
  }
});
});
</script>
</body>
</html>
