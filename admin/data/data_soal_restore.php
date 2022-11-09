<?php
session_start();
include("../db.php");
require "excel_reader.php";
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../../css/global.css">
	<script type="text/javascript">
		function berhasil(){
			window.location = document.referrer;
		}
	</script>
</head>
<body>
<?php
	if(isset($_POST['submit'])){ // Jika user mengklik tombol Import
	// Load librari PHPExcel nya
	require_once '../../js/PHPExcel/PHPExcel.php';
	$namaFile = $_FILES['fileku']['name'];
	$tmpFile = $_FILES['fileku']['tmp_name'];
	move_uploaded_file($tmpFile, $namaFile);

	$inputFileType = 'CSV';
	$inputFileName = $namaFile;
	echo $inputFileName;

	$reader = PHPExcel_IOFactory::createReader($inputFileType);
	$excel = $reader->load($inputFileName);

	$numrow = 1;
	$worksheet = $excel->getActiveSheet();
	foreach ($worksheet->getRowIterator() as $row) {
		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// START -->
			// Skrip untuk mengambil value nya
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

			$get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
			foreach ($cellIterator as $cell) {
				array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
			}
			// <-- END

			// Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
			$id_bank = $_POST['idBank'];
			$des_soal = str_replace(' alt="', "", $get[0]);
			$jenis_soal = str_replace(' alt="', "", $get[1]);
			$audio_soal = $get[2];
			$opsi_a = str_replace(' alt="', "", $get[3]);
			$opsi_b = str_replace(' alt="', "", $get[4]);
			$opsi_c = str_replace(' alt="', "", $get[5]);
			$opsi_d = str_replace(' alt="', "", $get[6]);
			$opsi_e = str_replace(' alt="', "", $get[7]);
			$kunci_pg = $get[8];
			$kunci_essay = $get[9];
			$acak_soal = $get[10];
			$acak_opsi = $get[11];

			// Buat query Insert
			$query = "INSERT INTO tbl_soal(id_bank_soal,des_soal,jenis_soal,audio_soal,opt1_soal,opt2_soal,opt3_soal,opt4_soal,opt5_soal,kunciopt_soal,kunciessay_soal,acak_soal,acak_opsi)VALUES('".$id_bank."','".$des_soal."','".$jenis_soal."','".$audio_soal."','".$opsi_a."','".$opsi_b."','".$opsi_c."','".$opsi_d."','".$opsi_e."','".$kunci_pg."','".$kunci_essay."','".$acak_soal."','".$acak_opsi."')";
			
			// Eksekusi $query
			mysqli_query($con, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}
?>
<?php
unlink($namaFile);
echo '<script type="text/javascript"> berhasil(); </script>';
?>
</body>
</html>