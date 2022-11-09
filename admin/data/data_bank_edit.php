<?php
session_start();
include("../db.php");
?>
<?php
	$folder = mysqli_fetch_array(mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$_GET['id']."'"));
	$structure = '../../js/kcfinder/upload/images/'.$folder['path_image'];
	function removeDirectory($path) {
	 	$files = glob($path . '/*');
		foreach ($files as $file) {
			is_dir($file) ? removeDirectory($file) : unlink($file);
		}
		rmdir($path);
	 	return;
	}
	removeDirectory($structure);
	$structure2 = '../../js/kcfinder/upload/images/'.$_GET['kode'];
	if (!mkdir($structure2, 0777, true)) {
	    //die('Failed to create folders...');
	}
	$sql = "UPDATE tbl_bank_soal SET kode_bank_soal='".$_GET['kode']."',id_mapel='".$_GET['mapel']."',jml_opsi='".$_GET['jmlOpsi']."',path_image='".$_GET['kode']."' WHERE id_bank_soal='".$_GET['id']."'";
	$query = mysqli_query($con,$sql);
	//ganti nama folder pada setiap soal
	$querySoal = mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$_GET['id']."'");
	$txt = "";
	while($dataSoal = mysqli_fetch_array($querySoal)){
		//des soal
		$txt = str_replace($folder['path_image'], $_GET['kode'], $dataSoal['des_soal']);
		//update
		$Upsoal = mysqli_query($con,"UPDATE tbl_soal SET des_soal='".$txt."' WHERE id_soal='".$dataSoal['id_soal']."'");
		//opsi A soal
		$txt = str_replace($folder['path_image'], $_GET['kode'], $dataSoal['opt1_soal']);
		//update
		$Upsoal = mysqli_query($con,"UPDATE tbl_soal SET opt1_soal='".$txt."' WHERE id_soal='".$dataSoal['id_soal']."'");
		//opsi B soal
		$txt = str_replace($folder['path_image'], $_GET['kode'], $dataSoal['opt2_soal']);
		//update
		$Upsoal = mysqli_query($con,"UPDATE tbl_soal SET opt2_soal='".$txt."' WHERE id_soal='".$dataSoal['id_soal']."'");
		//opsi C soal
		$txt = str_replace($folder['path_image'], $_GET['kode'], $dataSoal['opt3_soal']);
		//update
		$Upsoal = mysqli_query($con,"UPDATE tbl_soal SET opt3_soal='".$txt."' WHERE id_soal='".$dataSoal['id_soal']."'");
		//opsi D soal
		$txt = str_replace($folder['path_image'], $_GET['kode'], $dataSoal['opt4_soal']);
		//update
		$Upsoal = mysqli_query($con,"UPDATE tbl_soal SET opt4_soal='".$txt."' WHERE id_soal='".$dataSoal['id_soal']."'");
		//opsi E soal
		$txt = str_replace($folder['path_image'], $_GET['kode'], $dataSoal['opt5_soal']);
		//update
		$Upsoal = mysqli_query($con,"UPDATE tbl_soal SET opt5_soal='".$txt."' WHERE id_soal='".$dataSoal['id_soal']."'");
	}
?>