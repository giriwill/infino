<?php
session_start();
if($_SESSION['reg'] != 1){
	header('Location: ../login.php');
}
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../css/global.css">
<link rel="stylesheet" href="../css/awesome/css/font-awesome.css">
<style>
	body{
		background-color: #ffffff;
	}
	*{
		box-sizing: border-box;
	}
	div.header{
		display: inline-block;
		width: 100%;
		min-height: 50px;
		font-size: 15px;
		background-color: #0789c1;
		color: #fff;
	}
	div.judul{
		float: left;
		width: 50%;
		height: 50px;
		padding: 10px;
	}
	div.identitas{
		float: left;
		width: 50%;
		height: 50px;
		background-color: #465266;
		padding: 10px;
		overflow: hidden;
	}
	div.identitas #logout{
		font-size: 12px;
		color: #ccc;
	}
	div.box{
		margin: auto auto auto auto;
		position: absolute;
		top:0; left: 0; right: 0; bottom: 0;
		width: 95%;
		height: 410px;
		background-color: #efefef;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 10px;
		overflow: hidden;
		padding: 5px;
	}
	.isiBloker{
		margin: auto auto auto auto;
		position: absolute;
		top:0; left: 0; right: 0; bottom: 0;
		width: 300px;
		height: 150px;
		background-color: #efefef;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 10px;
		overflow: hidden;
		text-align: center;
		padding: 20px;
	}
	.bloking{
		 display: none;
	     position: absolute;
	     left: 0px;
	     top: 0px;
	     width:100%;
	     height:100%;
	     text-align:center;
	     z-index: 1001;
	     background-color: rgba(0, 0, 0, 0.6);
	}
	.bloking img{
		width: 50px;
		margin: auto;
		position: absolute;
		top: 0; left: 0; bottom: 0; right: 0;
	}
</style>
<script>
	$(document).ready(function(){

		$("#mulai").click(function(){
			$(".bloking").show();
			var token = $("#token").val();
			var id = $("#id").val();
			var idBank = $("#idBank").val();
			var idUjian = $("#idUjian").val();
			$.ajax({
				type: "GET",
				url: "../data/cekToken.php",
				data:{
					'token' : token,
					'id' : id
				},
				success : function(data){
					if(data < 1){
						$(".bloker").show();
					}else{
						window.location.href = "soalEngine.php?idBank="+idBank+"&idUjian="+idUjian;
					}
					$(".bloking").hide();
				}
			});
		});
		$(".bloker").click(function(){
			$(".bloker").hide();
		});


	});			
</script>
</head>
<body>
	<?php
	$sqlNama = mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$_SESSION['nopes']."'");
	$resNama = mysqli_fetch_array($sqlNama);
	?>
	<div class="header">
		<div class="judul">
			<img src="../../images/logoinfino3.png" style="width: 100px;">
		</div>
		<div class="identitas">
			<label><?php echo $resNama['nama_siswa'];?></label><br>
			<label id="logout"><a href="../logout.php" style="color: #ccc;">Logout</a></label>
		</div>
	</div>
	<?php
	$sql = mysqli_query($con,"select * from tbl_ujian where id_ujian='".$_GET['id']."'");
	$res = mysqli_fetch_array($sql);
	echo "<input type='hidden' value='".$res['id_ujian']."' id='id'>";
	echo "<input type='hidden' value='".$res['id_bank_soal']."' id='idBank'>";
	echo "<input type='hidden' value='".$res['id_ujian']."' id='idUjian'>";
	//mulai memasukan data jawaban siswa ke tabel jawaban
	include "../data/jawabEngine.php";
	//mulai masukan data ke tabel status_ujian(0=belum selesai,1=selesai ujian)
	include "../data/statusUjianEngine.php";
	//generate array dengan bentuk session untuk menampung shuffle jawaban pilihan ganda
	include "../data/shufflePGEngine.php";

	function cariMapel($idBankSoal){
		include("../db.php");
		$sql = mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$idBankSoal."'");
		$res = mysqli_fetch_array($sql);

		$sql2 = mysqli_query($con,"select * from tbl_mapel where id_mapel='".$res['id_mapel']."'");
		$res2 = mysqli_fetch_array($sql2);
		return $res2['nama_mapel'];
	}

	function cariJurusan($idJurusan){
		include("../db.php");
		$sql = mysqli_query($con,"select * from tbl_jurusan where id_jurusan='".$idJurusan."'");
		$res = mysqli_fetch_array($sql);
		$jml = mysqli_num_rows($sql);
		if($jml > 0){
			return $res['nama_jurusan'];
		}else{
			return 'Semua Jurusan';
		}		
	}

	function durasiUjian($waktu){
		$detik = $waktu * 60;
		$jam = $detik / 3600;
		$jampas = floor($jam);
		$sisamenit = $jam-(floor($jam));
		$menit = ceil($sisamenit * 60);
		return $jampas." Jam : ".$menit." Menit";
	}

	?>
<div class="box">
	<table style="width: 100%;">
		<tr>
			<td>Kode Ujian :</td>
		</tr>
		<tr>
			<td><label><b><?php echo $res['kode_ujian'];?></b></label></td>
		</tr>
	</table>
	<hr>
	<table style="width: 100%;">
		<tr>
			<td>Mata Pelajaran :</td>
		</tr>
		<tr>
			<td><label><b><?php echo cariMapel($res['id_bank_soal']);?></b></label></td>
		</tr>
	</table>
	<hr>
	<table style="width: 100%;">
		<tr>
			<td>Jurusan/Peminatan :</td>
		</tr>
		<tr>
			<td><label><b><?php echo cariJurusan($res['id_jurusan']);?></b></label></td>
		</tr>
	</table>
	<hr>
	<table style="width: 100%;">
		<tr>
			<td>Lama Ujian :</td>
		</tr>
		<tr>
			<td><label><b><?php echo durasiUjian($res['lama_ujian']);?></b></label></td>
		</tr>
	</table>
	<hr>
	<table style="width: 100%;">
		<tr>
			<td>Masukan Token :</td>
		</tr>
		<tr>
			<?php
			$TOKENKU = "";
			if($res['lihat_token'] == 1){
				$TOKENKU = $res['token_ujian'];
			}
			?>
			<td><input type="text" id="token" class="input" value="<?php echo $TOKENKU;?>"></td>
		</tr>
	</table>
	<hr>
	<table style="width: 100%;" border="0">
		<tr>
			<td colspan="2"><button class="button" id="mulai" style="width: 100%;">MULAI</button></td>
		</tr>
	</form>
</div>

<div class="bloker">
	<div class="isiBloker">
		<img src="../images/warning.png"><br><br>
		Maaf, Token tidak berlaku !
	</div>
</div>

<div class="bloking">
		<img src="../images/infinity.gif">
	</div>
</body>
</html>