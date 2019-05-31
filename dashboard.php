<html>
<head>
  <?php 
  session_start();
  ?>
<style>


.centernav {
  overflow: hidden;
  font-size: 20%;
  text-align: center;
  margin-top: 15%;
  padding: 6px;
}
.centernav input[type=text] {

  font-size: 50px;
  background-color: rgba(0, 0, 0, 0.1);
  border: 2px solid #FFFF

}
.addnew{
  width:100%;
  overflow: hidden;
  font-size: 20px;
  text-align: right;
  position: absolute;
  top:0;
  right:0;
  margin-top: 5px;
  margin-right: 3px;
}
.addnew a {
  float: right;
  display: block;
  text-align: center;
  padding: 2px;
  text-decoration: none;
  font-size: 17px;
  border: 2px solid ;
}
</style>
</head>

<body>

<div class="centernav">
    <form action="validate.php" method="post" name="centernav">
  <input type="text"  placeholder="Search..">
<div class="addnew">
    <a href="addissue.php" class="active">Add issue</a>
    <form action="addissue.php" method="post" name="Add issue">
</div>
  </div>
</body>
</html>
