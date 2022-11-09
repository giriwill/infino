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
	min-height: 400px;
	background-color: #efefef;
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	border-radius: 10px;
	overflow: hidden;
	padding: 5px;
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
			<img src="../../images/logoinfino3.png" style="width: 100px;">
		</div>
		<div class="identitas">
			<label><?php echo $resNama['nama_siswa'];?></label><br>
			<label id="logout"><a href="../logout.php" style="color: #ccc;">Logout</a></label>
		</div>
	</div>
	<?php
	$sql = mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$_SESSION['nopes']."'");
	$res = mysqli_fetch_array($sql);

	function cariKelas($idKelas){
		include("../db.php");
		$sql = mysqli_query($con,"select * from tbl_kelas where id_kelas='".$idKelas."'");
		return $res = mysqli_fetch_array($sql)['nama_kelas'];
	}

	function cariJurusan($idKelas){
		include("../db.php");
		$sql = mysqli_query($con,"select * from tbl_kelas where id_kelas='".$idKelas."'");
		return $res = mysqli_fetch_array($sql)['id_jurusan'];
	}

	function cariKelompok($nopesSiswa){
		include("../db.php");
		$sql = mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$nopesSiswa."'");
		return $res = mysqli_fetch_array($sql)['kelompok_siswa'];
	}

	function cariID($nopesSiswa){
		include("../db.php");
		$sql = mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$nopesSiswa."'");
		return $res = mysqli_fetch_array($sql)['id_siswa'];
	}

	?>
	<div class="box">
		<table style="width: 100%;">
			<tr>
				<td>Nomor Peserta :</td>
			</tr>
			<tr>
				<td><label><b><?php echo $res['nopes_siswa'];?></b></label></td>
			</tr>
		</table>
		<hr>
		<table style="width: 100%;">
			<tr>
				<td>Nama Peserta :</td>
			</tr>
			<tr>
				<td><label><b><?php echo $res['nama_siswa'];?></b></label></td>
			</tr>
		</table>
		<hr>
		<table style="width: 100%;">
			<tr>
				<td>Kelas :</td>
			</tr>
			<tr>
				<td><label><b><?php echo cariKelas($res['id_kelas']);?></b></label></td>
			</tr>
		</table>
		<hr>
		<table style="width: 100%;">
			<tr>
				<td>Kelompok Ujian :</td>
			</tr>
			<tr>
				<td><label><b>Kelompok <?php echo $res['kelompok_siswa'];?></b></label></td>
			</tr>
		</table>
		<hr>
		<table style="width: 100%;">
			<tr>
				<td>Mata Ujian Yang Tersedia :</td>
			</tr>
			<tr>
				<td>
					<?php
					$idJurusan = cariJurusan($res['id_kelas']);
					$kelSiswa = cariKelompok($_SESSION['nopes']);
					$idSiswa = cariID($_SESSION['nopes']);
					$sqlUjian = mysqli_query($con,"select * from tbl_ujian where (id_jurusan='".$idJurusan."' AND status_ujian='1') OR (id_jurusan='0' AND status_ujian='1')");
					while($resUjian = mysqli_fetch_array($sqlUjian)){
						$queryGroup = mysqli_query($con,"select (grup) from tbl_group where kode_ujian='".$resUjian['kode_ujian']."'");
						$resGroup = mysqli_fetch_array($queryGroup)['grup'];
						$pecah = explode(",", $resGroup);
						for($i = 0;$i < count($pecah);$i++){
							if($pecah[$i] == $idSiswa){
								echo "<b><a href='desMU.php?id=".$resUjian['id_ujian']."' class='buttonHijau'>".$resUjian['kode_ujian']."</a></b> ";
							}
						}		
					}
					?>
				</td>
			</tr>
		</table>
		<hr>
	</div>

</body>
</html>