<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "insert into tbl_jurusan(nama_jurusan)values('".$_GET['nama']."')";
	$query = mysqli_query($con,$sql);
?>