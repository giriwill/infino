<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	//alert('List Group Berhasil Diubah');
	history.go(-1);
	//window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	//alert('List Group Gagal Diubah');
	history.go(-1);
	//window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal2(){
	alert('Mata Pelajaran Gagal Dihapus, Karena Masih Ada Data Ujian Yang Menggunakan Mapel ini');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php

	if(isset($_POST['cekall'])){
		$query = mysqli_query($con,"UPDATE tbl_siswa SET cek='1'");
	}else{
		$query = mysqli_query($con,"UPDATE tbl_siswa SET cek='0'");
	}
	
	if($query){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
?>
</body>
</html>