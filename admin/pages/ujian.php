<!DOCTYPE html>
<html>
<head>
	<script>
		$(document).ready(function(){
			var limit = 1000;
			var flag = 0;

			if(flag <= 0){
		    	$("#btnPrev").hide();
		    }else{
		    	$("#btnPrev").show();
		    }

		    var katakunci = $("#search").val();
		    $(".loadon").load("data/data_ujian.php?katakunci="+katakunci+"&offset=0&limit="+limit);
		    //flag += limit;

		    $("#search").keyup(function(){
		    	var katakunci = $("#search").val();
		    	$(".loadon").load("data/data_ujian.php?katakunci="+katakunci+"&offset=0&limit="+limit);			    	
		    });

		    $("#btnNext").click(function(){
		    	flag += limit;
		    	$(".loadon").load("data/data_ujian.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);			    	
		    	if(flag <= 0){
		    		$("#btnPrev").hide();
		    	}else{
		    		$("#btnPrev").show();
		    	}
		    });			    

		    $("#btnPrev").click(function(){
		    	flag -= limit;
		    	$(".loadon").load("data/data_ujian.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);		
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
		    	var kode = $("#kode").val();
		    	var bank = $("#bank").val();
		    	var jurusan = $("#jurusan").val();
		    	var lama = $("#lama").val();
		    	var sesi = $("#sesi").val();
		    	var lihatHasil = $("#lihatHasil").val();
		    	var lihatToken = $("#lihatToken").val();
		    	var timeMode = $("#timeMode").val();
		    	//alert(password);
		    	$.ajax({
		            type: "GET",
		            url: "data/data_ujian_add.php",
		            data:{
		                'kode' : kode,
		                'bank' : bank,
		                'jurusan' : jurusan,
		                'lama' : lama,
		                'sesi' : sesi,
		                'lihatHasil' : lihatHasil,
		                'lihatToken' : lihatToken,
		                'timeMode' : timeMode
		            },
		            success : function(data){
		                //$('.loadon').load(data);
		                $(".loadon").load("data/data_ujian.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);
		                $(".modalTambah").hide();
		                alert("Penambahan Data Ujian Telah Berhasil");
		                $(".bloker").hide();
		            }
		        });
		    });

		});			
	</script>
</head>
<body>

	<div class="box2">
		<b>Data Ujian</b>
		<br><br><br>
		<input type="text" class="input" id="search" placeholder="Search Nama Ujian">
		&nbsp
		<button class="button" id="btnTambah"><img style="margin-right: 5px;" src="images/plus.png">Tambah Jadwal Ujian</button>
		<br><br>
		<div class="loadon"></div>
		<br>
		<button class="button" id="btnPrev">Prev</button> &nbsp <button class="button" id="btnNext">Next</button>
	</div>

	<div class="modalTambah">
		<table border="0" cellspacing="10" width="100%">
			<tr>
				<td><input type="text" id="kode" class="input" placeholder="Kode Ujian (contoh: USBN-1,UAS-1,dsb)" style="width: 100%"></td>
			</tr>
			<tr>
				<td>
					<select id="bank" class="input">
						<option value="-">Pilih Bank Soal</option>
					<?php
					$sqlbank = mysqli_query($con,"select * from tbl_bank_soal");
					while($res = mysqli_fetch_array($sqlbank)){
						echo "<option value='".$res['id_bank_soal']."'>".$res['kode_bank_soal']."</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<select id="jurusan" class="input">
						<option value="-">Pilih Jurusan</option>
						<option value="0">Semua Jurusan</option>
					<?php
					$sqljurusan = mysqli_query($con,"select * from tbl_jurusan");
					while($resJurusan = mysqli_fetch_array($sqljurusan)){
						echo "<option value='".$resJurusan['id_jurusan']."'>".$resJurusan['nama_jurusan']."</option>";
					}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="number" id="lama" class="input" placeholder="Lama Ujian (Dalam Menit)" style="width: 100%"></td>
			</tr>
			<tr>
				<td><input type="number" id="sesi" class="input" placeholder="Kelompok (Dalam Angka)" style="width: 100%"></td>
			</tr>
			<tr>
				<td>
					<select id="lihatHasil" class="input">
						<option value="1">Siswa Bisa Lihat Nilai</option>
						<option value="0">Sembunyikan Nilai dari Siswa</option>
					</select>
					&nbsp
					<select id="lihatToken" class="input">
						<option value="1">Siswa Bisa Lihat Token</option>
						<option value="0">Sembunyikan Token dari Siswa</option>
					</select>
					&nbsp
					<select id="timeMode" class="input">
						<option value="1">Mode Waktu Server</option>
						<option value="0">Mode Waktu Client</option>
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