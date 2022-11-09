<?php
session_start();
include("../db.php");

//start making sql query file
$query = mysqli_query($con,"select * from tbl_sekolah");
$kodeSekolah = mysqli_fetch_array($query);

$myfile = fopen($kodeSekolah['kode_sekolah']."-Backup-File.backup", "w") or die("Unable to open file!");
$txt = '';
//fetching data from tbl_jurusan
$queryJurusan = mysqli_query($con,"select * from tbl_jurusan");
while($dataJurusan = mysqli_fetch_array($queryJurusan)){
  $txt .= "INSERT INTO tbl_jurusan(id_jurusan,nama_jurusan)values('".$dataJurusan['id_jurusan']."','".$dataJurusan['nama_jurusan']."'); \n";
}
//end of fetching
//fetching data from tbl_kelas
$queryKelas = mysqli_query($con,"select * from tbl_kelas");
while($dataKelas = mysqli_fetch_array($queryKelas)){
  $txt .= "INSERT INTO tbl_kelas(id_kelas,nama_kelas,id_jurusan)values('".$dataKelas['id_kelas']."','".$dataKelas['nama_kelas']."','".$dataKelas['id_jurusan']."'); \n";
}
//end of fetching
//fetching data from tbl_mapel
$queryMapel = mysqli_query($con,"select * from tbl_mapel");
while($dataMapel = mysqli_fetch_array($queryMapel)){
  $txt .= "INSERT INTO tbl_mapel(id_mapel,nama_mapel,kkm_mapel,jenis_mapel)values('".$dataMapel['id_mapel']."','".$dataMapel['nama_mapel']."','".$dataMapel['kkm_mapel']."','".$dataMapel['jenis_mapel']."'); \n";
}
//end of fetching
//fetching data from tbl_siswa
$querySiswa = mysqli_query($con,"select * from tbl_siswa");
while($dataSiswa = mysqli_fetch_array($querySiswa)){
  $txt .= "INSERT INTO tbl_siswa(id_siswa,nopes_siswa,nama_siswa,id_kelas,password_siswa,kelompok_siswa)values('".$dataSiswa['id_siswa']."','".$dataSiswa['nopes_siswa']."','".$dataSiswa['nama_siswa']."','".$dataSiswa['id_kelas']."','".$dataSiswa['password_siswa']."','".$dataSiswa['kelompok_siswa']."'); \n";
}
//end of fetching
//fetching data from tbl_bank_soal
$queryBank = mysqli_query($con,"select * from tbl_bank_soal");
while($dataBank = mysqli_fetch_array($queryBank)){
  $txt .= "INSERT INTO tbl_bank_soal(id_bank_soal,kode_bank_soal,id_mapel,status_bank_soal,jml_opsi,path_image)values('".$dataBank['id_bank_soal']."','".$dataBank['kode_bank_soal']."','".$dataBank['id_mapel']."','".$dataBank['status_bank_soal']."','".$dataBank['jml_opsi']."','".$dataBank['path_image']."'); \n";
}
//end of fetching
//fetching data from tbl_soal
$querySoal = mysqli_query($con,"select * from tbl_soal");
while($dataSoal = mysqli_fetch_array($querySoal)){
  $txt .= "INSERT INTO tbl_soal(id_soal,id_bank_soal,des_soal,jenis_soal,audio_soal,opt1_soal,opt2_soal,opt3_soal,opt4_soal,opt5_soal,kunciopt_soal,kunciessay_soal,acak_soal,acak_opsi)values('".$dataSoal['id_soal']."','".$dataSoal['id_bank_soal']."','".$dataSoal['des_soal']."','".$dataSoal['jenis_soal']."','".$dataSoal['audio_soal']."','".$dataSoal['opt1_soal']."','".$dataSoal['opt2_soal']."','".$dataSoal['opt3_soal']."','".$dataSoal['opt4_soal']."','".$dataSoal['opt5_soal']."','".$dataSoal['kunciopt_soal']."','".$dataSoal['kunciessay_soal']."','".$dataSoal['acak_soal']."','".$dataSoal['acak_opsi']."'); \n";
}
//end of fetching
//fetching data from tbl_ujian
$queryUjian = mysqli_query($con,"select * from tbl_ujian");
while($dataUjian = mysqli_fetch_array($queryUjian)){
  $txt .= "INSERT INTO tbl_ujian(id_ujian,kode_ujian,id_bank_soal,id_jurusan,lama_ujian,sesi_ujian,token_ujian,status_ujian,lihat_hasil,lihat_token,time_mode,time_set)values('".$dataUjian['id_ujian']."','".$dataUjian['kode_ujian']."','".$dataUjian['id_bank_soal']."','".$dataUjian['id_jurusan']."','".$dataUjian['lama_ujian']."','".$dataUjian['sesi_ujian']."','".$dataUjian['token_ujian']."','".$dataUjian['status_ujian']."','".$dataUjian['lihat_hasil']."','".$dataUjian['lihat_token']."','".$dataUjian['time_mode']."','".$dataUjian['time_set']."'); \n";
}
//end of fetching
//fetching data from tbl_status_ujian
$queryStatusUjian = mysqli_query($con,"select * from tbl_status_ujian");
while($dataStatusUjian = mysqli_fetch_array($queryStatusUjian)){
  $txt .= "INSERT INTO tbl_status_ujian(id_status_ujian,id_ujian,nopes_siswa,sisa_waktu,status,nilai_pg,nilai_essay)values('".$dataStatusUjian['id_status_ujian']."','".$dataStatusUjian['id_ujian']."','".$dataStatusUjian['nopes_siswa']."','".$dataStatusUjian['sisa_waktu']."','".$dataStatusUjian['status']."','".$dataStatusUjian['nilai_pg']."','".$dataStatusUjian['nilai_essay']."'); \n";
}
//end of fetching
//fetching data from tbl_login
$queryLogin = mysqli_query($con,"select * from tbl_login");
while($dataLogin = mysqli_fetch_array($queryLogin)){
  $txt .= "INSERT INTO tbl_login(id_login,nopes_siswa,waktu_login,status_login)values('".$dataLogin['id_login']."','".$dataLogin['nopes_siswa']."','".$dataLogin['waktu_login']."','".$dataLogin['status_login']."'); \n";
}
//end of fetching
//fetching data from tbl_jawaban
$queryJawaban = mysqli_query($con,"select * from tbl_jawaban");
while($dataJawaban = mysqli_fetch_array($queryJawaban)){
  $txt .= "INSERT INTO tbl_jawaban(id_jawaban,id_ujian,nopes_siswa,id_soal,nomor_soal,pg_jawaban,essay_jawaban,bobot_essay,count_audio,acak_opsi)values('".$dataJawaban['id_jawaban']."','".$dataJawaban['id_ujian']."','".$dataJawaban['nopes_siswa']."','".$dataJawaban['id_soal']."','".$dataJawaban['nomor_soal']."','".$dataJawaban['pg_jawaban']."','".$dataJawaban['essay_jawaban']."','".$dataJawaban['bobot_essay']."','".$dataJawaban['count_audio']."','".$dataJawaban['acak_opsi']."'); \n";
}
//end of fetching
fwrite($myfile, $txt);
fclose($myfile);
header("Location: data_bares_download.php?kode=".$kodeSekolah['kode_sekolah']."-Backup-File.backup");
?>