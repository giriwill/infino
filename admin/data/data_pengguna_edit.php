<?php
session_start();
include("../db.php");
?>
<?php
	$pass = md5($_GET['password']);
	$sql = "update tbl_user set username='".$_GET['username']."',password='".$pass."',level='".$_GET['level']."' where id_user='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
?>