<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "UPDATE tbl_mapel SET nama_mapel='".$_GET['nama']."',kkm_mapel='".$_GET['kkm']."',jenis_mapel='".$_GET['jenis']."' WHERE id_mapel='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
?>