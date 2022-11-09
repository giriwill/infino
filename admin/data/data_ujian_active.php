<?php
session_start();
include("../db.php");
include("../token.php");

$token = genToken();

$id = $_GET['id'];
$sql = mysqli_query($con,"SELECT * FROM tbl_ujian WHERE id_ujian='".$id."'");
$res = mysqli_fetch_array($sql);
if($res['status_ujian'] == 0){
	$aktifkan = mysqli_query($con,"UPDATE tbl_ujian SET status_ujian='1' WHERE id_ujian='".$id."'");
	echo "Matikan";
}else{
	$nonaktifkan = mysqli_query($con,"UPDATE tbl_ujian SET status_ujian='0' WHERE id_ujian='".$id."'");
	echo "Aktifkan";
}
?>