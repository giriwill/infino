<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Soal Berhasil Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
function gagal(){
	alert('Soal Gagal Diubah');
	window.location = document.referrer;
	//window.location.href = 'http://jkafootwear.store/member/profile/profile.php';
}
</script>
</head>
<body>
<?php
	$id = $_POST['id'];
	$des = $_POST['des'];
	$audio = $_FILES['audio']['name'];
	$kunci = $_POST['kunci'];
	$opsiA = $_POST['opsiA'];
	$opsiB = $_POST['opsiB'];
	$opsiC = $_POST['opsiC'];
	$opsiD = $_POST['opsiD'];
	$opsiE = $_POST['opsiE'];
	$kunciEssay = $_POST['kunciEssay'];
	$acak = $_POST['acak'];
	$acakOpsi = $_POST['acakOpsi'];
	
	$sqlAudio = mysqli_query($con,"select * from tbl_soal where id_soal='".$id."'");
	$resAudio = mysqli_fetch_array($sqlAudio);
	$audioLama = $resAudio['audio_soal'];	

		if($_POST['upload']){
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
						unlink('../../audios/'.$audioLama);
						move_uploaded_file($file_tmp, '../../audios/'.$namaBaru);
						mysqli_set_charset($con,'utf8');
						$query = mysqli_query($con,"UPDATE tbl_soal SET des_soal='".$des."',audio_soal='".$namaBaru."',opt1_soal='".$opsiA."',opt2_soal='".$opsiB."',opt3_soal='".$opsiC."',opt4_soal='".$opsiD."',opt5_soal='".$opsiE."',kunciopt_soal='".$kunci."',kunciessay_soal='".$kunciEssay."' ,acak_soal='".$acak."',acak_opsi='".$acakOpsi."' WHERE id_soal='".$id."' ");
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
				$query = mysqli_query($con,"UPDATE tbl_soal SET des_soal='".$des."',opt1_soal='".$opsiA."',opt2_soal='".$opsiB."',opt3_soal='".$opsiC."',opt4_soal='".$opsiD."',opt5_soal='".$opsiE."',kunciopt_soal='".$kunci."',kunciessay_soal='".$kunciEssay."',acak_soal='".$acak."',acak_opsi='".$acakOpsi."'  WHERE id_soal='".$id."' ");
						if($query){
							echo '<script type="text/javascript"> berhasil(); </script>';
						}else{
							echo '<script type="text/javascript"> gagal(); </script>';
						}
			}
		}
?>
</body>
</html>