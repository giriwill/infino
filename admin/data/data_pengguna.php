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
				<th>Nama Pengguna</th>
				<th>Level</th>
				<th width="10">Command</th>
			</tr>
			<?php
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				$no = 1;
				$sql = "select * from tbl_user where username LIKE '%".$katakunci."%' ";
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['username']."</td>";
						if($res['level'] == 1){
							echo "<td>Admin</td>";
						}else{
							echo "<td>Guru</td>";
						}		
						echo "<td><a href='?pages=pengguna_edit&id=".$res['id_user']."'><img src=images/pencil.png></a>";?>
							&nbsp <a href="data/data_pengguna_delete.php?id=<?php echo $res['id_user']?>" onclick="return confirm('Anda yakin akan menghapus ini ?')"><img src=images/trash.png></a></td>
						<?php
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>