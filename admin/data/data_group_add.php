<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "insert into tbl_group(nama_group,id_ujian)values('".$_GET['nama']."','".$_GET['ujian']."')";
	$query = mysqli_query($con,$sql);
?>