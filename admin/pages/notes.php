<?php
//include("../db.php");
?>
<!DOCTYPE html>
<html>
	<head>
	</head>
<body>

	<div class="box2">
		<b>Notes</b>
		<br><br><br>
		*Notes adalah pengumuman yang akan muncul ketika siswa memilih perangkat di awal kegiatan ujian<br><br>
		Silahkan Update Notes Jika Diperlukan :<br><br>
		<form action="data/data_notes.php" method="POST">
			<textarea class="ckeditor" cols="70%" rows="10" name="notes" style="padding:10px;">
				<?php
				$sql = "select * from tbl_notes where id_notes = '1'";
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo $res['notes'];
				}
				?>
			</textarea><br>
			<input type="submit" value="UBAH NOTES">
		</form>
	</div>
	
</body>
</html>