<?php
session_start();

if(isset($_SESSION['username']))
{
  header("Location:dashboard.php");
}
?>
<!doctype html>
<html>
    <head>
        <title>Login - Knowledge Center</title>
        <!-- <style>
        .loginForm {
          margin: auto;
          width: 20%;
          padding: 10%;
        }
        .loginform h1 {
          align: center;
        }
        </style> -->
        <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="style.css">

    </head>
    <body class="bg-light" >
      <section id="login-form">
      <div class="container">
        <h1><span class="text-primary">Login</span></h1>
        <form action="validate.php" method="post" name="login">
        <div class="form-group">
          <label for="username">Username: </label>
          <input type="text" name="username" placeholder="Enter Username" id="username">
        </div>
        <div class="form-group">
          <label for="password">Password: </label>
          <input type="password" name="password" placeholder="Enter Password" id="password"><br>
        </div>                                                                                                                    <p>
        </p>
        <p>
          <button type="submit" class="btn">Login</button>
        </p>
      </form>
      </div>
    </section>

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
          required: "<br>Please provide a username",
          minlength: "<br>Your username must be at least 5 characters long",
          maxlength: "<br>Your username must be less than 20 characters long"
        },
        password: {
          required: "<br>Please provide a password",
          minlength: "<br>Your password must be at least 5 characters long",
          maxlength: "<br>Your password must be less than 20 characters long"
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
