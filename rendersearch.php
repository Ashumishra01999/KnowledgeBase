<?php
session_start();
require_once('dbconnect.php');

if(!isset($_SESSION['username']))
{
     $_SESSION['error'] = 'noaccess';
     header("Location:login.php");
}
if( (!isset($_GET['query']) ) || (strlen($_GET['query'])==0) )
{
  die("<div class='result'>Please Enter a Query</div>");
}
$dbconnection = new dbconnector;
$dbconnection->connect();
$rows = $dbconnection->search($_GET['query']);
if(!isset($_GET['pageNumber']))
{
  $pageNumber = 1;
}
else
{
  $pageNumber = $_GET['pageNumber'];
}
$perPageCount = 5;
$count = 0;
$num_matches = count($rows);
$pagesCount = ceil($num_matches/$perPageCount);
$lowerLimit = ($pageNumber - 1) * $perPageCount;
if($num_matches > 0){
  for($i = $lowerLimit; ($i < $num_matches)&&($count < $perPageCount); $i++, $count++) {
    $row = $rows[$i];
    $post = $row['description'];
    $description_len = strlen($post);
    $index_lim = $description_len < 300 ? $description_len - 1 : 299;
    $link = 'post.php?post_id='.$row['post_id'];
    echo "<div class='result'>";
    echo "<a href='".$link."'>".$row['title']."</a>";
    echo "<p class = 'res-desc'>".substr($post, 0, $index_lim)."...</p>";
    echo "</div>";
  }
}
else {
  echo "<div class='result'>";
  echo "No Matching Issues Found";
  echo "</div>";
}
?>
<div style="height: 30px;"></div>
<table class ="searchnav" width="50%" align="center">
    <tr>
      <td valign="top" align="center">
        <?php
        for ($i = 1; $i <= $pagesCount; $i++) {
          if ($i == $pageNumber) {
            echo '<a href="javascript:void(0);" class="current">';
            echo $i.'</a>';
          }
          else {
            echo '<a href="javascript:void(0);" class="pages" onclick="showRecords('.$perPageCount.','.$i.');">';
            echo $i.'</a>';
          }
        }
?>
      </td>
    </tr>
    <tr><td><br></td></tr>
    <tr>
      <td align="center" valign="top">Page <?php echo $pageNumber; ?>
        of <?php echo $pagesCount; ?>
      </td>
    </tr>
    <tr><td><br></td></tr>
</table>
