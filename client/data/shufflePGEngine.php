<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	//cek jumlah opsi
$jmlOpsinya = mysqli_fetch_array(mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$res['id_bank_soal']."'"));
if($jmlOpsinya['jml_opsi'] == 5){
	$sqlOpsiJmlSoal = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$res['id_ujian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
	while($resOpsiJmlSoal = mysqli_fetch_array($sqlOpsiJmlSoal)){
		if($resOpsiJmlSoal['acak_opsi'] == 1){
			$arrayOpsi = array('opt1_soal','opt2_soal','opt3_soal','opt4_soal','opt5_soal');
			shuffle($arrayOpsi);
			foreach ($arrayOpsi as $isiOpsi) {
				if(!isset($_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiE'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiE'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}
			}
		}else{
			$arrayOpsi = array('opt1_soal','opt2_soal','opt3_soal','opt4_soal','opt5_soal');
			//shuffle($arrayOpsi);
			foreach ($arrayOpsi as $isiOpsi) {
				if(!isset($_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiE'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiE'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}
			}
		}
	}
}else if($jmlOpsinya['jml_opsi'] == 4){
	$sqlOpsiJmlSoal = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$res['id_ujian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
	while($resOpsiJmlSoal = mysqli_fetch_array($sqlOpsiJmlSoal)){
		if($resOpsiJmlSoal['acak_opsi'] == 1){
			$arrayOpsi = array('opt1_soal','opt2_soal','opt3_soal','opt4_soal');
			shuffle($arrayOpsi);
			foreach ($arrayOpsi as $isiOpsi) {
				if(!isset($_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}
			}
		}else{
			$arrayOpsi = array('opt1_soal','opt2_soal','opt3_soal','opt4_soal');
			//shuffle($arrayOpsi);
			foreach ($arrayOpsi as $isiOpsi) {
				if(!isset($_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiD'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}
			}
		}
	}
}else if($jmlOpsinya['jml_opsi'] == 3){
	$sqlOpsiJmlSoal = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$res['id_ujian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
	while($resOpsiJmlSoal = mysqli_fetch_array($sqlOpsiJmlSoal)){
		if($resOpsiJmlSoal['acak_opsi'] == 1){
			$arrayOpsi = array('opt1_soal','opt2_soal','opt3_soal');
			shuffle($arrayOpsi);
			foreach ($arrayOpsi as $isiOpsi) {
				if(!isset($_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}
			}
		}else{
			$arrayOpsi = array('opt1_soal','opt2_soal','opt3_soal');
			//shuffle($arrayOpsi);
			foreach ($arrayOpsi as $isiOpsi) {
				if(!isset($_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiA'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiB'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}else if(!isset($_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']])){
					$_SESSION['opsiC'][$resOpsiJmlSoal['id_jawaban']] = $isiOpsi;
				}
			}
		}
	}
}

?>
</body>
</html>