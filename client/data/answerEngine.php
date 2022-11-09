<?php
session_start();
include("../db.php");
?>
<?php
	$idJawaban = $_GET['idJawaban'];
	$jawabanku = $_GET['jawabanku'];
	$sql = mysqli_query($con,"update tbl_jawaban set pg_jawaban = '".$jawabanku."' where id_jawaban='".$idJawaban."'");
	
?>
