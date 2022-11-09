<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Soal Berhasil Ditambahkan');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Soal Gagal Ditambahkan');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	$id = $_POST['id'];
	$jenis = $_POST['jenis'];
	$des = $_POST['des'];
	$kunci = $_POST['kunci'];
	$opsiA = $_POST['opsiA'];
	$opsiB = $_POST['opsiB'];
	$opsiC = $_POST['opsiC'];
	$opsiD = $_POST['opsiD'];
	$opsiE = $_POST['opsiE'];
	$kunciEssay = $_POST['kunciEssay'];
	$acak = $_POST['acak'];
	$acakOpsi = $_POST['acakOpsi'];

		
			if($_FILES['audio']['size'] > 0){
				
				$ekstensi_diperbolehkan	= array('mp3');
				$nama = $_FILES['audio']['name'];
				$x = explode('.', $nama);
				$ekstensi = strtolower(end($x));
				$namaBaru = rand(10,1000).time().".".$ekstensi;
				$ukuran	= $_FILES['audio']['size'];
				$file_tmp = $_FILES['audio']['tmp_name'];	
	 
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					if($ukuran < 100044070){			
						move_uploaded_file($file_tmp, '../../audios/'.$namaBaru);
						mysqli_set_charset($con,'utf8');
						$query = mysqli_query($con,"INSERT INTO tbl_soal(id_bank_soal,des_soal,jenis_soal,audio_soal,opt1_soal,opt2_soal,opt3_soal,opt4_soal,opt5_soal,kunciopt_soal,kunciessay_soal,acak_soal,acak_opsi) VALUES('".$id."','".$des."','".$jenis."','".$namaBaru."','".$opsiA."','".$opsiB."','".$opsiC."','".$opsiD."','".$opsiE."','".$kunci."','".$kunciEssay."','".$acak."','".$acakOpsi."')");
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
					mysqli_set_charset($con,'utf8');
					$query = mysqli_query($con,"INSERT INTO tbl_soal(id_bank_soal,des_soal,jenis_soal,opt1_soal,opt2_soal,opt3_soal,opt4_soal,opt5_soal,kunciopt_soal,kunciessay_soal,acak_soal,acak_opsi) VALUES('".$id."','".$des."','".$jenis."','".$opsiA."','".$opsiB."','".$opsiC."','".$opsiD."','".$opsiE."','".$kunci."','".$kunciEssay."','".$acak."','".$acakOpsi."')");
						if($query){
							echo '<script type="text/javascript"> berhasil(); </script>';
						}else{
							echo '<script type="text/javascript"> gagal(); </script>';
						}
			}
		
?>
</body>
</html>