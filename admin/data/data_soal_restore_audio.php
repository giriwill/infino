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
	if(isset($_POST['submit'])){
		$namaFile = $_FILES['audioku']['name'];
		$tmpFile = $_FILES['audioku']['tmp_name'];
		move_uploaded_file($tmpFile, "../../audios/".$namaFile);
	}
?>
<?php
echo '<script type="text/javascript"> berhasil(); </script>';
?>
</body>
</html>