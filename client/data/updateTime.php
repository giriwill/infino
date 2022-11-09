<?php
session_start();
include("../db.php");
?>
<?php
	$nopes = $_GET['nopes'];
	$idUjian = $_GET['idUjian'];
	$siswaWaktu = $_GET['siswaWaktu'];

	$updateTime = mysqli_query($con,"update tbl_status_ujian set sisa_waktu='".$siswaWaktu."' where id_ujian='".$idUjian."' AND nopes_siswa='".$nopes."' ");
?>
