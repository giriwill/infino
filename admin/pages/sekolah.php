<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
clearstatcache();
?>
<!DOCTYPE html>
<html>
	<head>

	</head>
<body>
	<?php
		$sql = "select * from tbl_sekolah";
		$query = mysqli_query($con,$sql);
		$data = mysqli_fetch_array($query);
	?>
	<div class="box2">
		<b>Data Sekolah / Administratif</b>
		<br><br><br>
		<form action="data/data_sekolah_edit.php" method="POST"  enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>Identitas Sekolah</th>
			</tr>
			<tr>
				<input type="hidden" name="id" value="<?php echo $data['id_sekolah'];?>">
				<td><input type="text" name="kode" class="input" placeholder="Kode Sekolah" value="<?php echo $data['kode_sekolah']?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="nama" class="input" placeholder="Nama Sekolah" value="<?php echo $data['nama_sekolah']?>"></td>
			</tr>
			<tr>
				<td><textarea name="alamat" class="input" placeholder="Alamat Sekolah" rows="5" cols="50"><?php echo $data['alamat_sekolah']?></textarea></td>
			</tr>
			<tr>
				<td>
					<img src="images/logosekolah.png" style="width: 100px;">
					<figcaption style="font-size: 12px;">Logo Sekolah</figcaption>
				</td>
			</tr>
			<tr>
				<td><input type="file" name="logo" class="input" value="UPLOAD"> {Ekstensi LOGO harus .png, Max 1Mb}</td>
			</tr>
			<tr>
				<td><input type="text" name="slogan" class="input" placeholder="Selogan Sekolah" value="<?php echo $data['slogan_sekolah']?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="kepsek" class="input" placeholder="Nama Kepala Sekolah" value="<?php echo $data['kepala_sekolah']?>"></td>
			</tr>
			<tr>
				<td><input type="text" name="nip" class="input" placeholder="NIP Kepala Sekolah" value="<?php echo $data['nip_kepsek']?>"></td>
			</tr>
			<tr>
				<td><input type="number" name="ruang" class="input" placeholder="Jumlah Ruang Ujian" value="<?php echo $data['jml_ruang']?>" style="width: 80px;"> Jumlah Ruang</td>
			</tr>
			<tr>
				<td><input type="number" name="hari" class="input" placeholder="Jumlah Hari Ujian" value="<?php echo $data['jml_hari']?>" style="width: 80px;"> Jumlah Hari</td>
			</tr>
			<tr>
				<td>
					<img src="../images/background.jpg" style="width: 100px;">
					<figcaption style="font-size: 12px;">Background LOGIN</figcaption>
				</td>
			</tr>
			<tr>
				<td><input type="file" name="gbrLogin" class="input" value="UPLOAD"> {Ekstensi Gambar harus .jpg | Dimensi ideal : 2000px x 1283px | Max 1Mb}</td>
			</tr>
			<tr>
				<td>
					<img src="images/imagebarinfino.jpg" style="width: 100px;">
					<figcaption style="font-size: 12px;">Background SideBar Admin</figcaption>
				</td>
			</tr>
			<tr>
				<td><input type="file" name="gbrSide" class="input" value="UPLOAD"> {Ekstensi Gambar harus .jpg | Dimensi ideal : 750px x 860px | Max 1Mb}</td>
			</tr>
		</table>
		<br>
		<input type="submit" class="button" value="Simpan">
		</form>
	</div>
</body>
</html>