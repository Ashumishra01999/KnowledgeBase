<?php
require_once('util.php');
session_start();
if(isset($_SESSION['username']))
{
  header("Location:dashboard.php");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Login - Knowledge Center</title>
        <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" href="images\favicon.png">
    </head>
    <body>
      <div class="container-fluid">
        <nav>
        </nav>
      </div>
      <main class="login-main">
          <div class="container">
              <div class="loginpage-wrapper">
                  <div class="accountpanel">
                    <div class="logintitle">
                        <p >AIS Knowledge Base </p>
                    </div>

                    <!-- Display error if any -->
                    <?php
                     if(isset($_SESSION['error']))
                     {
                       if($_SESSION['error']=='login')
                       {
                         displayerror('','login');
                         unset($_SESSION['error']);
                       }
                       elseif($_SESSION['error']=='noaccess')
                       {
                         displayerror('','noaccess');
                         unset($_SESSION['error']);
                       }
                     }
                    // User login form

                    ?>
                      <form class="form-default" action="validate.php" method="post" name="login">
                          <div class="form-group">
                              <label for="username">Username: </label>
                              <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
                          </div>
                          <div class="form-group">
                              <label for="password">Password: </label>
                              <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-secondary btn-block">Log in</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </main>

<!-- jQuery for form validation -->

  <script>
        $(function() {
          // Initialize form validation on the registration form.
          // It has the name attribute "registration"
          $("form[name='login']").validate({
          // Specify validation rules
      rules: {
        username: {
          required: true,
          minlength: 5,
          maxlength: 20
        },
        password: {
          required: true,
          minlength: 5,
          maxlength: 20
        }
      },
      // Specify validation error messages
      messages: {
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
