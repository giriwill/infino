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
				<th>Password</th>
				<th>Kelompok</th>
				<th width="10">Command</th>
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
				$sql = "select * from tbl_siswa where nama_siswa LIKE '%".$katakunci."%' LIMIT ".$limit." OFFSET ".$offset;
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['nopes_siswa']."</td>";
						echo "<td>".$res['nama_siswa']."</td>";				
							$kelas = "select * from tbl_kelas where id_kelas='".$res['id_kelas']."'";
							$qkelas = mysqli_query($con,$kelas);
							$dkelas = mysqli_fetch_array($qkelas);
							echo "<td>".$dkelas['nama_kelas']."</td>";
						echo "<td>".$res['password_siswa']."</td>";
						echo "<td>".$res['kelompok_siswa']."</td>";
						echo "<td><a href='?pages=siswa_edit&id=".$res['id_siswa']."'><img src=images/pencil.png></a>";?>
							&nbsp <a href="data/data_siswa_delete.php?id=<?php echo $res['id_siswa']?>" onclick="return confirm('Anda yakin akan menghapus ini ?')"><img src=images/trash.png></a></td>
						<?php
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>