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
		width: 80%;
		height: 50px;
		padding: 10px;
	}
	div.identitas{
		float: left;
		width: 20%;
		height: 50px;
		background-color: #465266;
		padding: 10px;
	}
	div.identitas #logout{
		font-size: 12px;
		color: #ccc;
	}
	div.box{
		margin: auto;
		position: absolute;
		right: 0;left:0;
		width: 20%;
		height: 280px;
		background-color: #efefef;
		box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
		border-radius: 10px;
		overflow: hidden;
		padding: 20px;
		text-align: center;
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
		INFINO ALPHA
	</div>
	<div class="identitas">
		<label><?php echo $resNama['nama_siswa'];?></label><br>
		<label id="logout"><a href="../logout.php" style="color: #ccc;">Logout</a></label>
	</div>
</div>
<?php
$poin = 0;
$jmlJawabanPeserta = mysqli_num_rows(mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'"));
$cekJawaban = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
while($resJawaban = mysqli_fetch_array($cekJawaban)){
	$cekKunciJawaban = mysqli_fetch_array(mysqli_query($con,"select * from tbl_soal where id_soal='".$resJawaban['id_soal']."'"));
	if($resJawaban['pg_jawaban'] == $cekKunciJawaban['kunciopt_soal']){
		$poin++;
	}
}
$savePoin = mysqli_query($con,"update tbl_status_ujian set nilai_pg='".$poin."' where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
?>
<div class="box">
	<table style="width: 100%;">
		<tr>
			<td>Jumlah Benar Soal PG :</td>
		</tr>
		<tr>
			<td><label style="font-size: 50px;"><b><?php echo $poin;?></b></label></td>
		</tr>
		<tr>
			<td>Jumlah Benar Soal Essay :</td>
		</tr>
		<tr>
			<td><label style="font-size: 50px;"><b>0</b></label></td>
		</tr>
		<tr>
			<td height="50px"><a href="../logout.php" class="buttonOrange">LOGOUT</a></td>
		</tr>
	</table>
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