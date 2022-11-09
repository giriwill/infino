<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	//window.location = document.referrer;
	window.location.href = 'dashboard.php';
}
function gagal(){
	alert('Username dan Password SALAH !');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
$username = antiinjektion($_POST['username']);
$password = antiinjektion(md5($_POST['password']));
function antiinjektion($data)
{
$filter=mysql_real_escape_string(htmlspecialchars(stripslashes(strip_tags($data, ENT_QUOTES))));return $filter;
}

$cek = mysqli_num_rows(mysqli_query($con,"select * from tbl_user where username='".$username."' AND password='".$password."'"));
$data = mysqli_fetch_array(mysqli_query($con,"select * from tbl_user where  username='".$username."' AND password='".$password."'"));
if($cek > 0){
	$_SESSION['regis'] = 1;
	if($data['level'] == 1){
		$_SESSION['level'] = 1;
	}else{
		$_SESSION['level'] = 2;
	}
	echo '<script type="text/javascript"> berhasil(); </script>';
}else{
	echo '<script type="text/javascript"> gagal(); </script>';
}
?>
</body>
</html>