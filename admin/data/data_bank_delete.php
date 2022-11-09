<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Bank Soal Berhasil Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Bank Soal Gagal Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	$folder = mysqli_fetch_array(mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$_GET['id']."'"));
	$structure = '../../js/kcfinder/upload/images/'.$folder['path_image'];
	function removeDirectory($path) {
	 	$files = glob($path . '/*');
		foreach ($files as $file) {
			is_dir($file) ? removeDirectory($file) : unlink($file);
		}
		rmdir($path);
	 	return;
	}
	removeDirectory($structure);
	$sql = "delete from tbl_bank_soal where id_bank_soal='".$_GET['id']."'";
	$sql2 = "delete from tbl_soal where id_bank_soal='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
	$query2 = mysqli_query($con,$sql2);
	if($query && $query2){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
?>
</body>
</html>