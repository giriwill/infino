<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Soal Berhasil Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Soal Gagal Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	$id = $_GET['id'];
	$sql = "select * from tbl_soal where id_soal='".$id."'";
	$query = mysqli_query($con,$sql);
	$res = mysqli_fetch_array($query);
	$audio = $res['audio_soal'];
	unlink('../../audios/'.$audio);
	$sql2 = mysqli_query($con,"DELETE FROM tbl_soal WHERE id_soal='".$id."'");
	if($sql2){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
		
?>
</body>
</html>