<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
<table class="table">
			<tr>
				<th width="10">No.</th>
				<th width="15%">Bank Soal</th>
				<th width="20%">Deskripsi Soal</th>
				<th width="20%">Jenis Soal</th>
				<th width="20%">Acak Soal</th>
				<th width="20%">Acak Opsi</th>
				<th width="20%">Unduh Audio</th>
				<th width="10">Command</th>
			</tr>
			<?php
				$offset = $_GET['offset'];
				$limit = $_GET['limit'];
				$idBank = $_GET['idBank'];
				$no = $offset+1;
				$sql = "select * from tbl_soal WHERE id_bank_soal='".$idBank."' LIMIT ".$limit." OFFSET ".$offset;
				mysqli_set_charset($con,'utf8');
				$query = mysqli_query($con,$sql);

				function cekBank($id){
					include("../db.php");
					$sqlBank = mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$id."'");
					$resBank = mysqli_fetch_array($sqlBank);
					return $resBank['kode_bank_soal'];
				}

				function jenisSoal($nomor){
					if($nomor == 1){
						return "Pilihan Ganda";
					}else{
						return "Essay";
					}
				}

				function acakSoal($nomor){
					if($nomor == 1){
						return "Diacak";
					}else{
						return "Tidak Diacak";
					}
				}

				function acakOpsi($nomor){
					if($nomor == 1){
						return "Diacak";
					}else{
						return "Tidak Diacak";
					}
				}

				while($res = mysqli_fetch_array($query)){					
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".cekBank($res['id_bank_soal'])."</td>";
						$cuplikan = substr($res['des_soal'], 0,40);
						if(isset($cuplikan)){
							echo "<td>".							
								substr(strip_tags($res['des_soal']), 0,12).". . ."
							."</td>";	
						}else{
							echo "<td>Cuplikan Soal</td>";	
						}												
						echo "<td>".jenisSoal($res['jenis_soal'])."</td>";								
						echo "<td>".acakSoal($res['acak_soal'])."</td>";							
						echo "<td>".acakOpsi($res['acak_opsi'])."</td>";
						echo "<td align='center'>";
						if($res['audio_soal'] != ""){
							echo "<a href='../audios/".$res['audio_soal']."' target='_blank' download><img src='images/download.png'></a>";
						}
						echo "</td>";
						echo "<td><a href='?pages=soal_edit&id=".$res['id_soal']."'><img src=images/pencil.png></a>";?>
							&nbsp <a href="data/data_soal_delete.php?id=<?php echo $res['id_soal']?>" onclick="return confirm('Anda yakin akan menghapus ini ?')"><img src=images/trash.png></a></td>
						<?php
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>