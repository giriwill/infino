<?php
session_start();
include("../db.php");
?>
<?php
	$nopes = $_GET['nopes'];
	$idUjian = $_GET['idUjian'];

	$jml = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$idUjian."' AND nopes_siswa='".$nopes."' AND pg_jawaban='' AND essay_jawaban=''"));

	echo $jml;
	
?>
