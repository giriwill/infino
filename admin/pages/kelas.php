<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				$(".bloker").hide();
			    var katakunci = $("#search").val();
			    $(".loadon").load("data/data_kelas.php?katakunci="+katakunci);

			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_kelas.php?katakunci="+katakunci);			    	
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
			    	var nama = $("#nama").val();
			    	var rombel = $("#rombel").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_kelas_add.php",
			            data:{
			                'nama' : nama,
			                'rombel' : rombel
			            },
			            success : function(data){
			                //$('.loadon').load(data);
			                $(".loadon").load("data/data_kelas.php?katakunci="+katakunci);
			                $(".modalTambah").hide();
			                alert("Penambahan Kelas Telah Berhasil");
			                $(".bloker").hide();
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<b>Data Pengguna / Kelas</b>
		<br><br><br>
		<input type="text" class="input" id="search" placeholder="Search">
		&nbsp
		<button class="button" id="btnTambah"><img style="margin-right: 5px;" src="images/plus.png">Tambah Kelas</button>
		&nbsp
		<a href="data/data_kelas_export.php" class="buttonOrange" style="font-size: 13px;"><img style="margin-right: 5px;" src="images/download.png">Download ID Kelas</a>
		<br><br>
		<div class="loadon"></div>
	</div>

	<div class="modalTambah">
		<table border="0" cellspacing="10" width="100%">
			<tr>
				<td><input type="text" id="nama" class="input" placeholder="Nama Kelas" style="width: 100%"></td>
			</tr>
			<tr>
				<td>
					<select id="rombel" class="input">
						<?php
							$sql = mysqli_query($con,"select * from tbl_jurusan");
							while($res = mysqli_fetch_array($sql)){
								echo "<option value='".$res['id_jurusan']."'>".$res['nama_jurusan']."</option>";
							}
						?>
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