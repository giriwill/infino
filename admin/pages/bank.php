<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				var limit = 40;
				var flag = 0;

				if(flag <= 0){
			    	$("#btnPrev").hide();
			    }else{
			    	$("#btnPrev").show();
			    }

			    var katakunci = $("#search").val();
			    $(".loadon").load("data/data_bank.php?katakunci="+katakunci+"&offset=0&limit="+limit);
			    //flag += limit;

			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_bank.php?katakunci="+katakunci+"&offset=0&limit="+limit);			    	
			    });

			    $("#btnNext").click(function(){
			    	flag += limit;
			    	$(".loadon").load("data/data_bank.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);			    	
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });			    

			    $("#btnPrev").click(function(){
			    	flag -= limit;
			    	$(".loadon").load("data/data_bank.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);		
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
			    	var mapel = $("#mapel").val();
			    	var jmlOpsi = $("#jmlOpsi").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_bank_add.php",
			            data:{
			                'kode' : kode,
			                'mapel' : mapel,
			                'jmlOpsi' : jmlOpsi
			            },
			            success : function(data){
			                //$('.loadon').load(data);
			                $(".loadon").load("data/data_bank.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);
			                $(".modalTambah").hide();
			                alert("Penambahan Bank Soal Telah Berhasil");
			                $(".bloker").hide();
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<b>Bank Soal</b>
		<br><br><br>
		<input type="text" class="input" id="search" placeholder="Search Kode">
		&nbsp
		<button class="button" id="btnTambah"><img style="margin-right: 5px;" src="images/plus.png">Tambah Bank Soal</button>
		<br><br>
		<div class="loadon"></div>
		<br>
		<button class="button" id="btnPrev">Prev</button> &nbsp <button class="button" id="btnNext">Next</button>
	</div>

	<div class="modalTambah">
		<table border="0" cellspacing="10" width="100%">
			<tr>
				<td><input type="text" id="kode" class="input" placeholder="Kode Bank Soal" style="width: 50%;"></td>
			</tr>
			<tr>
				<td>
					<select class="input" id="mapel">
					<?php
						$sqlMapel = "select * from tbl_mapel";
						$queryMapel = mysqli_query($con,$sqlMapel);
						while($dataMapel = mysqli_fetch_array($queryMapel)){
							echo "<option value='".$dataMapel['id_mapel']."'>".$dataMapel['nama_mapel']."</option>";
						}
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="text" id="jmlOpsi" class="input" placeholder="Jumlah Opsi Soal" style="width: 50%;"></td>
			</tr>
			<tr>
				<td><button class="button" id="btnMulaiTambah">TAMBAH</button>&nbsp<button class="button" id="btnCancelTambah">CANCEL</button></td>
			</tr>
		</table>
	</div>
	<div class="bloker"></div>
</body>
</html>