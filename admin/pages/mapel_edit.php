<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			    $("#btnEdit").click(function(){
			    	var nama = $("#nama").val();
			    	var kkm = $("#kkm").val();
			    	var jenis = $("#jenis").val();
			    	var id = $("#id").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_mapel_edit.php",
			            data:{
			                'nama' : nama,
			                'kkm' : kkm,
			                'jenis' : jenis,
			                'id' : id
			            },
			            success : function(data){            	
			                alert("Perubahan Data Mapel Telah Berhasil");
			                location.replace("?pages=mapel");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<?php
			$sql = "select * from tbl_mapel where id_mapel='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			$data = mysqli_fetch_array($query);
		?>
		<b>Edit Mapel / Administratif</b>
		<br><br>
		<table class="table">
			<tr>
				<th>Nama Mata Pelajaran</th>
				<th>KKM</th>
				<th>Jenis Mata Pelajaran</th>
				<th width="10">Command</th>
			</tr>
			<tr>
				<input type="hidden" id="id" value="<?php echo $data['id_mapel'];?>">
				<td><input type="text" id="nama" class="input" style="width: 100%;" value="<?php echo $data['nama_mapel'];?>"></td>
				<td><input type="text" id="kkm" class="input" style="width: 100%;" value="<?php echo $data['kkm_mapel'];?>"></td>
				<td>
					<select class="input" id="jenis">
						<option value="peminatan">Peminatan</option>
						<option value="pilihan A">pilihan A</option>
						<option value="pilihan B">pilihan B</option>
						<option value="lainnya">Lainnya</option>
					</select>
				</td>
				<td width="200px">					
					<button class="button" id="btnEdit"><img style="margin-right: 5px;" src="images/pencil.png">Edit Kelas</button>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>