<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Jurusan Berhasil Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Jurusan Gagal Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal2(){
	alert('Jurusan tidak bisa dihapus, karena masih ada Kelas yang menggunakan data Jurusan ini');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal3(){
	alert('Jurusan tidak bisa dihapus, karena masih ada DATA UJIAN yang menggunakan data Jurusan ini');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	//cek kelas pada tabel siswa
	$sqlKelas = "select * from tbl_kelas where id_jurusan='".$_GET['id']."'";
	$queryKelas = mysqli_query($con,$sqlKelas);
	$jmlKelas = mysqli_num_rows($queryKelas);

	if($jmlKelas > 0){
		echo '<script type="text/javascript"> gagal2(); </script>';
	}else{
		$sqlUjian = mysqli_query($con,"select * from tbl_ujian where id_jurusan='".$_GET['id']."'");
		$jmlUjian = mysqli_num_rows($sqlUjian);
		if($jmlUjian > 0){
			echo '<script type="text/javascript"> gagal3(); </script>';
		}else{
			$sql = "delete from tbl_jurusan where id_jurusan='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			if($query){
				echo '<script type="text/javascript"> berhasil(); </script>';
			}else{
				echo '<script type="text/javascript"> gagal(); </script>';
			}
		}
	}

?>
</body>
</html>