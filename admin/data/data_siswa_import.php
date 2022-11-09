<?php
session_start();
include("../db.php");
require "excel_reader.php";
?>
<!DOCTYPE html>
<html>
<head>
<script>
function berhasil(){
	alert('Data Siswa Berhasil Diimport');
	//window.location = document.referrer;
	window.location.href = '../dashboard.php?pages=siswa';
}
function gagal(){
	alert('Data Siswa Gagal Diimport');
	//window.location = document.referrer;
	window.location.href = '../dashboard.php?pages=siswa';
}
</script>
</head>
<body>
<?php
//jika tombol import ditekan
if(isset($_POST['submit'])){
    $target = basename($_FILES['fileSiswa']['name']) ;
    move_uploaded_file($_FILES['fileSiswa']['tmp_name'], $target);
 
// tambahkan baris berikut untuk mencegah error is not readable
    chmod($_FILES['fileSiswa']['name'],0777);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['fileSiswa']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
        
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++){
//       membaca data (kolom ke-1 sd terakhir)
     	$nopes = $data->val($i, 1);
      $nama_siswa = $data->val($i, 2);
     	$id_kelas = $data->val($i, 3);
     	$password_siswa = $data->val($i, 4);
      $kelompox = $data->val($i, 5);

      //echo "nama : ".$kelompox."<br>";
    
//      setelah data dibaca, masukkan ke tabel pegawai sql
    $sql = "INSERT INTO tbl_siswa(nopes_siswa,nama_siswa,id_kelas,password_siswa,kelompok_siswa)values('".$nopes."','".$nama_siswa."','".$id_kelas."','".$password_siswa."','".$kelompox."')";
		$query = mysqli_query($con,$sql);
    }
    
    if($query){
  		echo '<script type="text/javascript"> berhasil(); </script>';
  	}else{
  		echo '<script type="text/javascript"> gagal(); </script>';
  	}
      
//    hapus file xls yang udah dibaca
    unlink($_FILES['fileSiswa']['name']);
}	
?>
</body>
</html>