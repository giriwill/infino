<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../../css/global.css">
	<script type="text/javascript">
		function berhasil(){
			alert("Proses Import Soal Telah Selesai");
			window.location = document.referrer;
		}
		function gagal(){
			alert("Soal Gagal Di Import");
			window.location = document.referrer;
		}
	</script>
</head>
<body>
<?php
	if(isset($_POST['submit'])){
		$namaFile = $_FILES['word']['name'];
		$pecah = explode(".", $namaFile);
		$namaLama = $pecah[0];
		$ekstensi = $pecah[1];
		$tmpFile = $_FILES['word']['tmp_name'];
		//pindahkan file htm
		move_uploaded_file($tmpFile, $namaFile);

		$file=fopen($namaFile,"r") or exit("Unable to open file!");

		//hilangkan new line dengan cara baca baris, nilangkan \n dan tulis lagi ke file baru tahap 1
		if(file_exists('tempo.htm')){
		    unlink('tempo.htm');
		}else{
		    //echo 'file not found';
		}
		$myfile = fopen("tempo.htm", "w") or die("Unable to open file!");
		$textTMP = "";
		$jmlSoal = 0;
		while (!feof($file)){
		  	$baris = fgets($file);
		  	if(strpos($baris, "[AWALSOAL]")){
		  		$baris = "[AWALSOAL]";
		  	}
		  	if(strpos($baris, "[OPSIA]")){
		  		$baris = "[OPSIA]";
		  	}
		  	if(strpos($baris, "[OPSIB]")){
		  		$baris = "[OPSIB]";
		  	}
		  	if(strpos($baris, "[OPSIC]")){
		  		$baris = "[OPSIC]";
		  	}
		  	if(strpos($baris, "[OPSID]")){
		  		$baris = "[OPSID]";
		  	}
		  	if(strpos($baris, "[OPSIE]")){
		  		$baris = "[OPSIE]";
		  	}
		  	$textTMP .= $baris;
		}
		fwrite($myfile, $textTMP);
		fclose($myfile);
		fclose($file);

		//
		if(file_exists('tempo2.htm')){
		    unlink('tempo2.htm');
		}else{
		    //echo 'file not found';
		}
		$file2=fopen("tempo.htm","r") or exit("Unable to open file!");
		$myfile2 = fopen("tempo2.htm", "w") or die("Unable to open file!");
		$textTMP2 = "";
		while (!feof($file2)){
		  	$baris2 = fgets($file2);
		  	if(strpos($baris2, "AWALSOAL")){
		  		$baris2 = "[AWALSOAL]\n";
		  	}
		  	if(strpos($baris2, "[OPSIA]")){
		  		$baris2 = "[OPSIA]\n";
		  	}
		  	if(strpos($baris2, "[OPSIB]")){
		  		$baris2 = "[OPSIB]\n";
		  	}
		  	if(strpos($baris2, "[OPSIC]")){
		  		$baris2 = "[OPSIC]\n";
		  	}
		  	if(strpos($baris2, "[OPSID]")){
		  		$baris2 = "[OPSID]\n";
		  	}
		  	if(strpos($baris2, "[OPSIE]")){
		  		$baris2 = "[OPSIE]\n";
		  	}
		  	$textTMP2 .= $baris2;
		}
		fwrite($myfile2, $textTMP2);
		fclose($myfile2);		
		fclose($file2);

		$file3=fopen("tempo2.htm","r") or exit("Unable to open file!");
		//tampung soal dan opsi
		$arraySoal = "";
		$arrayOpsiA = "";
		$arrayOpsiB = "";
		$arrayOpsiC = "";
		$arrayOpsiD = "";
		$arrayOpsiE = "";
		$arrayProperty = "";
		$kunci = "";
		$acakSoal = "";
		$acakOpsi = "";
		$jenisSoal = "";
		$kunciEssay = "";
		//
		$initSoal = false;
		$initA = false;
		$initB = false;
		$initC = false;
		$initD = false;
		$initE = false;
		$initProperty = false;
		$initKunciEssay = false;

		$nomorSoal = 1;

		while (!feof($file3)){
		  	$barislagi = fgets($file3);
		  	if(strpos($barislagi, 'AWALSOAL')){
				$initSoal = true;
				$initA = false;
				$initB = false;
				$initC = false;
				$initD = false;
				$initE = false;
				$initKunciEssay = false;
				$initProperty = false;
		  	}else if(strpos($barislagi, 'OPSIA')){
				$initSoal = false;
				$initA = true;
				$initB = false;
				$initC = false;
				$initD = false;
				$initE = false;
				$initKunciEssay = false;
				$initProperty = false;
		  	}else if(strpos($barislagi, 'OPSIB')){
				$initSoal = false;
				$initA = false;
				$initB = true;
				$initC = false;
				$initD = false;
				$initE = false;
				$initKunciEssay = false;
				$initProperty = false;
		  	}else if(strpos($barislagi, 'OPSIC')){
				$initSoal = false;
				$initA = false;
				$initB = false;
				$initC = true;
				$initD = false;
				$initE = false;
				$initKunciEssay = false;
				$initProperty = false;
		  	}else if(strpos($barislagi, 'OPSID')){
				$initSoal = false;
				$initA = false;
				$initB = false;
				$initC = false;
				$initD = true;
				$initE = false;
				$initKunciEssay = false;
				$initProperty = false;
		  	}else if(strpos($barislagi, 'OPSIE')){
				$initSoal = false;
				$initA = false;
				$initB = false;
				$initC = false;
				$initD = false;
				$initE = true;
				$initKunciEssay = false;
				$initProperty = false;
		  	}else if(strpos($barislagi, 'KUNCIESSAY')){
				$initSoal = false;
				$initA = false;
				$initB = false;
				$initC = false;
				$initD = false;
				$initE = false;
				$initKunciEssay = true;
				$initProperty = false;
		  	}else if(strpos($barislagi, 'PROP')){
				$initSoal = false;
				$initA = false;
				$initB = false;
				$initC = false;
				$initD = false;
				$initE = false;
				$initKunciEssay = false;
				$initProperty = true;
		  	}
		  	//
		  	if($initSoal == true){
		  		$arraySoal .= str_replace(" class=MsoNormal", "", $barislagi);
		  	}else if($initA == true){
		  		$arrayOpsiA .=str_replace(" class=MsoNormal", "", $barislagi);
		  	}else if($initB == true){
		  		$arrayOpsiB .= str_replace(" class=MsoNormal", "", $barislagi);
		  	}else if($initC == true){
		  		$arrayOpsiC .= str_replace(" class=MsoNormal", "", $barislagi);
		  	}else if($initD == true){
		  		$arrayOpsiD .=str_replace(" class=MsoNormal", "", $barislagi);
		  	}else if($initE == true){
		  		$arrayOpsiE .= str_replace(" class=MsoNormal", "", $barislagi);
		  	}else if($initKunciEssay == true){
		  		$kunciEssay .= str_replace(" class=MsoNormal", "", $barislagi);
		  	}else if($initProperty == true){
		  		$arrayProperty .= str_replace(" class=MsoNormal", "", $barislagi);
		  	}
		  	//hilangkan label marka
		  		/*for($x = 1;$x <= 200;$x++){
			  		$arraySoal = str_replace("[AWALSOAL][".$x."]", '', $arraySoal);
		  		}*/

		  		//cari nama kode bank soal dari tabel bank soal
		  		$kodebank = mysqli_fetch_array(mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$_POST['idBank']."'"));
	  				  		
		  		$arraySoal = str_replace("[AWALSOAL]", '', $arraySoal);
		  		$arraySoal = str_replace("alt=", 'id=', $arraySoal);
		  		$arraySoal = str_replace("lang=", '', $arraySoal);
		  		$arraySoal = str_replace($namaLama."_files", "/infino/js/kcfinder/upload/images/".$kodebank['kode_bank_soal'], $arraySoal);
		  		$arraySoal = str_replace($namaLama,$kodebank['kode_bank_soal'], $arraySoal);
		  		$arraySoal = str_replace("<p>&nbsp;</p>", '', $arraySoal);
		  		//$arraySoal = str_replace("</span>", '', $arraySoal);
		  		$arraySoal = preg_replace('/alt=\"(.*)\"/', '', $arraySoal);
		  		//$arraySoal = preg_replace("/style=\'(.*)\'/", '', $arraySoal);
		  		//$arraySoal = preg_replace('/<span[^>]*>/', '', $arraySoal);
		  		$spanpat = "/<span[^>]*><\\/span[^>]*>/";
		  		$arraySoal = preg_replace($spanpat, '', $arraySoal);
		  		$ppat = "/<p[^>]*><\\/p[^>]*>/";
		  		$arraySoal = preg_replace($ppat, '', $arraySoal);
		  		$arraySoal = str_replace("<img    width", '<imgwidth', $arraySoal);
		  	    $arraySoal = str_replace("<imgwidth", '<img width', $arraySoal);

		  		$arrayOpsiA = str_replace(PHP_EOL, '', $arrayOpsiA);
		  		$arrayOpsiA = str_replace("[OPSIA]", '', $arrayOpsiA);
		  		$arrayOpsiA = str_replace("alt=", 'id=', $arrayOpsiA);
		  		$arrayOpsiA = str_replace("lang=", '', $arrayOpsiA);
		  		$arrayOpsiA = str_replace("<p>&nbsp;</p>", '', $arrayOpsiA);
		  		$arrayOpsiA = str_replace($namaLama."_files", "/infino/js/kcfinder/upload/images/".$kodebank['kode_bank_soal'], $arrayOpsiA);
		  		$arrayOpsiA = str_replace($namaLama,$kodebank['kode_bank_soal'], $arrayOpsiA);
		  		$arrayOpsiA = str_replace("<img", '<img ', $arrayOpsiA);
		  		//$arrayOpsiA = str_replace("</span>", '', $arrayOpsiA);
		  		$arrayOpsiA = preg_replace('/alt=\"(.*)\"/', '', $arrayOpsiA);
		  		//$arrayOpsiA = preg_replace("/style=\'(.*)\'/", '', $arrayOpsiA);
		  		$arrayOpsiA = str_replace("<img    width", '<imgwidth', $arrayOpsiA);
		  		//$arrayOpsiA = preg_replace('/<span[^>]*>/', '', $arrayOpsiA);
		  		$spanpat = "/<span[^>]*><\\/span[^>]*>/";
		  		$arrayOpsiA = preg_replace($spanpat, '', $arrayOpsiA);
		  		$ppat = "/<p[^>]*><\\/p[^>]*>/";
		  		$arrayOpsiA = preg_replace($ppat, '', $arrayOpsiA);
		  		$arrayOpsiA = str_replace(PHP_EOL, '', $arrayOpsiA);
		  		$arrayOpsiA = str_replace("<img    width", '<imgwidth', $arrayOpsiA);
		  		$arrayOpsiA = str_replace("<imgwidth", '<img width', $arrayOpsiA);

		  		//cek apakah di opsi ini ada kata kunci "KUNCI"
		  		if(strpos($arrayOpsiA, '[KUNCI]')){
		  			$kunci = "opt1_soal";
		  			$arrayOpsiA = str_replace("[KUNCI]", '', $arrayOpsiA);
		  		}

		  		$arrayOpsiB = str_replace("[OPSIB]", '', $arrayOpsiB);
		  		$arrayOpsiB = str_replace("alt=", 'id=', $arrayOpsiB);
		  		$arrayOpsiB = str_replace("lang=", '', $arrayOpsiB);
		  		$arrayOpsiB = str_replace("<p>&nbsp;</p>", '', $arrayOpsiB);
		  		$arrayOpsiB = str_replace($namaLama."_files", "/infino/js/kcfinder/upload/images/".$kodebank['kode_bank_soal'], $arrayOpsiB);
		  		$arrayOpsiB = str_replace($namaLama, $kodebank['kode_bank_soal'], $arrayOpsiB);
		  		$arrayOpsiB = str_replace("<img", '<img ', $arrayOpsiB);
		  		//$arrayOpsiB = str_replace("</span>", '', $arrayOpsiB);
		  		$arrayOpsiB = preg_replace('/alt=\"(.*)\"/', '', $arrayOpsiB);
		  		//$arrayOpsiB = preg_replace("/style=\'(.*)\'/", '', $arrayOpsiB);
		  		$arrayOpsiB = str_replace(PHP_EOL, '', $arrayOpsiB);
		  		$arrayOpsiB = str_replace("<img    width", '<imgwidth', $arrayOpsiB);
		  		//$arrayOpsiB = preg_replace('/<span[^>]*>/', '', $arrayOpsiB);
		  		$spanpat = "/<span[^>]*><\\/span[^>]*>/";
		  		$arrayOpsiB = preg_replace($spanpat, '', $arrayOpsiB);
		  		$ppat = "/<p[^>]*><\\/p[^>]*>/";
		  		$arrayOpsiB = preg_replace($ppat, '', $arrayOpsiB);
		  		$arrayOpsiB = str_replace(PHP_EOL, '', $arrayOpsiB);
		  		$arrayOpsiB = str_replace("<img    width", '<imgwidth', $arrayOpsiB);
		  		$arrayOpsiB = str_replace("<imgwidth", '<img width', $arrayOpsiB);
		  		//cek apakah di opsi ini ada kata kunci "KUNCI"
		  		if(strpos($arrayOpsiB, '[KUNCI]')){
		  			$kunci = "opt2_soal";
		  			$arrayOpsiB = str_replace("[KUNCI]", '', $arrayOpsiB);
		  		}

		  		$arrayOpsiC = str_replace("[OPSIC]", '', $arrayOpsiC);
		  		$arrayOpsiC = str_replace("alt", 'id=', $arrayOpsiC);
		  		$arrayOpsiC = str_replace("lang=", '', $arrayOpsiC);
		  		$arrayOpsiC = str_replace("<p>&nbsp;</p>", '', $arrayOpsiC);
		  		$arrayOpsiC = str_replace($namaLama."_files", "/infino/js/kcfinder/upload/images/".$kodebank['kode_bank_soal'], $arrayOpsiC);		
		  		$arrayOpsiC = str_replace($namaLama, $kodebank['kode_bank_soal'], $arrayOpsiC);		
		  		$arrayOpsiC = str_replace("<img", '<img ', $arrayOpsiC);  	
		  		$arrayOpsiC = preg_replace('/alt=\"(.*)\"/', '', $arrayOpsiC);
		  		//$arrayOpsiC = preg_replace("/style=\'(.*)\'/", '', $arrayOpsiC);
		  		$arrayOpsiC = str_replace(PHP_EOL, '', $arrayOpsiC);
		  		$arrayOpsiC = str_replace("<img    width", '<imgwidth', $arrayOpsiC);
		  		//$arrayOpsiC = str_replace("</span>", '', $arrayOpsiC);
		  		//$arrayOpsiC = preg_replace('/<span[^>]*>/', '', $arrayOpsiC);
		  		$spanpat = "/<span[^>]*><\\/span[^>]*>/";
		  		$arrayOpsiC = preg_replace($spanpat, '', $arrayOpsiC);
		  		$ppat = "/<p[^>]*><\\/p[^>]*>/";
		  		$arrayOpsiC = preg_replace($ppat, '', $arrayOpsiC);
		  		$arrayOpsiC = str_replace(PHP_EOL, '', $arrayOpsiC);
		  		$arrayOpsiC = str_replace("<img    width", '<imgwidth', $arrayOpsiC);
		  		$arrayOpsiC = str_replace("<imgwidth", '<img width', $arrayOpsiC);
		  		//cek apakah di opsi ini ada kata kunci "KUNCI"
		  		if(strpos($arrayOpsiC, '[KUNCI]')){
		  			$kunci = "opt3_soal";
		  			$arrayOpsiC = str_replace("[KUNCI]", '', $arrayOpsiC);
		  		}

		  		$arrayOpsiD = str_replace("[OPSID]", '', $arrayOpsiD);
		  		$arrayOpsiD = str_replace("alt=", 'id=', $arrayOpsiD);
		  		$arrayOpsiD = str_replace("lang=", '', $arrayOpsiD);
		  		$arrayOpsiD = str_replace("<p>&nbsp;</p>", '', $arrayOpsiD);
		  		$arrayOpsiD = str_replace($namaLama."_files", "/infino/js/kcfinder/upload/images/".$kodebank['kode_bank_soal'], $arrayOpsiD);	
		  		$arrayOpsiD = str_replace($namaLama, $kodebank['kode_bank_soal'], $arrayOpsiD);	
		  		$arrayOpsiD = str_replace("<img", '<img ', $arrayOpsiD);  		
		  		$arrayOpsiD = preg_replace('/alt=\"(.*)\"/', '', $arrayOpsiD);
		  		//$arrayOpsiD = preg_replace("/style=\'(.*)\'/", '', $arrayOpsiD);
		  		$arrayOpsiD = str_replace(PHP_EOL, '', $arrayOpsiD);
		  		$arrayOpsiD = str_replace("<img    width", '<imgwidth', $arrayOpsiD);
		  		//$arrayOpsiD = str_replace("</span>", '', $arrayOpsiD);
		  		//$arrayOpsiD = preg_replace('/<span[^>]*>/', '', $arrayOpsiD);
		  		$spanpat = "/<span[^>]*><\\/span[^>]*>/";
		  		$arrayOpsiD = preg_replace($spanpat, '', $arrayOpsiD);
		  		$ppat = "/<p[^>]*><\\/p[^>]*>/";
		  		$arrayOpsiD = preg_replace($ppat, '', $arrayOpsiD);
		  		$arrayOpsiD = str_replace(PHP_EOL, '', $arrayOpsiD);
		  		$arrayOpsiD = str_replace("<img    width", '<imgwidth', $arrayOpsiD);
		  		$arrayOpsiD = str_replace("<imgwidth", '<img width', $arrayOpsiD);
		  		//cek apakah di opsi ini ada kata kunci "KUNCI"
		  		if(strpos($arrayOpsiD, '[KUNCI]')){
		  			$kunci = "opt4_soal";
		  			$arrayOpsiD = str_replace("[KUNCI]", '', $arrayOpsiD);
		  		}

		  		$arrayOpsiE = str_replace("[OPSIE]", '', $arrayOpsiE);
		  		$arrayOpsiE = str_replace("alt=", 'id=', $arrayOpsiE);
		  		$arrayOpsiE = str_replace("lang=", '', $arrayOpsiE);
		  		$arrayOpsiE = str_replace("<p>&nbsp;</p>", '', $arrayOpsiE);
		  		$arrayOpsiE = str_replace($namaLama."_files", "/infino/js/kcfinder/upload/images/".$kodebank['kode_bank_soal'], $arrayOpsiE);
		  		$arrayOpsiE = str_replace($namaLama, $kodebank['kode_bank_soal'], $arrayOpsiE);
		  		$arrayOpsiE = str_replace("<img", '<img ', $arrayOpsiE);
		  		$arrayOpsiE = preg_replace('/alt=\"(.*)\"/', '', $arrayOpsiE);
		  		//$arrayOpsiE = preg_replace("/style=\'(.*)\'/", '', $arrayOpsiE);
		  		$arrayOpsiE = str_replace(PHP_EOL, '', $arrayOpsiE);
		  		$arrayOpsiE = str_replace("<img    width", '<imgwidth', $arrayOpsiE);
		  		//$arrayOpsiE = str_replace("</span>", '', $arrayOpsiE);
		  		//$arrayOpsiE = preg_replace('/<span[^>]*>/', '', $arrayOpsiE);
		  		$spanpat = "/<span[^>]*><\\/span[^>]*>/";
		  		$arrayOpsiE = preg_replace($spanpat, '', $arrayOpsiE);
		  		$ppat = "/<p[^>]*><\\/p[^>]*>/";
		  		$arrayOpsiE = preg_replace($ppat, '', $arrayOpsiE);
		  		$arrayOpsiE = str_replace(PHP_EOL, '', $arrayOpsiE);
		  		$arrayOpsiE = str_replace("<img    width", '<imgwidth', $arrayOpsiE);
		  		$arrayOpsiE = str_replace("<imgwidth", '<img width', $arrayOpsiE);
		  		//cek apakah di opsi ini ada kata kunci "KUNCI"
		  		if(strpos($arrayOpsiE, '[KUNCI]')){
		  			$kunci = "opt5_soal";
		  			$arrayOpsiE = str_replace("[KUNCI]", '', $arrayOpsiE);
		  		}		  		
		  		$kunciEssay = str_replace("[KUNCIESSAY]", '', $kunciEssay);
		  		$kunciEssay = str_replace("<p>&nbsp;</p>", '', $kunciEssay);
		  		$kunciEssay = str_replace($namaLama."_files", "/infino/js/kcfinder/upload/images/".$kodebank['kode_bank_soal'], $kunciEssay);
		  		$kunciEssay = str_replace($namaLama, $kodebank['kode_bank_soal'], $kunciEssay);
		  		$kunciEssay = str_replace("<img", '<img ', $kunciEssay);
		  		$kunciEssay = preg_replace('/alt=\"(.*)\"/', '', $kunciEssay);
		  		$kunciEssay = preg_replace("/style=\'(.*)\'/", '', $kunciEssay);
		  		$kunciEssay = str_replace(PHP_EOL, '', $kunciEssay);
		  		$kunciEssay = str_replace("<img    width", '<imgwidth', $kunciEssay);
		  		$kunciEssay = str_replace("</span>", '', $kunciEssay);
		  		$kunciEssay = preg_replace('/<span[^>]*>/', '', $kunciEssay);
		  		$spanpat = "/<span[^>]*><\\/span[^>]*>/";
		  		$kunciEssay = preg_replace($spanpat, '', $kunciEssay);
		  		$ppat = "/<p[^>]*><\\/p[^>]*>/";
		  		$kunciEssay = preg_replace($ppat, '', $kunciEssay);
		  		$kunciEssay = str_replace(PHP_EOL, '', $kunciEssay);
		  		$kunciEssay = str_replace("<img    width", '<imgwidth', $kunciEssay);
		  		$kunciEssay = str_replace("<imgwidth", '<img width', $kunciEssay);

		  		//cek acak soal dan opsi
		  		if(strpos($arrayProperty, '[ACAKSOAL]')){
		  			$acakSoal = "1";
		  		}else{
		  			$acakSoal = "0";
		  		}
		  		if(strpos($arrayProperty, '[ACAKOPSI]')){
		  			$acakOpsi = "1";
		  		}else{
		  			$acakOpsi = "0";
		  		}
		  		if(strpos($arrayProperty, '[PG]')){
		  			$jenisSoal = "1";
		  		}else{
		  			$jenisSoal = "2";
		  		}
		  		$arrayProperty = str_replace("[PROP]", '', $arrayProperty);
		  		$arrayProperty = str_replace(" ", '', $arrayProperty);
		  		for($y = 1;$y <= 200;$y++){
			  		$arrayProperty = str_replace("[AKHIRSOAL][".$y."]", '', $arrayProperty);
		  		}
		  		$arrayProperty = str_replace("<p>", '', $arrayProperty);
		  		$arrayProperty = str_replace("</p>", '', $arrayProperty);
		  	//
		  	if(strpos($barislagi, 'AKHIRSOAL')){
		  		mysqli_set_charset($con,'utf8');
		  		$sql = mysqli_query($con,"INSERT INTO tbl_soal(id_bank_soal,des_soal,jenis_soal,opt1_soal,opt2_soal,opt3_soal,opt4_soal,opt5_soal,kunciopt_soal,kunciessay_soal,acak_soal,acak_opsi)values('".$_POST['idBank']."','".str_replace("'", '"', $arraySoal)."','".$jenisSoal."','".str_replace("'", '"', $arrayOpsiA)."','".str_replace("'", '"', $arrayOpsiB)."','".str_replace("'", '"', $arrayOpsiC)."','".str_replace("'", '"', $arrayOpsiD)."','".str_replace("'", '"', $arrayOpsiE)."','".$kunci."','".str_replace("'", '"', $kunciEssay)."','".$acakSoal."','".$acakOpsi."')");
		  		//echo "<xmp>".$arrayProperty."</xmp>";
		  		//echo "<br><br>";
		  		//clearing
		  		//echo "<xmp>".$arraySoal."</xmp>";
		  		//echo "<br><br>";
		  		$arraySoal = "";
				$arrayOpsiA = "";
				$arrayOpsiB = "";
				$arrayOpsiC = "";
				$arrayOpsiD = "";
				$arrayOpsiE = "";
				$kunciEssay = "";
				$arrayProperty = "";

		  	}

		}
		fclose($file3);
		//echo $arrayOpsiE;
		
	}
?>
<?php
unlink($namaFile);
echo '<script type="text/javascript"> berhasil(); </script>';
?>
</body>
</html>