<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "insert into tbl_kelas(nama_kelas,id_jurusan)values('".$_GET['nama']."','".$_GET['rombel']."')";
	$query = mysqli_query($con,$sql);
?>