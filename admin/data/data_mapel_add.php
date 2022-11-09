<?php
session_start();
include("../db.php");
?>
<?php
	$sql = "insert into tbl_mapel(nama_mapel,kkm_mapel,jenis_mapel)values('".$_GET['nama']."','".$_GET['kkm']."','".$_GET['jenis']."')";
	$query = mysqli_query($con,$sql);
?>