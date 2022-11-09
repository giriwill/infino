<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "UPDATE tbl_kelas SET nama_kelas='".$_GET['nama']."',id_jurusan='".$_GET['rombel']."' WHERE id_kelas='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
?>