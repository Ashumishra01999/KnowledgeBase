<html>
    <head>
        <title>Login - Knowledge Center</title>
        <style>
        div.loginForm {
          margin: auto;
          width: 20%;
          padding: 10%;
          border: 2px dotted blue
        }
        h1 {
          align: center;
        }
        </style>
        <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

    </head>
    <body>
      <div class="loginForm">
        <h1>Login</h1>
        <form action="validate.php" method="post" name="login">
        <p>
          <label for="username">Username: </label>
          <input type="text" name="username" placeholder="Enter Username" id="username">
                                                                                                                                <p>
          <label for="password">Password: </label>
          <input type="password" name="password" placeholder="Enter Password" id="password"><br>
        </p>
        <p>
          <input type="submit" value="Login">
        </p>
      </div>
      </form>

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
          minlength: "Your username must be at least 5 characters long",
          maxlength: "Your username must be less than 20 characters long"
        },
        password: {
          required: "Please provide a password",
          minlength: "Your password must be at least 5 characters long",
          maxlength: "Your password must be less than 20 characters long"
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
