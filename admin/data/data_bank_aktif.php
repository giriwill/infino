<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	//alert('Status Berhasil Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	//alert('Status Gagal Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	if($_GET['com']=="aktifkan"){
		$sql = "UPDATE tbl_bank_soal SET status_bank_soal='1' WHERE id_bank_soal='".$_GET['id']."'";
		$query = mysqli_query($con,$sql);
		if($query){
			echo '<script type="text/javascript"> berhasil(); </script>';
		}else{
			echo '<script type="text/javascript"> gagal(); </script>';
		}
	}else{
		$sql = "UPDATE tbl_bank_soal SET status_bank_soal='2' WHERE id_bank_soal='".$_GET['id']."'";
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