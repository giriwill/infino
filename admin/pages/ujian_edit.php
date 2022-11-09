<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			    $("#btnEdit").click(function(){
			    	var kode = $("#kode").val();
			    	var lama = $("#lama").val();
			    	var id = $("#id").val();
			    	var lihatHasil = $("#lihatHasil").val();
			    	var lihatToken = $("#lihatToken").val();
			    	var timeMode = $("#timeMode").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_ujian_edit.php",
			            data:{
			                'kode' : kode,
			                'lama' : lama,
			                'lihatHasil' : lihatHasil,
			                'lihatToken' : lihatToken,
			                'timeMode' : timeMode,
			                'id' : id
			            },
			            success : function(data){            	
			                alert("Perubahan Data ujian Telah Berhasil");
			                location.replace("?pages=ujian");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<?php
			$sql = "select * from tbl_ujian where id_ujian='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			$data = mysqli_fetch_array($query);
		?>
		<b>Edit ujian / Administratif</b>
		<br><br>
		<table class="table">
			<tr>
				<th>Kode Ujian</th>
				<th>Lama Ujian</th>
				<th>Tampilkan Hasil</th>
				<th>Tampilkan Token</th>
				<th>Mode Waktu</th>
				<th width="10">Command</th>
			</tr>
			<tr>
				<input type="hidden" id="id" value="<?php echo $data['id_ujian'];?>">
				<td><input type="text" id="kode" class="input" style="width: 100%;" value="<?php echo $data['kode_ujian'];?>"></td>
				<td><input type="text" id="lama" class="input" style="width: 100%;" value="<?php echo $data['lama_ujian'];?>"></td>
				<td>
					<select id="lihatHasil" class="input">
						<option value="1">Siswa Bisa Lihat Nilai</option>
						<option value="0">Sembunyikan Nilai dari Siswa</option>
					</select>
				</td>
				<td>
					<select id="lihatToken" class="input">
						<option value="1">Siswa Bisa Lihat Token</option>
						<option value="0">Sembunyikan Token dari Siswa</option>
					</select>
				</td>
				<td>
					<select id="timeMode" class="input">
						<option value="1">Mode Waktu Server</option>
						<option value="0">Mode Waktu Client</option>
					</select>
				</td>
				<td width="200px">					
					<button class="button" id="btnEdit"><img style="margin-right: 5px;" src="images/pencil.png">Edit ujian</button>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>