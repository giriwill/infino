<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
			});			
		</script>
		<style>
			
		</style>
	</head>
<body>

	<div class="box2">
		<b>Info Aplikasi</b>
		<br><br><br>
		<?php
		//cek internet
		function check_internet_connection($sCheckHost = 'www.google.com'){
		    return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
		}
		$bIsConnected = check_internet_connection();
		//read version from xml file	

		if($bIsConnected == 1){
			$xml=simplexml_load_file("../version.xml") or die("Error: Cannot create object");
			$xmlnew=simplexml_load_file("http://infino.web.id/update/version.xml") or die("Error: Cannot create object");
			$xmlupdate=simplexml_load_file("http://infino.web.id/update/update.xml") or die("Error: Cannot create object");
			$versilama = str_replace(" ", "", $xml->version) ;
			$versibaru = str_replace(" ", "", $xmlnew->version);
			
			echo "<table border=0 cellpadding=10 class=table>";
			echo "<tr>";
			echo "<th colspan=5><label style='color:#fff'>Internet Terhubung</th>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='width:200px;'>Versi Aplikasi Saat ini</td><td style='width:20px;'>:</td><td>".$versilama."</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Versi Terbaru</td><td>:</td><td>".$versibaru."</td>";
			echo "</tr>";			
			if($versilama != $versibaru){
				echo "<tr>";
				echo "<td>Download Patch</td><td>:</td><td><a href='http://infino.web.id/update/".$xmlupdate->update."' download style='color:red'>[ KLIK DISINI ]</a></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>Upload Patch</td><td>:</td>
				<td>
					<form action='data/data_upload_patch.php' method='POST' enctype='multipart/form-data'>
						<input type='file' name='patch'> &nbsp
						<input type='submit' value='UPLOAD' class='button'>
					</form>
				</td>";
				echo "</tr>";
			}
			echo "</table>";
		}else{
			echo "<label style='color:red'>Koneksi Internet Anda Bermasalah</label>";
		}
		?>
	</div>
</body>
</html>
