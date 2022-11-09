<?php
session_start();
include("../db.php");
?>
<?php
	$nopes = $_GET['nopes'];
	$idBank = $_GET['idBank'];
	$idUjian = $_GET['idUjian'];
	$limit = $_GET['limit'];
	$flag = $_GET['flag'];

	$sqldariJawaban = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$idUjian."' AND nopes_siswa='".$nopes."' LIMIT ".$limit." OFFSET ".$flag);
	while($resDariJawaban = mysqli_fetch_array($sqldariJawaban)){
		$sqlSoal = mysqli_fetch_array(mysqli_query($con,"select * from tbl_soal where id_soal='".$resDariJawaban['id_soal']."'"));
		echo $resDariJawaban['nomor_soal'];
	}
?>
