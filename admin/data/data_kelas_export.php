<?php
session_start();
include("../db.php");
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=Daftar_ID_Kelas.xls")
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
		<table border="1">
			<tr>
				<th width="10">No.</th>
				<th>ID Kelas</th>
				<th>Nama Kelas</th>
				<th>urusan</th>
			</tr>
			
			<?php
				function jurusan($id){
					include("../db.php");
					$sql = mysqli_query($con,"select * from tbl_jurusan where id_jurusan='".$id."'");
					return $res = mysqli_fetch_array($sql)['nama_jurusan'];
				}
				$no = 1;
				$sql = "select * from tbl_kelas";
				$query = mysqli_query($con,$sql);
				while($data = mysqli_fetch_array($query)){
				?>
				<tr>
				<td><?php echo $no;?></td>
				<td><?php echo $data['id_kelas'];?></td>
				<td><?php echo $data['nama_kelas'];?></td>
				<td><?php echo jurusan($data['id_jurusan']);?></td>
				</tr>
				<?php
					$no++;
				}
				?>
			
		</table>
</body>
</html>