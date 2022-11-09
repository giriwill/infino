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
				<th>Nama Mata Pelajaran</th>
				<th>KKM</th>
				<th>Jenis Mata Pelajaran</th>
				<th width="10">Command</th>
			</tr>
			<?php
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				$no = 1;
				$sql = "select * from tbl_mapel where nama_mapel LIKE '%".$katakunci."%' ";
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['nama_mapel']."</td>";
						echo "<td>".$res['kkm_mapel']."</td>";
						echo "<td>".$res['jenis_mapel']."</td>";
						echo "<td><a href='?pages=mapel_edit&id=".$res['id_mapel']."'><img src=images/pencil.png></a>";?>
							&nbsp <a href="data/data_mapel_delete.php?id=<?php echo $res['id_mapel']?>" onclick="return confirm('Anda yakin akan menghapus ini ?')"><img src=images/trash.png></a></td>
						<?php
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>