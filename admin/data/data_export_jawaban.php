<?php
session_start();
include("../db.php");
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$kodeUjian = mysqli_fetch_array(mysqli_query($con,"select * from tbl_ujian where id_ujian='".$_POST['idUjian']."'"));
$jenisku = "";
if($_POST['jenisSoal'] == 1){
	$jenisku = "PG";
}else{
	$jenisku = "ESSAY";
}
header("Content-Disposition: attachment; filename=".$kodeUjian['kode_ujian']."_jawaban_".$jenisku.".xls")
?>

<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
		function berhasil(){
			window.location = document.referrer;
		}
	</script>
	<style type="text/css">
		
	</style>
</head>
<body>
	<?php if($_POST['jenisSoal'] == 1){?>
	<?php
	$dataUjian = mysqli_fetch_array(mysqli_query($con,"select * from tbl_ujian where id_ujian='".$_POST['idUjian']."'"));
	echo "<h3 style='text-align:center;'>DAFTAR JAWABAN SISWA DENGAN KODE UJIAN -".$dataUjian['kode_ujian']."-</h3>";
	echo "<h3 style='text-align:center;'>JENIS SOAL PILIHAN GANDA</h3>";
	echo "<h3 style='text-align:center;'>Ruang : ".$_POST['ruang']."</h3>";	
	?>
	
	<table width="100%" border="1" cellpadding="2" class="table">
		<tr>
			<th rowspan="4">No.</th>
			<th rowspan="4">Nomor Peserta</th>
			<th rowspan="4">Nama Siswa</th>
			<th rowspan="4">Kelas</th>
			<th colspan="2" style="text-align: center">Nomor Soal</th>			
		</tr>
		<tr>
			<?php
			$nomor = 1;
			$jmlSiswa = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' GROUP BY nopes_siswa"));
			$dataSiswa = mysqli_fetch_array(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' LIMIT 1"));
			if($jmlSiswa > 0){
				$jmlSoal = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' AND nopes_siswa='".$dataSiswa['nopes_siswa']."' AND pg_jawaban <> '' ORDER BY id_soal ASC");
				while($dataJmlSoal = mysqli_fetch_array($jmlSoal)){
					echo "<th>".$nomor."</th>";
					$nomor++;
				}
			}
			?>
		</tr>
		<tr>
			<th colspan="2" style="text-align: center">Kunci Jawaban</th>
		</tr>
		<tr>
			<?php
			function cariKunci($idSoal){
				include("../db.php");
				$sql = mysqli_fetch_array(mysqli_query($con,"select * from tbl_soal where id_soal='".$idSoal."'"));
				if($sql['kunciopt_soal'] == "opt1_soal"){
					return "A";
				}else if($sql['kunciopt_soal'] == "opt2_soal"){
					return "B";
				}else if($sql['kunciopt_soal'] == "opt3_soal"){
					return "C";
				}else if($sql['kunciopt_soal'] == "opt4_soal"){
					return "D";
				}else{
					return "E";
				}
			}

			$nomor2 = 1;
			$jmlSiswa2 = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' GROUP BY nopes_siswa"));
			$dataSiswa2 = mysqli_fetch_array(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' LIMIT 1"));
			if($jmlSiswa2 > 0){
				$jmlSoal2 = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' AND nopes_siswa='".$dataSiswa2['nopes_siswa']."' AND pg_jawaban <> '' ORDER BY id_soal ASC");
				while($dataJmlSoal2 = mysqli_fetch_array($jmlSoal2)){
					echo "<th>".cariKunci($dataJmlSoal2['id_soal'])."</th>";
					$nomor2++;
				}
			}
			?>
		</tr>
		<?php
			function cariNama($nopes){
				include("../db.php");
				$nama = mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$nopes."'"));
				return $nama['nama_siswa'];
			}

			function cariKelas($nopes){
				include("../db.php");
				$id = mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$nopes."'"));
				$idKelas = $id['id_kelas'];
				$kelas = mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where id_kelas='".$idKelas."'"));
				return $kelas['nama_kelas'];
			}

			function cariAbjad($abjad){
				if($abjad == "opt1_soal"){
					return "A";
				}else if($abjad == "opt2_soal"){
					return "B";
				}else if($abjad == "opt3_soal"){
					return "C";
				}else if($abjad == "opt4_soal"){
					return "D";
				}else{
					return "E";
				}
			}

			$no = 1;
			$queryJawaban = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' GROUP BY nopes_siswa ORDER BY nopes_siswa");
			while($dataJawaban = mysqli_fetch_array($queryJawaban)){
				echo "<tr>";
				echo "<td>".$no."</td>";
				echo "<td>".$dataJawaban['nopes_siswa']."</td>";
				echo "<td>".cariNama($dataJawaban['nopes_siswa'])."</td>";
				echo "<td>".cariKelas($dataJawaban['nopes_siswa'])."</td>";
				$detJawaban = mysqli_query($con,"select * from tbl_jawaban where nopes_siswa='".$dataJawaban['nopes_siswa']."' AND pg_jawaban <> '' AND id_ujian='".$_POST['idUjian']."' order by id_soal asc");
				while($datadetJawaban = mysqli_fetch_array($detJawaban)){
					if($datadetJawaban['pg_jawaban'] != ""){
						echo "<td>".cariAbjad($datadetJawaban['pg_jawaban'])."</td>";
					}else{
						echo "<td>".$datadetJawaban['essay_jawaban']."</td>";
					}
				}
				echo "</tr>";
				$no++;
			}
		?>
	</table>
	<?php }else{?>
	<?php
	//jawaban essay disini
	$dataUjian = mysqli_fetch_array(mysqli_query($con,"select * from tbl_ujian where id_ujian='".$_POST['idUjian']."'"));
	echo "<h3 style='text-align:center;'>DAFTAR JAWABAN SISWA DENGAN KODE UJIAN -".$dataUjian['kode_ujian']."-</h3>";
	echo "<h3 style='text-align:center;'>JENIS SOAL ESSAY</h3>";
	echo "<h3 style='text-align:center;'>Ruang : ".$_POST['ruang']."</h3>";	
	?>
	
	<table width="100%" border="1" cellpadding="2" class="table">
		<tr>
			<th rowspan="4">No.</th>
			<th rowspan="4">Nomor Peserta</th>
			<th rowspan="4">Nama Siswa</th>
			<th rowspan="4">Kelas</th>
			<th colspan="2" style="text-align: center">Nomor Soal</th>			
		</tr>
		<tr>
			<?php
			$nomor = 1;
			$jmlSiswa = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' GROUP BY nopes_siswa"));
			$dataSiswa = mysqli_fetch_array(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' LIMIT 1"));
			if($jmlSiswa > 0){
				$jmlSoal = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' AND nopes_siswa='".$dataSiswa['nopes_siswa']."' AND pg_jawaban = '' ORDER BY id_soal ASC");
				while($dataJmlSoal = mysqli_fetch_array($jmlSoal)){
					echo "<th>".$nomor."</th>";
					$nomor++;
				}
			}
			?>
		</tr>
		<tr>
			<th colspan="2" style="text-align: center">Kunci Jawaban</th>
		</tr>
		<tr>
			<?php
			function cariKunci($idSoal){
				include("../db.php");
				$sql = mysqli_fetch_array(mysqli_query($con,"select * from tbl_soal where id_soal='".$idSoal."'"));
				return $sql['kunciessay_soal'];
			}

			$nomor2 = 1;
			$jmlSiswa2 = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' GROUP BY nopes_siswa"));
			$dataSiswa2 = mysqli_fetch_array(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' LIMIT 1"));
			if($jmlSiswa2 > 0){
				$jmlSoal2 = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' AND nopes_siswa='".$dataSiswa2['nopes_siswa']."' AND pg_jawaban = '' ORDER BY id_soal ASC");
				while($dataJmlSoal2 = mysqli_fetch_array($jmlSoal2)){
					echo "<th>".cariKunci($dataJmlSoal2['id_soal'])."</th>";
					$nomor2++;
				}
			}
			?>
		</tr>
		<?php
			function cariNama($nopes){
				include("../db.php");
				$nama = mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$nopes."'"));
				return $nama['nama_siswa'];
			}

			function cariKelas($nopes){
				include("../db.php");
				$id = mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$nopes."'"));
				$idKelas = $id['id_kelas'];
				$kelas = mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where id_kelas='".$idKelas."'"));
				return $kelas['nama_kelas'];
			}

			function cariAbjad($abjad){
				if($abjad == "opt1_soal"){
					return "A";
				}else if($abjad == "opt2_soal"){
					return "B";
				}else if($abjad == "opt3_soal"){
					return "C";
				}else if($abjad == "opt4_soal"){
					return "D";
				}else{
					return "E";
				}
			}

			$no = 1;
			$queryJawaban = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_POST['idUjian']."' GROUP BY nopes_siswa ORDER BY nopes_siswa");
			while($dataJawaban = mysqli_fetch_array($queryJawaban)){
				echo "<tr>";
				echo "<td>".$no."</td>";
				echo "<td>".$dataJawaban['nopes_siswa']."</td>";
				echo "<td>".cariNama($dataJawaban['nopes_siswa'])."</td>";
				echo "<td>".cariKelas($dataJawaban['nopes_siswa'])."</td>";
				$detJawaban = mysqli_query($con,"select * from tbl_jawaban where nopes_siswa='".$dataJawaban['nopes_siswa']."' AND pg_jawaban = '' AND id_ujian='".$_POST['idUjian']."' order by id_soal asc");
				while($datadetJawaban = mysqli_fetch_array($detJawaban)){
					if($datadetJawaban['pg_jawaban'] != ""){
						echo "<td>".cariAbjad($datadetJawaban['pg_jawaban'])."</td>";
					}else{
						echo "<td>".$datadetJawaban['essay_jawaban']."</td>";
					}
				}
				echo "</tr>";
				$no++;
			}
		?>
	</table>
	<?php }?>
	<script type="text/javascript">
		//window.print();
	</script>
	<?php
	//echo '<script type="text/javascript"> berhasil(); </script>';
	?>
</body>
</html>