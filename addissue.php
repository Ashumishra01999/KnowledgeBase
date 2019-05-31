<html>
    <head>
      <?php
      session_start();
      ?>
        <title>Register - Knowledge Center</title>
        <style>
        div.registrationForm {
          margin: auto;
          width: 55%;
          padding: 12%;
          text-align: center;

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
        </style>

    </head>
    <body>
      <?php
      echo $_SESSION['username'];
      echo $_SESSION['user_id'];
      ?>
      <div class="registrationForm">
        <form action="submitissue.php" method="post">
          <table style="height:50%">
            <tr>
              <th  colspan="2">Add New Issue</th>
            </tr>
            <tr>
              <td><label for="tit">Title: </label></td>
              <td><textarea rows="2" cols = "100" name="title" placeholder="Enter Title of the Issue" id="title"></textarea></td>
            </tr>
            <tr>
            <td><label for="des">Description: </label></td>
            <td><textarea rows="5" cols = "100" name="description" placeholder="Enter Description of the Issue" id="description"></textarea></td>
          </tr>
          <tr>
            <td><label for="res">Resolution: </label></td>
            <td><textarea rows="5" cols = "100" name="resolution" placeholder="Enter Resolution for the Issue" id="resolution"></textarea></td>
          </tr>

          <tr>
            <td class="button"  colspan="2"><input type="submit" value="Submit" style:></td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
