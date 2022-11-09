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
				<th>Nama Group</th>
				<th>Nama Ujian</th>
				<th>Jumlah Anggota</th>
				<th width="10">Command</th>
			</tr>
			<?php
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}

				function cekUjian($id){
					include("../db.php");
					$sql = mysqli_query($con,"select * from tbl_ujian where kode_ujian='".$id."'");
					return $res = mysqli_fetch_array($sql)['kode_ujian'];
				}

				$no = 1;
				$sql = "select * from tbl_group where nama_group LIKE '%".$katakunci."%' ";
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					//jumlah anggota
						$sql = mysqli_query($con,"select (grup) from tbl_group where id_group='".$res['id_group']."'");
						$mentah = mysqli_fetch_array($sql)['grup'];
						$Anggota = strlen($mentah);
						if($Anggota > 0){
							$deret = explode(",", $mentah);
							$jmlAnggota = count($deret);
						}else{
							$jmlAnggota = "0 ";
						}
					//jumlah anggota
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['nama_group']."</td>";
						echo "<td>".cekUjian($res['kode_ujian'])."</td>";
						echo "<td>".$jmlAnggota." Siswa</td>";
						echo "<td><a href='dashboard.php?pages=list&id=".$res['id_group']."'><img width='20px' src=images/group.png></a> &nbsp <a href='?pages=group_edit&id=".$res['id_group']."'><img src=images/pencil.png></a>";?>
							&nbsp <a href="data/data_group_delete.php?id=<?php echo $res['id_group']?>" onclick="return confirm('Anda yakin akan menghapus ini ?')"><img src=images/trash.png></a></td>
						<?php
					echo "</tr>";
					$no++;
				}
			?>
		</table>
		<?php
		//celar cek di tabel siswa
			$sqlClear = mysqli_query($con,"UPDATE tbl_siswa SET cek='' ");
			if($sqlClear){
				echo '<script type="text/javascript"> berhasil(); </script>';
			}else{
				echo '<script type="text/javascript"> gagal(); </script>';
			}
		?>
</body>
</html>