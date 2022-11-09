<?php
session_start();
include("../db.php");
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
		.kartu{
			border:1px solid #333;
			width: 300px;
			height: 210px;
			padding:10px;
			font-family: arial;
			margin:3px 20px 26px 0;
			float: left;
			font-size: 12px;
			text-align: center;
		}
	</style>
</head>
<body>
	<?php
	$sekolah = mysqli_fetch_array(mysqli_query($con,"select * from tbl_sekolah"));
	$querySiswa = mysqli_query($con,"select * from tbl_siswa");
	while($siswa = mysqli_fetch_array($querySiswa)){
	?>
	<div class="kartu">
		<B>KARTU PESERTA<BR>
		PENILAIAN AKHIR SEMESTER ONLINE 2020/2021</B><hr>
		<table border="0" width="100%" style="text-align: left;" cellpadding="2">
			<tr>
				<td width="30%">Nomor Peserta</td>
				<td>:</td>
				<td><?php echo $siswa['nopes_siswa'];?></td>
			</tr>
			<tr>
				<td width="30%">Password</td>
				<td>:</td>
				<td><?php echo $siswa['password_siswa'];?></td>
			</tr>
			<tr>
				<td width="30%">Nama Peserta</td>
				<td>:</td>
				<td><?php echo $siswa['nama_siswa'];?></td>
			</tr>
			<tr>
				<td width="30%">Kelas</td>
				<td>:</td>
				<td><?php
				$kelas = mysqli_fetch_array(mysqli_query($con,"select * from tbl_kelas where id_kelas='".$siswa['id_kelas']."'"));
				echo $kelas['nama_kelas'];
				?>					
				</td>
			</tr>
			<tr>
				<td width="30%">Kelompok</td>
				<td>:</td>
				<td><?php echo "Kelompok ".$siswa['kelompok_siswa'];?></td>
			</tr>
		</table>
		<table border="0" width="100%" style="text-align: left;" cellpadding="2">
			<tr>
				<td width="20%"></td>
				<td width="80%" style="text-align: center;">
					Kepala Sekolah<br>
					<?php echo $sekolah['nama_sekolah'];?><br><br>


					<?php echo $sekolah['kepala_sekolah'];?><br>
					<?php echo "NIP ".$sekolah['nip_kepsek'];?>
				</td>
			</tr>
		</table>
	</div>
	<?php
	}
	?>
	<script type="text/javascript">
		window.print();
	</script>
	<?php
	echo '<script type="text/javascript"> berhasil(); </script>';
	?>
</body>
</html>