<?php
require_once('dbconnect.php');
session_start();

if(!isset($_SESSION['username']))
{
  die("<h3>Unauthorised Access<h3>");
}
?>
<!doctype html>
<html>
<head>
  <title>Example</title>
  <style>
    .wrapper {
      display: flex;
    }

    .wrapper>div {
      font-size: 4vh;
      color: black;
      margin: .1em;
      padding: .3em;
      border-radius: 3px;
      flex: 1;
    }

    div.resultcontainer {
      text-align: center;
      width: 60%;

    }

    form.searchform {
      text-align: center;
      left: 50%;
    }

    input.searchbox {
      display: inline-block;
      margin: 2% auto;
      text-align: center;
      border: 2px solid #3498db;
      padding: 14px 10px;
      width: 50%;
      outline: none;
      color: black;
      border-radius: 20px;
    }

    input.submitButton {
      display: inline-block;
      margin: 20px auto;
      border: 2px solid #2ecc71;
      background: #2ecc71;
      padding: 14px 10px;
      width: 10%;
      outline: none;
      color: white;
      border-radius: 20px;
      cursor: pointer;
    }

    input.submitButton:hover {
      background: #3498db;
      border: 2px solid #3498db;
    }

  </style>
</head>

<body>
  <div class="wrapper">
    <div class"searchcontainer">
      <form class="searchform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
        <input type="text" name="searchbox" class="searchbox" id="searchbox" placeholder="Search">
        <input type="submit" name="submitButton" class="submitButton" value="Search">
    </div>
  </div>
  <div class="wrapper">
    <div class="resultcontainer">
      <?php
          $dbconnection = new dbconnector;
          $dbconnection->connect();
          $rows = $dbconnection->search($_GET['searchbox']);
          echo('<table border="1">'."\n");
          // $i = 0;
          if(count($rows) > 0){
            foreach ($rows as $row) {
              echo '<tr>';
              echo '<td>';
              echo $row['title'];
              echo '</td>';
              echo '</tr>';
            }
          }
          ?>
    </div>
  </div>
</body>
</html>
