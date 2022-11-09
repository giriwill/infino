<?php
session_start();
include("../db.php");
include("../token.php");

$token = genToken();

$id = $_GET['id'];
$sql = mysqli_query($con,"UPDATE tbl_ujian SET token_ujian='".$token."' WHERE id_ujian='".$id."'");
if($sql){
	$sql2 = mysqli_query($con,"SELECT * FROM tbl_ujian where id_ujian='".$id."'");
	$res = mysqli_fetch_array($sql2);
	echo $res['token_ujian'];
}else{
	echo "Failed";
}

?>