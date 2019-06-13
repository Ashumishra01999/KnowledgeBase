<?php
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

    div.bottom-nav {
      margin: 2% auto;
      padding: 1%;
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

    .pages {
        padding: 10px 14px;
        color: #000000;
        border-radius: 50%;
        background: #CCC;
        text-decoration: none;
        margin: 0px 6px;
        font-size: 0.9em;
    }

    .pages:hover {
        color: #ffffff;
        background: #666;
    }

    .current {
        padding: 10px 14px;
        color: #ffffff;
        background: #73AD21;
        text-decoration: none;
        border-radius: 50%;
        margin: 0px 6px;
    }

  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body class="searchpage">
  <section class="wrapper">
    <div class="searchcontainer">
      <form class="searchform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
        <input type="text" name="searchbox" class="searchbox" id="searchbox" placeholder=<?php $placeholder = !isset($_GET['searchbox'])? "Search" : '"'.$_GET['searchbox'].'"'; echo $placeholder;?>>
        <input type="submit" name="submitButton" class="submitButton" value="Search">
    </div>
  </section>
  <hr>
  <section class="wrapper">
    <div class="resultcontainer" id="resultcontainer"></div>
  </section>
  <script type="text/javascript">
      function showRecords(perPageCount, pageNumber) {
        var $_GET=[];
        window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(a,name,value){$_GET[name]=value;});
          $.ajax({
              type: "GET",
              url: "rendersearch.php",
              data: "searchbox=" + $_GET['searchbox']+"&pageNumber="+pageNumber,
              cache: false,
              success: function(html) {
                  $("#resultcontainer").html(html);
                  $('#loader').html('');
              }
          });
      }

      $(document).ready(function() {
          showRecords(10, 1);
      });
  </script>
</body>
</html>
