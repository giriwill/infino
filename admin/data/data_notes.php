<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Notes Berhasil Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Notes Gagal Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	//$id = $_GET['id'];
	//echo $_POST["notes"];
	$sql2 = mysqli_query($con,"update tbl_notes set notes='".$_POST['notes']."' where id_notes='1'");
	if($sql2){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}		
?>
</body>
</html>