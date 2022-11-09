<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				
		</script>
	</head>
<body>

	<div class="box2">
		<b>Administrasi / Import Siswa</b>
		<br><br><br>
		<a href="files/templateImportSiswa.xls" class="buttonOrange" style="font-size: 13px;"><img style="margin-right: 5px;" src="images/download.png">Download Template</a>
		<br><br>
		<form action="data/data_siswa_import.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="fileSiswa" class="input">
			<br><br>
			<input type="submit" value="UPLOAD" class="button" name="submit">
		</form>
	</div>
	
</body>
</html>