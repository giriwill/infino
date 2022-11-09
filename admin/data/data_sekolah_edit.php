<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
clearstatcache();
?>
<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Identitas Sekolah Berhasil Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Identitas Sekolah Gagal Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php

	if($_FILES['logo']['size'] > 0){
		$ekstensi_diperbolehkan	= array('png');
		$nama = $_FILES['logo']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		//$namaBaru = rand(10,1000).time().".".$ekstensi;
		$namaBaru = "logosekolah".".".$ekstensi;
		$ukuran	= $_FILES['logo']['size'];
		$file_tmp = $_FILES['logo']['tmp_name'];	

		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 10044070){			
				move_uploaded_file($file_tmp, '../images/'.$namaBaru);
				$query = mysqli_query($con,"update tbl_sekolah set kode_sekolah='".$_POST['kode']."',nama_sekolah='".$_POST['nama']."',alamat_sekolah='".$_POST['alamat']."',logo_sekolah='".$namaBaru."',slogan_sekolah='".$_POST['slogan']."',kepala_sekolah='".$_POST['kepsek']."',nip_kepsek='".$_POST['nip']."',jml_ruang='".$_POST['ruang']."',jml_hari='".$_POST['hari']."' where id_sekolah='".$_POST['id']."'");
				if($query){
					echo '<script type="text/javascript"> berhasil(); </script>';
				}else{
					echo '<script type="text/javascript"> gagal(); </script>';
				}
			}else{
				echo '<script type="text/javascript"> gagal(); </script>';
			}
		}else{
			echo '<script type="text/javascript"> gagal(); </script>';
		}
	}else{
		$querys = mysqli_query($con,"update tbl_sekolah set kode_sekolah='".$_POST['kode']."',nama_sekolah='".$_POST['nama']."',alamat_sekolah='".$_POST['alamat']."',slogan_sekolah='".$_POST['slogan']."',kepala_sekolah='".$_POST['kepsek']."',nip_kepsek='".$_POST['nip']."',jml_ruang='".$_POST['ruang']."',jml_hari='".$_POST['hari']."' where id_sekolah='".$_POST['id']."'");
		if($querys){
			echo '<script type="text/javascript"> berhasil(); </script>';
		}else{
			echo '<script type="text/javascript"> gagal(); </script>';
		}
	}

	if($_FILES['gbrLogin']['size'] > 0){
		$ekstensi_diperbolehkan	= array('jpg');
		$nama = $_FILES['gbrLogin']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		//$namaBaru = rand(10,1000).time().".".$ekstensi;
		$namaBaru = "background".".".$ekstensi;
		$ukuran	= $_FILES['gbrLogin']['size'];
		$file_tmp = $_FILES['gbrLogin']['tmp_name'];	

		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 10044070){			
				move_uploaded_file($file_tmp, '../../images/'.$namaBaru);
				//$query = mysqli_query($con,"update tbl_sekolah set kode_sekolah='".$_POST['kode']."',nama_sekolah='".$_POST['nama']."',alamat_sekolah='".$_POST['alamat']."',logo_sekolah='".$namaBaru."',slogan_sekolah='".$_POST['slogan']."',kepala_sekolah='".$_POST['kepsek']."',nip_kepsek='".$_POST['nip']."',jml_ruang='".$_POST['ruang']."',jml_hari='".$_POST['hari']."',gambar_login='".$namaBaru."' where id_sekolah='".$_POST['id']."'");
				if($query){
					//echo '<script type="text/javascript"> berhasil(); </script>';
				}else{
					//echo '<script type="text/javascript"> gagal(); </script>';
				}
			}else{
				///echo '<script type="text/javascript"> gagal(); </script>';
			}
		}else{
			//echo '<script type="text/javascript"> gagal(); </script>';
		}
	}

	if($_FILES['gbrSide']['size'] > 0){
		$ekstensi_diperbolehkan	= array('jpg');
		$nama = $_FILES['gbrSide']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		//$namaBaru = rand(10,1000).time().".".$ekstensi;
		$namaBaru = "imagebarinfino".".".$ekstensi;
		$ukuran	= $_FILES['gbrSide']['size'];
		$file_tmp = $_FILES['gbrSide']['tmp_name'];	

		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 10044070){			
				move_uploaded_file($file_tmp, '../images/'.$namaBaru);
				//$query = mysqli_query($con,"update tbl_sekolah set kode_sekolah='".$_POST['kode']."',nama_sekolah='".$_POST['nama']."',alamat_sekolah='".$_POST['alamat']."',logo_sekolah='".$namaBaru."',slogan_sekolah='".$_POST['slogan']."',kepala_sekolah='".$_POST['kepsek']."',nip_kepsek='".$_POST['nip']."',jml_ruang='".$_POST['ruang']."',jml_hari='".$_POST['hari']."',gambar_sidebar='".$namaBaru."' where id_sekolah='".$_POST['id']."'");
				if($query){
					//echo '<script type="text/javascript"> berhasil(); </script>';
				}else{
					//echo '<script type="text/javascript"> gagal(); </script>';
				}
			}else{
				//echo '<script type="text/javascript"> gagal(); </script>';
			}
		}else{
			//echo '<script type="text/javascript"> gagal(); </script>';
		}
	}

?>
</body>
</html>