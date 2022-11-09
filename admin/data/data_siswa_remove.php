<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Data Siswa Berhasil Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Data Siswa Gagal Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	$hapus_siswa = mysqli_query($con,"truncate tbl_siswa");
	$hapus_login = mysqli_query($con,"truncate tbl_login");
	$hapus_status = mysqli_query($con,"truncate tbl_status_ujian");
	if($hapus_siswa && $hapus_login && $hapus_status){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
?>
</body>
</html>