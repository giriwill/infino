<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php

	$cekStatusUjian = mysqli_num_rows(mysqli_query($con,"select * from tbl_status_ujian where id_ujian='".$res['id_ujian']."' AND nopes_siswa='".$_SESSION['nopes']."'"));
	if($cekStatusUjian < 1){
		$sqlInst = mysqli_query($con,"insert into tbl_status_ujian(id_ujian,nopes_siswa,sisa_waktu,status)values('".$res['id_ujian']."','".$_SESSION['nopes']."','','0')");
	}
	
?>
</body>
</html>