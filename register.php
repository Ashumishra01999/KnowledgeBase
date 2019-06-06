<html>
    <head>
        <title>Register - Knowledge Center</title>
        <!-- <style>
        div.registrationForm {
          margin: auto;
          width: 20%;
          padding: 10%;
        }
        h1 {
          align: center;
        }
        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        td.button {
          text-align: center;
        }
        </style> -->
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
      <?php
      if(isset($_POST['submit']))
      {

      }
      ?>
      <div class="registrationForm">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <table>
            <tr>
              <th  colspan="2">Register</th>
            </tr>
            <tr>
              <td><label for="name">Name: </label></td>
              <td><input type="text" name="name" placeholder="Enter Name" id="name"></td>
            </tr>
            <tr>
            <td><label for="username">Enter Username: </label></td>
            <td><input type="text" name="username" placeholder="Enter Username" id="username"></td>
          </tr>
          <tr>
            <td><label for="email">Email address:</label></td>
            <td><input type="email" name="email" placeholder="Enter Email Address" id="email"></td>
          </tr>
          <tr>
            <td><label for="password">Password: </label></td>
            <td><input type="password" name="password" placeholder="Enter Password" id="password"><br></td>
          </tr>
          <tr>
            <td class="button"  colspan="2"><input type="submit" value="Register" style:></td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
