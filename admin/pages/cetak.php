<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				$("#btnNilai").click(function(){
					$(".bloker").show();
				});
				$("#cancelPrint").click(function(){
					$(".bloker").hide();
				});
				$("#btnJadwal").click(function(){
					$(".blokerJadwal").show();
				});
				$("#cancelJadwal").click(function(){
					$(".blokerJadwal").hide();
				});
				$("#btnExport").click(function(){
					$(".blokerExport").show();
				});
				$("#cancelExport").click(function(){
					$(".blokerExport").hide();
				});
				$("#btnExportJawaban").click(function(){
					$(".blokerExportJawaban").show();
				});
				$("#cancelExportJawaban").click(function(){
					$(".blokerExportJawaban").hide();
				});
			});			
		</script>
		<style>
			.boxPrint{
				width: 200px;
				height: 280px;
				margin:10px;
				border:1px solid #ccc;
				border-radius: 5px;
				float: left;
				text-align: center;
			}
			.isiBloker{
				width: 30%;
				min-height: 50px;
				margin:100px auto auto auto;
				left: 0;
				right: 0;
				background-color: #fff;
				padding:20px;
				border-radius: 3px;
			}
			#cancelPrint{
				cursor: pointer;
				position: absolute;
				display: block;
				margin:auto;
			}
			#cancelJadwal{
				cursor: pointer;
				position: absolute;
				display: block;
				margin:auto;
			}
			#cancelExport{
				cursor: pointer;
				position: absolute;
				display: block;
				margin:auto;
			}
			#cancelExportJawaban{
				cursor: pointer;
				position: absolute;
				display: block;
				margin:auto;
			}
			.blokerJadwal{
				display: none;
				position: fixed;
				left: 0px;
				top: 0px;
				width:100%;
				height:100%;
				text-align:center;
				z-index: 100;
				background-color: rgba(0, 0, 0, 0.6);
			}.blokerExport{
				display: none;
				position: fixed;
				left: 0px;
				top: 0px;
				width:100%;
				height:100%;
				text-align:center;
				z-index: 100;
				background-color: rgba(0, 0, 0, 0.6);
			}.blokerExportJawaban{
				display: none;
				position: fixed;
				left: 0px;
				top: 0px;
				width:100%;
				height:100%;
				text-align:center;
				z-index: 100;
				background-color: rgba(0, 0, 0, 0.6);
			}
		</style>
	</head>
<body>

	<div class="box2">
		<b>Cetak Laporan</b>
		<br><br><br>
		<div class="boxPrint">
			<h4>Cetak Kartu Peserta</h4>
			<img src="images/card.png"><br><br>
			<a href="data/data_cetak_kartu.php" class="buttonHijau" style="font-size: 13px;">CETAK</a>
		</div>
		<div class="boxPrint">
			<h4>Cetak Jadwal Ujian</h4>
			<img src="images/calendar.png"><br><br>
			<button id="btnJadwal" class="buttonHijau" style="font-size: 13px;">CETAK</button>
		</div>
		<div class="boxPrint">
			<h4>Cetak Hasil Ujian</h4>
			<img src="images/test2.png"><br><br>
			<button id="btnNilai" class="buttonHijau" style="font-size: 13px;">CETAK</button>			
		</div>
		<div class="boxPrint">
			<h4>Export Hasil Ujian</h4>
			<img src="images/excel-big.png"><br><br>
			<button id="btnExport" class="buttonHijau" style="font-size: 13px;">EXPORT</button>
		</div>		
		<div class="boxPrint">
			<h4>Export Jawaban Siswa</h4>
			<img src="images/excel-big.png"><br><br>
			<button id="btnExportJawaban" class="buttonHijau" style="font-size: 13px;">EXPORT</button>
		</div>
	</div>
	<div class="bloker">
		<div class="isiBloker">
			<span id="cancelPrint"><img src="images/cancel.png"></span>
			<form action="data/data_cetak_nilai.php" method="POST">
				<select name="idUjian" class="input">
					<option>PILIH KODE UJIAN</option>
					<?php
					$sqlUjian = mysqli_query($con,"select * from tbl_ujian");
					while($resUjian = mysqli_fetch_array($sqlUjian)){
						echo "<option value='".$resUjian['id_ujian']."'>".$resUjian['kode_ujian']."</option>";
					}
					?>
				</select><br><br>
			<input type="text" name="ruang" class="input" placeholder="Ruang (Contoh : Ruang 1)">
			<br><br>
			<input type="submit" value="CETAK SEKARANG" class="buttonHijau">
			</form>			
		</div>
	</div>
	<div class="blokerJadwal">
		<div class="isiBloker">
			<span id="cancelJadwal"><img src="images/cancel.png"></span>
			<form action="data/data_cetak_jadwal.php" method="POST" enctype="multipart/form-data">
			<a href="files/templateImportJadwal.xls" class="buttonOrange" style='font-size:15px;'>DOWNLOAD TEMPLATE</a><br><br>
			<input type="file" name="fileImport" class="input"><br><br>
			<input type="text" name="namaUjian" class="input" placeholder="Nama Ujian"><br><br>
			<input type="text" name="titiMangsa" class="input" placeholder="Titi Mangsa"><br><br>
			<input type="submit" value="CETAK SEKARANG" class="buttonHijau" name="submit">
			</form>			
		</div>
	</div>
	<div class="blokerExport">
		<div class="isiBloker">
			<span id="cancelExport"><img src="images/cancel.png"></span>
			<form action="data/data_export_nilai.php" method="POST">
				<select name="idUjian" class="input">
					<option>PILIH KODE UJIAN</option>
					<?php
					$sqlUjian = mysqli_query($con,"select * from tbl_ujian");
					while($resUjian = mysqli_fetch_array($sqlUjian)){
						echo "<option value='".$resUjian['id_ujian']."'>".$resUjian['kode_ujian']."</option>";
					}
					?>
				</select><br><br>
			<input type="text" name="ruang" class="input" placeholder="Ruang (Contoh : Ruang 1)">
			<br><br>
			<input type="submit" value="EXPORT SEKARANG" class="buttonHijau">
			</form>			
		</div>
	</div>
	<div class="blokerExportJawaban">
		<div class="isiBloker">
			<span id="cancelExportJawaban"><img src="images/cancel.png"></span>
			<form action="data/data_export_jawaban.php" method="POST">
				<select name="idUjian" class="input">
					<option>PILIH KODE UJIAN</option>
					<?php
					$sqlUjian = mysqli_query($con,"select * from tbl_ujian");
					while($resUjian = mysqli_fetch_array($sqlUjian)){
						echo "<option value='".$resUjian['id_ujian']."'>".$resUjian['kode_ujian']."</option>";
					}
					?>
				</select><br><br>
			<input type="text" name="ruang" class="input" placeholder="Ruang (Contoh : Ruang 1)">
			<br><br>
			<select name="jenisSoal" class="input">
					<option>PILIH JENIS SOAL</option>
					<option value="1">PILIHAN GANDA</option>
					<option value="2">ESSAY</option>					
				</select>
			<br><br>
			<input type="submit" value="EXPORT SEKARANG" class="buttonHijau">
			</form>			
		</div>
	</div>
</body>
</html>