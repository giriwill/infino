<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			    $("#btnEdit").click(function(){
			    	var nama = $("#nama").val();
			    	var id = $("#id").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_jurusan_edit.php",
			            data:{
			                'nama' : nama,
			                'id' : id
			            },
			            success : function(data){            	
			                alert("Perubahan Jurusan Kelas Telah Berhasil");
			                location.replace("?pages=jurusan");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<?php
			$sql = "select * from tbl_jurusan where id_jurusan='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			$data = mysqli_fetch_array($query);
		?>
		<b>Edit Jurusan / Administratif</b>
		<br><br>
		<table class="table">
			<tr>
				<th>Nama Jurusan</th>
				<th width="10">Command</th>
			</tr>
			<tr>
				<input type="hidden" id="id" value="<?php echo $data['id_jurusan'];?>">
				<td><input type="text" id="nama" class="input" style="width: 100%;" value="<?php echo $data['nama_jurusan'];?>"></td>
				<td width="200px">					
					<button class="button" id="btnEdit"><img style="margin-right: 5px;" src="images/pencil.png">Edit Jurusan</button>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>