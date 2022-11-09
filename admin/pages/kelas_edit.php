<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			    $("#btnEdit").click(function(){
			    	var nama = $("#nama").val();
			    	var rombel = $("#rombel").val();
			    	var id = $("#id").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_kelas_edit.php",
			            data:{
			                'nama' : nama,
			                'rombel' : rombel,
			                'id' : id
			            },
			            success : function(data){            	
			                alert("Perubahan Data Kelas Telah Berhasil");
			                location.replace("?pages=kelas");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<?php
			$sql = "select * from tbl_kelas where id_kelas='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			$data = mysqli_fetch_array($query);

			function cekJurusan($id){					
					include("db.php");
					$sql = mysqli_query($con,"select * from tbl_jurusan where id_jurusan='".$id."'");
					return $res = mysqli_fetch_array($sql)['nama_jurusan'];
				}
		?>
		<b>Edit Kelas / Administratif</b>
		<br><br>
		<table class="table">
			<tr>
				<th>Nama Kelas</th>
				<th>Jurusan</th>
				<th width="10">Command</th>
			</tr>
			<tr>
				<input type="hidden" id="id" value="<?php echo $data['id_kelas'];?>">
				<td><input type="text" id="nama" class="input" style="width: 100%;" value="<?php echo $data['nama_kelas'];?>"></td>
				<td>
					<select id="rombel" class="input">
						<option value="<?php echo $data['id_jurusan'];?>"><?php echo cekJurusan($data['id_jurusan']);?></option>
						<?php
							$sqlJurusan = mysqli_query($con,"select * from tbl_jurusan where id_jurusan <> '".$data['id_jurusan']."'");
							while($res = mysqli_fetch_array($sqlJurusan)){
								echo "<option value='".$res['id_jurusan']."'>".$res['nama_jurusan']."</option>";
							}
						?>						
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