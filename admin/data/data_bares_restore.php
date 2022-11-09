<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
	function berhasil(){
		alert('Database Berhasil Di Restore');
		window.location = document.referrer;
		//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
	}
	function gagal(){
		alert('Database Gagal Di Restore');
		window.location = document.referrer;
		//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
	}
	</script>
</head>
<body>


<?php
if($_FILES['dataBackup']['size'] > 0){
	$ekstensi_diperbolehkan	= array('backup');
	$nama = $_FILES['dataBackup']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$namaBaru = "siaprestore".".sql";
	$ukuran	= $_FILES['dataBackup']['size'];
	$file_tmp = $_FILES['dataBackup']['tmp_name'];
	$path = "../files/";
	move_uploaded_file($file_tmp, $namaBaru);

	//import database if exists
	$query = '';
	$sqlScript = file("siaprestore.sql");
	$status = true;
	foreach ($sqlScript as $line)	{
		
		$startWith = substr(trim($line), 0 ,2);
		$endWith = substr(trim($line), -1 ,1);
		
		if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
			continue;
		}
			
		$query = $query . $line;
		if ($endWith == ';') {
			$input = mysqli_query($con,$query);// or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
			$query= '';
			if($input){
				$status = true;
			}else{
				$status = false;
			}
		}
	}
	//buat folder images kosong
	$folderQuery = mysqli_query($con,"select * from tbl_bank_soal");
	while($folderData = mysqli_fetch_array($folderQuery)){
		mkdir("../../js/kcfinder/upload/images/".$folderData['kode_bank_soal']);
		chmod("../../js/kcfinder/upload/images/".$folderData['kode_bank_soal'], 0777);		
	}
	//akhir import sql
	unlink('siaprestore.sql');
	if($status == true){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
}
?>
</body>
</html>