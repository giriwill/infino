<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<script>
	$(document).ready(function(){
		var jmlMU = $("#jmlMU").val();

		for(var s = 0 ; s <= jmlMU ; s++){
			var tokenBaru;
			$("#refresh"+s).click(function(){
				var id = $(this).val();				
				$.ajax({
				            type: "GET",
				            url: "data/data_token.php",
				            data:{
				                'id' : id
				            },
				            success : function(data){
				            	window.location.href = '';
				            }
				});
			});
		}

		for(var b=0; b <= jmlMU; b++){
			var stat = $("#isiStatus"+b).text();
			if(stat == "Aktifkan"){
				$("#active"+b).css('background-color','#ef0408');
			}else{
				$("#active"+b).css('background-color','#6f73fc');
			}
		}

		for(var a=0; a <= jmlMU; a++){
		$("#active"+a).click(function(){
			var id = $(this).val();
			$.ajax({
			            type: "GET",
			            url: "data/data_ujian_active.php",
			            data:{
			                'id' : id
			            },
			            success : function(data){
			            	$("#isiStatus"+a).text(data);
			            	window.location.href = '';
			            }
			});
		});
		}
	});	
	</script>
</head>
<body>
<label style="color:red;font-size: 14px;">
- Ketika "Mematikan" Status Ujian, Pastikan Tidak Ada Ujian Yang Sedang Berlangsung
</label>
<table class="table">
			<tr>
				<th width="10">No.</th>
				<th width="8%">Kode Ujian</th>
				<th width="13%">Kode Bank Soal</th>
				<th>Jurusan</th>
				<th>Lama Ujian</th>
				<th>Kelompok Ujian</th>
				<th>Token</th>
				<th>Status Ujian</th>
				<th width="10">Cmd</th>
			</tr>
			<?php
				function durasiUjian($waktu){
					/*$jam = 0;
					$pembagian = 0;
					$menit = 0;
					if($waktu > 60){
						$pembagian = $waktu/60;
						$jam = number_format($waktu/60);
						$menit = ceil(number_format($pembagian-$jam,2)*60);
					}else{
						$jam = 0;
						$menit = $waktu;
					}*/
					$detik = $waktu * 60;
					$jam = $detik / 3600;
					$jampas = floor($jam);
					$sisamenit = $jam-(floor($jam));
					$menit = ceil($sisamenit * 60);
					return $jampas." Jam:".$menit." Menit";
				}

				$offset = $_GET['offset'];
				$limit = $_GET['limit'];
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				$status = "";
				$no = $offset+1;
				$sql = "select * from tbl_ujian where kode_ujian LIKE '%".$katakunci."%' LIMIT ".$limit." OFFSET ".$offset;
				$query = mysqli_query($con,$sql);
				$jmlMU = mysqli_num_rows($query);
				echo "<input type='hidden' id='jmlMU' value='".$jmlMU."'>";

				while($res = mysqli_fetch_array($query)){
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['kode_ujian']."</td>";
						$sqlBank = mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$res['id_bank_soal']."'");
						$resBank = mysqli_fetch_array($sqlBank);
						echo "<td>".$resBank['kode_bank_soal']."</td>";
						$sqlJurusan = mysqli_query($con,"select * from tbl_jurusan where id_jurusan='".$res['id_jurusan']."'");
						$resJurusan = mysqli_fetch_array($sqlJurusan);
						$rombel = "";
						if($resJurusan['nama_jurusan'] == ""){
							$rombel = "All";
						}else{
							$rombel = $resJurusan['nama_jurusan'];
						}
						echo "<td>".$rombel."</td>";
						echo "<td align='center'>".durasiUjian($res['lama_ujian'])."</td>";
						echo "<td align='center'>Kelompok ".$res['sesi_ujian']."</td>";
						echo "<td><button id='refresh".$no."' class='buttonHijau' value='".$res['id_ujian']."'><img src='images/refresh.png'>&nbsp".$res['token_ujian']."</button></td>";
						if($res['status_ujian'] == 0){
							$status = "Aktifkan";
						}else{
							$status = "Matikan";
						}
						echo "<td><button id='active".$no."' value='".$res['id_ujian']."' class='button'><label id='isiStatus".$no."'>".$status."</label></button></td>";
						echo "<td><a href='?pages=ujian_edit&id=".$res['id_ujian']."'><img src=images/pencil.png></a>";?>
							<?php if(isset($_SESSION['level'])==1){?>
							&nbsp <a href="data/data_ujian_delete.php?id=<?php echo $res['id_ujian']?>" onclick="return confirm('Anda yakin akan menghapus ini ? Ini akan mengakibatkan semua data ujian dan jawaban siswa terhapus ! Berhati Hatilah !')"><img src=images/trash.png></a>
							<?php }?>
						</td>
						<?php		
						//cek apakah data ujian ini mode waktu server ?
						if($res['time_mode'] == 1){
							echo "<tr>";
							echo "<td colspan='9'><label style='font-size:12px;'><b>Waktu Ujian Dimulai : ";
							date_default_timezone_set('Asia/Jakarta');
							echo "Tanggal ";
							echo date("d-m-Y", $res['time_set']);
							echo ", Pukul ";
							echo date("H:i:s", $res['time_set']);
							echo "</b></label>&nbsp&nbsp";
							echo "<a style='font-size:12px;color:red' href='data/data_ujian_reset_waktu.php?idUjian=".$res['id_ujian']."'><b>[ RESET ]</b></a>";
							echo "</td>";
							echo "</tr>";
						}				
						echo "</tr>";								
					$no++;
				}
			?>
		</table>
</body>
</html>