<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Database Berhasil Dikosongkan/Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Database Gagal Dikosongkan/Dihapus');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	//hapus db
	$hapusbanksoal = mysqli_query($con,"truncate tbl_bank_soal");
	$hapusjawaban = mysqli_query($con,"truncate tbl_jawaban");
	$hapusjurusan = mysqli_query($con,"truncate tbl_jurusan");
	$hapuskelas = mysqli_query($con,"truncate tbl_kelas");
	$hapuslogin = mysqli_query($con,"truncate tbl_login");
	$hapusmapel = mysqli_query($con,"truncate tbl_mapel");
	$hapussiswa = mysqli_query($con,"truncate tbl_siswa");
	$hapussoal = mysqli_query($con,"truncate tbl_soal");
	$hapusstatusujian = mysqli_query($con,"truncate tbl_status_ujian");
	$hapusujian = mysqli_query($con,"truncate tbl_ujian");

	//The name of the folder.
	$folder = '../../audios';
	 
	//Get a list of all of the file names in the folder.
	$files = glob($folder . '/*');
	 
	//Loop through the file list.
	foreach($files as $file){
	    //Make sure that this is a file and not a directory.
	    if(is_file($file)){
	        //Use the unlink function to delete the file.
	        unlink($file);
	    }
	}

	//The name of the folder.
	function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
	}
	rmdir_recursive("../../js/kcfinder/upload/images");
	mkdir("../../js/kcfinder/upload/images");
	chmod("../../js/kcfinder/upload/images", 0777);

	if($hapusbanksoal && $hapusjawaban && $hapusjurusan && $hapuskelas && $hapuslogin && $hapusmapel && $hapussiswa && $hapussoal && $hapusstatusujian && $hapusujian){
		echo '<script type="text/javascript"> berhasil(); </script>';
	}else{
		echo '<script type="text/javascript"> gagal(); </script>';
	}
?>
</body>
</html>