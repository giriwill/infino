<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/global.css">
<style>
.wrap{
	width: 100%;
	height: 700px;
	background-color: #fcfcfc;
	overflow: hidden;
}
.kiri{
	float: left;
	width: 50%;
}
.kanan{
	float: left;
	width: 50%;
}
.kiri img{	
	width: 100%;
}
.judulKanan{
	text-align: center;
	padding: 15px;
	background: #0789c1;
	color: #fff;
}
.isiKanan{
	margin-top: 100px;
	margin-left: 100px;
	width: 70%;
}
.isiKanan{
	margin: 100px auto auto auto;
	width: 50%;
}
</style>
</head>
<body>
	<?php
	$xml=simplexml_load_file("../version.xml") or die("Error: Cannot create object");
	$identitas = mysqli_fetch_array(mysqli_query($con,"select * from tbl_sekolah"));
	?>
	<div class="wrap">
		<div class="kiri">
			<img src="images/imagebarinfino.jpg">
		</div>
		<div class="kanan">
			<div class="judulKanan">
				<img src="images/logosekolah.png" style="width: 80px;">
				<h3> <?php echo $identitas['slogan_sekolah']; ?> </h3>
				<h2> <?php echo $identitas['nama_sekolah']; ?> </h2>
			</div>
			<div class="isiKanan">
				<form action="login.php" method="POST">
				<table class="boxLogin">
					<tr><td><h2>INFINO CBT LOGIN</h2></td><tr>
					<tr><td><span class="comment"> SILAHKAN MASUKAN USERNAME DAN PASSWORD</span></td><tr>
					<tr><td><input class="input" type="text" name="username" placeholder="username" style="width: 100%;" required></td><tr>
					<tr><td><input class="input" type="password" name="password" placeholder="password" style="width: 100%;" required></td><tr>
					<tr><td style="text-align: right;"><input class="button" type="submit" value="MASUK" required></td><tr>
					<tr><td style="text-align: center;"><span class="comment"><?php echo "INFINO CBT V ".$xml->version;?></span><tr>
				</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>