<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../../css/global.css">
	<script type="text/javascript">
		function berhasil(){
			window.location = document.referrer;
		}
	</script>
	<style type="text/css">
		
	</style>
</head>
<body>
	<?php
	$dataUjian = mysqli_fetch_array(mysqli_query($con,"select * from tbl_ujian where id_ujian='".$_POST['idUjian']."'"));
	echo "<h3 style='text-align:center;'>DAFTAR NILAI USBK KODE MATA UJIAN ".$dataUjian['kode_ujian']."</h3>";
	echo "<h3 style='text-align:center;'>Ruang : ".$_POST['ruang']."</h3>";	
	?>
	<table width="100%" border="1" cellpadding="2" class="table">
		<tr>
			<th>No.</th>
			<th width="100px">Nomor Peserta</th>
			<th>Nama Siswa</th>
			<th>Kelas</th>
			<th>Nilai Soal PG</th>
			<th>Nilai Soal Essay</th>
		</tr>
		<?php
		$no = 1;
		$dataStatus = mysqli_query($con,"select * from tbl_status_ujian where id_ujian='".$_POST['idUjian']."' order by nopes_siswa asc");
		while($resStatus = mysqli_fetch_array($dataStatus)){
			echo "<tr>";
			echo "<td>".$no."</td>";
			echo "<td>".$resStatus['nopes_siswa']."</td>";
			$datasiswa = mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$resStatus['nopes_siswa']."'"));
			echo "<td>".$datasiswa['nama_siswa']."</td>";
			$kelas = mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where id_kelas='".$datasiswa['id_kelas']."'"));
			echo "<td>".$kelas['nama_kelas']."</td>";
			echo "<td align='center'>".$resStatus['nilai_pg']."</td>";
			echo "<td align='center'>".$resStatus['nilai_essay']."</td>";
			echo "</tr>";
			$no++;
		}
		?>
	</table>
	<script type="text/javascript">
		window.print();
	</script>
	<?php
	echo '<script type="text/javascript"> berhasil(); </script>';
	?>
</body>
</html>