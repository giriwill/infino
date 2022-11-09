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
				<th>Nomor Peserta</th>
				<th>Nama Peserta</th>
				<th>Kelas</th>
				<th>Login Terakhir</th>
				<th>Status Login</th>
				<th>Reset Login</th>
			</tr>
			<?php
				$offset = $_GET['offset'];
				$limit = $_GET['limit'];
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				$no = $offset+1;
				//$sql = "select * from tbl_login where nopes_siswa LIKE '%".$katakunci."%' LIMIT ".$limit." OFFSET ".$offset;
				$sql = "select *,TL.nopes_siswa,TS.nopes_siswa
				from tbl_login TL,tbl_siswa TS
				Where TL.nopes_siswa = TS.nopes_siswa AND TS.nama_siswa LIKE '%".$katakunci."%' LIMIT ".$limit." OFFSET ".$offset;
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
					echo "<td>".$no."</td>";
					echo "<td>".$res['nopes_siswa']."</td>";

					$sqlNama = mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$res['nopes_siswa']."'");
					$resNama = mysqli_fetch_array($sqlNama);
					echo "<td>".$resNama['nama_siswa']."</td>";

					$sqlKelas = mysqli_query($con,"select * from tbl_kelas where id_kelas='".$resNama['id_kelas']."'");
					$resKelas = mysqli_fetch_array($sqlKelas);
					echo "<td>".$resKelas['nama_kelas']."</td>";

					echo "<td>".$res['waktu_login']."</td>";
					if($res['status_login'] == 1){
						$stat = "Aktif";
					}else{
						$stat = "Non Aktif";
					}
					echo "<td>".$stat."</td>";

					if($res['status_login'] == 0){
						echo "<td></td>";
					}else{
						echo "<td><a href='data/data_status_reset.php?id=".$res['id_login']."' style='margin:2px;border:1px solid #ccc;padding:5px;border-radius:5px;background-color:red;color:#fff;'>RESET</a></td>";
					}

					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>