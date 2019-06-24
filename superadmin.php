<?php
session_start();
require_once('dbconnect.php');
require_once('util.php');

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
if($_SESSION['role_type'] != 'superadmin')
{
  echo "<strong>Unauthorised Access</strong>";
  die();
}
$dbconnection = new dbconnector;
$dbconnection->connect();

?>
<!Doctype html>
<html>
<head>
  <title>Super-Admin Dashboard - Knowledge Center</title>
  <link rel="stylesheet" href="css\style.css">
  <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
  <header>
    <div class="logo">
        <a href="dashboard.php" class="logo-link"><p>AIS Knowledge Base </p></a>
    </div>
            <nav class="searchres-bar">
                <ul class="nav-list">
                  <li>
                    <form class="searchform searchform-nav" action="search.php" method="get">
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

  <main class="dash-main">
    <div class="dash-container">
      <div class="inner-nav">
          <ul class="nav-tabs" role="tablist">
              <li class="nav-item">
                  <a class="nav-link show active" data-toggle="tab" href="#tab-01" role="tab"><span>Issues</span></a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tab-02" role="tab"><span>User Management</span></a>
              </li>
          </ul>
      </div>
    </div>
  </main>
