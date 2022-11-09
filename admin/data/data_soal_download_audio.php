<?php
session_start();
unset($_SESSION['audio']);
?>
<html>
<head>
<script>
function gagal(){
	alert('File Audio Tidak Tersedia, Silahkan Lakukan Backup Soal Terlebih Dahulu');
	window.location = document.referrer;
}
</script>
</head>
<body>
<?php
header("Location:audio.zip");
?>
</body>
</html>