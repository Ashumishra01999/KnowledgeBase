<?php

function searchhtmlresponse(){
if(!isset($_GET['searchbox']))
{
  die("<div class='result'>Please Enter a Query</div>");
}
$dbconnection = new dbconnector;
$dbconnection->connect();
$rows = $dbconnection->search($_GET['searchbox']);
if(!isset($_GET['p']))
{
  $page = 1;
}
else
{
  $page = $_GET['p'];
}
$count = 0;
$num_matches = count($rows);
$num_pages = ceil($num_matches/10);
if($num_matches > 0){
  for($i = ($page-1) * 10; ($i < $num_matches)&&($count < 10); $i++, $count++) {
    $row = $rows[$i];
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
$url_base = "search.php?searchbox=".$_GET['searchbox']."&submitButton=Search&p=";
echo "<div class='bottom-nav'";
echo "<table class='search-nav'><tbody><tr>";
if($page == 1)
{
  echo '<td> <a href="">Previous Page</a></td>';
}
else
{
  echo '<td> <a href="'.$url_base.($page-1).'">Previous Page</a></td>';
}
if($page == $num_pages)
{
  echo '<td> <a href="">Next Page</a></td>';
}
else
{
  echo '<td> <a href="'.$url_base.($page+1).'">Previous Page</a></td>';
}
echo "</tr></tbody></table></div>";
}
