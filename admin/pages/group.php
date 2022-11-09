<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				$(".bloker").hide();				
				$(".modalList").hide();
			    var katakunci = $("#search").val();
			    $(".loadon").load("data/data_group.php?katakunci="+katakunci);

			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_group.php?katakunci="+katakunci);			    	
			    });
			    $("#btnTambah").click(function(){
			    	$(".modalTambah").show();
			    	$(".bloker").show();
			    });
			    $("#btnList").click(function(){
			    	$(".modalTambah").show();
			    	$(".bloker").show();
			    });
			    $("#btnCancelTambah").click(function(){
			    	$(".modalTambah").hide();
			    	$(".bloker").hide();
			    });

			    $(".bloker").click(function(){
			    	$(".modalTambah").hide();
			    	$(".bloker").hide();
			    });

			    $("#btnMulaiTambah").click(function(){
			    	var nama = $("#nama").val();
			    	var ujian = $("#ujian").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_group_add.php",
			            data:{
			                'nama' : nama,
			                'ujian' : ujian
			            },
			            success : function(data){
			                //$('.loadon').load(data);
			                $(".loadon").load("data/data_group.php?katakunci="+katakunci);
			                $(".modalTambah").hide();
			                alert("Penambahan Group Telah Berhasil");
			                $(".bloker").hide();
			            }
			        });
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<b>Dashboard / Group</b>
		<br><br><br>
		<input type="text" class="input" id="search" placeholder="Search">
		&nbsp
		&nbsp
		<br><br>
		<div class="loadon"></div>
	</div>

	<div class="modalTambah">
		<table border="0" cellspacing="10" width="100%">
			<tr>
				<td><input type="text" id="nama" class="input" placeholder="Nama Group" style="width: 100%"></td>
			</tr>
			<tr>
				<td>
					<select id="ujian" class="input">
						<?php
							$sql = mysqli_query($con,"select * from tbl_ujian");
							while($res = mysqli_fetch_array($sql)){
								echo "<option value='".$res['id_ujian']."'>".$res['kode_ujian']."</option>";
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