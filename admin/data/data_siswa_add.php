<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "insert into tbl_siswa(nopes_siswa,nama_siswa,id_kelas,password_siswa,kelompok_siswa)values('".$_GET['nopes']."','".$_GET['nama']."','".$_GET['kelas']."','".$_GET['password']."','".$_GET['sesi']."')";
	$query = mysqli_query($con,$sql);
?>