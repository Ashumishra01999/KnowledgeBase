<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=kb_storage', 'root', '');
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
header('Content-Type: application/json; charset=utf-8');

$stmt = $pdo->prepare('SELECT title FROM posts WHERE title LIKE :prefix');
$stmt->execute(array( ':prefix' => $_REQUEST['term']."%"));
$retval = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
  $retval[] = $row['title'];
}

echo(json_encode($retval, JSON_PRETTY_PRINT));
