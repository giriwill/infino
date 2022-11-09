<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			    $("#btnEdit").click(function(){
			    	var nopes = $("#nopes").val();
			    	var nama = $("#nama").val();
			    	var kelas = $("#kelas").val();
			    	var password = $("#password").val();
			    	var sesi = $("#sesi").val();
			    	var id = $("#id").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_siswa_edit.php",
			            data:{
			                'nopes' : nopes,
			                'nama' : nama,
			                'kelas' : kelas,
			                'password' : password,
			                'sesi' : sesi,
			                'id' : id
			            },
			            success : function(data){            	
			                alert("Perubahan Data Siswa Telah Berhasil");
			                location.replace("?pages=siswa");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<?php
			$sql = "select * from tbl_siswa where id_siswa='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			$data = mysqli_fetch_array($query);
		?>
		<b>Edit Siswa / Administratif</b>
		<br><br>
		<table class="table">
			<tr>
				<th>Nomor Peserta</th>
				<th>Nama Peserta</th>
				<th>Kelas</th>
				<th>Password</th>
				<th>Kelompok</th>
				<th width="10">Command</th>
			</tr>
			<tr>
				<input type="hidden" id="id" value="<?php echo $data['id_siswa'];?>">
				<td><input type="text" id="nopes" class="input" style="width: 100%;" value="<?php echo $data['nopes_siswa'];?>"></td>
				<td><input type="text" id="nama" class="input" style="width: 100%;" value="<?php echo $data['nama_siswa'];?>"></td>
				<td>
					<select id="kelas" class="input">
						<?php
						$sqlCur = mysqli_query($con,"select * from tbl_kelas where id_kelas='".$data['id_kelas']."'");
						while($resCur = mysqli_fetch_array($sqlCur)){
							echo "<option value='".$resCur['id_kelas']."'>".$resCur['nama_kelas']."</option>";
						}

						$sqlKelas = mysqli_query($con,"select * from tbl_kelas where id_kelas<>'".$data['id_kelas']."'");
						while($resKelas = mysqli_fetch_array($sqlKelas)){
							echo "<option value='".$resKelas['id_kelas']."'>".$resKelas['nama_kelas']."</option>";
						}
						?>
					</select>
				</td>
				<td><input type="text" id="password" class="input" style="width: 100%;" value="<?php echo $data['password_siswa'];?>"></td>
				<td><input type="number" id="sesi" class="input" style="width: 100%;" value="<?php echo $data['kelompok_siswa'];?>"></td>
				<td width="200px">					
					<button class="button" id="btnEdit"><img style="margin-right: 5px;" src="images/pencil.png">Edit Kelas</button>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>