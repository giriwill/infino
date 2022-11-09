<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "UPDATE tbl_siswa SET nopes_siswa='".$_GET['nopes']."',nama_siswa='".$_GET['nama']."',id_kelas='".$_GET['kelas']."',password_siswa='".$_GET['password']."',kelompok_siswa='".$_GET['sesi']."' WHERE id_siswa='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
?>