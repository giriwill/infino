<!DOCTYPE html>
<html>
	<head>
	</head>
<body>

	<div class="box2">
		<b>Backup / Restore</b>
		<br><br><br>
		<a href="data/data_bares_backup.php" class="buttonHijau" style="font-size: 13px;"><img style="margin-right: 5px;" src="images/download.png">Backup Database</a>
		<br><br>
		<a href="data/data_bares_hapus.php" class="buttonOrange" style="font-size: 13px;" onclick="return confirm('Anda yakin akan menghapus Seluruh Database ?')"><img style="margin-right: 5px;" src="images/trash.png">Hapus Database</a>	
		<label style="color:red;font-size: 12px;">Pastikan Anda Sudah Menghapus Database Sebelum Restore</label>	
		<br><br>
		<?php
		$jmlSiswa = mysqli_num_rows(mysqli_query($con,"select * from tbl_siswa"));
		$jmlKelas = mysqli_num_rows(mysqli_query($con,"select * from tbl_kelas"));
		$jmlJurusan = mysqli_num_rows(mysqli_query($con,"select * from tbl_jurusan"));
		if($jmlSiswa <= 0 && $jmlKelas <= 0 && $jmlJurusan <= 0){
		?>
		Restore Database<br>
		<form action="data/data_bares_restore.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="dataBackup" class="input" required="">
			&nbsp &nbsp
			<input type="submit" value="RESTORE NOW" class="button" name="submit">
		</form>
		<?php
		}
		?>
	</div>
	
</body>
</html>