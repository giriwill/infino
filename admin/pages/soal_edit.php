<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				var jenisSoal = $("#jenisSoal").val();
				if(jenisSoal == 1){
					$("#blokPG").show();
					$("#blokEssay").hide();
				}else{
					$("#blokPG").hide();
					$("#blokEssay").show();
				}
				
				
			});			
		</script>
		
	</head>
<body>
	<?php
	
	?>

	<?php
		mysqli_set_charset($con,'utf8');
		$sqlJenis = mysqli_query($con,"select * from tbl_soal where id_soal = '".$_GET['id']."'");
		$resJenis = mysqli_fetch_array($sqlJenis);
		if($resJenis['jenis_soal'] == 1){
			echo "<input type='hidden' id='jenisSoal' value='1'>";
		}else{			
			echo "<input type='hidden' id='jenisSoal' value='2'>";
		}

		function cekRadio($kunci){
			include("db.php");
			$sqlCek = mysqli_query($con,"select * from tbl_soal where id_soal = '".$_GET['id']."'");
			$resCek = mysqli_fetch_array($sqlCek);
			if($kunci == $resCek['kunciopt_soal']){
				return "checked";
			}
		}
	?>
	<div class="box2">
		<b>Edit Soal</b>
		<br><br><br>
		<form action="data/data_soal_edit.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
		<div id="blokSoal">
		<?php
		$sqlAcak = mysqli_query($con,"select * from tbl_");
		?>
		Acak Soal :<br>
		<select name="acak" class="input">
			<option value="1">Acak</option>
			<option value="0">Tidak Diacak</option>
		</select>
		<br><br>			
		Deskripsi Soal :
		<textarea class="ckeditor" id="ckedtor" name="des"><?php echo $resJenis['des_soal'];?></textarea>
		<br>
		<table border="0" class="table">
			<tr>
				<td width="10%">Upload Audio :</td>
				<td><input type="file" name="audio" class="input"></td>
			</tr>
		</table>		
		<br>
		</div>
		<div id="blokPG">
		Acak Opsi :<br>
		<select name="acakOpsi" class="input">
			<option value="1">Acak</option>
			<option value="0">Tidak Diacak</option>
		</select>
		<br><br>
		<table border="0" class="table">
			<tr>
				<td width="10%">Pilihan A <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt1_soal" <?php echo cekRadio("opt1_soal");?>></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiA"><?php echo $resJenis['opt1_soal'];?></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan B <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt2_soal" <?php echo cekRadio("opt2_soal");?>></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiB"><?php echo $resJenis['opt2_soal'];?></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan C <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt3_soal" <?php echo cekRadio("opt3_soal");?>></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiC"><?php echo $resJenis['opt3_soal'];?></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan D <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt4_soal" <?php echo cekRadio("opt4_soal");?>></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiD"><?php echo $resJenis['opt4_soal'];?></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan E <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt5_soal" <?php echo cekRadio("opt5_soal");?>></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiE"><?php echo $resJenis['opt5_soal'];?></textarea></td>
			</tr>
		</table>
		</div>
		<div id="blokEssay">
		<table class="table">
			<tr>
				<td width="10%">Kunci Jawaban Essay</td>
				<td><textarea class="ckeditor" id="ckedtor" name="kunciEssay"><?php echo $resJenis['kunciessay_soal'];?></textarea></td>
			</tr>
		</table>
		<br>
		</div>
		<input type="submit" value="Ubah Soal" class="button" name="upload">
		</form>
	</div>

</body>
</html>