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
        <script src="https://cdn.jsdelivr.net/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <?php
      echo $_SESSION['username'];
      echo $_SESSION['user_id'];
      ?>
      <div class="isssueForm">
        <form action="submitissue.php" method="post" name="addissue">
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
