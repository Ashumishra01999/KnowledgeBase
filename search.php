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

    .wrapper>section {
      font-size: 4vh;
      color: black;
      margin: .1em;
      padding: .3em;
      border-radius: 3px;
      flex: 1;
    }


    div.resultcontainer {
      display: block;
      margin: auto;
      width: 50%;
      outline: none;
    }

    div.searchcontainer {
      width:100%;
    }

    div.result {
      width:97%;
      overflow: hidden;
      margin-top: 1%;
      margin-bottom: 1%;
      padding: 1%;
      border: 2px solid #c3c3c3;
      border-radius: 20px;
    }
    div.result:hover {
      border: 2px solid #898989;
      border-radius: 20px;
      background: #dddbdb;
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
  <section class="wrapper">
    <div class="searchcontainer">
      <form class="searchform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
        <input type="text" name="searchbox" class="searchbox" id="searchbox" placeholder=<?php $placeholder = !isset($_GET['searchbox'])? "Search" : '"'.$_GET['searchbox'].'"'; echo $placeholder;?>>
        <input type="submit" name="submitButton" class="submitButton" value="Search">
    </div>
  </section>
  <hr>
  <section class="wrapper">
    <div class="resultcontainer">
      <?php
          if(!isset($_GET['searchbox']))
          {
            die("<div class='result'>Please Enter a Query</div>");
          }
          $dbconnection = new dbconnector;
          $dbconnection->connect();
          $rows = $dbconnection->search($_GET['searchbox']);
          // $i = 0;
          if(count($rows) > 0){
            foreach ($rows as $row) {
              $post = $row['description'];
              $description_len = strlen($post);
              $index_lim = $description_len < 300 ? $description_len - 1 : 299;
              $link = 'post.php?post_id='.$row['post_id'];
              echo "<div class='result'>";
              echo "<a href='".$link."'>".$row['title']."</a>";
              echo "<p>".substr($post, 0, $index_lim)."...</p>";
              echo "</div>";
            }
          }
          else {
            echo "<div class='result'>";
            echo "No Matching Issues Found";
            echo "</div>";
          }
          ?>
    </div>
  </section>
</body>
</html>
