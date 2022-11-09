<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Semua Peserta Berhasil Direset');
	//window.location = document.referrer;
	window.location.href = 'http://localhost/smksmart/admin/dashboard.php?pages=status';
}
function gagal(){
	alert('Semua Peserta Gagal Direset');
	//window.location = document.referrer;
	window.location.href = 'http://localhost/smksmart/admin/dashboard.php?pages=status';
}
</script>
</head>
<body>
<?php
	$sql = "truncate tbl_login";
	$query = mysqli_query($con,$sql);
	if($query){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
?>
</body>
</html>