<?php
session_start();
include("db.php");
date_default_timezone_set("Asia/Bangkok");

$username = $_GET['username'];
$password = $_GET['password'];
$sql = mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$username."' AND password_siswa='".$password."'");
$jml = mysqli_num_rows($sql);
if($jml > 0){
	$cekLogin = mysqli_query($con,"select * from tbl_login where nopes_siswa='".$username."'");
	$resCekLogin = mysqli_fetch_array($cekLogin);
	$jmlCekLogin = mysqli_num_rows($cekLogin);
	$waktu = date("h:i:sa");
	if($jmlCekLogin < 1){		
		$_SESSION['reg'] = 1;
		$_SESSION['nopes'] = $username;
		$inLogin = mysqli_query($con,"insert into tbl_login(nopes_siswa,waktu_login,status_login)values('".$username."','".$waktu."','1')");
		echo "1";
	}else if($jmlCekLogin > 0 && $resCekLogin['status_login'] == 1){
		echo "-1";
		$_SESSION['reg'] = 0;
	}else if($jmlCekLogin > 0 && $resCekLogin['status_login'] == 0){
		$_SESSION['reg'] = 1;
		$_SESSION['nopes'] = $username;
		$upLogin = mysqli_query($con,"update tbl_login set waktu_login='".$waktu."',status_login='1' where nopes_siswa='".$username."'");
		echo "1";
	}
}else{
	$_SESSION['reg'] = 0;
	echo "0";
}
?>