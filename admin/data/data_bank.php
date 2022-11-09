<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script>
		$(document).ready(function(){

		});	
	</script>
</head>
<body>
<table class="table">
			<tr>
				<th width="10">No.</th>
				<th>Kode</th>
				<th>Mata Pelajaran</th>
				<th>Jumlah Soal</th>
				<th>Jumlah Opsi</th>
				<th style="text-align: center;">Command</th>
			</tr>
			<?php
				if(isset($_GET['offset']) && isset($_GET['limit'])){
					$offset = $_GET['offset'];
					$limit = $_GET['limit'];
				}else{
					$offset = 0;
					$limit = 0;
				}	
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				$no = $offset+1;
				$sql = "select * from tbl_bank_soal where kode_bank_soal LIKE '%".$katakunci."%' order by id_bank_soal desc LIMIT ".$limit." OFFSET ".$offset;
				$query = mysqli_query($con,$sql);

				function jmlSoal($idBank){
					include("../db.php");
					$sqlJml = mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$idBank."'");
					$resJml = mysqli_num_rows($sqlJml);
					return $resJml;
				}

				function lock($idBank){
					include("../db.php");
					$sql = mysqli_query($con,"select * from tbl_ujian where id_bank_soal='".$idBank."' AND status_ujian='1'");
					$jml = mysqli_num_rows($sql);
					return $jml;
				}

				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['kode_bank_soal']."</td>";

						$sqlMapel = "select * from tbl_mapel where id_mapel='".$res['id_mapel']."'";
						$queryMapel = mysqli_query($con,$sqlMapel);
						$restMapel = mysqli_fetch_array($queryMapel);
						echo "<td>".$restMapel['nama_mapel']."</td>";
						echo "<td>".jmlSoal($res['id_bank_soal'])." Butir </td>";
						echo "<td>".$res['jml_opsi']." Opsi</td>";
						
						echo "<td align='center'>"?>
								<?php if(lock($res['id_bank_soal']) < 1){?>
									<a href="?pages=bank_edit&id=<?php echo $res['id_bank_soal']?>"  title="Edit Bank Soal"><img src=images/pencil.png></a>
									&nbsp <a href="data/data_bank_delete.php?id=<?php echo $res['id_bank_soal']?>" onclick="return confirm('Anda yakin akan menghapus ini ? Ini akan mengakibatkan semua soal pada bank soal ini akan terhapus !, berhati hatilah !')"  title="Hapus Bank Soal"><img src=images/trash.png></a>
									&nbsp <a href="?pages=soal&id=<?php echo $res['id_bank_soal']?>"><img src=images/test1.png title="Detail Soal"></a>
									&nbsp <a href="pages/review.php?id=<?php echo $res['id_bank_soal']?>" target="blank"><img src=images/vision.png title="Review Soal"></a>
									&nbsp <a href="pages/reviewmobile.php?id=<?php echo $res['id_bank_soal']?>" target="blank"><img src=images/smartphone.png title="Review Soal (Mobile)"></a>
									</td>
								<?php }else{echo "<img src=images/lock.png>";}?>
						<?php						
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>