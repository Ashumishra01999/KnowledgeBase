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

    </head>
    <body>
      <div class="loginForm">
        <h1>Login</h1>
        <form action="validate.php" method="post">
        <p>
          <label for="username">Username: </label>
          <input type="text" name="username" placeholder="Enter Username" id="username">
        </p>
        <p>
          <label for="password">Password: </label>
          <input type="password" name="password" placeholder="Enter Password" id="password"><br>
        </p>
        <input type="submit" value="Login">
      <div>
</form>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
   $(document).ready(function() {
      $("#form").validate();
   });
   jQuery(document).ready(function() {
   jQuery("#forms).validate({
      rules: {
         username: {
            required: true,
            maxlength: 20,
             },
        password: {
          required: true,
          minlength: 5,
          maxlength: 20,
        }
      }
    });
});
</script>
    </body>
</html>
