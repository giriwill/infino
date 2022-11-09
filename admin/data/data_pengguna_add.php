<?php
session_start();
include("../db.php");
?>
<?php
	$pass = md5($_GET['password']);
	$sql = "insert into tbl_user(username,password,level)values('".$_GET['username']."','".$pass."','".$_GET['level']."')";
	$query = mysqli_query($con,$sql);
?>