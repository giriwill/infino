<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	//cek apakah di tbl jawaban, siswa ini pernah mengikuti ujian ini ?
	$sqlCek = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$res['id_ujian']."' AND nopes_siswa='".$_SESSION['nopes']."'"));
	if($sqlCek < 1){
		/*$jmlSoalNonAcak = mysqli_num_rows(mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$res['id_bank_soal']."' AND acak_soal='0'"));
		$jmlSoalAcak = mysqli_num_rows(mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$res['id_bank_soal']."' AND acak_soal='1'"));
		
		//tentukan array penampung id soal non acak
		$arrayIdSoalNonAcak = array($jmlSoalNonAcak);
		//masukan id soal yang tidak di acak ke dalam array
		$nomorArray = 0;
		$no = 0;
		$sqlSoalNonAcak = mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$res['id_bank_soal']."' AND acak_soal='0' ORDER BY id_soal asc");
		while($resSoalNonAcak = mysqli_fetch_array($sqlSoalNonAcak)){
			$arrayIdSoalNonAcak[$no] = $resSoalNonAcak['id_soal'];
			$no++;
			$nomorArray++;
		}

		//tentukan array penampung id soal acak
		$arrayIdSoalAcak = array($jmlSoalAcak);
		//masukan id soal yang di acak ke dalam array
		$no2 = 0;
		$sqlSoalAcak = mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$res['id_bank_soal']."' AND acak_soal='1' ORDER BY rand()");
		while($resSoalAcak = mysqli_fetch_array($sqlSoalAcak)){
			$arrayIdSoalAcak[$no2] = $resSoalAcak['id_soal'];
			$no2++;
			$nomorArray++;
		}

		//jumlahkan seluruh soal
		$totalSoal = count($arrayIdSoalNonAcak) + count($arrayIdSoalAcak);

		//inputkan ke dalam tbl jawaban
		//yang non acak dulu
		$nomorSoal = 0;
		
		if($jmlSoalNonAcak > 0){
			for($na = 0;$na < count($arrayIdSoalNonAcak);$na++){
				$nomorSoal++;
				$sqlJawaban = mysqli_query($con,"insert into tbl_jawaban(id_ujian,nopes_siswa,id_soal,nomor_soal)values('".$res['id_ujian']."','".$_SESSION['nopes']."','".$arrayIdSoalNonAcak[$na]."','".$nomorSoal."')");
			}
		}
		//yang acak
		if($jmlSoalAcak > 0){
			for($ac = 0;$ac < count($arrayIdSoalAcak);$ac++){
				$nomorSoal++;
				$sqlJawaban2 = mysqli_query($con,"insert into tbl_jawaban(id_ujian,nopes_siswa,id_soal,nomor_soal)values('".$res['id_ujian']."','".$_SESSION['nopes']."','".$arrayIdSoalAcak[$ac]."','".$nomorSoal."')");
			}
		}*/

		//Algoritma Baru 22 2 2019 soal yang tidak  diacak akan disimpan pada nomor pada saat pembuatan soal
		//Array penampung id soal yang diacak
		$jmlSoalAcak = mysqli_num_rows(mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$res['id_bank_soal']."' AND acak_soal='1'"));
		$arrayIdSoalAcak = array($jmlSoalAcak);
		$no2 = 0;
		$sqlSoalAcak = mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$res['id_bank_soal']."' AND acak_soal='1'");
		while($resSoalAcak = mysqli_fetch_array($sqlSoalAcak)){
			$arrayIdSoalAcak[$no2] = $resSoalAcak['id_soal'];
			$no2++;
		}
		//acak soal 
		$kotaknomor = array();
		$nomorkotak = 0;
		shuffle($arrayIdSoalAcak);
		foreach ($arrayIdSoalAcak as $kotakBaru) {
		    $kotaknomor[$nomorkotak] = $kotakBaru;
		    $nomorkotak++;
		}

		$nomorArraySoalAcak = 0;
		$nomorSoal = 0;
		//input ke tbl_jawaban
		$cekSoal = mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$res['id_bank_soal']."'");
		while($resCekSoal = mysqli_fetch_array($cekSoal)){
			$nomorSoal++;
			if($resCekSoal['acak_soal'] == 0){
				$sqlinputketbljawaban = mysqli_query($con,"insert into tbl_jawaban(id_ujian,nopes_siswa,id_soal,nomor_soal,acak_opsi)values('".$res['id_ujian']."','".$_SESSION['nopes']."','".$resCekSoal['id_soal']."','".$nomorSoal."','".$resCekSoal['acak_opsi']."')");
			}else{
				$sqlinputketbljawaban = mysqli_query($con,"insert into tbl_jawaban(id_ujian,nopes_siswa,id_soal,nomor_soal,acak_opsi)values('".$res['id_ujian']."','".$_SESSION['nopes']."','".$kotaknomor[$nomorArraySoalAcak]."','".$nomorSoal."','".$resCekSoal['acak_opsi']."')");
				$nomorArraySoalAcak++;
			}
		}
		}else{
		
		
	}
?>
</body>
</html>