<html>
<head>
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
  overflow: hidden;
  font-size: 20%;
  text-align: left;
  position: absolute;

}
</style>
</head>

<body>

<div class="centernav">
    <form action="validate.php" method="post" name="centernav">
  <input type="text"  placeholder="Search..">
<div class="addnew">
    <form action="validate.php" method="post" name="Add issue">
  <p>
    <input type="submit" value="Add issue">
  </p>
</div>
  </div>
</body>
</html>
