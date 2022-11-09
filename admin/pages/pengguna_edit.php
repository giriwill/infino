<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			    $("#btnEdit").click(function(){
			    	var username = $("#username").val();
			    	var password = $("#password").val();
			    	var level = $("#level").val();
			    	var id = $("#id").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_pengguna_edit.php",
			            data:{
			                'username' : username,
			                'password' : password,
			                'level' : level,
			                'id' : id
			            },
			            success : function(data){            	
			                alert("Perubahan Data Pengguna Telah Berhasil");
			                location.replace("?pages=pengguna");
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<?php
			$sql = "select * from tbl_user where id_user='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			$data = mysqli_fetch_array($query);
		?>
		<b>Edit Pengguna / Administratif</b>
		<br><br>
		<table class="table">
			<tr>
				<th>Username</th>
				<th>Password</th>
				<th>Level</th>
				<th width="10">Command</th>
			</tr>
			<tr>
				<input type="hidden" id="id" value="<?php echo $data['id_user'];?>">
				<td><input type="text" id="username" class="input" style="width: 100%;" value="<?php echo $data['username'];?>"></td>
				<td><input type="text" id="password" class="input" style="width: 100%;"></td>
				<td>
					<select id="level" class="input" style="width: 100%">
						<option value="1">Admin</option>
						<option value="2">Guru</option>
					</select>					
				</td>
				<td width="200px">					
					<button class="button" id="btnEdit"><img style="margin-right: 5px;" src="images/pencil.png">Edit Pengguna</button>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>