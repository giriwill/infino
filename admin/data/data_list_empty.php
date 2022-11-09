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

	$idKelas = $_POST['kelas'];
	$qSiswa = mysqli_query($con,"select * from tbl_siswa where id_kelas='".$idKelas."'");
	while($rSiswa = mysqli_fetch_array($qSiswa)){
		$upSiswa = mysqli_query($con,"UPDATE tbl_siswa SET cek='0' WHERE id_siswa='".$rSiswa['id_siswa']."' ");
	}

	$idGroup = $_POST['idGroup'];
	$sql = mysqli_query($con,"select (id_siswa) from tbl_siswa where cek='1'");
	$tampung = "";
	while($res = mysqli_fetch_array($sql)){
		$tampung = $tampung.",".$res['id_siswa'];
	}
	$tampung = substr($tampung, 1);
	$deret = explode(",",$tampung);
	/*for($i = 0;$i < count($deret) ; $i++){
		echo $deret[$i];
	}*/
	$sqlUpdate = mysqli_query($con,"UPDATE tbl_group SET grup='".$tampung."' WHERE id_group='".$idGroup."'");
	//celar cek di tabel siswa
	$sqlClear = mysqli_query($con,"UPDATE tbl_siswa SET cek='' ");

	if($qSiswa){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}


?>
</body>
</html>