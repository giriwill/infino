<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				$("#blokPG").hide();
				$("#blokEssay").hide();
				$("#blokSoal").hide();

				$("#selectPIL").change(function(){
					var isi = $("#selectPIL").val();
					if(isi == 1){
						$("#blokPG").show();
						$("#blokEssay").hide();
						$("#blokSoal").show();
					}else if(isi == 2){
						$("#blokPG").hide();
						$("#blokEssay").show();
						$("#blokSoal").show();
					}else{
						$("#blokPG").hide();
						$("#blokEssay").hide();
						$("#blokSoal").hide();
					}
				});
				
			    $("#btnMulaiTambah").click(function(){
			    	var nopes = $("#nopes").val();
			    	var nama = $("#nama").val();
			    	var kelas = $("#kelas").val();
			    	var password = $("#password").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_soal_add.php",
			            data:{
			                'nopes' : nopes,
			                'nama' : nama,
			                'password' : password,
			                'kelas' : kelas
			            },
			            success : function(data){
			                //$('.loadon').load(data);
			                $(".loadon").load("data/data_soal.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);
			                $(".modalTambah").hide();
			                alert("Penambahan Siswa Telah Berhasil");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>
	<div class="box2">
		<b>Tambah Soal</b>
		<br><br><br>
		<form action="data/data_soal_add.php" method="POST" enctype="multipart/form-data">
		<a href="?pages=soal&id=<?php echo $_GET['id'];?>" class="button"><- Kembali Ke Soal</a><br><br>
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
		Jenis Soal : <br>
		<select name="jenis" class="input" id="selectPIL">
			<option value="0">-</option>
			<option value="1">Pilihan Ganda</option>
			<option value="2">Essay</option>
		</select>
		<br><br>
		<div id="blokSoal">
		Acak Soal :<br>
		<select name="acak" class="input">
			<option value="1">Acak</option>
			<option value="0">Tidak Diacak</option>
		</select>
		<br><br>
		Deskripsi Soal :
		<textarea class="ckeditor" id="ckedtor" name="des"></textarea>
		<br>
		<table border="0" class="table">
			<tr>
				<td width="10%">Upload Audio :</td>
				<td><input type="file" name="audio"></td>
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
				<td width="10%">Pilihan A <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt1_soal" checked></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiA"></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan B <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt2_soal"></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiB"></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan C <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt3_soal"></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiC"></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan D <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt4_soal"></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiD"></textarea></td>
			</tr>
			<tr>
				<td width="10%">Pilihan E <br><br> Jawaban Benar<input type="radio" name="kunci" value="opt5_soal"></td>
				<td><textarea class="ckeditor" id="ckedtor" name="opsiE"></textarea></td>
			</tr>
		</table>
		</div>
		<div id="blokEssay">
		<table class="table">
			<tr>
				<td width="10%">Kunci Jawaban Essay</td>
				<td><textarea class="ckeditor" id="ckedtor" name="kunciEssay"></textarea></td>
			</tr>
		</table>
		<br>
		</div>
		<input type="submit" value="Tambah Soal" class="button" name="upload">
		</form>
	</div>

</body>
</html>