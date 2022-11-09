<?php
session_start();
include("../db.php");
$cekBank = mysqli_fetch_array(mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$_GET['idBank']."'"));

$myfile = fopen($cekBank['kode_bank_soal'].".htm", "w") or die("Unable to open file!");
//tarik database
mysqli_set_charset($con,'utf8');
$sql = mysqli_query($con,"SELECT * FROM tbl_soal WHERE id_bank_soal='".$_GET['idBank']."'");
$no = 1;
$kunci = "";
$acakSoal = false;
$acakOpsi = false;
$txt = "";
while($data = mysqli_fetch_array($sql)){
  $txt .= "<p class=MsoNormal>[AWALSOAL][".$no."]</p>\n \n";
  $txt .= $data['des_soal']."\n";
  $txt .= "<p class=MsoNormal>[OPSIA]</p>\n";
  if($data['kunciopt_soal'] == "opt1_soal"){
    $txt .= "<p class=MsoNormal>[KUNCI]</p>\n";
  }
  $txt .= $data['opt1_soal']."\n";
  $txt .= "<p class=MsoNormal>[OPSIB]</p>\n";
  if($data['kunciopt_soal'] == "opt2_soal"){
    $txt .= "<p class=MsoNormal>[KUNCI]</p>\n";
  }
  $txt .= $data['opt2_soal']."\n";
  $txt .= "<p class=MsoNormal>[OPSIC]</p>\n";
  if($data['kunciopt_soal'] == "opt3_soal"){
    $txt .= "<p class=MsoNormal>[KUNCI]</p>\n";
  }
  $txt .= $data['opt3_soal']."\n";
  $txt .= "<p class=MsoNormal>[OPSID]</p>\n";
  if($data['kunciopt_soal'] == "opt4_soal"){
    $txt .= "<p class=MsoNormal>[KUNCI]</p>\n";
  }
  $txt .= $data['opt4_soal']."\n";
  $txt .= "<p class=MsoNormal>[OPSIE]</p>\n";
  if($data['kunciopt_soal'] == "opt5_soal"){
    $txt .= "<p class=MsoNormal>[KUNCI]</p>\n";
  }
  $txt .= $data['opt5_soal']."\n";
  $txt .= "<p class=MsoNormal>[KUNCIESSAY]</p>\n";
  $txt .= $data['kunciessay_soal']."\n";
  $txt .= "<p class=MsoNormal>[PROP][".$no."]</p>\n";
  if($data['jenis_soal'] == 1){
    $txt .= "<p class=MsoNormal>[PG]</p>\n";
  }
  if($data['acak_soal'] == 1){
    $txt .= "<p class=MsoNormal>[ACAKSOAL]</p>\n";
  }
  if($data['acak_opsi'] == 1){
    $txt .= "<p class=MsoNormal>[ACAKOPSI]</p>\n";
  }
  $txt .= "<p class=MsoNormal>[AKHIRSOAL][".$no."]</p>\n";
  $no++;
}
fwrite($myfile, $txt);
fclose($myfile);
?>
<!--<a href="<?php echo $cekBank['kode_bank_soal'].'.htm';?>" download>DOWNLOAD</a>-->
<?php
//unlink($cekBank['kode_bank_soal'].'.htm');
header("Location: data_soal_backup_download.php?kode=".$cekBank['kode_bank_soal'].".htm");
?>