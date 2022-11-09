<!DOCTYPE html>
<?php
include("db.php");
?>
<html>
	<head>
		<script>
			$(document).ready(function(){
				var limit = 10;
				var flag = 0;

				if(flag <= 0){
			    	$("#btnPrev").hide();
			    }else{
			    	$("#btnPrev").show();
			    }

			    var katakunci = $("#search").val();
			    $(".loadon").load("data/data_list.php?katakunci="+katakunci+"&offset=0&limit="+limit);
			    //flag += limit;

			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_list.php?katakunci="+katakunci+"&offset=0&limit="+limit);			    	
			    });

			    $("#btnNext").click(function(){
			    	flag += limit;
			    	$(".loadon").load("data/data_list.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);			    	
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });			    

			    $("#btnPrev").click(function(){
			    	flag -= limit;
			    	$(".loadon").load("data/data_list.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);		
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

			    $("#btnListAll").click(function(){
			    	/*var nopes = $("#nopes").val();
			    	//alert(password);
			    	$.ajax({
			            type: "GET",
			            url: "data/data_list_add.php",
			            data:{
			                'nopes' : nopes,
			                'nama' : nama,
			                'password' : password,
			                'kelas' : kelas,
			                'sesi' : sesi
			            },
			            success : function(data){
			                //$('.loadon').load(data);
			                $(".loadon").load("data/data_list.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);
			                $(".modalTambah").hide();
			                alert("Penambahan Siswa Telah Berhasil");
			                $(".bloker").hide();
			            }
			        });*/
			    	alert('');
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<input type="hidden" id="idGroup" value="<?php echo $_GET['id'];?>">
		<b>Dashboard / Group / List Siswa / 
			<?php
			$sql = "select nama_group from tbl_group where id_group='".$_GET['id']."'";
			$query = mysqli_query($con,$sql);
			echo $res = mysqli_fetch_array($query)['nama_group'];

			//binding array dari grup yg dipilih
			$queryGroup = mysqli_query($con,"select (grup) from tbl_group where id_group='".$_GET['id']."'");
			$mentah = mysqli_fetch_array($queryGroup)['grup'];
			$jmlMentah = strlen($mentah);
			if($jmlMentah > 1){
				$pecahMentah = explode(",", $mentah);
				$jmlAnggota = count($pecahMentah);
				for($i = 0;$i < $jmlAnggota ; $i++){
					$queryUpdateSiswa = mysqli_query($con,"UPDATE tbl_siswa SET cek='1' WHERE id_siswa='".$pecahMentah[$i]."'");
				}
			}
			
		?>
		</b>
		<br><br><br>
		<form action="data/data_list_all.php" method="POST" onsubmit="return true">
			<input type="submit" name="cekall" value="Pilih Semua" class="buttonHijau">
		</form>
		<br>
		<form action="data/data_list_kelas.php" method="POST" onsubmit="return true">
			<input type="hidden" name="idGroup" value="<?php echo $_GET['id'];?>">
			<select name="kelas">
				<?php
				$sqlKelas = "select * from tbl_kelas";
				$queryKelas = mysqli_query($con,$sqlKelas);
				while($res = mysqli_fetch_array($queryKelas)){
					echo "<option value=".$res['id_kelas'].">".$res['nama_kelas']."</option>";
				}
				?>
			</select>
			<input type="submit" name="cekkelas" value="Tandai Kelas Ini" class="buttonHijau">
		</form>
		<br>
		<form action="data/data_list_empty.php" method="POST" onsubmit="return true">
			<input type="hidden" name="idGroup" value="<?php echo $_GET['id'];?>">
			<select name="kelas">
				<?php
				$sqlKelas = "select * from tbl_kelas";
				$queryKelas = mysqli_query($con,$sqlKelas);
				while($res = mysqli_fetch_array($queryKelas)){
					echo "<option value=".$res['id_kelas'].">".$res['nama_kelas']."</option>";
				}
				?>
			</select>
			<input type="submit" name="cekkelas" value="Hilangkan Kelas Ini" class="buttonOrange">
		</form>
		<br>
		<form action="data/data_list_update.php" method="POST">
			<input type="hidden" name="idGroup" value="<?php echo $_GET['id'];?>">
			<input type="text" class="input" id="search" placeholder="Search Nama Peserta">
			<input type="submit" value="UPDATE GROUP" class="button">			
			<div class="loadon"></div>
			<br>
			<button class="button" id="btnPrev">Prev</button> &nbsp <button class="button" id="btnNext">Next</button>
		</form>
	</div>
</body>
</html>