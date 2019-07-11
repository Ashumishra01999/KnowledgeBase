<?php
// Start session, import database and util files and check for user login

session_start();
require_once('dbconnect.php');
require_once('util.php');

if(!isset($_SESSION['username']))
{
     if(!isset($_POST['auth_id']))
     {
       $_SESSION['error'] = 'noaccess';
       header("Location:login.php");
     }
}

$dbconnection = new dbconnector;
$dbconnection->connect();
// If all fields in form are set then edit post

if(isset($_POST['action']))
{
  if($_POST['action'] == 'update')
  {
    $dbconnection->updateUser($_POST['name'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['role'], $_POST['id']);
    $_SESSION['success'] = 'User Details Updated';
  }
  header( 'Location: superadmin.php' ) ;
}

// If get id is not set, redirect to superadmin panel

if(!isset($_GET['id']))
{
  $_SESSION['error'] = "Missing User ID";
  header('Location: superadmin.php');
}


// get the user details to edit

$user = $dbconnection->getUser($_GET['id']);

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Edit User</title>
        <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" href="images\favicon.png">
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
                                <input type="text" name="query" class="searchbox searchbox-nav" id="searchbox" placeholder="Search..." <?php if(isset($_GET['query'])) {echo 'value="'.$_GET['query'].'"';}?>>
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
      <main>
          <div class="container">
              <div class="loginpage-wrapper">
                  <div class="accountpanel registerpanel">
                    <div class="logintitle">
                        <p>Edit User</p>
                    </div>

                    <!-- Display error if any -->
                    <?php
                     if(isset($_SESSION['error']))
                     {
                       displayerror($_SESSION['error']);
                       unset($_SESSION['error']);
                     }
                     ?>
                      <form class="form-default" method="post" name="register">
                          <div class="form-group">
                              <label for="name">Name: </label>
                              <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $user['name'] ?>">
                          </div>
                          <div class="form-group">
                              <label for="username">Username: </label>
                              <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" value="<?= $user['username'] ?>">
                              <div id="status"></div>
                          </div>
                          <div class="form-group">
                              <label for="password">Password: </label>
                              <input type="text" name="password" class="form-control" id="password" placeholder="Enter New Password" value="<?= $user['password'] ?>">
                          </div>
                          <div class="form-group">
                              <label for="email">Email: </label>
                              <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="<?= $user['email'] ?>">
                          </div>
                          <div class="form-group">
                            <label for="role">Please Select a Role: </label>
                            <select name="role" id="role" class="form-control">
                              <option value="" hidden="true" disabled>Role</option>
                              <?php if($user['role_type'] == 'superadmin')
                              {
                                echo '<option value="superadmin" selected>Superadmin</option>';
                                echo '<option value="admin">Admin</option>';
                                echo '<option value="developer">Developer</option>';
                              }

                              elseif($user['role_type'] == 'developer')
                              {
                                echo '<option value="admin">Admin</option>';
                                echo '<option value="developer" selected>Developer</option>';
                              }

                              elseif($user['role_type'] == 'admin')
                              {
                                echo '<option value="admin" selected>Admin</option>';
                                echo '<option value="developer">Developer</option>';
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                              <input type="hidden" name="id" value="<?= $user['id'] ?>">
                              <button type="submit" name="action" value="update" class="btn btn-secondary btn-block">Update</button>

                          </div>
                      </form>
                      <a href="superadmin.php"><button name="action" value="cancel" class="btn btn-secondary btn-block">Cancel</button></a>
                  </div>
              </div>
          </div>
      </main>

<!-- jQuery for form validation -->

  <script>
        $(function() {
          // Initialize form validation on the registration form.
          // It has the name attribute "registration"
          $("form[name='register']").validate({
          // Specify validation rules
      rules: {
        name:
        {
          required: true,
          maxlength: 30
        },
        username: {
          required: true,
          minlength: 5,
          maxlength: 20
        },
        password: {
          required: true,
          minlength: 5,
          maxlength: 20
        },
        email: {
          required: true,
          email: true,
          maxlength: 40
        },
        role: {
          required: true
        }
      },
      // Specify validation error messages
      messages: {
        name: {
          required: "Please provide a name",
          maxlength: "The name must be less than 30 characters long"
        },
        username: {
          required: "Please provide a username",
          minlength: "The username must be at least 5 characters long",
          maxlength: "The username must be less than 20 characters long"
        },
        password: {
          required: "Please provide a password",
          minlength: "The password must be at least 5 characters long",
          maxlength: "The password must be less than 20 characters long"
        },
        email: {
          required: "Please provide an email address",
          email: "Please provide a valid email address",
          maxlenght: "The email address must be less than 40 characters long"
        },
        role: {
          required: "Please select an account role"
        }
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
  $(document).ready(function(){
    // check change event of the text field
    $("#username").keyup(function(){
      // get text username text field value
      var username = $("#username").val();

      // check username name only if length is greater than or equal to 3
      if(username.length >= 5 && username.length <= 20)
      {
        $("#status").html('Checking availability...');
        // check username
        $.post("username-check.php", {username: username}, function(data, status){
          $("#status").html(data);
        });
      }
      else
      {
        $("#status").html("");
      }
    });
  });
  </script>

    </body>
</html>
