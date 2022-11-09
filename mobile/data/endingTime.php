<?php
session_start();
include("../db.php");
?>
<?php
	$nopes = $_GET['nopes'];
	$idUjian = $_GET['idUjian'];

	$updateTime = mysqli_query($con,"update tbl_status_ujian set status='1' where id_ujian='".$idUjian."' AND nopes_siswa='".$nopes."' ");
?>

<?php
$poin = 0;
$jmlJawabanPeserta = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'"));
$cekJawaban = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
while($resJawaban = mysqli_fetch_array($cekJawaban)){
	$cekKunciJawaban = mysqli_fetch_array(mysqli_query($con,"select * from tbl_soal where id_soal='".$resJawaban['id_soal']."'"));
	if($resJawaban['pg_jawaban'] == $cekKunciJawaban['kunciopt_soal']){
		$poin++;
	}
}
$savePoin = mysqli_query($con,"update tbl_status_ujian set nilai_pg='".$poin."' where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
?>