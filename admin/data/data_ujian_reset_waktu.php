<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Waktu Server Berhasil DiReset');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Waktu Server Gagal DiReset');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	$curTime = time();
	$idUjian = $_GET['idUjian'];
	$sql = mysqli_query($con,"UPDATE tbl_ujian SET time_set='".$curTime."' WHERE id_ujian='".$idUjian."'");
	if($sql){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
		
?>
</body>
</html>