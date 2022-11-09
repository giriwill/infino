<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
		<table class="table">
			<tr>
				<th width="10">No.</th>
				<th>Kode Ujian</th>
				<th>Nomor Peserta</th>
				<th>Nama Peserta</th>
				<th>Sisa Waktu</th>
				<th>Status Ujian</th>
			</tr>
			<?php
				$offset = $_GET['offset'];
				$limit = $_GET['limit'];
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				function durasiUjian($waktu){
					$detik = $waktu * 60;
					$jam = $detik/3600;
					$sisamenit = $jam-(floor($jam));
					$menit = ceil($sisamenit * 60);
					$komposisi = floor($jam)." Jam : ".$menit." Menit";
					return $komposisi;
				}
				$no = 1;
				$sql = "select * from tbl_status_ujian where nopes_siswa LIKE '%".$katakunci."%' order by id_status_ujian desc LIMIT ".$limit." OFFSET ".$offset;
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
					echo "<td>".$no."</td>";
					$ujian = mysqli_fetch_array(mysqli_query($con,"select * from tbl_ujian where id_ujian = '".$res['id_ujian']."'"));
					echo "<td>".$ujian['kode_ujian']."</td>";
					echo "<td>".$res['nopes_siswa']."</td>";
					$peserta = mysqli_fetch_array(mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$res['nopes_siswa']."'"));
					echo "<td>".$peserta['nama_siswa']."</td>";
					echo "<td>".durasiUjian($res['sisa_waktu'])."</td>";
					if($res['status'] == 0 AND $res['sisa_waktu'] > 0){
						echo "<td style='color:red;'>Belum Selesai</td>";
					}else if($res['status'] == 0 AND $res['sisa_waktu'] == 0){
						echo "<td style='color:green;'>Belum Mulai</td>";
					}else{
						echo "<td>Selesai</td>";
					}
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>