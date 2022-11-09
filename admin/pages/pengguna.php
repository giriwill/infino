<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				$(".bloker").hide();
			    var katakunci = $("#search").val();
			    $(".loadon").load("data/data_pengguna.php?katakunci="+katakunci);
			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_pengguna.php?katakunci="+katakunci);			    	
			    });
			    $("#btnTambah").click(function(){
			    	$(".modalTambah").show();
			    	$(".bloker").show();
			    });
			    $("#btnCancelTambah").click(function(){
			    	$(".modalTambah").hide();
			    	$(".bloker").hide();
			    });

			    $("#btnMulaiTambah").click(function(){
			    	var username = $("#username").val();
			    	var password = $("#password").val();
			    	var level = $("#level").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_pengguna_add.php",
			            data:{
			                'username' : username,
			                'password' : password,
			                'level' : level
			            },
			            success : function(data){
			                //$('.loadon').load(data);
			                $(".loadon").load("data/data_pengguna.php?katakunci="+katakunci);
			                $(".modalTambah").hide();
			                alert("Penambahan Pengguna Telah Berhasil");
			                $(".bloker").hide();
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<b>Data Pengguna / Administratif</b>
		<br><br><br>
		<input type="text" class="input" id="search" placeholder="Search">
		&nbsp
		<button class="button" id="btnTambah"><img style="margin-right: 5px;" src="images/plus.png">Tambah Pengguna</button>
		<br><br>
		<div class="loadon"></div>
	</div>

	<div class="modalTambah">
		<table border="0" cellspacing="10" width="100%">
			<tr>
				<td><input type="text" id="username" class="input" placeholder="Username" style="width: 100%"></td>
			</tr>
			<tr>
				<td><input type="Password" id="password" class="input" placeholder="Password" style="width: 100%"></td>
			</tr>
			<tr>
				<td>
					<select id="level" class="input" style="width: 100%">
						<option value="1">Admin</option>
						<option value="2">Guru</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><button class="button" id="btnMulaiTambah">TAMBAH</button>&nbsp<button class="button" id="btnCancelTambah">CANCEL</button></td>
			</tr>
		</table>
	</div>
	
	<div class="bloker"></div>
</body>
</html>