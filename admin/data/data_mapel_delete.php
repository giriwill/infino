<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Mata Pelajaran Berhasil Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Mata Pelajaran Gagal Dihapus');
	window.location = document.referrer;
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
	$sqlBank = mysqli_query($con,"select * from tbl_bank_soal where id_mapel='".$_GET['id']."'");
	$jmlBank = mysqli_num_rows($sqlBank);
	if($jmlBank > 0){
		echo '<script type="text/javascript"> gagal2(); </script>';
	}else{
		$sql = "delete from tbl_mapel where id_mapel='".$_GET['id']."'";
		$query = mysqli_query($con,$sql);
		if($query){
			echo '<script type="text/javascript"> berhasil(); </script>';
		}else{
			echo '<script type="text/javascript"> gagal(); </script>';
		}
	}	
?>
</body>
</html>