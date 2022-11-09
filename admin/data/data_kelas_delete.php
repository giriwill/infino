<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Kelas Berhasil Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Kelas Gagal Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal2(){
	alert('Kelas tidak bisa dihapus, karena masih ada Siswa yang menggunakan data Kelas ini');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	//cek kelas pada tabel siswa
	$sqlSiswa = "select * from tbl_siswa where id_kelas='".$_GET['id']."'";
	$querySiswa = mysqli_query($con,$sqlSiswa);
	$jmlSiswa = mysqli_num_rows($querySiswa);

	if($jmlSiswa > 0){
		echo '<script type="text/javascript"> gagal2(); </script>';
	}else{
		$sql = "delete from tbl_kelas where id_kelas='".$_GET['id']."'";
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