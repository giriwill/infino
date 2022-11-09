<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Mata Ujian Berhasil Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Mata Ujian Gagal Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	$id = $_GET['id'];

	$queryGroup = mysqli_query($con,"select (kode_ujian) from tbl_ujian where id_ujian='".$id."'");
	$resGroup = mysqli_fetch_array($queryGroup)['kode_ujian'];

	$sql2 = mysqli_query($con,"DELETE FROM tbl_ujian WHERE id_ujian='".$id."'");	
	$sql3 = mysqli_query($con,"DELETE FROM tbl_jawaban WHERE id_ujian='".$id."'");
	$sql4 = mysqli_query($con,"DELETE FROM tbl_group WHERE kode_ujian='".$resGroup."'");
	if($sql2 && $sql3){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
		
?>
</body>
</html>