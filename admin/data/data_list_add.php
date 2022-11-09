<?php
session_start();
include("../db.php");
?>
<?php
	if($_GET['order'] == 1){
		$sql = "UPDATE tbl_siswa SET cek='1' WHERE id_siswa='".$_GET['idSiswa']."'";
		$query = mysqli_query($con,$sql);	
	}else{
		$sql = "UPDATE tbl_siswa SET cek='0' WHERE id_siswa='".$_GET['idSiswa']."'";
		$query = mysqli_query($con,$sql);
	}
?>