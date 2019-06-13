<html>
    <head>
      <?php
      session_start();
      if(!isset($_SESSION['username']))
      {
        die("<h3>Unauthorised Access<h3>");
      }
      ?>
        <title>Add Issue - Knowledge Center</title>
        <!-- <style>
        .isssueForm {
          margin: auto;
          width: 55%;
          padding: 12%;
          text-align: center;

        }
        .isssueForm h1 {
          align: center;
        }
        .isssueForm table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        .isssueForm td .button {
          text-align: center;
        }
        </style> -->
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <?php
      echo $_SESSION['username'];
      echo $_SESSION['user_id'];
      ?>
      <div class="isssueForm">
        <form action="submitissue.php" method="post">
          <table style="height:90%">
            <tr>
              <th  colspan="2">Add New Issue</th>
            </tr>
            <tr>
              <td><label for="tit">Title: </label></td>
              <td><textarea rows="2" cols = "100" name="title" placeholder="Enter Title of the Issue" id="title"></textarea></td>
            </tr>
            <tr>
            <td><label for="des">Description: </label></td>
            <td><textarea rows="6" cols = "100" name="description" placeholder="Enter Description of the Issue" id="description"></textarea></td>
          </tr>
          <tr>
            <td><label for="res">Resolution: </label></td>
            <td><textarea rows="6" cols = "100" name="resolution" placeholder="Enter Resolution for the Issue" id="resolution"></textarea></td>
          </tr>

          <tr>
            <td colspan="2" class="button"><input type="submit" value="Submit" name="addissue"></td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>
