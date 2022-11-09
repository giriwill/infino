<?php
session_start();
include("../db.php");

if($_FILES['patch']['size'] > 0){
	$ekstensi_diperbolehkan	= array('uru');
	$nama = $_FILES['patch']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$namaBaru = "update".".zip";
	$ukuran	= $_FILES['patch']['size'];
	$file_tmp = $_FILES['patch']['tmp_name'];
	$path = "../files/";
	move_uploaded_file($file_tmp, $path.$namaBaru);
	//unzip	
	$zip = new ZipArchive;
	if ($zip->open($path.$namaBaru) === TRUE) {
	    $zip->extractTo('../../../');
	    $zip->close();
	    echo 'ok';
	} else {
	    echo 'failed';
	}
	//import database if exists
	$query = '';
	$sqlScript = file("../../../update.sql");
	foreach ($sqlScript as $line)	{
		
		$startWith = substr(trim($line), 0 ,2);
		$endWith = substr(trim($line), -1 ,1);
		
		if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
			continue;
		}
			
		$query = $query . $line;
		if ($endWith == ';') {
			mysqli_query($con,$query);// or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
			$query= '';		
		}
	}
	//akhir import sql

	unlink($path.$namaBaru);
	unlink("../../../update.sql");
	header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>