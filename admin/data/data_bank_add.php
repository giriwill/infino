<?php
session_start();
include("../db.php");
?>
<?php
	//cek kode bank yang sama
	$sql_cek = "select * from tbl tbl_bank_soal where kode_bank_soal=".$_GET['kode'];
	$q_cek = mysqli_num_rows($con,$sql_cek);
	//echo $q_cek;
	if($q_cek < 1 AND $_GET['kode'] != ""){
		$sql = "INSERT INTO tbl_bank_soal(kode_bank_soal,id_mapel,status_bank_soal,jml_opsi,path_image)values('".$_GET['kode']."','".$_GET['mapel']."','2','".$_GET['jmlOpsi']."','".$_GET['kode']."')";
		$query = mysqli_query($con,$sql);
		$structure = '../../js/kcfinder/upload/images/'.$_GET['kode'];
		if (!mkdir($structure, 0777, true)) {
			//die('Failed to create folders...');
		}
	}
	
?>