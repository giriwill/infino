<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			    $("#btnEdit").click(function(){
			    	var kode = $("#kode").val();
			    	var mapel = $("#mapel").val();
			    	var jmlOpsi = $("#jmlOpsi").val();
			    	var id = $("#id").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_bank_edit.php",
			            data:{
			                'kode' : kode,
			                'mapel' : mapel,
			                'jmlOpsi' : jmlOpsi,
			                'id' : id
			            },
			            success : function(data){            	
			                alert("Perubahan Bank Soal Telah Berhasil");
			                location.replace("?pages=bank");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<?php
			$sql = "select * from tbl_bank_soal where id_bank_soal='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			$data = mysqli_fetch_array($query);
		?>
		<b>Edit Bank Soal</b>
		<br><br>
		<table class="table">
			<tr>
				<th>Kode</th>
				<th>Mata Pelajaran</th>
				<th>Jumlah Opsi</th>
				<th width="10">Command</th>
			</tr>
			<tr>
				<input type="hidden" id="id" value="<?php echo $data['id_bank_soal'];?>">
				<td><input type="text" id="kode" class="input" style="width: 100%;" value="<?php echo $data['kode_bank_soal'];?>"></td>
				<td>
					<select class="input" id="mapel">
						<?php
							$sqlMapel = "select * from tbl_mapel";
							$queryMapel = mysqli_query($con,$sqlMapel);
							while($restMapel = mysqli_fetch_array($queryMapel)){
								echo "<option value='$restMapel[id_mapel]'>$restMapel[nama_mapel]</option>";
							}
						?>
					</select>
				</td>
				<td><input type="text" id="jmlOpsi" class="input" style="width: 100%;" value="<?php echo $data['jml_opsi'];?>"></td>
				<td width="200px">		
					<button class="button" id="btnEdit"><img style="margin-right: 5px;" src="images/pencil.png">Edit Kelas</button>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>