<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "UPDATE tbl_ujian SET kode_ujian='".$_GET['kode']."',lama_ujian='".$_GET['lama']."',lihat_hasil='".$_GET['lihatHasil']."',lihat_token='".$_GET['lihatToken']."',time_mode='".$_GET['timeMode']."' WHERE id_ujian='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
?>