<?php
session_start();
include("../db.php");
?>
<?php
	$id = $_GET['id'];
	$token = $_GET['token'];
	$sql = mysqli_query($con,"select * from tbl_ujian where id_ujian = '".$id."' AND token_ujian='".$token."'");
	$jml = mysqli_num_rows($sql);
	echo $jml;
?>
