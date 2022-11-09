<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include("../db.php");
include("../token.php");
?>
<?php
	$kode = $_GET['kode'];
	$bank = $_GET['bank'];
	$jurusan = $_GET['jurusan'];
	$lama = $_GET['lama'];
	$sesi = $_GET['sesi'];
	$lihatHasil = $_GET['lihatHasil'];
	$lihatToken = $_GET['lihatToken'];
	$timeMode = $_GET['timeMode'];
	$curTime = time();

	$sql = "INSERT INTO tbl_ujian(kode_ujian,id_bank_soal,id_jurusan,lama_ujian,sesi_ujian,token_ujian,status_ujian,lihat_hasil,lihat_token,time_mode,time_set)values('".$kode."','".$bank."','".$jurusan."','".$lama."','".$sesi."','".genToken()."','0','".$lihatHasil."','".$lihatToken."','".$timeMode."','".$curTime."')";
	$query = mysqli_query($con,$sql);

	//buat Grup Ujian
	$queryGrup = mysqli_query($con,"INSERT INTO tbl_group(nama_group,kode_ujian)values('G-".$kode."','".$kode."')");
?>