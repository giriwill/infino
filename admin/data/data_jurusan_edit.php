<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "UPDATE tbl_jurusan SET nama_jurusan='".$_GET['nama']."' WHERE id_jurusan='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
?>