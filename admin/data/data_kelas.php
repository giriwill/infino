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
				<th>Nama Kelas</th>
				<th>Jurusan</th>
				<th width="10">Command</th>
			</tr>
			<?php
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				function cekJurusan($id){
					include("../db.php");
					$sql = mysqli_query($con,"select * from tbl_jurusan where id_jurusan='".$id."'");
					return $res = mysqli_fetch_array($sql)['nama_jurusan'];
				}

				$no = 1;
				$sql = "select * from tbl_kelas where nama_kelas LIKE '%".$katakunci."%' ";
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['nama_kelas']."</td>";
						echo "<td>".cekJurusan($res['id_jurusan'])."</td>";
						echo "<td><a href='?pages=kelas_edit&id=".$res['id_kelas']."'><img src=images/pencil.png></a>";?>
							&nbsp <a href="data/data_kelas_delete.php?id=<?php echo $res['id_kelas']?>" onclick="return confirm('Anda yakin akan menghapus ini ?')"><img src=images/trash.png></a></td>
						<?php
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>