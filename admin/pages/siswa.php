<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				var limit = 30;
				var flag = 0;

				if(flag <= 0){
			    	$("#btnPrev").hide();
			    }else{
			    	$("#btnPrev").show();
			    }

			    var katakunci = $("#search").val();
			    $(".loadon").load("data/data_siswa.php?katakunci="+katakunci+"&offset=0&limit="+limit);
			    //flag += limit;

			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_siswa.php?katakunci="+katakunci+"&offset=0&limit="+limit);			    	
			    });

			    $("#btnNext").click(function(){
			    	flag += limit;
			    	$(".loadon").load("data/data_siswa.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);			    	
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });			    

			    $("#btnPrev").click(function(){
			    	flag -= limit;
			    	$(".loadon").load("data/data_siswa.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);		
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });
			    $(".bloker").hide();
			    $("#btnTambah").click(function(){
			    	$(".modalTambah").show();
			    	$(".bloker").show();
			    });
			    $("#btnCancelTambah").click(function(){
			    	$(".modalTambah").hide();
			    	$(".bloker").hide();
			    });

			    $("#btnMulaiTambah").click(function(){
			    	var nopes = $("#nopes").val();
			    	var nama = $("#nama").val();
			    	var kelas = $("#kelas").val();
			    	var password = $("#password").val();
			    	var sesi = $("#sesi").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_siswa_add.php",
			            data:{
			                'nopes' : nopes,
			                'nama' : nama,
			                'password' : password,
			                'kelas' : kelas,
			                'sesi' : sesi
			            },
			            success : function(data){
			                //$('.loadon').load(data);
			                $(".loadon").load("data/data_siswa.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);
			                $(".modalTambah").hide();
			                alert("Penambahan Siswa Telah Berhasil");
			                $(".bloker").hide();
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<b>Administrasi / Siswa</b>
		<br><br><br>
		<input type="text" class="input" id="search" placeholder="Search Nama Peserta">
		&nbsp
		<button class="button" id="btnTambah"><img style="margin-right: 5px;" src="images/plus.png">Tambah Siswa</button>
		&nbsp
		<a href="?pages=siswa_import" class="button" style="font-size: 13px;"><img style="margin-right: 5px;" src="images/excel.png">Import Siswa</a>
		&nbsp
		<a href="data/data_siswa_remove.php" class="button" style="font-size: 13px;background-color: red;" onclick="return confirm('Anda yakin akan menghapus semua data Siswa ?, Ini akan mengakibatkan semua data LOGIN dan Status siswa terhapus dari database !')">Hapus Semua Siswa</a>
		<br><br>
		<div class="loadon"></div>
		<br>
		<button class="button" id="btnPrev">Prev</button> &nbsp <button class="button" id="btnNext">Next</button>
	</div>

	<div class="modalTambah">
		<table border="0" cellspacing="10" width="100%">
			<tr>
				<td><input type="text" id="nopes" class="input" placeholder="Nomor Peserta" style="width: 100%"></td>
			</tr>
			<tr>
				<td><input type="text" id="nama" class="input" placeholder="Nama Peserta" style="width: 100%"></td>
			</tr>
			<tr>
				<td><input type="text" id="password" class="input" placeholder="Password Peserta" style="width: 100%"></td>
			</tr>
			<tr>
				<td><input type="number" id="sesi" class="input" placeholder="Kelompok Peserta" style="width: 100%"></td>
			</tr>
			<tr>
				<td>
					<select id="kelas" class="input">
					<?php
						$sql = "select * from tbl_kelas";
						$query = mysqli_query($con,$sql);
						while($data = mysqli_fetch_array($query)){
							?>
								<option value="<?php echo $data['id_kelas']?>"><?php echo $data['nama_kelas'];?></option>
							<?php
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