<html>
    <head>
        <title>Register - Knowledge Center</title>
        <style>
        div.registerForm {
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
      <div class="registrationForm">
        <h1>Register</h1>
        <form action="validate.php" method="post">
        <p>
          <label for="username">Username: </label>
          <input type="text" name="username" placeholder="Enter Username" id="username">
        </p>
        <p>
          <label for="email_id">Email_Id:</label>
          <input type="text" name="Email_Id" placeholder="Enter Email_Id" id="Email_Id">
        </p>
        <p>
          <label for="password">Password: </label>
          <input type="password" name="password" placeholder="Enter Password" id="password"><br>
        </p>
        <input type="submit" value="Login">
      <div>
</form>
    </body>
</html>
