<?php
session_start();
include("db.php");
if($_SESSION['regis'] != 1){
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>INFINO CBT</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="../icon.png">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/ckeditor/ckeditor.js"></script>
<script>
	$(document).ready(function(){
		$("#btnAdministrasi").click(function(){
			$(".menuAnakAdministrasi").toggle();
		}); 
	});			
</script>
<link rel="stylesheet" href="../css/global.css">
<style>
body{
	background-color: #eaeaea;
}
*{
	box-sizing: border-box;
}
.header{
	width: 100%;
	overflow: hidden;
}
.headerKiri{
	background-color: #0789c1;
	height: 100px;
	float: left;
	width: 70%;
	color: #fff;
	display: inline-block;
}
.headerKiri img{
	margin: 26px 0 0 26px;
}
.headerKanan{
	min-height: 100px;
	float: left;
	width: 30%;
	padding: 30px 0 30px 30px;
	background-color: #042126;
	color: #fff;
	display: inline-block;
}
.wrap{
	margin: 20px 20px 300px 20px;
	border-radius: 5px;
	background-color: #fff;
	float: left;
	width: 95%;
}
.wrapHeader{
	border-radius: 2px;
	background-color: #b9d5f7;
	width: 100%;
	padding: 20px;
}
.menu{
	min-width: 15%;
	float: left;
	margin: 20px;
}
.menu ul{
	list-style: none;
	padding: 0;
	margin: 0;
}
.menu ul li{
	margin-bottom: 5px;
	padding: 10px;
	background-color: #efefef;
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.menu ul li:hover{
	background-color: #eaeaea;
}
.menuAnakAdministrasi{
	background-color: #ccc;
	padding: 10px;
	display: none;
	position: relative;
}

</style>
</head>
<body>
	<div class="header">
		<div class="headerKiri"><img src="../images/logoinfino3.png" style="width: 100px;"></div>
		<div class="headerKanan">Welcome In<br>
			<?php
			$xml=simplexml_load_file("../version.xml") or die("Error: Cannot create object");
			?>
			<label style="font-size: 12px"><?php echo "INFINO CBT V ".$xml->version;?><label>
	</div>
	</div>
	<div class="wrap">
		<div class="wrapHeader">
			Dashboard <?php
				if(isset($_GET['pages'])){
					if ($_GET['pages']=="pengguna") {
						echo " / Pengguna";
					}else if($_GET['pages']=="pengguna_edit") {
						echo " / Edit Pengguna";
					}else if($_GET['pages']=="sekolah") {
						echo " / Identitas Sekolah";
					}else if($_GET['pages']=="kelas") {
						echo " / Kelas";
					}else if($_GET['pages']=="mapel") {
						echo " / Mata Pelajaran";
					}else if($_GET['pages']=="siswa") {
						echo " / Siswa";
					}else if($_GET['pages']=="siswa_edit") {
						echo " / Edit Siswa";
					}else if($_GET['pages']=="siswa_import") {
						echo " / Import Siswa";
					}else if($_GET['pages']=="bank") {
						echo " / Bank Soal";
					}else if($_GET['pages']=="soal") {
						echo " / Data Soal";
					}else if($_GET['pages']=="soal_add") {
						echo " / Tambah Soal";
					}else if($_GET['pages']=="soal_edit") {
						echo " / Edit Soal";
					}else if($_GET['pages']=="jurusan") {
						echo " / Jurusan";
					}else if($_GET['pages']=="jurusan_edit") {
						echo " / Edit Jurusan";
					}else if($_GET['pages']=="ujian") {
						echo " / Status Ujian";
					}else if($_GET['pages']=="ujian_edit") {
						echo " / Edit Ujian";
					}else if($_GET['pages']=="status") {
						echo " / Reset Peserta";
					}else if($_GET['pages']=="statusujian") {
						echo " / Status Peserta";
					}else if($_GET['pages']=="cetak") {
						echo " / Cetak Dokumen";
					}else if($_GET['pages']=="bares") {
						echo " / Backup dan Restore";
					}else if($_GET['pages']=="notes") {
						echo " / Notes";
					}else if($_GET['pages']=="autoreset") {
						echo " / Autoreset";
					}else if($_GET['pages']=="group") {
						echo " / Group";
					}
				}
			?>
		</div>
		<div class="menu">
			<ul>
				<?php if($_SESSION['level'] == 1){?>
				<a href="?pages=pengguna"><li><img src="images/boy.png" style="margin-right: 5px;">Pengguna</li></a>
				<a href="?pages=sekolah"><li><img src="images/school.png" style="margin-right: 5px;">Data Sekolah</li></a>
				<li id="btnAdministrasi"><img src="images/folder.png" style="margin-right: 5px;">Administrasi
					<ul class="menuAnakAdministrasi">
						<a href="?pages=jurusan"><li>- Jurusan</li></a>
						<a href="?pages=kelas"><li>- Kelas</li></a>
						<a href="?pages=mapel"><li>- Mata Pelajaran</li></a>
						<a href="?pages=siswa"><li>- Siswa</li></a>
					</ul>
				</li>
				<?php }?>		
				<a href="?pages=bank"><li><img src="images/question.png" style="margin-right: 5px;">Bank Soal</li></a>
				<a href="?pages=ujian"><li><img src="images/test.png" style="margin-right: 5px;">Status Ujian</li></a>				
				<a href="?pages=group"><li><img src="images/group.png" style="margin-right: 5px;width: 25px;">Grup Ujian</li></a>
				<a href="?pages=statusujian"><li><img src="images/running.png" style="margin-right: 5px;">Status Peserta</li></a>
				<a href="?pages=status"><li><img src="images/reset.png" style="margin-right: 5px;">Reset Peserta</li></a>
				<!--<a href="data/reset_peserta.php" onclick="return confirm('Anda yakin akan mereset semua Peserta ?')"><li><img src="images/reset.png" style="margin-right: 5px;">Reset Login Peserta</li></a>-->
				<a href="?pages=cetak"><li><img src="images/printer.png" style="margin-right: 5px;">Cetak</li></a>
				<!--<a href=""><li><img src="images/analysis.png" style="margin-right: 5px;">Analisa Ujian</li></a>-->
				<?php if($_SESSION['level'] == 1){?>
				<a href="?pages=info"><li><img src="images/info.png" style="margin-right: 5px;width: 25px;">Info Aplikasi</li></a>
				<a href="?pages=bares"><li><img src="images/backup2.png" style="margin-right: 5px;width: 25px;">Backup dan Restore</li></a>
				<a href="?pages=notes"><li><img src="images/notes.png" style="margin-right: 5px;width: 25px;">Notes</li></a>
				<a href="?pages=autoreset"><li><img src="images/timer.png" style="margin-right: 5px;width: 25px;">Auto Reset</li></a>
				<?php }?>
				<a href="logout.php"><li><img src="images/exit.png" style="margin-right: 5px;">Logout</li></a>
			</ul>
		</div>
		<?php
			if(isset($_GET['pages'])){
				if ($_GET['pages']=="pengguna") {
					include 'pages/pengguna.php';
				}else if($_GET['pages']=="pengguna_edit"){
					include 'pages/pengguna_edit.php';
				}else if($_GET['pages']=="sekolah"){
					include 'pages/sekolah.php';
				}else if($_GET['pages']=="kelas"){
					include 'pages/kelas.php';
				}else if($_GET['pages']=="kelas_edit"){
					include 'pages/kelas_edit.php';
				}else if($_GET['pages']=="mapel"){
					include 'pages/mapel.php';
				}else if($_GET['pages']=="mapel_edit"){
					include 'pages/mapel_edit.php';
				}else if($_GET['pages']=="siswa"){
					include 'pages/siswa.php';
				}else if($_GET['pages']=="siswa_edit"){
					include 'pages/siswa_edit.php';
				}else if($_GET['pages']=="siswa_import"){
					include 'pages/siswa_import.php';
				}else if($_GET['pages']=="bank"){
					include 'pages/bank.php';
				}else if($_GET['pages']=="bank_edit"){
					include 'pages/bank_edit.php';
				}else if($_GET['pages']=="soal"){
					include 'pages/soal.php';
				}else if($_GET['pages']=="soal_add"){
					include 'pages/soal_add.php';
				}else if($_GET['pages']=="soal_edit"){
					include 'pages/soal_edit.php';
				}else if($_GET['pages']=="jurusan"){
					include 'pages/jurusan.php';
				}else if($_GET['pages']=="jurusan_edit"){
					include 'pages/jurusan_edit.php';
				}else if($_GET['pages']=="ujian"){
					include 'pages/ujian.php';
				}else if($_GET['pages']=="ujian_edit"){
					include 'pages/ujian_edit.php';
				}else if($_GET['pages']=="status"){
					include 'pages/status.php';
				}else if($_GET['pages']=="statusujian"){
					include 'pages/statusujian.php';
				}else if($_GET['pages']=="cetak"){
					include 'pages/cetak.php';
				}else if($_GET['pages']=="info"){
					include 'pages/info.php';
				}else if($_GET['pages']=="bares"){
					include 'pages/bares.php';
				}else if($_GET['pages']=="notes"){
					include 'pages/notes.php';
				}else if($_GET['pages']=="autoreset"){
					include 'pages/autoreset.php';
				}else if($_GET['pages']=="group"){
					include 'pages/group.php';
				}else if($_GET['pages']=="list"){
					include 'pages/list.php';
				}
			}
		?>
	</div>
</body>
</html>