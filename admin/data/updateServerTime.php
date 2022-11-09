<?php
session_start();
include("../db.php");
?>
<?php
	$idUjian = $_GET['idUjian'];
	$sisaWaktu = $_GET['sisaWaktu'];

	$updateTime = mysqli_query($con,"update tbl_ujian set time_limit='".$sisaWaktu."' where id_ujian='".$idUjian."'");
?>
