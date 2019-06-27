<?php
session_start();

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
?>
<!doctype html>
<html>
<head>
  <title>Search Result - Knowledge Base</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" type="image/png" href="images\favicon.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>

<body class="searchpage">
  <header>
    <div class="logo">
        <a href="dashboard.php" class="logo-link"><p>AIS Knowledge Base </p></a>
    </div>

    <!-- Nav bar -->

            <nav class="searchres-bar">
                <ul class="nav-list">
                  <li>
                    <form class="searchform searchform-nav" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
                        <div class="form-group">
                            <input type="text" name="query" class="searchbox searchbox-nav" id="username" placeholder="Search..." <?php if(isset($_GET['query'])) {echo 'value="'.$_GET['query'].'"';}?>>
                            <button type="submit" class="btn btn-secondary searchbtn searchbtn-nav">Search</button>
                        </div>
                    </form>
                  </li>
                    <li><a class = "nav-darklnk" href="addissue.php"><button type="submit" class="nav-btn">Add Issue</a></li>
                    <li>
                      <div class="dropdown">
                        <button type="submit" class="nav-btn"><?php echo $_SESSION['name']; ?></button>
                        <div class="dropdown-content">
                        <a href="logout.php">Logout</a>
                        </div>
                      </div>
                    </li>
                </ul>
            </nav>
  </header>

  <main>
    <div class="resultcontainer" id="resultcontainer"></div>
  </main>
  <!-- Script to retrieve results and Implement Paging -->
  <script type="text/javascript">

  // Retrieve GET parameter from address bar

      function showRecords(perPageCount, pageNumber) {
        var query = new RegExp('[\?&]' + 'query' + '=([^&#]*)').exec(window.location.href);
        if (query==null) {
          query = '';
        }
        else {
          query = query[1];
        }

  // Implement Paging using ajax

        $.ajax({
              type: "GET",
              url: "rendersearch.php",
              data: "query=" + query+"&pageNumber="+pageNumber,
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
